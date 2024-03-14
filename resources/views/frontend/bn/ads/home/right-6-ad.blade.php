{{-- Position 16 = Home Page Right Six Ad --}}
@php
    $homeRightSixAd = Cache::get('homePageAdsCacheKey')->where('position', 16)->first();

    $hasHomeRightSixAdTime = true;
    if ($homeRightSixAd && $homeRightSixAd->start_time && $homeRightSixAd->end_time && !\Carbon\Carbon::now()->between($homeRightSixAd->start_time, $homeRightSixAd->end_time)){
        $hasHomeRightSixAdTime = false;
    }
@endphp

@if($homeRightSixAd && $hasHomeRightSixAdTime)

    <div class="marginBottom10 {{ $homeRightSixAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $homeRightSixAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($homeRightSixAd->type == 3)
                <a href="{{ $homeRightSixAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$homeRightSixAd->desktop_image_path) }}" alt="Home Right Six Ad">
                </a>
            @else
                {!! $homeRightSixAd->code !!}
            @endif
        </div>
    </div>
@endif
