{{-- 2 = Middle One Ad - home page --}}
@php
    $mobileHomeTwoAd = Cache::get('mobileHomePageAdsCacheKey')->where('position', 2)->first();

    $hasMobileHomeTwoAdTime = true;
    if ($mobileHomeTwoAd && $mobileHomeTwoAd->start_time && $mobileHomeTwoAd->end_time && !\Carbon\Carbon::now()->between($mobileHomeTwoAd->start_time, $mobileHomeTwoAd->end_time)){
        $hasMobileHomeTwoAdTime = false;
    }
@endphp

@if($mobileHomeTwoAd && $hasMobileHomeTwoAdTime)
    <div class="mobile-home-ad-2 marginTop15 {{ $mobileHomeTwoAd->type != 4 ? 'advertisement' : '' }}">
        @if($mobileHomeTwoAd->type != 4)
        <div class="header-ad" style="display: flex; justify-content: center;">
            @endif
            <div class="{{ $mobileHomeTwoAd->type != 4 ? 'ad-box' : '' }}">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($mobileHomeTwoAd->type == 3)
                    <a href="{{ $mobileHomeTwoAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$mobileHomeTwoAd->mobile_image_path) }}" alt="Middle One Ad">
                    </a>
                @else
                    {!! $mobileHomeTwoAd->code !!}
                @endif
            </div>
            @if($mobileHomeTwoAd->type != 4)
        </div>
            @endif
    </div>
@endif
