@extends('layouts.app')
@section('content')

<div class="container mx-auto p-0 py-2 sm:py-8">
    <div class="bg-white shadow-md rounded-lg">
        <!-- Header Section -->
        <div class="border-b border-gray-200 p-2 sm:p-4 md:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-3 sm:mb-4 md:mb-6 space-y-2 sm:space-y-0">
                <h1 class="text-base sm:text-xl md:text-2xl font-bold text-gray-800 w-full sm:w-auto text-center sm:text-left">
                    {{ __('Formulir WTMD PSCP SELATAN') }}
                </h1>

                <!-- Button group dengan penyesuaian ukuran -->
                <div class="flex flex-col space-y-2 w-full sm:w-auto sm:flex-row sm:space-y-0 sm:space-x-2">
                    @if(Auth::check() && Auth::user()->role === 'superadmin')
                    <div class="relative w-full sm:w-auto" x-data="{ showDatePicker: false }">
                        <button @click="showDatePicker = !showDatePicker"
                            class="w-full sm:w-auto bg-green-600 text-white px-2 py-1.5 text-xs rounded-lg hover:bg-green-700 transition-colors duration-150 flex items-center justify-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            <span>PDF</span>
                        </button>

                        <!-- Date Picker Dropdown dengan ukuran yang lebih kecil -->
                        <div x-show="showDatePicker" @click.away="showDatePicker = false"
                            class="absolute right-0 mt-1 w-full sm:w-72 bg-white rounded-lg shadow-xl z-10 p-2">
                            <form action="{{ route('generate.merged.pdf') }}" method="POST" class="space-y-2">
                                @csrf
                                <div>
                                    <label for="pdf_start_date" class="block text-xs font-medium text-gray-700 mb-1">
                                        Tanggal Mulai
                                    </label>
                                    <input type="date" id="pdf_start_date" name="start_date" required
                                        class="w-full px-2 py-1 border border-gray-300 rounded-md text-xs">
                                </div>
                                <div>
                                    <label for="pdf_end_date" class="block text-xs font-medium text-gray-700 mb-1">
                                        Tanggal Akhir
                                    </label>
                                    <input type="date" id="pdf_end_date" name="end_date" required
                                        class="w-full px-2 py-1 border border-gray-300 rounded-md text-xs">
                                </div>
                                @if ($errors->any())
                                <div class="text-red-500 text-xs sm:text-sm">
                                    {{ $errors->first() }}
                                </div>
                                @endif
                                <div class="flex justify-end space-x-2">
                                    <button type="button" @click="showDatePicker = false"
                                        class="px-2 py-1 sm:px-3 sm:py-2 text-xs sm:text-sm text-gray-600 hover:text-gray-800">
                                        Batal
                                    </button>
                                    <button type="submit"
                                        class="px-2 py-1 sm:px-3 sm:py-2 text-xs sm:text-sm bg-green-600 text-white rounded-md hover:bg-green-700">
                                        Unduh
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif

                    <!-- Filter Button dengan ukuran yang lebih kecil -->
                    <button id="filterButton"
                        class="w-full sm:w-auto bg-blue-600 text-white px-2 py-1.5 text-xs rounded-lg hover:bg-blue-700 transition-colors duration-150 flex items-center justify-center space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        <span>Filter</span>
                    </button>
                </div>
            </div>

            <!-- Tabs Navigation dengan ukuran yang lebih kecil -->
            <div class="flex flex-wrap gap-1 justify-center sm:justify-start">
                <button onclick="switchTab('pending')"
                    class="tab-button px-2 py-1 text-xs font-medium rounded-lg transition-colors duration-150 bg-blue-600 text-white"
                    id="tab-pending">
                    Belum Diperiksa
                </button>
                <button onclick="switchTab('all')"
                    class="tab-button px-2 py-1 text-xs font-medium rounded-lg transition-colors duration-150 text-gray-600 hover:text-gray-800 hover:bg-gray-100"
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
            <div id="pending-content" class="tab-content hidden px-2 sm:px-6 lg:px-8">
                <h2 class="text-base sm:text-xl font-bold text-black">Formulir Belum Diperiksa</h2>
                <h4 class="text-[10px] sm:text-sm font-light text-black mb-2 sm:mb-4">
                    Daftar formulir WTMD PSCP Selatan yang belum selesai diperiksa
                </h4>

                @if(isset($startDate) && isset($endDate))
                <div class="mb-4 p-2 sm:p-4 bg-blue-100 text-blue-700 rounded-lg">
                    <p class="text-xs sm:text-sm">Menampilkan hasil dari
                        <strong>{{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }}</strong>
                        hingga <strong>{{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</strong>.
                    </p>
                    <a href="{{ route('wtmd.pscpselatan') }}"
                        class="text-blue-600 text-xs sm:text-sm underline hover:text-blue-800">Reset Filter</a>
                </div>
                @endif

                @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 sm:p-4 mb-4" role="alert">
                    @foreach($errors->all() as $error)
                    <p class="text-xs sm:text-sm">{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                @if($allWtmdForms->where('status', 'pending_supervisor')->count() > 0)
                <div class="overflow-x-auto -mx-2 sm:mx-0">
                    <table class="w-full border-collapse bg-white text-left">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-1 border-b text-[10px] font-semibold text-gray-600 uppercase whitespace-nowrap">
                                    Tanggal
                                </th>
                                <th class="p-1 border-b text-[10px] font-semibold text-gray-600 uppercase">
                                    Lokasi
                                </th>
                                <th class="p-1 border-b text-[10px] font-semibold text-gray-600 uppercase">
                                    Hasil
                                </th>
                                <th class="p-1 border-b text-[10px] font-semibold text-gray-600 uppercase">
                                    Status
                                </th>
                                <th class="p-1 border-b text-[10px] font-semibold text-gray-600 uppercase">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allWtmdForms->where('status', 'pending_supervisor') as $form)
                            <tr class="hover:bg-gray-50">
                                <td class="p-1 text-[10px]">
                                    {{ \Carbon\Carbon::parse($form->testDateTime)->format('d-m-Y H:i') }}
                                </td>
                                <td class="p-1 text-[10px]">{{ $form->location }}</td>
                                <td class="p-1">
                                    <span class="px-1.5 py-0.5 text-[10px] font-semibold rounded-full
                                        @if($form->result == 'pass') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ strtoupper($form->result) }}
                                    </span>
                                </td>
                                <td class="p-1">
                                    <span class="px-1.5 py-0.5 text-[10px] font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        {{ $form->status }}
                                    </span>
                                </td>
                                <td class="p-1">
                                    <a href="{{ route('review.wtmd.reviewwtmd', $form->id) }}"
                                        class="inline-flex items-center px-2 py-1 text-[10px] font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                                        Tinjau
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4 sm:py-8">
                    <p class="text-xs sm:text-sm text-gray-500">
                        Tidak ada formulir WTMD PSCP Selatan yang belum diperiksa saat ini.
                    </p>
                </div>
                @endif
            </div>

            <!-- All Forms Tab -->
            <div id="all-content" class="tab-content hidden px-2 sm:px-6 lg:px-8">
                <h2 class="text-base sm:text-xl font-bold text-black">Semua Formulir WTMD PSCP Selatan</h2>
                <h4 class="text-[10px] sm:text-sm font-light text-black mb-2 sm:mb-4">Daftar lengkap semua formulir WTMD PSCP Selatan</h4>

                @if(isset($startDate) && isset($endDate))
                <div class="mb-2 sm:mb-4 p-2 bg-blue-100 text-blue-700 rounded-lg">
                    <p class="text-[10px] sm:text-sm">
                        Menampilkan hasil dari
                        <strong>{{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }}</strong>
                        hingga
                        <strong>{{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</strong>
                    </p>
                    <a href="{{ route('wtmd.pscpselatan') }}"
                       class="text-blue-600 text-[10px] sm:text-sm underline hover:text-blue-800">
                        Reset Filter
                    </a>

                    @if(Auth::check() && Auth::user()->role === 'superadmin')
                    <form action="{{ route('generate.merged.pdf') }}" method="POST" class="mt-2">
                        @csrf
                        <input type="hidden" name="start_date" value="{{ $startDate }}">
                        <input type="hidden" name="end_date" value="{{ $endDate }}">
                        <input type="hidden" name="location" value="HBSCP">
                        <button type="submit"
                            class="w-full sm:w-auto bg-green-600 text-white px-2 py-1 text-[10px] sm:text-sm rounded-md hover:bg-green-700 transition-colors duration-150 flex items-center justify-center space-x-1">
                            <svg class="h-3 w-3 sm:h-4 sm:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            <span>Unduh PDF</span>
                        </button>
                    </form>
                    @endif
                </div>
                @endif

                @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mb-2 sm:mb-4" role="alert">
                    @foreach($errors->all() as $error)
                    <p class="text-[10px] sm:text-sm">{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                @if($allWtmdForms->count() > 0)
                <div class="overflow-x-auto -mx-2 sm:mx-0">
                    <table class="w-full border-collapse bg-white text-left">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-1 border-b text-[10px] font-semibold text-gray-600 uppercase whitespace-nowrap">
                                    Tanggal
                                </th>
                                <th class="p-1 border-b text-[10px] font-semibold text-gray-600 uppercase">
                                    Lokasi
                                </th>
                                <th class="p-1 border-b text-[10px] font-semibold text-gray-600 uppercase">
                                    Hasil
                                </th>
                                <th class="p-1 border-b text-[10px] font-semibold text-gray-600 uppercase">
                                    Status
                                </th>
                                <th class="p-1 border-b text-[10px] font-semibold text-gray-600 uppercase">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($allWtmdForms as $form)
                            <tr class="hover:bg-gray-50">
                                <td class="p-1 text-[10px] whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($form->testDateTime)->format('d-m-Y H:i') }}
                                </td>
                                <td class="p-1 text-[10px]">{{ $form->location }}</td>
                                <td class="p-1">
                                    <span class="px-1.5 py-0.5 text-[10px] font-semibold rounded-full
                                        @if($form->result == 'pass') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ strtoupper($form->result) }}
                                    </span>
                                </td>
                                <td class="p-1">
                                    <span class="px-1.5 py-0.5 text-[10px] font-semibold rounded-full
                                        @if($form->status == 'approved') bg-green-100 text-green-800
                                        @elseif($form->status == 'rejected') bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800 @endif">
                                        {{ $form->status }}
                                    </span>
                                </td>
                                <td class="p-1">
                                    <div class="flex gap-1">
                                        <a href="{{ route('review.wtmd.reviewwtmd', $form->id) }}"
                                            class="inline-flex items-center px-2 py-1 text-[10px] font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                                            Tinjau
                                        </a>
                                        @if($form->status == 'approved' && Auth::check() && Auth::user()->role === 'superadmin')
                                        <a href="{{ route('pdf.hhmd', $form->id) }}" target="_blank"
                                            class="inline-flex items-center px-2 py-1 text-[10px] font-medium text-white bg-green-600 rounded hover:bg-green-700">
                                            PDF
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
                <div class="text-center py-2 sm:py-4">
                    <p class="text-[10px] sm:text-sm text-gray-500">
                        Tidak ada formulir WTMD PSCP Selatan saat ini.
                    </p>
                </div>
                @endif
            </div>

            <!-- Back to Dashboard (Responsive) -->
            <div class="mt-6 flex justify-center sm:justify-start">
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
    function setupResponsiveElements() {
        const filterButton = document.getElementById('filterButton');
        const filterDropdown = document.getElementById('filterDropdown');

        // Responsive tab switching
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

        // Responsive filter dropdown
        if (filterButton && filterDropdown) {
            filterButton.addEventListener('click', (e) => {
                e.stopPropagation();
                filterDropdown.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!filterDropdown.contains(e.target) && !filterButton.contains(e.target)) {
                    filterDropdown.classList.add('hidden');
                }
            });
        }

        // Date filter form handling
        const dateFilterForm = document.getElementById('dateFilterForm');
        if (dateFilterForm) {
            dateFilterForm.addEventListener('submit', (e) => {
                const startDate = document.getElementById('start_date').value;
                const endDate = document.getElementById('end_date').value;

                if (!startDate || !endDate) {
                    e.preventDefault();
                    alert('Harap isi tanggal mulai dan akhir.');
                    return;
                }

                // Optional: Add loading state or validation
                filterButton.disabled = true;
                filterButton.innerHTML = 'Memproses...';
            });
        }

        // Initial tab setup
        const initialTab = document.getElementById('tab-pending');
        if (initialTab) {
            initialTab.click();
        }

        // Responsive table handling
        const tables = document.querySelectorAll('table');
        tables.forEach(table => {
            const wrapper = document.createElement('div');
            wrapper.classList.add('overflow-x-auto');
            table.parentNode.insertBefore(wrapper, table);
            wrapper.appendChild(table);
        });
    }

    // Handle resize and orientation change
    function handleResponsiveAdjustments() {
        const viewportWidth = window.innerWidth;
        const filterButton = document.getElementById('filterButton');
        const filterDropdown = document.getElementById('filterDropdown');

        // Adjust elements based on screen size
        if (viewportWidth < 640) {
            // Mobile-specific adjustments
            if (filterDropdown) {
                filterDropdown.classList.add('w-full');
                filterDropdown.classList.remove('w-72');
            }
        } else {
            // Desktop/Tablet adjustments
            if (filterDropdown) {
                filterDropdown.classList.remove('w-full');
                filterDropdown.classList.add('w-72');
            }
        }
    }

    // Initial setup
    setupResponsiveElements();
    handleResponsiveAdjustments();

    // Add event listeners for responsive adjustments
    window.addEventListener('resize', handleResponsiveAdjustments);
    window.addEventListener('orientationchange', handleResponsiveAdjustments);
});
</script>

@endsection
