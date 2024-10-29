@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
        <p class="mb-6">Selamat datang, {{ Auth::user()->name }}</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div onclick="window.location.href='{{ route('hhmdform') }}'" class="bg-gray-100 p-6 rounded-lg shadow-md text-center cursor-pointer hover:bg-gray-200 transition-colors relative">
                @if($pendingHhmdForms->count() > 0)
                    <div class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">
                        {{ $pendingHhmdForms->count() }}
                    </div>
                @endif
                <h2 class="text-xl font-semibold mb-2">Formulir HHMD</h2>
                <span class="text-blue-500 hover:text-blue-700">Lihat Formulir</span>
            </div>
            <div onclick="window.location.href='{{ route('wtmd.index') }}'" class="bg-gray-100 p-6 rounded-lg shadow-md text-center cursor-pointer hover:bg-gray-200 transition-colors relative">
                @if($pendingWtmdForms->count() > 0)
                    <div class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">
                        {{ $pendingWtmdForms->count() }}
                    </div>
                @endif
                <h2 class="text-xl font-semibold mb-2">Formulir WTMD</h2>
                <span class="text-blue-500 hover:text-blue-700">Lihat Formulir</span>
            </div>
            <div onclick="window.location.href='{{ route('xray.index') }}'" class="bg-gray-100 p-6 rounded-lg shadow-md text-center cursor-pointer hover:bg-gray-200 transition-colors relative">
                @if($pendingXrayForms->count() > 0)
                    <div class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">
                        {{ $pendingXrayForms->count() }}
                    </div>
                @endif
                <h2 class="text-xl font-semibold mb-2">Formulir Xray</h2>
                <span class="text-blue-500 hover:text-blue-700">Lihat Formulir</span>
            </div>
        </div>
    </div>
</div>
@endsection
