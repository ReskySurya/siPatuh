<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>X-RAY BAGASI Forms</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .custom-checkbox-alt {
            -webkit-appearance: none;
            appearance: none;
            width: 16px;
            height: 16px;
            border: 1px solid #b9b9b9;
            border-radius: 3px;
            cursor: not-allowed;
        }

        .custom-checkbox-alt:checked {
            background-color: #1e3bdd;
            position: relative;
        }

        .custom-checkbox-alt:checked::before {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 12px;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .custom-radio {
            -webkit-appearance: none;
            appearance: none;
            width: 16px;
            height: 16px;
            border: 1px solid #b9b9b9;
            border-radius: 50%;
            cursor: not-allowed;
        }

        .custom-radio:checked {
            background-color: white;
            position: relative;
        }

        .custom-radio:checked::before {
            content: '';
            position: absolute;
            width: 8px;
            height: 8px;
            background-color: #1e3bdd;
            border-radius: 50%;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        @page {
            margin: 0;
            padding: 0;
        }
        .page-break-after {
            page-break-after: always;
        }
    </style>
</head>
<body class="m-0 p-0">
    @foreach($forms as $form)
    <div class="page-break-after">
        <div class="bg-white p-4" style="width: 210mm;">
            <div id="format" class="mx-auto">
                <div class="border-t-2 border-x-2 border-black bg-white shadow-md px-4 py-2">
                    <div class="flex items-center justify-between">
                        <img src="data:image/png;base64,{{ $logoAirportBase64 }}" alt="Logo" class="w-14 h-14 object-contain">
                        <h1 class="text-sm font-bold text-center flex-grow px-2">
                            CHECK LIST PENGUJIAN HARIAN<br>
                            MESIN X-RAY BAGASI MULTIVIEW<br>
                        </h1>
                        <img src="data:image/png;base64,{{ $logoInjourneyBase64 }}" alt="Injourney Logo" class="w-16 h-14 object-contain">
                    </div>
                </div>

                <div class="border-2 border-black bg-white shadow">
                    <table class="w-full text-xs">
                        <tbody>
                            <tr class="border-b border-black">
                                <th class="w-1/3 text-left p-1">Nama Operator Penerbangan:</th>
                                <td class="w-2/3 p-1">{{ $form->operatorName }}</td>
                            </tr>
                            <tr class="border-b border-black">
                                <th class="w-1/3 text-left p-1">Tanggal & Waktu Pengujian:</th>
                                <td class="w-2/3 p-1">{{ date('d-m-Y H:i', strtotime($form->testDateTime)) }}</td>
                            </tr>
                            <tr class="border-b border-black">
                                <th class="w-1/3 text-left p-1">Lokasi Penempatan:</th>
                                <td class="w-2/3 p-1">{{ $form->location }}</td>
                            </tr>
                            <tr class="border-b border-black">
                                <th class="w-1/3 text-left p-1">Merk/Tipe/Nomor Seri:</th>
                                <td class="w-2/3 p-1">{{ $form->deviceInfo }}</td>
                            </tr>
                            <tr class="border-b border-black">
                                <th class="w-1/3 text-left p-1">Nomor dan Tanggal Sertifikat:</th>
                                <td class="w-2/3 p-1">{{ $form->certificateInfo }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="px-1">
                        <div class="p-1">
                            <div class="mb-0">
                                <label class="inline-flex items-center">
                                    <input class="custom-checkbox-alt" type="checkbox" {{ $form->terpenuhi ? 'checked' : '' }} disabled>
                                    <span class="ml-1 text-xs">Terpenuhi</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input class="custom-checkbox-alt" type="checkbox" {{ $form->tidakterpenuhi ? 'checked' : '' }} disabled>
                                    <span class="ml-2 text-sm">Tidak Terpenuhi</span>
                                </label>
                            </div>
                        </div>

                        <h2 class="font-bold text-xs mb-1 text-center">GENERATOR ATAS/BAWAH</h2>
                        <div class="border-2 border-black p-1 mb-1">
                            <div class="grid grid-cols-[30%_70%] gap-1 mb-1">
                                <div class="p-2">
                                    <h3 class="text-xs font-bold mb-2 text-center">TEST 2a</h3>
                                    <div class="grid grid-cols-2 gap-0">
                                        <input type="checkbox" {{$form->test2aab ? 'checked' : '' }}
                                            class="form-checkbox custom-checkbox-alt absolute place-self-center" disabled>
                                        <div class="bg-green-500 h-16 flex items-center justify-center">
                                        </div>
                                        <div class="bg-orange-500 h-16 flex items-center justify-center">
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-[70%_30%] relative">
                                        <h3 class="text-xs font-bold text-end">TEST 2b</h3>
                                        <input type="checkbox" {{$form->test2bab ? 'checked' : '' }}
                                            class="absolute custom-checkbox-alt place-self-end form-checkbox" disabled>
                                    </div>
                                </div>

                                <div class="p-1">
                                    <h3 class="text-xs font-bold mb-1 text-center">TEST 3</h3>
                                    <div class="grid grid-cols-9 gap-0 relative">
                                        <div class="bg-cyan-100 h-16 flex items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test3ab_14 ? 'checked' : '' }} name="test3ab_14" id="test3ab_14"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-cyan-200 h-16 flex items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test3ab_16 ? 'checked' : '' }} name="test3ab_16" id="test3ab_16"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-sky-400 h-16 flex items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test3ab_18 ? 'checked' : '' }} name="test3ab_18" id="test3ab_18"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-500 h-16 flex items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test3ab_20 ? 'checked' : '' }} name="test3ab_20" id="test3ab_20"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-500 h-16 flex items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test3ab_22 ? 'checked' : '' }} name="test3ab_22" id="test3ab_22"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-700 h-16 flex items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test3ab_24 ? 'checked' : '' }} name="test3ab_24" id="test3ab_24"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-700 h-16 flex items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test3ab_26 ? 'checked' : '' }} name="test3ab_26" id="test3ab_26"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-950 h-16 flex items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test3ab_28 ? 'checked' : '' }} name="test3ab_28" id="test3ab_28"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-950 h-16 flex items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test3ab_30 ? 'checked' : '' }} name="test3ab_30" id="test3ab_30"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-9 gap-0">
                                        <p class="text-xs -rotate-90">14</p>
                                        <p class="text-xs -rotate-90">16</p>
                                        <p class="text-xs -rotate-90">18</p>
                                        <p class="text-xs -rotate-90">20</p>
                                        <p class="text-xs -rotate-90">22</p>
                                        <p class="text-xs -rotate-90">24</p>
                                        <p class="text-xs -rotate-90">26</p>
                                        <p class="text-xs -rotate-90">28</p>
                                        <p class="text-xs -rotate-90">30</p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-[35%_50%_15%] gap-1 mb-0">
                                <div class="">
                                    <div class="grid grid-cols-6 gap-0 h-24">
                                        <div class="grid grid-rows bg-white items-center justify-center">
                                            <p class="text-xs -rotate-90">AWG</p>
                                        </div>
                                        <div class="grid grid-rows-4 bg-white items-center justify-center">
                                            <p class="text-xs -rotate-90">36</p>
                                            <p class="text-xs -rotate-90">32</p>
                                            <p class="text-xs -rotate-90">30</p>
                                            <p class="text-xs -rotate-90">24</p>
                                        </div>
                                        <div class="grid grid-rows-4 bg-white items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1aab_36 ? 'checked' : '' }} id="test1aab_36" name="test1aab_36"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1aab_32 ? 'checked' : '' }} id="test1aab_32" name="test1aab_32"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1aab_30 ? 'checked' : '' }} id="test1aab_30" name="test1aab_30"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1aab_24 ? 'checked' : '' }} id="test1aab_24" name="test1aab_24"
                                                class="form-checkbox" disabled>
                                        </div>
                                        <div
                                            class="grid grid-rows-4 bg-[#C5E0B3] border border-black items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bab_36_1 ? 'checked' : '' }} id="test1bab_36_1" name="test1bab_36_1"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bab_32_1 ? 'checked' : '' }} id="test1bab_32_1" name="test1bab_32_1"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bab_30_1 ? 'checked' : '' }} id="test1bab_30_1" name="test1bab_30_1"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bab_24_1 ? 'checked' : '' }} id="test1bab_24_1" name="test1bab_24_1"
                                                class="form-checkbox" disabled>
                                        </div>
                                        <div
                                            class="grid grid-rows-4 bg-[#92D050] border-y border-black items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bab_36_2 ? 'checked' : '' }} id="test1bab_36_2" name="test1bab_36_2"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bab_32_2 ? 'checked' : '' }} id="test1bab_32_2" name="test1bab_32_2"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bab_30_2 ? 'checked' : '' }} id="test1bab_30_2" name="test1bab_30_2"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bab_24_2 ? 'checked' : '' }} id="test1bab_24_2" name="test1bab_24_2"
                                                class="form-checkbox" disabled>
                                        </div>
                                        <div
                                            class="grid grid-rows-4 bg-green-500 border border-black items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bab_36_3 ? 'checked' : '' }} id="test1bab_36_3" name="test1bab_36_3"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bab_32_3 ? 'checked' : '' }} id="test1bab_32_3" name="test1bab_32_3"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bab_30_3 ? 'checked' : '' }} id="test1bab_30_3" name="test1bab_30_3"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bab_24_3 ? 'checked' : '' }} id="test1bab_24_3" name="test1bab_24_3"
                                                class="form-checkbox" disabled>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-[50%_50%] mt-3">
                                        <h3 class="text-xs font-bold text-center">TEST 1a</h3>
                                        <h3 class="text-xs font-bold text-end">TEST 1b</h3>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="grid grid-rows-3 gap-0">
                                        <div
                                            class="grid grid-cols-[40%_60%] bg-sky-400 items-center justify-center relative">
                                            <div class="grid grid-rows-4 text-xs h-6 pl-1">
                                                <p class="text-[8px] font-semibold absolute -top-1">1.5 mm gaps</p>
                                                <input class="custom-checkbox-alt" type="checkbox" {{$form->test4ab_h15mm ? 'checked' : '' }} name="test4ab_h15mm" id="test4ab_h15mm"
                                                    class="form-checkbox absolute place-self-center h-6 w-6" disabled>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                            </div>
                                            <div class="grid grid-cols-4 gap-0 text-xs h-7 px-8">
                                                <input class="custom-checkbox-alt" type="checkbox" {{$form->test4ab_v15mm ? 'checked' : '' }} name="test4ab_v15mm" id="test4ab_v15mm"
                                                    class="form-checkbox absolute place-self-center h-5 w-5" disabled>
                                                <div class="border border-black bg-white w-1"></div>
                                                <div class="border border-black bg-white w-1"></div>
                                                <div class="border border-black bg-white w-1"></div>
                                                <div class="border border-black bg-white w-1"></div>
                                            </div>
                                        </div>
                                        <div
                                            class="grid grid-cols-[65%_35%] bg-sky-400 items-center justify-end relative">
                                            <div class="grid grid-rows-4 text-xs h-6 px-1 pl-10">
                                                <p class="text-[8px] font-semibold absolute -top-1">2.0 mm gaps</p>
                                                <input class="custom-checkbox-alt" type="checkbox" {{$form->test4ab_h20mm ? 'checked' : '' }} name="test4ab_h20mm" id="test4ab_h20mm"
                                                    class="form-checkbox absolute place-self-center h-6 w-6" disabled>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                            </div>
                                            <div class="grid grid-cols-4 gap-0 text-xs h-8 px-2">
                                                <input class="custom-checkbox-alt" type="checkbox" {{$form->test4ab_v20mm ? 'checked' : '' }} name="test4ab_v20mm" id="test4ab_v20mm"
                                                    class="form-checkbox absolute place-self-center h-4 w-4" disabled>
                                                <div class="border border-black bg-white w-1"></div>
                                                <div class="border border-black bg-white w-1"></div>
                                                <div class="border border-black bg-white w-1"></div>
                                                <div class="border border-black bg-white w-1"></div>
                                            </div>
                                        </div>
                                        <div
                                            class="grid grid-cols-[40%_60%] bg-sky-400 items-center justify-center relative">
                                            <div class="grid grid-rows-4 text-xs h-6 pl-1">
                                                <p class="text-[8px] font-semibold absolute -top-1">1.0 mm gaps</p>
                                                <input class="custom-checkbox-alt" type="checkbox" {{$form->test4ab_h10mm ? 'checked' : '' }} name="test4ab_h10mm" id="test4ab_h10mm"
                                                    class="form-checkbox absolute place-self-center h-6 w-6" disabled>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                            </div>
                                            <div class="grid grid-cols-4 gap-0 text-xs h-11 px-9 py-1">
                                                <input class="custom-checkbox-alt" type="checkbox" {{$form->test4ab_v10mm ? 'checked' : '' }} name="test4ab_v10mm" id="test4ab_v10mm"
                                                    class="form-checkbox absolute place-self-center h-5 w-5" disabled>
                                                <div class="border border-black bg-white w-1"></div>
                                                <div class="border border-black bg-white w-1"></div>
                                                <div class="border border-black bg-white w-1"></div>
                                                <div class="border border-black bg-white w-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="text-xs font-bold mt-2 text-center">TEST 4</h3>
                                </div>

                                <div class="">
                                    <div class="grid grid-cols-[80%_20%] gap-0">
                                        <div class="grid grid-rows-3">
                                            <div class="bg-[#C5E0B3] h-10 flex items-center justify-center">
                                                <input class="custom-checkbox-alt" type="checkbox" {{$form->test5ab_05mm ? 'checked' : '' }} id="test5ab_05mm" name="test5ab_05mm"
                                                    class="form-checkbox" disabled>
                                            </div>
                                            <div class="bg-[#A8D08D] h-10 flex items-center justify-center">
                                                <input class="custom-checkbox-alt" type="checkbox" {{$form->test5ab_10mm ? 'checked' : '' }} id="test5ab_10mm" name="test5ab_10mm"
                                                    class="form-checkbox" disabled>
                                            </div>
                                            <div class="bg-[#548135] h-10 flex items-center justify-center">
                                                <input class="custom-checkbox-alt" type="checkbox" {{$form->test5ab_15mm ? 'checked' : '' }} id="test5ab_15mm" name="test5ab_15mm"
                                                    class="form-checkbox" disabled>
                                            </div>
                                        </div>
                                        <div class="grid grid-rows-3 pl-1">
                                            <p class="text-[8px] -rotate-90">0.05mm</p>
                                            <p class="text-[8px] -rotate-90">0.10mm</p>
                                            <p class="text-[8px] -rotate-90">0.15mm</p>
                                        </div>
                                    </div>
                                    <h3 class="text-xs font-bold mt-5 text-center">TEST 5</h3>
                                </div>
                            </div>
                        </div>

                        <h2 class="font-bold text-xs mb-1 text-center">GENERATOR BAWAH</h2>
                        <div class="border-2 border-black p-1 mb-1">
                            <div class="grid grid-cols-[30%_70%] gap-1 mb-1">
                                <div class="p-1">
                                    <h3 class="text-xs font-bold mb-1 text-center">TEST 2a</h3>
                                    <div class="grid grid-cols-2 gap-0">
                                        <input class="custom-checkbox-alt" type="checkbox" {{$form->test2ab ? 'checked' : '' }} name="test2ab" id="test2ab" disabled
                                            class="form-checkbox absolute place-self-center">
                                        <div class="bg-green-500 h-12 flex items-center justify-center">
                                        </div>
                                        <div class="bg-orange-500 h-12 flex items-center justify-center">
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-[70%_30%] relative">
                                        <h3 class="text-xs font-bold text-end">TEST 2b</h3>
                                        <input class="custom-checkbox-alt" type="checkbox" {{$form->test2bb ? 'checked' : '' }} name="test2bb" id="test2bb" disabled
                                            class="absolute place-self-end form-checkbox">
                                    </div>
                                </div>

                                <div class="p-1">
                                    <h3 class="text-xs font-bold mb-1 text-center">TEST 3</h3>
                                    <div class="grid grid-cols-9 gap-0 relative">
                                        <div class="bg-cyan-100 h-16 flex items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test3b_14 ? 'checked' : '' }} name="test3b_14" id="test3b_14"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-cyan-200 h-16 flex items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test3b_16 ? 'checked' : '' }} name="test3b_16" id="test3b_16"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-sky-400 h-16 flex items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test3b_18 ? 'checked' : '' }} name="test3b_18" id="test3b_18"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-500 h-16 flex items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test3b_20 ? 'checked' : '' }} name="test3b_20" id="test3b_20"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-500 h-16 flex items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test3b_22 ? 'checked' : '' }} name="test3b_22" id="test3b_22"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-700 h-16 flex items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test3b_24 ? 'checked' : '' }} name="test3b_24" id="test3b_24"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-700 h-16 flex items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test3b_26 ? 'checked' : '' }} name="test3b_26" id="test3b_26"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-950 h-16 flex items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test3b_28 ? 'checked' : '' }}name="test3b_28" id="test3b_28"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-950 h-16 flex items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test3b_30 ? 'checked' : '' }} name="test3b_30" id="test3b_30"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-9 gap-0 -mt-1">
                                        <p class="text-xs -rotate-90">14</p>
                                        <p class="text-xs -rotate-90">16</p>
                                        <p class="text-xs -rotate-90">18</p>
                                        <p class="text-xs -rotate-90">20</p>
                                        <p class="text-xs -rotate-90">22</p>
                                        <p class="text-xs -rotate-90">24</p>
                                        <p class="text-xs -rotate-90">26</p>
                                        <p class="text-xs -rotate-90">28</p>
                                        <p class="text-xs -rotate-90">30</p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-[35%_50%_15%] gap-1 mb-1">
                                <div class="">
                                    <div class="grid grid-cols-6 gap-0 h-24">
                                        <div class="grid grid-rows bg-white items-center justify-center">
                                            <p class="text-xs -rotate-90">AWG</p>
                                        </div>
                                        <div class="grid grid-rows-4 bg-white items-center justify-center">
                                            <p class="text-xs -rotate-90">36</p>
                                            <p class="text-xs -rotate-90">32</p>
                                            <p class="text-xs -rotate-90">30</p>
                                            <p class="text-xs -rotate-90">24</p>
                                        </div>
                                        <div class="grid grid-rows-4 bg-white items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1ab_36 ? 'checked' : '' }} id="test1ab_36" name="test1ab_36"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1ab_32 ? 'checked' : '' }} id="test1ab_32" name="test1ab_32"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1ab_30 ? 'checked' : '' }} id="test1ab_30" name="test1ab_30"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1ab_24 ? 'checked' : '' }} id="test1ab_24" name="test1ab_24"
                                                class="form-checkbox" disabled>
                                        </div>
                                        <div
                                            class="grid grid-rows-4 bg-[#C5E0B3] border border-black items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bb_36_1 ? 'checked' : '' }} id="test1bb_36_1" name="test1bb_36_1"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bb_32_1 ? 'checked' : '' }} id="test1bb_32_1" name="test1bb_32_1"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bb_30_1 ? 'checked' : '' }} id="test1bb_30_1" name="test1bb_30_1"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bb_24_1 ? 'checked' : '' }} id="test1bb_24_1" name="test1bb_24_1"
                                                class="form-checkbox" disabled>
                                        </div>
                                        <div
                                            class="grid grid-rows-4 bg-[#92D050] border-y border-black items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bb_36_2 ? 'checked' : '' }} id="test1bb_36_2" name="test1bb_36_2"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bb_32_2 ? 'checked' : '' }} id="test1bb_32_2" name="test1bb_32_2"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bb_30_2 ? 'checked' : '' }} id="test1bb_30_2" name="test1bb_30_2"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bb_24_2 ? 'checked' : '' }} id="test1bb_24_2" name="test1bb_24_2"
                                                class="form-checkbox" disabled>
                                        </div>
                                        <div
                                            class="grid grid-rows-4 bg-green-500 border border-black items-center justify-center">
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bb_36_3 ? 'checked' : '' }} id="test1bb_36_3" name="test1bb_36_3"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bb_32_3 ? 'checked' : '' }} id="test1bb_32_3" name="test1bb_32_3"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bb_30_3 ? 'checked' : '' }} id="test1bb_30_3" name="test1bb_30_3"
                                                class="form-checkbox" disabled>
                                            <input class="custom-checkbox-alt" type="checkbox" {{$form->test1bb_24_3 ? 'checked' : '' }} id="test1bb_24_3" name="test1bb_24_3"
                                                class="form-checkbox" disabled>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-[50%_50%] mt-3">
                                        <h3 class="text-xs font-bold text-center">TEST 1a</h3>
                                        <h3 class="text-xs font-bold text-end">TEST 1b</h3>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="grid grid-rows-3 gap-0">
                                        <div
                                            class="grid grid-cols-[40%_60%] bg-sky-400 items-center justify-center relative">
                                            <div class="grid grid-rows-4 text-xs h-6 pl-1">
                                                <p class="text-[8px] font-semibold absolute -top-1">1.5 mm gaps</p>
                                                <input class="custom-checkbox-alt" type="checkbox" {{$form->test4b_h15mm ? 'checked' : '' }} name="test4b_h15mm" id="test4b_h15mm"
                                                    class="form-checkbox absolute place-self-center h-6 w-6" disabled>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                            </div>
                                            <div class="grid grid-cols-4 gap-0 text-xs h-7 px-8">
                                                <input class="custom-checkbox-alt" type="checkbox" {{$form->test4b_v15mm ? 'checked' : '' }} name="test4b_v15mm" id="test4b_v15mm"
                                                    class="form-checkbox absolute place-self-center h-5 w-5" disabled>
                                                <div class="border border-black bg-white w-1"></div>
                                                <div class="border border-black bg-white w-1"></div>
                                                <div class="border border-black bg-white w-1"></div>
                                                <div class="border border-black bg-white w-1"></div>
                                            </div>
                                        </div>
                                        <div
                                            class="grid grid-cols-[65%_35%] bg-sky-400 items-center justify-end relative">
                                            <div class="grid grid-rows-4 text-xs h-6 px-1 pl-10">
                                                <p class="text-[8px] font-semibold absolute -top-1">2.0 mm gaps</p>
                                                <input class="custom-checkbox-alt" type="checkbox" {{$form->test4b_h20mm ? 'checked' : '' }} name="test4b_h20mm" id="test4b_h20mm"
                                                    class="form-checkbox absolute place-self-center h-6 w-6" disabled>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                            </div>
                                            <div class="grid grid-cols-4 gap-0 text-xs h-8 px-2">
                                                <input class="custom-checkbox-alt" type="checkbox" {{$form->test4b_v20mm ? 'checked' : '' }} name="test4b_v20mm" id="test4b_v20mm"
                                                    class="form-checkbox absolute place-self-center h-4 w-4" disabled>
                                                <div class="border border-black bg-white w-1"></div>
                                                <div class="border border-black bg-white w-1"></div>
                                                <div class="border border-black bg-white w-1"></div>
                                                <div class="border border-black bg-white w-1"></div>
                                            </div>
                                        </div>
                                        <div
                                            class="grid grid-cols-[40%_60%] bg-sky-400 items-center justify-center relative">
                                            <div class="grid grid-rows-4 text-xs h-6 pl-1">
                                                <p class="text-[8px] font-semibold absolute -top-1">1.0 mm gaps</p>
                                                <input class="custom-checkbox-alt" type="checkbox" {{$form->test4b_h10mm ? 'checked' : '' }} name="test4b_h10mm" id="test4b_h10mm"
                                                    class="form-checkbox absolute place-self-center h-6 w-6" disabled>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                            </div>
                                            <div class="grid grid-cols-4 gap-0 text-xs h-11 px-9 py-1">
                                                <input class="custom-checkbox-alt" type="checkbox" {{$form->test4b_v10mm ? 'checked' : '' }} name="test4b_v10mm" id="test4b_v10mm"
                                                    class="form-checkbox absolute place-self-center h-5 w-5" disabled>
                                                <div class="border border-black bg-white w-1"></div>
                                                <div class="border border-black bg-white w-1"></div>
                                                <div class="border border-black bg-white w-1"></div>
                                                <div class="border border-black bg-white w-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="text-xs font-bold mt-2 text-center">TEST 4</h3>
                                </div>

                                <div class="">
                                    <div class="grid grid-cols-[80%_20%] gap-0">
                                        <div class="grid grid-rows-3">
                                            <div class="bg-[#C5E0B3] h-10 flex items-center justify-center">
                                                <input class="custom-checkbox-alt" type="checkbox" {{$form->test5b_05mm ? 'checked' : '' }} id="test5b_05mm" name="test5b_05mm"
                                                    class="form-checkbox" disabled>
                                            </div>
                                            <div class="bg-[#A8D08D] h-10 flex items-center justify-center">
                                                <input class="custom-checkbox-alt" type="checkbox" {{$form->test5b_10mm ? 'checked' : '' }} id="test5b_10mm" name="test5b_10mm"
                                                    class="form-checkbox" disabled>
                                            </div>
                                            <div class="bg-[#548135] h-10 flex items-center justify-center">
                                                <input class="custom-checkbox-alt" type="checkbox" {{$form->test5b_15mm ? 'checked' : '' }} id="test5b_15mm" name="test5b_15mm"
                                                    class="form-checkbox" disabled>
                                            </div>
                                        </div>
                                        <div class="grid grid-rows-3 pl-1">
                                            <p class="text-[8px] -rotate-90">0.05mm</p>
                                            <p class="text-[8px] -rotate-90">0.10mm</p>
                                            <p class="text-[8px] -rotate-90">0.15mm</p>
                                        </div>
                                    </div>
                                    <h3 class="text-xs font-bold mt-5 text-center">TEST 5</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-t-2 border-black p-2">
                        <div class="flex items-start mb-1">
                            <label class="text-gray-700 font-bold mr-2 text-xs">Hasil:</label>
                            <div class="flex flex-col">
                                <div class="flex items-center">
                                    <input class="custom-checkbox-alt" type="radio" class="custom-radio" {{ $form->result == 'pass' ? 'checked' : '' }} disabled>
                                    <label class="text-xs ml-2">PASS</label>
                                </div>
                                <div class="flex items-center">
                                    <input class="custom-checkbox-alt" type="radio" class="custom-radio" {{ $form->result == 'fail' ? 'checked' : '' }} disabled>
                                    <label class="text-xs ml-2">FAIL</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-1 text-xs">CATATAN:</label>
                            <p class="text-xs">{{ $form->notes }}</p>
                        </div>
                    </div>

                    <div class="border-t-2 border-black px-2 py-1">
                        <h3 class="text-xs font-bold mb-1">Personel Pengamanan Penerbangan</h3>
                        <div class="grid grid-cols-2 gap-1">
                            <div class="grid grid-rows-2 gap-1 items-center">
                                <div class="text-center self-end">
                                    <h4 class="font-semibold text-xs">{{ $form->officerName }}</h4>
                                    <label class="text-gray-700 font-normal">1. Airport Security Officer</label>
                                </div>
                                <div class="text-center self-end">
                                    <h4 class="font-semibold text-xs">
                                        @if($form->supervisor)
                                            {{ $form->supervisor->name }}
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
                                        <img src="{{ $form->officer_signature }}" alt="Tanda tangan Officer"
                                            class="w-[100px] h-auto object-contain">
                                    @else
                                        <p class="text-xs">Tanda tangan Officer tidak tersedia</p>
                                    @endif
                                </div>
                                <div class="flex flex-col items-center">
                                    @if($form->supervisor_signature)
                                        <img src="{{ $form->supervisor_signature }}" alt="Tanda tangan Supervisor"
                                            class="w-[100px] h-auto object-contain">
                                    @else
                                        <p class="text-xs">Tanda tangan Supervisor tidak tersedia</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</body>
</html>
