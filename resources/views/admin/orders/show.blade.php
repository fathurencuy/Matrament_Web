{{-- resources/views/admin/orders/show.blade.php --}}
@extends('layouts.admin')

@section('title', 'Detail Pesanan')
@section('header', 'Detail Pesanan')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.orders.index') }}" class="text-indigo-600 hover:text-indigo-700 flex items-center">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Pesanan
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <!-- Order Info -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-xl font-bold">{{ $order->order_number }}</h2>
                    <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $order->status_badge }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <!-- Customer Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6 border-b">
                <div>
                    <h3 class="font-semibold mb-2">Informasi Pelanggan</h3>
                    <p class="text-gray-700">{{ $order->customer_name }}</p>
                    <p class="text-gray-700">{{ $order->customer_email }}</p>
                    <p class="text-gray-700">{{ $order->customer_phone }}</p>
                </div>
                <div>
                    <h3 class="font-semibold mb-2">Alamat Pengiriman</h3>
                    <p class="text-gray-700">{{ $order->shipping_address }}</p>
                </div>
            </div>

            <!-- Order Items -->
            <div class="mt-6">
                <h3 class="font-semibold mb-4">Produk yang Dibeli</h3>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                    <div class="flex items-center space-x-4 pb-4 border-b">
                        @if($item->product)
                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product_name }}" class="w-20 h-20 object-cover rounded">
                        @else
                        <div class="w-20 h-20 bg-gray-200 rounded"></div>
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

            <!-- Order Total -->
            <div class="mt-6 space-y-2">
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

            @if($order->notes)
            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600 mb-1">Catatan:</p>
                <p class="text-gray-700">{{ $order->notes }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Action Panel -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow p-6 sticky top-24">
            <h3 class="font-bold mb-4">Update Status Pesanan</h3>
            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition font-semibold">
                    Update Status
                </button>
            </form>

            <div class="mt-6 pt-6 border-t">
                <h4 class="font-semibold mb-3">Informasi Pembayaran</h4>
                <p class="text-sm text-gray-600">Metode Pembayaran:</p>
                <p class="font-semibold mb-2">{{ $order->payment_method }}</p>
            </div>
        </div>
    </div>
</div>
@endsection