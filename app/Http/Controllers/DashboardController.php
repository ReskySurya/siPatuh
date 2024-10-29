<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hhmdsaved;
use App\Models\wtmdsaved;
use App\Models\xraysaved;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pendingHhmdForms = collect();
        $pendingWtmdForms = collect();
        $pendingXrayForms = collect();

        if ($user->role == 'supervisor' || $user->role == 'superadmin') {
            $pendingHhmdForms = hhmdsaved::where('status', 'pending_supervisor')->get();
            // $pendingWtmdForms = wtmdsaved::where('status', 'pending_supervisor')->get();
            // $pendingXrayForms = xraysaved::where('status', 'pending_supervisor')->get();
        }

        return view('dashboard', compact('pendingHhmdForms', 'pendingWtmdForms', 'pendingXrayForms'));
    }

    public function hhmdIndex()
    {
        $pendingHhmdForms = hhmdsaved::where('status', 'pending_supervisor')->get();
        $allHhmdForms = hhmdsaved::all();
        $passorfailForms = hhmdsaved::whereIn('status', ['approved', 'rejected'])->get();
        return view('hhmdform', compact('pendingHhmdForms', 'allHhmdForms', 'passorfailForms'));
    }

    // public function wtmdIndex()
    // {
    //     $pendingWtmdForms = wtmdsaved::where('status', 'pending_supervisor')->get();
    //     $allWtmdForms = wtmdsaved::all();
    //     return view('wtmd.index', compact('pendingWtmdForms', 'allWtmdForms'));
    // }

    // public function xrayIndex()
    // {
    //     $pendingXrayForms = xraysaved::where('status', 'pending_supervisor')->get();
    //     $allXrayForms = xraysaved::all();
    //     return view('xray.index', compact('pendingXrayForms', 'allXrayForms'));
    // }

    public function dateRange(Request $request)
{
    $query = hhmdsaved::query();

    if ($request->has('start_date') && $request->has('end_date')) {
        $query->whereBetween('testDateTime', [$request->start_date, $request->end_date]);
    }

    $allHhmdForms = $query->get();
    $passorfailForms = $query->where('status', '!=', 'pending_supervisor')->get();

    if ($request->ajax()) {
        return response()->json([
            'allHhmdForms' => $allHhmdForms,
            'passorfailForms' => $passorfailForms
        ]);
    }

    return view('hhmdform', compact('allHhmdForms', 'passorfailForms'));
}
}
