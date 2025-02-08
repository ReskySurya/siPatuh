@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded px-4 sm:px-8 pt-6 pb-8 mb-4 w-full max-w-full">
        <h1 class="text-xl sm:text-2xl font-bold mb-4">Tinjau Formulir XRAY CABIN</h1>

        <div class="bg-white p-4 w-full max-w-full">
            <div id="format" class="mx-auto w-full">
                <div class="border-t-2 border-x-2 border-black bg-white shadow-md p-4">
                    <div class="flex flex-col sm:flex-row items-center justify-between">
                        <img src="{{ asset('images/airport-security-logo.png') }}" alt="Logo"
                            class="w-20 h-20 mb-2 sm:mb-0">
                        <h1 class="text-sm sm:text-xl font-bold text-center flex-grow px-2">
                            CHECK LIST PENGUJIAN HARIAN<br>
                            MESIN X-RAY CABIN MULTIVIEW<br>
                        </h1>
                        <img src="https://via.placeholder.com/80x80" alt="Additional Logo"
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

                    <div class="px-1">
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

                        <h2 class="font-bold text-sm mb-1 text-center">GENERATOR ATAS/BAWAH</h2>
                        <div class="border-2 border-black p-2 mb-2">
                            <div class="grid grid-cols-[30%_70%] gap-2 mb-4">
                                <div class="p-2">
                                    <h3 class="text-xs font-bold mb-2 text-center">TEST 2a</h3>
                                    <div class="grid grid-cols-2 gap-0">
                                        <input type="checkbox" {{$form->test2aab ? 'checked' : '' }}
                                            class="form-checkbox absolute place-self-center" disabled>
                                        <div class="bg-green-500 h-16 flex items-center justify-center">
                                        </div>
                                        <div class="bg-orange-500 h-16 flex items-center justify-center">
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-[70%_30%] relative">
                                        <h3 class="text-xs font-bold text-end">TEST 2b</h3>
                                        <input type="checkbox" {{$form->test2bab ? 'checked' : '' }}
                                            class="absolute place-self-end form-checkbox" disabled>
                                    </div>
                                </div>

                                <div class="p-2">
                                    <h3 class="text-xs font-bold mb-2 text-center">TEST 3</h3>
                                    <div class="grid grid-cols-9 gap-0 relative">
                                        <div class="bg-cyan-100 h-16 flex items-center justify-center">
                                            <input type="checkbox" {{$form->test3ab_14 ? 'checked' : '' }} name="test3ab_14" id="test3ab_14"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-cyan-200 h-16 flex items-center justify-center">
                                            <input type="checkbox" {{$form->test3ab_16 ? 'checked' : '' }} name="test3ab_16" id="test3ab_16"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-sky-400 h-16 flex items-center justify-center">
                                            <input type="checkbox" {{$form->test3ab_18 ? 'checked' : '' }} name="test3ab_18" id="test3ab_18"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-500 h-16 flex items-center justify-center">
                                            <input type="checkbox" {{$form->test3ab_20 ? 'checked' : '' }} name="test3ab_20" id="test3ab_20"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-500 h-16 flex items-center justify-center">
                                            <input type="checkbox" {{$form->test3ab_22 ? 'checked' : '' }} name="test3ab_22" id="test3ab_22"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-700 h-16 flex items-center justify-center">
                                            <input type="checkbox" {{$form->test3ab_24 ? 'checked' : '' }} name="test3ab_24" id="test3ab_24"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-700 h-16 flex items-center justify-center">
                                            <input type="checkbox" {{$form->test3ab_26 ? 'checked' : '' }} name="test3ab_26" id="test3ab_26"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-950 h-16 flex items-center justify-center">
                                            <input type="checkbox" {{$form->test3ab_28 ? 'checked' : '' }} name="test3ab_28" id="test3ab_28"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-950 h-16 flex items-center justify-center">
                                            <input type="checkbox" {{$form->test3ab_30 ? 'checked' : '' }} name="test3ab_30" id="test3ab_30"
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

                            <div class="grid grid-cols-[35%_50%_15%] gap-1 mb-2 pr-1">
                                <div class="">
                                    <div class="grid grid-cols-6 gap-0 h-32">
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
                                            <input type="checkbox" {{$form->test1aab_36 ? 'checked' : '' }} id="test1aab_36" name="test1aab_36"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1aab_32 ? 'checked' : '' }} id="test1aab_32" name="test1aab_32"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1aab_30 ? 'checked' : '' }} id="test1aab_30" name="test1aab_30"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1aab_24 ? 'checked' : '' }} id="test1aab_24" name="test1aab_24"
                                                class="form-checkbox" disabled>
                                        </div>
                                        <div
                                            class="grid grid-rows-4 bg-[#C5E0B3] border border-black items-center justify-center">
                                            <input type="checkbox" {{$form->test1bab_36_1 ? 'checked' : '' }} id="test1bab_36_1" name="test1bab_36_1"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1bab_32_1 ? 'checked' : '' }} id="test1bab_32_1" name="test1bab_32_1"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1bab_30_1 ? 'checked' : '' }} id="test1bab_30_1" name="test1bab_30_1"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1bab_24_1 ? 'checked' : '' }} id="test1bab_24_1" name="test1bab_24_1"
                                                class="form-checkbox" disabled>
                                        </div>
                                        <div
                                            class="grid grid-rows-4 bg-[#92D050] border-y border-black items-center justify-center">
                                            <input type="checkbox" {{$form->test1bab_36_2 ? 'checked' : '' }} id="test1bab_36_2" name="test1bab_36_2"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1bab_32_2 ? 'checked' : '' }} id="test1bab_32_2" name="test1bab_32_2"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1bab_30_2 ? 'checked' : '' }} id="test1bab_30_2" name="test1bab_30_2"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1bab_24_2 ? 'checked' : '' }} id="test1bab_24_2" name="test1bab_24_2"
                                                class="form-checkbox" disabled>
                                        </div>
                                        <div
                                            class="grid grid-rows-4 bg-green-500 border border-black items-center justify-center">
                                            <input type="checkbox" {{$form->test1bab_36_3 ? 'checked' : '' }} id="test1bab_36_3" name="test1bab_36_3"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1bab_32_3 ? 'checked' : '' }} id="test1bab_32_3" name="test1bab_32_3"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1bab_30_3 ? 'checked' : '' }} id="test1bab_30_3" name="test1bab_30_3"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1bab_24_3 ? 'checked' : '' }} id="test1bab_24_3" name="test1bab_24_3"
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
                                                <input type="checkbox" {{$form->test4ab_h15mm ? 'checked' : '' }} name="test4ab_h15mm" id="test4ab_h15mm"
                                                    class="form-checkbox absolute place-self-center h-6 w-6" disabled>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                            </div>
                                            <div class="grid grid-cols-4 gap-0 text-xs h-7 px-8">
                                                <input type="checkbox" {{$form->test4ab_v15mm ? 'checked' : '' }} name="test4ab_v15mm" id="test4ab_v15mm"
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
                                                <input type="checkbox" {{$form->test4ab_h20mm ? 'checked' : '' }} name="test4ab_h20mm" id="test4ab_h20mm"
                                                    class="form-checkbox absolute place-self-center h-6 w-6" disabled>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                            </div>
                                            <div class="grid grid-cols-4 gap-0 text-xs h-8 px-2">
                                                <input type="checkbox" {{$form->test4ab_v20mm ? 'checked' : '' }} name="test4ab_v20mm" id="test4ab_v20mm"
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
                                                <input type="checkbox" {{$form->test4ab_h10mm ? 'checked' : '' }} name="test4ab_h10mm" id="test4ab_h10mm"
                                                    class="form-checkbox absolute place-self-center h-6 w-6" disabled>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                            </div>
                                            <div class="grid grid-cols-4 gap-0 text-xs h-11 px-9 py-1">
                                                <input type="checkbox" {{$form->test4ab_v10mm ? 'checked' : '' }} name="test4ab_v10mm" id="test4ab_v10mm"
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
                                                <input type="checkbox" {{$form->test5ab_05mm ? 'checked' : '' }} id="test5ab_05mm" name="test5ab_05mm"
                                                    class="form-checkbox" disabled>
                                            </div>
                                            <div class="bg-[#A8D08D] h-10 flex items-center justify-center">
                                                <input type="checkbox" {{$form->test5ab_10mm ? 'checked' : '' }} id="test5ab_10mm" name="test5ab_10mm"
                                                    class="form-checkbox" disabled>
                                            </div>
                                            <div class="bg-[#548135] h-10 flex items-center justify-center">
                                                <input type="checkbox" {{$form->test5ab_15mm ? 'checked' : '' }} id="test5ab_15mm" name="test5ab_15mm"
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

                        <h2 class="font-bold text-sm mb-1 text-center">GENERATOR BAWAH</h2>
                        <div class="border-2 border-black p-2 mb-2">
                            <div class="grid grid-cols-[30%_70%] gap-2 mb-4">
                                <div class="p-2">
                                    <h3 class="text-xs font-bold mb-2 text-center">TEST 2a</h3>
                                    <div class="grid grid-cols-2 gap-0">
                                        <input type="checkbox" {{$form->test2ab ? 'checked' : '' }} name="test2ab" id="test2ab" disabled
                                            class="form-checkbox absolute place-self-center">
                                        <div class="bg-green-500 h-16 flex items-center justify-center">
                                        </div>
                                        <div class="bg-orange-500 h-16 flex items-center justify-center">
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-[70%_30%] relative">
                                        <h3 class="text-xs font-bold text-end">TEST 2b</h3>
                                        <input type="checkbox" {{$form->test2bb ? 'checked' : '' }} name="test2bb" id="test2bb" disabled
                                            class="absolute place-self-end form-checkbox">
                                    </div>
                                </div>

                                <div class="p-2">
                                    <h3 class="text-xs font-bold mb-2 text-center">TEST 3</h3>
                                    <div class="grid grid-cols-9 gap-0 relative">
                                        <div class="bg-cyan-100 h-16 flex items-center justify-center">
                                            <input type="checkbox" {{$form->test3b_14 ? 'checked' : '' }} name="test3b_14" id="test3b_14"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-cyan-200 h-16 flex items-center justify-center">
                                            <input type="checkbox" {{$form->test3b_16 ? 'checked' : '' }} name="test3b_16" id="test3b_16"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-sky-400 h-16 flex items-center justify-center">
                                            <input type="checkbox" {{$form->test3b_18 ? 'checked' : '' }} name="test3b_18" id="test3b_18"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-500 h-16 flex items-center justify-center">
                                            <input type="checkbox" {{$form->test3b_20 ? 'checked' : '' }} name="test3b_20" id="test3b_20"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-500 h-16 flex items-center justify-center">
                                            <input type="checkbox" {{$form->test3b_22 ? 'checked' : '' }} name="test3b_22" id="test3b_22"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-700 h-16 flex items-center justify-center">
                                            <input type="checkbox" {{$form->test3b_24 ? 'checked' : '' }} name="test3b_24" id="test3b_24"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-700 h-16 flex items-center justify-center">
                                            <input type="checkbox" {{$form->test3b_26 ? 'checked' : '' }} name="test3b_26" id="test3b_26"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-950 h-16 flex items-center justify-center">
                                            <input type="checkbox" {{$form->test3b_28 ? 'checked' : '' }}name="test3b_28" id="test3b_28"
                                                class="form-checkbox justify-center absolute top-4" disabled>
                                        </div>
                                        <div class="bg-blue-950 h-16 flex items-center justify-center">
                                            <input type="checkbox" {{$form->test3b_30 ? 'checked' : '' }} name="test3b_30" id="test3b_30"
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

                            <div class="grid grid-cols-[35%_50%_15%] gap-1 mb-2 pr-1">
                                <div class="">
                                    <div class="grid grid-cols-6 gap-0 h-32">
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
                                            <input type="checkbox" {{$form->test1ab_36 ? 'checked' : '' }} id="test1ab_36" name="test1ab_36"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1ab_32 ? 'checked' : '' }} id="test1ab_32" name="test1ab_32"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1ab_30 ? 'checked' : '' }} id="test1ab_30" name="test1ab_30"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1ab_24 ? 'checked' : '' }} id="test1ab_24" name="test1ab_24"
                                                class="form-checkbox" disabled>
                                        </div>
                                        <div
                                            class="grid grid-rows-4 bg-[#C5E0B3] border border-black items-center justify-center">
                                            <input type="checkbox" {{$form->test1bb_36_1 ? 'checked' : '' }} id="test1bb_36_1" name="test1bb_36_1"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1bb_32_1 ? 'checked' : '' }} id="test1bb_32_1" name="test1bb_32_1"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1bb_30_1 ? 'checked' : '' }} id="test1bb_30_1" name="test1bb_30_1"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1bb_24_1 ? 'checked' : '' }} id="test1bb_24_1" name="test1bb_24_1"
                                                class="form-checkbox" disabled>
                                        </div>
                                        <div
                                            class="grid grid-rows-4 bg-[#92D050] border-y border-black items-center justify-center">
                                            <input type="checkbox" {{$form->test1bb_36_2 ? 'checked' : '' }} id="test1bb_36_2" name="test1bb_36_2"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1bb_32_2 ? 'checked' : '' }} id="test1bb_32_2" name="test1bb_32_2"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1bb_30_2 ? 'checked' : '' }} id="test1bb_30_2" name="test1bb_30_2"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1bb_24_2 ? 'checked' : '' }} id="test1bb_24_2" name="test1bb_24_2"
                                                class="form-checkbox" disabled>
                                        </div>
                                        <div
                                            class="grid grid-rows-4 bg-green-500 border border-black items-center justify-center">
                                            <input type="checkbox" {{$form->test1bb_36_3 ? 'checked' : '' }} id="test1bb_36_3" name="test1bb_36_3"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1bb_32_3 ? 'checked' : '' }} id="test1bb_32_3" name="test1bb_32_3"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1bb_30_3 ? 'checked' : '' }} id="test1bb_30_3" name="test1bb_30_3"
                                                class="form-checkbox" disabled>
                                            <input type="checkbox" {{$form->test1bb_24_3 ? 'checked' : '' }} id="test1bb_24_3" name="test1bb_24_3"
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
                                                <input type="checkbox" {{$form->test4b_h15mm ? 'checked' : '' }} name="test4b_h15mm" id="test4b_h15mm"
                                                    class="form-checkbox absolute place-self-center h-6 w-6" disabled>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                            </div>
                                            <div class="grid grid-cols-4 gap-0 text-xs h-7 px-8">
                                                <input type="checkbox" {{$form->test4b_v15mm ? 'checked' : '' }} name="test4b_v15mm" id="test4b_v15mm"
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
                                                <input type="checkbox" {{$form->test4b_h20mm ? 'checked' : '' }} name="test4b_h20mm" id="test4b_h20mm"
                                                    class="form-checkbox absolute place-self-center h-6 w-6" disabled>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                            </div>
                                            <div class="grid grid-cols-4 gap-0 text-xs h-8 px-2">
                                                <input type="checkbox" {{$form->test4b_v20mm ? 'checked' : '' }} name="test4b_v20mm" id="test4b_v20mm"
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
                                                <input type="checkbox" {{$form->test4b_h10mm ? 'checked' : '' }} name="test4b_h10mm" id="test4b_h10mm"
                                                    class="form-checkbox absolute place-self-center h-6 w-6" disabled>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                                <div class="border border-black bg-white h-1"></div>
                                            </div>
                                            <div class="grid grid-cols-4 gap-0 text-xs h-11 px-9 py-1">
                                                <input type="checkbox" {{$form->test4b_v10mm ? 'checked' : '' }} name="test4b_v10mm" id="test4b_v10mm"
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
                                                <input type="checkbox" {{$form->test5b_05mm ? 'checked' : '' }} id="test5b_05mm" name="test5b_05mm"
                                                    class="form-checkbox" disabled>
                                            </div>
                                            <div class="bg-[#A8D08D] h-10 flex items-center justify-center">
                                                <input type="checkbox" {{$form->test5b_10mm ? 'checked' : '' }} id="test5b_10mm" name="test5b_10mm"
                                                    class="form-checkbox" disabled>
                                            </div>
                                            <div class="bg-[#548135] h-10 flex items-center justify-center">
                                                <input type="checkbox" {{$form->test5b_15mm ? 'checked' : '' }} id="test5b_15mm" name="test5b_15mm"
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

                <form action="{{ route('xray.updateStatus', $form->id) }}" method="POST" class="mt-2 sm:mt-4">
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
            fetch('{{ route("xray.saveSupervisorSignature", $form->id) }}', {
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
