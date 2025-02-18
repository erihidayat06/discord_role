@extends('admin.layouts.main')


@section('content')
    <div class="pagetitle">
        <h1>Data Tables Guild</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data Guild</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datatables Guild</h5>

                        <a href="/guild/create" class="btn btn-sm btn-primary mt-3">Tambah Guild</a>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Guild ID</th>
                                    <th scope="col">Expires</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($guilds as $guild)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $guild->name_guild }}</td>
                                        <td>{{ $guild->id_guild }}</td>
                                        <td>{{ $guild->expires ? 'true' : 'false' }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ url('/guild/' . $guild->id . '/edit') }}"
                                                    class="btn btn-warning btn-sm ms-2">Edit</a>
                                                <form action="{{ url('/guild/' . $guild->id) }}" method="POST"
                                                    class="ms-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus guild ini?')">Delete</button>
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
