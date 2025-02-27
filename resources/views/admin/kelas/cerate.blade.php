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

                        <form action="{{ url('/kelas') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Judul Kelas</label>
                                <input type="text" name="judul"
                                    class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <input type="file" name="gambar" id="gambarInput"
                                    class="form-control @error('gambar') is-invalid @enderror"
                                    onchange="previewImage(event)">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-3">
                                    <img id="gambarPreview" src="" alt="Preview Gambar"
                                        class="img-fluid rounded d-none" style="max-width: 30%; height: auto;">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select class="form-select @error('kategori_id') is-invalid @enderror" name="kategori_id">
                                    <option value="">Kosong kategori</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ old('kategori_id', request('kategori')) == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nm_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
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

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('gambarPreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none'); // Tampilkan gambar
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "";
                preview.classList.add('d-none'); // Sembunyikan gambar jika tidak ada file
            }
        }
    </script>
@endsection
