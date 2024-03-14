{{-- 2 = Middle One Ad - home page --}}
@php
    $middleOneAd = Cache::get('homePageAdsCacheKey')->where('position', 2)->first();

    $hasMiddleOneAdTime = true;
    if ($middleOneAd && $middleOneAd->start_time && $middleOneAd->end_time && !\Carbon\Carbon::now()->between($middleOneAd->start_time, $middleOneAd->end_time)){
        $hasMiddleOneAdTime = false;
    }
@endphp

@if($middleOneAd && $hasMiddleOneAdTime)
    <div class="hidden-sm hidden-xs marginBottom10 {{ $middleOneAd->type != 4 ? 'advertisement' : '' }}">
        @if($middleOneAd->type != 4)
        <div class="header-ad" style="display: flex; justify-content: center; margin: 0 0 10px 0;">
            @endif
            <div class="{{ $middleOneAd->type != 4 ? 'ad-box' : '' }}">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleOneAd->type == 3)
                    <a href="{{ $middleOneAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleOneAd->desktop_image_path) }}" alt="Middle One Ad">
                    </a>
                @else
                    {!! $middleOneAd->code !!}
                @endif
            </div>

            {{--<div class="hidden-md hidden-lg {{ $middleOneAd->type != 4 ? 'ad-box' : '' }}">
                --}}{{-- Type 1=DFP, 2=Code, 3=Image --}}{{--
                @if($middleOneAd->type == 3)
                    <a href="{{ $middleOneAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleOneAd->mobile_image_path) }}" alt="Middle One Ad">
                    </a>
                @else
                    {!! $middleOneAd->code !!}
                @endif
            </div>--}}
            @if($middleOneAd->type != 4)
        </div>
            @endif
    </div>
@endif