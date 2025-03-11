@extends('admin.layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Daftar Harga</h3>
                <a href="{{ route('keanggotaan.create') }}" class="btn btn-sm btn-success">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="col-lg-4">
                    <form action="/admin/periode/{{ $periode->id }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="periode" class="form-label">Tanggal Periode</label>
                            <div class="input-group mb-3">

                                <input type="datetime-local" id="periode" name="periode"
                                    class="form-control @error('periode') is-invalid @enderror"
                                    value="{{ old('periode', $periode) }}" required aria-describedby="button-addon2">
                                <button class="btn btn-primary" type="submit" id="button-addon2">Button</button>
                            </div>
                            @error('periode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>

                <div class="table-responsive">

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Harga</th>
                                <th>Harga Setahun</th>
                                <th>Bulan</th>
                                <th>URL</th>
                                <th>Title</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keanggotaans as $index => $keanggotaan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ number_format($keanggotaan->harga, 0, ',', '.') }}</td>
                                    <td>{{ number_format($keanggotaan->harga_setahun, 0, ',', '.') }}</td>
                                    <td>{{ $keanggotaan->bulan }}</td>
                                    <td><a href="{{ $keanggotaan->url }}" target="_blank">Link</a></td>
                                    <td>{{ $keanggotaan->title ? 'Ya' : 'Tidak' }}</td>
                                    <td>
                                        <a href="{{ route('keanggotaan.edit', $keanggotaan->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('keanggotaan.destroy', $keanggotaan->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus ini?');">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
