<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'min:8',
                'confirmed'
            ],
        ]);

        $user = auth()->user() ?? auth('officer')->user();

        // Cek autentikasi user
        if (!$user) {
            return back()->withErrors(['auth' => 'User tidak terautentikasi']);
        }

        // Verifikasi password saat ini
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
        }

        // Cek apakah password baru sama dengan password default
        if ($request->new_password === 'p4ssword') {
            return back()->withErrors(['new_password' => 'Password baru tidak boleh sama dengan password default']);
        }

        try {
            // Update password
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('dashboard')
                ->with('success', 'Password berhasil diubah');
        } catch (\Exception $e) {
            return back()->withErrors(['database' => 'Gagal menyimpan password baru']);
        }
    }
}
