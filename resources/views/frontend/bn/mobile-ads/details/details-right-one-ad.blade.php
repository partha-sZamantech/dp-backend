{{-- Mobile Details Right 1 ad --}}
@php
    $mobileDetailsRightOneAd = Cache::get('mobileDetailsPageAdsCacheKey')->where('position', 7)->first();

    $hasMobileDetailsRightOneAdTime = true;
    if ($mobileDetailsRightOneAd && $mobileDetailsRightOneAd->start_time && $mobileDetailsRightOneAd->end_time && !\Carbon\Carbon::now()->between($mobileDetailsRightOneAd->start_time, $mobileDetailsRightOneAd->end_time)){
        $hasMobileDetailsRightOneAdTime = false;
    }
@endphp

{{--@if($mobileDetailsRightOneAd && $hasMobileDetailsRightOneAdTime)--}}
@if($mobileDetailsRightOneAd)
    <div class="mobile-details-right-1 marginBottom20{{ $mobileDetailsRightOneAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $mobileDetailsRightOneAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($mobileDetailsRightOneAd->type == 3)
                <a href="{{ $mobileDetailsRightOneAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$mobileDetailsRightOneAd->mobile_image_path) }}" alt="Details Right One Ad">
                </a>
            @else
                {!! $mobileDetailsRightOneAd->code !!}
            @endif
        </div>
    </div>
@endif
