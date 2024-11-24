<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $loginField = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'nip';

        $credentials = [
            $loginField => $request->input('login'),
            'password' => $request->input('password'),
        ];

        // Coba login untuk setiap guard
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();

            // Cek role user
            switch ($user->role) {
                case 'superadmin':
                    $request->session()->regenerate();
                    return redirect()->intended('/dashboard');
                case 'supervisor':
                    $request->session()->regenerate();
                    return redirect()->intended('/dashboard');
                default:
                    Auth::guard('web')->logout();
                    return back()->withErrors([
                        'login' => 'Anda tidak memiliki akses yang sesuai.',
                    ]);
            }
        }

        // Coba login untuk officer
        if (Auth::guard('officer')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/officer/dashboard');
        }

        return back()->withErrors([
            'login' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ]);
    }

    public function logout(Request $request)
    {
        // Logout hanya dari guard yang aktif
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
