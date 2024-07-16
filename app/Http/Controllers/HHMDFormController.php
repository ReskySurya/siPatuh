<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class HHMDFormController extends Controller
{
    public function submitForm(Request $request)
    {
        // Validasi input (gunakan validasi yang sama seperti kode asli Anda)
        $validatedData = $request->validate([
            'operatorName' => 'required|string',
            'testDateTime' => 'required|date',
            'location' => 'required|string',
            'deviceInfo' => 'required|string',
            'certificateInfo' => 'required|string',
            'fulfilled' => 'nullable|string',
            'unfulfilled' => 'nullable|string',
            'test1' => 'nullable|string',
            'test2' => 'nullable|string',
            'test3' => 'nullable|string',
            'testCondition1' => 'nullable|string',
            'testCondition2' => 'nullable|string',
            'result' => 'required|in:pass,fail',
            'notes' => 'nullable|string',
            'securityOfficer' => 'required|string',
            'securitySupervisor' => 'required|string',
        ]);

        // Inisialisasi FPDF
        $pdf = new Fpdf('P', 'mm', 'A4');
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('Arial', 'B', 14);

        // Judul
        $pdf->Cell(0, 10, 'CHECK LIST PENGUJIAN HARIAN', 0, 1, 'C');
        $pdf->Cell(0, 10, 'PENDETEKSI LOGAM GENGGAM', 0, 1, 'C');
        $pdf->Cell(0, 10, '(HAND HELD METAL DETECTOR/HHMD)', 0, 1, 'C');
        $pdf->Ln(5);

        // Isi form fields
        $pdf->SetFont('Arial', '', 11);
        $lineHeight = 6;
        $this->addFormField($pdf, 'Lokasi Penempatan', $validatedData['location']);
        $this->addFormField($pdf, 'Nama Operator Penerbangan', $validatedData['operatorName']);
        $this->addFormField($pdf, 'Merk/Tipe/Nomor Seri', $validatedData['deviceInfo']);
        $this->addFormField($pdf, 'Nomor dan Tanggal Sertifikat', $validatedData['certificateInfo']);
        $this->addFormField($pdf, 'Tanggal & Waktu Pengujian', $validatedData['testDateTime']);
        $pdf->Ln(3);

        // Tabel hasil pengujian
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(30, 10, 'CATATAN :', 0, 0);
        $pdf->Cell(30, 10, 'Hasil :', 0, 0);
        $pdf->Cell(30, 10, 'PASS', 1, 0, 'C');
        $pdf->Cell(30, 10, 'FAIL', 1, 1, 'C');
        $pdf->Cell(60, 10, '', 0, 0);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(30, 10, ': Terpenuhi', 0, 0);
        $pdf->Cell(30, 10, ': Tidak Terpenuhi', 0, 1);
        $pdf->Ln(5);

        // Test checkboxes
        $this->addCheckbox($pdf, 'TEST 1', $validatedData['test1']);
        $this->addCheckbox($pdf, 'TEST 2', $validatedData['test2']);
        $this->addCheckbox($pdf, 'TEST 3', $validatedData['test3']);
        $pdf->Ln(5);

        // Test conditions
        $pdf->MultiCell(0, 5, 'Letak alat uji OTP dan HHMD pada saat pengujian harus > 1m dari benda logam lain disekelilingnya.', 0, 'L');
        $this->addCheckbox($pdf, '', $validatedData['testCondition1']);
        $pdf->MultiCell(0, 5, 'Jarak antara HHMD dan OTP > 3-5 cm.', 0, 'L');
        $this->addCheckbox($pdf, '', $validatedData['testCondition2']);
        $pdf->Ln(5);

        // Result
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(30, 10, 'Hasil:', 0, 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, strtoupper($validatedData['result']), 0, 1);
        $pdf->Ln(5);

        // Notes
        if (!empty($validatedData['notes'])) {
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->Cell(0, 10, 'CATATAN:', 0, 1);
            $pdf->SetFont('Arial', '', 11);
            $pdf->MultiCell(0, 5, $validatedData['notes'], 0, 'L');
            $pdf->Ln(5);
        }

        // Security personnel
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 10, 'Personel Pengamanan Penerbangan', 0, 1);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(10, 10, '1.', 0, 0);
        $pdf->Cell(0, 10, 'Airport Security Officer: ' . $validatedData['securityOfficer'], 0, 1);
        $pdf->Cell(10, 10, '2.', 0, 0);
        $pdf->Cell(0, 10, 'Airport Security Supervisor: ' . $validatedData['securitySupervisor'], 0, 1);

        // Output PDF
        return response($pdf->Output('S'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="hhmd_checklist.pdf"',
        ]);
    }

    private function addFormField($pdf, $label, $value,  $lineHeight = 10)
    {
        $pdf->Cell(70, $lineHeight, $label, 0, 0);
        $pdf->Cell(5, $lineHeight, ':', 0, 0);
        $pdf->Cell(0, $lineHeight, $value, 0, 1);
    }

    private function addCheckbox($pdf, $label, $checked)
    {
        $pdf->Cell(30, 10, $label, 0, 0);
        $pdf->Cell(5, 10, $checked ? 'V' : '', 1, 0, 'C');
        $pdf->Cell(0, 10, '', 0, 1);
    }
}
