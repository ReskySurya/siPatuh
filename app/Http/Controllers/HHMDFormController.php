<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hhmdsaved;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
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

        try {
            $hhmdsave->save();
            return redirect()->route('officer.dashboard')->with('success', 'HHMD data berhasil disimpan.');
        } catch (\Exception $e) {
            Log::error('Error saving HHMD data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    public function review($id)
    {
        $form = hhmdsaved::findOrFail($id);
        return view('review.hhmd.reviewhhmd', compact('form'));
    }

    public function updateStatus(Request $request, $id)
    {
        $form = hhmdsaved::findOrFail($id);

        // Validasi status
        $request->validate([
            'status' => 'required|string',
            // Tambahkan validasi lain jika perlu
        ]);

        // Update status
        $form->status = $request->input('status');

        // Simpan tanda tangan jika ada
        if ($request->has('supervisor_signature_data')) {
            $form->supervisor_signature = $request->input('supervisor_signature_data');
        }

        $form->save();

        return redirect()->route('dashboard', $form->id)->with('success', 'Status berhasil diperbarui!');
    }

    public function saveSupervisorSignature(Request $request, $id)
    {
        $form = hhmdsaved::findOrFail($id);

        $request->validate([
            'signature' => 'required|string',
        ]);

        $form->supervisor_signature = $request->input('signature');
        $form->save();

        return response()->json(['success' => true]);
    }


}
