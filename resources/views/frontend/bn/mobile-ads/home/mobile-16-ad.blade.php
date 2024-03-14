{{-- Position 9 = Middle 8 Ad - home page --}}
@php
    $mobileHomeSixteenAd = Cache::get('mobileHomePageAdsCacheKey')->where('position', 16)->first();

    $hasMobileHomeSixteenAdTime = true;
    if ($mobileHomeSixteenAd && $mobileHomeSixteenAd->start_time && $mobileHomeSixteenAd->end_time && !\Carbon\Carbon::now()->between($mobileHomeSixteenAd->start_time, $mobileHomeSixteenAd->end_time)){
        $hasMobileHomeSixteenAdTime = false;
    }
@endphp

@if($mobileHomeSixteenAd && $hasMobileHomeSixteenAdTime)
    <div class="hidden-md hidden-lg marginTop15 marginBottom20 {{ $mobileHomeSixteenAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $mobileHomeSixteenAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($mobileHomeSixteenAd->type == 3)
                <a href="{{ $mobileHomeSixteenAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$mobileHomeSixteenAd->mobile_image_path) }}" alt="Mobile Sixteen Ad">
                </a>
            @else
                {!! $mobileHomeSixteenAd->code !!}
            @endif
        </div>
    </div>
@endif
