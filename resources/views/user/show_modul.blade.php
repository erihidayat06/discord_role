@extends('user.layouts_modul.main')

@section('content')
    {{-- Import Plyr CSS dan JS --}}
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />

    <style>
        .video {
            width: 100%;
            max-width: 100%;
            height: auto;
        }

        #player {
            width: 100%;
            height: auto;
            max-height: 90vh;
            /* Maksimal 90% tinggi layar */
        }
    </style>

    <div class="video mb-5">
        {{-- <!-- Progress Bar -->
        <div class="progress" id="progress2">
            <div class="progress-bar" id="progress-bar-show2" role="progressbar" aria-valuenow="{{ $progress }}"
                aria-valuemin="0" aria-valuemax="100">
                <span id="progress-text-show2">0%</span> <!-- Pindahkan teks ke dalam bar -->
            </div>
        </div> --}}

        <!-- CSS -->
        <style>
            #progress2 {
                width: 100%;
                position: relative;
                height: 25px;
                /* Tambahkan tinggi agar teks tidak terpotong */
            }

            #progress-bar-show2 {
                background-color: #ac43e4 !important;
                /* Warna ungu */
                transition: width 0.3s ease-in-out;
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
            }

            /* Teks di dalam progress bar */
            #progress-bar-show2 span {
                position: absolute;
                width: 100%;
                text-align: center;
                color: white;
                /* Warna teks putih */
                font-weight: bold;
            }
        </style>




        <!-- JavaScript -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const progressBar = document.getElementById("progress-bar-show2");
                const progressText = document.getElementById("progress-text-show2");

                // Ambil nilai progress dari atribut dan pastikan berupa angka
                let progressValue = parseInt(progressBar.getAttribute("aria-valuenow")) || 0;

                if (isNaN(progressValue) || progressValue <= 0) {
                    console.error("Progress value tidak valid:", progressValue);
                    return; // Hentikan jika nilainya tidak valid
                }

                let currentProgress = 0;

                function animateProgress() {
                    if (currentProgress <= progressValue) {
                        progressBar.style.width = currentProgress + "%";
                        progressText.textContent = currentProgress + "%";
                        currentProgress++;

                        setTimeout(animateProgress, 5);
                    }
                }

                setTimeout(() => {
                    animateProgress();
                }, 1000);
            });
        </script>

        <!-- Judul Modul -->
        <p class="fw-bold">{{ $showModul->judul }}</p>


        <iframe src="{{ $showModul->video }}?autoplay=1&watermark={{ urlencode(env('BUNNY_STREAM_WATERMARK_URL')) }}"
            width="100%" height="500" allow="autoplay; fullscreen" frameborder="0" allowfullscreen>
        </iframe>

    </div>

    <script>
        const player = new Plyr('#player');
    </script>
@endsection
