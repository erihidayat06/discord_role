<nav class="navbar navbar-expand-lg">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="/">
            <img src="/assets/img/logo-main.png" alt="Logo" style="width: 120px;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
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
                            @if (auth()->user()->is_admin)
                                <li><a class="dropdown-item" href="/kursus">Lihat Kursus</a></li>
                                <li><a class="dropdown-item" href="/discord/data-role/view">Manage Roles</a></li>
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
