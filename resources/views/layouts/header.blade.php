<header id="header" class="header d-flex align-items-center fixed-top">
    <style>
        @keyframes glitch {

            0%,
            66% {
                transform: translate(0, 0);
                clip-path: none;
                filter: none;
            }

            67% {
                clip-path: inset(2% 0 3% 0);
                transform: translate(-2px, -1px);
                filter: hue-rotate(5deg);
            }

            72% {
                clip-path: inset(5% 0 2% 0);
                transform: translate(2px, 1px);
                filter: hue-rotate(-5deg);
            }

            78% {
                clip-path: inset(1% 0 4% 0);
                transform: translate(-3px, 0);
            }

            85% {
                clip-path: inset(3% 0 1% 0);
                transform: translate(3px, 0);
            }

            100% {
                transform: translate(0, 0);
                clip-path: none;
                filter: none;
            }
        }

        @keyframes glitch-rgb {

            0%,
            66%,
            100% {
                opacity: 0;
                transform: translate(0, 0);
            }

            67% {
                opacity: 0.5;
                transform: translate(2px, 0);
            }

            72% {
                opacity: 0.5;
                transform: translate(-2px, 0);
            }

            78% {
                opacity: 0.4;
                transform: translate(1px, 0);
            }

            85% {
                opacity: 0.4;
                transform: translate(-1px, 0);
            }
        }

        .logo {
            position: relative;
            display: inline-block;
            overflow: hidden;
        }

        .logo img {
            display: block;
            position: relative;
            animation: glitch 6s infinite steps(1, jump-end);
        }

        .logo::before,
        .logo::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("/assets/img/logo-main.png") no-repeat center;
            background-size: contain;
            opacity: 0;
            mix-blend-mode: screen;
            z-index: -1;
            animation: glitch-rgb 6s infinite steps(1, jump-end);
        }

        .logo::before {
            filter: hue-rotate(240deg);
        }

        .logo::after {
            filter: hue-rotate(120deg);
        }
    </style>
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.html" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <img src="/assets/img/logo-main.png" alt="" width="100%">
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero" class="active">Home</a></li>
                {{-- <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#team">Team</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li class="dropdown"><a href="#"><span>Dropdown</span> <i
                            class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">Dropdown 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li><a href="#">Deep Dropdown 1</a></li>
                                <li><a href="#">Deep Dropdown 2</a></li>
                                <li><a href="#">Deep Dropdown 3</a></li>
                                <li><a href="#">Deep Dropdown 4</a></li>
                                <li><a href="#">Deep Dropdown 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Dropdown 2</a></li>
                        <li><a href="#">Dropdown 3</a></li>
                        <li><a href="#">Dropdown 4</a></li>
                    </ul>
                </li> --}}
                <li><a href="#contact">Contact</a></li>

                @if (auth()->check())
                    <li class="dropdown "><a href="#"> <img
                                src="{{ auth()->user()->avatar ?? 'https://cdn.discordapp.com/embed/avatars/0.png' }}"
                                alt="Avatar" class="rounded-circle me-2" width="30" height="30">
                            <span>{{ auth()->user()->name ?? auth()->user()->discord_name }}</span>
                            <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            @if (auth()->user()->is_admin)
                                <li><a class="dropdown-item" href="/kursus">Lihat Kursus</a></li>
                                <li><a class="dropdown-item" href="/discord/data-role/view">Manage Roles</a></li>
                            @endif
                            <li>
                                <a href="#">
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </a>
                            </li>

                        </ul>
                    </li>
                @else
                    <li>
                        <a class=" p-2 ms-2" href="/login">Login</a>
                    </li>

                    <li>
                        <a class="btn-getstarted p-2 ms-2 btn btn-secondary" href="/register">
                            @if (auth()->check() && auth()->user()->expired)
                                Sign Up
                            @else
                                1 day trial
                            @endif
                        </a>

                    </li>

                @endif
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>




    </div>
</header>
