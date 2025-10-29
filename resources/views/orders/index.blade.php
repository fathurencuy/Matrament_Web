{{-- resources/views/orders/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Pesanan Saya - MatraMent Thrifting')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold mb-8">Pesanan Saya</h1>

    @if($orders->count() > 0)
    <div class="space-y-4">
        @foreach($orders as $order)
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="font-bold text-lg">{{ $order->order_number }}</h3>
                    <p class="text-sm text-gray-600">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $order->status_badge }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div class="border-t pt-4 mb-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Penerima</p>
                        <p class="font-semibold">{{ $order->customer_name }}</p>
                        <p class="text-sm">{{ $order->customer_phone }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Total Pembayaran</p>
                        <p class="font-bold text-xl text-indigo-600">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-600">{{ $order->payment_method }}</p>
                    </div>
                </div>
            </div>

            <div class="border-t pt-4">
                <p class="text-sm text-gray-600 mb-2">Produk yang dibeli:</p>
                <div class="space-y-2">
                    @foreach($order->items as $item)
                    <div class="flex items-center justify-between">
                        <span class="text-sm">{{ $item->product_name }} ({{ $item->quantity }}x)</span>
                        <span class="text-sm font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-4 flex justify-end">
                <a href="{{ route('orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">
                    Lihat Detail →
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $orders->links() }}
    </div>
    @else
    <div class="bg-white rounded-lg shadow p-12 text-center">
        <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        <h2 class="text-2xl font-bold mb-2">Belum Ada Pesanan</h2>
        <p class="text-gray-600 mb-6">Mulai belanja dan buat pesanan pertama Anda!</p>
        <a href="{{ route('products.index') }}" class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
            Mulai Belanja
        </a>
    </div>
    @endif
</div>
@endsection
