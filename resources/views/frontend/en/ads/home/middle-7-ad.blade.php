{{-- Position 7 = Middle Seven Ad - home page --}}
@php
    $middleSevenAd = Cache::get('homePageAdsCacheKey')->where('position', 7)->first();

    $hasMiddleSevenAdTime = true;
    if ($middleSevenAd && $middleSevenAd->start_time && $middleSevenAd->end_time && !\Carbon\Carbon::now()->between($middleSevenAd->start_time, $middleSevenAd->end_time)){
        $hasMiddleSevenAdTime = false;
    }
@endphp

@if($middleSevenAd && $hasMiddleSevenAdTime)
    <div class="advertisement marginBottom20">
        <div style="display: flex; justify-content: center; margin: 10px 0;">
            <div class="hidden-sm hidden-xs ad-box">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleSevenAd->type == 3)
                    <a href="{{ $middleSevenAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleSevenAd->desktop_image_path) }}" alt="Middle Seven Ad">
                    </a>
                @else
                    {!! $middleSevenAd->code !!}
                @endif
            </div>

            <div class="hidden-md hidden-lg ad-box">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleSevenAd->type == 3)
                    <a href="{{ $middleSevenAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleSevenAd->mobile_image_path) }}" alt="Middle Seven Ad">
                    </a>
                @else
                    {!! $middleSevenAd->code !!}
                @endif
            </div>
        </div>
    </div>
@endif
