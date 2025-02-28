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

    {{-- 📌 Tabel untuk Modul Tanpa Sub Kelas --}}
    @php
        $modul_tanpa_sub_kelas = $kelas->moduls->whereNull('sub_kelas')->merge($kelas->moduls->where('sub_kelas', ''));
    @endphp
    @if ($modul_tanpa_sub_kelas->count() > 0)
        <table class="table" style="border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 1px solid #444;">
                    <td colspan="3" class="bg-dark-full text-white p-3 fw-bold">Daftar Modul</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($modul_tanpa_sub_kelas as $modul)
                    @php
                        $modul_terlihat = json_decode($look->modul, true) ?? [];
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
                        <td class="bg-dark text-end">
                            <a href="{{ route('modul.view', ['slug' => $kelas->slug, 'slug_modul' => $modul->slug]) }}"
                                class="btn btn-sm {{ $is_seen ? 'btn-dark' : 'btn-main' }} fw-bold">
                                {{ $is_seen ? 'View' : 'Start' }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- 📌 Tabel untuk Modul Berdasarkan Sub Kelas --}}
    @foreach (json_decode($kelas->sub_kelas, true) ?? [] as $sub_kelas)
        @php
            $moduls_in_sub_kelas = $kelas->moduls->where('sub_kelas', $sub_kelas);
        @endphp
        @if ($moduls_in_sub_kelas->count() > 0)
            <table class="table" style="border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #444;">
                        <td colspan="3" class="bg-dark-full text-white p-3 fw-bold">{{ $sub_kelas }}</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($moduls_in_sub_kelas as $modul)
                        @php
                            $modul_terlihat = json_decode($look->modul, true) ?? [];
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
                            <td class="bg-dark text-end">
                                <a href="{{ route('modul.view', ['slug' => $kelas->slug, 'slug_modul' => $modul->slug]) }}"
                                    class="btn btn-sm {{ $is_seen ? 'btn-dark' : 'btn-main' }} fw-bold">
                                    {{ $is_seen ? 'View' : 'Start' }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endforeach
@endsection
