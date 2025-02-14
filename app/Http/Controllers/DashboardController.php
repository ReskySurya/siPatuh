<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hhmdsaved;
use App\Models\wtmdsaved;
use App\Models\xraysaved;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pendingHhmdForms = collect();
        $pendingWtmdForms = collect();
        $pendingXrayForms = collect();

        if ($user->role == 'supervisor') {
            $pendingHhmdForms = hhmdsaved::where('status', 'pending_supervisor')
                ->where('supervisor_id', $user->id)
                ->get();
            $pendingWtmdForms = wtmdsaved::where('status', 'pending_supervisor')
                ->where('supervisor_id', $user->id)
                ->get();
            $pendingXrayForms = xraysaved::where('status', 'pending_supervisor')
                ->where('supervisor_id', $user->id)
                ->get();
        } elseif ($user->role == 'superadmin') {
            $pendingHhmdForms = hhmdsaved::where('status', 'pending_supervisor')->get();
            $pendingWtmdForms = wtmdsaved::where('status', 'pending_supervisor')->get();
            $pendingXrayForms = xraysaved::where('status', 'pending_supervisor')->get();
        }

        return view('dashboard', compact('pendingHhmdForms', 'pendingWtmdForms', 'pendingXrayForms'));
    }

    public function hhmdIndex()
    {
        $user = Auth::user();
        $locations = [
            'HBSCP',
            'Pos Kedatangan',
            'Pos Timur',
            'PSCP Selatan',
            'Pos Barat',
            'PSCP Utara'
        ];

        $pendingCounts = [];

        // Query dasar
        $baseQuery = hhmdsaved::where('status', 'pending_supervisor');

        if ($user->role == 'supervisor') {
            $baseQuery->where('supervisor_id', $user->id);
        }

        // Hitung pending untuk setiap lokasi
        foreach ($locations as $location) {
            $pendingCounts[$location] = (clone $baseQuery)
                ->where('location', $location)
                ->count();
        }

        // Query untuk semua form
        $allHhmdForms = hhmdsaved::when($user->role == 'supervisor', function ($query) use ($user) {
            return $query->where('supervisor_id', $user->id);
        })
        ->orderBy('testDateTime', 'desc')
        ->paginate(5);

        // Query untuk form yang sudah diputuskan
        $passorfailForms = hhmdsaved::whereIn('status', ['approved', 'rejected'])->get();

        return view('hhmdform', compact('pendingCounts', 'allHhmdForms', 'passorfailForms'));
    }

    public function wtmdIndex()
    {
        $user = Auth::user();
        $locations = [
            'Pos Timur',
            'PSCP Selatan',
            'PSCP Utara'
        ];

        $pendingCounts = [];

        // Query dasar
        $baseQuery = wtmdsaved::where('status', 'pending_supervisor');

        if ($user->role == 'supervisor') {
            $baseQuery->where('supervisor_id', $user->id);
        }

        // Hitung pending untuk setiap lokasi
        foreach ($locations as $location) {
            $pendingCounts[$location] = (clone $baseQuery)
                ->where('location', $location)
                ->count();
        }

        // Query untuk semua form
        $allWtmdForms = wtmdsaved::when($user->role == 'supervisor', function ($query) use ($user) {
            return $query->where('supervisor_id', $user->id);
        })
        ->orderBy('testDateTime', 'desc')
        ->paginate(5);

        // Query untuk form yang sudah diputuskan
        $passorfailForms = wtmdsaved::whereIn('status', ['approved', 'rejected'])->get();

        return view('wtmdform', compact('pendingCounts', 'allWtmdForms', 'passorfailForms'));
    }

    public function xrayIndex()
    {
        $user = Auth::user();
        $locations = [
            'HBSCP Bagasi Timur',
            'HBSCP Bagasi Barat',
            'PSCP Cabin Selatan',
            'PSCP Cabin Utara'
        ];

        $pendingCounts = [];

        // Query dasar
        $baseQuery = xraysaved::where('status', 'pending_supervisor');

        if ($user->role == 'supervisor') {
            $baseQuery->where('supervisor_id', $user->id);
        }

        // Hitung pending untuk setiap lokasi
        foreach ($locations as $location) {
            $pendingCounts[$location] = (clone $baseQuery)
                ->where('location', $location)
                ->count();
        }

        // Query untuk semua form
        $allXrayForms = xraysaved::when($user->role == 'supervisor', function ($query) use ($user) {
            return $query->where('supervisor_id', $user->id);
        })
        ->orderBy('testDateTime', 'desc')
        ->paginate(5);

        // Query untuk form yang sudah diputuskan
        $passorfailForms = xraysaved::whereIn('status', ['approved', 'rejected'])->get();

        return view('xrayform', compact('pendingCounts', 'allXrayForms', 'passorfailForms'));
    }


    public function kedatangan_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Kedatangan
        $baseQuery = hhmdsaved::where('location', 'Pos Kedatangan');

        if ($user->role == 'supervisor') {
            $allHhmdForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allHhmdForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.kedatangan', compact('allHhmdForms'));
    }

    public function postimur_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Kedatangan
        $baseQuery = hhmdsaved::where('location', 'Pos Timur');

        if ($user->role == 'supervisor') {
            $allHhmdForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allHhmdForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.postimur', compact('allHhmdForms'));
    }


    public function posbarat_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Kedatangan
        $baseQuery = hhmdsaved::where('location', 'Pos Barat');

        if ($user->role == 'supervisor') {
            $allHhmdForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allHhmdForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.posbarat', compact('allHhmdForms'));
    }


    public function pscputara_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Kedatangan
        $baseQuery = hhmdsaved::where('location', 'PSCP Utara');

        if ($user->role == 'supervisor') {
            $allHhmdForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allHhmdForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.pscputara', compact('allHhmdForms'));
    }


    public function pscpselatan_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Kedatangan
        $baseQuery = hhmdsaved::where('location', 'PSCP Selatan');

        if ($user->role == 'supervisor') {
            $allHhmdForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allHhmdForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.pscpselatan', compact('allHhmdForms'));
    }


    public function hbscp_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Kedatangan
        $baseQuery = hhmdsaved::where('location', 'HBSCP');

        if ($user->role == 'supervisor') {
            $allHhmdForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allHhmdForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.hbscp', compact('allHhmdForms'));
    }


    public function wtmd_postimur_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Timur khusus WTMD
        $baseQuery = wtmdsaved::where('location', 'Pos Timur');

        if ($user->role == 'supervisor') {
            $allWtmdForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allWtmdForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.wtmd.postimur', compact('allWtmdForms'));
    }

    public function wtmd_pscpselatan_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi PSCP Selatan khusus WTMD
        $baseQuery = wtmdsaved::where('location', 'PSCP Selatan');

        if ($user->role == 'supervisor') {
            $allWtmdForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allWtmdForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.wtmd.pscpselatan', compact('allWtmdForms'));
    }


    public function wtmd_pscputara_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Timur khusus WTMD
        $baseQuery = wtmdsaved::where('location', 'PSCP Utara');

        if ($user->role == 'supervisor') {
            $allWtmdForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allWtmdForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.wtmd.pscputara', compact('allWtmdForms'));
    }

    public function xray_cabinutara_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Timur khusus WTMD
        $baseQuery = xraysaved::where('location', 'PSCP Cabin Utara');

        if ($user->role == 'supervisor') {
            $allXrayForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allXrayForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.xray.cabinutara', compact('allXrayForms'));
    }

    public function xray_cabinselatan_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Timur khusus WTMD
        $baseQuery = xraysaved::where('location', 'PSCP Cabin Selatan');

        if ($user->role == 'supervisor') {
            $allXrayForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allXrayForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.xray.cabinselatan', compact('allXrayForms'));
    }

    public function xray_bagasibarat_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Timur khusus WTMD
        $baseQuery = xraysaved::where('location', 'HBSCP Bagasi Barat');

        if ($user->role == 'supervisor') {
            $allXrayForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allXrayForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.xray.bagasibarat', compact('allXrayForms'));
    }

    public function xray_bagasitimur_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Timur khusus WTMD
        $baseQuery = xraysaved::where('location', 'HBSCP Bagasi Timur');

        if ($user->role == 'supervisor') {
            $allXrayForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allXrayForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.xray.bagasitimur', compact('allXrayForms'));
    }
}
