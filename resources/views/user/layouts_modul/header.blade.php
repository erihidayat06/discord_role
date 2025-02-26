<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center bg-dark text-white" data-bs-theme="dark">
    <div class="d-flex align-items-center justify-content-between">
        <a href='{{ isset($prevModul) || isset($nextModul) ? "/kursus/$kelas->slug" : '/kursus' }}'><i
                class="bi bi-arrow-left-circle-fill text-white"></i></a>
        <a href="/kursus" class="logo d-flex align-items-center ms-2 d-none d-lg-flex">
            <img src="/assets/img/logo-main.png" alt="">
        </a>
        <a href="/kursus" class="logo d-flex align-items-center ms-2 d-block d-lg-none">
            <img src="/assets/img/logo.png" alt="">
        </a>

        {{-- <i class="bi bi-list toggle-sidebar-btn text-white  d-none d-lg-flex"></i> --}}
    </div><!-- End Logo -->


    <style>
        .modul-navigation {
            top: 0;
            left: 0;
            width: 100%;
        }

        .btn-prev {
            width: 50%;
            background-color: #343a40;
            /* Warna tombol kembali */
            color: white;
            border-radius: 0;
            padding: 15px 0px;
            text-align: center;
        }

        .btn-next {
            width: 50%;
            background-color: #ac43e4;
            /* Warna tombol lanjut */
            color: white;
            border-radius: 0;
            padding: 15px 0px;
            text-align: center;
        }

        .btn-next:hover {
            background-color: #be79e4 !important;
        }

        .btn-prev:hover {
            background-color: #495057 !important;
        }

        .btn-prev:disabled,
        .btn-next:disabled {
            background-color: #6c757d;
            /* Warna tombol disabled */
        }

        /* Supaya konten tidak tertutup header */
        .content {
            padding-top: 60px;
        }
    </style>

    @if (isset($prevModul) || isset($nextModul))
        <div class="modul-navigation ms-2 d-flex justify-content-center">
            <!-- Tombol Kembali -->
            @if (!empty($prevModul))
                <a href="{{ route('modul.view', ['slug' => $kelas->slug, 'slug_modul' => $prevModul->slug]) }}"
                    class="btn btn-prev fw-bold">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            @endif

            <!-- Tombol Selesai & Lanjut -->
            @if (!empty($nextModul))
                <a href="{{ route('modul.view', ['slug' => $kelas->slug, 'slug_modul' => $nextModul->slug, 'slugSaatIni' => $showModul->slug]) }}"
                    class="btn btn-next d-flex justify-content-center fw-bold">
                    <span class="d-none d-lg-block">Complete &</span> Next <i class="bi bi-arrow-right"></i>
                </a>
            @else
                <a href="{{ route('modul.view', ['slug' => $kelas->slug, 'slug_modul' => $showModul->slug, 'slugSaatIni' => $showModul->slug]) }}"
                    class="btn btn-next">
                    Finished
                </a>
            @endif
        </div>
    @endif



    <i class="bi bi-list toggle-sidebar-btn text-white d-lg-none" style="right: 5px"></i>




    @if (!isset($prevModul) && !isset($nextModul))
        <nav class="header-nav ms-auto ">

            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3 text-white">

                    <a class="nav-link nav-profile d-flex align-items-center text-white pe-0" href="#"
                        data-bs-toggle="dropdown">

                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                    </a><!-- End Profile Image Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header text-white">
                            <h6 class="text-white">{{ auth()->user()->name }}</h6>

                        </li>


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
    @endif


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
