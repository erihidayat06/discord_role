<nav class="navbar navbar-expand-lg">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="/">
            <img src="{{ asset(profil_web()->logo) }}" alt="Logo" style="height: 50px;">
        </a>

        <style>
            .navbar-toggler {
                border-color: rgba(255, 255, 255, 0.8);
                /* Ubah warna border menjadi putih */
            }

            .navbar-toggler-icon {
                filter: invert(1);
                /* Mengubah warna ikon menjadi putih */
            }
        </style>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"
            style="border-color: rgba(255, 255, 255, 0.8);">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>


        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center gap-2">
                @if (auth()->check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center text-white" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth()->user()->avatar ?? 'https://cdn.discordapp.com/embed/avatars/0.png' }}"
                                alt="Avatar" class="rounded-circle me-2" width="30" height="30">
                            <span>{{ auth()->user()->name ?? auth()->user()->discord_name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="/orderan" class="dropdown-item">Orderan</a>
                            </li>
                            @if (auth()->user()->is_admin)
                                <li><a class="dropdown-item" href="/kursus">Lihat Kursus</a></li>
                                <li><a class="dropdown-item" href="/admin">Manage Web</a></li>
                                @can('super_admin')
                                    <li><a class="dropdown-item" href="/admin/dashboard">Manage Super Admin</a></li>
                                @endcan
                            @endif
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>

                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-main fw-bold px-3 py-2" href="/register">Sign Up</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
