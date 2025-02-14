@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-lg px-8 py-8 sm:px-10">
            <!-- Logo -->
            <div class="mb-6">
                <img src="{{ asset('images/airport-security-logo.png') }}"
                    alt="AVSEC Logo"
                    class="mx-auto w-20 h-20 sm:w-24 sm:h-24 object-contain">
            </div>

            <h2 class="mb-8 text-2xl sm:text-3xl font-extrabold text-gray-900 text-center">
                {{ __('Airport Security') }}
            </h2>

            <!-- Alert Error -->
            @if($errors->any())
            <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded-r" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <ul class="list-disc list-inside text-sm text-red-700">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6" id="loginForm">
                @csrf

                <!-- Email/NIP Field -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="login">
                        {{ __('Email / NIP') }}
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                        focus:outline-none focus:shadow-outline focus:border-blue-500 focus:ring-1 focus:ring-blue-500
                        @error('login') border-red-500 @enderror"
                        id="login"
                        type="text"
                        name="login"
                        placeholder="Masukkan Email atau NIP"
                        value="{{ old('login') }}"
                        required
                        autofocus>
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        {{ __('Password') }}
                    </label>
                    <div class="relative">
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                            focus:outline-none focus:shadow-outline focus:border-blue-500 focus:ring-1 focus:ring-blue-500
                            @error('password') border-red-500 @enderror"
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Masukkan Password"
                            required>
                        <button type="button"
                            onclick="togglePassword('password')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-500" id="password_icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Login Button -->
                <div>
                    <button type="submit"
                        id="loginButton"
                        class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded
                            focus:outline-none focus:shadow-outline transition duration-150 ease-in-out
                            disabled:opacity-50 disabled:cursor-not-allowed">
                        <span id="buttonText">{{ __('Login') }}</span>
                        <span id="buttonLoading" class="hidden">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Loading...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(inputId + '_icon');

    if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
        `;
    } else {
        input.type = 'password';
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        `;
    }
}

// Form validation and loading state
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const loginInput = document.getElementById('login');
    const passwordInput = document.getElementById('password');
    const button = document.getElementById('loginButton');
    const buttonText = document.getElementById('buttonText');
    const buttonLoading = document.getElementById('buttonLoading');

    // Basic validation
    if (!loginInput.value || !passwordInput.value) {
        e.preventDefault();
        alert('Mohon isi semua field yang diperlukan');
        return;
    }

    // Show loading state
    button.disabled = true;
    buttonText.classList.add('hidden');
    buttonLoading.classList.remove('hidden');
});
</script>
@endsection
