{{-- Position 15 = Home Page Right Five Ad --}}
@php
    $homeRightFiveAd = Cache::get('homePageAdsCacheKey')->where('position', 15)->first();

    $hasHomeRightFiveAdTime = true;
    if ($homeRightFiveAd && $homeRightFiveAd->start_time && $homeRightFiveAd->end_time && !\Carbon\Carbon::now()->between($homeRightFiveAd->start_time, $homeRightFiveAd->end_time)){
        $hasHomeRightFiveAdTime = false;
    }
@endphp

@if($homeRightFiveAd && $hasHomeRightFiveAdTime)

    <div class="marginBottom10 {{ $homeRightFiveAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $homeRightFiveAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($homeRightFiveAd->type == 3)
                <a href="{{ $homeRightFiveAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$homeRightFiveAd->desktop_image_path) }}" alt="Home Right Five Ad">
                </a>
            @else
                {!! $homeRightFiveAd->code !!}
            @endif
        </div>
    </div>
@endif
