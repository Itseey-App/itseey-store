@extends('layouts.app')

@section('title', 'Record Stock Movement')
@section('header', 'Record Stock Movement')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-semibold text-gray-800">Record New Stock Movement</h2>
    <a href="{{ route('stock-movements.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-md transition-all inline-flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Stock Movements
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <form action="{{ route('stock-movements.store') }}" method="POST" class="p-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-form-select name="product_id" id="product_id" label="Product" required>
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }} (Current Stock: {{ $product->stock }})
                    </option>
                    @endforeach
                </x-form-select>
                @error('product_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-form-select name="type" id="type" label="Movement Type" required>
                    <option value="">Select Type</option>
                    <option value="in" {{ old('type') == 'in' ? 'selected' : '' }}>Stock In</option>
                    <option value="out" {{ old('type') == 'out' ? 'selected' : '' }}>Stock Out</option>
                </x-form-select>
                @error('type')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-form-input
                    type="number"
                    name="quantity"
                    id="quantity"
                    :value="old('quantity')"
                    label="Quantity"
                    min="1"
                    required />
                @error('quantity')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-form-input
                    type="text"
                    name="notes"
                    id="notes"
                    :value="old('notes')"
                    label="Notes (Optional)" />
                @error('notes')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <x-button type="submit" variant="primary">Record Movement</x-button>
        </div>
    </form>
</div>

@endsection