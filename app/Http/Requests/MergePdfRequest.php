<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MergePdfRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Pastikan untuk mengatur ini sesuai kebutuhan otorisasi Anda
    }

    public function rules()
    {
        return [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ];
    }

    public function messages()
    {
        return [
            'start_date.required' => 'Tanggal awal harus diisi',
            'end_date.required' => 'Tanggal akhir harus diisi',
            'end_date.after_or_equal' => 'Tanggal akhir harus setelah atau sama dengan tanggal awal'
        ];
    }
}
