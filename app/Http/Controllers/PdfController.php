<?php

namespace App\Http\Controllers;

use App\Models\hhmdsaved;
use App\Models\wtmdsaved;
use App\Models\xraysaved;
use App\Services\PdfServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PdfController extends Controller
{
    protected $pdfService;

    public function __construct(PdfServices $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function index(Request $request)
    {
        return view('pdf.pdflayout');
    }

    public function previewData(Request $request)
    {
        $formType = $request->query('formType');
        $location = $request->query('location');
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');

        // Query data based on the form type and filters, only showing approved forms
        switch ($formType) {
            case 'hhmd':
                $data = hhmdsaved::where('location', $location)
                    ->whereBetween('testDateTime', [$startDate, $endDate])
                    ->where('status', 'approved')
                    ->get();
                break;
            case 'wtmd':
                $data = wtmdsaved::where('location', $location)
                    ->whereBetween('testDateTime', [$startDate, $endDate])
                    ->where('status', 'approved')
                    ->get();
                break;
            case 'xray_bagasi':
                $data = xraysaved::where('location', $location)
                    ->whereBetween('testDateTime', [$startDate, $endDate])
                    ->where('status', 'approved')
                    ->get();
                break;
            case 'xray_cabin':
                $data = xraysaved::where('location', $location)
                    ->whereBetween('testDateTime', [$startDate, $endDate])
                    ->where('status', 'approved')
                    ->get();
                break;
            default:
                return response()->json(['error' => 'Invalid form type'], 400);
        }

        return response()->json($data);
    }

    public function exportSelected(Request $request)
    {
        try {
            $selectedIds = json_decode($request->selectedIds, true);
            $formType = $request->formType;

            if (empty($selectedIds)) {
                return response()->json(['error' => 'No forms selected'], 400);
            }

            switch ($formType) {
                case 'hhmd':
                    $data = hhmdsaved::whereIn('id', $selectedIds)->get();
                    $view = 'pdf.hhmd_template';
                    break;
                case 'wtmd':
                    $data = wtmdsaved::whereIn('id', $selectedIds)->get();
                    $view = 'pdf.wtmd_template';
                    break;
                case 'xray_bagasi':
                    $data = xraysaved::whereIn('id', $selectedIds)->get();
                    $view = 'pdf.xraybagasi_template';
                    break;
                case 'xray_cabin':
                    $data = xraysaved::whereIn('id', $selectedIds)->get();
                    $view = 'pdf.xraycabin_template';
                    break;
                default:
                    return response()->json(['error' => 'Invalid form type'], 400);
            }

            if ($data->isEmpty()) {
                return response()->json(['error' => 'No data found'], 404);
            }

            return $this->pdfService->generateBulkPdf($data, $view, $formType);

        } catch (\Exception $e) {
            Log::error('Export Selected PDF Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to generate PDF: ' . $e->getMessage()], 500);
        }
    }

    public function exportAll(Request $request)
    {
        $request->validate([
            'formType' => 'required|in:hhmd,wtmd,xray_bagasi,xray_cabin',
            'location' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        try {
            $formType = $request->formType;
            $location = $request->location;
            $startDate = $request->startDate;
            $endDate = $request->endDate;

            // Get data based on form type
            switch ($formType) {
                case 'hhmd':
                    $data = hhmdsaved::where('location', $location)
                        ->whereBetween('testDateTime', [$startDate, $endDate])
                        ->where('status', 'approved')
                        ->get();
                    $view = 'pdf.hhmd_template';
                    break;
                case 'wtmd':
                    $data = wtmdsaved::where('location', $location)
                        ->whereBetween('testDateTime', [$startDate, $endDate])
                        ->where('status', 'approved')
                        ->get();
                    $view = 'pdf.wtmd_template';
                    break;
                case 'xray_bagasi':
                    $data = xraysaved::where('location', $location)
                        ->whereBetween('testDateTime', [$startDate, $endDate])
                        ->where('status', 'approved')
                        ->get();
                    $view = 'pdf.xraybagasi_template';
                    break;
                case 'xray_cabin':
                    $data = xraysaved::where('location', $location)
                        ->whereBetween('testDateTime', [$startDate, $endDate])
                        ->where('status', 'approved')
                        ->get();
                    $view = 'pdf.xraycabin_template';
                    break;
                default:
                    return response()->json(['error' => 'Invalid form type'], 400);
            }

            if ($data->isEmpty()) {
                return response()->json(['error' => 'Tidak ada data untuk di-export'], 400);
            }

            return $this->pdfService->generateBulkPdf($data, $view, $formType);
        } catch (\Exception $e) {
            Log::error('Export All PDF Error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal mengexport PDF'], 500);
        }
    }
}
