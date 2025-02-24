@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Edit Video Modul</div>
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

                        <form id="editForm" action="{{ route('modul.update', $modul->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Judul Modul</label>
                                <input type="text" name="judul"
                                    class="form-control @error('judul') is-invalid @enderror"
                                    value="{{ old('judul', $modul->judul) }}">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <div class="mb-3">
                                <label class="form-label">Video Saat Ini</label>
                                <div>
                                    <video width="100%" controls>
                                        <source src="{{ asset('storage/' . $modul->video) }}" type="video/mp4">
                                        Browser Anda tidak mendukung tag video.
                                    </video>
                                </div>
                            </div> --}}

                            {{-- <div class="mb-3">
                                <label class="form-label">Ganti Video</label>
                                <input type="file" name="video" id="videoInput"
                                    class="form-control @error('video') is-invalid @enderror" accept="video/*">
                                @error('video')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            {{-- <!-- Menampilkan Ukuran File -->
                            <p id="fileSizeInfo" class="text-muted d-none"></p> --}}

                            {{-- <!-- Progress Bar -->
                            <div class="progress mb-3 d-none" id="progressBarContainer">
                                <div class="progress-bar" id="progressBar" role="progressbar" style="width: 0%;">0%</div>
                            </div>

                            <!-- Error Message -->
                            <div class="alert alert-danger mt-3 d-none" id="errorMessage"></div> --}}
                            {{--
                            <input type="hidden" name="kelas_id" value="{{ $modul->kelas_id }}"> --}}

                            <button type="submit" class="btn btn-primary">Update Modul</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            // Menampilkan Ukuran File
            $('#videoInput').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const fileSize = (file.size / (1024 * 1024)).toFixed(2); // Convert ke MB
                    $('#fileSizeInfo').removeClass('d-none').text(`Ukuran File: ${fileSize} MB`);
                    $('#errorMessage').addClass('d-none').text(''); // Sembunyikan error message
                } else {
                    $('#fileSizeInfo').addClass('d-none').text('');
                }
            });

            // Setup CSRF Token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle Update dengan AJAX
            $('#editForm').on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                // Reset Progress Bar dan Error Message
                $('#progressBar').css('width', '0%').text('0%');
                $('#progressBarContainer').removeClass('d-none');
                $('#errorMessage').addClass('d-none').text('');

                $.ajax({
                    xhr: function() {
                        const xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(event) {
                            if (event.lengthComputable) {
                                const percentComplete = Math.round((event.loaded / event
                                    .total) * 100);
                                const uploadedMB = (event.loaded / (1024 * 1024))
                                    .toFixed(2);
                                const totalMB = (event.total / (1024 * 1024)).toFixed(
                                    2);

                                // Update Progress Bar
                                $('#progressBar').css('width', percentComplete + '%')
                                    .text(
                                        `${percentComplete}% (${uploadedMB} MB / ${totalMB} MB)`
                                    );
                            }
                        }, false);
                        return xhr;
                    },
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Ambil kelas_id dari query string (contoh: ?kelas=1)
                        const urlParams = new URLSearchParams(window.location.search);
                        const kelasId = urlParams.get('kelas');

                        // Redirect ke /kelas/{kelas_id}
                        if (kelasId) {
                            window.location.href = '/kelas/' + kelasId;
                        } else {
                            // Jika kelas_id tidak ditemukan dalam query string
                            alert('Kelas ID tidak ditemukan.');
                        }
                    },
                    error: function(xhr) {
                        $('#errorMessage').removeClass('d-none').text(
                            'Gagal memperbarui modul!');
                    }
                });
            });
        });
    </script> --}}
@endsection
