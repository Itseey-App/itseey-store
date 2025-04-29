<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('name')
            ->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'expiry_date' => 'required|date|after:today',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $product = Product::create($validated);

        // Record initial stock movement
        if ($validated['stock'] > 0) {
            StockMovement::create([
                'product_id' => $product->id,
                'type' => 'in',
                'quantity' => $validated['stock'],
                'notes' => 'Initial stock',
            ]);
        }

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $product->load('category', 'stockMovements');
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'expiry_date' => 'required|date',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $oldStock = $product->stock;

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $product->update($validated);

        // Record stock movement if stock has changed
        $newStock = $validated['stock'];
        if ($newStock != $oldStock) {
            $type = $newStock > $oldStock ? 'in' : 'out';
            $quantity = abs($newStock - $oldStock);

            StockMovement::create([
                'product_id' => $product->id,
                'type' => $type,
                'quantity' => $quantity,
                'notes' => 'Stock adjustment via product update',
            ]);
        }

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Delete image if it exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function updateStock(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|not_in:0',
            'notes' => 'nullable|string',
        ]);

        $type = $validated['quantity'] > 0 ? 'in' : 'out';
        $quantity = abs($validated['quantity']);

        // Check if we have enough stock for outgoing movements
        if ($type === 'out' && $product->stock < $quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        // Update product stock
        $product->stock = $type === 'in'
            ? $product->stock + $quantity
            : $product->stock - $quantity;
        $product->save();

        // Create stock movement record
        StockMovement::create([
            'product_id' => $product->id,
            'type' => $type,
            'quantity' => $quantity,
            'notes' => $validated['notes'] ?? ($type === 'in' ? 'Stock added' : 'Stock removed'),
        ]);

        return back()->with('success', 'Stock updated successfully.');
    }
}