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
                        <label class="form-label">Harga Asli</label>
                        <input type="number" id="harga_asli" name="harga"
                            class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}">
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

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
                        <input type="number" id="bulan" name="bulan" min="1"
                            class="form-control @error('bulan') is-invalid @enderror" value="{{ old('bulan', 1) }}">
                        <!-- Default 1 -->
                        @error('bulan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Menampilkan hasil total harga -->
                    <p><strong>Total Harga: </strong><span id="totalHarga">0</span></p>
                    <input type="hidden" name="url" value="kosong">

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <select name="title" id="titleSelect" class="form-control @error('title') is-invalid @enderror">
                            <option value="0" {{ old('title') == 0 ? 'selected' : '' }}>Tidak</option>
                            <option value="1" {{ old('title') == 1 ? 'selected' : '' }}>Ya</option>
                        </select>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3" id="textTitleContainer" style="display: none;">
                        <label class="form-label">Text Title</label>
                        <input type="text" name="text_title"
                            class="form-control @error('text_title') is-invalid @enderror" value="{{ old('text_title') }}">
                        @error('text_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Akases Role Student</label>
                        <select name="akses_role" id="akses_roleSelect"
                            class="form-control @error('akses_role') is-invalid @enderror">
                            <option value="0" {{ old('akses_role') == 0 ? 'selected' : '' }}>Tidak</option>
                            <option value="1" {{ old('akses_role') == 1 ? 'selected' : '' }}>Ya</option>
                        </select>
                        @error('akses_role')
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
        document.addEventListener("DOMContentLoaded", function() {
            let titleSelect = document.getElementById("titleSelect");
            let textTitleContainer = document.getElementById("textTitleContainer");

            function toggleTextTitle() {
                if (titleSelect.value === "1") {
                    textTitleContainer.style.display = "block";
                } else {
                    textTitleContainer.style.display = "none";
                }
            }

            // Jalankan saat halaman dimuat (agar tetap tampil jika sebelumnya dipilih)
            toggleTextTitle();

            // Tambahkan event listener untuk perubahan pilihan
            titleSelect.addEventListener("change", toggleTextTitle);
        });
    </script>

    <script>
        $(document).ready(function() {
            function hitungTotalHarga() {
                let hargaBulan = parseFloat($('#harga_bulan').val()) || 0;
                let bulan = parseInt($('#bulan').val()) || 1; // Minimal 1 bulan
                let total = hargaBulan * bulan;
                $('#totalHarga').text(total.toLocaleString()); // Format angka
            }

            // Panggil fungsi saat input berubah
            $('#harga_bulan, #bulan').on('input', function() {
                if ($(this).attr('id') === 'bulan' && $(this).val() < 1) {
                    $(this).val(1); // Set ke 1 jika user masukkan 0
                }
                hitungTotalHarga();
            });

            // Hitung total saat halaman dimuat
            hitungTotalHarga();
        });
    </script>
@endsection
