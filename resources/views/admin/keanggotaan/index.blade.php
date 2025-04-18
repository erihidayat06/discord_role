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
                                <button class="btn btn-primary" type="submit" id="button-addon2">Simpan</button>
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
                                <th>Harga&nbsp;Asli&nbsp;(dicoret)</th>
                                <th>Harga&nbsp;Perbulan</th>
                                <th>Harga&nbsp;Total</th>
                                <th>Bulan</th>
                                <th>Title</th>
                                <th>Text&nbsp;title</th>
                                <th>Akses&nbsp;role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keanggotaans as $index => $keanggotaan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ number_format($keanggotaan->harga, 0, ',', '.') }}</td>
                                    <td>{{ number_format($keanggotaan->harga_setahun, 0, ',', '.') }}</td>
                                    <td>{{ number_format($keanggotaan->harga_setahun * $keanggotaan->bulan, 0, ',', '.') }}
                                    </td>
                                    <td>{{ $keanggotaan->bulan }}</td>
                                    <td>{{ $keanggotaan->title ? 'Ya' : 'Tidak' }}</td>
                                    <td>{{ $keanggotaan->text_title ?? '-' }}</td>
                                    <td>{{ $keanggotaan->akses_role ? 'Ya' : 'Tidak' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('keanggotaan.edit', $keanggotaan->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('keanggotaan.destroy', $keanggotaan->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger ms-2"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus ini?');">Hapus</button>
                                            </form>
                                        </div>
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
