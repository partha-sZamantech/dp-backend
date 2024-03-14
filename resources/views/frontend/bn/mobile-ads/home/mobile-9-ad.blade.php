{{-- Mobile Home 9 ad --}}
@php
    $mobileHomeNineAd = Cache::get('mobileHomePageAdsCacheKey')->where('position', 9)->first();

    $hasMobileHomeNineAdTime = true;
    if ($mobileHomeNineAd && $mobileHomeNineAd->start_time && $mobileHomeNineAd->end_time && !\Carbon\Carbon::now()->between($mobileHomeNineAd->start_time, $mobileHomeNineAd->end_time)){
        $hasMobileHomeNineAdTime = false;
    }
@endphp

@if($mobileHomeNineAd && $hasMobileHomeNineAdTime)
    <div class="mobile-home-ad-9 marginTop15 marginBottom20 {{ $mobileHomeNineAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $mobileHomeNineAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($mobileHomeNineAd->type == 3)
                <a href="{{ $mobileHomeNineAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$mobileHomeNineAd->mobile_image_path) }}" alt="Mobile Nine Ad">
                </a>
            @else
                {!! $mobileHomeNineAd->code !!}
            @endif
        </div>
    </div>
@endif
