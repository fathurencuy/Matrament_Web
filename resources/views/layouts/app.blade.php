{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MatraMent Thrifting - Thrift Store Online')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <span class="text-2xl font-bold text-indigo-600">MatraMent</span>
                        <span class="ml-1 text-gray-600">Thrifting</span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600 transition">Home</a>
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-indigo-600 transition">Produk</a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-indigo-600 transition">Tentang</a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-indigo-600 transition">Kontak</a>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('wishlist.index') }}" class="text-gray-700 hover:text-indigo-600 relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </a>
                        <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-indigo-600 relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            @if(auth()->user()->carts->count() > 0)
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ auth()->user()->carts->count() }}
                                </span>
                            @endif
                        </a>

                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center text-gray-700 hover:text-indigo-600">
                                <span class="mr-2">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard Admin</a>
                                @endif
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Pesanan Saya</a>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600">Login</a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" x-data="{ show: true }" x-show="show">
                <span class="block sm:inline">{{ session('success') }}</span>
                <button @click="show = false" class="absolute top-0 right-0 px-4 py-3">
                    <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" x-data="{ show: true }" x-show="show">
                <span class="block sm:inline">{{ session('error') }}</span>
                <button @click="show = false" class="absolute top-0 right-0 px-4 py-3">
                    <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">MatraMent Thrifting</h3>
                    <p class="text-gray-400">Toko pakaian bekas berkualitas dengan harga terjangkau. Sustainable fashion untuk semua.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kategori</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('products.index', ['category' => 1]) }}" class="hover:text-white">Kaos</a></li>
                        <li><a href="{{ route('products.index', ['category' => 2]) }}" class="hover:text-white">Jaket</a></li>
                        <li><a href="{{ route('products.index', ['category' => 3]) }}" class="hover:text-white">Celana</a></li>
                        <li><a href="{{ route('products.index', ['category' => 4]) }}" class="hover:text-white">Hoodie</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Informasi</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('about') }}" class="hover:text-white">Tentang Kami</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white">Kontak</a></li>
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                        <li><a href="#" class="hover:text-white">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>Email: info@matrament.com</li>
                        <li>Telepon: 0812-3456-7890</li>
                        <li>Alamat: Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 MatraMent Thrifting. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>