@extends('super_admin.index')


@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5>Daftar Website</h5>
            </div>
            <table class="datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pemilik</th>
                        <th>Nomor</th>
                        <th>Email</th>
                        <th>Is Admin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->no_tlp ?? '-' }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
