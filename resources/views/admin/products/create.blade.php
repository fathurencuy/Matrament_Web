{{-- resources/views/admin/products/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('header', 'Tambah Produk Baru')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-lg shadow p-8">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Nama Produk *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Kategori *</label>
                    <select name="category_id" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Harga *</label>
                    <input type="number" name="price" value="{{ old('price') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Stok *</label>
                    <input type="number" name="stock" value="{{ old('stock') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                    @error('stock')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Ukuran</label>
                    <input type="text" name="size" value="{{ old('size') }}" placeholder="M, L, XL" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                    @error('size')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Kondisi *</label>
                    <select name="condition" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        <option value="Baru" {{ old('condition') == 'Baru' ? 'selected' : '' }}>Baru</option>
                        <option value="Seperti Baru" {{ old('condition') == 'Seperti Baru' ? 'selected' : '' }}>Seperti Baru</option>
                        <option value="Baik" {{ old('condition') == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Bekas" {{ old('condition') == 'Bekas' ? 'selected' : '' }}>Bekas</option>
                    </select>
                    @error('condition')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-gray-700 font-semibold mb-2">Deskripsi *</label>
                <textarea name="description" rows="5" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <label class="block text-gray-700 font-semibold mb-2">Gambar Produk</label>
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, GIF. Max: 2MB</p>
            </div>

            <div class="mt-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="mr-2">
                    <span class="text-gray-700">Jadikan Produk Unggulan</span>
                </label>
            </div>

            <div class="mt-8 flex space-x-4">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
                    Simpan Produk
                </button>
                <a href="{{ route('admin.products.index') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition font-semibold">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection