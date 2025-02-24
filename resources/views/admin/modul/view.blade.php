@extends('admin.layouts.main')

@section('content')
    <a href="/kelas/{{ $kelas_id }}"><i class="bi bi-arrow-left"></i> Kembali</a>
    <p>Judul : {{ $video->judul }}</p>
    {{-- <video id="player" playsinline controls data-poster="/path/to/poster.jpg" width="70%" height="500">
        <source src="{{ URL::signedRoute('video.secure', ['filename' => substr($video->video, 6)]) }}" type="video/mp4" />
    </video> --}}

    <iframe src="{{ $video->video }}?watermark={{ urlencode(env('BUNNY_STREAM_WATERMARK_URL')) }}" width="100%"
        height="500" allow="autoplay; fullscreen" frameborder="0" allowfullscreen>
    </iframe>


    <script>
        const player = new Plyr('#player');
    </script>
@endsection
