@extends('admin.layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Data Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="/discord/data-role/view">Data Role</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="card-title">Data Role User</h5>

                        <a href="/discord/add-role/view" class="btn btn-sm btn-primary mt-3 mb-3">Add Role User</a>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Avatar</th>
                                    <th>Username</th>
                                    <th>Roles (Discord)</th>
                                    <th>Role (Database)</th>
                                    <th>Tanggal Expires</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- {{ dd($formattedUsers) }} --}}
                                @foreach ($formattedUsers as $user)
                                    <tr>
                                        <td><img src="{{ $user['avatar'] }}" width="50"></td>
                                        <td>{{ $user['username'] }}</td>
                                        <td>{{ implode(', ', $user['roles']) }}</td>
                                        <td>{{ $user['database_role'] }}</td>
                                        <td>{{ date('d F Y', strtotime($user['tanggal_aktif'])) }}</td>
                                        <td>

                                            @if ($user['tanggal_aktif'] >= now())
                                                <a href="/discord/edit/view/{{ $user['id'] }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>

                                                <form action="/discord/delete/{{ $user['id'] }}" method="POST"
                                                    class="d-inline" onsubmit="return confirmDelete(event)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>
                                            @endif
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

    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Mencegah submit langsung
            if (confirm("Apakah Anda yakin ingin menghapus data add role ini?")) {
                event.target.submit(); // Submit jika user konfirmasi
            }
        }
    </script>
@endsection
