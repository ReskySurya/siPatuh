<div class="bg-white p-4 w-full max-w-full">
    <div id="format" class="mx-auto w-full">
        <div class="border-t-2 border-x-2 border-black bg-white shadow-md p-4">
            <div class="flex flex-col sm:flex-row items-center justify-between">
                <img src="{{ asset('images/airport-security-logo.png') }}" alt="Logo" class="w-20 h-20 mb-2 sm:mb-0">
                <h1 class="text-sm sm:text-xl font-bold text-center flex-grow px-2">
                    CHECK LIST PENGUJIAN HARIAN<br>
                    GAWANG PENDETEKSI LOGAM<br>
                    (WALK THROUGH METAL DETECTOR/WTMD)
                </h1>
                <img src="{{ asset('images/injourney-logo.png') }}" alt="Injourney Logo" class="w-20 h-20 mt-2 sm:mt-0">
            </div>
        </div>

        <form id="wtmdForm" action="{{ route('submit.wtmd') }}" method="POST" enctype="multipart/form-data"
            onsubmit="onFormSubmit(event)" class="mt-0">
            @csrf
            <div class="border-2 border-black bg-white shadow">
                <table class="w-full text-xs sm:text-sm">
                    <tbody>
                        <tr class="border-b border-black">
                            <th class="w-1/3 text-left p-1 sm:p-2">
                                <label for="operatorName" class="text-gray-700 font-bold">Nama Operator
                                    Penerbangan:</label>
                            </th>
                            <td class="w-2/3 p-2">
                                <input type="text" id="operatorName" name="operatorName"
                                    class="w-full border rounded px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-base"
                                    value="Bandar Udara Adisutjipto Yogyakarta" readonly>
                            </td>
                        </tr>
                        <tr class="border-b border-black">
                            <th class="w-1/3 text-left p-1 sm:p-2">
                                <label for="testDateTime" class="text-gray-700 font-bold">Tanggal & Waktu
                                    Pengujian:</label>
                            </th>
                            <td class="w-2/3 p-2">
                                <input type="datetime-local" id="testDateTime" name="testDateTime"
                                    class="w-full border rounded px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-base"
                                    readonly>
                            </td>
                        </tr>
                        <tr class="border-b border-black">
                            <th class="w-1/3 text-left p-1 sm:p-2">
                                <label for="location" class="text-gray-700 font-bold">Lokasi Penempatan:</label>
                            </th>
                            <td class="w-2/3 p-2">
                                <select id="location" name="location"
                                    class="w-full border rounded px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-base">
                                    <option value="">Pilih Lokasi</option>
                                    <option value="Pos Timur">Pos Timur</option>
                                    <option value="PSCP Utara">PSCP Utara</option>
                                    <option value="PSCP Selatan">PSCP Selatan</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b border-black">
                            <th class="w-1/3 text-left p-1 sm:p-2">
                                <label for="deviceInfo" class="text-gray-700 font-bold">Merk/Tipe/Nomor Seri:</label>
                            </th>
                            <td class="w-2/3 p-2">
                                <input type="text" id="deviceInfo" name="deviceInfo"
                                    class="w-full border rounded px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-base">
                            </td>
                        </tr>
                        <tr class="border-b border-black">
                            <th class="w-1/3 text-left p-1 sm:p-2">
                                <label for="certificateInfo" class="text-gray-700 font-bold">Nomor dan Tanggal
                                    Sertifikat:</label>
                            </th>
                            <td class="w-2/3 p-2">
                                <input type="text" id="certificateInfo" name="certificateInfo"
                                    class="w-full border rounded px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-base">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="px-4">
                    <div class="p-2">
                        <div class="mb-0">
                            <label class="inline-flex items-center">
                                <input type="checkbox" id="terpenuhi" name="terpenuhi" class="form-checkbox" value="1"
                                    checked>
                                <span class="ml-2 text-sm">Terpenuhi</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" id="tidakterpenuhi" name="tidakterpenuhi" class="form-checkbox"
                                    value="1">
                                <span class="ml-2 text-sm">Tidak Terpenuhi</span>
                            </label>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 border-x-2 border-t-2 border-black text-center items-center">
                        <div class="relative">
                            <div>
                                <img src="{{asset('images/tampakdepan.png')}}" alt="tampakdepan" class="w-full scale-75">
                                <p class="text-sm font-semibold pb-20">DEPAN</p>
                            </div>

                            <div class="absolute inset-0 flex flex-col items-start pt-44 pointer-events-auto">
                                <div class="mb-1">
                                    <div class="flex items-center gap-1">
                                        <div class="flex flex-col gap-2">
                                            <div class="flex items-center gap-1 pl-2.5">
                                                <span class="text-[10px]">IN</span>
                                                <input type="checkbox" name="test1_in_depan" id="test1_in_depan" class="form-checkbox h-4 w-4 bg-white" value="1">
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <span class="text-[10px]">OUT</span>
                                                <input type="checkbox" name="test1_out_depan" id="test1_out_depan" class="form-checkbox h-4 w-4 bg-white" value="1">
                                            </div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                        <span class="text-xs font-bold">TEST 1</span>
                                    </div>
                                </div>

                                <div class="mb-28">
                                    <div class="flex items-center gap-1">
                                        <div class="flex flex-col gap-2">
                                            <div class="flex items-center gap-1 pl-2.5">
                                                <span class="text-[10px]">IN</span>
                                                <input type="checkbox" name="test2_in_depan" id="test2_in_depan" class="form-checkbox h-4 w-4 bg-white" value="1">
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <span class="text-[10px]">OUT</span>
                                                <input type="checkbox" name="test2_out_depan" id="test2_out_depan" class="form-checkbox h-4 w-4 bg-white" value="1">
                                            </div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                        <span class="text-xs font-bold">TEST 2</span>
                                    </div>
                                </div>

                                <div class="mb-8">
                                    <div class="flex items-center gap-1">
                                        <div class="flex flex-col gap-2">
                                            <div class="flex items-center gap-1 pl-2.5">
                                                <span class="text-[10px]">IN</span>
                                                <input type="checkbox" name="test4_in_depan" id="test4_in_depan" class="form-checkbox h-4 w-4 bg-white" value="1">
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <span class="text-[10px]">OUT</span>
                                                <input type="checkbox" name="test4_out_depan" id="test4_out_depan" class="form-checkbox h-4 w-4 bg-white" value="1">
                                            </div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                        <span class="text-xs font-bold">TEST 4</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="relative">
                            <div>
                                <img src="{{asset('images/tampakbelakang.png')}}" alt="tampakbelakang" class="w-full scale-75">
                                <p class="text-sm font-semibold pb-20">BELAKANG</p>
                            </div>

                            <div class="absolute inset-0 flex flex-col items-end pr-2 pt-4 pointer-events-auto">
                                <div class="mt-52">
                                    <div class="flex items-center gap-1">
                                        <span class="text-xs font-bold">TEST 3</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                        <div class="flex flex-col gap-2">
                                            <div class="flex items-center gap-1 pr-2.5">
                                                <input type="checkbox" name="test3_in_belakang" id="test3_in_belakang" class="form-checkbox h-4 w-4 bg-white" value="1">
                                                <span class="text-[10px]">IN</span>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <input type="checkbox" name="test3_out_belakang" id="test3_out_belakang" class="form-checkbox h-4 w-4 bg-white" value="1">
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
                                <input type="radio" id="resultPass" name="result" value="pass" class="form-radio"
                                    onclick="document.getElementById('result').value='pass'">
                                <label for="resultPass" class="text-sm ml-2">PASS</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="resultFail" name="result" value="fail" class="form-radio"
                                    onclick="document.getElementById('result').value='fail'">
                                <label for="resultFail" class="text-sm ml-2">FAIL</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="notes" class="block text-gray-700 font-bold mb-2">CATATAN:</label>
                        <textarea id="notes" name="notes"
                            class="w-full border rounded px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-base"
                            rows="2"></textarea>
                    </div>
                </div>

                <input type="hidden" id="result" name="result" value="">

                <div class="border-t-2 border-black p-2 sm:p-4">
                    <h3 class="text-xs sm:text-sm font-bold mb-2">Personel Pengamanan Penerbangan</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-4">
                        <div class="grid grid-rows-2 gap-1 sm:gap-2 items-center text-center">
                            <!-- Kolom Kiri (Label 1) -->
                            <div class="text-center self-end">
                                <h4 class="font-bold">
                                    @if(Auth::guard('officer')->check())
                                    {{ Auth::guard('officer')->user()->name }}
                                    @else
                                    {{ Auth::user()->name }}
                                    @endif
                                </h4>
                                <input type="hidden" name="officerName"
                                    value="{{ Auth::guard('officer')->check() ? Auth::guard('officer')->user()->name : Auth::user()->name }}">
                                <label for="securityOfficerSignature" class="text-gray-700 font-normal">1. Airport
                                    Security Officer</label>
                            </div>
                            <div class="text-center self-end">
                                <label for="securitySupervisorSignature" class="text-gray-700 font-normal">2. Airport
                                    Security Supervisor</label>
                            </div>
                        </div>
                        <div>
                            <!-- Kolom Kanan (Canvas dan Tombol Clear) -->
                            <div>
                                <canvas class="border border-black rounded-md w-full" id="signatureCanvas" width="300"
                                    height="150"></canvas>
                                <div class="mt-2 flex justify-start space-x-2">
                                    <button type="button" id="clearSignature"
                                        class="bg-slate-200 border border-black text-black px-2 py-1 sm:px-4 sm:py-2 rounded text-xs sm:text-base">Clear</button>
                                    <button type="button" id="saveOfficerSignature"
                                        class="bg-slate-200 border border-black text-black px-2 py-1 sm:px-4 sm:py-2 rounded text-xs sm:text-base">Save</button>
                                </div>
                                <input type="hidden" name="officer_signature_data" id="officerSignatureData">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="status" value="pending_supervisor">

            <div class="mt-2 sm:mt-4 px-2 sm:px-0">
                <div class="mb-2 sm:mb-4">
                    <label for="supervisor_id"
                        class="block text-gray-700 font-bold text-xs sm:text-base mb-1 sm:mb-2">Pilih
                        Supervisor:</label>
                    <select name="supervisor_id" id="supervisor_id"
                        class="w-full border rounded px-1 py-1 sm:px-2 sm:py-1 text-xs sm:text-base" required>
                        <option value="">Pilih Supervisor</option>
                        @foreach(\App\Models\User::where('role', 'supervisor')->get() as $supervisor)
                        <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-2 py-1 sm:px-4 sm:py-2 rounded text-xs sm:text-base"
                        type="submit">
                        Submit to Approver
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
