{{-- resources/views/admin/categories/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('header', 'Edit Kategori')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg shadow p-8">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Nama Kategori *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
                    Update Kategori
                </button>
                <a href="{{ route('admin.categories.index') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition font-semibold">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection