{{-- Mobile Home 11 Ad --}}
@php
    $mobileHomeElevenAd = Cache::get('mobileHomePageAdsCacheKey')->where('position', 11)->first();

    $hasMobileHomeElevenAdTime = true;
    if ($mobileHomeElevenAd && $mobileHomeElevenAd->start_time && $mobileHomeElevenAd->end_time && !\Carbon\Carbon::now()->between($mobileHomeElevenAd->start_time, $mobileHomeElevenAd->end_time)){
        $hasMobileHomeElevenAdTime = false;
    }
@endphp

@if($mobileHomeElevenAd && $hasMobileHomeElevenAdTime)
    <div class="mobile-home-ad-11 marginTop15 marginBottom20 {{ $mobileHomeElevenAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $mobileHomeElevenAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($mobileHomeElevenAd->type == 3)
                <a href="{{ $mobileHomeElevenAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$mobileHomeElevenAd->mobile_image_path) }}" alt="Mobile Eleven Ad">
                </a>
            @else
                {!! $mobileHomeElevenAd->code !!}
            @endif
        </div>
    </div>
@endif
