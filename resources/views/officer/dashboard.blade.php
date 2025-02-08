<!-- resources/views/officer/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto sm:px-4 py-4 sm:py-8">
    <div class="bg-white shadow-md rounded px-3 sm:px-8 pt-4 sm:pt-6 pb-6 sm:pb-8 mb-4">
        <h1 class="text-xl sm:text-2xl font-bold mb-4">{{ __('Officer Dashboard') }}</h1>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-3 py-2 sm:px-4 sm:py-3 rounded relative mb-4 text-sm sm:text-base" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h2 class="text-lg sm:text-xl font-semibold mb-2">Welcome, Officer {{ Auth::guard('officer')->user()->name }}</h2>
        <p class="mb-4 text-gray-600 text-sm sm:text-base">NIP: {{ Auth::guard('officer')->user()->nip }}</p>

        <!-- Form yang Ditolak/Dikembalikan -->
        <div class="mt-6 sm:mt-8">
            <h3 class="text-base sm:text-lg font-semibold mb-3 sm:mb-4 text-red-600">Form yang Perlu Diperbaiki</h3>
            @php
                $rejectedHhmdForms = \App\Models\hhmdsaved::where('submitted_by', Auth::guard('officer')->id())
                    ->where('status', 'rejected')
                    ->orderBy('reviewed_at', 'desc')
                    ->get();

                $rejectedWtmdForms = \App\Models\wtmdsaved::where('submitted_by', Auth::guard('officer')->id())
                    ->where('status', 'rejected')
                    ->orderBy('reviewed_at', 'desc')
                    ->get();

                $rejectedXrayForms = \App\Models\xraysaved::where('submitted_by', Auth::guard('officer')->id())
                    ->where('status', 'rejected')
                    ->orderBy('reviewed_at', 'desc')
                    ->get();

                $rejectedForms = $rejectedHhmdForms->concat($rejectedWtmdForms)->concat($rejectedXrayForms)->sortByDesc('reviewed_at');
            @endphp

            @if($rejectedForms->count() > 0)
                <div class="overflow-x-scroll">
                    <table class="w-full overflow-scroll table-auto border-collapse bg-white border border-gray-300 text-xs sm:text-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-2 py-2 border-b text-left">Tanggal Test</th>
                                <th class="px-2 py-2 border-b text-left">Lokasi</th>
                                <th class="px-2 py-2 border-b text-left">Jenis</th>
                                <th class="px-2 py-2 border-b text-left">Catatan</th>
                                {{-- <th class="px-2 py-2 border-b text-left">Ditinjau</th> --}}
                                <th class="px-2 py-2 border-b text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rejectedForms as $form)
                            <tr class="hover:bg-gray-50">
                                <td class="whitespace-nowrap px-2 py-2 border-b">
                                    {{ $form->testDateTime->format('d/m/Y H:i') }}
                                </td>
                                <td class="whitespace-nowrap px-2 py-2 border-b max-w-[60px] truncate">{{ $form->location }}</td>
                                <td class="whitespace-nowrap px-2 py-2 border-b">
                                    @if($form instanceof \App\Models\hhmdsaved)
                                        HHMD
                                    @elseif($form instanceof \App\Models\wtmdsaved)
                                        WTMD
                                    @elseif($form instanceof \App\Models\xraysaved)
                                        X-Ray
                                    @endif
                                </td>
                                <td class="px-2 py-2 border-b text-red-600">
                                    <div class="max-w-[60px] truncate">
                                        {{ $form->rejection_note }}
                                    </div>
                                </td>
                                {{-- <td class="whitespace-nowrap px-2 py-2 border-b">
                                    {{ $form->reviewed_at ? $form->reviewed_at->format('d/m/Y H:i') : '-' }}
                                </td> --}}
                                <td class="whitespace-nowrap px-2 py-2 border-b">
                                    @if($form instanceof \App\Models\hhmdsaved)
                                        <a href="{{ route('officer.hhmd.edit', $form->id) }}"
                                           class="inline-block bg-blue-500 hover:bg-blue-700 text-white text-xs font-bold py-1 px-2 rounded">
                                            Edit
                                        </a>
                                    @elseif($form instanceof \App\Models\wtmdsaved)
                                        <a href="{{ route('officer.wtmd.edit', $form->id) }}"
                                           class="inline-block bg-blue-500 hover:bg-blue-700 text-white text-xs font-bold py-1 px-2 rounded">
                                            Edit
                                        </a>
                                    @elseif($form instanceof \App\Models\xraysaved)
                                        @if($form->location == 'HBSCP Bagasi Timur' || $form->location == 'HBSCP Bagasi Barat')
                                            <a href="{{ route('officer.xray.editbagasi', $form->id) }}"
                                               class="inline-block bg-blue-500 hover:bg-blue-700 text-white text-xs font-bold py-1 px-2 rounded">
                                                Edit
                                            </a>
                                        @elseif($form->location == 'PSCP Cabin Utara' || $form->location == 'PSCP Cabin Selatan')
                                            <a href="{{ route('officer.xray.editcabin', $form->id) }}"
                                               class="inline-block bg-blue-500 hover:bg-blue-700 text-white text-xs font-bold py-1 px-2 rounded">
                                                Edit
                                            </a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-600 text-sm">Tidak ada form yang perlu diperbaiki.</p>
            @endif
        </div>

        <h3 class="text-base sm:text-lg font-semibold mb-2 mt-6 sm:mt-8">Quick Actions</h3>
        <ul class="list-disc pl-5 mb-4 space-y-2 text-sm sm:text-base">
            <li><a href="{{ route('officer.hhmd.create') }}" class="text-blue-500 hover:text-blue-700">Submit Form HHMD Baru</a></li>
            <li><a href="#" class="text-blue-500 hover:text-blue-700">Update Profile</a></li>
        </ul>
    </div>
</div>

<!-- Tambahkan script di bagian bawah file -->
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tableContainer = document.getElementById('tableContainer');
    const scrollIndicator = document.getElementById('scrollIndicator');

    if (tableContainer && scrollIndicator) {
        // Cek apakah tabel bisa di-scroll
        const checkScroll = () => {
            if (tableContainer.scrollWidth > tableContainer.clientWidth) {
                scrollIndicator.classList.remove('hidden');
            } else {
                scrollIndicator.classList.add('hidden');
            }
        };

        // Sembunyikan indikator scroll saat user mulai scroll
        tableContainer.addEventListener('scroll', () => {
            if (tableContainer.scrollLeft > 0) {
                scrollIndicator.classList.add('hidden');
            }
        });

        // Cek saat halaman dimuat dan saat resize
        checkScroll();
        window.addEventListener('resize', checkScroll);
    }
});
</script>
@endpush

<!-- Tambahkan style untuk scrollbar (opsional) -->
@push('styles')
<style>
/* Styling untuk scrollbar */
.scrollbar-thin::-webkit-scrollbar {
    height: 8px;
}

.scrollbar-thin::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.scrollbar-thin::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}

.scrollbar-thin::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Untuk Firefox */
.scrollbar-thin {
    scrollbar-width: thin;
    scrollbar-color: #888 #f1f1f1;
}
</style>
@endpush
@endsection
