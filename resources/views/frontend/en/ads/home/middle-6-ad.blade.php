{{-- Position 6 = Middle Six Ad - home page --}}
@php
    $middleSixAd = Cache::get('homePageAdsCacheKey')->where('position', 6)->first();

    $hasMiddleSixAdTime = true;
    if ($middleSixAd && $middleSixAd->start_time && $middleSixAd->end_time && !\Carbon\Carbon::now()->between($middleSixAd->start_time, $middleSixAd->end_time)){
        $hasMiddleSixAdTime = false;
    }
@endphp

@if($middleSixAd && $hasMiddleSixAdTime)
    <div class="advertisement marginBottom20">
        <div style="display: flex; justify-content: center; margin: 10px 0;">
            <div class="hidden-sm hidden-xs ad-box">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleSixAd->type == 3)
                    <a href="{{ $middleSixAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleSixAd->desktop_image_path) }}" alt="Middle Six Ad">
                    </a>
                @else
                    {!! $middleSixAd->code !!}
                @endif
            </div>

            <div class="hidden-md hidden-lg ad-box">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleSixAd->type == 3)
                    <a href="{{ $middleSixAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleSixAd->mobile_image_path) }}" alt="Middle Six Ad">
                    </a>
                @else
                    {!! $middleSixAd->code !!}
                @endif
            </div>
        </div>
    </div>
@endif
