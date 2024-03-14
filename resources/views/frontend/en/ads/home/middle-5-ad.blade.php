{{-- Position 5 = Middle Five Ad - home page --}}
@php
    $middleFiveAd = Cache::get('homePageAdsCacheKey')->where('position', 5)->first();

    $hasMiddleFiveAdTime = true;
    if ($middleFiveAd && $middleFiveAd->start_time && $middleFiveAd->end_time && !\Carbon\Carbon::now()->between($middleFiveAd->start_time, $middleFiveAd->end_time)){
        $hasMiddleFiveAdTime = false;
    }
@endphp

@if($middleFiveAd && $hasMiddleFiveAdTime)
    <div class="advertisement">
        <div style="display: flex; justify-content: center; margin: 10px 0;">
            <div class="hidden-sm hidden-xs ad-box">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleFiveAd->type == 3)
                    <a href="{{ $middleFiveAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleFiveAd->desktop_image_path) }}" alt="Middle Five Ad">
                    </a>
                @else
                    {!! $middleFiveAd->code !!}
                @endif
            </div>

            <div class="hidden-md hidden-lg ad-box">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleFiveAd->type == 3)
                    <a href="{{ $middleFiveAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleFiveAd->mobile_image_path) }}" alt="Middle Five Ad">
                    </a>
                @else
                    {!! $middleFiveAd->code !!}
                @endif
            </div>
        </div>
    </div>
@endif
