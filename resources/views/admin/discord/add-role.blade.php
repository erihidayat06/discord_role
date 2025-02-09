@extends('admin.layouts.main')

@section('content')



    <div class="pagetitle">
        <h1>Tambah Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/discord/data-role/view">Data Role</a></li>
                <li class="breadcrumb-item active">Tambah data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Tambahkan Role Discord
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('discord.addRole') }}" method="POST">
                    @csrf

                    <div class="mb-3 mt-3">
                        <label for="discord_id" class="form-label">Pilih Pengguna</label>
                        <select class="form-select @error('discord_id') is-invalid @enderror js-example-basic-single"
                            id="discord_id" name="discord_id">
                            <option disabled {{ old('discord_id') ? '' : 'selected' }}>Pilih Pengguna</option>
                            @foreach ($users as $user)
                                <option value="{{ $user['id'] }}" data-roles="{{ json_encode($user['roles']) }}"
                                    {{ old('discord_id') == $user['id'] ? 'selected' : '' }}>
                                    {{ $user['username'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('discord_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <!-- Tempat Menampilkan Role -->
                        <div id="user_roles" class="mt-3"></div>
                    </div>

                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select class="form-select @error('role_id') is-invalid @enderror" id="role_id" name="role_id">
                            @foreach ($roles as $item)
                                <option value="{{ $item['id'] }}" {{ old('role_id') == $item['id'] ? 'selected' : '' }}>
                                    {{ $item['name'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="days" class="form-label">Tanggal Expires</label>
                        <input type="date" class="form-control @error('days') is-invalid @enderror" id="days"
                            name="days" value="{{ old('days') }}" required>
                        @error('days')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" id="tambah">Tambah Role</button>
                </form>

            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#discord_id').select2({
                placeholder: "Pilih Pengguna",
                allowClear: true
            });
        });
        $(document).ready(function() {
            $('#role_id').select2({
                placeholder: "Pilih Pengguna",
                allowClear: true
            });
        });
    </script>

    <script>
        var roleArray = []; // Variabel global

        $(document).ready(function() {
            $("#discord_id").on("change", function() {
                var selectedOption = $(this).find("option:selected");
                var rolesData = selectedOption.attr("data-roles"); // Ambil data-roles

                var roleArray = [];
                try {
                    roleArray = rolesData ? JSON.parse(rolesData) : []; // Parse JSON
                } catch (e) {
                    console.error("Error parsing roles:", e);
                }

                // Reset semua option agar tidak ada sisa dari pilihan sebelumnya
                $("#role_id option").prop("disabled", false);

                // if (roleArray.length > 0) {
                //     roleArray.forEach(role => {
                //         // Jika option dengan value role.id sudah ada, maka disable
                //         $("#role_id option[value='" + role.id + "']").prop("disabled", true);
                //     });
                // }

                // **Tambahkan kembali untuk menampilkan role di #user_roles**
                var roleHtml = roleArray.length > 0 ?
                    roleArray.map(role => `<span class="badge bg-primary me-1">${role.name}</span>`).join(
                        "") :
                    `<span class="badge bg-secondary">Tidak ada role</span>`;

                $("#user_roles").html(roleHtml); // Perbarui tampilan role

                console.log("Disabled Role IDs:", roleArray.map(role => role.id)); // Debugging
            });




        });

        // Panggil kapan saja
        setTimeout(getRoles, 5000);
    </script>




@endsection
