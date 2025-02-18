@extends('admin.layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="pagetitle">
            <h1>Update Data</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/discord/data-role/view">Data Role</a></li>
                    <li class="breadcrumb-item active">Edit sata</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                Edit Role Discord
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
                <form action="/discord/update/role/{{ $userRole->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 mt-3">
                        <label for="discord_id" class="form-label">Pilih Pengguna</label>
                        <select class="form-select @error('discord_id') is-invalid @enderror" id="discord_id"
                            name="discord_id">
                            <option disabled {{ old('discord_id', $userRole->discord_id) ? '' : 'selected' }}>Pilih
                                Pengguna
                            </option>

                            @foreach ($formattedUsers as $user)
                                @if (old('discord_id', $userRole->discord_id) == $user['id'])
                                    <option value="{{ $user['id'] }}" data-roles="{{ json_encode($user['roles']) }}"
                                        {{ old('discord_id', $userRole->discord_id) == $user['id'] ? 'selected' : '' }}>
                                        {{ $user['username'] }}
                                    </option>
                                @endif
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
                                <option value="{{ $item['id'] }}" data-role-name="{{ $item['name'] }}"
                                    {{ old('role_id', $userRole->role_id) == $item['id'] ? 'selected' : '' }}>
                                    {{ $item['name'] }}
                                </option>
                            @endforeach
                        </select>

                        @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if ($guild)
                        <div class="mb-3">
                            <label for="days" class="form-label">Tanggal Expires</label>
                            <input type="date" class="form-control @error('days') is-invalid @enderror" id="days"
                                name="days" value="{{ date('Y-m-d', strtotime(old('days', $userRole->expires_at))) }}"
                                required>
                            @error('days')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @else
                        <input type="hidden" name="days"
                            value="{{ date('Y-m-d', strtotime(old('days', $userRole->expires_at))) }}">
                    @endif

                    <button type="submit" class="btn btn-success" id="update">Update Role</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#role_id').select2({
                placeholder: "Pilih Pengguna",
                allowClear: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#discord_id").on("change", function() {
                var selectedOption = $(this).find("option:selected");
                var rolesData = selectedOption.attr("data-roles");

                var userRoles = [];
                try {
                    userRoles = rolesData ? JSON.parse(rolesData) : [];
                } catch (e) {
                    console.error("Error parsing roles:", e);
                }

                // Reset semua option agar tidak ada yang disabled
                $("#role_id option").prop("disabled", false);

                // Disable role yang sudah dimiliki user
                $("#role_id option").each(function() {
                    var roleName = $(this).attr("data-role-name");
                    if (!userRoles.includes(roleName)) {
                        $(this).prop("disabled", true);
                    }
                });

                // Tampilkan role user yang dipilih
                var roleHtml = userRoles.length > 0 ?
                    userRoles.map(role => `<span class="badge bg-primary me-1">${role}</span>`).join("") :
                    `<span class="badge bg-secondary">Tidak ada role</span>`;

                $("#user_roles").html(roleHtml);
            });

            // Trigger event change agar saat halaman dimuat role yang dimiliki langsung di-disable
            $("#discord_id").trigger("change");
        });
    </script>
@endsection
