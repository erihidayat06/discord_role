@extends('user.layouts_modul.main')

@section('content')
    <p class="text-secondary">{{ count($kelas->moduls) }} Lessons</p>

    <p>Course Curriculum</p>

    <style>
        .table tbody tr {
            cursor: pointer;
            transition: background-color 0.3s;
            display: table-row;
        }

        .table tbody tr:hover td {
            background-color: #11111165 !important;
        }
    </style>

    <table class="table" style="border-collapse: collapse;">
        <thead>
            <tr style="border-bottom: 1px solid #444;">
                <td colspan="3" class="bg-dark-full text-white">
                    <h5 class="fw-bold mt-2">Daftar Modul</h5>
                </td>
            </tr>
        </thead>
        <tbody>

            @foreach ($kelas->moduls as $modul)
                @php
                    $modul_terlihat = json_decode($look->modul, true) ?? [];

                    // Jika `modul_terlihat` berisi array dengan indeks 0 dan memiliki key 'modul'
                    $modul_list = isset($modul_terlihat[0]['modul']) ? $modul_terlihat[0]['modul'] : [];

                    $is_seen = in_array($modul->slug, $modul_list);
                @endphp




                <tr style="border-bottom: 1px solid #444;"
                    onclick="window.location='{{ route('modul.view', ['slug' => $kelas->slug, 'slug_modul' => $modul->slug]) }}'">

                    <td class="bg-dark text-secondary fw-bold" style="width: 20px">
                        <i class="bi {{ $is_seen ? 'bi-check-circle-fill' : 'bi-play-circle' }} ms-2"></i>
                    </td>
                    <td class="bg-dark text-secondary fw-bold">

                        <i class="bi bi-play-circle-fill"></i>
                        <span class="ms-2">{{ $modul->judul }}</span>
                    </td>
                    <td class="bg-dark   text-end">
                        <a href="{{ route('modul.view', ['slug' => $kelas->slug, 'slug_modul' => $modul->slug]) }}"
                            class="btn btn-sm  {{ $is_seen ? 'btn-dark' : 'btn-main' }} fw-bold">
                            {{ $is_seen ? 'View' : 'Start' }}
                        </a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
