@extends('admin.layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Keanggotaan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('keanggotaan.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Harga Satu Bulan</label>
                        <input type="number" id="harga_bulan" name="harga_setahun"
                            class="form-control @error('harga_setahun') is-invalid @enderror"
                            value="{{ old('harga_setahun') }}">
                        @error('harga_setahun')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bulan</label>
                        <input type="number" id="bulan" name="bulan"
                            class="form-control @error('bulan') is-invalid @enderror" value="{{ old('bulan') }}">
                        @error('bulan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Menampilkan hasil total harga -->
                    <p><strong>Total Harga: </strong><span id="totalHarga">0</span></p>

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <select name="title" class="form-control @error('title') is-invalid @enderror">
                            <option value="0" {{ old('title') == 0 ? 'selected' : '' }}>Tidak</option>
                            <option value="1" {{ old('title') == 1 ? 'selected' : '' }}>Ya</option>
                        </select>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('keanggotaan.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function hitungTotalHarga() {
                let hargaBulan = parseFloat($('#harga_bulan').val()) || 0;
                let bulan = parseInt($('#bulan').val()) || 0;
                let total = hargaBulan * bulan;
                $('#totalHarga').text(total.toLocaleString()); // Format angka
            }

            // Panggil fungsi saat input berubah
            $('#harga_bulan, #bulan').on('input', hitungTotalHarga);
        });
    </script>
@endsection
