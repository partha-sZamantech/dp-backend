{{-- 3 = Category Right One Ad - category page --}}
@php
    $categoryRightOneAd = Cache::get('categoryPageAdsCacheKey')->where('position', 3)->first();

    $hasCategoryRightOneAdTime = true;
    if ($categoryRightOneAd && $categoryRightOneAd->start_time && $categoryRightOneAd->end_time && !\Carbon\Carbon::now()->between($categoryRightOneAd->start_time, $categoryRightOneAd->end_time)){
        $hasCategoryRightOneAdTime = false;
    }
@endphp

@if($categoryRightOneAd && $hasCategoryRightOneAdTime)

    <div class="advertisement marginBottom20" style="height: 250px">
        <div class="hidden-sm hidden-xs ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($categoryRightOneAd->type == 3)
                <a href="{{ $categoryRightOneAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$categoryRightOneAd->desktop_image_path) }}" alt="Category Right One Ad">
                </a>
            @else
                {!! $categoryRightOneAd->code !!}
            @endif
        </div>

        <div class="hidden-md hidden-lg ad-box">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($categoryRightOneAd->type == 3)
                <a href="{{ $categoryRightOneAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$categoryRightOneAd->mobile_image_path) }}" alt="Category Right One Ad">
                </a>
            @else
                {!! $categoryRightOneAd->code !!}
            @endif
        </div>
    </div>
@endif