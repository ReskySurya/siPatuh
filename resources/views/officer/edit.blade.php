@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md w-fit rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-2xl font-bold mb-4">Edit Formulir HHMD</h1>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('officer.hhmd.update', $form->id) }}" method="POST">
            @csrf
            @method('PUT')

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
                                    <td class="w-2/3 p-2">
                                        <input type="text" name="operatorName" value="{{ old('operatorName', $form->operatorName) }}"
                                               class="w-full border rounded px-2 py-1">
                                    </td>
                                </tr>
                                <tr class="border-b border-black">
                                    <th class="w-1/3 text-left p-2">Tanggal & Waktu Pengujian:</th>
                                    <td class="w-2/3 p-2">
                                        <input type="datetime-local" name="testDateTime"
                                               value="{{ old('testDateTime', $form->testDateTime->format('Y-m-d\TH:i')) }}"
                                               class="w-full border rounded px-2 py-1">
                                    </td>
                                </tr>
                                <tr class="border-b border-black">
                                    <th class="w-1/3 text-left p-2">Lokasi Penempatan:</th>
                                    <td class="w-2/3 p-2">
                                        <input type="text" name="location" value="{{ old('location', $form->location) }}"
                                               class="w-full border rounded px-2 py-1">
                                    </td>
                                </tr>
                                <tr class="border-b border-black">
                                    <th class="w-1/3 text-left p-2">Merk/Tipe/Nomor Seri:</th>
                                    <td class="w-2/3 p-2">
                                        <input type="text" name="deviceInfo" value="{{ old('deviceInfo', $form->deviceInfo) }}"
                                               class="w-full border rounded px-2 py-1">
                                    </td>
                                </tr>
                                <tr class="border-b border-black">
                                    <th class="w-1/3 text-left p-2">Nomor dan Tanggal Sertifikat:</th>
                                    <td class="w-2/3 p-2">
                                        <input type="text" name="certificateInfo" value="{{ old('certificateInfo', $form->certificateInfo) }}"
                                               class="w-full border rounded px-2 py-1">
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="px-4">
                            <div class="p-2">
                                <div class="mb-0">
                                    <label class="inline-flex items-center">
                                        <input type="hidden" name="terpenuhi" value="0">
                                        <input type="checkbox" name="terpenuhi" value="1" {{ old('terpenuhi', $form->terpenuhi) ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm">Terpenuhi</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex items-center">
                                        <input type="hidden" name="tidakterpenuhi" value="0">
                                        <input type="checkbox" name="tidakterpenuhi" value="1" {{ old('tidakterpenuhi', $form->tidakterpenuhi) ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm">Tidak Terpenuhi</span>
                                    </label>
                                </div>
                            </div>

                            <div class="border-x-2 border-t-2 border-black text-center items-center pt-10">
                                <div>
                                    <h2 class="font-bold mb-2">TEST 1</h2>
                                    <div class="w-20 h-20 mx-auto border-2 border-black flex items-center justify-center">
                                        <input type="hidden" name="test2" value="0">
                                        <input type="checkbox" name="test2" value="1" {{ old('test2', $form->test2) ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>

                            <div class="border-x-2 border-black pt-10 pb-10">
                                <div class="flex items-center mb-0 pl-4">
                                    <input type="hidden" name="testCondition1" value="0">
                                    <input type="checkbox" name="testCondition1" value="1" {{ old('testCondition1', $form->testCondition1) ? 'checked' : '' }}>
                                    <label class="ml-2 text-sm">Letak alat uji OTP dan HHMD pada saat pengujian harus > 1m dari benda logam lain disekelilingnya.</label>
                                </div>
                                <div class="flex items-center mb-0 pl-4">
                                    <input type="hidden" name="testCondition2" value="0">
                                    <input type="checkbox" name="testCondition2" value="1" {{ old('testCondition2', $form->testCondition2) ? 'checked' : '' }}>
                                    <label class="ml-2 text-sm">Jarak antara HHMD dan OTP > 3-5 cm.</label>
                                </div>
                            </div>
                        </div>

                        <div class="border-t-2 border-black p-4">
                            <div class="flex items-start mb-2">
                                <label class="text-gray-700 font-bold mr-4">Hasil:</label>
                                <div class="flex flex-col">
                                    <div class="flex items-center mb-0">
                                        <input type="radio" name="result" value="pass" {{ old('result', $form->result) == 'pass' ? 'checked' : '' }}>
                                        <label class="text-sm ml-2">PASS</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="result" value="fail" {{ old('result', $form->result) == 'fail' ? 'checked' : '' }}>
                                        <label class="text-sm ml-2">FAIL</label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">CATATAN:</label>
                                <textarea name="notes" class="w-full border rounded px-2 py-1" rows="3">{{ old('notes', $form->notes) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Simpan Perubahan
                </button>
                <a href="{{ route('officer.dashboard') }}" class="text-gray-600 hover:text-gray-800">
                    Kembali ke Dashboard
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
