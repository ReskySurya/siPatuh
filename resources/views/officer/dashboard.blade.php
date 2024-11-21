<!-- resources/views/officer/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-2xl font-bold mb-4">{{ __('Officer Dashboard') }}</h1>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h2 class="text-xl font-semibold mb-2">Welcome, Officer {{ Auth::guard('officer')->user()->name }}</h2>
        <p class="mb-4 text-gray-600">NIP: {{ Auth::guard('officer')->user()->nip }}</p>

        <!-- Form yang Ditolak/Dikembalikan -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-4 text-red-600">Form yang Perlu Diperbaiki</h3>
            @php
                $rejectedForms = \App\Models\hhmdsaved::where('submitted_by', Auth::guard('officer')->id())
                    ->where('status', 'rejected')
                    ->orderBy('reviewed_at', 'desc')
                    ->get();
            @endphp

            @if($rejectedForms->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 border-b">Tanggal Test</th>
                                <th class="px-6 py-3 border-b">Lokasi</th>
                                <th class="px-6 py-3 border-b">Catatan Supervisor</th>
                                <th class="px-6 py-3 border-b">Ditinjau Pada</th>
                                <th class="px-6 py-3 border-b">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rejectedForms as $form)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 border-b">{{ $form->testDateTime->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 border-b">{{ $form->location }}</td>
                                <td class="px-6 py-4 border-b text-red-600">
                                    {{ $form->rejection_note }}
                                </td>
                                <td class="px-6 py-4 border-b">
                                    {{ $form->reviewed_at ? $form->reviewed_at->format('d/m/Y H:i') : '-' }}
                                </td>
                                <td class="px-6 py-4 border-b">
                                    <a href="{{ route('officer.hhmd.edit', $form->id) }}"
                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Edit Form
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-600">Tidak ada form yang perlu diperbaiki.</p>
            @endif
        </div>

        <h3 class="text-lg font-semibold mb-2 mt-8">Quick Actions</h3>
        <ul class="list-disc pl-5 mb-4 space-y-2">
            <li><a href="{{ route('officer.hhmd.create') }}" class="text-blue-500 hover:text-blue-700">Submit Form HHMD Baru</a></li>
            <li><a href="#" class="text-blue-500 hover:text-blue-700">Update Profile</a></li>
        </ul>
    </div>
</div>
@endsection
