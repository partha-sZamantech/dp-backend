{{-- Mobile Home 12 Ad --}}
@php
    $mobileHomeTwelveAd = Cache::get('mobileHomePageAdsCacheKey')->where('position', 12)->first();

    $hasMobileHomeTwelveAdTime = true;
    if ($mobileHomeTwelveAd && $mobileHomeTwelveAd->start_time && $mobileHomeTwelveAd->end_time && !\Carbon\Carbon::now()->between($mobileHomeTwelveAd->start_time, $mobileHomeTwelveAd->end_time)){
        $hasMobileHomeTwelveAdTime = false;
    }
@endphp

@if($mobileHomeTwelveAd && $hasMobileHomeTwelveAdTime)
    <div class="mobile-home-ad-12 marginTop15 marginBottom20 {{ $mobileHomeTwelveAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $mobileHomeTwelveAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($mobileHomeTwelveAd->type == 3)
                <a href="{{ $mobileHomeTwelveAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$mobileHomeTwelveAd->mobile_image_path) }}" alt="Mobile Twelve Ad">
                </a>
            @else
                {!! $mobileHomeTwelveAd->code !!}
            @endif
        </div>
    </div>
@endif
