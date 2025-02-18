@extends('admin.layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Tambah Data Multiple</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/discord/data-role/view">Data Role</a></li>
                <li class="breadcrumb-item active">Tambah data multiple</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Tambahkan Role Discord
            </div>
            <div class="card-body">
                <form action="/discord/add-role/multiple" method="POST">
                    @csrf

                    <label for="roleDropdown" class="from-lable">Pilih Role</label>
                    <select id="roleDropdown" class="form-select mt-3" name="role_id">
                        <option value="">-- Pilih Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                        @endforeach
                    </select>

                    <!-- Input pencarian -->
                    <input type="text" id="searchInput" class="form-control mt-3" placeholder="Cari pengguna...">

                    <!-- Tampilkan hasil -->
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Discord ID</th>
                                @if ($guild)
                                    <th>Tanggal Expire</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="userTable"></tbody>
                    </table>
                    <div id="loading"></div>
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#roleDropdown").change(function() {
                let roleId = $(this).val();
                let tbody = $("#userTable");
                let loadingIndicator = $("#loading");
                tbody.empty();
                if (roleId) {
                    loadingIndicator.text("loading...")
                    $.ajax({
                        url: "/get-discord-users",
                        type: "GET",
                        data: {
                            role_id: roleId
                        },
                        success: function(response) {
                            loadingIndicator.text("")
                            tbody.empty();
                            if (response.length > 0) {
                                $.each(response, function(index, user) {
                                    tbody.append(
                                        `<tr>
                                            <td>${index + 1}</td>
                                            <td class="username">${user.username ?? 'Unknown'}</td>
                                            <td>${user.id ?? 'N/A'} <input type="hidden" value="${user.id ?? 'N/A'}" name="discord_id[]"></td>
                                             @if ($guild)
                                            <td><input type="date" name="expires_at[]" class="form-control"></td>
                                            @else
                                            <td><input type="hidden" name="expires_at[]" class="form-control" value="{{ now()->addDay()->toDateTimeString() }}"></td>
                                            @endif
                                        </tr>`
                                    );
                                });
                            } else {
                                tbody.html(
                                    '<tr><td colspan="4">Tidak ada anggota dengan role ini.</td></tr>'
                                );
                            }
                        },
                        error: function() {
                            loadingIndicator.text("");
                            tbody.html(
                                '<tr><td colspan="4" class="text-danger">Gagal mengambil data.</td></tr>'
                            );
                        }
                    });
                } else {
                    tbody.html('<tr><td colspan="4">Pilih role untuk melihat anggota</td></tr>');
                }
            });

            // Fitur pencarian
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#userTable tr").filter(function() {
                    $(this).toggle($(this).find(".username").text().toLowerCase().indexOf(value) > -
                        1)
                });
            });
        });
    </script>
@endsection
