@extends('layouts.app')

@section('content')

<!-- Table Pertama -->
<div class="container px-6 py-8">
    <div class="bg-white shadow-md rounded max-w-4xl mx-auto px-8 pt-6 pb-8 mb-4">
        <div class="flex justify-between items-center border-t-2 border-x-2 border-black p-2">
            <img src="{{ asset('images/airport-security-logo.png') }}" alt="Logo" class="w-28 h-28">
            <h2 class="text-2xl font-bold text-center flex-grow mr-27 ml-28">
                CHECK LIST PENGUJIAN HARIAN<br>
                MESIN X-RAY KABIN MULTI VIEW
            </h2>
            <img src="{{ asset('images/logo-adisucipto.png') }}" alt="Adi Sutjipto" class="w-25 h-25">
        </div>
        <!-- End Table Pertama -->

        <!-- Table Kedua -->
        <div class="flex justify-center">
            <table class="w-full border-collapse border-2 border-black">
                <tr>
                    <th class="w-64 border-y-2 border-black px-3 py-2 text-left">Nama Personil</th>
                    <td class="border-y-2 border-black px-0 py-2 text-left mr-0">:</td>
                    <td class="border-y-2 border-black px-1 py-2"></td>
                </tr>
                <tr>
                    <th class="border-y-2 border-black px-3 py-2 text-left">Tanggal & Waktu Pengujian</th>
                    <td class="border-y-2 border-black px-0 py-2 text-left">:</td>
                    <td class="border-y-2 border-black px-4 py-2"></td>
                </tr>
                <tr>
                    <th class="border-y-2 border-black px-3 py-2 text-left">Lokasi Penempatan</th>
                    <td class="border-y-2 border-black px-0 py-2 text-left">:</td>
                    <td class="border-y-2 border-black px-4 py-2"></td>
                </tr>
                <tr>
                    <th class="border-y-2 border-black px-3 py-2 text-left">Merk /Type/ Nomor Seri</th>
                    <td class="border-y-2 border-black px-0 py-2 text-left">:</td>
                    <td class="border-y-2 border-black px-4 py-2"></td>
                </tr>
                <tr>
                    <th class="border-y-2 border-black px-3 py-2 text-left">Nomor dan Tanggal Sertifikat</th>
                    <td class="border-y-2 border-black px-0 py-2 text-left">:</td>
                    <td class="border-y-2 border-black px-4 py-2"></td>
                </tr>
                <tr>
                    <th class="border-y-2 border-black px-3 py-2 text-left h-10"></th>
                    <td class="border-y-2 border-black px-0 py-2 text-left"></td>
                    <td class="border-y-2 border-black px-4 py-2"></td>
                </tr>
            </table>
        </div>
        <!-- End Table Kedua -->

        <!-- Checkbox Terpenuhi & Tidak Terpenuhi -->
        <div class="mb-4 border-b-2 border-x-2 border-black p-2">
            <div class="flex flex-col">
                <label class="inline-flex items-center mb-2 ml-10">
                    <input type="checkbox" class="form-checkbox" name="status" value="terpenuhi">
                    <span class="ml-2 font-semibold">Terpenuhi</span>
                </label>
                <label class="inline-flex items-center ml-10">
                    <input type="checkbox" class="form-checkbox" name="status" value="tidak_terpenuhi">
                    <span class="ml-2 font-semibold">Tidak Terpenuhi</span>
                </label>
            </div>
            <div>
                <!-- Box Generator Atas/Bawah -->
                <h3 class="text-center font-bold my-2">GENERATOR ATAS/BAWAH</h3>
                <div class="border-2 border-black mx-4 p-4">
                        <div class="grid grid-cols-3 gap-4 ml-20">
                        <!-- Test 2a -->
                        <div class="p-4 text-center">
                            <p>TEST 2a</p>
                            <div class="relative flex border-2 border-black" style="height: 100px;">
                                <div class="bg-green-500 flex-1 flex items-center justify-center relative">
                                    <!-- Membuat garis hitam di tengah dengan ketebalan yang sama -->
                                    <div class="absolute right-0 top-0 bottom-0 w-0.5 border-r-2 border-black"></div>
                                </div>
                                <div class="bg-orange-500 flex-1 flex items-center justify-center relative">
                                    <!-- Membuat garis hitam di tengah dengan ketebalan yang sama -->
                                    <div class="absolute left-0 top-0 bottom-0 w-0.5 border-l-2 border-black"></div>
                                </div>
                                <div class="absolute inset-0 flex justify-center items-center" style="top: -37px;">
                                    <input type="checkbox" class="form-checkbox" style="width: 20px; height: 20px;">
                                </div>
                            </div>
                        </div>                                                                                                                  
                        <!-- Test 3 -->
                        <div class="p-4 text-center">
                            <p>TEST 3</p>
                            <div class="relative">
                                <div class="table border-2 border-black" style="width: 180%; height: 100px;">
                                    <div class="table-row">
                                        <div class="table-cell bg-blue-100 border-black border-r relative" style="width: 11.11%;">
                                            <input type="checkbox" class="form-checkbox w-4 h-4 absolute top-1/4 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                            <div class="absolute w-full h-0.5 bg-black top-1/2 left-0"></div>
                                        </div>
                                        <div class="table-cell bg-blue-200 border-black border-r relative" style="width: 11.11%;">
                                            <input type="checkbox" class="form-checkbox w-4 h-4 absolute top-1/4 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                            <div class="absolute w-full h-0.5 bg-black top-1/2 left-0"></div>
                                        </div>
                                        <div class="table-cell bg-blue-300 border-black border-r relative" style="width: 11.11%;">
                                            <input type="checkbox" class="form-checkbox w-4 h-4 absolute top-1/4 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                            <div class="absolute w-full h-0.5 bg-black top-1/2 left-0"></div>
                                        </div>
                                        <div class="table-cell bg-blue-400 border-black border-r relative" style="width: 11.11%;">
                                            <input type="checkbox" class="form-checkbox w-4 h-4 absolute top-1/4 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                            <div class="absolute w-full h-0.5 bg-black top-1/2 left-0"></div>
                                        </div>
                                        <div class="table-cell bg-blue-500 border-black border-r relative" style="width: 11.11%;">
                                            <input type="checkbox" class="form-checkbox w-4 h-4 absolute top-1/4 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                            <div class="absolute w-full h-0.5 bg-black top-1/2 left-0"></div>
                                        </div>
                                        <div class="table-cell bg-blue-600 border-black border-r relative" style="width: 11.11%;">
                                            <input type="checkbox" class="form-checkbox w-4 h-4 absolute top-1/4 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                            <div class="absolute w-full h-0.5 bg-black top-1/2 left-0"></div>
                                        </div>
                                        <div class="table-cell bg-blue-700 border-black border-r relative" style="width: 11.11%;">
                                            <input type="checkbox" class="form-checkbox w-4 h-4 absolute top-1/4 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                            <div class="absolute w-full h-0.5 bg-black top-1/2 left-0"></div>
                                        </div>
                                        <div class="table-cell bg-blue-800 border-black border-r relative" style="width: 11.11%;">
                                            <input type="checkbox" class="form-checkbox w-4 h-4 absolute top-1/4 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                            <div class="absolute w-full h-0.5 bg-black top-1/2 left-0"></div>
                                        </div>
                                        <div class="table-cell bg-blue-900 relative" style="width: 11.11%;">
                                            <input type="checkbox" class="form-checkbox w-4 h-4 absolute top-1/4 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                            <div class="absolute w-full h-0.5 bg-black top-1/2 left-0"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between mt-1" style="width: 180%;">
                                    <span class="text-center" style="width: 11.11%;">14</span>
                                    <span class="text-center" style="width: 11.11%;">16</span>
                                    <span class="text-center" style="width: 11.11%;">18</span>
                                    <span class="text-center" style="width: 11.11%;">20</span>
                                    <span class="text-center" style="width: 11.11%;">22</span>
                                    <span class="text-center" style="width: 11.11%;">24</span>
                                    <span class="text-center" style="width: 11.11%;">26</span>
                                    <span class="text-center" style="width: 11.11%;">28</span>
                                    <span class="text-center" style="width: 11.11%;">30</span>
                                </div>
                            </div>
                        </div>                                                                                                                                                                                                                                     
                        <!-- test lain -->
                        </div>
                    
                </div>
                <!-- Box Generator Samping -->
                <h3 class="text-center font-bold my-2">GENERATOR SAMPING</h3>
                <div class="border-2 border-black h-10 mx-4">
                    <!-- Tambahkan elemen sesuai kebutuhan -->
                </div>
            </div>
            </div>
        </div>
        <!-- End Checkbox Terpenuhi & Tidak Terpenuhi -->

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox" name="result" value="pass">
                <span class="ml-2">PASS</span>
            </label>
            <label class="inline-flex items-center ml-6">
                <input type="checkbox" class="form-checkbox" name="result" value="fail">
                <span class="ml-2">FAIL</span>
            </label>
        </div>

        <div class="flex justify-between">
            <div class="w-5/12 text-center">
                <p>Mengetahui,</p>
                <p>Airport Security Supervisor</p>
                <div class="h-20"></div>
                <p>__________________</p>
            </div>
            <div class="w-5/12 text-center">
                <p>Petugas Airport Security</p>
                <div class="h-20"></div>
                <p>__________________</p>
            </div>
        </div>
    </div>
</div>
@endsection
