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

                            <div class="mb-3">
                                <label class="form-label">Video Saat Ini</label>
                                <div>
                                    <iframe
                                        src="{{ $modul->video }}?watermark={{ urlencode(env('BUNNY_STREAM_WATERMARK_URL')) }}"
                                        width="100%" height="500" allow="autoplay; fullscreen" frameborder="0"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Video ID</label>
                                <input type="text" name="video" id="videoInput"
                                    class="form-control @error('video') is-invalid @enderror"
                                    value="{{ old('video', substr($modul->video, 46)) }}">
                                @error('video')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update Modul</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
