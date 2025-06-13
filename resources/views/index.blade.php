@extends('layouts.main')

@section('content')
    <style>
        .mt-6 {
            margin-top: 100px !important;
        }

        @media (max-width: 768px) {
            .mt-6 {
                margin-top: 30px !important;
            }
        }
    </style>
    <!-- Tombol WhatsApp Fixed -->
    <a href="https://api.whatsapp.com/send/?phone=%2B6285179663069&text=Halo+kak+Produk+Masih+ada%3F+https%3A%2F%2Flynk.id%2Fbelajarsatupersen.id&type=phone_number&app_absent=0"
        target="_blank" class="btn btn-success btn-lg rounded-circle shadow"
        style="position: fixed; bottom: 20px; right: 20px; z-index: 1050;">
        <i class="fab fa-whatsapp" style="font-size: 24px;"></i>
    </a>
    <div class="container mt-6">
        <div class="text-center">
            <h1 class="text-white fw-bold text-title">Strategi Investasi Crypto Untuk</h1>
            <h1 class="text-title text-grad fw-bold">Gandain Uang Kalian</h1>
            <div class="container text-center mx-auto" style="max-width: 658px">
                <!-- Untuk layar besar -->
                <p class="text-white fs-3 fw-medium d-none d-lg-block">
                    71% Murid di Akademi berhasil melipatgandakan portofolionya <br>
                    dalam waktu <span class="text-decoration-underline fw-bold">3 bulan</span> menggunakan strategi kita.
                </p>

                <!-- Untuk layar kecil -->
                <p class="text-white fs-3 fw-medium d-lg-none">
                    71% Murid di Akademi berhasil <br>
                    melipatgandakan portofolionya dalam <br>
                    <span class="text-decoration-underline fw-bold">waktu 3 bulan</span> menggunakan strategi kita.
                </p>
            </div>

        </div>
    </div>

    <div class="container d-flex justify-content-center mt-5 w-100">
        <div class="video-container">

            <iframe class="m-0 p-0"
                src="https://iframe.mediadelivery.net/embed/453816/ec39cde0-ac6e-4abd-9c0b-99e3938f8393?autoplay=0&watermark={{ urlencode(env('BUNNY_STREAM_WATERMARK_URL')) }}"
                width="100%" height="500" allow="fullscreen" frameborder="0" allowfullscreen disablePictureInPicture
                referrerpolicy="no-referrer">
            </iframe>

            {{-- <iframe width="100%" height="100%" src="https://www.youtube.com/embed/mkLVWTv7zNM?si=eZiCoX8Fn_37KbJR"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
            </iframe> --}}
        </div>
    </div>

    <div class="text-center mt-5 mb-5">
        <p class="fs-5 text-white fw-bold text-grad text-spacing lh-1">Harga Mulai</p>
        <p class="lh-1"><span class=" text-danger fs-6  text-decoration-line-through ">Rp2.000.000</span> <span
                class="fs-1 text-white fw-bold">Rp135.000</span></p>

        <a href="#tawaran"> <img class="join-now" src="https://akademicrypto.com/wp-content/uploads/2024/04/button-join.svg"
                class="img-fluid" style="max-width: 50%;" alt=""></a>
    </div>


    <h2 class="title-line" data-aos="fade-up">Apa Kata Mereka</h2>



    <div class=" mt-5 mb-5" data-aos="fade-up">
        <div class="swiper w-100">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-wrapper">
                <div class="swiper-slide"><iframe width="560" height="315"
                        src="https://www.youtube.com/embed/Xsy6YLUQojw?si=1E82vpjb6Hb8UMSE" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div>
                <div class="swiper-slide"><iframe width="560" height="315"
                        src="https://www.youtube.com/embed/eA--N6bT1KI?si=qXnnM3wbWd2BL1qz" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div>
                <div class="swiper-slide"><iframe width="560" height="315"
                        src="https://www.youtube.com/embed/mCKuO1oIutg?si=I84J83uqsRgZ3sB4" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div>
                <div class="swiper-slide"><iframe width="560" height="315"
                        src="https://www.youtube.com/embed/Dc9oCwssAAk?si=U_YyGd4KkhAqhv3o" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div>
                <div class="swiper-slide"><iframe width="560" height="315"
                        src="https://www.youtube.com/embed/QgUyEdYWRas?si=sai1igD6eAYzHJfn" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div>
                <div class="swiper-slide"><iframe width="560" height="315"
                        src="https://www.youtube.com/embed/8RLgcEowJi4?si=rWRurxvbroQhEUDH" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div>
                <div class="swiper-slide"><iframe width="560" height="315"
                        src="https://www.youtube.com/embed/FLvauie6eDk?si=5m-tz2YD7az5Ws16" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div>
                <div class="swiper-slide"><iframe width="560" height="315"
                        src="https://www.youtube.com/embed/0GSK7cEmVUc?si=JW1XTp2b3QC3H3qF" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div>

                <div class="swiper-slide"><iframe width="560" height="315"
                        src="https://www.youtube.com/embed/Oex3FempwxA?si=J85sKP9qhfPDNH1E" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="text-center mt-5">
            <a href="https://discord.gg/belajarsatupersen"> <img class="join-now"
                    src="https://akademicrypto.com/wp-content/uploads/2024/04/btn-join-discord.webp" class="img-fluid"
                    style="max-width: 350px;" alt=""></a>
        </div>
    </div>

    <style>
        @media (min-width: 992px) {

            /* Bootstrap breakpoint untuk lg */
            .w-lg-40 {
                width: 35% !important;
            }
        }
    </style>



    <div class="gradient-line mt-5 mb-5"></div>

    <div class="text-center">
        <h1 class="fs-1 text-white fw-semibold">Kenapa Akademi Crypto?</h1>
    </div>

    <div class="container kenapa">
        <div class="row row-cols-1 row-cols-lg-2 mt-2 mt-lg-5  position-relative">
            <div class="col border-end border-white">
                <h3 class="pe-3 ps-5" data-aos="fade-up">
                    <span class="text-grad fw-bold">
                        Mulai dari nol hingga mahir dalam berinvestasi di crypto bersama <strong>Belajar Satu
                            Persen</strong>,
                        serta kembangkan portofolio kalian secara maksimal.
                    </span>
                    <span class="text-white">
                        Dapatkan akses ke 1000+ modul pembelajaran yang diperbarui setiap minggu dan dipandu langsung oleh
                        para ahli.
                    </span>
                </h3>


            </div>
            <img class="peringkat-1" src="https://akademicrypto.com/wp-content/uploads/2024/04/no-1.svg" alt="">
            <div class="vertical-line"></div>
            <div class="col py-3 py-lg-0">
                <img class="px-5" data-aos="fade-up"
                    src="https://akademicrypto.com/wp-content/uploads/2025/02/Frame-654037542@2x-1536x805.webp"
                    width="100%" alt="">
            </div>
        </div>
        <div class="row row-cols-1 row-cols-lg-2 mt-2 mt-lg-5 position-relative">
            <!-- Kolom teks -->
            <div class="col border-end border-white py-3 py-lg-5 order-2 order-lg-1">
                <img class="pt-3 px-5" data-aos="fade-up"
                    src="https://akademicrypto.com/wp-content/uploads/2025/02/Frame-654037579-1536x904.webp"
                    width="100%" alt="">
            </div>

            <img class="peringkat" src="https://akademicrypto.com/wp-content/uploads/2024/04/02-a.svg" alt="">

            <!-- Kolom gambar -->
            <div class="col py-1 py-lg-5 order-1 order-lg-2">
                <h3 class="ps-5" data-aos="fade-up">
                    <span class="text-grad fw-bold">
                        Dengan akses ke AC Research melalui <strong>{{ profil_web()->nama_website }}</strong>, kalian bisa
                        mendapatkan
                        coin picks setiap bulan dan analisis on-chain yang mendalam setiap hari.
                    </span>
                    <span class="text-white">
                        Selain itu, kalian juga akan mendapatkan berita market A1 yang eksklusif dan tidak bisa ditemukan di
                        tempat lain.
                    </span>
                </h3>

            </div>
        </div>

        <div class="row row-cols-1 row-cols-lg-2 mt-2 mt-lg-5 position-relative">
            <div class="col ">
                <h3 class="pe-5 ps-5" data-aos="fade-up">
                    <span class="text-grad fw-bold">
                        Kalian akan belajar dan berkembang bersama <strong>{{ profil_web()->nama_website }}</strong> melalui
                        event
                        eksklusif
                        dengan komunitas yang memiliki tujuan yang sama—membangun kekayaan dari crypto.
                    </span>
                    <span class="text-white">
                        Kesuksesan tidak bisa dicapai sendirian—kalian butuh komunitas offline yang saling mendukung dan
                        maju bersama.
                    </span>
                </h3>


            </div>
            <img class="peringkat" src="https://akademicrypto.com/wp-content/uploads/2024/04/03-a.svg" alt="">
            <div class="col py-3 py-lg-5">
                <img class="px-5 img-p3" data-aos="fade-up"
                    src="https://akademicrypto.com/wp-content/uploads/2025/02/community-1536x1074.webp" width="100%"
                    alt="">
            </div>
        </div>
    </div>


    <div class="gradient-line mt-5 mb-5"></div>

    <div class="text-center">
        <h5 class="text-grad fw-bold fs-5 text-spacing" data-aos="fade-up">KURIKULUM PROGRAM</h5>

        <span class="fw-bold fs-3 text-secondary" data-aos="fade-up">01.</span><span
            class="text-title fw-bold text-white sub-title" data-aos="fade-up">Edukasi</span>
    </div>

    <div class="parent-container">
        <div class="container mt-5">

            <img class="shadow-right" data-aos="fade-up"
                src="https://akademicrypto.com/wp-content/uploads/2024/04/glow-2-a.svg" alt="">

            <div class="row row-cols-1 row-cols-lg-2 position-relative ">
                <div class="col border-right-dotted px-5  pb-6">
                    <img src="https://akademicrypto.com/wp-content/uploads/2025/02/Frame-654037543-1536x840.webp"
                        data-aos="fade-up" alt="" width="100%">
                </div>
                <img class="check-1" width="20px" src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg"
                    alt="">
                <div class="col ps-5 text-white">
                    <h1 class="fw-semibold text-white" data-aos="fade-up">Crypto <span class="text-grad">Investing</span>
                    </h1>
                    <p class="mt-3" data-aos="fade-up">
                        Di modul ini, kalian akan belajar langsung bersama
                        <strong>{{ profil_web()->nama_website }}</strong>, dipandu
                        step by step dari
                        mindset berinvestasi di crypto, memahami siklus pasar untuk mengetahui kapan masuk dan keluar,
                        menganalisis berbagai jenis cryptocurrency, memahami attention economy dalam crypto, hingga cara
                        meriset dan menghitung harga wajarnya.
                    </p>

                    <p class="mt-3" data-aos="fade-up">
                        Kalian juga akan belajar bagaimana mengelola risiko dalam portofolio, memahami korelasi antara
                        Bitcoin dan Altcoin,
                        serta cara mengamati pergerakan “smart money.” Bahkan, gua bakal kasih contekan portofolio gua,
                        supaya kalian bisa punya gambaran dalam menyusun portofolio yang solid.
                    </p>


                </div>
            </div>
            <div class="vertical-line-dotted"></div>
            <img class="shadow-left" src="https://akademicrypto.com/wp-content/uploads/2024/04/glow-2-a.svg"
                alt="">
            <div class="row row-cols-1 row-cols-lg-2 position-relative ">

                <div class="col border-right-dotted px-5 pb-6">
                    <img src="https://akademicrypto.com/wp-content/uploads/2025/02/Frame-654037544-1536x840.webp"
                        data-aos="fade-up" alt="" width="100%">
                </div>
                <img class="check-1" width="20px" src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg"
                    alt="">
                <div class="col ps-5 text-white">
                    <h1 class="fw-semibold text-white" data-aos="fade-up">Crypto <span class="text-grad">Trading</span>
                    </h1>
                    <p class="mt-3" data-aos="fade-up">
                        Di modul ini, kalian akan belajar dari nol hingga mahir dalam trading crypto bersama
                        <strong>{{ profil_web()->nama_website }}</strong>. Materinya mencakup pengenalan trading crypto, Dow
                        Theory,
                        dasar analisis teknikal, cara mengukur setup sebuah trade, dasar kontrak futures, manajemen risiko,
                        strategi masuk posisi dan mengukur risikonya, memahami perilaku market, pattern recognition,
                        psikologi dalam trading,
                        hingga live trading bareng bersama komunitas.
                    </p>



                </div>
            </div>
            <div class="row row-cols-1 row-cols-lg-2 position-relative ">

                <div class="col border-right-dotted px-5 pb-6">
                    <img src="https://akademicrypto.com/wp-content/uploads/2025/02/Frame-654037544-1-1536x840.webp"
                        data-aos="fade-up" alt="" width="100%">
                </div>
                <img class="check-1" width="20px" src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg"
                    alt="">
                <div class="col ps-5 text-white">
                    <h1 class="fw-semibold text-white" data-aos="fade-up">Crypto <span class="text-grad">Trading <br>
                            Psychology</span></h1>
                    <p class="mt-3" data-aos="fade-up">
                        Di modul ini, kalian akan belajar bersama <strong>{{ profil_web()->nama_website }}</strong> tentang
                        strategi
                        rahasia
                        dalam mengatur psikologi dan emosi saat trading. Kalian akan memahami mekanisme dalam otak yang
                        menyebabkan bias,
                        pola perilaku para trader dan investor, overconfidence bias, herding behaviour bias, serta alasan di
                        balik
                        loss aversion bias. Dengan pemahaman ini, kalian bisa menjadi trader crypto yang lebih konsisten,
                        serta menguasai manajemen emosi dan risiko dalam setiap transaksi trading.
                    </p>

                </div>
            </div>
            <div class="row row-cols-1 row-cols-lg-2 position-relative ">

                <div class="col border-right-dotted px-5 pb-6">
                    <img src="https://akademicrypto.com/wp-content/uploads/2025/02/Frame-654037545-1-1536x840.webp"
                        data-aos="fade-up" alt="" width="100%">
                </div>
                <img class="check-1" width="20px" src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg"
                    alt="">
                <div class="col ps-5 text-white">
                    <h1 class="fw-semibold text-white" data-aos="fade-up">Crypto <span class="text-grad">Research</span>
                    </h1>
                    <p class="mt-3" data-aos="fade-up">
                        Di modul ini, kalian akan belajar bersama <strong>{{ profil_web()->nama_website }}</strong>
                        bagaimana cara
                        menemukan
                        project crypto atau altcoin yang berpotensi naik hingga 10x menggunakan strategi screening altcoin
                        proprietary Akademi Crypto. Metode ini mencakup narrative research, technical research, dan
                        fundamental research.
                        <br><br>
                        Kalian juga akan mempelajari cara menggunakan tools seperti Token Terminal dan Glassnode secara
                        efisien
                        untuk menemukan alpha di market dan mendapatkan profit yang konsisten.
                    </p>

                </div>
            </div>
            <div class="row row-cols-1 row-cols-lg-2 position-relative ">

                <div class="col border-right-dotted px-5 pb-6">
                    <img src="https://akademicrypto.com/wp-content/uploads/2025/02/Frame-654037547-1536x840.webp"
                        data-aos="fade-up" alt="" width="100%">
                </div>
                <img class="check-1" width="20px" src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg"
                    alt="">
                <div class="col ps-5 text-white">
                    <h1 class="fw-semibold text-white" data-aos="fade-up">Bitcoin: <span
                            class="text-grad">Transaction</span> in <br> Depth
                    </h1>
                    <p class="mt-3" data-aos="fade-up">
                        Di modul ini, kita akan mempelajari transaksi Bitcoin secara mendalam bersama <strong>Belajar Satu
                            Persen</strong>.
                        Materi mencakup cara kerja Base58Check encoding, Bitcoin scripting, Pay to Address (P2A), Pay to
                        Public Key (P2PK),
                        Hash Locked Transaction (HLT), Check Lock Time Verify (CLTV), serta praktik langsung menggunakan
                        IDE.
                    </p>

                </div>
            </div>
            <div class="row row-cols-1 row-cols-lg-2 position-relative ">

                <div class="col border-right-dotted px-5 pb-6">
                    <img src="https://akademicrypto.com/wp-content/uploads/2025/02/Frame-654037548-1536x840.webp"
                        data-aos="fade-up" alt="" width="100%">
                </div>
                <img class="check-1" width="20px" src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg"
                    alt="">
                <div class="col ps-5 text-white">
                    <h1 class="fw-semibold text-white" data-aos="fade-up">Ethereum: <span
                            class="text-grad">Programmable</span> <br>money
                    </h1>
                    <p class="mt-3" data-aos="fade-up">
                        Di modul ini, kalian akan belajar semua yang perlu diketahui tentang Ethereum, atau yang sering
                        disebut
                        <strong>"The World Computer"</strong>, bersama <strong>{{ profil_web()->nama_website }}</strong>.
                        Materinya mencakup pengenalan Ethereum, perbedaan antara Bitcoin dan Ethereum, sejarah awalnya,
                        komponen Ethereum, dasar denominasi Ethereum, wallet, networks, struktur transaksi, transaction
                        nonce,
                        gas, dan gas limit.
                        <br><br>
                        Kalian juga akan mempelajari <strong>The Merge</strong>, yaitu transisi dari PoW (Proof of Work) ke
                        PoS (Proof of Stake)
                        yang dieksekusi pada 15 September 2022, integrasi Beacon Chain dan Mainnet, dasar dari EVM (Ethereum
                        Virtual Machine),
                        hingga cara staking Ethereum untuk mendapatkan bunga.
                    </p>

                </div>
            </div>
            <img class="shadow-right" src="https://akademicrypto.com/wp-content/uploads/2024/04/glow-2-a.svg"
                alt="">

            <div class="row row-cols-1 row-cols-lg-2 position-relative ">

                <div class="col border-right-dotted px-5 pb-6">
                    <img src="https://akademicrypto.com/wp-content/uploads/2025/02/Frame-654037549-1-1536x840.webp"
                        data-aos="fade-up" alt="" width="100%">
                </div>
                <img class="check-1" width="20px" src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg"
                    alt="">
                <div class="col ps-5 text-white">
                    <h1 class="fw-semibold text-white" data-aos="fade-up">Monero: <span
                            class="text-grad">Anonymity</span></h1>
                    <p class="mt-3" data-aos="fade-up">
                        Di modul ini, kalian akan belajar secara mendalam tentang salah satu cryptocurrency yang terkenal
                        dengan anonimitasnya,
                        yaitu <strong>Monero</strong>, bersama <strong>{{ profil_web()->nama_website }}</strong>.
                        Materinya mencakup kasus ransomware di Norwegia tahun 2018, sejarah Monero, latar belakang
                        cryptocurrency privacy,
                        serta detail transaksi Monero.
                        <br><br>
                        Kalian juga akan mempelajari berbagai tantangan dalam anonimitas, seperti Monero Ring Attack (MRA)
                        dan
                        masalah Key Reuse yang dapat memengaruhi privasi transaksi.
                    </p>

                </div>
            </div>
            <img class="shadow-right" src="https://akademicrypto.com/wp-content/uploads/2024/04/glow-2-a.svg"
                alt="">
            <img class="shadow-left" src="https://akademicrypto.com/wp-content/uploads/2024/04/glow-2-a.svg"
                alt="">

            <div class="row row-cols-1 row-cols-lg-2 position-relative ">

                <div class="col border-right-dotted px-5 pb-6">
                    <img src="https://akademicrypto.com/wp-content/uploads/2025/02/Frame-654037551-2-1536x840.webp"
                        data-aos="fade-up" alt="" width="100%">
                </div>
                <img class="check-1" width="20px" src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg"
                    alt="">
                <div class="col ps-5 text-white">
                    <h1 class="fw-semibold text-white" data-aos="fade-up">Crypto <span class="text-grad">Self
                            Custody</span></h1>
                    <p class="mt-3" data-aos="fade-up">
                        Di modul ini, kalian akan belajar salah satu aspek terpenting dalam crypto, yaitu bagaimana cara
                        mengamankan aset kalian sendiri bersama <strong>{{ profil_web()->nama_website }}</strong>.
                        Kalian akan memahami cara menyimpan crypto dengan aman dengan memegang private key sendiri
                        (tanpa membiarkan coin kalian tersimpan di CEX seperti Binance).
                    </p>

                    <p class="mt-3" data-aos="fade-up">
                        Selain itu, kalian juga akan mempelajari perbedaan antara hot dan cold wallet, cara setup cold
                        wallet,
                        proses reset dan recovery, serta cara menghubungkan cold wallet ke desktop app.
                        Materi juga mencakup penggunaan testnet di Ledger, cara menghubungkan cold wallet dengan Metamask,
                        dan langkah-langkah melakukan transaksi dengan cold wallet kalian.
                    </p>

                </div>
            </div>
            <div class="row row-cols-1 row-cols-lg-2 position-relative ">

                <div class="col border-right-dotted px-5 pb-6">
                    <img src="https://akademicrypto.com/wp-content/uploads/2025/02/Frame-654037552-1536x840.webp"
                        alt="" width="100%" data-aos="fade-up">
                </div>
                <img class="check-1" width="20px" src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg"
                    alt="">
                <div class="col ps-5 text-white">
                    <h1 class="fw-semibold text-white" data-aos="fade-up">Cryptocurrency <span
                            class="text-grad">Security</span></h1>
                    <p class="mt-3" data-aos="fade-up">
                        Di modul ini, kita akan belajar secara mendalam tentang keamanan crypto bersama
                        <strong>{{ profil_web()->nama_website }}</strong>. Materi mencakup <strong>Blockchain & Security
                            Overview</strong>,
                        komponen sistem dalam blockchain, blockchain execution environment, serta berbagai tantangan
                        keamanan
                        yang ada di dalamnya.
                    </p>

                    <p class="mt-3" data-aos="fade-up">
                        Kalian juga akan mempelajari teknik kriptografi, blockchain memory pool (Mempool), miner extractable
                        value (MEV),
                        finality issues, serta tantangan dalam Solidity, seperti permanent contract dan upgradable contract.
                        Selain itu, kita akan membahas risiko dalam DeFi, masalah keamanan yang sering dihadapi pengguna,
                        dan best practices untuk menjaga keamanan aset crypto kalian.
                    </p>

                </div>
            </div>
            <div class="row row-cols-1 row-cols-lg-2 position-relative ">

                <div class="col border-right-dotted px-5 pb-6">
                    <img src="https://akademicrypto.com/wp-content/uploads/2025/02/Frame-654037553-1536x840.webp"
                        alt="" width="100%" data-aos="fade-up">
                </div>
                <img class="check-1" width="20px" src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg"
                    alt="">
                <div class="col ps-5 text-white">
                    <h1 class="fw-semibold" data-aos="fade-up"><span class=" text-grad">Smart Contract</span> <span
                            class="text-white">Security</span></h1>
                    <p class="mt-3" data-aos="fade-up">
                        Di modul ini, kalian akan belajar secara <strong>advanced</strong> tentang <strong>smart contract
                            security</strong>
                        bersama <strong>{{ profil_web()->nama_website }}</strong>. Modul ini dirancang khusus bagi kalian
                        yang ingin
                        bekerja
                        sebagai auditor smart contract.
                    </p>

                    <p class="mt-3" data-aos="fade-up">
                        Kalian akan mempelajari bagaimana menjadi auditor security, memahami tantangan serta risikonya,
                        dan mendalami proses auditing smart contract. Selain itu, kalian akan mengenal berbagai tools dan
                        teknik
                        yang digunakan dalam auditing serta berlatih mencari angka tersembunyi di dalam sebuah smart
                        contract.
                    </p>

                </div>
            </div>
            <img class="shadow-right" src="https://akademicrypto.com/wp-content/uploads/2024/04/glow-2-a.svg"
                alt="">
            <div class="row row-cols-1 row-cols-lg-2 position-relative ">

                <div class="col border-right-dotted px-5 pb-6">
                    <img src="https://akademicrypto.com/wp-content/uploads/2025/02/Frame-654037554-1536x840.webp"
                        alt="" width="100%" data-aos="fade-up">
                </div>
                <img class="check-1" width="20px" src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg"
                    alt="">
                <div class="col ps-5 text-white">
                    <h1 class="fw-semibold text-white" data-aos="fade-up">Blockchain <br> <span
                            class="text-grad">Interoperability</span>
                    </h1>
                    <p class="mt-3" data-aos="fade-up">
                        Di modul ini, kalian akan belajar tentang <strong>blockchain interoperability</strong>
                        bersama <strong>{{ profil_web()->nama_website }}</strong>—sebuah konsep yang memungkinkan berbagai
                        jaringan
                        blockchain
                        untuk berinteraksi, berintegrasi, dan berkomunikasi secara mulus guna mendukung transfer data antar
                        chain.
                    </p>

                    <p class="mt-3" data-aos="fade-up">
                        Materi yang akan dipelajari mencakup landscape blockchain interoperability, blockchain DBMS,
                        multi-blockchain environment, blockchain joint, serta blockchain extension seperti sidechain.
                        Selain itu, kalian juga akan memahami konsep decentralized exchange, state pinning, konsensus,
                        komunikasi & standarisasi, bridge, serta kelebihan dan kekurangannya.
                        Studi kasus tentang penerapan blockchain dalam <strong>Supply Chain Management (SCM)</strong> juga
                        akan dibahas.
                    </p>

                </div>
            </div>
            <img class="shadow-right" src="https://akademicrypto.com/wp-content/uploads/2024/04/glow-2-a.svg"
                alt="">
            <div class="row row-cols-1 row-cols-lg-2 position-relative ">

                <div class="col border-right-dotted px-5 pb-6">
                    <img src="https://akademicrypto.com/wp-content/uploads/2025/02/Frame-654037555-1536x840.webp"
                        alt="" width="100%" data-aos="fade-up">
                </div>
                <img class="check-1" width="20px" src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg"
                    alt="">
                <div class="col ps-5 text-white">
                    <h1><span class="text-grad " data-aos="fade-up">Smart Contract</span> <br> <span
                            class="text-white">Development</span>
                    </h1>
                    <p class="mt-3" data-aos="fade-up">
                        Di modul ini, kalian akan belajar tentang <strong>blockchain interoperability</strong>,
                        yaitu konsep yang memungkinkan berbagai jaringan blockchain untuk berinteraksi, berintegrasi,
                        dan berkomunikasi secara mulus guna mendukung transfer data antar chain.
                    </p>

                    <p class="mt-3" data-aos="fade-up">
                        Selain itu, kalian juga akan mempelajari <strong>skill programming paling mahal di
                            dunia</strong>—belajar coding
                        di internet masa depan dengan teknologi <strong>smart contract</strong>, atau yang lebih dikenal
                        sebagai <strong>Web3</strong>.
                        Ini adalah materi eksklusif yang tidak akan kalian temui di universitas mana pun di Indonesia,
                        dan hanya tersedia di <strong>{{ profil_web()->nama_website }}</strong>.
                    </p>

                    <p class="mt-3" data-aos="fade-up">
                        Kalian akan dibimbing langsung oleh praktisi berpengalaman, belajar <strong>step by step</strong>
                        dari dasar-dasar bahasa pemrograman <strong>Solidity</strong>, struktur smart contract,
                        penggunaan <strong>Remix Interface</strong>, pemahaman <strong>Mnemonic Phrases</strong>,
                        hingga <strong>deployment smart contract</strong>.
                    </p>

                </div>
            </div>

            <div class="row row-cols-1 row-cols-lg-2 position-relative ">

                <div class="col px-5 pb-6">
                    <img src="https://akademicrypto.com/wp-content/uploads/2025/02/Frame-654037556-1536x840.webp"
                        alt="" width="100%" data-aos="fade-up">
                </div>


                <img class="check-1" width="20px" src="https://akademicrypto.com/wp-content/uploads/2024/04/Vector.svg"
                    alt="">

                <div class="col ps-5 text-white">
                    <h1 class="fw-semibold  text-white" data-aos="fade-up">Sales <span class="text-grad">Mastery</span>
                    </h1>

                    <p class="mt-3" data-aos="fade-up">
                        <strong>Sales Mastery</strong> adalah bonus modul tambahan di <strong>Akademi Crypto</strong>
                        yang tersedia eksklusif di <strong>{{ profil_web()->nama_website }}</strong>.
                        Di sini, kalian akan mendapatkan ilmu fundamental tentang seni menjual,
                        sehingga kalian bisa menjual apa pun, kapan pun, kepada siapa pun, dan di mana pun.
                    </p>

                    <p class="mt-3" data-aos="fade-up">
                        Kalian akan belajar secara mendalam tentang <strong>psikologi jualan</strong>,
                        <strong>mentalitas seorang sales</strong>, <strong>decision-making flow</strong>,
                        <strong>seni storytelling</strong>, <strong>teknik persuasi</strong>, <strong>funnel sales</strong>,
                        hingga <strong>strategi menangani keberatan (objection handling)</strong> dari calon klien.
                    </p>


                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5 mb-5">
        <a href="#tawaran"> <img class="join-now"
                src="https://akademicrypto.com/wp-content/uploads/2024/04/button-join.svg" class="img-fluid"
                style="max-width: 50%;" alt=""></a>
    </div>

    <div class="gradient-line mt-5 mb-5"></div>

    <div class="container">


        <div class="text-center">

            <h2 class="text-white text-spacing mb-lg-5" data-aos="fade-up">Bonus yang kalian dapatkan <br>setelah
                bergabung menjadi member
            </h2>
            <div class="d-none d-lg-block" data-aos="fade-up">
                <span class="fw-semibold fs-3 text-secondary">01.</span><span class="sub-title  text-grad"> AC
                    Research,</span><span class="sub-title  text-white">Coin Picks Yang <br>Memiliki
                </span><span class="sub-title " style="color: #5ef438">Winrate 90%+</span>
            </div>
            <div class="d-block d-lg-none" data-aos="fade-up">
                <span class="fw-semibold fs-3 text-secondary">01.</span><span class="sub-title  text-grad"> AC
                    Research,</span><span class="sub-title  text-white">Coin Picks Yang Memiliki
                </span><span class="sub-title " style="color: #5ef438">Winrate 90%+</span>
            </div>




            <p class="text-white mt-5 mx-auto" style="max-width: 600px" data-aos="fade-up">
                Lima tahun dari sekarang, kalian akan bersyukur telah memulai investasi dengan <strong>AC Research</strong>.
                Tidak perlu repot menyaring jutaan koin—cukup ikuti riset internal kami dan nikmati hasilnya.
            </p>

        </div>

    </div>
    <div class="container mb-5 px-5 d-none d-lg-block">
        <img src="/assets/img/Group-654038111-1-1-1024x612.webp" alt="Gambar Tidak Muncul" width="100%">

    </div>
    <div class="container mb-5 d-block d-lg-none">
        <img src="/assets/img/Group-654035756-2.png" alt="Gambar Tidak Muncul" width="100%">

    </div>
    <div class="container text-center mt-5" data-aos="fade-up">
        <img src="/assets/img/Frame-654037574-2-1536x814.webp" alt="Gambar Tidak Muncul" class="responsive-img">
    </div>
    <div class="container text-center mt-5" data-aos="fade-up">
        <img src="/assets/img/Frame-654037573-4-1536x814.webp" alt="Gambar Tidak Muncul" class="responsive-img">
    </div>
    <div class="container text-center mt-5" data-aos="fade-up">
        <img src="/assets/img/Group-654038109-1536x816.webp" alt="Gambar Tidak Muncul" class="responsive-img">
    </div>
    <div class="container text-center mt-5" data-aos="fade-up">
        <img src="/assets/img/Group-654038110-1536x845.webp" alt="Gambar Tidak Muncul" class="responsive-img">
    </div>


    <div class="container text-center mt-5" data-aos="fade-up">
        <img src="https://akademicrypto.com/wp-content/uploads/2025/02/Frame-654036879-1.svg" class="img-fluid"
            style="max-width: 50%;" alt="Gambar Tidak Muncul">

    </div>
    <style>
        .text-container span {
            font-size: clamp(14px, 4vw, 32px) !important;
            /* Min 14px, max 32px, menyesuaikan viewport */
        }
    </style>

    <div class="title-line ">
        <div class="fw-bold mb-3 text-container" data-aos="fade-up">
            <span class="fs-3 text-secondary">02.</span>
            <span class="text-grad fs-2">Webinar Eksklusif</span>
            <span class="text-white pb-2 fs-2">Bulanan</span>
        </div>


    </div>

    <div class="contriner">
        <div class="text-center">
            <p class="fs-2 text-white fw-bold mx-auto" style="max-width: 500px" data-aos="fade-up">Seharga 970rb Per
                Webinar Untuk Orang Luar
            </p>
            <p class="text-white mx-auto" style="max-width: 480px" data-aos="fade-up">Kalian akan mendapatkan hanya
                dengan commitment fee
                97rb jika
                menjadi member dan
                recording seumur hidup.</p>
        </div>
    </div>


    <div class="container">
        <div class="card " data-aos="fade-up">
            <div class="value  text-center">
                <img class="img-fluid w-auto"
                    src="https://akademicrypto.com/wp-content/uploads/2024/04/Frame-654037320.svg" alt="">
            </div>

            <img class="shadow-left" src="https://akademicrypto.com/wp-content/uploads/2024/04/glow-2-a.svg"
                alt="">
            <div class="card-body p-0">
                <div class="header">
                    <div class="zoom text-center mb-3 mt-2 mt-lg-5">
                        <img src="/assets/img/Group-654035762.webp" alt="Zoom Icon">
                    </div>
                </div>
                <div class="content">
                    <div class="row row-cols-2 row-cols-lg-4">
                        <div class="col">
                            <img width="100%" class="mb-3" src="/assets/img/image-13.webp" alt="Crypto Card">
                        </div>
                        <div class="col">
                            <img width="100%" class="mb-3" src="/assets/img/image-14.webp" alt="Election Card">
                        </div>
                        <div class="col">
                            <img width="100%" class="mb-3" src="/assets/img/image-26.webp" alt="AI Card">
                        </div>
                        <div class="col">
                            <img width="100%" class="mb-3" src="/assets/img/image-25.webp" alt="Reset Card">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="title-line fw-bold">
        <span class="fs-3 text-secondary">03.</span>
        <span class="text-grad fs-2">Private Mentoring,</span>
        <span class="text-white pb-2 fs-2">&nbsp;Akses </span>
    </div>

    <div class="text-center">
        <p class="fs-2 text-white fw-bold">Langsung Ke Para Founder <br> Untuk Main Ke Kantor Kita</p>

        <p class="text-white">untuk private mentoring dengan komunitas.</p>
    </div> --}}


    <div class="title-line fw-bold">

        <p class="text-grad  text-spacing mt-3" data-aos="fade-up">KAMU ADA DI TIPE MANA?</p>
    </div>
    <div class="container">

        <div class="text-center">
            <h2 class="text-white fw-bold" data-aos="fade-up">di Dunia ini Ada 2 Tipe Orang,</h2>
        </div>

        <div class="row row-cols-1 row-cols-lg-2" data-aos="fade-up">
            <div class="col d-flex justify-content-end">
                <img src="https://akademicrypto.com/wp-content/uploads/2024/04/Frame-654037080-905x1024.webp"
                    alt="" width="97%">
            </div>
            <div class="col d-flex justify-content-end">
                <img class="mt-4 me-2"
                    src="https://akademicrypto.com/wp-content/uploads/2024/04/Frame-654037079-967x1024.webp"
                    alt="" width="100%">
            </div>
        </div>
    </div>
    <div class="text-center mt-5" data-aos="fade-up">
        <a href="#tawaran"> <img src="https://akademicrypto.com/wp-content/uploads/2024/04/btn-cta.svg"
                class="img-fluid join-now" alt=""></a>

    </div>

    <div class="gradient-line mt-5 mb-5" id="tawaran"></div>
    <style>
        .text-periode {
            font-size: clamp(10px, 3vw, 20px) !important;
            /* Min 14px, max 32px, menyesuaikan viewport */
        }
    </style>
    <div class="text-center mb-4" data-aos="fade-up">
        <p class="text-spacing text-grad fw-bold">PRICING</p>
        <h2 class="text-white fw-bold fs-1 mb-4">Daftar & Join Sekarang</h2>
        <p class="text-spacing text-white text-periode">Harga Sampai Periode <span
                class="text-danger">{{ date('d F H:i', strtotime($periode->periode)) }}</span></p>
    </div>




    <div class="container">
        <div class="row row-cols-1 row-cols-lg-3 g-4 justify-content-center">
            @foreach ($keanggotaans as $index => $keanggotaan)
                <div class="col d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ $index * 200 }}">
                    <div class="card text-white position-relative w-100 text-start mt-3">
                        <!-- Badge di atas -->
                        <div
                            class="top-badge {{ $keanggotaan->title && $keanggotaan->text_title != null ? 'd-block' : 'd-none' }}">
                            {{ $keanggotaan->text_title }}</div>
                        <div class="card-body d-flex flex-column">
                            <p class="text-spacing fs-6">Keanggotaan {{ $keanggotaan->bulan }} Bulan</p>
                            <p class="fs-6  {{ $keanggotaan->title ? 'd-block' : 'd-none' }}">+ Akses discord
                                role student</p>
                            <h1 class="fw-bold">
                                Rp{{ number_format($keanggotaan->harga_setahun, 0, ',', '.') }}</h1>
                            <span>/bulan</span>
                            <hr>
                            <p class="fw-bold text-danger text-decoration-line-through m-0" style="font-size: 14px">
                                Rp{{ number_format($keanggotaan->harga * $keanggotaan->bulan, 0, ',', '.') }}
                            </p>
                            <h2 class="fw-bold">
                                Rp{{ number_format($keanggotaan->harga_setahun * $keanggotaan->bulan, 0, ',', '.') }}</h2>
                            <p>*Pembayaran {{ $keanggotaan->bulan }} Bulan Penuh</p>
                            <div class="text-center mt-auto">
                                <div class="button-wrapper">
                                    <a @if (!auth()->check()) href="/register"
            @elseif (!auth()->user()->hasVerifiedEmail())
                href="{{ route('verification.notice') }}"
            @else
                {{-- data-bs-toggle="modal" data-bs-target="#paymentModal{{ $keanggotaan->id }}" --}}
                href="https://lynk.id/belajarsatupersen.id/LPn99wE/checkout" @endif
                                        class="text-decoration-none">
                                        <button class="custom-bergabung-border2"></button>
                                        <button class="custom-bergabung-border"></button>
                                        <button class="custom-bergabung text-spacing fs-6"
                                            style="font-size: 14px !important">
                                            Bergabung Sekarang
                                        </button>
                                    </a>
                                </div>
                            </div>

                            <div class="img-card">
                                <img src="{{ asset(profil_web()->logo) }}" alt="" width="40%">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                @auth
                    <div class="modal fade text-dark" id="paymentModal{{ $keanggotaan->id }}" tabindex="-1"
                        aria-labelledby="paymentModal{{ $keanggotaan->id }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="paymentModalLabel">Konfirmasi Pembayaran</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Tabel Harga -->
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Paket</th>
                                                <th>Harga Per Bulan</th>
                                                <th>Harga {{ $keanggotaan->bulan }} Bulan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $keanggotaan->bulan }} Bulan</td>
                                                <td>Rp{{ number_format($keanggotaan->harga_setahun, 0, ',', '.') }}
                                                </td>
                                                <td>Rp{{ number_format($keanggotaan->harga_setahun * $keanggotaan->bulan, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <!-- Pilihan Metode Pembayaran dengan Kotak -->
                                    <h6 class="mt-3 text-center fw-bold">Pilih Metode Pembayaran</h6>
                                    <div class="d-flex justify-content-center flex-wrap gap-3 ">
                                        <label class="payment-option">
                                            <input type="radio" name="payment_type_{{ $keanggotaan->id }}"
                                                value="bank_transfer" checked>
                                            <div class="option-content"><img
                                                    src="https://cdn-icons-png.flaticon.com/512/6404/6404655.png"
                                                    width="70%" alt="">
                                            </div>
                                        </label>
                                        <label class="payment-option">
                                            <input type="radio" name="payment_type_{{ $keanggotaan->id }}" value="gopay">
                                            <div class="option-content"><img
                                                    src="https://antinomi.org/wp-content/uploads/2022/03/logo-gopay-vector.png"
                                                    width="100%" alt=""></div>
                                        </label>
                                        <label class="payment-option">
                                            <input type="radio" name="payment_type_{{ $keanggotaan->id }}" value="qris">
                                            <div class="option-content"><img
                                                    src="https://images.seeklogo.com/logo-png/39/2/quick-response-code-indonesia-standard-qris-logo-png_seeklogo-391791.png"
                                                    width="100%" alt="">
                                            </div>
                                        </label>
                                        <label class="payment-option">
                                            <input type="radio" name="payment_type_{{ $keanggotaan->id }}"
                                                value="credit_card">
                                            <div class="option-content"><img
                                                    src="https://st2.depositphotos.com/2485091/45350/v/450/depositphotos_453506614-stock-illustration-popular-credit-card-companies-logos.jpg"
                                                    width="100%" alt=""></div>
                                        </label>
                                    </div>

                                    <!-- Info User -->
                                    <hr>
                                    <h6 class="mt-3 fw-bold">Informasi Pengguna</h6>
                                    <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
                                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                                    <p><strong>No Telepon:</strong> {{ auth()->user()->no_tlp }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-primary pay-button"
                                        data-id="{{ $keanggotaan->id }}">Lanjutkan Pembayaran</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endauth

                <!-- Tambahkan CSS -->
                <style>
                    .payment-option {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-direction: column;
                        width: 120px;
                        height: 80px;
                        border: 2px solid #ddd;
                        border-radius: 10px;
                        cursor: pointer;
                        text-align: center;
                        font-weight: bold;
                        transition: all 0.3s;
                        position: relative;
                    }

                    .payment-option input {
                        position: absolute;
                        opacity: 0;
                        cursor: pointer;
                    }

                    .payment-option input:checked+.option-content {
                        background-color: #0d6efd;
                        color: white;
                        border-color: #0d6efd;
                    }

                    .option-content {
                        width: 100%;
                        height: 100%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 10px;
                        padding: 10px;
                    }
                </style>
            @endforeach
        </div>
    </div>



    <script>
        document.querySelectorAll('.pay-button').forEach(button => {
            button.addEventListener('click', async function() {
                let keanggotaanId = this.getAttribute('data-id');
                let paymentTypeInput = document.querySelector(
                    `input[name="payment_type_${keanggotaanId}"]:checked`);

                if (!paymentTypeInput) {
                    alert('Silakan pilih metode pembayaran!');
                    return;
                }

                let paymentType = paymentTypeInput.value;
                console.log('Payment Type:', paymentType);

                // Ubah tombol saat loading
                this.disabled = true;
                this.textContent = 'Memproses...';

                try {
                    let response = await fetch('/payment/process', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            keanggotaan_id: keanggotaanId,
                            payment_type: paymentType
                        })
                    });

                    let data = await response.json();
                    console.log('Midtrans Token:', data.token);

                    if (!data.token) {
                        alert('Gagal mendapatkan token pembayaran!');
                        return;
                    }

                    snap.pay(data.token, {
                        onSuccess: async function(result) {
                            console.log('Pembayaran sukses:', result);

                            if (!result.order_id) {
                                alert('Order ID tidak ditemukan!');
                                return;
                            }

                            // Kirim notifikasi sukses ke backend
                            try {
                                let notifyResponse = await fetch('/payment/notification', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        order_id: result.order_id,
                                        transaction_status: 'settlement' // Status sukses
                                    })
                                });

                                let notifyData = await notifyResponse.json();
                                console.log('Status pembayaran diperbarui:', notifyData);

                                // Redirect setelah status sukses diupdate
                                window.location.href = '/kursus';

                            } catch (error) {
                                console.error('Gagal mengupdate status pembayaran:', error);
                                alert(
                                    'Terjadi kesalahan saat memperbarui status pembayaran.'
                                );
                            }
                        },
                        onPending: async function(result) {
                            console.log('Pembayaran pending:', result);
                            alert('Menunggu pembayaran...');

                            if (!result.order_id) {
                                alert('Order ID tidak ditemukan!');
                                return;
                            }

                            // Update status ke pending sebelum redirect
                            await updatePaymentStatus(result.order_id, 'pending');
                            window.location.href = '/orderan';
                        },
                        onError: async function(result) {
                            console.log('Pembayaran gagal:', result);
                            alert('Pembayaran gagal!');

                            if (!result.order_id) {
                                alert('Order ID tidak ditemukan!');
                                return;
                            }

                            // Kirim status gagal ke backend sebelum redirect
                            await updatePaymentStatus(result.order_id, 'failure');
                            window.location.href = '/orderan';
                        }
                    });

                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan, silakan coba lagi.');
                } finally {
                    // Kembalikan tombol ke keadaan semula
                    this.disabled = false;
                    this.textContent = 'Bayar Sekarang';
                }
            });
        });

        async function updatePaymentStatus(orderId, status) {
            try {
                let response = await fetch('/payment/notification', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        order_id: orderId,
                        transaction_status: status
                    })
                });

                let data = await response.json();
                console.log(`Status pembayaran (${status}) diperbarui:`, data);
            } catch (error) {
                console.error(`Error update status (${status}):`, error);
            }
        }
    </script>

    <!-- Tambahkan Midtrans Script -->
    <script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ profil_web()->midtrans_client_key }}"></script>









    <section class="binjamin">
        <div class="container">


            <div class="text-center kata text-white fw-bold" data-aos="fade-up">
                “If a Man Empties His Purse Into His Head no Man Can Take It Away”
            </div>

            <div class="text-center">
                <p class="text-spacing text-white mb-5" data-aos="fade-up">
                    BENJAMIN FRANKLIN
                </p>
                <a href="#tawaran" data-aos="fade-up"> <img class="join-now"
                        src="https://akademicrypto.com/wp-content/uploads/2024/04/button-join.svg" class="img-fluid"
                        style="max-width: 50%;" alt=""></a>

            </div>
        </div>
    </section>


    <div class="title-line text-grad text-spacing fs-6 fw-bold mb-5" data-aos="fade-up">FREQUENTLY ASKED QUESTION</div>
    <img class="shadow-left" src="https://akademicrypto.com/wp-content/uploads/2024/04/glow-2-a.svg" alt="">
    <div class="parent-container accordion-widht" data-aos="fade-up">
        <div class="container ">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button bg-transparent fs-4 text-white" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                            aria-controls="collapseOne">
                            Apakah investasi di crypto pasti akan mendapatkan keuntungan?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show bg-transparent "
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body ">
                            Layaknya semua hal didunia tidak ada yang pasti. Semakin tinggi potensi imbal hasil sebuah
                            asset
                            maka resikonya akan semakin tinggi juga. tetapi dengan belajar, kalian pasti akan bisa
                            meminimalisir kerugian.
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion mt-4" id="accordionExample">

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fs-4 py-4 collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">

                            Apakah butuh modal yang besar untuk mulai berinvestasi di crypto?
                        </button>
                    </h2>


                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Tidak juga, kalian bisa mulai dengan modal sekecil apapun kita bahkan menyarankan untuk
                            pemula,
                            mulai dengan 5-10% dari total asset untuk merasakan naik & turunnya fluktuasi harga crypto &
                            untuk belajar cara teknologinya bekerja
                        </div>
                    </div>
                </div>

            </div>

            <div class="accordion mt-4" id="accordionExample">

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fs-4 py-4 collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">

                            Saya benar-benar awam tentang crypto apakah akan menjadi masalah?
                        </button>
                    </h2>
                    <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Tentu tidak, justru itulah fungsinya kalian belajar di akademi crypto. disini kita akan
                            membimbing kalian dari 0 sampai mengerti secara penuh tentang analisa, manajemen portofolio,
                            dan
                            cara berhasil di pasar crypto
                        </div>
                    </div>
                </div>

            </div>
            <div class="accordion mt-4" id="accordionExample">

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fs-4 py-4 collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">

                            Saya masih muda, apakah umur akan menjadi masalah?
                        </button>
                    </h2>
                    <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            umur itu tidak pernah menjadi masalah, karena kita tau teman terbaik dari mulai lebih awal
                            adalah compounding. compounding tidak hanya bekerja di uang tapi juga di ilmu, semakin muda
                            kalian mulai, semakin tinggi imbal hasil efek compounding yang kalian dapatkan di masa
                            mendatang. waktu terbaik untuk mulai adalah hari ini.
                        </div>
                    </div>
                </div>

            </div>

            <div class="accordion mt-4" id="accordionExample">

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fs-4 py-4 collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">

                            Belum punya income yang besar, apakah iya bisa mencapai kebebasan finansial di crypto?
                        </button>
                    </h2>
                    <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            komunitas yang akan gua bangun disini, gaakan cuma sekedar ngomongin investasi, tapi gua
                            juga
                            akan sharing bagaimana cara kalian bisa mendapatkan income lebih untuk mencapai 1 miliar
                            pertama.
                        </div>
                    </div>
                </div>

            </div>

            <div class="accordion mt-4" id="accordionExample">

                <img class="shadow-right" src="https://akademicrypto.com/wp-content/uploads/2024/04/glow-2-a.svg"
                    alt="">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fs-4 py-4 collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">

                            Tidak di support oleh teman dan keluarga, apakah iya bisa menjadi orang yang sukses?
                        </button>
                    </h2>
                    <div id="collapse6" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            gua ngerti kok rasanya tidak di support oleh keluarga dan teman, itulah fungsinya komunitas
                            eklusif akademi crypto untuk menjadi teman yang saling support dengan visi, misi dan tujuan
                            yang
                            sama, karena gua tau relasi adalah hal yang penting dalam mencapai kesuksesan.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="text-center mt-4 mb-5" data-aos="fade-up">
        <a href="#tawaran"> <img class="join-now"
                src="https://akademicrypto.com/wp-content/uploads/2024/04/button-join.svg" class="img-fluid"
                style="max-width: 50%;" alt=""></a>

    </div>

    <div class="container mb-5 d-none d-lg-block" data-aos="fade-up">
        <img src="/assets/img/Frame-654037265-1536x532.webp" alt="" width="100%">
    </div>
    <div class="container mb-5 d-block d-lg-none" data-aos="fade-up">
        <img src="/assets/img/Frame-654037268.webp" alt="" width="100%">
    </div>

    <hr>
@endsection
