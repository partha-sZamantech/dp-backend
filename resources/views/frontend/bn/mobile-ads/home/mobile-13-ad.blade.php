{{-- Position 17 = Home Page Right Seven Ad --}}
@php
    $mobileHomeThirteenAd = Cache::get('mobileHomePageAdsCacheKey')->where('position', 13)->first();

    $hasMobileHomeThirteenAdTime = true;
    if ($mobileHomeThirteenAd && $mobileHomeThirteenAd->start_time && $mobileHomeThirteenAd->end_time && !\Carbon\Carbon::now()->between($mobileHomeThirteenAd->start_time, $mobileHomeThirteenAd->end_time)){
        $hasMobileHomeThirteenAdTime = false;
    }
@endphp

@if($mobileHomeThirteenAd && $hasMobileHomeThirteenAdTime)
    <div class="hidden-md hidden-lg marginTop15 marginBottom20 {{ $mobileHomeThirteenAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $mobileHomeThirteenAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($mobileHomeThirteenAd->type == 3)
                <a href="{{ $mobileHomeThirteenAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$mobileHomeThirteenAd->mobile_image_path) }}" alt="Mobile Thirteen Ad">
                </a>
            @else
                {!! $mobileHomeThirteenAd->code !!}
            @endif
        </div>
    </div>
@endif
