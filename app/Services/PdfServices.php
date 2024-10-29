<?php
// app/Services/PdfService.php

namespace App\Services;

use App\Models\hhmdsaved;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\LaravelPdf\Enums\Format;
use iio\libmergepdf\Merger;
use iio\libmergepdf\Driver\TcpdiDriver;

class PdfServices
{
    private $tempDir;

    public function __construct()
    {
        $this->tempDir = storage_path('app/temp');
        $this->ensureTempDirectoryExists();
    }

    private function ensureTempDirectoryExists(): void
    {
        if (!file_exists($this->tempDir)) {
            mkdir($this->tempDir, 0755, true);
        }
    }

    public function generateSinglePdf(hhmdsaved $form): mixed
    {
        return Pdf::view('pdf.hhmd', compact('form'))
            ->format(Format::A4)
            ->name("hhmd-{$form->id}.pdf")
            ->download();
    }

    public function generateMergedPdf(array $dateRange): string
    {
        $forms = $this->getFormsByDateRange($dateRange);
        $tempFiles = $this->generateTemporaryPdfs($forms);
        $mergedPdf = $this->mergePdfs($tempFiles);
        $this->cleanupTempFiles($tempFiles);

        return $mergedPdf;
    }

    private function getFormsByDateRange(array $dateRange): object
    {
        return hhmdsaved::whereBetween('testDateTime', [
            $dateRange['start_date'],
            $dateRange['end_date']
        ])->get();
    }

    private function generateTemporaryPdfs(object $forms): array
    {
        $tempFiles = [];
        foreach ($forms as $form) {
            $tempPath = $this->tempDir . '/' . uniqid() . '.pdf';
            Pdf::view('pdf.hhmd', compact('form'))
               ->format(Format::A4)
               ->save($tempPath);
            $tempFiles[] = $tempPath;
        }
        return $tempFiles;
    }

    private function mergePdfs(array $tempFiles): string
    {
        $merger = new Merger(new TcpdiDriver());
        foreach ($tempFiles as $file) {
            $merger->addFile($file);
        }
        return $merger->merge();
    }

    private function cleanupTempFiles(array $files): void
    {
        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
}
