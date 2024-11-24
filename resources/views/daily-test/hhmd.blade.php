@if(!isset($isPdf))
    @extends('layouts.app')

    @section('content')
@endif


<div class="bg-gray-100 px-64">
    <div>
        <x-form-hhmd/>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the current date and time
        let now = new Date();

        // Format the date and time to match the input format (YYYY-MM-DDTHH:MM)
        let year = now.getFullYear();
        let month = (now.getMonth() + 1).toString().padStart(2, '0');
        let day = now.getDate().toString().padStart(2, '0');
        let hours = now.getHours().toString().padStart(2, '0');
        let minutes = now.getMinutes().toString().padStart(2, '0');

        let formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

        // Set the value of the input
        document.getElementById('testDateTime').value = formattedDateTime;
    });
    // Get the current date and time

    // Add this function to your form's onsubmit event
    function onFormSubmit(event) {
        event.preventDefault();
        document.getElementById('hhmdForm').submit();
    }

    function updateResult() {
        var test2 = document.getElementById('test2').checked;

        var resultPass = document.getElementById('resultPass');
        var resultFail = document.getElementById('resultFail');
        var resultHidden = document.getElementById('result');

        if (test2) {
            resultPass.checked = true;
            resultFail.checked = false;
            resultHidden.value = 'pass';
        } else {
            resultPass.checked = false;
            resultFail.checked = true;
            resultHidden.value = 'fail';
        }
    }

    // Panggil updateResult saat halaman dimuat
    document.addEventListener('DOMContentLoaded', updateResult);

    // Tambahkan event listener untuk setiap checkbox test
    document.getElementById('test2').addEventListener('change', updateResult);

    // Tambahkan event listener untuk form submission
    document.getElementById('hhmdForm').addEventListener('submit', function(event) {
        updateResult(); // Pastikan result diupdate sebelum form disubmit
    });

    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('signatureCanvas');
        const ctx = canvas.getContext('2d');
        let isDrawing = false;
        let lastX = 0; // Menyimpan posisi X terakhir
        let lastY = 0; // Menyimpan posisi Y terakhir

        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        document.getElementById('clearSignature').addEventListener('click', clearCanvas);
        document.getElementById('saveOfficerSignature').addEventListener('click', saveOfficerSignature);

        function startDrawing(e) {
            isDrawing = true;
            [lastX, lastY] = [e.offsetX, e.offsetY]; // Menggunakan offsetX dan offsetY
            draw(e);
        }

        function draw(e) {
            if (!isDrawing) return;
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.strokeStyle = '#000';

            ctx.beginPath();
            ctx.moveTo(lastX, lastY); // Menggunakan posisi terakhir
            ctx.lineTo(e.offsetX, e.offsetY); // Menggunakan offsetX dan offsetY
            ctx.stroke();
            [lastX, lastY] = [e.offsetX, e.offsetY]; // Memperbarui posisi terakhir
        }

        function stopDrawing() {
            isDrawing = false;
            ctx.beginPath();
        }

        function clearCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }

        function saveOfficerSignature() {
        const officerSignatureData = canvas.toDataURL('image/png');
        document.getElementById('officerSignatureData').value = officerSignatureData;
        alert('Tanda tangan Officer disimpan!');
        }

    });

</script>

@if(!isset($isPdf))
    @endsection
@endif
