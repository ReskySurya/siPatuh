@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ __('Formulir HHMD') }}</h1>

            <!-- Enhanced Filter Button with Animation -->
            <div class="relative">
                <button id="filterButton" class="bg-blue-600 text-white px-4 py-2 rounded-lg mr-2 hover:bg-blue-700 transition duration-150 ease-in-out flex items-center space-x-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span>Filter</span>
                </button>

                <!-- Enhanced Filter Dropdown with Animation -->
                <div id="filterDropdown" class="absolute right-0 mt-2 w-72 bg-white rounded-lg shadow-xl hidden transform transition-all duration-150 ease-in-out z-10">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">Filter Berdasarkan Tanggal</h3>
                        <form id="dateFilterForm" class="space-y-4">
                            <div>
                                <label for="startDate" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai:</label>
                                <input type="date" id="startDate" name="startDate"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="endDate" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir:</label>
                                <input type="date" id="endDate" name="endDate"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <button type="submit"
                                class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                Terapkan Filter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if (session('status'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-4 animate-fade-in" role="alert">
                <p class="font-medium">{{ session('status') }}</p>
            </div>
        @endif

        <!-- Enhanced Section Styling -->
        <div class="space-y-8">
            <!-- Pending Forms Section -->
            <section class="bg-gray-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Formulir HHMD Belum Diperiksa</h2>
                @if($allHhmdForms->where('status', 'pending_supervisor')->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse bg-white rounded-lg overflow-hidden">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Pengujian</th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Lokasi</th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Hasil Pemeriksaan</th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status Koreksi</th>
                                    <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($allHhmdForms->where('status', 'pending_supervisor') as $form)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($form->testDateTime)->format('d-m-Y H:i') }}</td>
                                        <td class="px-6 py-4">{{ $form->location }}</td>
                                        <td class="px-6 py-4">
                                            @if($form->result == 'pass')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    PASS
                                                </span>
                                            @elseif($form->result == 'fail')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    FAIL
                                                </span>
                                            @else
                                                {{ $form->result }}
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                {{ $form->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('review.hhmd.reviewhhmd', $form->id) }}"
                                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
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
            </section>

            <!-- All Forms Section with Similar Enhanced Styling -->
            <section class="bg-gray-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Semua Formulir HHMD</h2>
                @if($allHhmdForms->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse bg-white rounded-lg overflow-hidden">
                            <!-- Similar enhanced table structure as above -->
                        </table>
                    </div>
                    <div id="mergePdfButton" class="mt-4"></div>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-500">Tidak ada formulir HHMD saat ini.</p>
                    </div>
                @endif
            </section>
        </div>

        <div class="mt-6">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Enhanced JavaScript with better organization and error handling
    const HHMDForm = {
        elements: {
            filterBtn: null,
            filterDropdown: null,
            dateFilterForm: null,
            pendingTable: null,
            allFormsTable: null,
            mergePdfContainer: null
        },

        init() {
            this.initializeElements();
            this.setupEventListeners();
        },

        initializeElements() {
            this.elements = {
                filterBtn: document.getElementById('filterButton'),
                filterDropdown: document.getElementById('filterDropdown'),
                dateFilterForm: document.getElementById('dateFilterForm'),
                pendingTable: document.querySelector('table:first-of-type tbody'),
                allFormsTable: document.querySelector('table:last-of-type tbody'),
                mergePdfContainer: document.getElementById('mergePdfButton')
            };
        },

        setupEventListeners() {
            // Setup filter dropdown toggle
            if (this.elements.filterBtn && this.elements.filterDropdown) {
                this.elements.filterBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.toggleDropdown();
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', (e) => {
                    if (!this.elements.filterDropdown.contains(e.target)) {
                        this.elements.filterDropdown.classList.add('hidden');
                    }
                });
            }

            // Setup date filter form
            if (this.elements.dateFilterForm) {
                this.elements.dateFilterForm.addEventListener('submit', (e) => this.handleDateFilter(e));
            }
        },

        toggleDropdown() {
            this.elements.filterDropdown.classList.toggle('hidden');

            // Add slide animation classes
            if (!this.elements.filterDropdown.classList.contains('hidden')) {
                this.elements.filterDropdown.classList.add('opacity-100', 'translate-y-0');
                this.elements.filterDropdown.classList.remove('opacity-0', '-translate-y-2');
            } else {
                this.elements.filterDropdown.classList.add('opacity-0', '-translate-y-2');
                this.elements.filterDropdown.classList.remove('opacity-100', 'translate-y-0');
            }
        },

        async handleDateFilter(e) {
            e.preventDefault();
            const form = e.target;
            const startDate = form.querySelector('#startDate').value;
            const endDate = form.querySelector('#endDate').value;
            const submitBtn = form.querySelector('button[type="submit"]');

            try {
                // Validasi tanggal
                if (!this.validateDate(startDate)) {
                this.showError('Tanggal mulai tidak valid');
                return;
                }

                if (!this.validateDate(endDate)) {
                this.showError('Tanggal akhir tidak valid');
                return;
                }

                // Validasi rentang tanggal
                if (!this.validateDateRange(startDate, endDate)) {
                this.showError('Rentang tanggal tidak valid');
                return;
                }

                // Proses form jika validasi berhasil
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="inline-flex items-center"><svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memproses...</span>';

                const formData = new FormData(form);
                const response = await this.fetchFilteredData(formData);

                if (response.ok) {
                const data = await response.json();
                this.updateTables(data);
                this.updateMergedPdfButton(formData);
                this.elements.filterDropdown.classList.add('hidden');
                } else {
                throw new Error('Network response was not ok');
                }
            } catch (error) {
                console.error('Error:', error);
                this.showError('Terjadi kesalahan saat memfilter data');
            } finally {
                // Reset button state
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Terapkan Filter';
            }
        },

        validateDate(dateString) {
            const date = new Date(dateString);
            return !isNaN(date.getTime());
        },

        validateDateRange(startDate, endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            return start < end;
        },

        async fetchFilteredData(formData) {
            const params = new URLSearchParams(formData);
            return fetch(`{{ route('filter.hhmd.forms') }}?${params}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
        },

        updateTables(data) {
            if (this.elements.pendingTable) {
                this.elements.pendingTable.innerHTML = this.generateTableRows(data.allHhmdForms.filter(form => form.status === 'pending_supervisor'));
            }

            if (this.elements.allFormsTable) {
                this.elements.allFormsTable.innerHTML = this.generateTableRows(data.passorfailForms);
            }
        },

        generateTableRows(forms) {
            return forms.map(form => {
                const date = new Date(form.testDateTime);
                const formattedDate = date.toLocaleString('id-ID', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                }).replace(',', '');

                return `
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">${formattedDate}</td>
                        <td class="px-6 py-4">${form.location}</td>
                        <td class="px-6 py-4">
                            ${this.generateStatusBadge(form.result)}
                        </td>
                        <td class="px-6 py-4">
                            ${this.generateStatusBadge(form.status)}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="/review/hhmd/${form.id}"
                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                                    Tinjau
                                </a>
                                ${form.can_download_pdf ? this.generatePdfButton(form.id) : ''}
                            </div>
                        </td>
                    </tr>
                `;
            }).join('');
        },

        generateStatusBadge(status) {
            const badges = {
                pass: 'bg-green-100 text-green-800',
                fail: 'bg-red-100 text-red-800',
                pending_supervisor: 'bg-yellow-100 text-yellow-800',
                approved: 'bg-green-100 text-green-800',
                rejected: 'bg-red-100 text-red-800'
            };

            const badgeClass = badges[status.toLowerCase()] || 'bg-gray-100 text-gray-800';
            return `
                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${badgeClass}">
                    ${status.toUpperCase()}
                </span>
            `;
        },

        generatePdfButton(formId) {
            return `
                <a href="/pdf/hhmd/${formId}"
                target="_blank"
                class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-150">
                    <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Unduh PDF
                </a>
            `;
        },

        updateMergedPdfButton(formData) {
            if (!this.elements.mergePdfContainer) return;

            const startDate = formData.get('start_date');
            const endDate = formData.get('end_date');

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('generate.merged.pdf') }}";
            form.className = 'mt-4';

            form.innerHTML = `
                @csrf
                <input type="hidden" name="start_date" value="${startDate}">
                <input type="hidden" name="end_date" value="${endDate}">
                <button type="submit"
                    class="group relative inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-150">
                    <span class="flex items-center">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Unduh PDF Gabungan</span>
                    </span>
                    <span class="absolute opacity-0 group-hover:opacity-100 transition-opacity duration-150 ease-in-out left-1/2 -translate-x-1/2 -top-8 px-2 py-1 bg-gray-900 text-white text-xs rounded">
                        Mengunduh data dari ${startDate} sampai ${endDate}
                    </span>
                </button>
            `;

            form.addEventListener('submit', this.handlePdfGeneration.bind(this));
            this.elements.mergePdfContainer.innerHTML = '';
            this.elements.mergePdfContainer.appendChild(form);
        },

        handlePdfGeneration(e) {
            const button = e.target.querySelector('button');
            const originalContent = button.innerHTML;

            button.disabled = true;
            button.innerHTML = `
                <span class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Menghasilkan PDF...
                </span>
            `;

            // Reset button after 3 seconds (assuming PDF generation is complete)
            setTimeout(() => {
                button.disabled = false;
                button.innerHTML = originalContent;
            }, 3000);
        },

        showError(message) {
            // Create error notification
            const notification = document.createElement('div');
            notification.className = 'fixed bottom-4 right-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-lg transform transition-all duration-300 ease-in-out opacity-0 translate-y-2';
            notification.innerHTML = `
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            // Animate in
            setTimeout(() => {
                notification.classList.remove('opacity-0', 'translate-y-2');
            }, 100);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.classList.add('opacity-0', 'translate-y-2');
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }
    };

    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', () => HHMDForm.init());

    // Add loading state styles
    const style = document.createElement('style');
    style.textContent = `
        .loading-shimmer {
            background: linear-gradient(
                90deg,
                rgba(255,255,255,0) 0%,
                rgba(255,255,255,0.2) 20%,
                rgba(255,255,255,0.5) 60%,
                rgba(255,255,255,0) 100%
            );
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(style);
</script>
@endsection
