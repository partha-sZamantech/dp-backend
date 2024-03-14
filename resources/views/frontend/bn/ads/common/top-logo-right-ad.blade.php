{{-- Position 2 = Top Logo Right Ad --}}
@php
    $topLogoRightAd = Cache::get('commonAdsCacheKey')->where('position', 2)->first();

    $hasLogoRightAdTime = true;
    if ($topLogoRightAd && $topLogoRightAd->start_time && $topLogoRightAd->end_time && !\Carbon\Carbon::now()->between($topLogoRightAd->start_time, $topLogoRightAd->end_time)){
        $hasLogoRightAdTime = false;
    }
@endphp

@if($topLogoRightAd && $hasLogoRightAdTime)
    {{-- Show only on Desktop --}}
    @if($topLogoRightAd->type == 3)
        <a href="{{ $topLogoRightAd->external_link }}" target="_blank" rel="nofollow">
            <img src="{{ asset(config('appconfig.adPath').$topLogoRightAd->desktop_image_path) }}" width="728" height="90" alt="Logo Right Ad">
        </a>
    @else
        {!! $topLogoRightAd->code !!}
    @endif
@endif