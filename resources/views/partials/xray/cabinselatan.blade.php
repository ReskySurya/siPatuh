@extends('layouts.app')
@section('content')

<div class="container mx-auto p-0 py-2 sm:py-8">
    <div class="bg-white shadow-md rounded-lg">
        <!-- Header Section -->
        <div class="border-b border-gray-200 p-2 sm:p-4 md:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-3 sm:mb-4 md:mb-6 space-y-2 sm:space-y-0">
                <h1 class="text-base sm:text-xl md:text-2xl font-bold text-gray-800 w-full sm:w-auto text-center sm:text-left">
                    {{ __('Formulir PSCP CABIN SELATAN') }}
                </h1>
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
                    Daftar formulir XRAY HBSCP Bagasi Barat yang belum selesai diperiksa
                </h4>

                @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 sm:p-4 mb-4" role="alert">
                    @foreach($errors->all() as $error)
                    <p class="text-xs sm:text-sm">{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                @if($allXrayForms->where('status', 'pending_supervisor')->count() > 0)
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
                            @foreach($allXrayForms->where('status', 'pending_supervisor') as $form)
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
                                    <a href="{{ route('review.xray.reviewxraycabin', $form->id) }}"
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
                    <p class="text-xs sm:text-sm text-gray-500">Tidak ada formulir PSCP Cabin Selatan yang belum diperiksa
                        saat ini.</p>
                </div>
                @endif
            </div>

            <!-- All Forms Tab -->
            <div id="all-content" class="tab-content hidden px-2 sm:px-6 lg:px-8">
                <h2 class="text-base sm:text-xl font-bold text-black">Semua Formulir PSCP Cabin Selatan</h2>
                <h4 class="text-[10px] sm:text-sm font-light text-black mb-2 sm:mb-4">
                    Daftar lengkap semua formulir PSCP Cabin Selatan
                </h4>

                @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mb-2 sm:mb-4" role="alert">
                    @foreach($errors->all() as $error)
                    <p class="text-[10px] sm:text-sm">{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                @if($allXrayForms->count() > 0)
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
                            @foreach($allXrayForms as $form)
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
                                        <a href="{{ route('review.xray.reviewxraycabin', $form->id) }}"
                                            class="inline-flex items-center px-2 py-1 text-[10px] font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                                            Tinjau
                                        </a>
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
                        Tidak ada formulir PSCP Cabin Selatan saat ini.
                    </p>
                </div>
                @endif
            </div>

            <!-- Back to Dashboard (Responsive) -->
            <div class="mt-6 flex justify-center sm:justify-start">
                <a href="{{ route('xrayform') }}"
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
