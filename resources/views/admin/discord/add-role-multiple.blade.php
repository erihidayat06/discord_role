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

                    <!-- Tampilkan hasil -->
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Discord ID</th>
                                <th>Tanggal Expire</th>
                            </tr>
                        </thead>
                        <tbody id="userTable">


                            <tr id="text-pilih" style="display: block;">
                                <td colspan="4">Pilih role untuk melihat anggota</td>
                            </tr>
                        </tbody>
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
                let text_pilih = $("#text-pilih");
                text_pilih.hide()

                if (roleId) {
                    loadingIndicator.text("loading...")
                    tbody.empty();


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
                                    <td>${user.username ?? 'Unknown'}</td>
                                    <td>${user.id ?? 'N/A'} <input type="hidden" value="${user.id ?? 'N/A'}" name="discord_id[]"></td>
                                    <td><input type="date" name="expires_at[]" class="form-control"></td>

                                </tr>`
                                    );
                                });
                            } else {
                                tbody.html(
                                    '<tr><td colspan="3">Tidak ada anggota dengan role ini.</td></tr>'
                                );
                            }
                        },
                        error: function() {
                            loadingIndicator.css("display", "none"); // ✅ Sembunyikan jika gagal
                            tbody.html(
                                '<tr><td colspan="3" class="text-danger">Gagal mengambil data.</td></tr>'
                            );
                        }
                    });
                } else {
                    tbody.html('<tr><td colspan="3">Pilih role untuk melihat anggota</td></tr>');
                }
            });
        });
    </script>


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
