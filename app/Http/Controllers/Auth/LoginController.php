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

        // Coba login untuk setiap guard secara spesifik
        $guards = ['web', 'officer'];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->attempt($credentials)) {
                // Logout dari guard lain
                foreach (array_diff($guards, [$guard]) as $otherGuard) {
                    Auth::guard($otherGuard)->logout();
                }

                $request->session()->regenerate();

                // Redirect berdasarkan guard
                switch ($guard) {
                    case 'officer':
                        return redirect()->intended('/officer/dashboard');
                    case 'web':
                        return redirect()->intended('/dashboard');
                }
            }
        }

        return back()->withErrors([
            'login' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ]);
    }

    public function logout(Request $request)
    {
        // Logout dari semua guard
        $guards = ['web', 'officer'];

        foreach ($guards as $guard) {
            Auth::guard($guard)->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
