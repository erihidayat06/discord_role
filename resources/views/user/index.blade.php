@extends('user.layouts.main')

@section('content')
    @empty(request('kategori') or request('nama_kategori'))
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
                            class="object-fit-cover border rounded w-100" alt="" height="300px">

                        <!-- Teks di bawah kanan dengan background -->
                        <div class="position-absolute bottom-0 end-0 bg-dark text-white px-3 py-1 rounded m-3">
                            {{ count($kelases->first()->moduls) }} Lessons
                        </div>
                    </a>
                </div>

            </div>
        </section>
    @endempty

    <section class="mt-5">
        @empty(request('nama_kategori'))
            <h4 class="fw-bold">All Classes </h4>
        @else
            <h4 class="fw-bold">{{ request('nama_kategori') }} </h4>
        @endempty

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($kelases as $kelas)
                <div class="col">
                    <a href="/kursus/{{ $kelas->slug }}" class="text-decoration-none text-white">
                        <div class="position-relative border rounded overflow-hidden">
                            <img src="{{ asset('storage/') . '/' . $kelas->gambar }}" alt="{{ $kelas->judul }}"
                                class="object-fit-cover w-100" height="200px">

                            <!-- Teks di bawah kanan dengan background -->
                            <div class="position-absolute bottom-0 end-0 bg-dark text-white px-3 py-1 rounded m-2"
                                style="font-size: 12px">
                                {{ count($kelas->moduls) }} Lessons
                            </div>
                        </div>
                        <h5 class="fw-bold mt-2">{{ $kelas->judul }}</h5>
                    </a>
                </div>
            @endforeach
        </div>

    </section>
@endsection
