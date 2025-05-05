<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Itseey Store - Sistem Manajemen Skincare Premium">
    <title>Itseey Store - Sistem Manajemen Skincare Premium</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #FFF5F7 0%, #FECDD3 100%);
        }

        .feature-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(252, 231, 243, 0.3);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            background: linear-gradient(135deg, #EC4899 0%, #DB2777 100%);
        }

        .btn-primary {
            background: linear-gradient(135deg, #EC4899 0%, #DB2777 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(219, 39, 119, 0.4);
        }
    </style>
</head>
<body class="antialiased gradient-bg min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-white sticky top-0 z-50 backdrop-filter backdrop-blur-lg bg-opacity-70 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-2xl font-bold bg-gradient-to-r from-pink-500 to-pink-600 text-transparent bg-clip-text">Itseey</span>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="#features" class="text-gray-600 hover:text-pink-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">Fitur</a>
                    <a href="{{ route('login') }}" class="bg-white text-pink-600 border border-pink-200 hover:bg-pink-50 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 ml-2">Masuk</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden pt-24 pb-32 flex-grow">
        <div class="absolute inset-0 z-0 opacity-50">
            <div class="absolute right-0 top-0 w-1/2 h-1/2 bg-pink-100 rounded-full filter blur-3xl transform translate-x-1/3 -translate-y-1/3"></div>
            <div class="absolute left-0 bottom-0 w-1/2 h-1/2 bg-pink-200 rounded-full filter blur-3xl transform -translate-x-1/3 translate-y-1/3"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                    <h1>
                        <span class="mt-1 block text-4xl tracking-tight font-extrabold sm:text-5xl xl:text-6xl">
                            <span class="block bg-gradient-to-r from-pink-500 to-pink-600 text-transparent bg-clip-text">Itseey Store</span>
                            <span class="block text-pink-500 text-3xl mt-3 font-light">Sistem Manajemen Skincare</span>
                        </span>
                    </h1>
                    <p class="mt-6 text-base text-gray-600 sm:text-lg md:text-xl lg:text-lg xl:text-xl leading-relaxed">
                        Sistem manajemen profesional. Pantau Stok, Notifikasi, dan Laporan yang intuitif.
                    </p>
                    <div class="mt-10 sm:max-w-lg sm:mx-auto sm:text-center lg:text-left lg:mx-0">
                        <a href="{{ route('login') }}" class="btn-primary inline-flex items-center px-8 py-4 border border-transparent text-base font-medium rounded-full shadow-lg text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                            Masuk ke Dashboard <i class="fas fa-arrow-right ml-3"></i>
                        </a>
                    </div>
                </div>
                <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                    <div class="w-full rounded-2xl shadow-xl ring-1 ring-black ring-opacity-5 overflow-hidden bg-white p-5">
                        <div class="relative h-64 bg-gradient-to-br from-pink-100 to-pink-200 rounded-xl flex items-center justify-center">
                            <i class="fas fa-spa text-pink-600 text-7xl"></i>
                        </div>
                        <div class="grid grid-cols-3 gap-3 mt-3">
                            <div class="h-20 rounded-lg bg-pink-50 flex items-center justify-center">
                                <i class="fas fa-chart-line text-pink-500 text-xl"></i>
                            </div>
                            <div class="h-20 rounded-lg bg-pink-50 flex items-center justify-center">
                                <i class="fas fa-users text-pink-500 text-xl"></i>
                            </div>
                            <div class="h-20 rounded-lg bg-pink-50 flex items-center justify-center">
                                <i class="fas fa-boxes-stacked text-pink-500 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="bg-white py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold bg-gradient-to-r from-pink-500 to-pink-600 text-transparent bg-clip-text sm:text-4xl">
                    Fitur Manajemen
                </h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                    Solusi lengkap untuk bisnis skincare Anda
                </p>
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="pt-6">
                        <div class="feature-card flow-root bg-white rounded-xl px-6 pb-8">
                            <div class="-mt-6">
                                <div>
                                    <span class="feature-icon inline-flex items-center justify-center p-3 rounded-xl shadow-lg">
                                        <i class="fas fa-boxes-stacked text-white text-lg"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-semibold text-gray-800 tracking-tight">Manajemen Stok</h3>
                                <p class="mt-5 text-base text-gray-600">
                                    Kelola inventaris produk skincare dengan mudah dan pantau level stok secara real-time.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="feature-card flow-root bg-white rounded-xl px-6 pb-8">
                            <div class="-mt-6">
                                <div>
                                    <span class="feature-icon inline-flex items-center justify-center p-3 rounded-xl shadow-lg">
                                        <i class="fas fa-exchange-alt text-white text-lg"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-semibold text-gray-800 tracking-tight">Laporan Barang</h3>
                                <p class="mt-5 text-base text-gray-600">
                                    Pantau dan lacak semua barang masuk dan keluar dengan detail transaksi lengkap.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="feature-card flow-root bg-white rounded-xl px-6 pb-8">
                            <div class="-mt-6">
                                <div>
                                    <span class="feature-icon inline-flex items-center justify-center p-3 rounded-xl shadow-lg">
                                        <i class="fas fa-file-pdf text-white text-lg"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-semibold text-gray-800 tracking-tight">Laporan Ekspor PDF</h3>
                                <p class="mt-5 text-base text-gray-600">
                                    Buat laporan profesional dan ekspor dalam format PDF untuk keperluan dokumentasi.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="feature-card flow-root bg-white rounded-xl px-6 pb-8">
                            <div class="-mt-6">
                                <div>
                                    <span class="feature-icon inline-flex items-center justify-center p-3 rounded-xl shadow-lg">
                                        <i class="fas fa-bell text-white text-lg"></i>
                                    </span>
                                </div>
                                <h3 class="mt-8 text-lg font-semibold text-gray-800 tracking-tight">Notifikasi Kadaluarsa</h3>
                                <p class="mt-5 text-base text-gray-600">
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
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <span class="text-2xl font-bold bg-gradient-to-r from-pink-400 to-pink-500 text-transparent bg-clip-text">Itseey</span>
                    <p class="mt-4 text-gray-400 max-w-md">
                        Sistem manajemen profesional. Pantau Stok, Notifikasi, dan Laporan yang intuitif.
                    </p>
                    <div class="flex space-x-6 mt-6">
                        <a href="#" class="text-gray-400 hover:text-pink-400 transition-colors duration-200">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-pink-400 transition-colors duration-200">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-pink-400 transition-colors duration-200">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                    </div>
                </div>

            </div>
            <div class="mt-12 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">&copy; 2025 Itseey Store.</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for anchor links
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
