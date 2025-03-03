<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center bg-dark text-white" data-bs-theme="dark">
    <style>
        .logo {
            width: 50px;
        }

        .lebar {
            width: 600px;
        }

        .search-bar {
            width: 100% !important;
            border-radius: 20px !important;
        }
    </style>
    <div class="lebar d-flex align-items-center">
        <a href="/kursus" class="logo ">
            <img src="/assets/img/logo-main.png" alt="">
        </a>

        @if (Request::is('kursus*'))
            {{-- <i class="bi bi-list toggle-sidebar-btn text-white d-none d-md-block"></i> --}}
            <div class="search-bar bg-dark text-white p-0 m-0 ">
                <form class="search-form d-flex align-items-center" method="GET" action="/kursus">
                    <!-- Hidden input untuk kategori dan nama_kategori -->
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    <input type="hidden" name="nama_kategori" value="{{ request('nama_kategori') }}">

                    <!-- Input untuk pencarian -->
                    <input type="text" name="query" class="text-white form-control me-2" placeholder="Search..."
                        title="Enter search keyword" value="{{ request('query') }}">

                    <button type="submit" title="Search" class="btn btn-light">
                        <i class="bi bi-search text-white"></i>
                    </button>
                </form>
            </div>
        @endif
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto ">

        <ul class="d-flex align-items-center">
            <style>
                .nav-link-2.active {
                    /* Warna biru info */
                    color: #5abdcc !important;

                    /* Memberikan sedikit ruang pada teks */
                    font-weight: bold;
                }
            </style>
            @if (Request::is('kursus*'))
                <li class="nav-item d-block d-lg-none text-white">
                    <a class="nav-link-2 nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search text-white"></i>
                    </a>
                </li><!-- End Search Icon-->
            @endif

            <li class="nav-item d-none d-lg-block">
                <a class="nav-link-2 text-white {{ Request::is('kursus*') ? 'active' : '' }}"
                    href="{{ url('/kursus') }}">
                    Academy
                </a>
            </li>
            <li class="nav-item ms-4 d-none d-lg-block">
                <a class="nav-link-2 text-white {{ Request::is('research*') ? 'active' : '' }}"
                    href="{{ url('/research') }}">
                    Research
                </a>
            </li>

            <li>
                <a class="d-block d-lg-none ms-4" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i
                        class="bi bi-justify fs-3 text-white"></i></a>

                <div class="offcanvas offcanvas-end w-100 bg-dark text-white border-0" tabindex="-1"
                    id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header border-0">
                        <a href="/kursus" class="logo ">
                            <img src="/assets/img/logo-main.png" alt="">
                        </a>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>


                    <div class="offcanvas-body p-0">
                        <div class="accordion w-100" id="accordionMenu">

                            <div class="accordion-item bg-dark border-0">
                                <a class="d-block p-2 ms-2 fw-bold {{ Request::is('kursus*') ? 'active text-info' : 'text-white' }}"
                                    href="{{ url('/kursus') }}">
                                    Academy
                                </a>
                            </div>
                            <div class="accordion-item bg-dark border-0">
                                <a class="d-block p-2 ms-2 fw-bold {{ Request::is('research*') ? 'active text-info' : 'text-white' }}"
                                    href="{{ url('/research') }}">
                                    Research
                                </a>
                            </div>
                            @if (auth()->user()->discord_active == 0)
                                <div class="accordion-item bg-dark border-0">
                                    <a class="d-block text-white p-2 ms-2 fw-bold" href="/login/discord">Login
                                        discord</a>
                                </div>
                            @else
                                <div class="accordion-item bg-dark border-0">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button
                                            class="accordion-button bg-dark text-white w-100 border-0 shadow-none pb-1 fw-bold"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            <span class="fw-bold">{{ auth()->user()->discord_name }}</span>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionMenu">
                                        <div class="accordion-body  text-white border-0 p-1 bg-dark-main">

                                            <form action="/logout/discord" method="POST">
                                                @csrf

                                                <button type="submit"
                                                    class="dropdown-item d-flex align-items-center p-2 ms-3 text-danger"
                                                    href="#">
                                                    <i class="bi bi-box-arrow-right"></i>
                                                    <span>Logout Discord</span>
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="accordion-item bg-dark border-0">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button bg-dark text-white w-100 border-0 shadow-none pb-1 "
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        <span class="fw-bold">{{ auth()->user()->name }}</span>
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionMenu">
                                    <div class="accordion-body  text-white border-0 p-0 bg-dark-main">

                                        <form action="/logout" method="POST">
                                            @csrf

                                            <button type="submit"
                                                class="dropdown-item d-flex align-items-center p-2  ms-3 text-danger"
                                                href="#">
                                                <i class="bi bi-box-arrow-right"></i>
                                                <span>Logout</span>
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>





            @if (auth()->user()->discord_active == 0)
                <li><a href="/login/discord" class="text-white d-none d-md-block ms-4">Login discord</a></li>
            @else
                <li class="nav-item dropdown pe-3 text-white">

                    <a class="d-none d-md-block nav-link nav-profile d-flex align-items-center text-white pe-0 ms-2"
                        href="#" data-bs-toggle="dropdown">

                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->discord_name }}</span>
                    </a><!-- End Profile Image Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header ">
                            <h6 class="text-white">{{ auth()->user()->discord_name }}</h6>

                        </li>


                        <li>

                            <form action="/logout/discord" method="POST">
                                @csrf

                                <button type="submit" class="dropdown-item d-flex align-items-center"
                                    href="#">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Logout Discord</span>
                                </button>
                            </form>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->
            @endif


            <li class="nav-item dropdown pe-3 text-white">

                <a class="nav-link nav-profile d-flex align-items-center text-white pe-0 ms-4 d-none d-lg-block"
                    href="#" data-bs-toggle="dropdown">

                    <span class=" dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                </a><!-- End Profile Image Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header ">
                        <h6 class="text-white">{{ auth()->user()->name }}</h6>

                    </li>

                    @if (auth()->user()->is_admin)
                        <li><a class="dropdown-item" href="/discord/data-role/view">Manage Roles</a></li>
                    @endif

                    <li>

                        <form action="/logout" method="POST">
                            @csrf

                            <button type="submit" class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->



        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#select-guild').change(function() {
            var selectedGuild = $(this).val();

            // Tampilkan loading spinner
            $('#loading-overlay').removeClass('d-none');

            $.ajax({
                url: '/update-guild/ubah',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Laravel CSRF Protection
                    id_guild: selectedGuild
                },
                success: function(response) {
                    console.log(response.message);
                    location.reload(); // Refresh halaman setelah sukses
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
