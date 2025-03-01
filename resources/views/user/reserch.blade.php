@extends('user.layouts_research.main')

@section('content')
    <style>
        /* Placeholder putih */
        ::placeholder {
            color: white !important;
        }

        /* Menyesuaikan lebar input */
        .input-group {
            max-width: 400px;
            width: 100%;
        }

        /* Menyesuaikan gambar */
        .card-img-top {
            object-fit: cover;
            width: 100%;
            height: 150px;
        }

        .ndfHFb-c4YZDc-to915-LgbsSe {
            display: none !important;
            pointer-events: none !important;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center flex-wrap flex-md-nowrap" style="margin-top: 100px">
        <h3 class="mb-3 mb-md-0">Research Report</h3>
        <div class="ms-auto" style="max-width: 400px; width: 100%;">
            <input type="text" id="searchInput" class="form-control bg-dark border-0 text-white"
                placeholder="Cari Research...">
        </div>
    </div>

    <div id="researchContainer" class="row row-cols-1 row-cols-md-4 g-4 mt-5">
        @foreach ($researchs as $index => $research)
            <div class="col research-item {{ $index >= 12 ? 'd-none' : '' }}" data-bs-toggle="modal"
                data-bs-target="#pdfModal{{ $research->id }}">
                <a href="#" class="card bg-dark">
                    <img src="{{ asset('storage/' . $research->gambar) }}" class="card-img-top" alt="Gambar Research">
                    <div class="card-body">
                        <h5 class="card-title text-white">{{ $research->judul }}</h5>
                        <p class="card-text text-secondary mt-4">{{ date('M d, Y', strtotime($research->tanggal)) }}</p>
                    </div>
                </a>
            </div>
            <div class="modal fade p-0 m-0" id="pdfModal{{ $research->id }}" tabindex="-1">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content bg-dark d-flex flex-column">
                        <div class="modal-header p-1">
                            <h5 class="modal-title text-white">{{ $research->judul }}</h5>
                            <button type="button" class="btn-close custom-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body flex-grow-1 p-0 d-flex">
                            <iframe src="https://drive.google.com/file/d/{{ $research->link }}/preview?embedded=true"
                                class="w-100 h-100 border-0" sandbox="allow-scripts allow-same-origin"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                /* Tombol close putih & lebih besar */
                .custom-close {
                    filter: invert(1);
                    width: 30px;
                    height: 30px;
                }

                /* Pastikan modal-body tidak overflow */
                .modal-body {
                    overflow: hidden;
                }
            </style>
        @endforeach
    </div>

    {{-- Tombol Load More --}}
    @if (count($researchs) > 12)
        <div class="text-center mt-4">
            <button id="loadMore" class="btn btn-info text-white">Load More</button>
        </div>
    @endif

    {{-- JavaScript untuk Pencarian dan Load More --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let itemsPerPage = 12; // Batas awal data yang ditampilkan
            let totalItems = $(".research-item").length;
            let visibleItems = itemsPerPage;

            // Pencarian dengan jQuery
            $('#searchInput').on('keyup', function() {
                let query = $(this).val().toLowerCase();
                $('.research-item').each(function() {
                    let title = $(this).find('.card-title').text().toLowerCase();
                    $(this).toggle(title.includes(query));
                });
            });

            // Load More Functionality
            $('#loadMore').on('click', function() {
                visibleItems += itemsPerPage;
                $('.research-item').slice(0, visibleItems).removeClass('d-none');

                // Sembunyikan tombol jika semua item sudah ditampilkan
                if (visibleItems >= totalItems) {
                    $('#loadMore').hide();
                }
            });
        });
    </script>
@endsection
