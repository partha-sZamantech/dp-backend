{{-- Position 2 = Category Bottom Ad - category page --}}
@php
    $categoryBottomAd = Cache::get('categoryPageAdsCacheKey')->where('position', 2)->first();

    $hasCategoryBottomAdTime = true;
    if ($categoryBottomAd && $categoryBottomAd->start_time && $categoryBottomAd->end_time && !\Carbon\Carbon::now()->between($categoryBottomAd->start_time, $categoryBottomAd->end_time)){
        $hasCategoryBottomAdTime = false;
    }
@endphp

@if($categoryBottomAd && $hasCategoryBottomAdTime)
    <div class="advertisement marginTop20 marginBottom20">
        <div style="display: flex; justify-content: center; margin: 10px 0;">
            <div class="hidden-sm hidden-xs ad-box" style="height: 90px">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($categoryBottomAd->type == 3)
                    <a href="{{ $categoryBottomAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$categoryBottomAd->desktop_image_path) }}" alt="Middle Three Ad">
                    </a>
                @else
                    {!! $categoryBottomAd->code !!}
                @endif
            </div>

            <div class="hidden-md hidden-lg ad-box" style="height: 50px">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($categoryBottomAd->type == 3)
                    <a href="{{ $categoryBottomAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$categoryBottomAd->mobile_image_path) }}" alt="Middle Three Ad">
                    </a>
                @else
                    {!! $categoryBottomAd->code !!}
                @endif
            </div>
        </div>
    </div>
@endif