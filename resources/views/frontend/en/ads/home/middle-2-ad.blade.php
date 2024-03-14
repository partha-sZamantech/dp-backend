{{-- Position 2 = Middle Two Ad - home page --}}
@php
    $middleTwoAd = Cache::get('homePageAdsCacheKey')->where('position', 2)->first();

    $hasMiddleTwoAdTime = true;
    if ($middleTwoAd && $middleTwoAd->start_time && $middleTwoAd->end_time && !\Carbon\Carbon::now()->between($middleTwoAd->start_time, $middleTwoAd->end_time)){
        $hasMiddleTwoAdTime = false;
    }
@endphp

@if($middleTwoAd && $hasMiddleTwoAdTime)
    <div class="advertisement">
        <div style="display: flex; justify-content: center; margin: 0 0 10px 0;">
            <div class="hidden-sm hidden-xs ad-box">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleTwoAd->type == 3)
                    <a href="{{ $middleTwoAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleTwoAd->desktop_image_path) }}" alt="Middle Two Ad">
                    </a>
                @else
                    {!! $middleTwoAd->code !!}
                @endif
            </div>

            <div class="hidden-md hidden-lg ad-box">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleTwoAd->type == 3)
                    <a href="{{ $middleTwoAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleTwoAd->mobile_image_path) }}" alt="Middle Two Ad">
                    </a>
                @else
                    {!! $middleTwoAd->code !!}
                @endif
            </div>
        </div>
    </div>
@endif
