{{-- resources/views/auth/confirm-password.blade.php --}}
@extends('layouts.app')

@section('title', 'Konfirmasi Password - MatraMent Thrifting')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Konfirmasi Password
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Ini adalah area aman aplikasi. Silakan konfirmasi password Anda sebelum melanjutkan.
            </p>
        </div>
        
        <form class="mt-8 space-y-6" action="{{ route('password.confirm') }}" method="POST">
            @csrf
            
            <div>
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" type="password" required 
                       class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                       placeholder="Password">
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit" 
                        class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Konfirmasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection