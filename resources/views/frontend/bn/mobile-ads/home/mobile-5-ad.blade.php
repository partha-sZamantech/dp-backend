{{-- Mobile 5 Ad - home page --}}
@php
    $mobileHomeFiveAd = Cache::get('mobileHomePageAdsCacheKey')->where('position', 5)->first();

    $hasMobileHomeFiveAdTime = true;
    if ($mobileHomeFiveAd && $mobileHomeFiveAd->start_time && $mobileHomeFiveAd->end_time && !\Carbon\Carbon::now()->between($mobileHomeFiveAd->start_time, $mobileHomeFiveAd->end_time)){
        $hasMobileHomeFiveAdTime = false;
    }
@endphp

@if($mobileHomeFiveAd && $hasMobileHomeFiveAdTime)
    <div class="mobile-home-ad-5 marginTop15 marginBottom20 {{ $mobileHomeFiveAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $mobileHomeFiveAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($mobileHomeFiveAd->type == 3)
                <a href="{{ $mobileHomeFiveAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$mobileHomeFiveAd->mobile_image_path) }}" alt="Mobile Five Ad">
                </a>
            @else
                {!! $mobileHomeFiveAd->code !!}
            @endif
        </div>
    </div>
@endif
