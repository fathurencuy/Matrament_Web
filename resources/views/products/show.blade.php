{{-- resources/views/products/show.blade.php --}}
@extends('layouts.app')

@section('title', $product->name . ' - Matrament Thrifting')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="text-sm mb-8">
        <ol class="flex items-center space-x-2">
            <li><a href="{{ route('home') }}" class="text-indigo-600 hover:underline">Home</a></li>
            <li class="text-gray-500">/</li>
            <li><a href="{{ route('products.index') }}" class="text-indigo-600 hover:underline">Produk</a></li>
            <li class="text-gray-500">/</li>
            <li class="text-gray-700">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <!-- Product Image -->
        <div>
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full max-h-96 object-contain rounded-lg shadow-lg">
        </div>

        <!-- Product Info -->
        <div>
            <span class="text-sm text-indigo-600 font-semibold">{{ $product->category->name }}</span>
            <h1 class="text-3xl font-bold mt-2 mb-4">{{ $product->name }}</h1>
            
            <div class="flex items-center space-x-4 mb-6">
                <span class="text-3xl font-bold text-indigo-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">{{ $product->condition }}</span>
            </div>

            <div class="border-t border-b py-4 mb-6 space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-600">Stok:</span>
                    <span class="font-semibold">{{ $product->stock }} pcs</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Ukuran:</span>
                    <span class="font-semibold">{{ $product->size ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Terjual:</span>
                    <span class="font-semibold">{{ $product->sold }} pcs</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Dilihat:</span>
                    <span class="font-semibold">{{ $product->views }} kali</span>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="font-semibold mb-2">Deskripsi Produk</h3>
                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
            </div>

            @auth
                <form action="{{ route('cart.add', $product) }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <label class="text-gray-700">Jumlah:</label>
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-20 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit" class="flex-1 bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
                            Tambah ke Keranjang
                        </button>
                        <button type="button" onclick="event.preventDefault(); document.getElementById('wishlist-form').submit();" class="px-6 py-3 border border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-50 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                    </div>
                </form>

                <form id="wishlist-form" action="{{ route('wishlist.add', $product) }}" method="POST" class="hidden">
                    @csrf
                </form>
            @else
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                    <p class="text-yellow-800">Silakan <a href="{{ route('login') }}" class="font-semibold underline">login</a> terlebih dahulu untuk menambahkan produk ke keranjang.</p>
                </div>
            @endauth
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <div class="mt-16">
        <h2 class="text-2xl font-bold mb-8">Produk Terkait</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                <a href="{{ route('products.show', $related->slug) }}">
                    <img src="{{ $related->image_url }}" alt="{{ $related->name }}" class="w-full h-48 object-cover">
                </a>
                <div class="p-4">
                    <h3 class="font-semibold">
                        <a href="{{ route('products.show', $related->slug) }}" class="hover:text-indigo-600">{{ $related->name }}</a>
                    </h3>
                    <p class="text-indigo-600 font-bold mt-2">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
