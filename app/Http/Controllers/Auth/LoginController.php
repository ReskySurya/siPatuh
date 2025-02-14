<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Officer;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $login = $request->input('login');
        $password = $request->input('password');

        // Coba login sebagai User
        $userCredentials = [
            'password' => $password
        ];

        // Cek apakah login menggunakan email atau NIP untuk User
        $user = User::where('email', $login)
                   ->orWhere('nip', $login)
                   ->first();

        if ($user) {
            $userCredentials[filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nip'] = $login;

            if (Auth::guard('web')->attempt($userCredentials)) {
                $request->session()->regenerate();

                switch ($user->role) {
                    case 'superadmin':
                    case 'supervisor':
                        return redirect()->intended('/dashboard');
                    default:
                        Auth::guard('web')->logout();
                        return back()->withErrors([
                            'login' => 'Anda tidak memiliki akses yang sesuai.',
                        ]);
                }
            }
        }

        // Coba login sebagai Officer
        $officerCredentials = [
            'password' => $password
        ];

        // Cek apakah login menggunakan email atau NIP untuk Officer
        $officer = Officer::where('email', $login)
                        ->orWhere('nip', $login)
                        ->first();

        if ($officer) {
            $officerCredentials[filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nip'] = $login;

            if (Auth::guard('officer')->attempt($officerCredentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/officer/dashboard');
            }
        }

        // Jika semua percobaan login gagal
        return back()->withErrors([
            'login' => 'Email/NIP atau password yang diberikan tidak cocok dengan data kami.',
        ])->withInput($request->only('login'));
    }

    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
        if (Auth::guard('officer')->check()) {
            Auth::guard('officer')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
