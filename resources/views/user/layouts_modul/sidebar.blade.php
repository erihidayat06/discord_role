<style>
    .progress-bar {
        background-color: rgba(190, 72, 251, 0.9);
    }

    .text-main {
        color: rgba(190, 72, 251, 0.9);
    }

    .btn-main {
        background-color: rgba(190, 72, 251, 0.9);
        color: white;
    }

    .btn-main:hover {
        background-color: rgba(178, 110, 212, 0.9);
        color: white;
    }

    .accordion-button::after {
        filter: invert(1);
        /* Mengubah warna ikon menjadi putih */
    }

    .accordion-button:not(.collapsed)::after {
        filter: invert(1);
        /* Tetap putih saat accordion terbuka */
    }
</style>
<!-- ======= Sidebar ======= -->
<div class="sidebar bg-dark text-white p-0">
    <ul class="nav flex-column">
        <li class="list-group-item text-center m-2">
            <img src="{{ asset('storage/' . $kelas->gambar) }}" class="object-fit-cover" alt="" width="90%"
                height="150px" loading="lazy">


            <p class="fw-bold mt-3 text-start">{{ $kelas->judul }}</p>
            <style>
                /* Container utama */
                #progress-container {
                    width: 100%;
                    max-width: 600px;
                    margin: auto;
                    text-align: center;
                }

                /* Progress bar */
                .progress {
                    width: 100%;
                    background-color: #e0e0e0;
                    border-radius: 20px;
                    overflow: hidden;
                    position: relative;
                }

                /* Progress warna ungu */
                .progress-bar {
                    background-color: #ac43e4 !important;
                    width: 0%;
                    height: 100%;
                    transition: width 0.3s ease-in-out;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white !important;
                    /* Warna teks dalam progress bar */
                    font-weight: bold;
                    font-size: 14px;
                }

                /* Teks di bawah progress bar */
                #progress-text {
                    margin-top: 5px;
                    font-size: 14px;
                    font-weight: bold;
                    color: #ac43e4;
                    /* Warna teks bawah progress bar */
                }
            </style>

            <!-- Progress Container -->
            <div id="progress-container">
                <div class="progress">
                    <div class="progress-bar" id="progress-bar" role="progressbar" aria-valuenow="{{ $progress }}"
                        aria-valuemin="0" aria-valuemax="100">

                    </div>
                </div>
                <p id="progress-text">0%</p> <!-- Teks di bawah progress bar -->
            </div>

            <!-- JavaScript untuk Animasi -->
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const progressBar = document.getElementById("progress-bar");

                    const progressTextBelow = document.getElementById("progress-text");

                    let progressValue = parseInt(progressBar.getAttribute("aria-valuenow")) || 0;

                    if (isNaN(progressValue) || progressValue < 0 || progressValue > 100) {
                        console.error("Progress value tidak valid:", progressValue);
                        return;
                    }

                    let currentProgress = 0;

                    function animateProgress() {
                        if (currentProgress <= progressValue) {
                            progressBar.style.width = currentProgress + "%";

                            progressTextBelow.textContent = currentProgress + "%"; // Teks di bawah progress bar
                            currentProgress++;
                            setTimeout(animateProgress, 10);
                        }
                    }

                    setTimeout(animateProgress, 500);
                });
            </script>




        </li><!-- End Dashboard Nav -->
        <li class="list-group-item">
            <!-- Default Accordion -->
            <div class="accordion" id="accordionExample">
                <div class="accordion-item bg-dark text-white"
                    style="border-top: 1px solid #444; border-bottom: 1px solid #444; border-left: none; border-right: none;">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button bg-dark-full text-white" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                            aria-controls="collapseOne"
                            style="border-left: none; border-right: none; border-bottom: 1px solid #444;">
                            Daftar Modul
                        </button>
                    </h2>

                    <style>
                        .modul-item {
                            background-color: #222;
                            /* Warna dasar */
                            color: white;
                            cursor: pointer;
                            border-left: none;
                            border-right: none;
                            border-bottom: 1px solid #444;
                            transition: background 0.3s ease-in-out;
                        }

                        .modul-item:hover {
                            background-color: #11111165;
                        }

                        .list-group-item.active {
                            background-color: #ac43e4 !important;
                            /* Warna latar belakang untuk modul aktif */
                            color: white !important;
                            /* Warna teks */
                            font-weight: bold;
                            /* Membuat teks lebih tebal */
                        }
                    </style>

                    <div id="collapseOne" class="accordion-collapse collapse show text-white"
                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <ul class="list-group list-group-flush">
                            @foreach ($moduls as $modul)
                                <li class="list-group-item modul-item {{ isset($showModul->slug) && $modul->slug == $showModul->slug ? 'active' : '' }}"
                                    onclick="window.location='{{ route('modul.view', ['slug' => $kelas->slug, 'slug_modul' => $modul->slug]) }}'">
                                    {{ $modul->judul }}
                                </li>
                            @endforeach
                        </ul>
                    </div>



                </div>
            </div>
        </li><!-- End Dashboard Nav -->

    </ul>

</div><!-- End Sidebar-->
