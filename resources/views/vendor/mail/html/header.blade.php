@props(['url'])

<tr>
<td class="header">
    <a href="{{ $url }}" style="display: inline-block; text-align: center;">
        @php
            $logo = profil_web()->logo ?? null;
            $logoPath = $logo ? public_path($logo) : null;
        @endphp

        @if ($logo && file_exists($logoPath))
            <img src="{{ asset($logo) }}" class="logo" alt="{{ config('app.name') }}" style="max-height: 60px;">
        @elseif(trim($slot))
             {{ config('app.name') }}
        @else
            {{ config('app.name') }}
        @endif
    </a>
</td>
</tr>
