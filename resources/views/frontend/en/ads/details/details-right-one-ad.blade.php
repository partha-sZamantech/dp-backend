{{-- Position 7 = Details Right One Ad - details page --}}
@php
    $detailsRightOneAd = Cache::get('detailsPageAdsCacheKey')->where('position', 7)->first();

    $hasDetailsRightOneAdTime = true;
    if ($detailsRightOneAd && $detailsRightOneAd->start_time && $detailsRightOneAd->end_time && !\Carbon\Carbon::now()->between($detailsRightOneAd->start_time, $detailsRightOneAd->end_time)){
        $hasDetailsRightOneAdTime = false;
    }
@endphp

@if($detailsRightOneAd && $hasDetailsRightOneAdTime)

    <div class="advertisement marginBottom20" style="height: 250px">
        <div class="hidden-sm hidden-xs ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($detailsRightOneAd->type == 3)
                <a href="{{ $detailsRightOneAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$detailsRightOneAd->desktop_image_path) }}" alt="Details Right One Ad">
                </a>
            @else
                {!! $detailsRightOneAd->code !!}
            @endif
        </div>

        <div class="hidden-md hidden-lg ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($detailsRightOneAd->type == 3)
                <a href="{{ $detailsRightOneAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$detailsRightOneAd->mobile_image_path) }}" alt="Details Right One Ad">
                </a>
            @else
                {!! $detailsRightOneAd->code !!}
            @endif
        </div>
    </div>
@endif