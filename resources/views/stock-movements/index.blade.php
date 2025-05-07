@extends('layouts.app')

@section('title', 'Stock Movements')
@section('header', 'Stock Movements')

@section('content')
<div class="flex justify-end items-center mb-6">
    <!-- <a href="{{ route('stock-movements.create') }}" class="group flex items-center px-4 py-2.5 bg-pink-500 text-white font-medium rounded-md hover:bg-pink-600 transition-all duration-200 shadow-sm hover:shadow">
        <span class="flex justify-center items-center w-5 h-5 mr-2 bg-white bg-opacity-20 rounded-full">
            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
        </span>
        Record Stock Movement
    </a> -->
</div>


<!-- Improved Filters -->
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
                    label="From Date" />
            </div>
            <div>
                <x-form-input
                    type="date"
                    name="to_date"
                    id="to_date"
                    :value="request('to_date')"
                    label="To Date" />
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
        <div class="mt-4 flex flex-wrap gap-2 justify-end">
            <x-button type="submit" variant="primary" class="px-6">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                Filter
            </x-button>
            @if(request()->anyFilled(['from_date', 'to_date', 'product_id', 'type']))
            <a href="{{ route('stock-movements.index') }}" class="flex items-center px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md transition-all shadow-sm hover:shadow">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Clear
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
                <td colspan="7" class="px-6 py-12 whitespace-nowrap text-sm text-gray-500">
                    <div class="flex flex-col items-center">
                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-lg font-medium text-gray-500">No stock movement records found</p>
                        <p class="text-gray-400 mt-1">Try adjusting your filters or add a new stock movement</p>
                        <a href="{{ route('stock-movements.create') }}" class="mt-4 btn-primary inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Record Stock Movement
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="px-6 py-4 border-t">
        {{ $stockMovements->links() }}
    </div>
</div>


@endsection
<a href="{{ route('stock-movements.create') }}" class="fixed bottom-6 right-6 z-50 p-4 bg-pink-500 hover:bg-pink-600 text-white rounded-full shadow-lg transition-all">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
    </svg>
</a>