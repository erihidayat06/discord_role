@extends('layouts.main')


@section('content')
    <div class="text-center text-white">
        <div class="text-spacing-2">KURIKULUM</div>
        <div class="apa-modul mt-3">
            <h1 class="fw-bold">Apa Modul Yang Kalian Dapatkan Didalam?</h1>
        </div>
    </div>
    <div class="container text-start mt-5">
        <div class="row row-cols-1 row-cols-lg-4 justify-content-center ">
            <div class=" mx-2 card-bg-grad">
                <div class="card-body">
                    <img src="https://akademicrypto.com/wp-content/uploads/2024/07/q3-1-1.webp" alt="" width="100%">

                    <p class="phase">PHASE 1</p>
                    <h4 class="fw-bold text-white">Fondasi Trading <br> Crypto</h4>

                    <ul class="text-white p-0 ms-3 mt-3">
                        <li>Mind Management</li>
                        <li>Risk Management</li>
                        <li>Trading Basics</li>
                    </ul>
                </div>
            </div>
            <div class="mx-2 card-bg-grad">
                <div class="card-body">
                    <img src="https://akademicrypto.com/wp-content/uploads/2024/07/q4-1-1.webp" alt=""
                        width="100%">

                    <p class="phase">PHASE 2</p>
                    <h4 class="fw-bold text-white">Crypto Narrative <br> Trading Guide</h4>

                    <ul class="text-white p-0 ms-3 mt-3">
                        <li>Altcoin Screening</li>
                        <li>Fundamental Research</li>
                        <li>Narrative Research</li>
                        <li>Fibonacci guide</li>
                        <li>Harmonic Trading</li>
                    </ul>
                </div>
            </div>
            <div class="mx-2 card-bg-grad">
                <div class="card-body">
                    <img src="https://akademicrypto.com/wp-content/uploads/2024/07/q5-1-1.webp" alt=""
                        width="100%">

                    <p class="phase">PHASE 3</p>
                    <h4 class="fw-bold text-white">Crypto Advanced <br> Technical Analysis</h4>

                    <ul class="text-white p-0 ms-3 mt-3">
                        <li>Order Flow Analysis</li>
                        <li>Liquidity Concepts</li>
                        <li>Market Structures</li>
                    </ul>
                </div>
            </div>
            <div class="mx-2 card-bg-grad">
                <div class="card-body">
                    <img src="https://akademicrypto.com/wp-content/uploads/2024/07/q6-1-1.webp" alt=""
                        width="100%">

                    <p class="phase">PHASE 4</p>
                    <h4 class="fw-bold text-white">Crypto Institution <br> Fundamental Investing</h4>

                    <ul class="text-white p-0 ms-3 mt-3">
                        <li>Crypto Investing Strategies</li>
                        <li>Deep Tools</li>
                    </ul>
                </div>
            </div>
            <div class="mx-2 card-bg-grad">
                <div class="card-body">
                    <img src="https://akademicrypto.com/wp-content/uploads/2024/07/q7-1-1.webp" alt=""
                        width="100%">

                    <p class="phase">PHASE 5</p>
                    <h4 class="fw-bold text-white">Crypto Advanced <br> Portfolio Management</h4>

                    <ul class="text-white p-0 ms-3 mt-3">
                        <li>Mind Management</li>
                        <li>Risk Management</li>
                        <li>Trading Basics</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <hr class="mt-5">

    <div class="container-fluid">
        <style>
            .bonus {
                max-width: 500px;
                margin: auto;
                margin-top: 200px;
                position: relative;
                padding-top: 150px;
                /* Memberikan ruang untuk gambar */
            }

            .img-bonus {
                position: absolute;
                top: -150px;
                left: 50%;
                transform: translateX(-50%);
                width: 80%;
                /* Menyesuaikan ukuran agar lebih responsif */
                max-width: 400px;
            }

            @media (max-width: 768px) {
                .bonus {
                    margin-top: 150px;
                    /* Mengurangi margin di layar kecil */
                    padding-top: 120px;
                }

                .img-bonus {
                    top: -120px;
                    /* Menyesuaikan posisi gambar */
                    width: 70%;
                    /* Mengurangi ukuran gambar */
                }
            }
        </style>

        <div class="text-center">
            <h1 class="text-white fw-bold">
                Bonus Lain Yang Kalian Dapatkan <br>
                Setelah Bergabung Menjadi Member
            </h1>

            <div class="card-bg-grad bonus">
                <div class="card-body">
                    <img src="https://akademicrypto.com/wp-content/uploads/2024/07/image_2024-05-27_105737157-1-1.webp"
                        alt="" class="img-bonus">
                    <p class="text-spacing fs-6" style="color:#04CA00; margin-top:70px">
                        Value 600jt+ per tahun
                    </p>
                    <h1 class="fw-bold text-white">AC Terminal​</h1>

                    <p class="text-white mt-5">
                        Data onchain dan quantitative eksklusif yang kita olah sendiri & tarik dari provider luar seharga
                        ribuan
                        dollar. Kalian gak perlu subs tools apapun, kita yang akan pilah ke kalian data mana yang paling
                        penting.
                    </p>

                    <p class="text-white mt-5">
                        Anggap ini kaya Bloomberg Terminal untuk crypto.
                        Kalian hemat subscribe ITC, Kingfisher, Glassnode, Coingecko, dan banyak tools lainnya.
                    </p>
                </div>
            </div>
        </div>
    </div>


    <hr class="mt-5">
@endsection
