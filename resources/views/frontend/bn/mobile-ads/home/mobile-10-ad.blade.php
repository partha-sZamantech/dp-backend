{{-- Position 15 = Home Page Right Five Ad --}}
@php
    $mobileHomeTenAd = Cache::get('mobileHomePageAdsCacheKey')->where('position', 10)->first();

    $hasMobileHomeTenAdTime = true;
    if ($mobileHomeTenAd && $mobileHomeTenAd->start_time && $mobileHomeTenAd->end_time && !\Carbon\Carbon::now()->between($mobileHomeTenAd->start_time, $mobileHomeTenAd->end_time)){
        $hasMobileHomeTenAdTime = false;
    }
@endphp

{{--@if($mobileHomeTenAd && $hasMobileHomeTenAdTime)--}}
@if($mobileHomeTenAd)
    <div class="hidden-md hidden-lg marginTop15 {{ $mobileHomeTenAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $mobileHomeTenAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}

            @if($mobileHomeTenAd->type == 3)
                <a href="{{ $mobileHomeTenAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$mobileHomeTenAd->mobile_image_path) }}" alt="Mobile Ten Ad">

                </a>
            @else
                {!! $mobileHomeTenAd->code !!}
            @endif
        </div>
    </div>
@endif
