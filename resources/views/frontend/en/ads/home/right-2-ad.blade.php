{{-- Position 11 = Home Page Right Two Ad --}}
@php
    $homeRightTwoAd = Cache::get('homePageAdsCacheKey')->where('position', 12)->first();

    $hasHomeRightTwoAdTime = true;
    if ($homeRightTwoAd && $homeRightTwoAd->start_time && $homeRightTwoAd->end_time && !\Carbon\Carbon::now()->between($homeRightTwoAd->start_time, $homeRightTwoAd->end_time)){
        $hasHomeRightTwoAdTime = false;
    }
@endphp

@if($homeRightTwoAd && $hasHomeRightTwoAdTime)

    <div class="advertisement marginBottom20">
        <div class="hidden-sm hidden-xs ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($homeRightTwoAd->type == 3)
                <a href="{{ $homeRightTwoAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$homeRightTwoAd->desktop_image_path) }}" alt="Home Right Two Ad">
                </a>
            @else
                {!! $homeRightTwoAd->code !!}
            @endif
        </div>

        <div class="hidden-md hidden-lg ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($homeRightTwoAd->type == 3)
                <a href="{{ $homeRightTwoAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$homeRightTwoAd->mobile_image_path) }}" alt="Home Right Two Ad">
                </a>
            @else
                {!! $homeRightTwoAd->code !!}
            @endif
        </div>
    </div>
@endif
