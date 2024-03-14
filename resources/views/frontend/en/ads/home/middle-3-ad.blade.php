{{-- Position 3 = Middle Three Ad - home page --}}
@php
    $middleThreeAd = Cache::get('homePageAdsCacheKey')->where('position', 3)->first();

    $hasMiddleThreeAdTime = true;
    if ($middleThreeAd && $middleThreeAd->start_time && $middleThreeAd->end_time && !\Carbon\Carbon::now()->between($middleThreeAd->start_time, $middleThreeAd->end_time)){
        $hasMiddleThreeAdTime = false;
    }
@endphp

@if($middleThreeAd && $hasMiddleThreeAdTime)
    <div class="advertisement marginBottom10">
        <div style="display: flex; justify-content: center; margin: 10px 0;">
            <div class="hidden-sm hidden-xs ad-box">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleThreeAd->type == 3)
                    <a href="{{ $middleThreeAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleThreeAd->desktop_image_path) }}" alt="Middle Three Ad">
                    </a>
                @else
                    {!! $middleThreeAd->code !!}
                @endif
            </div>

            <div class="hidden-md hidden-lg ad-box">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleThreeAd->type == 3)
                    <a href="{{ $middleThreeAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleThreeAd->mobile_image_path) }}" alt="Middle Three Ad">
                    </a>
                @else
                    {!! $middleThreeAd->code !!}
                @endif
            </div>
        </div>
    </div>
@endif
