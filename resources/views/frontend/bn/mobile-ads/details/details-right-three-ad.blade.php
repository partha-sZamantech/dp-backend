{{-- Mobile details right 3 ad --}}
@php
    $mobileDetailsRightThreeAd = Cache::get('detailsPageAdsCacheKey')->where('position', 9)->first();

    $hasMobileDetailsRightThreeAdTime = true;
    if ($mobileDetailsRightThreeAd && $mobileDetailsRightThreeAd->start_time && $mobileDetailsRightThreeAd->end_time && !\Carbon\Carbon::now()->between($mobileDetailsRightThreeAd->start_time, $mobileDetailsRightThreeAd->end_time)){
        $hasMobileDetailsRightThreeAdTime = false;
    }
@endphp

@if($mobileDetailsRightThreeAd && $hasMobileDetailsRightThreeAdTime)

    <div class="marginBottom20 mobile-details-right-3 {{ $mobileDetailsRightThreeAd->type != 4 ? 'advertisement' : '' }}">
        <div class="{{ $mobileDetailsRightThreeAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($mobileDetailsRightThreeAd->type == 3)
                <a href="{{ $mobileDetailsRightThreeAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$mobileDetailsRightThreeAd->mobile_image_path) }}" alt="Details Right Three Ad">
                </a>
            @else
                {!! $mobileDetailsRightThreeAd->code !!}
            @endif
        </div>
    </div>
@endif
