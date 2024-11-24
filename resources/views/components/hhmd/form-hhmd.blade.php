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

        <form id="hhmdForm" action="{{ route('submit.hhmd') }}" method="POST" enctype="multipart/form-data" onsubmit="onFormSubmit(event)" class="mt-0">
            @csrf
            <div class="border-2 border-black bg-white shadow">
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-black">
                            <th class="w-1/3 text-left p-2">
                                <label for="operatorName" class="text-gray-700 font-bold">Nama Operator Penerbangan:</label>
                            </th>
                            <td class="w-2/3 p-2">
                                <input type="text" id="operatorName" name="operatorName" class="w-full border rounded px-2 py-1" value="Bandar Udara Adisutjipto Yogyakarta" readonly>
                            </td>
                        </tr>
                        <tr class="border-b border-black">
                            <th class="w-1/3 text-left p-2">
                                <label for="testDateTime" class="text-gray-700 font-bold">Tanggal & Waktu Pengujian:</label>
                            </th>
                            <td class="w-2/3 p-2">
                                <input type="datetime-local" id="testDateTime" name="testDateTime" class="w-full border rounded px-2 py-1" readonly>
                            </td>
                        </tr>
                        <tr class="border-b border-black">
                            <th class="w-1/3 text-left p-2">
                                <label for="location" class="text-gray-700 font-bold">Lokasi Penempatan:</label>
                            </th>
                            <td class="w-2/3 p-2">
                                <select id="location" name="location" class="w-full border rounded px-2 py-1">
                                    <option value="">Pilih Lokasi</option>
                                    <option value="HBSCP">HBSCP</option>
                                    <option value="Pos Timur">Pos Timur</option>
                                    <option value="Pos Barat">Pos Barat</option>
                                    <option value="PSCP Utara">PSCP Utara</option>
                                    <option value="PSCP Selatan">PSCP Selatan</option>
                                    <option value="Pos Kedatangan">Pos Kedatangan</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b border-black">
                            <th class="w-1/3 text-left p-2">
                                <label for="deviceInfo" class="text-gray-700 font-bold">Merk/Tipe/Nomor Seri:</label>
                            </th>
                            <td class="w-2/3 p-2">
                                <input type="text" id="deviceInfo" name="deviceInfo" class="w-full border rounded px-2 py-1">
                            </td>
                        </tr>
                        <tr class="border-b border-black">
                            <th class="w-1/3 text-left p-2">
                                <label for="certificateInfo" class="text-gray-700 font-bold">Nomor dan Tanggal Sertifikat:</label>
                            </th>
                            <td class="w-2/3 p-2">
                                <input type="text" id="certificateInfo" name="certificateInfo" class="w-full border rounded px-2 py-1">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="px-4">
                    <div class="p-2">
                        <div class="mb-0">
                            <label class="inline-flex items-center">
                                <input type="checkbox" id="terpenuhi" name="terpenuhi" class="form-checkbox" value="1" checked>
                                <span class="ml-2 text-sm">Terpenuhi</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" id="tidakterpenuhi" name="tidakterpenuhi" class="form-checkbox" value="1">
                                <span class="ml-2 text-sm">Tidak Terpenuhi</span>
                            </label>
                        </div>
                    </div>
                    <div class="border-x-2 border-t-2 border-black text-center items-center pt-10">
                        <div>
                            <h2 class="font-bold mb-2">TEST 1</h2>
                            <div class="w-20 h-20 mx-auto border-2 border-black flex items-center justify-center">
                                <input type="checkbox" id="test2" name="test2" class="form-checkbox h-5 w-5" onchange="updateResult()" value="1">
                            </div>
                        </div>
                    </div>
                    <div class="border-x-2 border-black pt-10 pb-10">
                        <div class="flex items-center mb-0 pl-4">
                            <input type="checkbox" id="testCondition1" name="testCondition1" class="form-checkbox" value="1" checked>
                            <label for="testCondition1" class="ml-2 text-sm">Letak alat uji OTP dan HHMD pada saat pengujian harus > 1m dari benda logam lain disekelilingnya.</label>
                        </div>
                        <div class="flex items-center mb-0 pl-4">
                            <input type="checkbox" id="testCondition2" name="testCondition2" class="form-checkbox" value="1" checked>
                            <label for="testCondition2" class="ml-2 text-sm">Jarak antara HHMD dan OTP > 3-5 cm.</label>
                        </div>
                    </div>
                </div>

                <div class="border-t-2 border-black p-4">
                    <div class="flex items-start mb-2">
                        <label class="text-gray-700 font-bold mr-4">Hasil:</label>
                        <div class="flex flex-col">
                            <div class="flex items-center mb-0">
                                <input type="radio" id="resultPass" name="result" value="pass" class="form-radio" onclick="document.getElementById('result').value='pass'">
                                <label for="resultPass" class="text-sm ml-2">PASS</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="resultFail" name="result" value="fail" class="form-radio" onclick="document.getElementById('result').value='fail'">
                                <label for="resultFail" class="text-sm ml-2">FAIL</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="notes" class="block text-gray-700 font-bold mb-2">CATATAN:</label>
                        <textarea id="notes" name="notes" class="w-full border rounded px-2 py-1" rows="2"></textarea>
                    </div>
                </div>

                <input type="hidden" id="result" name="result" value="">

                <div class="border-t-2 border-black p-4">
                    <h3 class="text-sm font-bold mb-2">Personel Pengamanan Penerbangan</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="grid grid-rows-2 gap-2 items-center">
                            <!-- Kolom Kiri (Label 1) -->
                            <div class="text-center self-end">
                                <h4 class="font-bold">
                                    @if(Auth::guard('officer')->check())
                                        {{ Auth::guard('officer')->user()->name }}
                                    @else
                                        {{ Auth::user()->name }}
                                    @endif
                                </h4>
                                <input type="hidden" name="officerName" value="{{ Auth::guard('officer')->check() ? Auth::guard('officer')->user()->name : Auth::user()->name }}">
                                <label for="securityOfficerSignature" class="text-gray-700 font-normal">1. Airport Security Officer</label>
                            </div>
                            <div class="text-center self-end">
                                <label for="securitySupervisorSignature" class="text-gray-700 font-normal">2. Airport Security Supervisor</label>
                            </div>
                        </div>
                        <div>
                            <!-- Kolom Kanan (Canvas dan Tombol Clear) -->
                            <div class="flex flex-col items-start">
                                <canvas class="border border-black rounded-md" id="signatureCanvas" width="200" height="100"></canvas>
                                <div class="mt-2 flex items-start">
                                    <button type="button" id="clearSignature" class="bg-slate-200 border border-black text-black px-4 py-2 rounded w-20">Clear</button>
                                    <button type="button" id="saveOfficerSignature" class="bg-slate-200 border border-black text-black px-4 py-2 rounded ml-2 w-20">Save</button>
                                </div>
                                <input type="hidden" name="officer_signature_data" id="officerSignatureData">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="status" value="pending_supervisor">

            <div class="mt-4">
                <div class="mb-4">
                    <label for="supervisor_id" class="block text-gray-700 font-bold mb-2">Pilih Supervisor:</label>
                    <select name="supervisor_id" id="supervisor_id" class="w-full border rounded px-2 py-1" required>
                        <option value="">Pilih Supervisor</option>
                        @foreach(\App\Models\User::where('role', 'supervisor')->get() as $supervisor)
                            <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                        Submit to Approver
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
