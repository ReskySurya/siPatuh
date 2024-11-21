<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Periksa autentikasi untuk setiap guard
        $guards = ['web', 'officer'];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                // Untuk officer, periksa role secara langsung
                if ($guard === 'officer' && in_array('officer', $roles)) {
                    return $next($request);
                }

                // Untuk web, periksa role
                if ($guard === 'web' && in_array($user->role, $roles)) {
                    return $next($request);
                }
            }
        }

        return redirect('/')->with('error', 'You do not have permission to access this page.');
    }
}
