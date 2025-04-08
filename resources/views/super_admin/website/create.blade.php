@extends('super_admin.index')

@section('content')
    <div class="container mt-4">
        <div class="card shadow rounded-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Tambah Website</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('websites.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="user_id" class="form-label">Pemilik</label>
                        <select name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                            <option value="">-- Pilih Pemilik --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="domain" class="form-label">Domain Website</label>
                        <input type="text" name="domain" class="form-control @error('domain') is-invalid @enderror"
                            value="{{ old('domain') }}">
                        @error('domain')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
