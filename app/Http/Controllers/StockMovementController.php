<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class StockMovementController extends Controller
{
    public function index(Request $request)
    {
        $query = StockMovement::with(['product', 'product.category']);

        // Filter by date range
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $from = Carbon::parse($request->from_date)->startOfDay();
            $to = Carbon::parse($request->to_date)->endOfDay();
            $query->whereBetween('created_at', [$from, $to]);
        }

        // Filter by product
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        // Filter by type (in/out)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('q')) {
            $query->where(function ($sub) use ($request) {
                $sub->whereHas('product', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->q . '%');
                })
                    ->orWhere('notes', 'like', '%' . $request->q . '%');
            });
        }

        $stockMovements = $query->orderBy('created_at', 'desc')->paginate(15);
        $products = Product::orderBy('name')->get();

        return view('stock-movements.index', compact('stockMovements', 'products'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('stock-movements.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        // Check if we have enough stock for outgoing movements
        if ($validated['type'] === 'out' && $product->stock < $validated['quantity']) {
            return back()->withInput()->with('error', 'Not enough stock available.');
        }

        // Update product stock
        if ($validated['type'] === 'in') {
            $product->stock += $validated['quantity'];
        } else {
            $product->stock -= $validated['quantity'];
        }
        $product->save();

        // Create stock movement record
        StockMovement::create($validated);

        return redirect()->route('stock-movements.index')
            ->with('success', 'Stock movement recorded successfully.');
    }

    public function report(Request $request)
    {
        $reportType = $request->input('report_type', 'daily');
        $fromDate = $request->input('from_date', Carbon::now()->startOfDay()->format('Y-m-d'));
        $toDate = $request->input('to_date', Carbon::now()->endOfDay()->format('Y-m-d'));

        // Parse dates
        $from = Carbon::parse($fromDate)->startOfDay();
        $to = Carbon::parse($toDate)->endOfDay();

        // Base query
        $query = StockMovement::with(['product', 'product.category'])
            ->whereBetween('created_at', [$from, $to]);

        // Group by date based on report type
        switch ($reportType) {
            case 'daily':
                $dateFormat = 'Y-m-d';
                $title = 'Daily Stock Movement Report';
                break;
            case 'weekly':
                $dateFormat = 'Y-W'; // Year and week number
                $title = 'Weekly Stock Movement Report';
                break;
            case 'monthly':
                $dateFormat = 'Y-m';
                $title = 'Monthly Stock Movement Report';
                break;
            case 'yearly':
                $dateFormat = 'Y';
                $title = 'Yearly Stock Movement Report';
                break;
            default:
                $dateFormat = 'Y-m-d';
                $title = 'Stock Movement Report';
        }

        // Get data
        $stockMovements = $query->orderBy('created_at', 'desc')->get();

        // Group data by date
        $groupedData = $stockMovements->groupBy(function ($item) use ($dateFormat) {
            return Carbon::parse($item->created_at)->format($dateFormat);
        });

        // For export to PDF
        if ($request->has('export_pdf')) {
            $pdf = PDF::loadView('stock-movements.report-pdf', [
                'title' => $title,
                'fromDate' => $from->format('Y-m-d'),
                'toDate' => $to->format('Y-m-d'),
                'reportType' => $reportType,
                'groupedData' => $groupedData,
            ]);

            return $pdf->download("stock-movement-report-{$reportType}-{$from->format('Y-m-d')}-to-{$to->format('Y-m-d')}.pdf");
        }

        return view('stock-movements.report', [
            'title' => $title,
            'fromDate' => $from->format('Y-m-d'),
            'toDate' => $to->format('Y-m-d'),
            'reportType' => $reportType,
            'groupedData' => $groupedData,
        ]);
    }
}
