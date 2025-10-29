{{-- resources/views/orders/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Pesanan - MatraMent Thrifting')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="{{ route('orders.index') }}" class="text-indigo-600 hover:text-indigo-700 flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar Pesanan
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-bold">Detail Pesanan</h1>
                <p class="text-gray-600">{{ $order->order_number }}</p>
                <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
            <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $order->status_badge }}">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 pb-6 border-b">
            <div>
                <h3 class="font-semibold mb-2">Informasi Penerima</h3>
                <p class="text-gray-700">{{ $order->customer_name }}</p>
                <p class="text-gray-700">{{ $order->customer_email }}</p>
                <p class="text-gray-700">{{ $order->customer_phone }}</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">Alamat Pengiriman</h3>
                <p class="text-gray-700">{{ $order->shipping_address }}</p>
            </div>
        </div>

        <div class="mb-6 pb-6 border-b">
            <h3 class="font-semibold mb-4">Produk yang Dibeli</h3>
            <div class="space-y-4">
                @foreach($order->items as $item)
                <div class="flex items-center space-x-4">
                    @if($item->product)
                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product_name }}" class="w-20 h-20 object-cover rounded">
                    @else
                    <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @endif
                    <div class="flex-1">
                        <h4 class="font-semibold">{{ $item->product_name }}</h4>
                        <p class="text-sm text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="space-y-2">
            <div class="flex justify-between text-gray-600">
                <span>Subtotal</span>
                <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-gray-600">
                <span>Biaya Pengiriman</span>
                <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-xl font-bold pt-2 border-t">
                <span>Total</span>
                <span class="text-indigo-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="mt-6 pt-6 border-t">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-600">Metode Pembayaran</p>
                    <p class="font-semibold">{{ $order->payment_method }}</p>
                </div>
                @if($order->status == 'pending')
                <p class="text-sm text-yellow-600">Menunggu konfirmasi</p>
                @elseif($order->status == 'processing')
                <p class="text-sm text-blue-600">Pesanan sedang diproses</p>
                @elseif($order->status == 'shipped')
                <p class="text-sm text-purple-600">Pesanan dalam pengiriman</p>
                @elseif($order->status == 'completed')
                <p class="text-sm text-green-600">Pesanan selesai</p>
                @endif
            </div>

            @if($order->notes)
            <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600 mb-1">Catatan:</p>
                <p class="text-gray-700">{{ $order->notes }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
