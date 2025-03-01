@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-2">
    <!-- Back Button -->
    <div class="my-2">
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center px-4 py-2 bg-white hover:bg-white-700 text-black text-sm font-medium rounded-md transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Dashboard
        </a>
    </div>
    <div class="bg-gradient-to-r from-white to-gray-50 shadow-lg rounded-xl px-4 sm:px-8 pt-6 pb-8 mb-6">
        <!-- Header Section -->
        <div class="text-center sm:text-left mb-6 sm:mb-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-sky-600 mb-3">
                Formulir XRAY
            </h1>
            <p class="text-lg sm:text-xl text-gray-600 font-medium">
                Silakan pilih jenis formulir XRAY
            </p>
        </div>

        <!-- Grid Layout for X-ray Forms -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Pos Timur Form Card -->
            <div onclick="window.location.href='{{ route('xray.cabinutara', ['location' => 'PSCP Cabin Utara']) }}'"
                class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer border border-gray-100 relative group">

                @if ($pendingCounts['PSCP Cabin Utara'] > 0)
                    <div
                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold shadow-md animate-pulse">
                        {{ $pendingCounts['PSCP Cabin Utara'] }}
                    </div>
                @endif

                <div class="flex flex-col items-center">
                    <div
                        class="bg-blue-50 p-4 rounded-full mb-4 group-hover:bg-blue-100 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 text-blue-500 group-hover:text-blue-600 transition-colors duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>

                    <h2
                        class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-blue-700 transition-colors duration-300">
                        Form PSCP Cabin Utara
                    </h2>

                    <div class="flex items-center space-x-2">
                        @if ($pendingCounts['PSCP Cabin Utara'] > 0)
                            <span class="text-red-500 font-semibold">
                                {{ $pendingCounts['PSCP Cabin Utara'] }} Formulir Menunggu
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        @else
                            <span class="text-blue-500 hover:text-blue-700 font-medium">
                                Buka Form
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-blue-500 group-hover:text-blue-700 transition-colors"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        @endif
                    </div>
                </div>
            </div>

            <!-- PSCP Selatan Form Card -->
            <div onclick="window.location.href='{{ route('xray.cabinselatan', ['location' => 'PSCP Cabin Selatan']) }}'"
                class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer border border-gray-100 relative group">

                @if ($pendingCounts['PSCP Cabin Selatan'] > 0)
                    <div
                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold shadow-md animate-pulse">
                        {{ $pendingCounts['PSCP Cabin Selatan'] }}
                    </div>
                @endif

                <div class="flex flex-col items-center">
                    <div
                        class="bg-blue-50 p-4 rounded-full mb-4 group-hover:bg-blue-100 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 text-blue-500 group-hover:text-blue-600 transition-colors duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>

                    <h2
                        class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-blue-700 transition-colors duration-300">
                        Form PSCP Cabin Selatan
                    </h2>

                    <div class="flex items-center space-x-2">
                        @if ($pendingCounts['PSCP Cabin Selatan'] > 0)
                            <span class="text-red-500 font-semibold">
                                {{ $pendingCounts['PSCP Cabin Selatan'] }} Formulir Menunggu
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        @else
                            <span class="text-blue-500 hover:text-blue-700 font-medium">
                                Buka Form
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-blue-500 group-hover:text-blue-700 transition-colors"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        @endif
                    </div>
                </div>
            </div>

            <!-- HBSCP Bagasi Barat Form Card -->
            <div onclick="window.location.href='{{ route('xray.bagasibarat', ['location' => 'HBSCP Bagasi Barat']) }}'"
                class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer border border-gray-100 relative group">

                @if ($pendingCounts['HBSCP Bagasi Barat'] > 0)
                    <div
                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold shadow-md animate-pulse">
                        {{ $pendingCounts['HBSCP Bagasi Barat'] }}
                    </div>
                @endif

                <div class="flex flex-col items-center">
                    <div
                        class="bg-sky-50 p-4 rounded-full mb-4 group-hover:bg-sky-100 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 text-sky-500 group-hover:text-sky-600 transition-colors duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>

                    <h2
                        class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-sky-700 transition-colors duration-300">
                        Form XRAY HBSCP Bagasi Barat
                    </h2>

                    <div class="flex items-center space-x-2">
                        @if ($pendingCounts['HBSCP Bagasi Barat'] > 0)
                            <span class="text-red-500 font-semibold">
                                {{ $pendingCounts['HBSCP Bagasi Barat'] }} Formulir Menunggu
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        @else
                            <span class="text-sky-500 hover:text-sky-700 font-medium">
                                Buka Form
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-sky-500 group-hover:text-sky-700 transition-colors" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        @endif
                    </div>
                </div>
            </div>

            <!-- HBSCP Bagasi Timur Form Card -->
            <div onclick="window.location.href='{{ route('xray.bagasitimur', ['location' => 'HBSCP Bagasi Timur']) }}'"
                class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer border border-gray-100 relative group">

                @if ($pendingCounts['HBSCP Bagasi Timur'] > 0)
                    <div
                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold shadow-md animate-pulse">
                        {{ $pendingCounts['HBSCP Bagasi Timur'] }}
                    </div>
                @endif

                <div class="flex flex-col items-center">
                    <div
                        class="bg-sky-50 p-4 rounded-full mb-4 group-hover:bg-sky-100 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 text-sky-500 group-hover:text-sky-600 transition-colors duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>

                    <h2
                        class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-sky-700 transition-colors duration-300">
                        Form XRAY HBSCP Bagasi Timur
                    </h2>

                    <div class="flex items-center space-x-2">
                        @if ($pendingCounts['HBSCP Bagasi Timur'] > 0)
                            <span class="text-red-500 font-semibold">
                                {{ $pendingCounts['HBSCP Bagasi Timur'] }} Formulir Menunggu
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        @else
                            <span class="text-sky-500 hover:text-sky-700 font-medium">
                                Buka Form
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-sky-500 group-hover:text-sky-700 transition-colors" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    @media (max-width: 640px) {
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .grid {
            gap: 1rem;
        }

        .text-3xl {
            font-size: 1.5rem;
        }

        .p-4 {
            padding: 0.75rem;
        }
    }
</style>
@endpush
@endsection
