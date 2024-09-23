@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-2xl font-bold mb-4">{{ __('Dashboard') }}</h1>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h2 class="text-xl font-semibold mb-2">Selamat datang, {{ Auth::user()->name }}</h2>
        <p class="mb-4">Peran: {{ Auth::user()->role }}</p>

        @if(Auth::user()->isSuperAdmin())
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4" role="alert">
                Anda memiliki hak akses superadmin.
            </div>
        @endif

        @if(Auth::user()->role == 'supervisor' || Auth::user()->role == 'superadmin')
            <h3 class="text-lg font-semibold mb-2">Formulir HHMD yang Perlu Dikoreksi</h3>
            @if(isset($pendingForms) && $pendingForms->count() > 0)
                <table class="w-full border-collapse border border-gray-300 mb-4">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">Tanggal Pengujian</th>
                            <th class="border border-gray-300 px-4 py-2">Lokasi</th>
                            <th class="border border-gray-300 px-4 py-2">Hasil Pemeriksaan</th>
                            <th class="border border-gray-300 px-4 py-2">Status Koreksi</th>
                            <th class="border border-gray-300 px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingForms as $form)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $form->testDateTime }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $form->location }}</td>
                                <td class="border border-gray-300 px-4 py-2 uppercase text-center">
                                    @if($form->result == 'pass')
                                        <span class="bg-green-500 text-white px-2 py-1 rounded">{{ $form->result }}</span>
                                    @elseif($form->result == 'fail')
                                        <span class="bg-red-500 text-white px-2 py-1 rounded">{{ $form->result }}</span>
                                    @else
                                        {{ $form->result }}
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-4 py-2 uppercase text-center">
                                    @if($form->status == 'pending_supervisor')
                                        <span class="bg-yellow-500 text-white px-2 py-1 rounded">{{ $form->status }}</span>
                                    @elseif($form->status == 'approved')
                                        <span class="bg-green-500 text-white px-2 py-1 rounded">{{ $form->status }}</span>
                                    @elseif($form->status == 'rejected')
                                        <span class="bg-red-500 text-white px-2 py-1 rounded">{{ $form->status }}</span>
                                    @else
                                        {{ $form->status }}
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('review.hhmd.reviewhhmd', $form->id) }}" class="bg-blue-500 text-white px-2 py-1 hover:bg-blue-700 rounded">Tinjau</a>
                                        @if(Auth::check() && !Auth::guard('officer')->check() && Auth::user()->role === 'superadmin')
                                            <a href="{{ route('pdf.hhmd', $form->id) }}" class="bg-green-500 text-white px-2 py-1 hover:bg-green-700 rounded" target="_blank">Unduh PDF</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="mb-4">Tidak ada formulir yang perlu dikoreksi saat ini.</p>
            @endif

            <h3 class="text-lg font-semibold mb-2 mt-6">Rekap HHMD yang Sudah Dikoreksi</h3>
            @if(isset($correctedForms) && $correctedForms->count() > 0)
                <table class="w-full border-collapse border border-gray-300 mb-4">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">Tanggal Pengujian</th>
                            <th class="border border-gray-300 px-4 py-2">Lokasi</th>
                            <th class="border border-gray-300 px-4 py-2">Hasil Pemeriksaan</th>
                            <th class="border border-gray-300 px-4 py-2">Status Koreksi</th>
                            <th class="border border-gray-300 px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($correctedForms as $form)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $form->testDateTime }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $form->location }}</td>
                                <td class="border border-gray-300 px-4 py-2 uppercase text-center">
                                    @if($form->result == 'pass')
                                        <span class="bg-green-500 text-white px-2 py-1 rounded">{{ $form->result }}</span>
                                    @elseif($form->result == 'fail')
                                        <span class="bg-red-500 text-white px-2 py-1 rounded">{{ $form->result }}</span>
                                    @else
                                        {{ $form->result }}
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-4 py-2 uppercase text-center">
                                    @if($form->status == 'pending_supervisor')
                                        <span class="bg-yellow-500 text-white px-2 py-1 rounded">{{ $form->status }}</span>
                                    @elseif($form->status == 'approved')
                                        <span class="bg-green-500 text-white px-2 py-1 rounded">{{ $form->status }}</span>
                                    @elseif($form->status == 'rejected')
                                        <span class="bg-red-500 text-white px-2 py-1 rounded">{{ $form->status }}</span>
                                    @else
                                        {{ $form->status }}
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('review.hhmd.reviewhhmd', $form->id) }}" class="bg-blue-500 text-white px-2 py-1 hover:bg-blue-700 rounded">Tinjau</a>
                                        @if(Auth::check() && !Auth::guard('officer')->check() && Auth::user()->role === 'superadmin')
                                            <a href="{{ route('pdf.hhmd', $form->id) }}" class="bg-green-500 text-white px-2 py-1 hover:bg-green-700 rounded" target="_blank">Unduh PDF</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="mb-4">Belum ada formulir HHMD yang sudah dikoreksi.</p>
            @endif
        @endif

        <h3 class="text-lg font-semibold mb-2">Aksi Cepat</h3>
        <ul class="list-disc pl-5 mb-4">
            <li><a href="#" class="text-blue-500 hover:text-blue-700">Kelola Pengguna</a></li>
            <li><a href="#" class="text-blue-500 hover:text-blue-700">Lihat Laporan</a></li>
            <li><a href="#" class="text-blue-500 hover:text-blue-700">Pengaturan Sistem</a></li>
        </ul>
    </div>
</div>
@endsection
