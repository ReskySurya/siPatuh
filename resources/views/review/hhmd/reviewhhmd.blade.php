@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md w-fit rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-2xl font-bold mb-4">Tinjau Formulir HHMD</h1>

        <div class="bg-white p-4" style="width: 210mm; min-height: 297mm;">
            <div id="format" class="mx-auto">
                <div class="border-t-2 border-x-2 border-black bg-white shadow-md p-4">
                    <div class="flex items-center justify-between">
                        <img src="{{ asset('images/airport-security-logo.png') }}" alt="Logo" class="w-20 h-20">
                        <h1 class="text-xl font-bold text-center flex-grow px-2">
                            CHECK LIST PENGUJIAN HARIAN<br>
                            PENDETEKSI LOGAM GENGGAM<br>
                            (HAND HELD METAL DETECTOR/HHMD)<br>
                            PADA KONDISI NORMAL (HIJAU)

                        </h1>
                        <img src="https://via.placeholder.com/80x80" alt="Additional Logo" class="w-20 h-20">
                    </div>
                </div>

                <div class="border-2 border-black bg-white shadow">
                    <table class="w-full text-sm">
                        <tbody>
                            <tr class="border-b border-black">
                                <th class="w-1/3 text-left p-2">Nama Operator Penerbangan:</th>
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
                        <div class="border-x-2 border-t-2 border-black text-center items-center pt-10">
                            <div>
                                <h2 class="font-bold mb-2">TEST 1</h2>
                                <div class="w-20 h-20 mx-auto border-2 border-black flex items-center justify-center">
                                    <input type="checkbox" {{ $form->test2 ? 'checked' : '' }} disabled>
                                </div>
                            </div>
                        </div>

                        <div class="border-x-2 border-black pt-10 pb-10">
                            <div class="flex items-center mb-0 pl-4">
                                <input type="checkbox" {{ $form->testCondition1 ? 'checked' : '' }} disabled>
                                <label class="ml-2 text-sm">Letak alat uji OTP dan HHMD pada saat pengujian harus > 1m dari benda logam lain disekelilingnya.</label>
                            </div>
                            <div class="flex items-center mb-0 pl-4">
                                <input type="checkbox" {{ $form->testCondition2 ? 'checked' : '' }} disabled>
                                <label class="ml-2 text-sm">Jarak antara HHMD dan OTP > 3-5 cm.</label>
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
                            <label class="block text-gray-700 font-bold mb-2">CATATAN:</label>
                            <p>{{ $form->notes }}</p>
                        </div>
                    </div>

                    <div class="border-t-2 border-black p-4">
                        <h3 class="text-sm font-bold mb-2">Personel Pengamanan Penerbangan</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="grid grid-rows-2 gap-2 items-center">
                                <div class="text-center self-end">
                                    <h4 class="font-bold">{{ $form->officerName }}</h4>
                                    <label class="text-gray-700 font-normal">1. Airport Security Officer</label>
                                </div>
                                <div class="text-center self-end">
                                    <h4 class="font-bold">
                                        @if($supervisor)
                                            {{ $supervisor->name }}
                                        @else
                                            Nama Supervisor tidak tersedia
                                        @endif
                                    </h4>
                                    <label class="text-gray-700 font-normal">2. Airport Security Supervisor</label>
                                </div>
                            </div>
                            <div>
                                <div class="flex flex-col items-center">
                                    @if($form->officer_signature)
                                        <img src="{{ $form->officer_signature }}" alt="Tanda tangan Officer">
                                    @else
                                        <p>Tanda tangan Officer tidak tersedia</p>
                                    @endif
                                </div>
                                <div class="flex flex-col items-center">
                                    @if($form->supervisor_signature)
                                        <img src="{{ $form->supervisor_signature }}" alt="Tanda tangan Supervisor" id="supervisorSignatureImage">
                                    @else
                                        <p>Tanda tangan Supervisor tidak tersedia</p>
                                    @endif
                                </div>
                                <!-- Canvas untuk Tanda Tangan Supervisor -->
                                @if(!$form->supervisor_signature)
                                <div class="flex flex-col items-center mt-4" id="signatureContainer">
                                    <h3 class="text-sm font-bold mb-2">Tanda Tangan Supervisor</h3>
                                    <canvas id="signatureCanvas" width="300" height="150" style="border: 1px solid #000;"></canvas>
                                    <div class="mt-2">
                                        <button type="button" id="clearSignature" class="bg-red-500 text-white px-4 py-2 rounded">Clear</button>
                                        <button type="button" id="saveSupervisorSignature" class="bg-green-500 text-white px-4 py-2 rounded ml-2">Save</button>
                                    </div>
                                    <input type="hidden" name="supervisor_signature_data" id="supervisorSignatureData">
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('hhmd.updateStatus', $form->id) }}" method="POST" class="mt-4">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                    Status
                </label>
                <select name="status" id="status" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Perbarui Status
                </button>
                <a href="{{ route('dashboard') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Kembali ke Dashboard
                </a>
            </div>
        </form>
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
        let lastX = 0; // Menyimpan posisi X terakhir
        let lastY = 0; // Menyimpan posisi Y terakhir

        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        document.getElementById('clearSignature').addEventListener('click', clearCanvas);
        document.getElementById('saveSupervisorSignature').addEventListener('click', saveSupervisorSignature);

        function startDrawing(e) {
            isDrawing = true;
            [lastX, lastY] = [e.offsetX, e.offsetY]; // Menggunakan offsetX dan offsetY
            draw(e);
        }

        function draw(e) {
            if (!isDrawing) return;
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.strokeStyle = '#000';

            ctx.beginPath();
            ctx.moveTo(lastX, lastY); // Menggunakan posisi terakhir
            ctx.lineTo(e.offsetX, e.offsetY); // Menggunakan offsetX dan offsetY
            ctx.stroke();
            [lastX, lastY] = [e.offsetX, e.offsetY]; // Memperbarui posisi terakhir
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
            document.getElementById('supervisorSignatureData').value = supervisorSignatureData;

            // Menampilkan tanda tangan yang disimpan
            const signatureContainer = document.getElementById('signatureContainer');
            signatureContainer.innerHTML = `
                <h3 class="text-sm font-bold mb-2">Tanda Tangan Supervisor</h3>
                <img src="${supervisorSignatureData}" alt="Tanda tangan Supervisor" id="supervisorSignatureImage">
            `;

            // Mengirim data tanda tangan ke server
            fetch('{{ route("hhmd.saveSupervisorSignature", $form->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ signature: supervisorSignatureData })
            })
        }
    });
</script>
@endsection
