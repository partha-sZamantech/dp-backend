{{-- Position 8 = Middle 7 Ad - home page --}}
@php
    $mobileHomeFifteenAd = Cache::get('mobileHomePageAdsCacheKey')->where('position', 15)->first();

    $hasMobileHomeFifteenAdTime = true;
    if ($mobileHomeFifteenAd && $mobileHomeFifteenAd->start_time && $mobileHomeFifteenAd->end_time && !\Carbon\Carbon::now()->between($mobileHomeFifteenAd->start_time, $mobileHomeFifteenAd->end_time)){
        $hasMobileHomeFifteenAdTime = false;
    }
@endphp

@if($mobileHomeFifteenAd && $hasMobileHomeFifteenAdTime)
    <div class="hidden-md hidden-lg marginTop15 marginBottom20 {{ $mobileHomeFifteenAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $mobileHomeFifteenAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($mobileHomeFifteenAd->type == 3)
                <a href="{{ $mobileHomeFifteenAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$mobileHomeFifteenAd->mobile_image_path) }}" alt="Mobile Fifteen Ad">
                </a>
            @else
                {!! $mobileHomeFifteenAd->code !!}
            @endif
        </div>
    </div>
@endif
