{{-- Mobile 6 ad - Home page --}}
@php
    $mobileHomeSixAd = Cache::get('mobileHomePageAdsCacheKey')->where('position', 6)->first();

    $hasMobileHomeSixAdTime = true;
    if ($mobileHomeSixAd && $mobileHomeSixAd->start_time && $mobileHomeSixAd->end_time && !\Carbon\Carbon::now()->between($mobileHomeSixAd->start_time, $mobileHomeSixAd->end_time)){
        $hasMobileHomeSixAdTime = false;
    }
@endphp

@if($mobileHomeSixAd && $hasMobileHomeSixAdTime)
    <div class="mobile-home-ad-6 marginTop15 marginBottom20 {{ $mobileHomeSixAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $mobileHomeSixAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($mobileHomeSixAd->type == 3)
                <a href="{{ $mobileHomeSixAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$mobileHomeSixAd->mobile_image_path) }}" alt="Mobile Six Ad">
                </a>
            @else
                {!! $mobileHomeSixAd->code !!}
            @endif
        </div>
    </div>
@endif
