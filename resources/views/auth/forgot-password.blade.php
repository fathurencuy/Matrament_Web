{{-- resources/views/auth/forgot-password.blade.php --}}
@extends('layouts.app')

@section('title', 'Lupa Password - MatraMent Thrifting')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Lupa Password?
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Masukkan email Anda dan kami akan mengirimkan link reset password.
            </p>
        </div>
        
        @if (session('status'))
            <div class="rounded-md bg-green-50 p-4">
                <div class="text-sm text-green-800">
                    {{ session('status') }}
                </div>
            </div>
        @endif
        
        <form class="mt-8 space-y-6" action="{{ route('password.email') }}" method="POST">
            @csrf
            
            <div>
                <label for="email" class="sr-only">Email</label>
                <input id="email" name="email" type="email" autocomplete="email" required 
                       class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                       placeholder="Email" value="{{ old('email') }}">
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit" 
                        class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Kirim Link Reset Password
                </button>
            </div>
            
            <div class="text-center">
                <a href="{{ route('login') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                    Kembali ke Login
                </a>
            </div>
        </form>
    </div>
</div>
@endsection