<?php

namespace App\Http\Controllers;

use App\Models\hhmdsaved;
use App\Services\PdfServices;
use App\Http\Requests\MergePdfRequest;
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
            $form = hhmdsaved::with('supervisor')->findOrFail($id);
            return $this->pdfService->generateSinglePdf($form);
        } catch (\Exception $e) {
            return $this->handleException($e, 'Gagal menghasilkan PDF');
        }
    }


    public function generateMergedPDF(MergePdfRequest $request)
    {
        try {
            $validated = $request->validated();

            $mergedContent = $this->pdfService->generateMergedPdf($validated);

            return $this->downloadResponse($mergedContent, $validated);
        } catch (\Exception $e) {
            return $this->handleException($e, 'Gagal menghasilkan PDF gabungan');
        }
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

    private function handleException(\Exception $e, string $message)
    {
        Log::error($message . ': ' . $e->getMessage());
        return response()->json(['error' => $message], 500);
    }
}
