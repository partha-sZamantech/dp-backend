{{-- Position 14 = Home Page Right Five Ad --}}
@php
    $homeRightFiveAd = Cache::get('homePageAdsCacheKey')->where('position', 15)->first();

    $hasHomeRightFiveAdTime = true;
    if ($homeRightFiveAd && $homeRightFiveAd->start_time && $homeRightFiveAd->end_time && !\Carbon\Carbon::now()->between($homeRightFiveAd->start_time, $homeRightFiveAd->end_time)){
        $hasHomeRightFiveAdTime = false;
    }
@endphp

@if($homeRightFiveAd && $hasHomeRightFiveAdTime)

    <div class="advertisement marginBottom20">
        <div class="hidden-sm hidden-xs ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($homeRightFiveAd->type == 3)
                <a href="{{ $homeRightFiveAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$homeRightFiveAd->desktop_image_path) }}" alt="Home Four Five Ad">
                </a>
            @else
                {!! $homeRightFiveAd->code !!}
            @endif
        </div>

        <div class="hidden-md hidden-lg ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($homeRightFiveAd->type == 3)
                <a href="{{ $homeRightFiveAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$homeRightFiveAd->mobile_image_path) }}" alt="Home Right Five Ad">
                </a>
            @else
                {!! $homeRightFiveAd->code !!}
            @endif
        </div>
    </div>
@endif
