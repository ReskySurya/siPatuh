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

        if ($user->role == 'supervisor' || $user->role == 'superadmin') {
            $pendingHhmdForms = hhmdsaved::where('status', 'pending_supervisor')->get();
            // $pendingWtmdForms = wtmdsaved::where('status', 'pending_supervisor')->get();
            // $pendingXrayForms = xraysaved::where('status', 'pending_supervisor')->get();
        }

        return view('dashboard', compact('pendingHhmdForms', 'pendingWtmdForms', 'pendingXrayForms'));
    }

    public function hhmdIndex()
    {
        $pendingHhmdForms = hhmdsaved::where('status', 'pending_supervisor')
            ->orderBy('testDateTime', 'desc')
            ->paginate(5);
        $allHhmdForms = hhmdsaved::orderBy('testDateTime', 'desc')->paginate(5);
        $passorfailForms = hhmdsaved::whereIn('status', ['approved', 'rejected'])->get();
        return view('hhmdform', compact('pendingHhmdForms', 'allHhmdForms', 'passorfailForms'));
    }


    public function filterByDate(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        try {
            $filteredForms = hhmdsaved::whereBetween('testDateTime', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay(),
            ])->get();

            // Tambahkan penanganan jika tidak ada data
            if ($filteredForms->isEmpty()) {
                return back()->with('status', 'Tidak ada data yang ditemukan dalam rentang tanggal tersebut.');
            }

            // Kembalikan ke view dengan data yang sudah difilter
            return view('hhmdform', [
                'allHhmdForms' => $filteredForms,
                'pendingHhmdForms' => $filteredForms->where('status', 'pending_supervisor'),
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);
        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Filter HHMD Error: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Terjadi kesalahan saat memfilter data: ' . $e->getMessage()]);
        }
    }
}
