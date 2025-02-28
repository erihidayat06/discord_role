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

                        <form id="uploadForm" action="/kelas/modul" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Judul Modul</label>
                                <input type="text" name="judul" id="judulInput" class="form-control"
                                    value="{{ old('judul') }}">

                                @error('judul')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Video ID</label>
                                <input type="text" name="video" id="videoInput" class="form-control"
                                    value="{{ old('video') }}">

                                @error('video')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            @if (!empty($kelas->sub_kelas) && $kelas->sub_kelas !== 'null')
                                <div class="mb-3">
                                    <label for="sub_kelas" id="sub_kelas">Sub Kelas</label>
                                    <select class="form-control @error('sub_kelas') is-invalid @enderror" id="sub_kelas"
                                        name="sub_kelas">

                                        @foreach (json_decode($kelas->sub_kelas, true) ?? [] as $sub)
                                            <option value="{{ $sub }}"
                                                {{ old('sub_kelas') == $sub ? 'selected' : '' }}>
                                                {{ $sub }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('sub_kelas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            @endif



                            <input type="hidden" id="kelasIdInput" name="kelas_id" value="{{ request('kelas') }}">

                            <button type="submit" class="btn btn-primary" id="uploadBtn">
                                <span id="uploadText">Upload Video</span>
                            </button>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



@endsection
