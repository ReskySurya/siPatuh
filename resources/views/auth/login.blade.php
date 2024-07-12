@extends('layouts.auth')

@section('content')
<div class="w-full max-w-md mx-auto">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <!-- Tambahkan Gambar Logo -->
        <div class="mb-4">
            <img src="{{ asset('images/airport-security-logo.png') }}" alt="AVSEC Logo" class="mx-auto w-24 h-24">
        </div>
        <h2 class="mb-10 text-3xl font-extrabold text-gray-900 text-center">
            {{ __('Airport Security') }}
        </h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="login">
                    {{ __('Email or NIP') }}
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('login') border-red-500 @enderror"
                       id="login"
                       type="text"
                       name="login"
                       value="{{ old('login') }}"
                       required
                       autofocus>
                @error('login')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    {{ __('Password') }}
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror"
                       id="password"
                       type="password"
                       name="password"
                       required>
                @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                    {{ __('Login') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
