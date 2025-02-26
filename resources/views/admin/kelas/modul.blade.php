@extends('admin.layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Data Tables modul</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data modul</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card table-responsive">
                    <div class="card-body">
                        <h5 class="card-title">Datatables modul</h5>

                        <a href="/kelas/modul/create?kelas={{ $kelas->id }}" class="btn btn-sm btn-primary mt-3">Tambah
                            modul</a>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama modul</th>
                                    <th scope="col">Video</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;

                                @endphp
                                @foreach ($moduls as $modul)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $modul->judul }} </td>
                                        <td>
                                            <a
                                                href="{{ route('lihat.video', ['kelas_id' => $kelas->id, 'id' => $modul->id]) }}">Lihat
                                                video</a>
                                        </td>


                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ url('/kelas/modul/' . $modul->id . '/edit') }}"
                                                    class="btn btn-warning btn-sm ms-2">Edit</a>
                                                <form action="{{ url('/kelas/modul/' . $modul->id) }}" method="POST"
                                                    class="ms-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus modul ini?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
