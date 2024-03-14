{{-- Position 16 = Home Page Right Seven Ad --}}
@php
    $homeRightSevenAd = Cache::get('homePageAdsCacheKey')->where('position', 17)->first();

    $hasHomeRightSevenAdTime = true;
    if ($homeRightSevenAd && $homeRightSevenAd->start_time && $homeRightSevenAd->end_time && !\Carbon\Carbon::now()->between($homeRightSevenAd->start_time, $homeRightSevenAd->end_time)){
        $hasHomeRightSevenAdTime = false;
    }
@endphp

@if($homeRightSevenAd && $hasHomeRightSevenAdTime)

    <div class="advertisement marginBottom20">
        <div class="hidden-sm hidden-xs ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($homeRightSevenAd->type == 3)
                <a href="{{ $homeRightSevenAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$homeRightSevenAd->desktop_image_path) }}" alt="Home Four Seven Ad">
                </a>
            @else
                {!! $homeRightSevenAd->code !!}
            @endif
        </div>

        <div class="hidden-md hidden-lg ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($homeRightSevenAd->type == 3)
                <a href="{{ $homeRightSevenAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$homeRightSevenAd->mobile_image_path) }}" alt="Home Right Seven Ad">
                </a>
            @else
                {!! $homeRightSevenAd->code !!}
            @endif
        </div>
    </div>
@endif
