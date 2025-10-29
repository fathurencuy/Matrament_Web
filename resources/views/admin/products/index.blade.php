{{-- resources/views/admin/products/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('header', 'Kelola Produk')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold">Daftar Produk</h2>
    <a href="{{ route('admin.products.create') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
        Tambah Produk Baru
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gambar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Terjual</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($products as $product)
                <tr>
                    <td class="px-6 py-4">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                        <div class="text-sm text-gray-500">{{ $product->condition }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm">{{ $product->category->name }}</td>
                    <td class="px-6 py-4 text-sm font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-sm">{{ $product->stock }}</td>
                    <td class="px-6 py-4 text-sm">{{ $product->sold }}</td>
                    <td class="px-6 py-4">
                        @if($product->is_featured)
                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Featured</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm space-x-2">
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t">
        {{ $products->links() }}
    </div>
</div>
@endsection