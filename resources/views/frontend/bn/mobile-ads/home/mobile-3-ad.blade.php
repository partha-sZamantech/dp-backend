{{-- Mobile Home 3 Ad --}}
@php
    $mobileHomeThreeAd = Cache::get('mobileHomePageAdsCacheKey')->where('position', 3)->first();

    $hasMobileHomeThreeAdTime = true;
    if ($mobileHomeThreeAd && $mobileHomeThreeAd->start_time && $mobileHomeThreeAd->end_time && !\Carbon\Carbon::now()->between($mobileHomeThreeAd->start_time, $mobileHomeThreeAd->end_time)){
        $hasMobileHomeThreeAdTime = false;
    }
@endphp

@if($mobileHomeThreeAd && $hasMobileHomeThreeAdTime)
    <div class="mobile-home-ad-3 marginTop15 marginBottom20 {{ $mobileHomeThreeAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $mobileHomeThreeAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($mobileHomeThreeAd->type == 3)
                <a href="{{ $mobileHomeThreeAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$mobileHomeThreeAd->mobile_image_path) }}" alt="Home Right One Ad">
                </a>
            @else
                {!! $mobileHomeThreeAd->code !!}
            @endif
        </div>
    </div>
@endif
