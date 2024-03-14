{{-- 1 = Header Top Banner --}}
@php
    $topBannerAd = Cache::get('commonAdsCacheKey')->where('position', 1)->first();

    $hasTopBannerAdTime = true;
    if ($topBannerAd && $topBannerAd->start_time && $topBannerAd->end_time && !\Carbon\Carbon::now()->between($topBannerAd->start_time, $topBannerAd->end_time)){
        $hasTopBannerAdTime = false;
    }

    $middleOneAd = Cache::get('homePageAdsCacheKey')->where('position', 1)->first();
    $hasMiddleOneAdTime = true;
    if ($middleOneAd && $middleOneAd->start_time && $middleOneAd->end_time && !\Carbon\Carbon::now()->between($middleOneAd->start_time, $middleOneAd->end_time)){
        $hasMiddleOneAdTime = false;
    }
@endphp

@if($topBannerAd && $hasTopBannerAdTime)
    <div class="container header-container">
        @if($topBannerAd->type != 4)
            <div class="header-ad" style="display: flex; justify-content: center; margin: 10px 0;">
                @else
                    <div class="header-ad">
                        @endif
                        <div class="{{ $topBannerAd->type != 4 ? 'ad-box' : '' }}">
                            {{-- Type 1=DFP, 2=Code, 3=Image --}}
                            @if($topBannerAd->type == 3)
                                <a href="{{ $topBannerAd->external_link }}" target="_blank" rel="nofollow">
                                    <img src="{{ asset(config('appconfig.adPath').$topBannerAd->desktop_image_path) }}" alt="Header Ad">
                                </a>
                            @else
                                {!! $topBannerAd->code !!}
                            @endif
                        </div>

                        {{--<div class="visible-xs {{ $topBannerAd->type != 4 ? 'ad-box' : '' }}">
--}}{{--                             Type 1=DFP, 2=Code, 3=Image --}}{{--
                            @if($topBannerAd->type == 3)
                                <a href="{{ $topBannerAd->external_link }}" target="_blank" rel="nofollow">
                                    <img src="{{ asset(config('appconfig.adPath').$topBannerAd->mobile_image_path) }}" alt="Header Ad" style="width: 100%">
                                </a>
                            @else
                                {!! $topBannerAd->code !!}
                            @endif
                        </div>--}}
                    </div>
            </div>
        @else
            @if($hasMiddleOneAdTime)
                <style>
                    @media screen and (max-width: 767px) {
                        header {
                            display: inline-block !important;
                            width: 100%;
                            position: absolute;
                        }

                        .main-content {
                            padding-top: 60px !important;
                        }
                    }
                </style>
@endif

{{--    <div class="marginTop15 text-center advertisement">
        <div class="hidden-sm hidden-xs ad-box">
            <iframe id="serviceFrameSend" src="{{ asset(config('appconfig.adPath')."sara_728x90/index.html") }}"  frameborder="0" style="width: 728px; height: 90px"></iframe>
        </div>
        <div class="hidden-md hidden-lg ad-box">
            <iframe id="serviceFrameSend" src="{{ asset(config('appconfig.adPath')."sara_300x250/index.html") }}"  frameborder="0" style="width: 300px; height: 250px"></iframe>
        </div>
    </div>--}}
@endif