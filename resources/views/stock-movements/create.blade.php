@extends('layouts.app')

@section('title', 'Pencatatan Stok')
@section('header', 'Pencatatan Stok')

@section('content')
<!-- Alert Messages -->
@if(session('success'))
<div id="alert-success" class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 flex items-center justify-between">
    <div class="flex items-center">
        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <span class="text-green-700 font-medium">{{ session('success') }}</span>
    </div>
    <button type="button" class="text-green-400 hover:text-green-600" onclick="closeAlert('alert-success')">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
    </button>
</div>
@endif

@if(session('error'))
<div id="alert-error" class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4 flex items-center justify-between">
    <div class="flex items-center">
        <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
        </svg>
        <span class="text-red-700 font-medium">{{ session('error') }}</span>
    </div>
    <button type="button" class="text-red-400 hover:text-red-600" onclick="closeAlert('alert-error')">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
    </button>
</div>
@endif

@if($errors->any())
<div id="alert-validation" class="mb-6 bg-orange-50 border border-orange-200 rounded-lg p-4">
    <div class="flex items-center mb-3">
        <svg class="w-5 h-5 text-orange-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
        </svg>
        <span class="text-orange-700 font-medium">Terjadi kesalahan validasi:</span>
        <button type="button" class="ml-auto text-orange-400 hover:text-orange-600" onclick="closeAlert('alert-validation')">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
    <ul class="text-sm text-orange-700 space-y-1">
        @foreach($errors->all() as $error)
        <li class="flex items-center">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 001.414 1.414l3-3z" clip-rule="evenodd"></path>
            </svg>
            {{ $error }}
        </li>
        @endforeach
    </ul>
</div>
@endif

<div class="mb-6">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li>
                <div class="flex items-center">
                    <a href="{{ route('stock-movements.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-pink-500 md:ml-2">Pencatatan Stok</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-pink-500 md:ml-2">Pencatatan Stok</span>
                </div>
            </li>
        </ol>
    </nav>
</div>

<div class="mt-6 mb-6 bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
    <div class="p-4 bg-pink-50 border-b border-pink-100">
        <h3 class="text-sm font-semibold text-pink-500 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Informasi Pencatatan Stok
        </h3>
    </div>
    <div class="p-6">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1 p-4 rounded-lg">
                <div class="flex items-center mb-3">
                    <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white mr-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                        </svg>
                    </div>
                    <h3 class="font-medium text-gray-800">Stok Masuk</h3>
                </div>
                <p class="text-sm text-gray-600">
                    Digunakan untuk menambah jumlah stok produk dalam inventaris, seperti dari pembelian baru atau pengembalian barang.
                </p>
            </div>
            <div class="flex-1 p-4 rounded-lg">
                <div class="flex items-center mb-3">
                    <div class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center text-white mr-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </div>
                    <h3 class="font-medium text-gray-800">Stok Keluar</h3>
                </div>
                <p class="text-sm text-gray-600">
                    Digunakan untuk mengurangi jumlah stok produk dalam inventaris, seperti untuk penjualan atau barang rusak.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Toggle Buttons -->
<div class="mb-6 bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
    <div class="p-6">
        <div class="flex flex-col sm:flex-row gap-4 w-full">
            <button type="button" id="btn-stock-in" class="flex-1 bg-green-500 hover:bg-green-600 text-white font-medium py-4 px-6 rounded-lg transition-all flex items-center justify-center text-lg shadow-md">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                </svg>
                Form Stok Masuk
            </button>
            <button type="button" id="btn-stock-out" class="flex-1 bg-red-500 hover:bg-red-600 text-white font-medium py-4 px-6 rounded-lg transition-all flex items-center justify-center text-lg shadow-md">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
                Form Stok Keluar
            </button>
        </div>
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">Pilih salah satu jenis pencatatan stok di atas untuk melanjutkan</p>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100">
                <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Konfirmasi Pencatatan Stok</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500" id="confirmationMessage">
                    Apakah Anda yakin ingin melanjutkan pencatatan stok ini?
                </p>
            </div>
            <div class="flex justify-center space-x-4 mt-4">
                <button id="cancelBtn" class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md hover:bg-gray-400 transition-colors">
                    Batal
                </button>
                <button id="confirmBtn" class="px-4 py-2 bg-blue-600 text-white text-base font-medium rounded-md hover:bg-blue-700 transition-colors">
                    Ya, Lanjutkan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- FORM STOK MASUK -->
