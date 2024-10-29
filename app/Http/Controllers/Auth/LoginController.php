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

        if (Auth::guard('officer')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/officer/dashboard');
        }

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'login' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ]);
    }

     /**
     * Handle user logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
