@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg">
        <!-- Header Section -->
        <div class="border-b border-gray-200 p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">{{ __('Formulir HHMD') }}</h1>

                <!-- Filter Button -->
                <div class="relative" x-data="{ isOpen: false }">
                    <button id="filterButton"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-150 flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        <span>Filter</span>
                    </button>

                    <!-- Filter Dropdown -->
                    <div id="filterDropdown"
                        class="absolute right-0 mt-2 w-72 bg-white rounded-lg shadow-xl hidden transform transition-all duration-150 ease-in-out z-10">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-700 mb-3">Filter Berdasarkan Tanggal</h3>
                            <form id="dateFilterForm" class="space-y-4" action="{{ route('filter.hhmd.forms') }}"
                                method="POST">
                                @csrf
                                <div>
                                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                                        Mulai:</label>
                                    <input type="date" id="start_date" name="start_date"
                                        value="{{ old('start_date', $startDate ?? '') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                                        Akhir:</label>
                                    <input type="date" id="end_date" name="end_date"
                                        value="{{ old('end_date', $endDate ?? '') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <button type="submit"
                                    class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors duration-150">
                                    Terapkan Filter
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="flex space-x-1">
                <button onclick="switchTab('pending')"
                    class="tab-button px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-150 bg-blue-600 text-white"
                    id="tab-pending">
                    Belum Diperiksa
                </button>
                <button onclick="switchTab('all')"
                    class="tab-button px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-150 text-gray-600 hover:text-gray-800 hover:bg-gray-100"
                    id="tab-all">
                    Semua Formulir
                </button>
            </div>
        </div>

        <!-- Content Section -->
        <div class="p-6">
            @if (session('status'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p class="font-medium">{{ session('status') }}</p>
            </div>
            @endif

            <!-- Pending Forms Tab -->
            <div id="pending-content" class="tab-content">
                <h2 class="text-xl font-bold text-black">Formulir HHMD Belum Diperiksa</h2>
                <h4 class="text-sm font-light text-black mb-4">Daftar formulir HHMD yang belum selesai diperiksa</h4>

                @if(isset($startDate) && isset($endDate))
                <div class="mb-4 p-4 bg-blue-100 text-blue-700 rounded-lg">
                    <p>Menampilkan hasil dari <strong>{{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }}</strong>
                        hingga <strong>{{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</strong>.</p>
                    <a href="{{ route('hhmdform') }}" class="text-blue-600 underline hover:text-blue-800">Reset
                        Filter</a>

                    <!-- Tombol untuk Unduh PDF Gabungan -->
                    <form action="{{ route('generate.merged.pdf') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="start_date" value="{{ $startDate }}">
                        <input type="hidden" name="end_date" value="{{ $endDate }}">
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-150">
                            Unduh PDF Gabungan
                        </button>
                    </form>
                </div>
                @endif

                @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                @if($allHhmdForms->where('status', 'pending_supervisor')->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse bg-white rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Tanggal Pengujian
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Lokasi
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Hasil Pemeriksaan
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status Koreksi
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($allHhmdForms->where('status', 'pending_supervisor') as $form)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($form->testDateTime)->format('d-m-Y H:i') }}
                                </td>
                                <td class="px-6 py-4">{{ $form->location }}</td>
                                <td class="px-6 py-4">
                                    @if($form->result == 'pass')
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        PASS
                                    </span>
                                    @elseif($form->result == 'fail')
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        FAIL
                                    </span>
                                    @else
                                    {{ $form->result }}
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        {{ $form->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('review.hhmd.reviewhhmd', $form->id) }}"
                                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                        Tinjau
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-8">
                    <p class="text-gray-500">Tidak ada formulir HHMD yang belum diperiksa saat ini.</p>
                </div>
                @endif
            </div>

            <!-- All Forms Tab -->
            <div id="all-content" class="tab-content hidden">
                <h2 class="text-xl font-bold text-black">Semua Formulir HHMD</h2>
                <h4 class="text-sm font-light text-black mb-4">Daftar lengkap semua formulir HHMD</h4>

                @if(isset($startDate) && isset($endDate))
                <div class="mb-4 p-4 bg-blue-100 text-blue-700 rounded-lg">
                    <p>Menampilkan hasil dari <strong>{{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }}</strong>
                        hingga <strong>{{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</strong>.</p>
                    <a href="{{ route('hhmdform') }}" class="text-blue-600 underline hover:text-blue-800">Reset
                        Filter</a>

                    <!-- Tombol untuk Unduh PDF Gabungan -->
                    <form action="{{ route('generate.merged.pdf') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="start_date" value="{{ $startDate }}">
                        <input type="hidden" name="end_date" value="{{ $endDate }}">
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-150">
                            Unduh PDF Gabungan
                        </button>
                    </form>
                </div>
                @endif

                @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                @if($allHhmdForms->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse bg-white rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Tanggal Pengujian
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Lokasi
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Hasil Pemeriksaan
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status Koreksi
                                </th>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($allHhmdForms as $form)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($form->testDateTime)->format('d-m-Y H:i') }}
                                </td>
                                <td class="px-6 py-4">{{ $form->location }}</td>
                                <td class="px-6 py-4">
                                    @if($form->result == 'pass')
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        PASS
                                    </span>
                                    @elseif($form->result == 'fail')
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        FAIL
                                    </span>
                                    @else
                                    {{ $form->result }}
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($form->status == 'approved') bg-green-100 text-green-800
                                        @elseif($form->status == 'rejected') bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800
                                        @endif">
                                        {{ $form->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('review.hhmd.reviewhhmd', $form->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            Tinjau
                                        </a>
                                        @if($form->status == 'approved' && Auth::check() && Auth::user()->role ===
                                        'superadmin')
                                        <a href="{{ route('pdf.hhmd', $form->id) }}" target="_blank"
                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                            <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            Unduh PDF
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-8">
                    <p class="text-gray-500">Tidak ada formulir HHMD saat ini.</p>
                </div>
                @endif
            </div>

            <!-- Back to Dashboard -->
            <div class="mt-6">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-150">
                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching functionality
        const tabs = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs
                tabs.forEach(t => {
                    t.classList.remove('bg-blue-600', 'text-white');
                    t.classList.add('text-gray-600', 'hover:text-gray-800', 'hover:bg-gray-100');
                });

                // Hide all tab contents
                tabContents.forEach(content => content.classList.add('hidden'));

                // Activate the clicked tab
                tab.classList.add('bg-blue-600', 'text-white');
                tab.classList.remove('text-gray-600', 'hover:text-gray-800', 'hover:bg-gray-100');

                // Show the corresponding tab content
                const contentId = tab.getAttribute('onclick').match(/'([^']+)'/)[1] + '-content';
                document.getElementById(contentId).classList.remove('hidden');
            });
        });

        // Set initial active tab
        document.getElementById('tab-pending').click();

        // Dropdown filter toggle
        const filterButton = document.getElementById('filterButton');
        const filterDropdown = document.getElementById('filterDropdown');

        filterButton.addEventListener('click', () => {
            const isVisible = filterDropdown.classList.contains('hidden');
            filterDropdown.classList.toggle('hidden', !isVisible);
        });

        // Close the filter dropdown if clicked outside
        document.addEventListener('click', (e) => {
            if (!filterButton.contains(e.target) && !filterDropdown.contains(e.target)) {
                filterDropdown.classList.add('hidden');
            }
        });

        // Date filter form submission
        const dateFilterForm = document.getElementById('dateFilterForm');
        dateFilterForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            if (!startDate || !endDate) {
                alert('Harap isi tanggal mulai dan akhir.');
                return;
            }

            dateFilterForm.submit();

            // Example: sending data via AJAX
            fetch(dateFilterForm.action, {
                method: 'POST',
                body: new FormData(dateFilterForm),
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Handle the response
                alert('Filter diterapkan. Silakan perbarui data di tabel.');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menerapkan filter.');
            });
        });
    });
</script>
@endsection
