@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded px-4 sm:px-8 pt-6 pb-8 mb-4 w-full max-w-full">
        <h1 class="text-xl sm:text-2xl font-bold mb-4">Tinjau Formulir WTMD</h1>

        <div class="bg-white p-4 w-full max-w-full">
            <div id="format" class="mx-auto w-full">
                <div class="border-t-2 border-x-2 border-black bg-white shadow-md p-4">
                    <div class="flex flex-col sm:flex-row items-center justify-between">
                        <img src="{{ asset('images/airport-security-logo.png') }}" alt="Logo"
                            class="w-20 h-20 mb-2 sm:mb-0">
                        <h1 class="text-sm sm:text-xl font-bold text-center flex-grow px-2">
                            CHECK LIST PENGUJIAN HARIAN<br>
                            GAWANG PENDETEKSI LOGAM<br>
                            (WALK THROUGH METAL DETECTOR/WTMD)
                        </h1>
                        <img src="{{ asset('images/injourney-logo.png') }}" alt="Injourney Logo"
                            class="w-20 h-20 mt-2 sm:mt-0">
                    </div>
                </div>

                <div class="border-2 border-black bg-white shadow">
                    <table class="w-full text-xs sm:text-sm">
                        <tbody>
                            <tr class="border-b border-black">
                                <th class="w-1/3 text-left p-1 sm:p-2">Nama Operator Penerbangan:</th>
                                <td class="w-2/3 p-2">{{ $form->operatorName }}</td>
                            </tr>
                            <tr class="border-b border-black">
                                <th class="w-1/3 text-left p-2">Tanggal & Waktu Pengujian:</th>
                                <td class="w-2/3 p-2">{{ date('d-m-Y H:i', strtotime($form->testDateTime)) }}</td>
                            </tr>
                            <tr class="border-b border-black">
                                <th class="w-1/3 text-left p-2">Lokasi Penempatan:</th>
                                <td class="w-2/3 p-2">{{ $form->location }}</td>
                            </tr>
                            <tr class="border-b border-black">
                                <th class="w-1/3 text-left p-2">Merk/Tipe/Nomor Seri:</th>
                                <td class="w-2/3 p-2">{{ $form->deviceInfo }}</td>
                            </tr>
                            <tr class="border-b border-black">
                                <th class="w-1/3 text-left p-2">Nomor dan Tanggal Sertifikat:</th>
                                <td class="w-2/3 p-2">{{ $form->certificateInfo }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="px-4">
                        <div class="p-2">
                            <div class="mb-0">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" {{ $form->terpenuhi ? 'checked' : '' }} disabled>
                                    <span class="ml-2 text-sm">Terpenuhi</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" {{ $form->tidakterpenuhi ? 'checked' : '' }} disabled>
                                    <span class="ml-2 text-sm">Tidak Terpenuhi</span>
                                </label>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 border-x-2 border-t-2 border-black text-center items-center">
                            <div class="relative">
                                <div>
                                    <img src="{{asset('images/tampakdepan.png')}}" alt="tampakdepan"
                                        class="w-full scale-75">
                                    <p class="text-sm font-semibold pb-20">DEPAN</p>
                                </div>

                                <div class="absolute inset-0 flex flex-col items-start pt-44 pointer-events-auto">
                                    <div class="mb-1">
                                        <div class="flex items-center gap-1">
                                            <div class="flex flex-col gap-2">
                                                <div class="flex items-center gap-1 pl-2.5">
                                                    <span class="text-[10px]">IN</span>
                                                    <input type="checkbox" {{$form->test1_in_depan ? 'checked' : '' }} disabled>
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    <span class="text-[10px]">OUT</span>
                                                    <input type="checkbox" {{$form->test1_out_depan ? 'checked' : '' }} disabled>
                                                </div>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                            <span class="text-xs font-bold">TEST 1</span>
                                        </div>
                                    </div>

                                    <div class="mb-28">
                                        <div class="flex items-center gap-1">
                                            <div class="flex flex-col gap-2">
                                                <div class="flex items-center gap-1 pl-2.5">
                                                    <span class="text-[10px]">IN</span>
                                                    <input type="checkbox" {{$form->test2_in_depan ? 'checked' : '' }} disabled>
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    <span class="text-[10px]">OUT</span>
                                                    <input type="checkbox" {{$form->test2_out_depan ? 'checked' : '' }} disabled>
                                                </div>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                            <span class="text-xs font-bold">TEST 2</span>
                                        </div>
                                    </div>

                                    <div class="mb-8">
                                        <div class="flex items-center gap-1">
                                            <div class="flex flex-col gap-2">
                                                <div class="flex items-center gap-1 pl-2.5">
                                                    <span class="text-[10px]">IN</span>
                                                    <input type="checkbox" {{$form->test4_in_depan ? 'checked' : '' }} disabled>
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    <span class="text-[10px]">OUT</span>
                                                    <input type="checkbox" {{$form->test4_out_depan ? 'checked' : '' }} disabled>
                                                </div>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                            <span class="text-xs font-bold">TEST 4</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="relative">
                                <div>
                                    <img src="{{asset('images/tampakbelakang.png')}}" alt="tampakbelakang"
                                        class="w-full scale-75">
                                    <p class="text-sm font-semibold pb-20">BELAKANG</p>
                                </div>

                                <div class="absolute inset-0 flex flex-col items-end pr-2 pt-4 pointer-events-auto">
                                    <div class="mt-52">
                                        <div class="flex items-center gap-1">
                                            <span class="text-xs font-bold">TEST 3</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 rotate-180"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                            <div class="flex flex-col gap-2">
                                                <div class="flex items-center gap-1 pr-2.5">
                                                    <input type="checkbox" {{$form->test3_in_belakang ? 'checked' : '' }} disabled>
                                                    <span class="text-[10px]">IN</span>
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    <input type="checkbox" {{$form->test3_out_belakang ? 'checked' : '' }} disabled>
                                                    <span class="text-[10px]">OUT</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-t-2 border-black p-4">
                        <div class="flex items-start mb-2">
                            <label class="text-gray-700 font-bold mr-4">Hasil:</label>
                            <div class="flex flex-col">
                                <div class="flex items-center mb-0">
                                    <input type="radio" {{ $form->result == 'pass' ? 'checked' : '' }} disabled>
                                    <label class="text-sm ml-2">PASS</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" {{ $form->result == 'fail' ? 'checked' : '' }} disabled>
                                    <label class="text-sm ml-2">FAIL</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="notes" class="block text-gray-700 font-bold mb-2">CATATAN:</label>
                            <p>{{ $form->notes }}</p>
                        </div>
                    </div>

                    <div class="border-t-2 border-black p-2 sm:p-4">
                        <h3 class="text-xs sm:text-sm font-bold mb-2">Personel Pengamanan Penerbangan</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-4">
                            <div class="grid grid-rows-2 gap-1 sm:gap-2 items-center text-center">
                                <!-- Kolom Kiri (Label 1) -->
                                <div class="text-center self-end">
                                    <h4 class="font-bold">{{ $form->officerName }}</h4>
                                    <label class="text-gray-700 font-normal text-xs sm:text-sm">1. Airport Security Officer</label>
                                </div>
                                <div class="text-center self-end">
                                    <h4 class="font-bold">
                                        @if($supervisor)
                                            {{ $supervisor->name }}
                                        @else
                                            Nama Supervisor tidak tersedia
                                        @endif
                                    </h4>
                                    <label class="text-gray-700 font-normal text-xs sm:text-sm">2. Airport Security Supervisor</label>
                                </div>
                            </div>
                            <div>
                                <!-- Kolom Kanan (Canvas dan Tombol Clear) -->
                                <div class="flex flex-col items-center">
                                    @if($form->officer_signature)
                                        <img src="{{ $form->officer_signature }}" alt="Tanda tangan Officer" class="max-w-full h-auto">
                                    @else
                                        <p class="text-xs sm:text-sm">Tanda tangan Officer tidak tersedia</p>
                                    @endif
                                </div>
                                <div class="flex flex-col items-center mt-2 sm:mt-4">
                                    @if($form->supervisor_signature)
                                        <img src="{{ $form->supervisor_signature }}" alt="Tanda tangan Supervisor" id="supervisorSignatureImage" class="max-w-full h-auto">
                                    @else
                                        <p class="text-xs sm:text-sm">Tanda tangan Supervisor tidak tersedia</p>
                                    @endif
                                </div>
                                @if(!$form->supervisor_signature)
                                <div class="flex flex-col items-center mt-2 sm:mt-4" id="signatureContainer">
                                    <h3 class="text-xs sm:text-sm font-bold mb-2">Tanda Tangan Supervisor</h3>
                                    <canvas id="signatureCanvas" class="border border-black rounded-md w-full" width="300" height="150"></canvas>
                                    <div class="mt-2 flex justify-start space-x-2">
                                        <button type="button" id="clearSignature" class="bg-slate-200 border border-black text-black px-2 py-1 sm:px-4 sm:py-2 rounded text-xs sm:text-base">Clear</button>
                                        <button type="button" id="saveSupervisorSignature" class="bg-slate-200 border border-black text-black px-2 py-1 sm:px-4 sm:py-2 rounded text-xs sm:text-base">Save</button>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('wtmd.updateStatus', $form->id) }}" method="POST" class="mt-2 sm:mt-4">
                    @csrf
                    @method('PATCH')
                    <div class="mb-2 sm:mb-4">
                        <label class="block text-gray-700 text-xs sm:text-sm font-bold mb-1 sm:mb-2" for="status">
                            Status
                        </label>
                        <select name="status" id="status" class="w-full border rounded px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-base">
                            <option value="approved">Setujui</option>
                            <option value="rejected">Tolak</option>
                        </select>
                    </div>

                    <div id="rejectionNoteContainer" class="mb-4 hidden">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="rejection_note">
                            Catatan Penolakan
                        </label>
                        <textarea
                            name="rejection_note"
                            id="rejection_note"
                            rows="4"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Masukkan alasan penolakan..."
                        ></textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-2 py-1 sm:px-4 sm:py-2 rounded text-xs sm:text-base" type="submit">
                            Perbarui Status
                        </button>
                        <a href="{{ route('dashboard') }}" class="text-xs sm:text-sm font-bold text-blue-500 hover:text-blue-800">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('status');
        const rejectionNoteContainer = document.getElementById('rejectionNoteContainer');
        const rejectionNoteTextarea = document.getElementById('rejection_note');

        statusSelect.addEventListener('change', function() {
            if (this.value === 'rejected') {
                rejectionNoteContainer.classList.remove('hidden');
                // Tambahkan validasi bahwa catatan harus diisi
                rejectionNoteTextarea.setAttribute('required', 'required');
            } else {
                rejectionNoteContainer.classList.add('hidden');
                rejectionNoteTextarea.removeAttribute('required');
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('signatureCanvas');
        const ctx = canvas.getContext('2d');
        let isDrawing = false;
        let lastX = 0;
        let lastY = 0;

        // Touch events untuk mobile
        canvas.addEventListener('touchstart', handleTouchStart, { passive: false });
        canvas.addEventListener('touchmove', handleTouchMove, { passive: false });
        canvas.addEventListener('touchend', stopDrawing);

        // Mouse events untuk desktop
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        document.getElementById('clearSignature').addEventListener('click', clearCanvas);
        document.getElementById('saveSupervisorSignature').addEventListener('click', saveSupervisorSignature);

        function handleTouchStart(e) {
            e.preventDefault();
            const touch = e.touches[0];
            const rect = canvas.getBoundingClientRect();
            lastX = touch.clientX - rect.left;
            lastY = touch.clientY - rect.top;
            isDrawing = true;
        }

        function handleTouchMove(e) {
            e.preventDefault();
            if (!isDrawing) return;

            const touch = e.touches[0];
            const rect = canvas.getBoundingClientRect();
            const currentX = touch.clientX - rect.left;
            const currentY = touch.clientY - rect.top;

            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.strokeStyle = '#000';

            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(currentX, currentY);
            ctx.stroke();

            lastX = currentX;
            lastY = currentY;
        }

        function startDrawing(e) {
            isDrawing = true;
            const rect = canvas.getBoundingClientRect();
            lastX = e.clientX - rect.left;
            lastY = e.clientY - rect.top;
        }

        function draw(e) {
            if (!isDrawing) return;

            const rect = canvas.getBoundingClientRect();
            const currentX = e.clientX - rect.left;
            const currentY = e.clientY - rect.top;

            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.strokeStyle = '#000';

            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(currentX, currentY);
            ctx.stroke();

            lastX = currentX;
            lastY = currentY;
        }

        function stopDrawing() {
            isDrawing = false;
            ctx.beginPath();
        }

        function clearCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }

        function saveSupervisorSignature() {
            const supervisorSignatureData = canvas.toDataURL('image/png');

            // Menampilkan tanda tangan yang disimpan
            const signatureContainer = document.getElementById('signatureContainer');
            signatureContainer.innerHTML = `
                <h3 class="text-xs sm:text-sm font-bold mb-2">Tanda Tangan Supervisor</h3>
                <img src="${supervisorSignatureData}" alt="Tanda tangan Supervisor" id="supervisorSignatureImage" class="max-w-full h-auto">
            `;

            // Mengirim data tanda tangan ke server
            fetch('{{ route("wtmd.saveSupervisorSignature", $form->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ signature: supervisorSignatureData })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Tanda tangan berhasil disimpan');
                    // Refresh halaman atau update UI sesuai kebutuhan
                } else {
                    alert('Gagal menyimpan tanda tangan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan tanda tangan');
            });
        }

        // Menyesuaikan ukuran canvas saat resize window
        function resizeCanvas() {
            const container = canvas.parentElement;
            canvas.width = container.offsetWidth;
            canvas.height = 150; // atau sesuaikan dengan kebutuhan

            // Setel ulang properti context setelah resize
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.strokeStyle = '#000';
        }

        // Panggil resizeCanvas saat halaman dimuat dan saat window di-resize
        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);
    });
</script>
@endsection
