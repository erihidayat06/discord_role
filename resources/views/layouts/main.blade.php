<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Belajar 1 Persen</title>

    <!-- Favicons -->
    <link href="{{ asset(profil_web()->logo_title) }}" rel="icon">
    <link href="{{ asset(profil_web()->logo_title) }}" rel="apple-touch-icon">

    {{-- SEO --}}
    <title>Belajar Satu Persen - Platform Belajar Online</title>
    <meta name="description"
        content="Belajar Satu Persen adalah platform edukasi yang membantu meningkatkan skill & mindset.">
    <meta name="keywords" content="Belajar Satu Persen, Belajar Online, Pengembangan Diri, Pendidikan">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Belajar Satu Persen">
    <link rel="canonical" href="https://belajarsatupersen.com">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="/assets/css/main.css">

    {{-- Aos --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    {{-- icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Masukkan di <head> -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', {{ pixel()->pixel ?? 0 }}); // Ganti dengan ID Pixel kamu
        fbq('track', 'PageView'); // Melacak setiap halaman yang dikunjungi
    </script>
    <noscript>
        <img height="1" width="1"
            src="https://www.facebook.com/tr?id={{ pixel()->pixel ?? 0 }}&ev=PageView&noscript=1" />
    </noscript>

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
    @include('sweetalert::alert')
    <div class="elementor-background-top">
        @include('layouts.header')
        <main id="main">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>


    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <!-- Bootstrap Bundle dengan Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}


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

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>


    <!-- Bootstrap 5 Script -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let modals = document.querySelectorAll('.modal'); // Ambil semua modal
            let background = document.querySelector('.elementor-background-top');

            if (!modals || !background) return;

            modals.forEach(modal => {
                modal.addEventListener('show.bs.modal', function() {
                    background.classList.remove(
                        'elementor-background-top'); // Hapus class saat modal dibuka
                });

                modal.addEventListener('hidden.bs.modal', function() {
                    background.classList.add(
                        'elementor-background-top'); // Tambahkan class saat modal ditutup
                });
            });
        });
    </script>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "Belajar Satu Persen",
            "url": "https://belajarsatupersen.com",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "https://belajarsatupersen.com/search?q={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
</script>





</body>

</html>