<div id="form-stock-in" class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hidden">
    <div class="p-4 bg-green-50 border-b border-green-100">
        <h3 class="text-lg font-semibold text-green-600 flex items-center">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
            Form Stok Masuk
        </h3>
    </div>

    <form action="{{ route('stock-movements.store') }}" method="POST" class="p-8" id="stockInForm">
        @csrf
        <input type="hidden" name="type" value="in">
        <input type="hidden" name="confirmed" value="0" id="confirmedIn">

        <div class="max-w-2xl mx-auto space-y-6">
            <div>
                <label for="product_in" class="block text-sm font-medium text-gray-700 mb-3">Produk</label>
                <select name="product_id" id="product_in" class="block w-full rounded-lg border-gray-200 bg-gray-50 py-4 px-4 text-base focus:border-green-400 focus:ring-green-300 focus:outline-none focus:ring focus:ring-opacity-40" required>
                    <option value="">Pilih Produk</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}" data-stock="{{ $product->stock }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }} (Stok: {{ $product->stock }})
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="quantity_in" class="block text-sm font-medium text-gray-700 mb-3">Jumlah</label>
                <div class="flex rounded-lg bg-gray-50 border border-gray-200 overflow-hidden max-w-md mx-auto">
                    <button type="button" class="px-6 py-4 bg-gray-100 hover:bg-gray-200 border-r border-gray-200 focus:outline-none transition-colors" id="decrease-qty-in">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                    </button>
                    <input
                        type="number"
                        name="quantity"
                        id="quantity_in"
                        value="{{ old('quantity', 1) }}"
                        min="1"
                        class="flex-1 block w-full py-4 px-4 border-0 bg-gray-50 text-center focus:ring-0 text-base font-medium"
                        required />
                    <button type="button" class="px-6 py-4 bg-gray-100 hover:bg-gray-200 border-l border-gray-200 focus:outline-none transition-colors" id="increase-qty-in">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div>
                <label for="notes_in" class="block text-sm font-medium text-gray-700 mb-3">Catatan (Opsional)</label>
                <textarea name="notes" id="notes_in" rows="3" class="block w-full rounded-lg border-gray-200 bg-gray-50 py-4 px-4 text-base focus:border-green-400 focus:ring-green-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Tambahkan catatan untuk stok masuk...">{{ old('notes') }}</textarea>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-6">
                <button type="reset" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-4 px-6 rounded-lg transition-all border border-gray-200 flex items-center justify-center text-base">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Reset Form
                </button>
                <button type="submit" class="flex-1 bg-green-500 hover:bg-green-600 text-white font-medium py-4 px-6 rounded-lg transition-all flex items-center justify-center text-base shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                    </svg>
                    Simpan Stok Masuk
                </button>
            </div>
        </div>
    </form>
</div>

