@extends('user.layouts_research.main')

@section('content')
    <style>
        ::placeholder {
            color: white !important;
        }

        .input-group {
            max-width: 400px;
            width: 100%;
        }

        .card-img-top {
            object-fit: cover;
            width: 100%;
            height: 150px;
        }

        .card {
            height: 100%;
        }

        .card-body {
            display: flex;
            flex-direction: column;
        }

        .ndfHFb-c4YZDc-to915-LgbsSe {
            display: none !important;
            pointer-events: none !important;
        }

        /* Styling tombol close */
        .modal-header .btn-close {
            filter: invert(1);
            /* Mengubah warna menjadi putih */
            transform: scale(1.5);
            /* Memperbesar tombol close */
            opacity: 1;
            /* Pastikan terlihat */
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
            <div class="col research-item {{ $index >= 12 ? 'd-none' : '' }}">
                <a href="#" class="card bg-dark d-flex flex-column h-100" data-bs-toggle="modal"
                    data-bs-target="#pdfModal{{ $research->id }}" data-link="{{ $research->link }}">
                    <img src="{{ asset('storage/' . $research->gambar) }}" class="card-img-top" alt="Gambar Research">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-white">{{ $research->judul }}</h5>
                        <p class="card-text text-secondary mt-auto">{{ date('M d, Y', strtotime($research->tanggal)) }}</p>
                    </div>
                </a>
            </div>
            <div class="modal fade p-0 m-0" id="pdfModal{{ $research->id }}" tabindex="-1">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content bg-dark d-flex flex-column">
                        <div class="modal-header p-1">
                            <h5 class="modal-title text-white">{{ $research->judul }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body flex-grow-1 p-0 d-flex">
                            <iframe id="iframe-{{ $research->id }}" class="w-100 h-100 border-0"
                                sandbox="allow-scripts allow-same-origin"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if (count($researchs) > 12)
        <div class="text-center mt-4">
            <button id="loadMore" class="btn btn-dark text-white">Load More</button>
        </div>
    @endif

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let itemsPerPage = 12;
            let totalItems = $(".research-item").length;
            let visibleItems = itemsPerPage;
            $('#searchInput').on('keyup', function() {
                let query = $(this).val().toLowerCase();

                if (query) {
                    $('.research-item').removeClass('d-none').each(function() {
                        let title = $(this).find('.card-title').text().toLowerCase();
                        $(this).toggle(title.includes(query));
                    });
                    $('#loadMore').hide(); // Sembunyikan tombol Load More saat pencarian
                } else {
                    // Jika input kosong, kembalikan ke tampilan awal
                    visibleItems = itemsPerPage; // Reset jumlah item yang terlihat
                    $('.research-item').addClass('d-none').slice(0, visibleItems).removeClass('d-none');

                    // Cek apakah tombol "Load More" perlu ditampilkan
                    $('#loadMore').toggle(visibleItems < totalItems);
                }
            });



            $('#loadMore').on('click', function() {
                visibleItems += itemsPerPage;
                $('.research-item').slice(0, visibleItems).removeClass('d-none');

                if (visibleItems >= totalItems) {
                    $('#loadMore').hide();
                }
            });


            $('.modal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let link = button.data('link');
                let modal = $(this);
                let iframe = modal.find('iframe');

                iframe.attr('src', 'https://drive.google.com/file/d/' + link + '/preview?embedded=true');
            });

            $('.modal').on('hidden.bs.modal', function() {
                $(this).find('iframe').attr('src', '');
            });
        });
    </script>
@endsection
