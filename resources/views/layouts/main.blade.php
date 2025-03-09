<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="/assets/css/main.css">
</head>
<style>
    #main {
        max-width: 2000px;
        margin: 0 auto;
    }

    .container {
        max-width: 1200px !important;
    }
</style>

<body class="bg-black ">

    <div class="elementor-background-overlay">
        @include('layouts.header')
        <main id="main">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>


    <!-- SwiperJS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const swiper = new Swiper('.swiper', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            loop: true, // Muter terus
            slidesPerView: 2, // Pastikan setidaknya 2 slide terlihat
            spaceBetween: -200, // Kurangi jarak antar video agar lebih rapat
            coverflowEffect: {
                rotate: 15, // Miringkan video samping sedikit
                stretch: 0, // Biarkan default, sesuaikan jika perlu
                depth: 250, // Efek kedalaman lebih dalam agar terlihat lebih 3D
                modifier: 1,
                slideShadows: false, // Matikan bayangan agar lebih bersih
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            // autoplay: {
            //     delay: 2500,
            //     disableOnInteraction: false,
            // }
        });
    </script>
</body>

</html>
