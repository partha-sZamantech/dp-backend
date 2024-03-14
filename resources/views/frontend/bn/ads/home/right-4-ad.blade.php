{{-- Position 14 = Home Page Right Four Ad --}}
@php
    $homeRightFourAd = Cache::get('homePageAdsCacheKey')->where('position', 14)->first();

    $hasHomeRightFourAdTime = true;
    if ($homeRightFourAd && $homeRightFourAd->start_time && $homeRightFourAd->end_time && !\Carbon\Carbon::now()->between($homeRightFourAd->start_time, $homeRightFourAd->end_time)){
        $hasHomeRightFourAdTime = false;
    }
@endphp

@if($homeRightFourAd && $hasHomeRightFourAdTime)

    <div class="{{--hidden-sm hidden-xs --}}marginBottom10 {{ $homeRightFourAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $homeRightFourAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($homeRightFourAd->type == 3)
                <a href="{{ $homeRightFourAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$homeRightFourAd->desktop_image_path) }}" alt="Home Right Four Ad">
                </a>
            @else
                {!! $homeRightFourAd->code !!}
            @endif
        </div>
    </div>
@endif
