{{-- Position 10 = Home Page Right One Ad --}}
@php
    $homeRightOneAd = Cache::get('homePageAdsCacheKey')->where('position', 11)->first();

    $hasHomeRightOneAdTime = true;
    if ($homeRightOneAd && $homeRightOneAd->start_time && $homeRightOneAd->end_time && !\Carbon\Carbon::now()->between($homeRightOneAd->start_time, $homeRightOneAd->end_time)){
        $hasHomeRightOneAdTime = false;
    }
@endphp

@if($homeRightOneAd && $hasHomeRightOneAdTime)

    <div class="advertisement marginTop20mobile marginBottom20">
        <div class="hidden-sm hidden-xs ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($homeRightOneAd->type == 3)
                <a href="{{ $homeRightOneAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$homeRightOneAd->desktop_image_path) }}" alt="Home Right One Ad">
                </a>
            @else
                {!! $homeRightOneAd->code !!}
            @endif
        </div>

        <div class="hidden-md hidden-lg ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($homeRightOneAd->type == 3)
                <a href="{{ $homeRightOneAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$homeRightOneAd->mobile_image_path) }}" alt="Home Right One Ad">
                </a>
            @else
                {!! $homeRightOneAd->code !!}
            @endif
        </div>
    </div>
@endif
