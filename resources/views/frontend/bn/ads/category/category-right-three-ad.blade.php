{{-- Position 4 = Category Right Two Ad - category page --}}
@php
    $categoryRightThreeAd = Cache::get('categoryPageAdsCacheKey')->where('position', 5)->first();

    $hasCategoryRightThreeAdTime = true;
    if ($categoryRightThreeAd && $categoryRightThreeAd->start_time && $categoryRightThreeAd->end_time && !\Carbon\Carbon::now()->between($categoryRightThreeAd->start_time, $categoryRightThreeAd->end_time)){
        $hasCategoryRightThreeAdTime = false;
    }
@endphp

@if($categoryRightThreeAd && $hasCategoryRightThreeAdTime)

    <div class="marginTop20 {{ $categoryRightThreeAd->type != 4 ? 'advertisement' : '' }}">
        <div class="hidden-sm hidden-xs {{ $categoryRightThreeAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($categoryRightThreeAd->type == 3)
                <a href="{{ $categoryRightThreeAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$categoryRightThreeAd->desktop_image_path) }}" alt="Category Right Two Ad">
                </a>
            @else
                {!! $categoryRightThreeAd->code !!}
            @endif
        </div>

        <div class="hidden-md hidden-lg {{ $categoryRightThreeAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($categoryRightThreeAd->type == 3)
                <a href="{{ $categoryRightThreeAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$categoryRightThreeAd->mobile_image_path) }}" alt="Category Right Two Ad">
                </a>
            @else
                {!! $categoryRightThreeAd->code !!}
            @endif
        </div>
    </div>
@endif
