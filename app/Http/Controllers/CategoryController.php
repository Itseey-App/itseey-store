<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->orderBy('name')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Check if there are products in this category
        if ($category->products()->exists()) {
            return redirect()->route('categories.index')
                ->with('error', 'Cannot delete category that has products.');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        $categoryIds = explode(',', $request->input('selected_categories'));

        // Validasi bahwa semua kategori yang dipilih tidak memiliki produk
        $categoriesWithProducts = Category::whereIn('id', $categoryIds)
            ->withCount('products')
            ->having('products_count', '>', 0)
            ->count();

        if ($categoriesWithProducts > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Cannot delete categories that have products.');
        }

        // Delete categories
        Category::whereIn('id', $categoryIds)->delete();

        return redirect()->route('categories.index')
            ->with('success', count($categoryIds) . ' categories deleted successfully.');
    }
}
