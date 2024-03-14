{{-- Position 9 = Details Right three Ad - details page --}}
@php
    $detailsRightThreeAd = Cache::get('detailsPageAdsCacheKey')->where('position', 9)->first();

    $hasDetailsRightThreeAdTime = true;
    if ($detailsRightThreeAd && $detailsRightThreeAd->start_time && $detailsRightThreeAd->end_time && !\Carbon\Carbon::now()->between($detailsRightThreeAd->start_time, $detailsRightThreeAd->end_time)){
        $hasDetailsRightThreeAdTime = false;
    }
@endphp

@if($detailsRightThreeAd && $hasDetailsRightThreeAdTime)

    <div class="advertisement marginBottom20" style="height: 600px">
        <div class="hidden-sm hidden-xs ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($detailsRightThreeAd->type == 3)
                <a href="{{ $detailsRightThreeAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$detailsRightThreeAd->desktop_image_path) }}" alt="Details Right Three Ad">
                </a>
            @else
                {!! $detailsRightThreeAd->code !!}
            @endif
        </div>

        <div class="hidden-md hidden-lg ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($detailsRightThreeAd->type == 3)
                <a href="{{ $detailsRightThreeAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$detailsRightThreeAd->mobile_image_path) }}" alt="Details Right Three Ad">
                </a>
            @else
                {!! $detailsRightThreeAd->code !!}
            @endif
        </div>
    </div>
@endif