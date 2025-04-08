@component('mail::message')

{{-- Logo atau Nama Domain --}}


# Verifikasi Email

Klik tombol di bawah untuk verifikasi email kamu.

@component('mail::button', ['url' => $url])
Verifikasi Sekarang
@endcomponent

Jika tombol di atas tidak berfungsi, salin dan tempel link di bawah ini ke browser kamu:

[{{ $url }}]({{ $url }})

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
