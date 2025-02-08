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
        Log::info('Received WTMD data:', $request->all());

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
            'status' => 'required|in:pending_supervisor,approved,rejected',
            'officer_signature' => 'nullable|string',
            'supervisor_signature' => 'nullable|string',
            'supervisor_id' => 'required|exists:users,id,role,supervisor',
            'officerName' => 'required|string'
        ]);

        // Ubah nilai checkbox menjadi boolean
        $validatedData['terpenuhi'] = $request->has('terpenuhi');
        $validatedData['tidakterpenuhi'] = $request->has('tidakterpenuhi');

        // Test Depan
        $validatedData['test1_in_depan'] = $request->has('test1_in_depan');
        $validatedData['test1_out_depan'] = $request->has('test1_out_depan');
        $validatedData['test2_in_depan'] = $request->has('test2_in_depan');
        $validatedData['test2_out_depan'] = $request->has('test2_out_depan');
        $validatedData['test4_in_depan'] = $request->has('test4_in_depan');
        $validatedData['test4_out_depan'] = $request->has('test4_out_depan');

        // Test Belakang
        $validatedData['test3_in_belakang'] = $request->has('test3_in_belakang');
        $validatedData['test3_out_belakang'] = $request->has('test3_out_belakang');

        if ($request->has('officer_signature_data')) {
            $validatedData['officer_signature'] = $request->input('officer_signature_data');
        }

        if ($request->has('supervisor_signature_data')) {
            $validatedData['supervisor_signature'] = $request->input('supervisor_signature_data');
        }

        $wtmdsave = new wtmdsaved($validatedData);
        if (Auth::guard('web')->check()) {
            $wtmdsave->submitted_by = Auth::guard('web')->id();
            $wtmdsave->officerName = Auth::user()->name;
        } elseif (Auth::guard('officer')->check()) {
            $wtmdsave->submitted_by = Auth::guard('officer')->id();
            $wtmdsave->officerName = Auth::guard('officer')->user()->name;
        } else {
            return redirect()->back()->with('error', 'Anda harus login untuk mengirimkan formulir ini.');
        }

        $wtmdsave->supervisor_id = $validatedData['supervisor_id'];

        try {
            $wtmdsave->save();
            return redirect()->route('officer.dashboard')->with('success', 'WTMD data berhasil disimpan dan menunggu persetujuan supervisor.');
        } catch (\Exception $e) {
            Log::error('Error saving WTMD data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
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

            return redirect()->route('dashboard')->with('success', $message);
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
