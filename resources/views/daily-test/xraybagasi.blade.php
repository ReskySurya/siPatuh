@if(!isset($isPdf))
    @extends('layouts.app')

    @section('content')
@endif


<div class="bg-white-100 px-4 sm:px-8 md:px-16 lg:px-32 xl:px-64">
    <div>
        <x-form-xray type="bagasi"/>
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
        let year = now.getFullYear();
        let month = (now.getMonth() + 1).toString().padStart(2, '0');
        let day = now.getDate().toString().padStart(2, '0');
        let hours = now.getHours().toString().padStart(2, '0');
        let minutes = now.getMinutes().toString().padStart(2, '0');

        let formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
        document.getElementById('testDateTime').value = formattedDateTime;

        // Canvas setup dan event listeners
        const canvas = document.getElementById('signatureCanvas');
        const ctx = canvas.getContext('2d');
        let isDrawing = false;
        let lastX = 0;
        let lastY = 0;

        // Validasi form dan tanda tangan
        const form = document.getElementById('xrayForm');
        const submitButton = document.getElementById('submitButton');
        const buttonText = document.getElementById('buttonText');
        const buttonLoading = document.getElementById('buttonLoading');

        form.onsubmit = function(event) {
            event.preventDefault();

            const signatureInput = document.getElementById('officerSignatureData');
            const supervisorSelect = document.getElementById('supervisor_id');

            // Validasi tanda tangan
            if (!signatureInput || !signatureInput.value) {
                Swal.fire({
                    title: 'Tanda Tangan Diperlukan!',
                    text: 'Anda harus menyimpan tanda tangan terlebih dahulu sebelum submit form.',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                });

                document.querySelector('.signature-section').scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                return false;
            }

            // Validasi supervisor
            if (!supervisorSelect.value) {
                Swal.fire({
                    title: 'Supervisor Diperlukan!',
                    text: 'Silakan pilih supervisor terlebih dahulu.',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                });
                return false;
            }

            // Tampilkan loading state
            submitButton.disabled = true;
            buttonText.classList.add('hidden');
            buttonLoading.classList.remove('hidden');

            // Submit form langsung tanpa updateResult
            form.submit();
        };

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
            try {
                const canvas = document.getElementById('signatureCanvas');
                const signatureData = canvas.toDataURL('image/png');
                const signatureInput = document.getElementById('officerSignatureData');

                if (!signatureInput) {
                    console.error('Element officerSignatureData tidak ditemukan');
                    return;
                }

                signatureInput.value = signatureData;

                // Buat preview container
                const previewContainer = document.createElement('div');
                previewContainer.id = 'signaturePreview';
                previewContainer.innerHTML = `
                    <img src="${signatureData}" alt="Tanda tangan Officer" class="max-w-full h-auto">
                `;

                // Ganti canvas dengan preview
                const canvasContainer = canvas.parentElement;
                canvas.remove();
                canvasContainer.appendChild(previewContainer);

                // Sembunyikan tombol clear dan save
                document.getElementById('clearSignature').style.display = 'none';
                document.getElementById('saveOfficerSignature').style.display = 'none';

                alert('Tanda tangan berhasil disimpan');
                console.log('Signature data saved:', signatureData.substring(0, 100) + '...');
            } catch (error) {
                console.error('Error saving signature:', error);
                alert('Terjadi kesalahan saat menyimpan tanda tangan');
            }
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

        // Fungsi untuk mengecek status checkbox dan mengupdate radio button
        function updateRadioResult() {
            // Ambil semua checkbox berdasarkan ID yang ada
            const test2Checkboxes = [
                document.getElementById('test2aab'),
                document.getElementById('test2bab'),
                document.getElementById('test2ab'),
                document.getElementById('test2bb')
            ];
            const test3Checkboxes = [
                document.getElementById('test3ab_14'),
                document.getElementById('test3ab_16'),
                document.getElementById('test3ab_18'),
                document.getElementById('test3ab_20'),
                document.getElementById('test3ab_22'),
                document.getElementById('test3b_14'),
                document.getElementById('test3b_16'),
                document.getElementById('test3b_18'),
                document.getElementById('test3b_20'),
                document.getElementById('test3b_22')
            ];
            const test1Checkboxes = [
                document.getElementById('test1aab_30'),
                document.getElementById('test1aab_24'),
                document.getElementById('test1bab_30_1'),
                document.getElementById('test1bab_24_1'),
                document.getElementById('test1bab_24_2'),
                document.getElementById('test1bab_24_3'),
                document.getElementById('test1ab_30'),
                document.getElementById('test1ab_24'),
                document.getElementById('test1bb_30_1'),
                document.getElementById('test1bb_24_1'),
                document.getElementById('test1bb_24_2'),
                document.getElementById('test1bb_24_3')
            ];
            const test4Checkboxes = [
                document.getElementById('test4ab_h20mm'),
                document.getElementById('test4ab_v20mm'),
                document.getElementById('test4b_h20mm'),
                document.getElementById('test4b_v20mm')
            ];

            const test5Checkboxes = [
                document.getElementById('test5ab_10mm'),
                document.getElementById('test5b_10mm')
            ];

            // Cek apakah semua checkbox tercentang
            const allChecked = [...test1Checkboxes, ...test2Checkboxes, ...test3Checkboxes, ...test4Checkboxes, ...test5Checkboxes]
                .every(checkbox => checkbox.checked);

            // Update radio button dan hidden input
            const resultPass = document.getElementById('resultPass');
            const resultFail = document.getElementById('resultFail');
            const resultHidden = document.getElementById('result');

            if (allChecked) {
                resultPass.checked = true;
                resultHidden.value = 'pass';
            } else {
                resultFail.checked = true;
                resultHidden.value = 'fail';
            }
        }

        // Tambahkan event listener untuk semua checkbox
        const allCheckboxIds = [
            'test2aab',
            'test2bab',
            'test2ab',
            'test2bb',
            'test3ab_14',
            'test3ab_16',
            'test3ab_18',
            'test3ab_20',
            'test3ab_22',
            'test3ab_24',
            'test3b_14',
            'test3b_16',
            'test3b_18',
            'test3b_20',
            'test3b_22',
            'test3b_24',
            'test1aab_32',
            'test1aab_30',
            'test1aab_24',
            'test1bab_30_1',
            'test1bab_24_1',
            'test1bab_30_2',
            'test1bab_24_2',
            'test1bab_24_3',
            'test1ab_32',
            'test1ab_30',
            'test1ab_24',
            'test1bb_30_1',
            'test1bb_24_1',
            'test1bb_30_2',
            'test1bb_24_2',
            'test1bb_24_3',
            'test4ab_h15mm',
            'test4ab_v15mm',
            'test4ab_h20mm',
            'test4ab_v20mm',
            'test4b_h15mm',
            'test4b_v15mm',
            'test4b_h20mm',
            'test4b_v20mm',
            'test5ab_10mm',
            'test5b_10mm'
        ];

        allCheckboxIds.forEach(id => {
            document.getElementById(id).addEventListener('change', updateRadioResult);
        });

        // Nonaktifkan radio button agar tidak bisa diklik manual
        document.getElementById('resultPass').addEventListener('click', (e) => e.preventDefault());
        document.getElementById('resultFail').addEventListener('click', (e) => e.preventDefault());

        // Inisialisasi status awal
        updateRadioResult();
    });
</script>

@if(!isset($isPdf))
    @endsection
@endif
