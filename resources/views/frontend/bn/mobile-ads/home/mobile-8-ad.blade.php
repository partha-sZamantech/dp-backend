{{-- Mobile Home 8 Ad --}}
@php
    $mobileHomeEightAd = Cache::get('mobileHomePageAdsCacheKey')->where('position', 8)->first();

    $hasMobileHomeEightAdTime = true;
    if ($mobileHomeEightAd && $mobileHomeEightAd->start_time && $mobileHomeEightAd->end_time && !\Carbon\Carbon::now()->between($mobileHomeEightAd->start_time, $mobileHomeEightAd->end_time)){
        $hasMobileHomeEightAdTime = false;
    }
@endphp

@if($mobileHomeEightAd && $hasMobileHomeEightAdTime)
    <div class="mobile-home-ad-8 marginTop15 marginBottom20 {{ $mobileHomeEightAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $mobileHomeEightAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($mobileHomeEightAd->type == 3)
                <a href="{{ $mobileHomeEightAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$mobileHomeEightAd->mobile_image_path) }}" alt="Mobile Eight Ad">
                </a>
            @else
                {!! $mobileHomeEightAd->code !!}
            @endif
        </div>
    </div>
@endif
