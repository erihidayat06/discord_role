@extends('admin.layouts.main')
@section('content')
    <div class="pagetitle d-flex justify-content-between align-items-center">
        <h1>Data Kelas</h1>
        <a href="{{ url('/kelas/create') }}{{ request('kategori') ? '?kategori=' . request('kategori') : '' }}"
            class="btn btn-sm btn-primary">
            Tambah Kelas
        </a>
    </div><!-- End Page Title -->

    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/discord/data-role/view">Home</a></li>
            <li class="breadcrumb-item">Kelas</li>
        </ol>
    </nav>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($kelases->sortByDesc('created_at') as $kelas)
            <div class="col">
                <div class="card position-relative">
                    <!-- Tombol Naik & Turun di Pojok Kiri Atas -->
                    <div class="position-absolute top-0 start-0 m-2 d-flex">
                        <form action="{{ url('/kelas/' . $kelas->id . '/down') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary">⬆</button>
                        </form>
                        <form action="{{ url('/kelas/' . $kelas->id . '/up') }}" method="POST" class="me-1">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-secondary ms-2">⬇</button>
                        </form>
                    </div>

                    <img src="{{ asset('storage') }}/{{ $kelas->gambar }}" class="card-img-top object-fit-cover"
                        alt="..." height="200">
                    <div class="card-body">
                        <h5 class="card-title">{{ $kelas->judul }}</h5>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex">
                            <a href="/kelas/{{ $kelas->id }}" class="col-4 border-end text-center text-info">
                                <i class="bi bi-book-half fs-4 p-2"></i>
                                <p class="mb-0 small">Modul</p>
                            </a>
                            <a href="/kelas/{{ $kelas->id }}/edit" class="col-4 border-end text-center text-success">
                                <i class="bi bi-pencil-square fs-4 p-2"></i>
                                <p class="mb-0 small">Edit</p>
                            </a>
                            <form action="/kelas/{{ $kelas->id }}" method="POST" class="col-4 text-center">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="border-0 bg-transparent text-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">
                                    <i class="bi bi-trash fs-4 p-2"></i>
                                    <p class="mb-0 small">Hapus</p>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
@endsection
