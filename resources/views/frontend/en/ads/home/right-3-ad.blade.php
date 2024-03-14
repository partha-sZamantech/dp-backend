{{-- Position 12 = Home Page Right Three Ad --}}
@php
    $homeRightThreeAd = Cache::get('homePageAdsCacheKey')->where('position', 13)->first();

    $hasHomeRightThreeAdTime = true;
    if ($homeRightThreeAd && $homeRightThreeAd->start_time && $homeRightThreeAd->end_time && !\Carbon\Carbon::now()->between($homeRightThreeAd->start_time, $homeRightThreeAd->end_time)){
        $hasHomeRightThreeAdTime = false;
    }
@endphp

@if($homeRightThreeAd && $hasHomeRightThreeAdTime)

    <div class="advertisement marginBottom20">
        <div class="hidden-sm hidden-xs ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($homeRightThreeAd->type == 3)
                <a href="{{ $homeRightThreeAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$homeRightThreeAd->desktop_image_path) }}" alt="Home Right Three Ad">
                </a>
            @else
                {!! $homeRightThreeAd->code !!}
            @endif
        </div>

        <div class="hidden-md hidden-lg ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($homeRightThreeAd->type == 3)
                <a href="{{ $homeRightThreeAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$homeRightThreeAd->mobile_image_path) }}" alt="Home Right Three Ad">
                </a>
            @else
                {!! $homeRightThreeAd->code !!}
            @endif
        </div>
    </div>
@endif
