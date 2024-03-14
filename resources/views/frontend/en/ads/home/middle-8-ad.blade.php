{{-- Position 8 = Middle Eight Ad - home page --}}
@php
    $middleEightAd = Cache::get('homePageAdsCacheKey')->where('position', 8)->first();

    $hasMiddleEightAdTime = true;
    if ($middleEightAd && $middleEightAd->start_time && $middleEightAd->end_time && !\Carbon\Carbon::now()->between($middleEightAd->start_time, $middleEightAd->end_time)){
        $hasMiddleEightAdTime = false;
    }
@endphp

@if($middleEightAd && $hasMiddleEightAdTime)
    <div class="advertisement marginBottom20">
        <div style="display: flex; justify-content: center; margin: 10px 0;">
            <div class="hidden-sm hidden-xs ad-box">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleEightAd->type == 3)
                    <a href="{{ $middleEightAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleEightAd->desktop_image_path) }}" alt="Middle Eight Ad">
                    </a>
                @else
                    {!! $middleEightAd->code !!}
                @endif
            </div>

            <div class="hidden-md hidden-lg ad-box">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleEightAd->type == 3)
                    <a href="{{ $middleEightAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleEightAd->mobile_image_path) }}" alt="Middle Eight Ad">
                    </a>
                @else
                    {!! $middleEightAd->code !!}
                @endif
            </div>
        </div>
    </div>
@endif
