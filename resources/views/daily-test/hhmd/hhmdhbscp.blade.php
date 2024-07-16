@extends('layouts.app')

@section('content')
<div class="bg-gray-100 px-64">
    <div class="bg-white flex items-center justify-center py-12">
        <div class="max-w-4xl mx-auto">
            <div class="border-2 border-black bg-white shadow-md px-6 pt-6 pb-4">
                <div class="flex items-center">
                    <img src= "{{ asset('images/airport-security-logo.png') }}" alt="Logo" class="w-28 h-28 mr-4">
                    <h1 class="text-2xl font-bold text-center flex-grow">
                        CHECK LIST PENGUJIAN HARIAN<br>
                        PENDETEKSI LOGAM GENGGAM<br>
                        (HAND HELD METAL DETECTOR/HHMD)
                    </h1>
                    <img src="https://via.placeholder.com/170x78" alt="Additional Logo" class="w-44 h-20">
                </div>
            </div>

            <form id="hhmdForm" action="{{ route('submit-form') }}" method="POST">
                <div class="border-x-2 border-b-2 border-black bg-white shadow">
                    <table class="w-full">
                        <tbody>
                            <tr class="border-b-2 border-black">
                                <th class="w-1/3 text-left">
                                    <label for="operatorName" class="text-gray-700 text-sm font-bold m-3">Nama Operator Penerbangan:</label>
                                </th>
                                <td class="w-2/3">
                                    <input type="text" id="operatorName" name="operatorName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </td>
                            </tr>
                            <tr class="border-b-2 border-black">
                                <th class="w-1/3 text-left ">
                                    <label for="testDateTime" class="text-gray-700 text-sm font-bold m-3">Tanggal & Waktu Pengujian:</label>
                                </th>
                                <td class="w-2/3">
                                    <input type="datetime-local" id="testDateTime" name="testDateTime"
                                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline cursor-not-allowed"
                                           value="" readonly>
                                </td>
                            </tr>
                            <tr class="border-b-2 border-black">
                                <th class="w-1/3 text-left ">
                                    <label for="location" class="text-gray-700 text-sm font-bold m-3">Lokasi Penempatan:</label>
                                </th>
                                <td class="w-2/3">
                                    <input type="text" id="location" name="location" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </td>
                            </tr>
                            <tr class="border-b-2 border-black">
                                <th class="w-1/3 text-left ">
                                    <label for="deviceInfo" class="text-gray-700 text-sm font-bold m-3">Merk/Tipe/Nomor Seri:</label>
                                </th>
                                <td class="w-2/3">
                                    <input type="text" id="deviceInfo" name="deviceInfo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </td>
                            </tr>
                            <tr class="border-b-2 border-black">
                                <th class="w-1/3 text-left ">
                                    <label for="certificateInfo" class="text-gray-700 text-sm font-bold m-3">Nomor dan Tanggal Sertifikat:</label>
                                </th>
                                <td class="w-2/3">
                                    <input type="text" id="certificateInfo" name="certificateInfo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </td>
                            </tr>
                            <tr class="border-b-2 border-black">
                                <th class="w-1/3 h-10 text-left ">
                                    {{-- <label for="certificateInfo" class="text-gray-700 text-sm font-bold m-3">Nomor dan Tanggal Sertifikat:</label> --}}
                                </th>
                                <td class="w-2/3">
                                    {{-- <input type="text" id="certificateInfo" name="certificateInfo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"> --}}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mx-10 my-4">
                        <div class="mb-3">
                            <div class="flex items-center mb-2">
                                <input type="checkbox" id="fulfilled" name="fulfilled" class="form-checkbox h-5 w-5 text-blue-600" checked><label for="fulfilled" class="ml-2 text-sm">Terpenuhi</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="unfulfilled" name="unfulfilled" class="form-checkbox h-5 w-5 text-blue-600"><label for="unfulfilled" class="ml-2 text-sm">Tidak Terpenuhi</label>
                            </div>
                        </div>
                    </div>
                    <div class="mx-10 mt-4 mb-0 border-x-2 border-t-2 border-black px-10 py-40">
                        <div>
                            <div class="grid grid-cols-3 gap-4 text-center">
                                <div>
                                    <h2 class="font-bold mb-2">TEST 1</h2>
                                    <div class="w-28 h-28 mx-auto border-2 border-black flex items-center justify-center">
                                        <input type="checkbox" id="test1" name="test1" class="form-checkbox h-5 w-5 text-blue-600">
                                    </div>
                                </div>
                                <div>
                                    <h2 class="font-bold mb-2">TEST 2</h2>
                                    <div class="w-28 h-28 mx-auto border-2 border-black flex items-center justify-center">
                                        <input type="checkbox" id="test2" name="test2" class="form-checkbox h-5 w-5 text-blue-600">
                                    </div>
                                </div>
                                <div>
                                    <h2 class="font-bold mb-2">TEST 3</h2>
                                    <div class="w-28 h-28 mx-auto border-2 border-black flex items-center justify-center">
                                        <input type="checkbox" id="test3" name="test3" class="form-checkbox h-5 w-5 text-blue-600">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-32 mx-10">
                            <div class="flex items-center mb-2">
                                <input type="checkbox" id="testCondition1" name="testCondition1" class="form-checkbox h-5 w-5 text-blue-600" checked>
                                <label for="testCondition1" class="ml-2 text-sm">Letak alat uji OTP dan HHMD pada saat pengujian harus > 1m dari benda logam lain disekelilingnya.</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="testCondition2" name="testCondition2" class="form-checkbox h-5 w-5 text-blue-600" checked>
                                <label for="testCondition2" class="ml-2 text-sm">Jarak antara HHMD dan OTP > 3-5 cm.</label>
                            </div>
                        </div>
                    </div>
                    <div class="border-y-2 border-black">
                        <div class="mt-5 mb-2 mx-5 flex items-start">
                            <label class="text-gray-700 text-sm font-bold mr-4 pt-1">Hasil:</label>
                            <div class="flex flex-col">
                                <div class="flex items-center mb-1">
                                    <input type="checkbox" id="resultPass" name="result" value="pass" class="form-checkbox h-5 w-5 text-blue-600">
                                    <label for="resultPass" class="ml-2">PASS</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="resultFail" name="result" value="fail" class="form-checkbox h-5 w-5 text-blue-600">
                                    <label for="resultFail" class="ml-2">FAIL</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5 mx-5">
                            <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">CATATAN:</label>
                            <textarea id="notes" name="notes" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="my-3 mx-5">
                        <h3 class="text-sm font-bold mb-2">Personel Pengamanan Penerbangan</h3>
                        <div class="space-y-4">
                            <div>
                                <button onclick="clearSignature(event, 'securityOfficerSignature')" class="mt-2 px-3 py-1 bg-gray-200 text-sm rounded">Clear</button>
                                <canvas id="securityOfficerSignature" class="signature-pad" width="300" height="150"></canvas>
                                <label for="securityOfficer" class="block text-gray-700 text-xs mb-1">1. Airport Security Officer</label>
                            </div>
                            <div>
                                <button onclick="clearSignature(event, 'securitySupervisorSignature')" class="mt-2 px-3 py-1 bg-gray-200 text-sm rounded">Clear</button>
                                <canvas id="securitySupervisorSignature" class="signature-pad" width="300" height="150"></canvas>
                                <label for="securitySupervisor" class="block text-gray-700 text-xs mb-1">2. Airport Security Supervisor</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-start mt-5">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the current date and time
        let now = new Date();

        // Format the date and time to match the input format (YYYY-MM-DDTHH:MM)
        let year = now.getFullYear();
        let month = (now.getMonth() + 1).toString().padStart(2, '0');
        let day = now.getDate().toString().padStart(2, '0');
        let hours = now.getHours().toString().padStart(2, '0');
        let minutes = now.getMinutes().toString().padStart(2, '0');

        let formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

        // Set the value of the input
        document.getElementById('testDateTime').value = formattedDateTime;
    });
    // Get the current date and time

    document.getElementById('hhmdForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.blob();
    })
    .then(blob => {
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.style.display = 'none';
        a.href = url;
        a.download = 'filled_hhmd_form.pdf';
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while submitting the form. Please try again.');
    });
});

var securityOfficerPad = new SignaturePad(document.getElementById('securityOfficerSignature'));
var securitySupervisorPad = new SignaturePad(document.getElementById('securitySupervisorSignature'));

    function clearSignature(event, canvasId) {
        event.preventDefault();
        if (canvasId === 'securityOfficerSignature') {
            securityOfficerPad.clear();
        } else if (canvasId === 'securitySupervisorSignature') {
            securitySupervisorPad.clear();
        }
    }

        // Function to save signatures (you'll need to implement this based on your backend)
        function saveSignatures() {
            var officerSignature = securityOfficerPad.toDataURL();
            var supervisorSignature = securitySupervisorPad.toDataURL();

            // Here you would typically send these data URLs to your server
            console.log("Officer Signature:", officerSignature);
            console.log("Supervisor Signature:", supervisorSignature);
        }

</script>

@endsection
