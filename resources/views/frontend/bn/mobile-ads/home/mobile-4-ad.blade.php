{{-- Mobile Four Ad - Home page --}}
@php
    $mobileHomeFourAd = Cache::get('mobileHomePageAdsCacheKey')->where('position', 4)->first();

    $hasMobileHomeFourAdTime = true;
    if ($mobileHomeFourAd && $mobileHomeFourAd->start_time && $mobileHomeFourAd->end_time && !\Carbon\Carbon::now()->between($mobileHomeFourAd->start_time, $mobileHomeFourAd->end_time)){
        $hasMobileHomeFourAdTime = false;
    }
@endphp

@if($mobileHomeFourAd && $hasMobileHomeFourAdTime)
    <div class="mobile-home-ad-4 marginTop15 {{ $mobileHomeFourAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $mobileHomeFourAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($mobileHomeFourAd->type == 3)
                <a href="{{ $mobileHomeFourAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$mobileHomeFourAd->mobile_image_path) }}" alt="Home Right One Ad">
                </a>
            @else
                {!! $mobileHomeFourAd->code !!}
            @endif
        </div>
    </div>
@endif
