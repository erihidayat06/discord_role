@extends('layouts.main')
@section('content')
    <style>
        .bg-primary {
            color: white;
            background: linear-gradient(to top, #4e0d94, #6a11cb, #ac43e4) !important;
        }

        .bg-primary:hover {
            color: white !important;
        }
    </style>
    <!-- Hero Section -->
    <section id="hero" class="hero section bg-color">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-12 text-center order-2 order-lg-1 d-flex flex-column justify-content-center "
                    data-aos="zoom-out">
                    <h1 class="text-white">Modul Belajar Investasi & Trading Crypto Terlengkap</h1>
                    <p class="text-white">Ada Lebih Ratusan Member Telah Bergabung Disini!! Sekarang Kaliann Join Bersama
                        Pelajar Lainnya </p>
                    <div class="text-center">
                        <a href="/login/discord" class="btn-get-started"><i class="bi bi-chevron-double-right"></i> Gabung
                            discord <i class="bi bi-chevron-double-left"></i></a>
                        {{-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                            class="glightbox btn-watch-video d-flex align-items-center text-white"><i
                                class="bi bi-play-circle"></i><span>Watch Video</span></a> --}}
                    </div>
                </div>
                {{-- <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="/assets/img/logo-main.png" class="img-fluid animated" alt="">
                </div> --}}
            </div>
        </div>

    </section><!-- /Hero Section -->


    <section class="section bg-main">
        <div class="container col-lg-4">
            <a href=""></a>
            <div class="card">
                <img src="https://s3.ap-southeast-1.amazonaws.com/assets.lynk.id/products/15-02-2025/1739566164551_9962437"
                    class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Kelas Bulanan Akademi Crypto 1 Bulan</h5>
                    <p class="card-text fw-bold">IDR 147,000</p>
                    <p class="card-text text-decoration-line-through text-dark-emphasis fw-bold">IDR 2,000,000</p>
                    <a href="{{ auth()->check() ? 'https://belajarsatupersen.xyz/belajarsatupersen.id/LPn99wE' : '/register' }}"
                        {{ auth()->check() ? 'target="_blank"' : '' }} class="btn bg-primary bg-gradient col-lg-12 fw-bold">
                        Dapatkan akses sekarang
                    </a>

                </div>
            </div>
        </div>
    </section>

    <section class="section bg-main">
        <div class="container">
            <div class="card col-lg-5 mx-auto shadow custom-shadow module-border-wrap">
                <a href="https://api.whatsapp.com/send/?phone=%2B6285179663069&text=Halo+Kelas+Bulanan+Akademi+Crypto+Masih+Ada%3F&type=phone_number&app_absent=0"
                    class="d-flex justify-content-center">
                    <div class="card-body text-center">
                        <div class="row align-items-center">
                            <div class="col-1">
                                <i class="bi bi-whatsapp fs-1 ms-4 text-success"></i>
                            </div>
                            <div class="col-10">
                                <h3 class="text-dark"> WhatsApp</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-5 mt-5 mx-auto">
            <p class="   fw-bold text-center">71% Murid Akademi Crypto berhasil melipatgandakan portofolionya
                dalam waktu
                3 bulan
                menggunakan strategi kita.
            </p>
        </div>
    </section>




    <section class=" bg-main text-center">
        <div class="col-lg-5 container mx-auto">
            <img class="img-bg module-border-wrap"
                src="https://s3.ap-southeast-1.amazonaws.com/assets.lynk.id/products/02-03-2025/1740850002427_7540093"
                alt="">
        </div>
    </section>

    <section class=" bg-main text-center">
        <div class="col-lg-5 container mx-auto">
            <img class="img-bg module-border-wrap"
                src="https://s3.ap-southeast-1.amazonaws.com/assets.lynk.id/products/15-02-2025/1739554405994_7888550"
                alt="">
        </div>
    </section>

    <section class=" bg-main text-center">
        <div class="col-lg-5 container mx-auto">
            <img class="img-bg module-border-wrap"
                src="https://s3.ap-southeast-1.amazonaws.com/assets.lynk.id/products/13-02-2025/1739454844767_1913151"
                alt="">
        </div>
    </section>
    <section class=" bg-main">
        <div class="container">
            <div class="card col-lg-5 container mx-auto shadow custom-shadow">
                <a href="https://belajarsatupersen.xyz/belajarsatupersen.id/LPn99wE" class="d-flex justify-content-center">
                    <div class="card-body text-center ">
                        <div class="row align-items-center">

                            <h3 class="text-dark"> Saya Mau Belajar</h3>

                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section class=" bg-main text-center">
        <div class="col-lg-5 container mx-auto">
            <img class="img-bg module-border-wrap"
                src="https://s3.ap-southeast-1.amazonaws.com/assets.lynk.id/products/15-02-2025/1739554469006_2126920"
                alt="">
        </div>
    </section>
    <section class=" bg-main text-center">
        <div class="col-lg-5 container mx-auto">
            <img class="img-bg module-border-wrap"
                src="https://s3.ap-southeast-1.amazonaws.com/assets.lynk.id/products/12-02-2025/1739307282480_5799265"
                alt="">
        </div>
    </section>

    {{-- <div class="tawaran">
            <img class="shadow-left" src="https://akademicrypto.com/wp-content/uploads/2024/04/glow-2-a.svg"
                alt="">
            <div class="card p-0">
                <div class="card-body p-0">
                    <div class="row row-cols-1 row-cols-lg-2 p-3">
                        <div class="col">
                            <p class="text-spacing text-white text-start">
                                Dapatkan Akses 12 bulan Akademi Crypto Hanya
                            </p>
                        </div>
                        <div class="col text-lg-end text-start">
                            <!-- Gambar hanya muncul di desktop (≥992px) -->
                            <img src="/assets/img/logo-main.png" class="d-none d-lg-inline-block" alt="Logo"
                                width="100px">

                            <p class="text-spacing text-white mt-2 mt-lg-4">
                                PEMBAYARAN UNTUK 12 BULAN
                            </p>

                        </div>
                    </div>



                    <p class="text-danger text-decoration-line-through fw-bold px-3">RP2.000.000</p>

                    <p class="fs-bold fs-1 fw-bold text-white px-3">RP147.000</p>

                    <div class="title-line fs-6 m-0">
                        <img src="https://akademicrypto.com/wp-content/uploads/2024/04/Star-2.svg" alt=""
                            width="15"> &nbsp;BENEFIT
                    </div>

                    <table class="table-dot" class="text-white">
                        <tr>
                            <td style="width: 90%">
                                <p class="ps-3">Strategi investasi yang telah terbukti memberikan return
                                    signifikan
                                    pada
                                    portofolio member dalam 3
                                    bulan</p>
                            </td>
                            <td class="text-end pe-3"><img
                                    src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg" width="20px"
                                    alt=""></td>
                        </tr>
                        <tr>
                            <td style="width: 90%">
                                <p class="ps-3">
                                    Coin Picks AC Research yang sudah terbukti outperform market
                                </p>
                            </td>
                            <td class="text-end pe-3"><img
                                    src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg" width="20px"
                                    alt=""></td>
                        </tr>

                        <tr>
                            <td style="width: 90%">
                                <p class="ps-3">Rahasia trading dan investasi yang sudah di buktikan oleh ribuan
                                    member
                                </p>
                            </td>
                            <td class="text-end pe-3"><img
                                    src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg" width="20px"
                                    alt=""></td>
                        </tr>
                        <tr>
                            <td style="width: 90%">
                                <p class="ps-3">Ribuan Modul E-Learning yang bisa di akses 24 jam
                                    seputar crypto</p>
                            </td>
                            <td class="text-end pe-3"><img
                                    src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg" width="20px"
                                    alt=""></td>
                        </tr>
                        <tr>
                            <td style="width: 90%">
                                <p class="ps-3">
                                    Akses ke data mahal seperti bloomberg, glassnode, cryptoquant, LSEG senilai 600jt
                                    per
                                    tahun
                                </p>
                            </td>
                            <td class="text-end pe-3"><img
                                    src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg" width="20px"
                                    alt=""></td>
                        </tr>
                        <tr>
                            <td style="width: 90%">
                                <p class="ps-3">
                                    Riset ekslusif coin yang naik ratusan persen setiap bulannya
                                </p>
                            </td>
                            <td class="text-end pe-3"><img
                                    src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg" width="20px"
                                    alt=""></td>
                        </tr>
                        <tr>
                            <td style="width: 90%">
                                <p class="ps-3">
                                    Webinar ekslusif untuk mengetahui outlook dunia crypto
                                </p>
                            </td>
                            <td class="text-end pe-3"><img
                                    src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg" width="20px"
                                    alt=""></td>
                        </tr>

                        <tr>
                            <td style="width: 90%">
                                <p class="ps-3">
                                    Private mentoring ke kantor untuk para contrarian
                                </p>
                            </td>
                            <td class="text-end pe-3"><img
                                    src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg" width="20px"
                                    alt=""></td>
                        </tr>
                        <tr>
                            <td style="width: 90% ">
                                <p class="ps-3">
                                    Aplikasi Ekslusif member untuk mendapatkan kemudahan akses berita, riset, dan juga
                                    modul
                                </p>
                            </td>
                            <td class="text-end pe-3"><img
                                    src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg" width="20px"
                                    alt=""></td>
                        </tr>


                        <img class="shadow-left" src="https://akademicrypto.com/wp-content/uploads/2024/04/glow-2-a.svg"
                            alt="">
                    </table>
                 <img class="shadow-right" src="https://akademicrypto.com/wp-content/uploads/2024/04/glow-2-a.svg"
                        alt="">
                    <div class="p-3">
                        <a href="{{ auth()->check() ? 'https://belajarsatupersen.xyz/belajarsatupersen.id/LPn99wE' : '/register' }}"
                            {{ auth()->check() ? 'target="_blank"' : '' }} class="btn-custom">
                            Dapatkan akses sekarang
                        </a>
                   <a href="#" class="btn-custom ">Dapatkan Akses Sekarang</a>
                    </div>

                </div>
            </div>
        </div>  </div> --}}
    {{-- <!-- Contact Section -->
    <section id="contact" class="contact section bg-main">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Contact</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-12">

                    <div class="info-wrap">
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h3>Address</h3>
                                <p>A108 Adam Street, New York, NY 535022</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>Call Us</h3>
                                <p>+1 5589 55488 55</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>Email Us</h3>
                                <p>info@example.com</p>
                            </div>
                        </div><!-- End Info Item -->

                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus"
                            frameborder="0" style="border:0; width: 100%; height: 270px;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div> --}}

    {{-- <div class="col-lg-7">
                    <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <label for="name-field" class="pb-2">Your Name</label>
                                <input type="text" name="name" id="name-field" class="form-control" required="">
                            </div>

                            <div class="col-md-6">
                                <label for="email-field" class="pb-2">Your Email</label>
                                <input type="email" class="form-control" name="email" id="email-field" required="">
                            </div>

                            <div class="col-md-12">
                                <label for="subject-field" class="pb-2">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject-field" required="">
                            </div>

                            <div class="col-md-12">
                                <label for="message-field" class="pb-2">Message</label>
                                <textarea class="form-control" name="message" rows="10" id="message-field" required=""></textarea>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>

                                <button type="submit">Send Message</button>
                            </div>

                        </div>
                    </form>
                </div><!-- End Contact Form --> --}}
    {{--
            </div>

        </div>

    </section><!-- /Contact Section --> --}}
@endsection
