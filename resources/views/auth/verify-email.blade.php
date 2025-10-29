{{-- resources/views/auth/verify-email.blade.php --}}
@extends('layouts.app')

@section('title', 'Verifikasi Email - MatraMent Thrifting')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Verifikasi Email
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik link yang baru saja kami kirimkan? Jika Anda tidak menerima email, kami dengan senang hati akan mengirimkan yang lain.
            </p>
        </div>
        
        @if (session('status') == 'verification-link-sent')
            <div class="rounded-md bg-green-50 p-4">
                <div class="text-sm text-green-800">
                    Link verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.
                </div>
            </div>
        @endif
        
        <div class="flex items-center justify-between space-x-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" 
                        class="inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="text-sm text-gray-600 hover:text-gray-900 underline">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
