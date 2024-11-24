<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hhmdsaved;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use App\Models\User;

class HHMDFormController extends Controller
{

    public function store(Request $request)
    {
        Log::info('Received HHMD data:', $request->all());

        $validatedData = $request->validate([
            'operatorName' => 'required|string',
            'testDateTime' => 'required|date',
            'location' => 'required|string',
            'deviceInfo' => 'required|string',
            'certificateInfo' => 'required|string',
            'terpenuhi' => 'boolean',
            'tidakterpenuhi' => 'boolean',
            'test2' => 'nullable|boolean',
            'testCondition1' => 'boolean',
            'testCondition2' => 'boolean',
            'result' => 'required|in:pass,fail',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending_supervisor,approved,rejected',
            'officer_signature' => 'nullable|string',
            'supervisor_signature' => 'nullable|string',
            'supervisor_id' => 'required|exists:users,id,role,supervisor',
        ]);

        // Ubah nilai checkbox menjadi boolean
        $validatedData['terpenuhi'] = $request->has('terpenuhi');
        $validatedData['tidakterpenuhi'] = $request->has('tidakterpenuhi');
        $validatedData['test1'] = $request->has('test1');
        $validatedData['test2'] = $request->has('test2');
        $validatedData['test3'] = $request->has('test3');
        $validatedData['testCondition1'] = $request->has('testCondition1');
        $validatedData['testCondition2'] = $request->has('testCondition2');

        // Menyimpan data tanda tangan jika ada
        if ($request->has('officer_signature_data')) {
            $validatedData['officer_signature'] = $request->input('officer_signature_data'); // Simpan tanda tangan officer
        }

        if ($request->has('supervisor_signature_data')) {
            $validatedData['supervisor_signature'] = $request->input('supervisor_signature_data'); // Simpan tanda tangan supervisor
        }

        $hhmdsave = new hhmdsaved($validatedData);
        if (Auth::guard('web')->check()) {
            $hhmdsave->submitted_by = Auth::guard('web')->id();
            $hhmdsave->officerName = Auth::user()->name;
        } elseif (Auth::guard('officer')->check()) {
            $hhmdsave->submitted_by = Auth::guard('officer')->id();
            $hhmdsave->officerName = Auth::guard('officer')->user()->name;
        } else {
            return redirect()->back()->with('error', 'Anda harus login untuk mengirimkan formulir ini.');
        }

        $hhmdsave->supervisor_id = $validatedData['supervisor_id'];

        try {
            $hhmdsave->save();
            return redirect()->route('officer.dashboard')->with('success', 'HHMD data berhasil disimpan dan menunggu persetujuan supervisor.');
        } catch (\Exception $e) {
            Log::error('Error saving HHMD data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }


    public function review($id)
    {
        $form = hhmdsaved::findOrFail($id);
        $supervisor = User::find($form->supervisor_id);

        return view('review.hhmd.reviewhhmd', compact('form', 'supervisor'));
    }

    public function updateStatus(Request $request, $id)
    {
        $form = hhmdsaved::findOrFail($id);

        // Validasi input
        $request->validate([
            'status' => 'required|in:pending_supervisor,approved,rejected',
            'rejection_note' => 'required_if:status,rejected|nullable|string',
            'supervisor_signature_data' => 'nullable|string',
        ]);

        // Update status dan data review
        $form->status = $request->status;
        $form->reviewed_at = now();
        $form->reviewed_by = Auth::id();

        // Jika ditolak, simpan catatan penolakan
        if ($request->status === 'rejected') {
            $form->rejection_note = $request->rejection_note;
        }

        // Jika disetujui
        if ($request->status === 'approved') {
            $form->supervisorName = Auth::user()->name;
            // Simpan tanda tangan supervisor jika ada
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
            Log::error('Error updating HHMD status: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui status.');
        }
    }

    public function saveSupervisorSignature(Request $request, $id)
    {
        $form = hhmdsaved::findOrFail($id);

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
        return view('officer.hhmd.create');
    }

    public function edit($id)
    {
        $form = hhmdsaved::findOrFail($id);

        // Pastikan officer hanya bisa edit formnya sendiri
        if ($form->submitted_by !== Auth::guard('officer')->id()) {
            return redirect()->route('officer.dashboard')
                           ->with('error', 'Anda tidak memiliki akses ke form ini');
        }

        return view('officer.edit', compact('form'));
    }

    public function update(Request $request, $id)
    {
        $form = hhmdsaved::findOrFail($id);

        // Validasi akses
        if ($form->submitted_by !== Auth::guard('officer')->id()) {
            return redirect()->route('officer.dashboard')
                           ->with('error', 'Anda tidak memiliki akses ke form ini');
        }

        // Validasi tanpa status
        $validatedData = $request->validate([
            'operatorName' => 'required|string',
            'testDateTime' => 'required|date',
            'location' => 'required|string',
            'deviceInfo' => 'required|string',
            'certificateInfo' => 'required|string',
            'terpenuhi' => 'boolean',
            'tidakterpenuhi' => 'boolean',
            'test2' => 'nullable|boolean',
            'testCondition1' => 'boolean',
            'testCondition2' => 'boolean',
            'result' => 'required|in:pass,fail',
            'notes' => 'nullable|string',
        ]);

        try {
            // Ubah nilai checkbox menjadi boolean
            $validatedData['terpenuhi'] = $request->has('terpenuhi');
            $validatedData['tidakterpenuhi'] = $request->has('tidakterpenuhi');
            $validatedData['test2'] = $request->has('test2');
            $validatedData['testCondition1'] = $request->has('testCondition1');
            $validatedData['testCondition2'] = $request->has('testCondition2');

            // Set status ke pending_supervisor
            $validatedData['status'] = 'pending_supervisor';

            $form->update($validatedData);
            $form->status = 'pending_supervisor'; // Reset status ke pending
            $form->save();

            return redirect()->route('officer.dashboard')
                           ->with('success', 'Form berhasil diperbarui dan menunggu review ulang');
        } catch (\Exception $e) {
            Log::error('Error updating HHMD form: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui form');
        }
    }

}
