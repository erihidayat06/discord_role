@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Create kategori</div>
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

                        <form action="{{ url('/admin/research') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Judul --}}
                            <div class="mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" name="judul"
                                    class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Input Gambar --}}
                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <input type="file" name="gambar" id="gambarInput"
                                    class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Preview Gambar --}}
                            <div class="mb-3">
                                <img id="previewImage" src="#" alt="Preview Gambar" class="img-fluid rounded d-none"
                                    style="max-width: 100%; height: auto;">
                            </div>

                            {{-- Link PDF --}}
                            <div class="mb-3">
                                <label class="form-label">Link PDF (Google drive)</label>
                                <input type="text" name="link"
                                    class="form-control @error('link') is-invalid @enderror" value="{{ old('link') }}">
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tanggal --}}
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tanggal"
                                    class="form-control @error('tanggal') is-invalid @enderror"
                                    value="{{ old('tanggal') }}">
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Create kategori</button>
                            <a href="{{ url('/kategori') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript untuk Preview Gambar --}}
    <script>
        document.getElementById('gambarInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImage = document.getElementById('previewImage');
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('d-none'); // Tampilkan gambar
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
