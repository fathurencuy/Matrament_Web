{{-- resources/views/checkout/index.blade.php--}}
@extends('layouts.app')

@section('title', 'Checkout - MatraMent Thrifting')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold mb-8">Checkout</h1>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Shipping Form -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold mb-4">Informasi Pengiriman</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Nama Lengkap *</label>
                            <input type="text" name="customer_name" value="{{ auth()->user()->name }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                            @error('customer_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Nomor Telepon *</label>
                            <input type="text" name="customer_phone" value="{{ auth()->user()->phone }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                            @error('customer_phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Alamat Pengiriman Lengkap *</label>
                            <textarea name="shipping_address" rows="4" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">{{ auth()->user()->address }}</textarea>
                            @error('shipping_address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Catatan (Opsional)</label>
                            <textarea name="notes" rows="3" placeholder="Catatan tambahan untuk pesanan Anda..." class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500"></textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold mb-4">Metode Pembayaran</h2>
                    
                    <div class="space-y-3">
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="payment_method" value="COD" checked class="mr-3">
                            <div>
                                <p class="font-semibold">COD (Cash on Delivery)</p>
                                <p class="text-sm text-gray-600">Bayar saat barang diterima</p>
                            </div>
                        </label>

                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="payment_method" value="Transfer Bank" class="mr-3">
                            <div>
                                <p class="font-semibold">Transfer Bank</p>
                                <p class="text-sm text-gray-600">Transfer ke rekening toko</p>
                            </div>
                        </label>

                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="payment_method" value="E-Wallet" class="mr-3">
                            <div>
                                <p class="font-semibold">E-Wallet</p>
                                <p class="text-sm text-gray-600">OVO, GoPay, Dana</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow p-6 sticky top-24">
                    <h2 class="text-xl font-bold mb-4">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-3 mb-6 max-h-64 overflow-y-auto">
                        @foreach($carts as $cart)
                        <div class="flex items-center space-x-3 pb-3 border-b">
                            <img src="{{ $cart->product->image_url }}" alt="{{ $cart->product->name }}" class="w-16 h-16 object-cover rounded">
                            <div class="flex-1">
                                <p class="font-semibold text-sm">{{ $cart->product->name }}</p>
                                <p class="text-sm text-gray-600">{{ $cart->quantity }} x Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Biaya Pengiriman</span>
                            <span>Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between">
                            <span class="font-bold text-lg">Total</span>
                            <span class="font-bold text-lg text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
                        Konfirmasi Pembelian
                    </button>

                    <a href="{{ route('cart.index') }}" class="block w-full text-center text-gray-600 hover:text-gray-800 mt-3">
                        Kembali ke Keranjang
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection