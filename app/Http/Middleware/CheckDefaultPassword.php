<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CheckDefaultPassword
{
    public function handle(Request $request, Closure $next)
    {
        // Ambil user yang sedang login
        $user = auth()->user() ?? auth('officer')->user();

        if ($user) {
            // Cek password default dengan lebih eksplisit
            $isUsingDefaultPassword = Hash::check('p4ssword', $user->password);

            if ($isUsingDefaultPassword) {
                // Izinkan akses ke route change password
                if ($request->routeIs('password.change') || $request->routeIs('password.update')) {
                    return $next($request);
                }

                // Redirect ke halaman change password untuk route lainnya
                return redirect()->route('password.change')
                    ->with('warning', 'Anda harus mengganti password default sebelum melanjutkan.');
            }
        }

        return $next($request);
    }
}
