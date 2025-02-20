<?php

namespace App\Services;

use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PdfServices
{
    private $tempDir;

    public function __construct()
    {
        $this->tempDir = storage_path('app/temp');
        if (!file_exists($this->tempDir)) {
            mkdir($this->tempDir, 0755, true);
        }
    }

    public function generateBulkPdf($data, $view, $formType)
    {
        try {
            if ($data->isEmpty()) {
                throw new \Exception('No data available to generate PDF');
            }

            // Ambil location dari data pertama
            $location = $data->first()->location;

            // Convert images to base64
            $tampakDepan = base64_encode(file_get_contents(public_path('images/tampakdepan.png')));
            $tampakBelakang = base64_encode(file_get_contents(public_path('images/tampakbelakang.png')));
            $logoAirport = base64_encode(file_get_contents(public_path('images/airport-security-logo.png')));
            $logoInjourney = base64_encode(file_get_contents(public_path('images/Injourney-API.png')));

            // Pass base64 images to view
            $html = View::make($view, [
                'forms' => $data,
                'tampakDepanBase64' => $tampakDepan,
                'tampakBelakangBase64' => $tampakBelakang,
                'logoAirportBase64' => $logoAirport,
                'logoInjourneyBase64' => $logoInjourney
            ])->render();

            // Generate filename terlebih dahulu
            $filename = sprintf(
                '%s-%s-%s.pdf',
                str_replace(' ', '_', $this->getFormName($formType)),
                str_replace(' ', '_', $location),
                now()->format('d-m-Y')
            );

            // Gunakan filename untuk outputPath
            $outputPath = $this->tempDir . '/' . $filename;

            // Set paper size based on form type
            $paperSize = $this->getPaperSize($formType);

            // Generate PDF using Browsershot
            $browsershot = Browsershot::html($html)
                ->setNodeBinary('node')
                ->setNpmBinary('npm')
                ->noSandbox()
                ->showBackground()
                ->waitUntilNetworkIdle();

            // Apply specific paper size and margins
            if ($paperSize === 'F4') {
                $browsershot->paperSize(215.9, 330.2) // F4 dimensions in mm
                    ->margins(10, 10, 10, 10);
            } else {
                $browsershot->format('A4')
                    ->margins(10, 10, 10, 10);
            }

            $browsershot->savePdf($outputPath);

            if (!file_exists($outputPath)) {
                throw new \Exception("Failed to generate PDF");
            }

            // Read the generated PDF
            $content = file_get_contents($outputPath);

            // Clean up temporary file
            unlink($outputPath);

            // Return response dengan filename yang sudah dibuat
            return response($content)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');

        } catch (\Exception $e) {
            Log::error('PDF Generation Error: ' . $e->getMessage());
            throw $e;
        }
    }

    private function getPaperSize($formType): string
    {
        return in_array($formType, ['xray_bagasi', 'xray_cabin']) ? 'F4' : 'A4';
    }

    private function getFormName($formType): string
    {
        switch ($formType) {
            case 'hhmd':
                return 'Form HHMD';
            case 'wtmd':
                return 'Form WTMD';
            case 'xray_bagasi':
                return 'Form X-Ray Bagasi';
            case 'xray_cabin':
                return 'Form X-Ray Cabin';
            default:
                return 'Form';
        }
    }

    // private function generateTemporaryPdfs($data, $view): array
    // {
    //     try {
    //         $tempFiles = [];
    //         foreach ($data as $item) {
    //             $tempPath = $this->tempDir . '/' . uniqid() . '.pdf';
    //             Log::info('Generating PDF for item', [
    //                 'id' => $item->id,
    //                 'tempPath' => $tempPath
    //             ]);

    //             Pdf::view($view, ['form' => $item])
    //                 ->format(Format::A4)
    //                 ->save($tempPath);

    //             if (!file_exists($tempPath)) {
    //                 throw new \Exception("Failed to generate PDF at: $tempPath");
    //             }

    //             $tempFiles[] = $tempPath;
    //         }
    //         return $tempFiles;
    //     } catch (\Exception $e) {
    //         Log::error('Error generating temporary PDFs: ' . $e->getMessage());
    //         throw $e;
    //     }
    // }

    // private function mergePdfs(array $tempFiles): string
    // {
    //     $merger = new Merger(new TcpdiDriver());
    //     foreach ($tempFiles as $file) {
    //         $merger->addFile($file);
    //     }
    //     return $merger->merge();
    // }

    // private function cleanupTempFiles(array $files): void
    // {
    //     foreach ($files as $file) {
    //         if (file_exists($file)) {
    //             unlink($file);
    //         }
    //     }
    // }

    // private function cleanupTempDirectory(): void
    // {
    //     $files = glob($this->tempDir . '/*');
    //     foreach ($files as $file) {
    //         if (is_file($file) && time() - filemtime($file) > 3600) { // cleanup files older than 1 hour
    //             unlink($file);
    //         }
    //     }
    // }
}
