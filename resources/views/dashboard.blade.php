@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gradient-to-r from-white to-gray-50 shadow-lg rounded-xl px-8 pt-8 pb-10 mb-6">
        <!-- Header Section with Enhanced Typography -->
        <div class="text-left mb-8">
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 mb-4">
                Dashboard
            </h1>
            <p class="text-xl text-gray-600 font-medium">
                Selamat datang, <span class="text-indigo-600 font-semibold">{{ Auth::user()->name }}</span> 👋
            </p>
        </div>

        <!-- Enhanced Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- HHMD Form Card -->
            <div onclick="window.location.href='{{ route('hhmdform') }}'"
                 class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer border border-gray-100 relative">
                @if($pendingHhmdForms->count() > 0)
                    <div class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-7 h-7 flex items-center justify-center text-sm font-bold shadow-md">
                        {{ $pendingHhmdForms->count() }}
                    </div>
                @endif
                <div class="flex flex-col items-center">
                    <div class="bg-blue-50 p-3 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Formulir HHMD</h2>
                    <span class="text-blue-500 hover:text-blue-700 font-medium">Lihat Formulir →</span>
                </div>
            </div>

            <!-- WTMD Form Card -->
            <div onclick="window.location.href='{{ route('wtmd.index') }}'"
                 class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer border border-gray-100 relative">
                @if($pendingWtmdForms->count() > 0)
                    <div class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-7 h-7 flex items-center justify-center text-sm font-bold shadow-md">
                        {{ $pendingWtmdForms->count() }}
                    </div>
                @endif
                <div class="flex flex-col items-center">
                    <div class="bg-purple-50 p-3 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Formulir WTMD</h2>
                    <span class="text-purple-500 hover:text-purple-700 font-medium">Lihat Formulir →</span>
                </div>
            </div>

            <!-- Xray Form Card -->
            <div onclick="window.location.href='{{ route('xray.index') }}'"
                 class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer border border-gray-100 relative">
                @if($pendingXrayForms->count() > 0)
                    <div class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-7 h-7 flex items-center justify-center text-sm font-bold shadow-md">
                        {{ $pendingXrayForms->count() }}
                    </div>
                @endif
                <div class="flex flex-col items-center">
                    <div class="bg-green-50 p-3 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Formulir Xray</h2>
                    <span class="text-green-500 hover:text-green-700 font-medium">Lihat Formulir →</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
