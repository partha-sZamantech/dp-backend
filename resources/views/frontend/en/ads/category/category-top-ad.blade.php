{{-- 1 = Category Top Ad - category page --}}
@php
    $categoryTopAd = Cache::get('categoryPageAdsCacheKey')->where('position', 1)->first();

    $hasCategoryTopAdTime = true;
    if ($categoryTopAd && $categoryTopAd->start_time && $categoryTopAd->end_time && !\Carbon\Carbon::now()->between($categoryTopAd->start_time, $categoryTopAd->end_time)){
        $hasCategoryTopAdTime = false;
    }
@endphp

@if($categoryTopAd && $hasCategoryTopAdTime)
    <div class="advertisement marginBottom20">
        <div style="display: flex; justify-content: center;">
            <div class="hidden-sm hidden-xs ad-box" style="height: 90px">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($categoryTopAd->type == 3)
                    <a href="{{ $categoryTopAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$categoryTopAd->desktop_image_path) }}" alt="Middle Three Ad">
                    </a>
                @else
                    {!! $categoryTopAd->code !!}
                @endif
            </div>

            <div class="hidden-md hidden-lg ad-box" style="height: 50px">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($categoryTopAd->type == 3)
                    <a href="{{ $categoryTopAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$categoryTopAd->mobile_image_path) }}" alt="Middle Three Ad">
                    </a>
                @else
                    {!! $categoryTopAd->code !!}
                @endif
            </div>
        </div>
    </div>
@endif