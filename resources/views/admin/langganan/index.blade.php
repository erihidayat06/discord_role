@extends('admin.layouts.main')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <h2 class="mb-4">Daftar Langganan Pengguna</h2>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                    type="button" role="tab" aria-controls="pills-home" aria-selected="true">User Langganan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                    type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Datar user</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                tabindex="0">

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
                                        <th>Expired (Tanggal)</th>
                                        <th>Discord Active</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $index => $user)
                                        @if ($user->expired != null && $user->expired > now())
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $user->discord_id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <input type="date" class="expired-input form-control"
                                                        data-user-id="{{ $user->id }}"
                                                        value="{{ \Carbon\Carbon::parse($user->expired)->format('Y-m-d') }}">
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge discord-active-badge {{ $user->discord_active ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $user->discord_active ? 'Aktif' : 'Tidak Aktif' }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data pengguna</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                tabindex="0">

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
                                        <th>Expired (Tanggal)</th>
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
                                                <input type="date" class="expired-input form-control"
                                                    data-user-id="{{ $user->id }}"
                                                    value="{{ \Carbon\Carbon::parse($user->expired)->format('Y-m-d') }}">
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
                                            <td colspan="6" class="text-center">Tidak ada data pengguna</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
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
            let updateTimeout;

            expiredInputs.forEach(function(input) {
                input.addEventListener("input", function() {
                    clearTimeout(updateTimeout);

                    updateTimeout = setTimeout(() => {
                        let userId = this.dataset.userId;
                        let newDate = this.value;

                        let csrfToken = document.querySelector('meta[name="csrf-token"]')
                            ?.content || '';
                        if (!csrfToken) {
                            console.error("CSRF Token tidak ditemukan!");
                            return;
                        }

                        input.classList.add("loading");

                        fetch(`/admin/langganan/update-expired/${userId}`, {
                                method: "PATCH",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": csrfToken
                                },
                                body: JSON.stringify({
                                    expired_date: newDate
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log("Response dari server:", data);
                                input.style.backgroundColor = data.success ? "#d4edda" :
                                    "#f8d7da";

                                setTimeout(() => {
                                    input.style.backgroundColor = "";
                                    input.classList.remove("loading");
                                }, 1000);

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
                                input.style.backgroundColor = "#f8d7da";

                                setTimeout(() => {
                                    input.style.backgroundColor = "";
                                    input.classList.remove("loading");
                                }, 1000);
                            });
                    }, 500);
                });
            });
        });
    </script>
@endsection
