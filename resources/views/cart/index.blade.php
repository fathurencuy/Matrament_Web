{{-- resources/views/cart/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Keranjang Belanja - MatraMent Thrifting')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold mb-8">Keranjang Belanja</h1>

    @if($carts->count() > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2 space-y-4">
            @foreach($carts as $cart)
            <div class="bg-white rounded-lg shadow p-6 flex items-center space-x-6">
                <img src="{{ $cart->product->image_url }}" alt="{{ $cart->product->name }}" class="w-24 h-24 object-cover rounded">
                
                <div class="flex-1">
                    <h3 class="font-semibold text-lg">
                        <a href="{{ route('products.show', $cart->product->slug) }}" class="hover:text-indigo-600">
                            {{ $cart->product->name }}
                        </a>
                    </h3>
                    <p class="text-gray-600 text-sm">{{ $cart->product->category->name }}</p>
                    <p class="text-indigo-600 font-bold mt-1">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
                </div>

                <form action="{{ route('cart.update', $cart) }}" method="POST" class="flex items-center space-x-2">
                    @csrf
                    @method('PATCH')
                    <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" max="{{ $cart->product->stock }}" class="w-16 px-2 py-1 border rounded text-center">
                    <button type="submit" class="text-indigo-600 hover:text-indigo-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </button>
                </form>

                <div class="text-right">
                    <p class="font-bold text-lg">Rp {{ number_format($cart->subtotal, 0, ',', '.') }}</p>
                    <form action="{{ route('cart.remove', $cart) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-700 text-sm">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6 sticky top-24">
                <h2 class="text-xl font-bold mb-4">Ringkasan Pesanan</h2>
                
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal ({{ $carts->count() }} item)</span>
                        <span class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Biaya Pengiriman</span>
                        <span class="font-semibold">Rp 20.000</span>
                    </div>
                    <div class="border-t pt-3 flex justify-between">
                        <span class="font-bold text-lg">Total</span>
                        <span class="font-bold text-lg text-indigo-600">Rp {{ number_format($subtotal + 20000, 0, ',', '.') }}</span>
                    </div>
                </div>

                <a href="{{ route('checkout.index') }}" class="block w-full bg-indigo-600 text-white text-center py-3 rounded-lg hover:bg-indigo-700 transition font-semibold mb-3">
                    Lanjut ke Checkout
                </a>

                <a href="{{ route('products.index') }}" class="block w-full bg-gray-200 text-gray-700 text-center py-3 rounded-lg hover:bg-gray-300 transition">
                    Lanjut Belanja
                </a>

                <form action="{{ route('cart.clear') }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full text-red-600 hover:text-red-700 text-sm" onclick="return confirm('Yakin ingin mengosongkan keranjang?')">
                        Kosongkan Keranjang
                    </button>
                </form>
            </div>
        </div>
    </div>
    @else
    <div class="bg-white rounded-lg shadow p-12 text-center">
        <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        <h2 class="text-2xl font-bold mb-2">Keranjang Anda Kosong</h2>
        <p class="text-gray-600 mb-6">Yuk, mulai belanja dan temukan produk favorit Anda!</p>
        <a href="{{ route('products.index') }}" class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
            Mulai Belanja
        </a>
    </div>
    @endif
</div>
@endsection
