@extends('layouts.app')

@section('title', 'Pencatatan Stok')
@section('header', 'Pencatatan Stok')

@section('content')
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

<div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
    <div class="p-4 bg-pink-50 border-b border-pink-100">
        <h3 class="text-md font-semibold text-pink-500 flex items-center">
            Form Pencatatan Stok
        </h3>
    </div>

    <form action="{{ route('stock-movements.store') }}" method="POST" class="p-6" id="stockMovementForm">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">Produk <span class="text-pink-500">*</span></label>
                <div class="relative">
                    <select name="product_id" id="product_id" class="block w-full rounded-lg border-gray-200 bg-gray-50 py-3 px-4 text-sm focus:border-pink-400 focus:ring-pink-300 focus:outline-none focus:ring focus:ring-opacity-40" required>
                        <option value="">Pilih Produk</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" data-stock="{{ $product->stock }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} (Stok: {{ $product->stock }})
                        </option>
                        @endforeach
                    </select>

                </div>
                <div id="stock-info" class="mt-2 text-sm font-medium hidden">
                    <span class="px-2.5 py-0.5 bg-pink-50 text-pink-600 rounded-full inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                        </svg>
                        Stok tersedia: <span id="available-stock" class="font-semibold ml-1">0</span>
                    </span>
                </div>
                @error('product_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Pencatatan <span class="text-pink-500">*</span></label>
                <div class="grid grid-cols-2 gap-3 mt-1">
                    <label class="flex items-center justify-center p-3 border rounded-lg cursor-pointer transition-all hover:bg-pink-50 peer-checked:border-pink-500 peer-checked:bg-pink-50" for="type-in">
                        <input type="radio" name="type" id="type-in" value="in" class="peer sr-only" {{ old('type') == 'in' ? 'checked' : '' }}>
                        <span class="flex items-center">
                            <span class="w-8 h-8 mr-2 rounded-full bg-accent flex items-center justify-center text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                </svg>
                            </span>
                            <span class="font-medium text-sm">Stok Masuk</span>
                        </span>
                    </label>

                    <label class="flex items-center justify-center p-3 border rounded-lg cursor-pointer transition-all hover:bg-pink-50 peer-checked:border-pink-500 peer-checked:bg-pink-50" for="type-out">
                        <input type="radio" name="type" id="type-out" value="out" class="peer sr-only" {{ old('type') == 'out' ? 'checked' : '' }}>
                        <span class="flex items-center">
                            <span class="w-8 h-8 mr-2 rounded-full bg-red-500 flex items-center justify-center text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                </svg>
                            </span>
                            <span class="font-medium text-sm">Stok Keluar</span>
                        </span>
                    </label>
                </div>
                @error('type')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah <span class="text-pink-500">*</span></label>
                <div class="flex rounded-lg bg-gray-50 border-gray-200 overflow-hidden">
                    <button type="button" class="px-4 py-3 bg-gray-100 hover:bg-gray-200 border-r border-gray-200 focus:outline-none" id="decrease-qty">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                    </button>
                    <input
                        type="number"
                        name="quantity"
                        id="quantity"
                        value="{{ old('quantity') }}"
                        min="1"
                        class="flex-1 block w-full py-3 px-4 border-0 bg-gray-50 text-center focus:ring-0 text-sm"
                        required />
                    <button type="button" class="px-4 py-3 bg-gray-100 hover:bg-gray-200 border-l border-gray-200 focus:outline-none" id="increase-qty">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6"></path>
                        </svg>
                    </button>
                </div>
                <div id="quantity-warning" class="mt-2 hidden items-center text-sm text-red-600">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span>Jumlah melebihi stok yang tersedia!</span>
                </div>
                @error('quantity')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan (Opsional)</label>
                <div class="mt-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="notes"
                        id="notes"
                        value="{{ old('notes') }}"
                        placeholder="Masukkan catatan terkait pergerakan stok ini"
                        class="block w-full pl-10 rounded-lg border-gray-200 bg-gray-50 py-3 focus:border-pink-400 focus:ring-pink-300 focus:outline-none focus:ring focus:ring-opacity-40" />
                </div>
                @error('notes')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end mt-8">
            <button type="reset" id="reset-btn" class="bg-white hover:bg-gray-50 text-gray-700 font-medium py-2.5 px-4 rounded-lg transition-all mr-2 border border-gray-300">
                Reset
            </button>
            <button type="submit" id="submit-btn" class="bg-green-300 text-white font-medium py-2.5 px-6 rounded-lg transition-all flex items-center shadow-sm opacity-60 cursor-not-allowed" disabled>
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan
            </button>
        </div>
    </form>
</div>

<div class="mt-6 bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
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
                    <div class="w-8 h-8 rounded-full bg-accent flex items-center justify-center text-white mr-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productSelect = document.getElementById('product_id');
        const quantityInput = document.getElementById('quantity');
        const stockInfo = document.getElementById('stock-info');
        const availableStock = document.getElementById('available-stock');
        const quantityWarning = document.getElementById('quantity-warning');
        const submitBtn = document.getElementById('submit-btn');
        const resetBtn = document.getElementById('reset-btn');
        const increaseBtn = document.getElementById('increase-qty');
        const decreaseBtn = document.getElementById('decrease-qty');
        const typeIn = document.getElementById('type-in');
        const typeOut = document.getElementById('type-out');
        const form = document.getElementById('stockMovementForm');

        let formChanged = false;

        if (!typeIn.checked && !typeOut.checked) {
            typeIn.checked = true;
        }

        if (!quantityInput.value) {
            quantityInput.value = 1;
        }

        function updateRadioStyles() {
            const labels = document.querySelectorAll('label[for^="type-"]');
            labels.forEach(label => {
                const radio = document.getElementById(label.getAttribute('for'));
                if (radio.checked) {
                    label.classList.add('border-pink-500', 'bg-pink-50');
                } else {
                    label.classList.remove('border-pink-500', 'bg-pink-50');
                }
            });
        }

        updateRadioStyles();

        function updateSubmitButton() {
            const productSelected = productSelect.value !== '';
            const quantityValid = parseInt(quantityInput.value) > 0;
            const isOutType = typeOut.checked;
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            let stockValid = true;

            if (selectedOption && selectedOption.value && isOutType) {
                const currentStock = parseInt(selectedOption.dataset.stock);
                const quantity = parseInt(quantityInput.value) || 0;
                stockValid = quantity <= currentStock;
            }

            const formValid = productSelected && quantityValid && stockValid && formChanged;

            if (formValid) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-60', 'cursor-not-allowed', 'bg-green-300');
                submitBtn.classList.add('bg-green-500', 'hover:bg-green-600');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-60', 'cursor-not-allowed', 'bg-green-300');
                submitBtn.classList.remove('bg-green-500', 'hover:bg-green-600');
            }
        }

        productSelect.addEventListener('change', function() {
            formChanged = true;
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                const currentStock = selectedOption.dataset.stock;
                availableStock.textContent = currentStock;
                stockInfo.classList.remove('hidden');
                validateQuantity();
            } else {
                stockInfo.classList.add('hidden');
            }
            updateSubmitButton();
        });

        if (productSelect.value) {
            productSelect.dispatchEvent(new Event('change'));
        }

        function validateQuantity() {
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            if (!selectedOption.value) return;

            const currentStock = parseInt(selectedOption.dataset.stock);
            const quantity = parseInt(quantityInput.value) || 0;
            const isOutType = typeOut.checked;

            if (isOutType && quantity > currentStock) {
                quantityWarning.classList.remove('hidden');
                quantityWarning.classList.add('flex');
                quantityInput.classList.add('border-red-300', 'bg-red-50');
            } else {
                quantityWarning.classList.add('hidden');
                quantityWarning.classList.remove('flex');
                quantityInput.classList.remove('border-red-300', 'bg-red-50');
            }

            updateSubmitButton();
        }

        quantityInput.addEventListener('input', function() {
            formChanged = true;
            validateQuantity();
        });

        typeIn.addEventListener('change', function() {
            formChanged = true;
            updateRadioStyles();
            validateQuantity();
        });

        typeOut.addEventListener('change', function() {
            formChanged = true;
            updateRadioStyles();
            validateQuantity();
        });

        document.getElementById('notes').addEventListener('input', function() {
            formChanged = true;
            updateSubmitButton();
        });

        increaseBtn.addEventListener('click', function() {
            formChanged = true;
            quantityInput.value = (parseInt(quantityInput.value) || 0) + 1;
            quantityInput.dispatchEvent(new Event('input'));
        });

        decreaseBtn.addEventListener('click', function() {
            formChanged = true;
            const currentVal = parseInt(quantityInput.value) || 0;
            if (currentVal > 1) {
                quantityInput.value = currentVal - 1;
                quantityInput.dispatchEvent(new Event('input'));
            }
        });

        resetBtn.addEventListener('click', function() {
            setTimeout(() => {
                formChanged = false;
                updateSubmitButton();

                quantityWarning.classList.add('hidden');
                quantityWarning.classList.remove('flex');
                quantityInput.classList.remove('border-red-300', 'bg-red-50');
                stockInfo.classList.add('hidden');

                typeIn.checked = true;
                updateRadioStyles();

                quantityInput.value = 1;
            }, 10);
        });
    });
</script>
@endsection