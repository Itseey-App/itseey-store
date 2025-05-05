@extends('layouts.app')

@section('title', $title)
@section('header', $title)

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-semibold text-gray-800">Report<h2>
    <div class="flex space-x-2">
        <form method="GET" action="{{ route('reports.index') }}" class="inline">
            <input type="hidden" name="export_pdf" value="1">
            <input type="hidden" name="from_date" value="{{ $fromDate }}">
            <input type="hidden" name="to_date" value="{{ $toDate }}">
            <input type="hidden" name="report_type" value="{{ $reportType }}">
            <button type="submit" class="bg-secondary hover:bg-secondary/90 text-white py-2 px-4 rounded-md transition-all inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Export to PDF
            </button>
        </form>
    </div>
</div>

<!-- Filters -->
<div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
    <div class="p-4 bg-gray-50 border-b">
        <h3 class="text-sm font-medium text-gray-700">Report Settings</h3>
    </div>
    <form method="GET" action="{{ route('reports.index') }}" class="p-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <x-form-select name="report_type" id="report_type" label="Report Type">
                    <option value="daily" {{ $reportType == 'daily' ? 'selected' : '' }}>Daily</option>
                    <option value="weekly" {{ $reportType == 'weekly' ? 'selected' : '' }}>Weekly</option>
                    <option value="monthly" {{ $reportType == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="yearly" {{ $reportType == 'yearly' ? 'selected' : '' }}>Yearly</option>
                </x-form-select>
            </div>
            <div>
                <x-form-input
                    type="date"
                    name="from_date"
                    id="from_date"
                    :value="$fromDate"
                    label="From Date"
                />
            </div>
            <div>
                <x-form-input
                    type="date"
                    name="to_date"
                    id="to_date"
                    :value="$toDate"
                    label="To Date"
                />
            </div>
            <div class="flex items-end">
                <x-button type="submit" variant="primary" class="w-full">Generate Report</x-button>
            </div>
        </div>
    </form>
</div>

<!-- Report Results -->
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-4 bg-gray-50 border-b">
        <h3 class="font-medium text-gray-700">Report Results: {{ $fromDate }} to {{ $toDate }}</h3>
    </div>

    @if($groupedData->isEmpty())
        <div class="p-6 text-center text-gray-500">
            No data available for the selected period.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Period</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock In (Total)</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock Out (Total)</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Net Change</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($groupedData as $period => $movements)
                        @php
                            $stockIn = $movements->where('type', 'in')->sum('quantity');
                            $stockOut = $movements->where('type', 'out')->sum('quantity');
                            $netChange = $stockIn - $stockOut;
                        @endphp
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $period }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-green-600">+{{ $stockIn }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-red-600">-{{ $stockOut }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium {{ $netChange >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $netChange >= 0 ? '+' : '' }}{{ $netChange }}
                                </div>
                            </td>
                        </tr>

                        <!-- Detailed movements for this period -->
                        <tr>
                            <td colspan="4" class="px-6 py-4">
                                <div class="border-t border-gray-200 pt-2">
                                    <h4 class="text-xs font-medium text-gray-500 uppercase mb-2">Detailed Movements</h4>
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500">Product</th>
                                                <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500">Type</th>
                                                <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500">Quantity</th>
                                                <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500">Date & Time</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($movements as $movement)
                                                <tr>
                                                    <td class="px-3 py-2 whitespace-nowrap text-xs">
                                                        {{ $movement->product->name }}
                                                    </td>
                                                    <td class="px-3 py-2 whitespace-nowrap text-xs">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $movement->type === 'in' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                            {{ $movement->type === 'in' ? 'In' : 'Out' }}
                                                        </span>
                                                    </td>
                                                    <td class="px-3 py-2 whitespace-nowrap text-xs">
                                                        {{ $movement->quantity }}
                                                    </td>
                                                    <td class="px-3 py-2 whitespace-nowrap text-xs text-gray-500">
                                                        {{ $movement->created_at->format('Y-m-d H:i') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <th scope="row" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <td class="px-6 py-3 whitespace-nowrap">
                            <div class="text-sm font-bold text-green-600">
                                +{{ $groupedData->flatten()->where('type', 'in')->sum('quantity') }}
                            </div>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap">
                            <div class="text-sm font-bold text-red-600">
                                -{{ $groupedData->flatten()->where('type', 'out')->sum('quantity') }}
                            </div>
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap">
                            @php
                                $totalIn = $groupedData->flatten()->where('type', 'in')->sum('quantity');
                                $totalOut = $groupedData->flatten()->where('type', 'out')->sum('quantity');
                                $totalNet = $totalIn - $totalOut;
                            @endphp
                            <div class="text-sm font-bold {{ $totalNet >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $totalNet >= 0 ? '+' : '' }}{{ $totalNet }}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @endif
</div>
@endsection
