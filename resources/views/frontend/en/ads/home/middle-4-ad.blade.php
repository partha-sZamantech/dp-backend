{{-- Position 4 = Middle Four Ad - home page --}}
@php
    $middleFourAd = Cache::get('homePageAdsCacheKey')->where('position', 4)->first();

    $hasMiddleFourAdTime = true;
    if ($middleFourAd && $middleFourAd->start_time && $middleFourAd->end_time && !\Carbon\Carbon::now()->between($middleFourAd->start_time, $middleFourAd->end_time)){
        $hasMiddleFourAdTime = false;
    }
@endphp

@if($middleFourAd && $hasMiddleFourAdTime)
    <div class="advertisement">
        <div style="display: flex; justify-content: center; margin: 10px 0;">
            <div class="hidden-sm hidden-xs ad-box">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleFourAd->type == 3)
                    <a href="{{ $middleFourAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleFourAd->desktop_image_path) }}" alt="Middle Four Ad">
                    </a>
                @else
                    {!! $middleFourAd->code !!}
                @endif
            </div>

            <div class="hidden-md hidden-lg ad-box">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleFourAd->type == 3)
                    <a href="{{ $middleFourAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleFourAd->mobile_image_path) }}" alt="Middle Four Ad">
                    </a>
                @else
                    {!! $middleFourAd->code !!}
                @endif
            </div>
        </div>
    </div>
@endif
