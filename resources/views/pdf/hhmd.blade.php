<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir HHMD</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .container { width: 210mm; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 5px; }
        .checkbox { width: 15px; height: 15px; border: 1px solid black; display: inline-block; }
        .checked { background-color: black; }
        .signature-box { border: 1px solid black; height: 50px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>CHECK LIST PENGUJIAN HARIAN PENDETEKSI LOGAM GENGGAM (HAND HELD METAL DETECTOR/HHMD)</h1>
        </div>

        <table>
            <tr>
                <th>Nama Operator Penerbangan:</th>
                <td>{{ $form->operatorName }}</td>
            </tr>
            <tr>
                <th>Tanggal & Waktu Pengujian:</th>
                <td>{{ $form->testDateTime }}</td>
            </tr>
            <tr>
                <th>Lokasi Penempatan:</th>
                <td>{{ $form->location }}</td>
            </tr>
            <tr>
                <th>Merk/Tipe/Nomor Seri:</th>
                <td>{{ $form->deviceInfo }}</td>
            </tr>
            <tr>
                <th>Nomor dan Tanggal Sertifikat:</th>
                <td>{{ $form->certificateInfo }}</td>
            </tr>
        </table>

        <div>
            <span class="checkbox {{ $form->terpenuhi ? 'checked' : '' }}"></span> Terpenuhi
            <span class="checkbox {{ $form->tidakterpenuhi ? 'checked' : '' }}"></span> Tidak Terpenuhi
        </div>

        <table>
            <tr>
                <th>TEST 1</th>
                <th>TEST 2</th>
                <th>TEST 3</th>
            </tr>
            <tr>
                <td><div class="checkbox {{ $form->test1 ? 'checked' : '' }}"></div></td>
                <td><div class="checkbox {{ $form->test2 ? 'checked' : '' }}"></div></td>
                <td><div class="checkbox {{ $form->test3 ? 'checked' : '' }}"></div></td>
            </tr>
        </table>

        <div>
            <div class="checkbox {{ $form->testCondition1 ? 'checked' : '' }}"></div> Letak alat uji OTP dan HHMD pada saat pengujian harus > 1m dari benda logam lain disekelilingnya.
        </div>
        <div>
            <div class="checkbox {{ $form->testCondition2 ? 'checked' : '' }}"></div> Jarak antara HHMD dan OTP > 3-5 cm.
        </div>

        <h3>Hasil:</h3>
        <div>
            <span class="checkbox {{ $form->result == 'pass' ? 'checked' : '' }}"></span> PASS
            <span class="checkbox {{ $form->result == 'fail' ? 'checked' : '' }}"></span> FAIL
        </div>

        <h3>CATATAN:</h3>
        <p>{{ $form->notes }}</p>

        <h3>Personel Pengamanan Penerbangan</h3>
        <div>
            <p>1. Airport Security Officer: {{ $form->officerName }}</p>
            <div class="signature-box">
                @if($form->officer_signature)
                    <img src="{{ $form->officer_signature }}" alt="Tanda tangan Officer" style="max-width: 100%; max-height: 100%;">
                @endif
            </div>
            <p>2. Airport Security Supervisor</p>
            <div class="signature-box">
                @if($form->supervisor_signature)
                    <img src="{{ $form->supervisor_signature }}" alt="Tanda tangan Supervisor" style="max-width: 100%; max-height: 100%;">
                @endif
            </div>
        </div>
    </div>
</body>
</html>
