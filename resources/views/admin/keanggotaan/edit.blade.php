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
                        <label class="form-label">Harga Asli</label>
                        <input type="number" id="harga_asli" name="harga"
                            class="form-control @error('harga') is-invalid @enderror"
                            value="{{ old('harga', $keanggotaan->harga) }}">
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Satu Bulan</label>
                        <input type="number" id="harga_bulan" name="harga_setahun"
                            class="form-control @error('harga_setahun') is-invalid @enderror"
                            value="{{ old('harga_setahun', $keanggotaan->harga_setahun) }}">
                        @error('harga_setahun')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bulan</label>
                        <input type="number" id="bulan" name="bulan" min="1"
                            class="form-control @error('bulan') is-invalid @enderror"
                            value="{{ old('bulan', $keanggotaan->bulan ?? 1) }}"> <!-- Default ke 1 jika null -->
                        @error('bulan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Menampilkan hasil total harga -->
                    <p><strong>Total Harga: </strong><span id="totalHarga">0</span></p>
                    <input type="hidden" name="url" value="kosong">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function hitungTotalHarga() {
                let hargaBulan = parseFloat($('#harga_bulan').val()) || 0;
                let bulan = parseInt($('#bulan').val()) || 1; // Default minimal 1
                let total = hargaBulan * bulan;
                $('#totalHarga').text(total.toLocaleString()); // Format angka
            }

            // Panggil fungsi saat input berubah
            $('#harga_bulan, #bulan').on('input', function() {
                if ($(this).attr('id') === 'bulan' && $(this).val() < 1) {
                    $(this).val(1); // Set ke 1 jika user memasukkan angka kurang dari 1
                }
                hitungTotalHarga();
            });

            // Jalankan perhitungan pertama kali jika ada nilai default
            hitungTotalHarga();
        });
    </script>
@endsection
