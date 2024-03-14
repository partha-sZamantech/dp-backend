{{-- Position 13 = Home Page Right Four Ad --}}
@php
    $homeRightFourAd = Cache::get('homePageAdsCacheKey')->where('position', 14)->first();

    $hasHomeRightFourAdTime = true;
    if ($homeRightFourAd && $homeRightFourAd->start_time && $homeRightFourAd->end_time && !\Carbon\Carbon::now()->between($homeRightFourAd->start_time, $homeRightFourAd->end_time)){
        $hasHomeRightFourAdTime = false;
    }
@endphp

@if($homeRightFourAd && $hasHomeRightFourAdTime)

    <div class="advertisement marginBottom20">
        <div class="hidden-sm hidden-xs ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($homeRightFourAd->type == 3)
                <a href="{{ $homeRightFourAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$homeRightFourAd->desktop_image_path) }}" alt="Home Four Three Ad">
                </a>
            @else
                {!! $homeRightFourAd->code !!}
            @endif
        </div>

        <div class="hidden-md hidden-lg ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($homeRightFourAd->type == 3)
                <a href="{{ $homeRightFourAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$homeRightFourAd->mobile_image_path) }}" alt="Home Right Four Ad">
                </a>
            @else
                {!! $homeRightFourAd->code !!}
            @endif
        </div>
    </div>
@endif
