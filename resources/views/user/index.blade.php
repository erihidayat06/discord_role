@extends('user.layouts.main')

@section('content')
    <style>
        .img-card {
            width: 100%;
            /* Gunakan persentase agar fleksibel */
            max-width: 350px;
            /* Batasi lebar maksimum */
            height: 200px;
            /* Default height */
            object-fit: cover;
            /* Agar gambar tidak terdistorsi */
            border-radius: 8px;
            /* Tambahkan sedikit rounding */
        }

        @media (max-width: 1199px) {
            .img-card {
                height: 200px;
                /* Tinggi yang lebih sesuai untuk layar kecil */
            }
        }

        @media (max-width: 768px) {
            .img-card {
                height: 180px;
                /* Sesuaikan lagi untuk layar lebih kecil */
                max-width: 100%;
                /* Supaya tidak melebihi lebar parent */
            }
        }


        /* satu */
        .img-card-satu {
            width: 100%;
            /* Gunakan persentase agar fleksibel */
            max-width: 550px;
            /* Batasi lebar maksimum */
            height: 300px;
            /* Default height */
            object-fit: cover;
            /* Agar gambar tidak terdistorsi */
            border-radius: 8px;
            /* Tambahkan sedikit rounding */
        }

        @media (max-width: 1199px) {
            .img-card-satu {
                height: 200px;
                /* Tinggi yang lebih sesuai untuk layar kecil */
            }
        }

        @media (max-width: 768px) {
            .img-card-satu {
                height: 180px;
                /* Sesuaikan lagi untuk layar lebih kecil */
                max-width: 100%;
                /* Supaya tidak melebihi lebar parent */
            }
        }
    </style>
    @if (!request()->hasAny(['kategori', 'nama_kategori', 'query']))
        <div class="pagetitle">
            <h1 class="text-white">New & For You</h1>
        </div><!-- End Page Title -->
        <section>
            <div class="row">
                <div class="col-lg-6 d-flex align-items-center">
                    <h1 style="font-family: 'Bebas Neue', 'sans-serif'; font-size:70px">
                        The Art of Crypto Trading
                    </h1>
                </div>

                <div class="col-lg-6 position-relative">
                    <a href="/kursus/{{ $kelases->first()->slug }}">
                        <img src="{{ asset('storage/') . '/' . $kelases->first()->gambar }}"
                            class="object-fit-cover border border-0 rounded img-card-satu" alt="">

                        <!-- Teks di bawah kanan dengan background -->
                        <div class="position-absolute bottom-0 end-0 bg-dark text-white px-3 py-1 rounded m-3">
                            {{ count($kelases->first()->moduls) }} Lessons
                        </div>
                    </a>
                </div>

            </div>
        </section>
    @endif

    <section class="mt-5">
        @empty(request('nama_kategori'))
            <h5 class="fw-bold mb-3">All Classes </h5>
        @else
            <h5 class="fw-bold mb-5">{{ request('nama_kategori') }} </h5>
        @endempty

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($kelases as $kelas)
                <div class="col ">
                    <a href="/kursus/{{ $kelas->slug }}" class="text-decoration-none text-white ">
                        <div class="position-relative border border-0  rounded overflow-hidden">
                            <img src="{{ asset('storage/') . '/' . $kelas->gambar }}" alt="{{ $kelas->judul }}"
                                class="object-fit-cover img-card">

                            <!-- Teks di bawah kanan dengan background -->
                            <div class="position-absolute bottom-0 end-0 bg-dark text-white px-3 py-1 rounded m-2"
                                style="font-size: 12px">
                                {{ count($kelas->moduls) }}
                                {{ $kelas->judul === 'Welcome to Akademi Crypto' ? 'Start' : 'Lessons' }}
                            </div>
                        </div>
                        <h6 class="fw-bold mt-2">{{ $kelas->judul }}</h6>
                    </a>
                </div>
            @endforeach
        </div>

    </section>
@endsection
