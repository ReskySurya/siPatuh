<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\xraysaved;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use App\Models\User;

class XRAYFormController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Log untuk debugging
            Log::info('Checking location: ' . $request->location);
            Log::info('Last submission: ' . xraysaved::where('location', $request->location)
                ->where('created_at', '>=', now()->subMinutes(90))
                ->first()?->created_at);

            // Validasi form yang sudah ada
            if (xraysaved::hasSubmittedToday($request->location)) {
                $lastSubmission = xraysaved::where('location', $request->location)
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

            // Validasi input yang sudah ada
            $validatedData = $request->validate([
                'operatorName' => 'required|string',
                'testDateTime' => 'required|date',
                'location' => 'required|string',
                'deviceInfo' => 'required|string',
                'certificateInfo' => 'required|string',
                'terpenuhi' => 'boolean',
                'tidakterpenuhi' => 'boolean',

                // Generator Atas/Bawah
                'test2aab' => 'nullable|boolean',
                'test2bab' => 'nullable|boolean',
                'test3ab_14' => 'nullable|boolean',
                'test3ab_16' => 'nullable|boolean',
                'test3ab_18' => 'nullable|boolean',
                'test3ab_20' => 'nullable|boolean',
                'test3ab_22' => 'nullable|boolean',
                'test3ab_24' => 'nullable|boolean',
                'test3ab_26' => 'nullable|boolean',
                'test3ab_28' => 'nullable|boolean',
                'test3ab_30' => 'nullable|boolean',

                // Test 1a dan 1b Atas/Bawah
                'test1aab_36' => 'nullable|boolean',
                'test1aab_32' => 'nullable|boolean',
                'test1aab_30' => 'nullable|boolean',
                'test1aab_24' => 'nullable|boolean',
                'test1bab_36_1' => 'nullable|boolean',
                'test1bab_32_1' => 'nullable|boolean',
                'test1bab_30_1' => 'nullable|boolean',
                'test1bab_24_1' => 'nullable|boolean',
                'test1bab_36_2' => 'nullable|boolean',
                'test1bab_32_2' => 'nullable|boolean',
                'test1bab_30_2' => 'nullable|boolean',
                'test1bab_24_2' => 'nullable|boolean',
                'test1bab_36_3' => 'nullable|boolean',
                'test1bab_32_3' => 'nullable|boolean',
                'test1bab_30_3' => 'nullable|boolean',
                'test1bab_24_3' => 'nullable|boolean',

                // Test 4 Atas/Bawah
                'test4ab_h10mm' => 'nullable|boolean',
                'test4ab_v10mm' => 'nullable|boolean',

                // Test 5 Atas/Bawah
                'test5ab_05mm' => 'nullable|boolean',
                'test5ab_10mm' => 'nullable|boolean',
                'test5ab_15mm' => 'nullable|boolean',

                // Generator Bawah
                'test2ab' => 'nullable|boolean',
                'test2bb' => 'nullable|boolean',
                'test3b_14' => 'nullable|boolean',
                'test3b_16' => 'nullable|boolean',
                'test3b_18' => 'nullable|boolean',
                'test3b_20' => 'nullable|boolean',
                'test3b_22' => 'nullable|boolean',
                'test3b_24' => 'nullable|boolean',
                'test3b_26' => 'nullable|boolean',
                'test3b_28' => 'nullable|boolean',
                'test3b_30' => 'nullable|boolean',

                // Test 1a dan 1b Bawah
                'test1ab_36' => 'nullable|boolean',
                'test1ab_32' => 'nullable|boolean',
                'test1ab_30' => 'nullable|boolean',
                'test1ab_24' => 'nullable|boolean',
                'test1bb_36_1' => 'nullable|boolean',
                'test1bb_32_1' => 'nullable|boolean',
                'test1bb_30_1' => 'nullable|boolean',
                'test1bb_24_1' => 'nullable|boolean',
                'test1bb_36_2' => 'nullable|boolean',
                'test1bb_32_2' => 'nullable|boolean',
                'test1bb_30_2' => 'nullable|boolean',
                'test1bb_24_2' => 'nullable|boolean',
                'test1bb_36_3' => 'nullable|boolean',
                'test1bb_32_3' => 'nullable|boolean',
                'test1bb_30_3' => 'nullable|boolean',
                'test1bb_24_3' => 'nullable|boolean',

                // Test 4 Bawah
                'test4b_h10mm' => 'nullable|boolean',
                'test4b_v10mm' => 'nullable|boolean',

                // Test 5 Bawah
                'test5b_05mm' => 'nullable|boolean',
                'test5b_10mm' => 'nullable|boolean',
                'test5b_15mm' => 'nullable|boolean',

                // Form fields
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

            // Generator Atas/Bawah
            $validatedData['test2aab'] = $request->has('test2aab');
            $validatedData['test2bab'] = $request->has('test2bab');
            $validatedData['test3ab_14'] = $request->has('test3ab_14');
            $validatedData['test3ab_16'] = $request->has('test3ab_16');
            $validatedData['test3ab_18'] = $request->has('test3ab_18');
            $validatedData['test3ab_20'] = $request->has('test3ab_20');
            $validatedData['test3ab_22'] = $request->has('test3ab_22');
            $validatedData['test3ab_24'] = $request->has('test3ab_24');
            $validatedData['test3ab_26'] = $request->has('test3ab_26');
            $validatedData['test3ab_28'] = $request->has('test3ab_28');
            $validatedData['test3ab_30'] = $request->has('test3ab_30');

            // Test 1a dan 1b Atas/Bawah
            $validatedData['test1aab_36'] = $request->has('test1aab_36');
            $validatedData['test1aab_32'] = $request->has('test1aab_32');
            $validatedData['test1aab_30'] = $request->has('test1aab_30');
            $validatedData['test1aab_24'] = $request->has('test1aab_24');
            $validatedData['test1bab_36_1'] = $request->has('test1bab_36_1');
            $validatedData['test1bab_32_1'] = $request->has('test1bab_32_1');
            $validatedData['test1bab_30_1'] = $request->has('test1bab_30_1');
            $validatedData['test1bab_24_1'] = $request->has('test1bab_24_1');
            $validatedData['test1bab_36_2'] = $request->has('test1bab_36_2');
            $validatedData['test1bab_32_2'] = $request->has('test1bab_32_2');
            $validatedData['test1bab_30_2'] = $request->has('test1bab_30_2');
            $validatedData['test1bab_24_2'] = $request->has('test1bab_24_2');
            $validatedData['test1bab_36_3'] = $request->has('test1bab_36_3');
            $validatedData['test1bab_32_3'] = $request->has('test1bab_32_3');
            $validatedData['test1bab_30_3'] = $request->has('test1bab_30_3');
            $validatedData['test1bab_24_3'] = $request->has('test1bab_24_3');

            // Test 4 Atas/Bawah
            $validatedData['test4ab_h10mm'] = $request->has('test4ab_h10mm');
            $validatedData['test4ab_v10mm'] = $request->has('test4ab_v10mm');
            $validatedData['test4ab_h15mm'] = $request->has('test4ab_h15mm');
            $validatedData['test4ab_v15mm'] = $request->has('test4ab_v15mm');
            $validatedData['test4ab_h20mm'] = $request->has('test4ab_h20mm');
            $validatedData['test4ab_v20mm'] = $request->has('test4ab_v20mm');

            // Test 5 Atas/Bawah
            $validatedData['test5ab_05mm'] = $request->has('test5ab_05mm');
            $validatedData['test5ab_10mm'] = $request->has('test5ab_10mm');
            $validatedData['test5ab_15mm'] = $request->has('test5ab_15mm');

            // Generator Bawah
            $validatedData['test2ab'] = $request->has('test2ab');
            $validatedData['test2bb'] = $request->has('test2bb');
            $validatedData['test3b_14'] = $request->has('test3b_14');
            $validatedData['test3b_16'] = $request->has('test3b_16');
            $validatedData['test3b_18'] = $request->has('test3b_18');
            $validatedData['test3b_20'] = $request->has('test3b_20');
            $validatedData['test3b_22'] = $request->has('test3b_22');
            $validatedData['test3b_24'] = $request->has('test3b_24');
            $validatedData['test3b_26'] = $request->has('test3b_26');
            $validatedData['test3b_28'] = $request->has('test3b_28');
            $validatedData['test3b_30'] = $request->has('test3b_30');

            // Test 1a dan 1b Bawah
            $validatedData['test1ab_36'] = $request->has('test1ab_36');
            $validatedData['test1ab_32'] = $request->has('test1ab_32');
            $validatedData['test1ab_30'] = $request->has('test1ab_30');
            $validatedData['test1ab_24'] = $request->has('test1ab_24');
            $validatedData['test1bb_36_1'] = $request->has('test1bb_36_1');
            $validatedData['test1bb_32_1'] = $request->has('test1bb_32_1');
            $validatedData['test1bb_30_1'] = $request->has('test1bb_30_1');
            $validatedData['test1bb_24_1'] = $request->has('test1bb_24_1');
            $validatedData['test1bb_36_2'] = $request->has('test1bb_36_2');
            $validatedData['test1bb_32_2'] = $request->has('test1bb_32_2');
            $validatedData['test1bb_30_2'] = $request->has('test1bb_30_2');
            $validatedData['test1bb_24_2'] = $request->has('test1bb_24_2');
            $validatedData['test1bb_36_3'] = $request->has('test1bb_36_3');
            $validatedData['test1bb_32_3'] = $request->has('test1bb_32_3');
            $validatedData['test1bb_30_3'] = $request->has('test1bb_30_3');
            $validatedData['test1bb_24_3'] = $request->has('test1bb_24_3');

            // Test 4 Bawah
            $validatedData['test4b_h10mm'] = $request->has('test4b_h10mm');
            $validatedData['test4b_v10mm'] = $request->has('test4b_v10mm');
            $validatedData['test4b_h15mm'] = $request->has('test4b_h15mm');
            $validatedData['test4b_v15mm'] = $request->has('test4b_v15mm');
            $validatedData['test4b_h20mm'] = $request->has('test4b_h20mm');
            $validatedData['test4b_v20mm'] = $request->has('test4b_v20mm');

            // Test 5 Bawah
            $validatedData['test5b_05mm'] = $request->has('test5b_05mm');
            $validatedData['test5b_10mm'] = $request->has('test5b_10mm');
            $validatedData['test5b_15mm'] = $request->has('test5b_15mm');

            // Menyimpan data tanda tangan jika ada
            if ($request->has('officer_signature_data')) {
                $validatedData['officer_signature'] = $request->input('officer_signature_data');
            }

            if ($request->has('supervisor_signature_data')) {
                $validatedData['supervisor_signature'] = $request->input('supervisor_signature_data');
            }

            $xraysave = new xraysaved($validatedData);
            if (Auth::guard('web')->check()) {
                $xraysave->submitted_by = Auth::guard('web')->id();
                $xraysave->officerName = Auth::user()->name;
            } elseif (Auth::guard('officer')->check()) {
                $xraysave->submitted_by = Auth::guard('officer')->id();
                $xraysave->officerName = Auth::guard('officer')->user()->name;
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda harus login untuk mengirimkan formulir ini.'
                ], 401);
            }

            $xraysave->supervisor_id = $validatedData['supervisor_id'];

            try {
                $xraysave->save();
                return redirect()->route('officer.dashboard')
                    ->with('success', 'X-RAY data berhasil disimpan dan menunggu persetujuan supervisor.');
            } catch (\Exception $e) {
                Log::error('Error saving X-RAY data: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
                ], 500);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function review_cabin($id)
    {
        $form = xraysaved::findOrFail($id);
        $supervisor = User::find($form->supervisor_id);

        return view('review.xray.reviewxraycabin', compact('form', 'supervisor'));
    }

    public function review_bagasi($id)
    {
        $form = xraysaved::findOrFail($id);
        $supervisor = User::find($form->supervisor_id);

        return view('review.xray.reviewxraybagasi', compact('form', 'supervisor'));
    }

    public function updateStatus(Request $request, $id)
    {
        $form = xraysaved::findOrFail($id);

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

            return redirect()->route('xrayform')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Error updating X-RAY status: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui status.');
        }
    }

    public function saveSupervisorSignature(Request $request, $id)
    {
        $form = xraysaved::findOrFail($id);

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
        return view('officer.xray.create');
    }

    public function edit_bagasi($id)
    {
        $form = xraysaved::findOrFail($id);

        if ($form->submitted_by !== Auth::guard('officer')->id()) {
            return redirect()->route('officer.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke form ini');
        }

        return view('officer.editxraybagasi', compact('form'));
    }

    public function edit_cabin($id)
    {
        $form = xraysaved::findOrFail($id);

        if ($form->submitted_by !== Auth::guard('officer')->id()) {
            return redirect()->route('officer.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke form ini');
        }

        return view('officer.editxraycabin', compact('form'));
    }

    public function update(Request $request, $id)
    {
        $form = xraysaved::findOrFail($id);

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
            'result' => 'required|in:pass,fail',
            'notes' => 'nullable|string',
        ]);

        try {
            // Perbaikan: Menggunakan input() alih-alih has()
            $checkboxFields = [
                'terpenuhi', 'tidakterpenuhi',
                // Generator Atas/Bawah
                'test2aab', 'test2bab', 'test3ab_14', 'test3ab_16', 'test3ab_18', 'test3ab_20', 'test3ab_22',
                'test3ab_24', 'test3ab_26', 'test3ab_28', 'test3ab_30',
                // Test 1a dan 1b Atas/Bawah
                'test1aab_36', 'test1aab_32', 'test1aab_30', 'test1aab_24',
                'test1bab_36_1', 'test1bab_32_1', 'test1bab_30_1', 'test1bab_24_1',
                'test1bab_36_2', 'test1bab_32_2', 'test1bab_30_2', 'test1bab_24_2',
                'test1bab_36_3', 'test1bab_32_3', 'test1bab_30_3', 'test1bab_24_3',
                // Test 4 Atas/Bawah
                'test4ab_h10mm', 'test4ab_v10mm', 'test4ab_h15mm', 'test4ab_v15mm',
                'test4ab_h20mm', 'test4ab_v20mm',
                // Test 5 Atas/Bawah
                'test5ab_05mm', 'test5ab_10mm', 'test5ab_15mm',
                // Generator Bawah
                'test2ab', 'test2bb', 'test3b_14', 'test3b_16', 'test3b_18', 'test3b_20', 'test3b_22',
                'test3b_24', 'test3b_26', 'test3b_28', 'test3b_30',
                // Test 1a dan 1b Bawah
                'test1ab_36', 'test1ab_32', 'test1ab_30', 'test1ab_24',
                'test1bb_36_1', 'test1bb_32_1', 'test1bb_30_1', 'test1bb_24_1',
                'test1bb_36_2', 'test1bb_32_2', 'test1bb_30_2', 'test1bb_24_2',
                'test1bb_36_3', 'test1bb_32_3', 'test1bb_30_3', 'test1bb_24_3',
                // Test 4 Bawah
                'test4b_h10mm', 'test4b_v10mm', 'test4b_h15mm', 'test4b_v15mm',
                'test4b_h20mm', 'test4b_v20mm',
                // Test 5 Bawah
                'test5b_05mm', 'test5b_10mm', 'test5b_15mm',
            ];

            foreach ($checkboxFields as $field) {
                // Menggunakan input() untuk mendapatkan nilai checkbox
                $validatedData[$field] = $request->input($field, 0);
            }

            $validatedData['status'] = 'pending_supervisor';

            $form->update($validatedData);

            return redirect()->route('officer.dashboard')
                ->with('success', 'Form berhasil diperbarui dan menunggu review ulang');
        } catch (\Exception $e) {
            Log::error('Error updating X-RAY form: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui form');
        }
    }
}
