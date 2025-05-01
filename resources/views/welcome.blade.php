<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Itseey Store - Sistem Manajemen Skincare Premium">
    <title>Itseey Store - Sistem Manajemen Skincare Premium</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="antialiased bg-gradient-to-b from-pink-50 to-pink-100 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-2xl font-bold text-pink-600">Itseey</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden pt-16 pb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                    <h1>
                        <span class="mt-1 block text-4xl tracking-tight font-extrabold sm:text-5xl xl:text-6xl">
                            <span class="block text-pink-600">Itseey Store</span>
                            <span class="block text-pink-500 text-3xl mt-3">Sistem Manajemen Skincare</span>
                        </span>
                    </h1>
                    <p class="mt-6 text-base text-pink-700 sm:text-lg md:text-xl lg:text-lg xl:text-xl">
                        Sistem manajemen profesional untuk bisnis skincare Anda. Pantau stok, kelola pelanggan, dan tingkatkan penjualan dengan dashboard yang intuitif.
                    </p>
                    <div class="mt-8 sm:max-w-lg sm:mx-auto sm:text-center lg:text-left lg:mx-0">
                        <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-pink-500 hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition-all duration-200">
                            Masuk ke Dashboard <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-pink-600 sm:text-4xl">
                    Fitur Manajemen
                </h2>
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="pt-6">
                        <div class="flow-root bg-pink-50 rounded-lg px-6 pb-8">
                            <div class="-mt-6">
                                <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-pink-500 rounded-md shadow-lg">
                                        <i class="fas fa-boxes-stacked text-white text-lg"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-pink-700 tracking-tight">Manajemen Stok</h3>
                                <p class="mt-5 text-base text-pink-600">
                                    Kelola inventaris produk skincare dengan mudah dan pantau level stok secara real-time.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="flow-root bg-pink-50 rounded-lg px-6 pb-8">
                            <div class="-mt-6">
                                <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-secondary rounded-md shadow-lg">
                                        <i class="fas fa-exchange-alt text-white text-lg"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-pink-700 tracking-tight">Laporan Barang</h3>
                                <p class="mt-5 text-base text-pink-600">
                                    Pantau dan lacak semua barang masuk dan keluar dengan detail transaksi lengkap.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="flow-root bg-pink-50 rounded-lg px-6 pb-8">
                            <div class="-mt-6">
                                <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-accent rounded-md shadow-lg">
                                        <i class="fas fa-file-pdf text-white text-lg"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-pink-700 tracking-tight">Laporan Ekspor PDF</h3>
                                <p class="mt-5 text-base text-pink-600">
                                    Buat laporan profesional dan ekspor dalam format PDF untuk keperluan dokumentasi.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="flow-root bg-pink-50 rounded-lg px-6 pb-8">
                            <div class="-mt-6">
                                <div>
                                    <span class="inline-flex items-center justify-center p-3 bg-pink-600 rounded-md shadow-lg">
                                        <i class="fas fa-bell text-white text-lg"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-medium text-pink-700 tracking-tight">Notifikasi Kadaluarsa</h3>
                                <p class="mt-5 text-base text-pink-600">
                                    Dapatkan peringatan otomatis untuk produk yang mendekati tanggal kadaluarsa.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-pink-500">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex justify-center md:justify-start">
                    <span class="text-xl font-bold text-white">Itseey</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Tambahkan ini di app.js atau inline untuk scroll halus
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
