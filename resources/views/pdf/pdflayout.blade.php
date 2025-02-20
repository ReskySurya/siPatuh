@extends('layouts.app')

@section('content')
<div class="container mx-auto px-2 py-4 sm:px-4 sm:py-8">
    <div class="bg-white shadow-md rounded-lg p-4 sm:p-6">
        <h1 class="text-xl sm:text-2xl font-bold mb-4">Export PDF Form</h1>

        <!-- Filter Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <!-- Form Type Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Form</label>
                <select id="formType" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Pilih Jenis Form</option>
                    <option value="hhmd">Form HHMD</option>
                    <option value="wtmd">Form WTMD</option>
                    <option value="xray_bagasi">Form X-Ray Bagasi</option>
                    <option value="xray_cabin">Form X-Ray Cabin</option>
                </select>
            </div>

            <!-- Location Selection (akan muncul sesuai form type) -->
            <div id="locationContainer" class="hidden">
                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                <select id="location" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Pilih Lokasi</option>
                </select>
            </div>
        </div>

        <!-- Date Range Filter -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                <input type="date" id="startDate" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
                <input type="date" id="endDate" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
        </div>

        <!-- Preview Table -->
        <div class="overflow-x-auto mb-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider max-w-[60px] truncate">Lokasi</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        {{-- <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Officer</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supervisor</th> --}}
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="previewTable">
                    <!-- Data will be populated here -->
                </tbody>
            </table>
        </div>

        <!-- Export Buttons -->
        <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-4">
            <button id="previewBtn" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">
                Preview Data
            </button>
            <button id="exportSelectedBtn" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition-colors">
                Export Selected
            </button>
            <button id="exportAllBtn" class="bg-purple-500 text-white px-4 py-2 rounded-md hover:bg-purple-600 transition-colors">
                Export All
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const formTypeSelect = document.getElementById('formType');
    const locationContainer = document.getElementById('locationContainer');
    const locationSelect = document.getElementById('location');

    const locations = {
        hhmd: [
            'Pos Kedatangan',
            'HBSCP',
            'Pos Timur',
            'Pos Barat',
            'PSCP Utara',
            'PSCP Selatan'
        ],
        wtmd: [
            'Pos Timur',
            'PSCP Utara',
            'PSCP Selatan'
        ],
        xray_bagasi: [
            'HBSCP Bagasi Timur',
            'HBSCP Bagasi Barat'
        ],
        xray_cabin: [
            'PSCP Cabin Utara',
            'PSCP Cabin Selatan'
        ]
    };

    formTypeSelect.addEventListener('change', function() {
        const selectedType = this.value;
        if (selectedType) {
            locationContainer.classList.remove('hidden');
            // Clear existing options
            locationSelect.innerHTML = '<option value="">Pilih Lokasi</option>';

            // Add new options based on form type
            locations[selectedType].forEach(location => {
                const option = document.createElement('option');
                option.value = location;
                option.textContent = location;
                locationSelect.appendChild(option);
            });
        } else {
            locationContainer.classList.add('hidden');
        }
    });

    // Preview button click handler
    document.getElementById('previewBtn').addEventListener('click', function() {
        const formType = formTypeSelect.value;
        const location = locationSelect.value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        if (!formType || !location || !startDate || !endDate) {
            alert('Mohon lengkapi semua filter terlebih dahulu');
            return;
        }

        // Fetch preview data
        fetch(`/preview-pdf-data?formType=${formType}&location=${location}&startDate=${startDate}&endDate=${endDate}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                updatePreviewTable(data);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memuat data preview');
            });
    });

    // Export Selected button click handler
    document.getElementById('exportSelectedBtn').addEventListener('click', function() {
        const selectedCheckboxes = document.querySelectorAll('#previewTable input[type="checkbox"]:checked');
        const selectedIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.value);

        if (selectedIds.length === 0) {
            alert('Pilih minimal satu form untuk di-export');
            return;
        }

        exportPDF('/export-selected-pdf', {
            selectedIds: JSON.stringify(selectedIds),
            formType: formTypeSelect.value,
            location: locationSelect.value,
            startDate: document.getElementById('startDate').value,
            endDate: document.getElementById('endDate').value
        });
    });

    // Export All button click handler
    document.getElementById('exportAllBtn').addEventListener('click', function() {
        const formType = formTypeSelect.value;
        const location = locationSelect.value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        if (!formType || !location || !startDate || !endDate) {
            alert('Mohon lengkapi semua filter terlebih dahulu');
            return;
        }

        exportPDF('/export-all-pdf', {
            formType: formType,
            location: location,
            startDate: startDate,
            endDate: endDate
        });
    });

    // Fungsi untuk handle PDF export
    function exportPDF(url, data) {
        const formData = new FormData();
        for (const [key, value] of Object.entries(data)) {
            formData.append(key, value);
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        formData.append('_token', csrfToken);

        // Show loading indicator
        const loadingOverlay = document.createElement('div');
        loadingOverlay.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
        loadingOverlay.innerHTML = '<div class="bg-white p-4 rounded">Generating PDF...</div>';
        document.body.appendChild(loadingOverlay);

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => Promise.reject(err));
            }
            return response.blob().then(blob => {
                // Get filename from Content-Disposition header
                const contentDisposition = response.headers.get('Content-Disposition');
                let filename = 'document.pdf';
                if (contentDisposition) {
                    const matches = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/.exec(contentDisposition);
                    if (matches != null && matches[1]) {
                        filename = matches[1].replace(/['"]/g, '');
                    }
                }
                return { blob, filename };
            });
        })
        .then(({ blob, filename }) => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = filename; // Gunakan filename dari response header
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            a.remove();
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.error || 'Terjadi kesalahan saat mengexport PDF');
        })
        .finally(() => {
            // Remove loading overlay
            document.body.removeChild(loadingOverlay);
        });
    }
});

function updatePreviewTable(data) {
    const tbody = document.getElementById('previewTable');
    tbody.innerHTML = '';

    if (data.length === 0) {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500" colspan="4">Tidak Ada Form</td>
        `;
        tbody.appendChild(row);
    } else {
        data.forEach(item => {
            // Format tanggal menggunakan JavaScript
            const date = new Date(item.testDateTime);
            const formattedDate = date.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            }).replace(',', '');

            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${formattedDate}</td>
                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 max-w-[60px] truncate">${item.location}</td>
                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">${item.status}</td>
                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600" value="${item.id}">
                </td>
            `;
            tbody.appendChild(row);
        });
    }
}
</script>
@endpush
@endsection
