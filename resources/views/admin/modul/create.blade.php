@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Upload Video Modul</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form id="uploadForm" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Judul Modul</label>
                                <input type="text" name="judul" id="judulInput" class="form-control"
                                    value="{{ old('judul') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Video</label>
                                <input type="file" name="video" id="videoInput" class="form-control" accept="video/*">
                                <small id="fileSizeInfo" class="text-muted">Ukuran File: 0MB</small>
                            </div>

                            <!-- Progress Bar -->
                            <div class="progress mb-3 d-none" id="progressBarContainer">
                                <div class="progress-bar" id="progressBar" role="progressbar" style="width: 0%;">0%</div>
                            </div>

                            <!-- Menampilkan ukuran yang sudah ter-upload -->
                            <p id="uploadSizeInfo" class="text-muted d-none">Ter-upload: 0MB / 0MB</p>
                            <p id="uploadTimeInfo" class="text-muted d-none">Estimasi waktu: --</p>
                            <!-- Error Message -->
                            <div class="alert alert-danger mt-3 d-none" id="errorMessage"></div>

                            <input type="hidden" id="kelasIdInput" name="kelas_id" value="{{ request('kelas') }}">

                            <button type="button" class="btn btn-primary" id="uploadBtn">
                                <span id="uploadText">Upload Video</span>
                                <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                                    aria-hidden="true"></span>
                            </button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let uploadInProgress = false;
        let xhrRequest = null;
        let startTime = null;

        document.getElementById("videoInput").addEventListener("change", function(event) {
            const file = event.target.files[0];

            if (file) {
                const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                document.getElementById("fileSizeInfo").textContent = `Ukuran File: ${fileSizeMB}MB`;
                document.getElementById("uploadSizeInfo").textContent = `Ter-upload: 0MB / ${fileSizeMB}MB`;
                document.getElementById("uploadTimeInfo").textContent = "Estimasi waktu: --";
            }
        });

        document.getElementById("uploadBtn").addEventListener("click", function() {
            if (uploadInProgress) {
                // Jika upload sedang berlangsung, batalkan
                if (xhrRequest) {
                    xhrRequest.abort();
                }
                resetUpload();
                return;
            }

            const fileInput = document.getElementById("videoInput");
            const file = fileInput.files[0];
            const judul = document.getElementById("judulInput").value;

            if (!file) {
                alert("Pilih video terlebih dahulu.");
                return;
            }

            uploadInProgress = true;
            updateButtonState(true); // Ubah tombol ke "Batal Upload"

            const formData = new FormData();
            formData.append("_token", "{{ csrf_token() }}");
            formData.append("judul", judul);
            formData.append("video", file);
            formData.append("kelas_id", "{{ request('kelas') }}");

            const progressBar = document.getElementById("progressBar");
            const progressContainer = document.getElementById("progressBarContainer");
            const uploadSizeInfo = document.getElementById("uploadSizeInfo");
            const uploadTimeInfo = document.getElementById("uploadTimeInfo");
            const errorMessage = document.getElementById("errorMessage");

            progressContainer.classList.remove("d-none");
            uploadSizeInfo.classList.remove("d-none");
            uploadTimeInfo.classList.remove("d-none");
            errorMessage.classList.add("d-none");

            startTime = Date.now(); // Waktu mulai upload

            xhrRequest = new XMLHttpRequest();
            xhrRequest.open("POST", "{{ route('modul.store') }}", true);

            xhrRequest.upload.onprogress = function(event) {
                if (event.lengthComputable) {
                    const uploadedMB = (event.loaded / (1024 * 1024)).toFixed(2);
                    const totalMB = (event.total / (1024 * 1024)).toFixed(2);
                    const percentComplete = Math.round((event.loaded / event.total) * 100);

                    progressBar.style.width = percentComplete + "%";
                    progressBar.textContent = percentComplete + "%";
                    uploadSizeInfo.textContent = `Ter-upload: ${uploadedMB}MB / ${totalMB}MB`;

                    // Hitung estimasi waktu upload
                    const elapsedTime = (Date.now() - startTime) / 1000; // Waktu berlalu dalam detik
                    const uploadSpeed = event.loaded / elapsedTime; // Kecepatan upload (bytes per detik)
                    const remainingTime = (event.total - event.loaded) /
                        uploadSpeed; // Waktu tersisa dalam detik


                    if (remainingTime > 0) {
                        uploadTimeInfo.textContent = `Estimasi waktu: ${formatTime(remainingTime)}`;
                    } else if (percentComplete == 100) {
                        uploadTimeInfo.textContent = "Kompresi video";
                    } else {
                        uploadTimeInfo.textContent = "Menghitung...";
                    }
                }
            };

            xhrRequest.onload = function() {
                if (xhrRequest.status === 200) {
                    alert("Upload berhasil!");
                    const kelasId = document.getElementById("kelasIdInput").value;
                    window.location.href = `/kelas/${kelasId}`;
                } else {
                    errorMessage.textContent = "Upload gagal, coba lagi.";
                    errorMessage.classList.remove("d-none");
                }
                resetUpload();
            };

            xhrRequest.onerror = function() {
                errorMessage.textContent = "Terjadi kesalahan saat mengupload.";
                errorMessage.classList.remove("d-none");
                resetUpload();
            };

            xhrRequest.send(formData);
        });

        function updateButtonState(uploading) {
            const uploadBtn = document.getElementById("uploadBtn");
            const uploadText = document.getElementById("uploadText");
            const spinner = document.getElementById("loadingSpinner");

            if (uploading) {
                uploadText.textContent = "Batal Upload";
                spinner.classList.remove("d-none");
                uploadInProgress = true;
            } else {
                uploadText.textContent = "Upload Video";
                spinner.classList.add("d-none");
                uploadInProgress = false;
            }
        }

        function resetUpload() {
            updateButtonState(false);
            document.getElementById("progressBarContainer").classList.add("d-none");
            document.getElementById("uploadSizeInfo").classList.add("d-none");
            document.getElementById("uploadTimeInfo").classList.add("d-none");
        }

        // Fungsi untuk mengubah detik ke format waktu (menit:detik)
        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = Math.round(seconds % 60);
            return `${minutes}m ${secs}s`;
        }
    </script>


@endsection
