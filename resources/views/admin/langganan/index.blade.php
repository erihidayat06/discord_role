@extends('admin.layouts.main')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <h2 class="mb-4">Daftar Langganan Pengguna</h2>

        <div class="card">
            <div class="card-body mt-3">
                <div class="table-responsive">
                    <table class="table table-striped datatable">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Discord ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Expired (hari)</th>
                                <th>Discord Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->discord_id }}</td>
                                    <td>{{ $user->name }}</td>


                                    <td>{{ $user->email }}</td>

                                    <td>
                                        <input type="number" class="expired-input form-control"
                                            data-user-id="{{ $user->id }}" data-expired="{{ $user->expired }}"
                                            value="{{ \Carbon\Carbon::now()->diffInDays($user->expired) }}" min="0">
                                    </td>





                                    <td>
                                        <span
                                            class="badge discord-active-badge {{ $user->discord_active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $user->discord_active ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data pengguna</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .expired-input.loading {
            opacity: 0.5;
            pointer-events: none;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let expiredInputs = document.querySelectorAll(".expired-input");
            let updateTimeout; // Debounce timeout

            expiredInputs.forEach(function(input) {
                let expiredDateStr = input.getAttribute("data-expired");
                let expiredDate = new Date(expiredDateStr + "T00:00:00");
                let today = new Date();
                let timeDiff = expiredDate - today;
                let daysLeft = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

                input.value = daysLeft > 0 ? daysLeft : 0;

                input.addEventListener("input", function() {
                    clearTimeout(updateTimeout); // Hapus timeout sebelumnya untuk debounce

                    updateTimeout = setTimeout(() => {
                        let userId = this.dataset.userId;
                        let newDays = parseInt(this.value) || 0;

                        if (newDays < 0) {
                            this.value = 0;
                            newDays = 0;
                        }

                        let csrfToken = document.querySelector('meta[name="csrf-token"]')
                            ?.content || '';

                        if (!csrfToken) {
                            console.error("CSRF Token tidak ditemukan!");
                            return;
                        }

                        input.classList.add("loading"); // Aktifkan loading efek

                        fetch(`/admin/langganan/update-expired/${userId}`, {
                                method: "PATCH",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": csrfToken
                                },
                                body: JSON.stringify({
                                    days: newDays
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log("Response dari server:", data);

                                // Ubah warna jika sukses atau gagal
                                input.style.backgroundColor = data.success ? "#d4edda" :
                                    "#f8d7da";

                                setTimeout(() => {
                                    input.style.backgroundColor = "";
                                    input.classList.remove(
                                        "loading"); // Matikan loading efek
                                }, 1000);

                                // 🔹 Update badge status Discord Active
                                let badge = input.closest("tr").querySelector(
                                    ".discord-active-badge");
                                if (badge) {
                                    if (data.discord_active) {
                                        badge.classList.remove("bg-danger");
                                        badge.classList.add("bg-success");
                                        badge.textContent = "Aktif";
                                    } else {
                                        badge.classList.remove("bg-success");
                                        badge.classList.add("bg-danger");
                                        badge.textContent = "Tidak Aktif";
                                    }
                                }

                            })
                            .catch(error => {
                                console.error("Error:", error);
                                input.style.backgroundColor =
                                    "#f8d7da"; // Warna merah jika gagal

                                setTimeout(() => {
                                    input.style.backgroundColor = "";
                                    input.classList.remove("loading");
                                }, 1000);
                            });
                    }, 500); // Delay 500ms agar tidak spam request
                });
            });
        });
    </script>
@endsection
