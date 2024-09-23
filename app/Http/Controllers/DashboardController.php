<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hhmdsaved;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pendingForms = collect();
        $correctedForms = collect();

        if ($user->role == 'supervisor' || $user->role == 'superadmin') {
            $pendingForms = hhmdsaved::where('status', 'pending_supervisor')->get();
            $correctedForms = hhmdsaved::whereIn('status', ['approved', 'rejected'])->get();
        }

        return view('dashboard', compact('pendingForms', 'correctedForms'));
    }
}
