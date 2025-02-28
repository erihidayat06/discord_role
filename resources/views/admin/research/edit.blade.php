@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Edit Research</div>
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

                        <form action="{{ url('/admin/research/' . $research->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" name="judul"
                                    class="form-control @error('judul') is-invalid @enderror"
                                    value="{{ old('judul', $research->judul) }}">
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
                                @if ($research->gambar)
                                    <img id="previewImage" src="{{ asset('storage/' . $research->gambar) }}"
                                        alt="Preview Gambar" class="img-fluid rounded"
                                        style="max-width: 100%; height: auto;">
                                @else
                                    <img id="previewImage" src="#" alt="Preview Gambar"
                                        class="img-fluid rounded d-none" style="max-width: 100%; height: auto;">
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Link PDF (Google Drive)</label>
                                <input type="text" name="link"
                                    class="form-control @error('link') is-invalid @enderror"
                                    value="{{ old('link', $research->link ? 'https://drive.google.com/file/d/' . $research->link . '/preview' : '') }}">
                                @error('link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tanggal"
                                    class="form-control @error('tanggal') is-invalid @enderror"
                                    value="{{ old('tanggal', $research->tanggal) }}">
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update Research</button>
                            <a href="{{ url('/research') }}" class="btn btn-secondary">Back</a>
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
