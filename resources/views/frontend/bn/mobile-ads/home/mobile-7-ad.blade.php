{{-- Mobile Home 7 Ad - home page --}}
@php
    $mobileHomeSevenAd = Cache::get('mobileHomePageAdsCacheKey')->where('position', 7)->first();

    $hasMobileHomeSevenAdTime = true;
    if ($mobileHomeSevenAd && $mobileHomeSevenAd->start_time && $mobileHomeSevenAd->end_time && !\Carbon\Carbon::now()->between($mobileHomeSevenAd->start_time, $mobileHomeSevenAd->end_time)){
        $hasMobileHomeSevenAdTime = false;
    }
@endphp

@if($mobileHomeSevenAd && $hasMobileHomeSevenAdTime)
    <div class="mobile-home-ad-7 marginTop15 marginBottom20 {{ $mobileHomeSevenAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $mobileHomeSevenAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($mobileHomeSevenAd->type == 3)
                <a href="{{ $mobileHomeSevenAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$mobileHomeSevenAd->mobile_image_path) }}" alt="Mobile Seven Ad">
                </a>
            @else
                {!! $mobileHomeSevenAd->code !!}
            @endif
        </div>
    </div>
@endif
