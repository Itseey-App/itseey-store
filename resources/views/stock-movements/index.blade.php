@extends('layouts.app')

@section('title', 'Stock Movements')
@section('header', 'Stock Movements')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-semibold text-gray-800">Stock Movement Records</h2>
    <a href="{{ route('stock-movements.create') }}" class="btn-primary">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Record Stock Movement
    </a>
</div>

<!-- Filters -->
<div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
    <div class="p-4 bg-gray-50 border-b">
        <h3 class="text-sm font-medium text-gray-700">Filter Stock Movements</h3>
    </div>
    <form method="GET" action="{{ route('stock-movements.index') }}" class="p-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <x-form-input
                    type="date"
                    name="from_date"
                    id="from_date"
                    :value="request('from_date')"
                    label="From Date"
                />
            </div>
            <div>
                <x-form-input
                    type="date"
                    name="to_date"
                    id="to_date"
                    :value="request('to_date')"
                    label="To Date"
                />
            </div>
            <div>
                <x-form-select name="product_id" id="product_id" label="Product">
                    <option value="">All Products</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </x-form-select>
            </div>
            <div>
                <x-form-select name="type" id="type" label="Movement Type">
                    <option value="">All Types</option>
                    <option value="in" {{ request('type') == 'in' ? 'selected' : '' }}>Stock In</option>
                    <option value="out" {{ request('type') == 'out' ? 'selected' : '' }}>Stock Out</option>
                </x-form-select>
            </div>
        </div>
        <div class="mt-4 flex justify-end">
            <x-button type="submit" variant="primary">Filter</x-button>
            @if(request()->anyFilled(['from_date', 'to_date', 'product_id', 'type']))
                <a href="{{ route('stock-movements.index') }}" class="ml-2 bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-md transition-all inline-flex items-center">
                    Clear Filters
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Stock Movements Table -->
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($stockMovements as $movement)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $movement->created_at->format('Y-m-d') }}</div>
                    <div class="text-sm text-gray-500">{{ $movement->created_at->format('H:i:s') }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ $movement->product->name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">{{ $movement->product->category->name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $movement->type === 'in' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $movement->type === 'in' ? 'Stock In' : 'Stock Out' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $movement->quantity }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-500">{{ $movement->notes ?? '-' }}</div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No stock movement records found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="px-6 py-4 border-t">
        {{ $stockMovements->links() }}
    </div>
</div>
@endsection
