{{-- resources/views/wishlist/index.blade.php - LENGKAP --}}
@extends('layouts.app')

@section('title', 'Wishlist - MatraMent Thrifting')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold mb-8">Wishlist Saya</h1>

    @if($wishlists->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @foreach($wishlists as $wishlist)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
            <a href="{{ route('products.show', $wishlist->product->slug) }}">
                <img src="{{ $wishlist->product->image_url }}" alt="{{ $wishlist->product->name }}" class="w-full h-64 object-cover">
            </a>
            <div class="p-4">
                <span class="text-xs text-indigo-600 font-semibold">{{ $wishlist->product->category->name }}</span>
                <h3 class="font-semibold mt-2 mb-2">
                    <a href="{{ route('products.show', $wishlist->product->slug) }}" class="hover:text-indigo-600">{{ $wishlist->product->name }}</a>
                </h3>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xl font-bold text-indigo-600">Rp {{ number_format($wishlist->product->price, 0, ',', '.') }}</span>
                    <span class="text-sm text-gray-500">{{ $wishlist->product->condition }}</span>
                </div>

                <div class="flex space-x-2">
                    <a href="{{ route('products.show', $wishlist->product->slug) }}" class="flex-1 bg-indigo-600 text-white text-center py-2 rounded-lg hover:bg-indigo-700 transition text-sm">
                        Lihat Detail
                    </a>
                    <form action="{{ route('wishlist.remove', $wishlist->product) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-2 border border-red-600 text-red-600 rounded-lg hover:bg-red-50 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-white rounded-lg shadow p-12 text-center">
        <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
        </svg>
        <h2 class="text-2xl font-bold mb-2">Wishlist Kosong</h2>
        <p class="text-gray-600 mb-6">Tambahkan produk favorit Anda ke wishlist!</p>
        <a href="{{ route('products.index') }}" class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
            Jelajahi Produk
        </a>
    </div>
    @endif
</div>
@endsection