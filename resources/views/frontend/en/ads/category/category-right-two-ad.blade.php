{{-- Position 4 = Category Right Two Ad - category page --}}
@php
    $categoryRightTwoAd = Cache::get('categoryPageAdsCacheKey')->where('position', 4)->first();

    $hasCategoryRightTwoAdTime = true;
    if ($categoryRightTwoAd && $categoryRightTwoAd->start_time && $categoryRightTwoAd->end_time && !\Carbon\Carbon::now()->between($categoryRightTwoAd->start_time, $categoryRightTwoAd->end_time)){
        $hasCategoryRightTwoAdTime = false;
    }
@endphp

@if($categoryRightTwoAd && $hasCategoryRightTwoAdTime)

    <div class="advertisement marginBottom20" style="height: 600px">
        <div class="hidden-sm hidden-xs ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($categoryRightTwoAd->type == 3)
                <a href="{{ $categoryRightTwoAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$categoryRightTwoAd->desktop_image_path) }}" alt="Category Right Two Ad">
                </a>
            @else
                {!! $categoryRightTwoAd->code !!}
            @endif
        </div>

        <div class="hidden-md hidden-lg ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($categoryRightTwoAd->type == 3)
                <a href="{{ $categoryRightTwoAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$categoryRightTwoAd->mobile_image_path) }}" alt="Category Right Two Ad">
                </a>
            @else
                {!! $categoryRightTwoAd->code !!}
            @endif
        </div>
    </div>
@endif