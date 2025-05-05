<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 14px;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .summary-table th {
            text-align: right;
        }
        .stock-in {
            color: #16a34a;
        }
        .stock-out {
            color: #dc2626;
        }
        .footer {
            margin-top: 20px;
            font-size: 10px;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Itseey Store - {{ $title }}</h1>
        <p>Period: {{ $fromDate }} to {{ $toDate }}</p>
        <p>Generated on: {{ now()->format('Y-m-d H:i:s') }}</p>
    </div>

    @if($groupedData->isEmpty())
        <p>No data available for the selected period.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Period</th>
                    <th>Stock In (Total)</th>
                    <th>Stock Out (Total)</th>
                    <th>Net Change</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groupedData as $period => $movements)
                    @php
                        $stockIn = $movements->where('type', 'in')->sum('quantity');
                        $stockOut = $movements->where('type', 'out')->sum('quantity');
                        $netChange = $stockIn - $stockOut;
                    @endphp
                    <tr>
                        <td>{{ $period }}</td>
                        <td class="stock-in">+{{ $stockIn }}</td>
                        <td class="stock-out">-{{ $stockOut }}</td>
                        <td style="font-weight: bold; {{ $netChange >= 0 ? 'color: #16a34a;' : 'color: #dc2626;' }}">
                            {{ $netChange >= 0 ? '+' : '' }}{{ $netChange }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <td class="stock-in" style="font-weight: bold;">
                        +{{ $groupedData->flatten()->where('type', 'in')->sum('quantity') }}
                    </td>
                    <td class="stock-out" style="font-weight: bold;">
                        -{{ $groupedData->flatten()->where('type', 'out')->sum('quantity') }}
                    </td>
                    <td style="font-weight: bold;
                        {{ ($groupedData->flatten()->where('type', 'in')->sum('quantity') - $groupedData->flatten()->where('type', 'out')->sum('quantity')) >= 0 ? 'color: #16a34a;' : 'color: #dc2626;' }}">
                        @php
                            $totalIn = $groupedData->flatten()->where('type', 'in')->sum('quantity');
                            $totalOut = $groupedData->flatten()->where('type', 'out')->sum('quantity');
                            $totalNet = $totalIn - $totalOut;
                        @endphp
                        {{ $totalNet >= 0 ? '+' : '' }}{{ $totalNet }}
                    </td>
                </tr>
            </tfoot>
        </table>

        <h3>Detailed Movement Records</h3>

        @foreach($groupedData as $period => $movements)
            <h4>{{ $period }}</h4>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Date & Time</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movements as $movement)
                        <tr>
                            <td>{{ $movement->product->name }}</td>
                            <td>{{ $movement->product->category->name }}</td>
                            <td>{{ $movement->type === 'in' ? 'Stock In' : 'Stock Out' }}</td>
                            <td>{{ $movement->quantity }}</td>
                            <td>{{ $movement->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $movement->notes ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @endif

    <div class="footer">
        <p>Itseey Store Skincare Management System &copy; {{ date('Y') }}</p>
    </div>
</body>
</html>
