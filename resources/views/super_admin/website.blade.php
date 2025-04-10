@extends('super_admin.index')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-title d-flex justify-content-between align-items-center">
                <h5>Daftar Website</h5>
                <a href="{{ route('websites.create') }}" class="btn btn-sm btn-primary">Tambah Website</a>
            </div>

            <table class="datatable table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pemilik</th>
                        <th>Nomor</th>
                        <th>Email</th>
                        <th>Nama Website</th>
                        <th>Status</th>

                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($websites as $index => $website)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $website->user_name }}</td>
                            <td>{{ $website->no_tlp ?? '-' }}</td>
                            <td>{{ $website->email }}</td>
                            <td>
                                <a href="http://{{ $website->domain }}" target="_blank">
                                    {{ $website->domain }}
                                </a>
                            </td>

                            <td>
                                @if ($website->is_active)
                                    <form action="{{ route('websites.toggle', $website->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-success" type="submit"
                                            title="Klik untuk nonaktifkan">
                                            Aktif
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('websites.toggle', $website->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-secondary" type="submit" title="Klik untuk aktifkan">
                                            Nonaktif
                                        </button>
                                    </form>
                                @endif
                            </td>

                            <td class="d-flex gap-2">
                                <a href="{{ route('websites.edit', $website->id) }}" class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('websites.destroy', $website->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus website ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
