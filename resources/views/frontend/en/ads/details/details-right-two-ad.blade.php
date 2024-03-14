{{-- Position 8 = Details Page Right Two Ad --}}
@php
    $detailsRightTwoAd = Cache::get('detailsPageAdsCacheKey')->where('position', 8)->first();

    $hasDetailsRightTwoAdTime = true;
    if ($detailsRightTwoAd && $detailsRightTwoAd->start_time && $detailsRightTwoAd->end_time && !\Carbon\Carbon::now()->between($detailsRightTwoAd->start_time, $detailsRightTwoAd->end_time)){
        $hasDetailsRightTwoAdTime = false;
    }
@endphp

@if($detailsRightTwoAd && $hasDetailsRightTwoAdTime)

    <div class="advertisement marginBottom20" style="height: 250px">
        <div class="hidden-sm hidden-xs ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($detailsRightTwoAd->type == 3)
                <a href="{{ $detailsRightTwoAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$detailsRightTwoAd->desktop_image_path) }}" alt="Details Right Two Ad">
                </a>
            @else
                {!! $detailsRightTwoAd->code !!}
            @endif
        </div>

        <div class="hidden-md hidden-lg ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($detailsRightTwoAd->type == 3)
                <a href="{{ $detailsRightTwoAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$detailsRightTwoAd->mobile_image_path) }}" alt="Details Right Two Ad">
                </a>
            @else
                {!! $detailsRightTwoAd->code !!}
            @endif
        </div>
    </div>
@endif