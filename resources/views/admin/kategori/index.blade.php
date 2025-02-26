@extends('admin.layouts.main')


@section('content')
    <div class="pagetitle">
        <h1>Data Tables kategori</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data kategori</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card table-responsive">
                    <div class="card-body">
                        <h5 class="card-title">Datatables kategori</h5>

                        <a href="/kategori/create" class="btn btn-sm btn-primary mt-3">Tambah kategori</a>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Kategori</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="kategoriTable">
                                @foreach ($kategoris->sortBy('order') as $kategori)
                                    <tr data-id="{{ $kategori->id }}">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $kategori->nm_kategori }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-primary btn-sm me-1 move-up"
                                                    data-id="{{ $kategori->id }}">⬆</button>
                                                <button class="btn btn-secondary btn-sm me-1 move-down"
                                                    data-id="{{ $kategori->id }}">⬇</button>
                                                <a href="{{ url('/kategori/' . $kategori->id . '/edit') }}"
                                                    class="btn btn-warning btn-sm me-1">Edit</a>
                                                <form action="{{ url('/kategori/' . $kategori->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Delete</button>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Tombol naik
            $(".move-up").click(function() {
                let row = $(this).closest("tr");
                let id = $(this).data("id");

                $.ajax({
                    url: "/kategori/" + id + "/up",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function() {
                        row.prev().before(row);
                    }
                });
            });

            // Tombol turun
            $(".move-down").click(function() {
                let row = $(this).closest("tr");
                let id = $(this).data("id");

                $.ajax({
                    url: "/kategori/" + id + "/down",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function() {
                        row.next().after(row);
                    }
                });
            });
        });
    </script>
@endsection
