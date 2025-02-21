<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\wtmdsaved;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use App\Models\User;

class WTMDFormController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Log untuk debugging
            Log::info('Checking location: ' . $request->location);
            Log::info('Last submission: ' . wtmdsaved::where('location', $request->location)
                ->where('created_at', '>=', now()->subMinutes(90))
                ->first()?->created_at);

            // Validasi form yang sudah ada
            if (wtmdsaved::hasSubmittedToday($request->location)) {
                $lastSubmission = wtmdsaved::where('location', $request->location)
                    ->where('status', '!=', 'rejected')
                    ->where('submitted_by', Auth::guard('officer')->id())
                    ->latest()
                    ->first();

                $minutesLeft = 90 - now()->diffInMinutes($lastSubmission->created_at);

                return response()->json([
                    'success' => false,
                    'message' => 'Form untuk lokasi ini sudah dibuat. Silakan tunggu ' . ceil($minutesLeft) . ' menit lagi sebelum membuat form baru.'
                ], 422);
            }

            // Validasi input
            $request->validate([
                'operatorName' => 'required|string',
                'testDateTime' => 'required|date',
                'location' => 'required|string',
                'deviceInfo' => 'required|string',
                'certificateInfo' => 'required|string',
                'terpenuhi' => 'boolean',
                'tidakterpenuhi' => 'boolean',

                // Test Depan
                'test1_in_depan' => 'nullable|boolean',
                'test1_out_depan' => 'nullable|boolean',
                'test2_in_depan' => 'nullable|boolean',
                'test2_out_depan' => 'nullable|boolean',
                'test4_in_depan' => 'nullable|boolean',
                'test4_out_depan' => 'nullable|boolean',

                // Test Belakang
                'test3_in_belakang' => 'nullable|boolean',
                'test3_out_belakang' => 'nullable|boolean',

                'result' => 'required|in:pass,fail',
                'notes' => 'nullable|string',
                'supervisor_id' => 'required|exists:users,id',
                'officer_signature_data' => 'required|string'
            ]);

            // Simpan form
            $form = new wtmdsaved($request->all());
            $form->status = 'pending_supervisor';
            $form->submitted_by = Auth::guard('officer')->id();
            $form->officerName = Auth::guard('officer')->user()->name;
            $form->officer_signature = $request->officer_signature_data;
            $form->save();

            return redirect()->route('officer.dashboard')
                ->with('success', 'Form WTMD berhasil disimpan dan menunggu persetujuan supervisor');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function review($id)
    {
        $form = wtmdsaved::findOrFail($id);
        $supervisor = User::find($form->supervisor_id);

        return view('review.wtmd.reviewwtmd', compact('form', 'supervisor'));
    }

    public function updateStatus(Request $request, $id)
    {
        $form = wtmdsaved::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending_supervisor,approved,rejected',
            'rejection_note' => 'required_if:status,rejected|nullable|string',
            'supervisor_signature_data' => 'nullable|string',
        ]);

        $form->status = $request->status;
        $form->reviewed_at = now();
        $form->reviewed_by = Auth::id();

        if ($request->status === 'rejected') {
            $form->rejection_note = $request->rejection_note;
        }

        if ($request->status === 'approved') {
            $form->supervisorName = Auth::user()->name;
            if ($request->has('supervisor_signature_data')) {
                $form->supervisor_signature = $request->supervisor_signature_data;
            }
        }

        try {
            $form->save();
            $message = $request->status === 'rejected'
                ? 'Form ditolak dan catatan telah disimpan.'
                : 'Form berhasil disetujui!';

            return redirect()->route('wtmdform')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Error updating WTMD status: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui status.');
        }
    }

    public function saveSupervisorSignature(Request $request, $id)
    {
        $form = wtmdsaved::findOrFail($id);

        $request->validate([
            'signature' => 'required|string',
        ]);

        $form->supervisor_signature = $request->signature;
        $form->supervisorName = Auth::user()->name;
        $form->save();

        return response()->json(['success' => true]);
    }

    public function create()
    {
        return view('officer.wtmd.create');
    }

    public function edit($id)
    {
        $form = wtmdsaved::findOrFail($id);

        if ($form->submitted_by !== Auth::guard('officer')->id()) {
            return redirect()->route('officer.dashboard')
                           ->with('error', 'Anda tidak memiliki akses ke form ini');
        }

        return view('officer.editwtmd', compact('form'));
    }

    public function update(Request $request, $id)
    {
        $form = wtmdsaved::findOrFail($id);

        if ($form->submitted_by !== Auth::guard('officer')->id()) {
            return redirect()->route('officer.dashboard')
                           ->with('error', 'Anda tidak memiliki akses ke form ini');
        }

        $validatedData = $request->validate([
            'operatorName' => 'required|string',
            'testDateTime' => 'required|date',
            'location' => 'required|string',
            'deviceInfo' => 'required|string',
            'certificateInfo' => 'required|string',
            'terpenuhi' => 'boolean',
            'tidakterpenuhi' => 'boolean',
            // Test Depan
            'test1_in_depan' => 'nullable|boolean',
            'test1_out_depan' => 'nullable|boolean',
            'test2_in_depan' => 'nullable|boolean',
            'test2_out_depan' => 'nullable|boolean',
            'test4_in_depan' => 'nullable|boolean',
            'test4_out_depan' => 'nullable|boolean',

            // Test Belakang
            'test3_in_belakang' => 'nullable|boolean',
            'test3_out_belakang' => 'nullable|boolean',

            'result' => 'required|in:pass,fail',
            'notes' => 'nullable|string',
        ]);

        try {
            // Update semua nilai checkbox
            $validatedData['status'] = 'pending_supervisor';
            $form->update($validatedData);
            $form->save();

            return redirect()->route('officer.dashboard')
                           ->with('success', 'Form berhasil diperbarui dan menunggu review ulang');
        } catch (\Exception $e) {
            Log::error('Error updating WTMD form: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui form');
        }
    }
}
