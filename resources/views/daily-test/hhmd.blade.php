@if(!isset($isPdf))
    @extends('layouts.app')

    @section('content')
@endif


<div class="bg-white-100 px-4 sm:px-8 md:px-16 lg:px-32 xl:px-64">
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
        let lastX = 0;
        let lastY = 0;

        // Fungsi untuk mendapatkan koordinat sentuhan atau mouse
        function getCoordinates(e) {
            const rect = canvas.getBoundingClientRect();
            const scaleX = canvas.width / rect.width;
            const scaleY = canvas.height / rect.height;

            let x, y;
            if (e.touches) {
                x = (e.touches[0].clientX - rect.left) * scaleX;
                y = (e.touches[0].clientY - rect.top) * scaleY;
            } else {
                x = (e.offsetX || e.layerX) * scaleX;
                y = (e.offsetY || e.layerY) * scaleY;
            }
            return [x, y];
        }

        function startDrawing(e) {
            e.preventDefault(); // Mencegah scrolling atau zoom saat menggambar
            isDrawing = true;
            [lastX, lastY] = getCoordinates(e);
        }

        function draw(e) {
            if (!isDrawing) return;
            e.preventDefault(); // Mencegah scrolling atau zoom saat menggambar

            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.strokeStyle = '#000';

            const [x, y] = getCoordinates(e);

            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(x, y);
            ctx.stroke();

            [lastX, lastY] = [x, y];
        }

        function stopDrawing(e) {
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

        // Event listeners untuk mouse
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        // Event listeners untuk sentuhan mobile
        canvas.addEventListener('touchstart', startDrawing, { passive: false });
        canvas.addEventListener('touchmove', draw, { passive: false });
        canvas.addEventListener('touchend', stopDrawing);

        document.getElementById('clearSignature').addEventListener('click', clearCanvas);
        document.getElementById('saveOfficerSignature').addEventListener('click', saveOfficerSignature);
    });

</script>

@if(!isset($isPdf))
    @endsection
@endif
