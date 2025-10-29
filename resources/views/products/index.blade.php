{{-- resources/views/products/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Semua Produk - MatraMent Thrifting')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold mb-8">Semua Produk</h1>

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar Filters -->
        <aside class="w-full md:w-64 space-y-6">
            <form method="GET" action="{{ route('products.index') }}">
                <!-- Search -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="font-semibold mb-3">Cari Produk</h3>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama produk..." class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Category Filter -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="font-semibold mb-3">Kategori</h3>
                    <select name="category" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Condition Filter -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="font-semibold mb-3">Kondisi</h3>
                    <select name="condition" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        <option value="">Semua Kondisi</option>
                        @foreach($conditions as $condition)
                            <option value="{{ $condition }}" {{ request('condition') == $condition ? 'selected' : '' }}>
                                {{ $condition }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Price Range -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="font-semibold mb-3">Harga</h3>
                    <div class="space-y-2">
                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="w-full px-3 py-2 border rounded-lg">
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="w-full px-3 py-2 border rounded-lg">
                    </div>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                    Terapkan Filter
                </button>

                @if(request()->anyFilled(['search', 'category', 'condition', 'min_price', 'max_price']))
                    <a href="{{ route('products.index') }}" class="block w-full text-center bg-gray-200 text-gray-700 py-2 rounded-lg hover:bg-gray-300 transition">
                        Reset Filter
                    </a>
                @endif
            </form>
        </aside>

        <!-- Products Grid -->
        <div class="flex-1">
            <!-- Sort -->
            <div class="bg-white p-4 rounded-lg shadow mb-6 flex justify-between items-center">
                <span class="text-gray-600">{{ $products->total() }} produk ditemukan</span>
                <form method="GET" action="{{ route('products.index') }}" class="flex items-center">
                    @foreach(request()->except('sort') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <label class="mr-2 text-gray-600">Urutkan:</label>
                    <select name="sort" onchange="this.form.submit()" class="px-3 py-2 border rounded-lg">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                    </select>
                </form>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                        <a href="{{ route('products.show', $product->slug) }}">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                        </a>
                        <div class="p-4">
                            <span class="text-xs text-indigo-600 font-semibold">{{ $product->category->name }}</span>
                            <h3 class="font-semibold mt-2 mb-2">
                                <a href="{{ route('products.show', $product->slug) }}" class="hover:text-indigo-600">{{ $product->name }}</a>
                            </h3>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xl font-bold text-indigo-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="text-sm text-gray-500">{{ $product->condition }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                                <span>Stok: {{ $product->stock }}</span>
                                <span>Terjual: {{ $product->sold }}</span>
                            </div>
                            <a href="{{ route('products.show', $product->slug) }}" class="block bg-indigo-600 text-white text-center py-2 rounded-lg hover:bg-indigo-700 transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="bg-white p-8 rounded-lg shadow text-center">
                    <p class="text-gray-500">Tidak ada produk ditemukan.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection