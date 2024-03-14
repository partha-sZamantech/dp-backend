{{-- Position 7 = Middle 6 Ad - home page --}}
@php
    $mobileHomeForteenAd = Cache::get('mobileHomePageAdsCacheKey')->where('position', 14)->first();

    $hasMobileHomeForteenAdTime = true;
    if ($mobileHomeForteenAd && $mobileHomeForteenAd->start_time && $mobileHomeForteenAd->end_time && !\Carbon\Carbon::now()->between($mobileHomeForteenAd->start_time, $mobileHomeForteenAd->end_time)){
        $hasMobileHomeForteenAdTime = false;
    }
@endphp

@if($mobileHomeForteenAd && $hasMobileHomeForteenAdTime)
    <div class="hidden-md hidden-lg marginTop15 marginBottom20 {{ $mobileHomeForteenAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $mobileHomeForteenAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($mobileHomeForteenAd->type == 3)
                <a href="{{ $mobileHomeForteenAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$mobileHomeForteenAd->mobile_image_path) }}" alt="Mobile Forteen Ad">
                </a>
            @else
                {!! $mobileHomeForteenAd->code !!}
            @endif
        </div>
    </div>
@endif
