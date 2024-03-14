{{-- Position 10 = Home Page Right One Ad --}}
@php
    $homeRightOneAd = Cache::get('homePageAdsCacheKey')->where('position', 11)->first();

    $hasHomeRightOneAdTime = true;
    if ($homeRightOneAd && $homeRightOneAd->start_time && $homeRightOneAd->end_time && !\Carbon\Carbon::now()->between($homeRightOneAd->start_time, $homeRightOneAd->end_time)){
        $hasHomeRightOneAdTime = false;
    }
@endphp

@if($homeRightOneAd && $hasHomeRightOneAdTime)
    <div class="marginBottom20">
        <div class="{{ $homeRightOneAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($homeRightOneAd->type == 3)
                <a href="{{ $homeRightOneAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$homeRightOneAd->desktop_image_path) }}" alt="Home Right One Ad">
                </a>
            @else
                {!! $homeRightOneAd->code !!}
            @endif
        </div>
    </div>
{{--@else
    <div class="marginBottom20 text-center advertisement">
        --}}{{--<div class="hidden-sm hidden-xs ad-box">
            <iframe id="serviceFrameSend" src="{{ asset(config('appconfig.adPath')."sara_728x90/index.html") }}"  frameborder="0" style="width: 728px; height: 90px"></iframe>
        </div>--}}{{--
        <div class="ad-box">
            <iframe id="serviceFrameSend" src="{{ asset(config('appconfig.adPath')."sara_300x250/index.html") }}"  frameborder="0" style="width: 300px; height: 250px"></iframe>
        </div>
    </div>--}}
@endif
