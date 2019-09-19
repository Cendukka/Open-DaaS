@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Terve!')
@endif
@endif

{{-- Intro Lines --}}
@lang(
    "Sait tämän sähköpostin, koska saimme pyynnön salasanan nollaukseen"

)
{{--@foreach ($introLines as $line)--}}
{{--{{ $line }}--}}

{{--@endforeach--}}

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@lang(
        "Tämä palautuslinkki toimii 60 min ajan. \n".
        "Jos et pyytänyt salasanan palautusta, voit poistaa tämän sähköpostin."
)
{{--@foreach ($outroLines as $line)--}}
{{--{{ $line }}--}}

{{--@endforeach--}}

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang(
        "Terveisin,\n".
        'IT-Tiimi, LSJH'
)
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "Jos sinulla on ongelmia \":actionText\" nappulan kanssa, voit painaa alla olevaa linkkiä tai \n".
    'kopioida ja liittää sen selaimen osoitekenttään: [:actionURL](:actionURL)',
    [
        'actionText' => $actionText,
        'actionURL' => $actionUrl,
    ]
)
@endslot
@endisset
@endcomponent
