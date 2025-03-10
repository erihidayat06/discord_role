@extends('admin.layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Update Pixel & Token</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pixel.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Input Pixel -->
                            <div class="mb-3">
                                <label for="pixel" class="form-label">Pixel ID</label>
                                <input type="text" name="pixel" id="pixel"
                                    class="form-control @error('pixel') is-invalid @enderror"
                                    value="{{ old('pixel', $data->pixel) }}" required>
                                @error('pixel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Input Token -->
                            <div class="mb-3">
                                <label for="token" class="form-label">Token (Opsional)</label>
                                <input type="text" name="token" id="token"
                                    class="form-control @error('token') is-invalid @enderror"
                                    value="{{ old('token', $data->token) }}">
                                @error('token')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tombol Submit -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Notifikasi Sukses -->
                @if (session('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif
            </div>
        </div>
    </div>
@endsection
