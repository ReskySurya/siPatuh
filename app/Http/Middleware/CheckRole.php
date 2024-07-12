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
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        if (Auth::guard('officer')->check()) {
            if (in_array('officer', $roles)) {
                return $next($request);
            }
        } elseif (in_array($user->role, $roles)) {
            return $next($request);
        }

        return redirect('/')->with('error', 'You do not have permission to access this page.');

    }
}