{{-- resources/views/home/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Matrament Thrifting - Thrift Store Terbaik')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-indigo-900 to-blue-500 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Matrament Thrifting</h1>
            <p class="text-xl md:text-2xl mb-8">Fashion Berkelanjutan dengan Harga Terjangkau</p>
            <a href="{{ route('products.index') }}" class="bg-white text-indigo-800 px-8 py-3 rounded-lg font-semibold hover:bg-gray-300 transition inline-block">
                Belanja Sekarang
            </a>
        </div>
    </div>
</div>

<!-- Categories -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h2 class="text-3xl font-bold text-center mb-12">Kategori Produk</h2>
    <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
        @foreach($categories as $category)
        <a href="{{ route('products.index', ['category' => $category->id]) }}" class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition text-center group">
            <div class="text-4xl mb-4">
                @if($category->slug == 'kaos') 👕
                @elseif($category->slug == 'jaket') 🧥
                @elseif($category->slug == 'celana') 👖
                @elseif($category->slug == 'hoodie') 🧥
                @else 🎒
                @endif
            </div>
            <h3 class="font-semibold text-gray-800 group-hover:text-indigo-800">{{ $category->name }}</h3>
            <p class="text-sm text-gray-500">{{ $category->products_count }} produk</p>
        </a>
        @endforeach
    </div>
</div>

<!-- Featured Products -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Produk Unggulan</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featuredProducts as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                <a href="{{ route('products.show', $product->slug) }}">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                </a>
                <div class="p-6">
                    <span class="text-xs text-indigo-600 font-semibold">{{ $product->category->name }}</span>
                    <h3 class="text-lg font-semibold mt-2 mb-2">
                        <a href="{{ route('products.show', $product->slug) }}" class="hover:text-indigo-600">{{ $product->name }}</a>
                    </h3>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <span class="text-sm text-gray-500">{{ $product->condition }}</span>
                    </div>
                    <a href="{{ route('products.show', $product->slug) }}" class="mt-4 block bg-indigo-600 text-white text-center py-2 rounded-lg hover:bg-indigo-700 transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- New Products -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h2 class="text-3xl font-bold text-center mb-12">Produk Terbaru</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @foreach($newProducts as $product)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
            <a href="{{ route('products.show', $product->slug) }}">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
            </a>
            <div class="p-4">
                <h3 class="font-semibold">
                    <a href="{{ route('products.show', $product->slug) }}" class="hover:text-indigo-800">{{ $product->name }}</a>
                </h3>
                <p class="text-indigo-600 font-bold mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- CTA Section -->
<div class="bg-indigo-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Bergabunglah dengan Gerakan Sustainable Fashion</h2>
        <p class="text-xl mb-8">Belanja pakaian berkualitas sambil menjaga lingkungan</p>
        <a href="{{ route('about') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition inline-block">
            Pelajari Lebih Lanjut
        </a>
    </div>
</div>
@endsection
