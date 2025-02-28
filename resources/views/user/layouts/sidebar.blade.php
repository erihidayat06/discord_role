<div class="container">
    <ul class=" d-md-none p-0" style="margin-top: 70px">
        <li class="list-group-item">
            <a class="nav-link p-2 text-white fw-bold {{ Request::is('kursus') && !request('nama_kategori') ? 'active' : '' }}"
                href="/kursus">
                <span>New & For You</span>
            </a>
        </li>
        <li class="list-group-item">
            <a class=" nav-link text-white p-2 {{ Request::is('kursus') && request('nama_kategori') == 'All Classes' ? 'active' : '' }}"
                href="/kursus?nama_kategori=All Classes">
                <span>All Classes</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <hr>

        @foreach (kategori() as $kategori)
            <li class="list-group-item mt-3">
                <a class="nav-link text-white p-2 {{ Request::is('kursus') && request('kategori') == $kategori->id ? 'active' : '' }}"
                    href="/kursus?kategori={{ $kategori->id }}&nama_kategori={{ $kategori->nm_kategori }}">
                    <span>{{ $kategori->nm_kategori }}</span>
                </a>
            </li><!-- End Dashboard Nav -->
        @endforeach
    </ul>
</div>

<style>
    .sidebar {
        width: 400px !important;
    }

    @media (max-width: 1199px) {
        .sidebar {
            left: -400px !important;
        }
    }

    .nav-link.active {
        background-color: #1a1c21 !important;
        /* Warna abu-abu */
        color: white !important;
        border-radius: 50px;
    }
</style>
<!-- ======= Sidebar ======= -->
<div class="sidebar bg-dark-main text-white">


    <ul class="nav flex-column">
        <li class="list-group-item">
            <a class="nav-link text-white fw-bold {{ Request::is('kursus') && !request('nama_kategori') ? 'active' : '' }}"
                href="/kursus">
                <span>New & For You</span>
            </a>
        </li>
        <li class="list-group-item">
            <a class="nav-link text-white fw-bold {{ Request::is('kursus') && request('nama_kategori') == 'All Classes' ? 'active' : '' }}"
                href="/kursus?nama_kategori=All Classes">
                <span>All Classes</span>
            </a>
        </li>

        <hr>
        @foreach (kategori() as $kategori)
            <li class="list-group-item mt-3">
                <a class="nav-link text-white fw-bold {{ Request::is('kursus') && request('kategori') == $kategori->id ? 'active' : '' }}"
                    href="/kursus?kategori={{ $kategori->id }}&nama_kategori={{ $kategori->nm_kategori }}">
                    <span>{{ $kategori->nm_kategori }}</span>
                </a>
            </li>
        @endforeach
    </ul>


</div><!-- End Sidebar-->
