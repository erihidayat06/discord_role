<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center bg-dark text-white" data-bs-theme="dark">
    <div class="d-flex align-items-center justify-content-between">
        <a href="/kursus" class="logo d-flex align-items-center">
            <img src="/assets/img/logo-main.png" alt="">
        </a>
        <i class="bi bi-list toggle-sidebar-btn text-white"></i>
    </div><!-- End Logo -->
    <div class="search-bar bg-dark text-white">
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



    <nav class="header-nav ms-auto ">
        <ul class="d-flex align-items-center">


            <li class="nav-item d-block d-lg-none text-white">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search text-white"></i>
                </a>
            </li><!-- End Search Icon-->


            @if (auth()->user()->discord_active == 0)
                <li><a href="/login/discord" class="text-white">Login discord</a></li>
            @else
                <li class="nav-item dropdown pe-3 text-white">

                    <a class="nav-link nav-profile d-flex align-items-center text-white pe-0 ms-2" href="#"
                        data-bs-toggle="dropdown">

                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->discord_name }}</span>
                    </a><!-- End Profile Image Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header ">
                            <h6 class="text-white">{{ auth()->user()->discord_name }}</h6>

                        </li>


                        <li>

                            <form action="/logout/discord" method="POST">
                                @csrf

                                <button type="submit" class="dropdown-item d-flex align-items-center" href="#">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Logout Discord</span>
                                </button>
                            </form>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->
            @endif


            <li class="nav-item dropdown pe-3 text-white">

                <a class="nav-link nav-profile d-flex align-items-center text-white pe-0 ms-2" href="#"
                    data-bs-toggle="dropdown">

                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
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
