@extends('admin.layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Keanggotaan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('keanggotaan.update', $keanggotaan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                            value="{{ old('harga', $keanggotaan->harga) }}">
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Setahun</label>
                        <input type="number" name="harga_setahun"
                            class="form-control @error('harga_setahun') is-invalid @enderror"
                            value="{{ old('harga_setahun', $keanggotaan->harga_setahun) }}">
                        @error('harga_setahun')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bulan</label>
                        <input type="number" name="bulan" class="form-control @error('bulan') is-invalid @enderror"
                            value="{{ old('bulan', $keanggotaan->bulan) }}">
                        @error('bulan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="url" name="url" class="form-control @error('url') is-invalid @enderror"
                            value="{{ old('url', $keanggotaan->url) }}">
                        @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <select name="title" class="form-control @error('title') is-invalid @enderror">
                            <option value="0" {{ old('title', $keanggotaan->title) == 0 ? 'selected' : '' }}>Tidak
                            </option>
                            <option value="1" {{ old('title', $keanggotaan->title) == 1 ? 'selected' : '' }}>Ya
                            </option>
                        </select>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('keanggotaan.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
