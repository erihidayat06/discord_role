<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Belajar satu persen</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="/assets/img/logo.png" rel="icon">
    <link href="/assets/img/logo.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets2/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets2/vendor/aos/aos.css" rel="stylesheet">
    <link href="/assets2/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/assets2/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="/assets2/css/main.css" rel="stylesheet">
    <link href="/assets2/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Arsha
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    <style>
        .bg-color {
            background-image: radial-gradient(circle at 50% -10%,
                    #8c4397 0%,
                    #66327b 10%,
                    #40205b 30%,
                    #000000 60%,
                    #000000 85%,
                    #000000 100%);
        }

        .custom-shadow {
            box-shadow: 5px 10px 15px #9a25e36c !important;
            /* Warna ungu dengan transparansi */
        }

        .bg-main {
            background-color: #000008;
        }

        .bg-transparan {
            background-color: #ffffff00 !important;
        }

        body {
            background-image: radial-gradient(circle at 43.84% -20.44%,
                    #8c4397 0,
                    #66327b 16.67%,
                    #40205b 33.33%,
                    #1b0c38 50%,
                    #000018 66.67%,
                    #000000 83.33%,
                    #000000 100%);
        }

        .module-border-wrap {
            border-width: 3px;
            border-style: solid;
            border-image: linear-gradient(to bottom right,
                    var(--accent-color) 0%,
                    var(--accent-color) 30%,
                    rgba(0, 0, 0, 0) 50%,
                    var(--accent-color) 100%) 1;
        }

        .img-bg {
            width: 100%;
            margin: auto;
        }
    </style>
</head>

<body class="index-page">
    @include('sweetalert::alert')
    @include('layouts.header')
    <main class="main">
        @yield('content')
    </main>
    @include('layouts.footer')

</body>

</html>