<!-- FORM STOK KELUAR -->
<div id="form-stock-out" class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hidden">
    <div class="p-4 bg-red-50 border-b border-red-100">
        <h3 class="text-lg font-semibold text-red-600 flex items-center">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
            Form Stok Keluar
        </h3>
    </div>

    <form action="{{ route('stock-movements.store') }}" method="POST" class="p-8" id="stockOutForm">
        @csrf
        <input type="hidden" name="type" value="out">
        <input type="hidden" name="confirmed" value="0" id="confirmedOut">

        <div class="max-w-2xl mx-auto space-y-6">
            <div>
                <label for="product_out" class="block text-sm font-medium text-gray-700 mb-3">Produk</label>
                <select name="product_id" id="product_out" class="block w-full rounded-lg border-gray-200 bg-gray-50 py-4 px-4 text-base focus:border-red-400 focus:ring-red-300 focus:outline-none focus:ring focus:ring-opacity-40" required>
                    <option value="">Pilih Produk</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}" data-stock="{{ $product->stock }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }} (Stok: {{ $product->stock }})
                    </option>
                    @endforeach
                </select>
                <div id="stock-info-out" class="mt-3 text-sm font-medium hidden">
                    <span class="px-4 py-2 bg-red-50 text-red-600 rounded-full inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                        </svg>
                        Stok tersedia: <span id="available-stock-out" class="font-semibold ml-1">0</span> unit
                    </span>
                </div>
            </div>

            <div>
                <label for="quantity_out" class="block text-sm font-medium text-gray-700 mb-3">Jumlah</label>
                <div class="flex rounded-lg bg-gray-50 border border-gray-200 overflow-hidden max-w-md mx-auto">
                    <button type="button" class="px-6 py-4 bg-gray-100 hover:bg-gray-200 border-r border-gray-200 focus:outline-none transition-colors" id="decrease-qty-out">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                    </button>
                    <input
                        type="number"
                        name="quantity"
                        id="quantity_out"
                        value="{{ old('quantity', 1) }}"
                        min="1"
                        class="flex-1 block w-full py-4 px-4 border-0 bg-gray-50 text-center focus:ring-0 text-base font-medium"
                        required />
                    <button type="button" class="px-6 py-4 bg-gray-100 hover:bg-gray-200 border-l border-gray-200 focus:outline-none transition-colors" id="increase-qty-out">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6"></path>
                        </svg>
                    </button>
                </div>
                <div id="quantity-warning-out" class="mt-3 hidden items-center text-sm text-red-600 justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span class="font-medium">Jumlah melebihi stok yang tersedia!</span>
                </div>
            </div>

            <div>
                <label for="notes_out" class="block text-sm font-medium text-gray-700 mb-3">Catatan (Opsional)</label>
                <textarea name="notes" id="notes_out" rows="3" class="block w-full rounded-lg border-gray-200 bg-gray-50 py-4 px-4 text-base focus:border-red-400 focus:ring-red-300 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Tambahkan catatan untuk stok keluar...">{{ old('notes') }}</textarea>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-6">
                <button type="reset" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-4 px-6 rounded-lg transition-all border border-gray-200 flex items-center justify-center text-base">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Reset Form
                </button>
                <button type="submit" id="submit-btn-out" class="flex-1 bg-red-500 hover:bg-red-600 text-white font-medium py-4 px-6 rounded-lg transition-all flex items-center justify-center text-base shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                    Simpan Stok Keluar
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnStockIn = document.getElementById('btn-stock-in');
        const btnStockOut = document.getElementById('btn-stock-out');
        const formStockIn = document.getElementById('form-stock-in');
        const formStockOut = document.getElementById('form-stock-out');

        // Modal elements
        const modal = document.getElementById('confirmationModal');
        const confirmationMessage = document.getElementById('confirmationMessage');
        const confirmBtn = document.getElementById('confirmBtn');
        const cancelBtn = document.getElementById('cancelBtn');

        let currentForm = null;
        let currentFormType = null;

        // Function to set button states following proper UI/UX principles
        function setButtonStates(state) {
            // Reset all classes first
            btnStockIn.className = 'flex-1 font-medium py-4 px-6 rounded-lg transition-all flex items-center justify-center text-lg shadow-md';
            btnStockOut.className = 'flex-1 font-medium py-4 px-6 rounded-lg transition-all flex items-center justify-center text-lg shadow-md';

            // Both buttons remain functionally enabled
            btnStockIn.disabled = false;
            btnStockOut.disabled = false;

            switch (state) {
                case 'initial':
                    // Both buttons disabled state (visually)
                    btnStockIn.classList.add('bg-gray-300', 'text-gray-500', 'cursor-pointer');
                    btnStockOut.classList.add('bg-gray-300', 'text-gray-500', 'cursor-pointer');
                    break;
                case 'stock-in-active':
                    // Stock In active, Stock Out disabled
                    btnStockIn.classList.add('bg-green-500', 'hover:bg-green-600', 'text-white');
                    btnStockOut.classList.add('bg-gray-300', 'text-gray-500', 'cursor-pointer');
                    break;
                case 'stock-out-active':
                    // Stock Out active, Stock In disabled
                    btnStockIn.classList.add('bg-gray-300', 'text-gray-500', 'cursor-pointer');
                    btnStockOut.classList.add('bg-red-500', 'hover:bg-red-600', 'text-white');
                    break;
            }
        }

        // Initialize buttons in disabled state
        function initializeButtons() {
            setButtonStates('initial');
            // Hide both forms initially
            formStockIn.classList.add('hidden');
            formStockOut.classList.add('hidden');
        }

        // Stock In button click handler
        btnStockIn.addEventListener('click', function() {
            formStockIn.classList.remove('hidden');
            formStockOut.classList.add('hidden');
            setButtonStates('stock-in-active');
        });

        // Stock Out button click handler
        btnStockOut.addEventListener('click', function() {
            formStockOut.classList.remove('hidden');
            formStockIn.classList.add('hidden');
            setButtonStates('stock-out-active');
        });

        // Initialize buttons on page load
        initializeButtons();

        // Check if there's old input to determine which form to show
        const oldProductIn = document.querySelector('#product_in').value;
        const oldProductOut = document.querySelector('#product_out').value;

        // Show appropriate form based on old input
        if (oldProductIn || document.querySelector('input[name="type"][value="in"]')) {
            btnStockIn.click();
        } else if (oldProductOut || document.querySelector('input[name="type"][value="out"]')) {
            btnStockOut.click();
        }

        // Rest of your existing JavaScript code for quantity controls, stock checking, etc.
        // Quantity controls for stock in
        const decreaseQtyIn = document.getElementById('decrease-qty-in');
        const increaseQtyIn = document.getElementById('increase-qty-in');
        const quantityIn = document.getElementById('quantity_in');

        if (decreaseQtyIn && increaseQtyIn && quantityIn) {
            decreaseQtyIn.addEventListener('click', function() {
                let value = parseInt(quantityIn.value) || 1;
                if (value > 1) {
                    quantityIn.value = value - 1;
                }
            });

            increaseQtyIn.addEventListener('click', function() {
                let value = parseInt(quantityIn.value) || 1;
                quantityIn.value = value + 1;
            });
        }

        // Quantity controls for stock out
        const decreaseQtyOut = document.getElementById('decrease-qty-out');
        const increaseQtyOut = document.getElementById('increase-qty-out');
        const quantityOut = document.getElementById('quantity_out');
        const productOut = document.getElementById('product_out');
        const stockInfoOut = document.getElementById('stock-info-out');
        const availableStockOut = document.getElementById('available-stock-out');
        const quantityWarningOut = document.getElementById('quantity-warning-out');
        const submitBtnOut = document.getElementById('submit-btn-out');

        if (decreaseQtyOut && increaseQtyOut && quantityOut) {
            decreaseQtyOut.addEventListener('click', function() {
                let value = parseInt(quantityOut.value) || 1;
                if (value > 1) {
                    quantityOut.value = value - 1;
                    checkStockAvailability();
                }
            });

            increaseQtyOut.addEventListener('click', function() {
                let value = parseInt(quantityOut.value) || 1;
                quantityOut.value = value + 1;
                checkStockAvailability();
            });
        }

        // Product selection for stock out
        if (productOut) {
            productOut.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value) {
                    const stock = selectedOption.getAttribute('data-stock');
                    if (availableStockOut) {
                        availableStockOut.textContent = stock;
                    }
                    if (stockInfoOut) {
                        stockInfoOut.classList.remove('hidden');
                    }
                    checkStockAvailability();
                } else {
                    if (stockInfoOut) {
                        stockInfoOut.classList.add('hidden');
                    }
                    if (quantityWarningOut) {
                        quantityWarningOut.classList.add('hidden');
                    }
                    if (submitBtnOut) {
                        submitBtnOut.disabled = false;
                        submitBtnOut.classList.remove('opacity-50', 'cursor-not-allowed');
                    }
                }
            });
        }

        // Check stock availability for outgoing stock
        if (quantityOut) {
            quantityOut.addEventListener('input', checkStockAvailability);
        }

        function checkStockAvailability() {
            if (!productOut || !quantityOut) return;

            const selectedOption = productOut.options[productOut.selectedIndex];
            if (selectedOption.value) {
                const availableStock = parseInt(selectedOption.getAttribute('data-stock')) || 0;
                const requestedQuantity = parseInt(quantityOut.value) || 0;

                if (requestedQuantity > availableStock) {
                    if (quantityWarningOut) {
                        quantityWarningOut.classList.remove('hidden');
                        quantityWarningOut.classList.add('flex');
                    }
                    if (submitBtnOut) {
                        submitBtnOut.disabled = true;
                        submitBtnOut.classList.add('opacity-50', 'cursor-not-allowed');
                    }
                } else {
                    if (quantityWarningOut) {
                        quantityWarningOut.classList.add('hidden');
                        quantityWarningOut.classList.remove('flex');
                    }
                    if (submitBtnOut) {
                        submitBtnOut.disabled = false;
                        submitBtnOut.classList.remove('opacity-50', 'cursor-not-allowed');
                    }
                }
            }
        }

        // Form submission with confirmation
        const stockInForm = document.getElementById('stockInForm');
        const stockOutForm = document.getElementById('stockOutForm');

        if (stockInForm) {
            stockInForm.addEventListener('submit', function(e) {
                e.preventDefault();
                currentForm = this;
                currentFormType = 'in';
                showConfirmationModal();
            });
        }

        if (stockOutForm) {
            stockOutForm.addEventListener('submit', function(e) {
                e.preventDefault();
                currentForm = this;
                currentFormType = 'out';
                showConfirmationModal();
            });
        }

        function showConfirmationModal() {
            if (!modal || !confirmationMessage) return;

            const productSelect = currentFormType === 'in' ?
                document.getElementById('product_in') :
                document.getElementById('product_out');
            const quantityInput = currentFormType === 'in' ?
                document.getElementById('quantity_in') :
                document.getElementById('quantity_out');

            if (!productSelect || !quantityInput) return;

            const selectedProduct = productSelect.options[productSelect.selectedIndex];
            const productName = selectedProduct.text.split(' (')[0];
            const quantity = quantityInput.value;
            const type = currentFormType === 'in' ? 'masuk' : 'keluar';

            confirmationMessage.innerHTML = `
            <strong>Detail Pencatatan:</strong><br>
            Produk: ${productName}<br>
            Jumlah: ${quantity} unit<br>
            Jenis: Stok ${type}<br><br>
            Apakah Anda yakin ingin melanjutkan?
        `;

            modal.classList.remove('hidden');
        }

        if (confirmBtn) {
            confirmBtn.addEventListener('click', function() {
                // Set confirmed field to true
                const confirmedField = currentFormType === 'in' ?
                    document.getElementById('confirmedIn') :
                    document.getElementById('confirmedOut');

                if (confirmedField) {
                    confirmedField.value = '1';
                }

                if (modal) {
                    modal.classList.add('hidden');
                }

                if (currentForm) {
                    currentForm.submit();
                }
            });
        }

        if (cancelBtn) {
            cancelBtn.addEventListener('click', function() {
                if (modal) {
                    modal.classList.add('hidden');
                }
                currentForm = null;
                currentFormType = null;
            });
        }

        // Close modal when clicking outside
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    currentForm = null;
                    currentFormType = null;
                }
            });
        }

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('[id^="alert-"]');
            alerts.forEach(function(alert) {
                if (alert) {
                    alert.style.transition = 'opacity 0.5s ease-out';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 500);
                }
            });
        }, 5000);
    });

    // Function to close alerts manually
    function closeAlert(alertId) {
        const alert = document.getElementById(alertId);
        if (alert) {
            alert.style.transition = 'opacity 0.3s ease-out';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 300);
        }
    }

    // Toast notification function for dynamic alerts
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 z-50 max-w-sm w-full transition-all duration-300 transform translate-x-full`;

        const bgColor = type === 'success' ? 'bg-green-50 border-green-200' :
            type === 'error' ? 'bg-red-50 border-red-200' :
            'bg-yellow-50 border-yellow-200';

        const textColor = type === 'success' ? 'text-green-700' :
            type === 'error' ? 'text-red-700' :
            'text-yellow-700';

        const iconColor = type === 'success' ? 'text-green-500' :
            type === 'error' ? 'text-red-500' :
            'text-yellow-500';

        const icon = type === 'success' ?
            '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>' :
            type === 'error' ?
            '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>' :
            '<path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>';

        toast.innerHTML = `
        <div class="border rounded-lg p-4 shadow-lg ${bgColor}">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3 ${iconColor}" fill="currentColor" viewBox="0 0 20 20">
                        ${icon}
                    </svg>
                    <span class="font-medium ${textColor}">${message}</span>
                </div>
                <button type="button" class="${iconColor.replace('text-', 'text-').replace('500', '400')} hover:${iconColor}" onclick="this.parentElement.parentElement.parentElement.remove()">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    `;

        document.body.appendChild(toast);

        // Animate in
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);

        // Auto remove after 5 seconds
        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 300);
        }, 5000);
    }
</script>

@endsection