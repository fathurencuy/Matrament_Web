@extends('layouts.app')

@section('title', 'Edit Profil - MatraMent Thrifting')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold mb-8">Pengaturan Profil</h1>

    <div class="space-y-6">
        <!-- Update Profile Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-6">Informasi Profil</h2>
            
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        
                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-2">
                            <p class="text-sm text-gray-800">
                                Email Anda belum diverifikasi.
                                <button form="send-verification" class="underline text-indigo-600 hover:text-indigo-900">
                                    Klik di sini untuk mengirim ulang email verifikasi.
                                </button>
                            </p>
                        </div>
                        @endif
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Nomor Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="08123456789" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Alamat Lengkap</label>
                        <textarea name="address" rows="4" placeholder="Jl. Nama Jalan No. 123, Kota, Provinsi" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Update Password -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-6">Ubah Password</h2>
            
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Password Saat Ini</label>
                        <input type="password" name="current_password" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        @error('current_password', 'updatePassword')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Password Baru</label>
                        <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        @error('password', 'updatePassword')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
                        @error('password_confirmation', 'updatePassword')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">
                        Update Password
                    </button>
                </div>
            </form>
        </div>

        <!-- Delete Account -->
        <div class="bg-white rounded-lg shadow p-6 border-2 border-red-200">
            <h2 class="text-xl font-bold text-red-600 mb-4">Zona Berbahaya</h2>
            <p class="text-gray-700 mb-4">
                Setelah akun Anda dihapus, semua data dan informasi akan dihapus secara permanen. 
                Sebelum menghapus akun, silakan unduh data atau informasi yang ingin Anda simpan.
            </p>
            
            <button 
                x-data="" 
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" 
                class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition font-semibold"
            >
                Hapus Akun
            </button>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div 
    x-data="{ show: false }" 
    x-on:open-modal.window="$event.detail == 'confirm-user-deletion' ? show = true : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: none;"
>
    <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div x-show="show" class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-md sm:mx-auto">
        <div class="bg-white px-6 py-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">
                Apakah Anda yakin ingin menghapus akun?
            </h3>

            <p class="text-sm text-gray-600 mb-4">
                Setelah akun Anda dihapus, semua data dan informasi akan dihapus secara permanen. 
                Masukkan password Anda untuk konfirmasi penghapusan akun.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Password" 
                        required 
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500"
                    >
                    @error('password', 'userDeletion')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" x-on:click="show = false" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                        Batal
                    </button>
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                        Hapus Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection