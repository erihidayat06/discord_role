@extends('admin.layouts.main')


@section('content')
    <div class="pagetitle">
        <h1>Data Tables research</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data research</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card table-responsive">
                    <div class="card-body">
                        <h5 class="card-title">Datatables research</h5>

                        <a href="/admin/research/create" class="btn btn-sm btn-primary mt-3">Tambah research</a>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Gambar</th>
                                    <th>Tanggal</th>
                                    <th>Judul</th>
                                    <th>PDF</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($researchs as $research)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>
                                            @if ($research->gambar)
                                                <img src="{{ asset('storage/' . $research->gambar) }}" width="70"
                                                    class="img-thumbnail">
                                            @else
                                                <span class="text-muted">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>{{ date('M d, Y', strtotime($research->tanggal)) }}</td>
                                        <td>{{ $research->judul }}</td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#pdfModal{{ $research->id }}">Lihat</a>
                                            <div class="modal fade" id="pdfModal{{ $research->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Preview PDF: {{ $research->judul }}</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <iframe
                                                                src="https://drive.google.com/file/d/{{ $research->link }}/preview"
                                                                width="100%" height="600px"></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('/admin/research', $research->id) }}/edit"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ url('/admin/research', $research->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus research ini?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Data tidak tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>


                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
