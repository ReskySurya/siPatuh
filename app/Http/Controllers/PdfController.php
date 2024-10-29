<?php

namespace App\Http\Controllers;

use App\Models\hhmdsaved;
use App\Services\PdfServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class PdfController extends Controller
{
    protected $pdfService;

    public function __construct(PdfServices $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function generatePDF($id)
    {
        try {
            $form = hhmdsaved::findOrFail($id);
            return $this->pdfService->generateSinglePdf($form);
        } catch (\Exception $e) {
            Log::error('PDF Generation Error: ' . $e->getMessage());
            return $this->errorResponse('Gagal menghasilkan PDF', $e);
        }
    }

    public function generateMergedPDF(Request $request)
    {
        try {
            $validated = $this->validateDateRange($request);

            $mergedContent = $this->pdfService->generateMergedPdf($validated);

            return $this->downloadResponse($mergedContent, $validated);
        } catch (\Exception $e) {
            Log::error('Merged PDF Generation Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghasilkan PDF gabungan: ' . $e->getMessage());
        }
    }

    private function validateDateRange(Request $request): array
    {
        return $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);
    }

    private function downloadResponse(string $content, array $dateRange): Response
    {
        $fileName = sprintf(
            "merged_hhmd_%s_to_%s.pdf",
            $dateRange['start_date'],
            $dateRange['end_date']
        );

        return response($content, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ]);
    }

    private function errorResponse(string $message, \Exception $e)
    {
        return response()->json([
            'error' => $message . ': ' . $e->getMessage()
        ], 500);
    }
}
