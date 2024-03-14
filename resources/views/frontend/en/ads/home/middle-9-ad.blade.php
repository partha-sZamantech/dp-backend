{{-- Position 9 = Middle Nine Ad - home page --}}
@php
    $middleNineAd = Cache::get('homePageAdsCacheKey')->where('position', 9)->first();

    $hasMiddleNineAdTime = true;
    if ($middleNineAd && $middleNineAd->start_time && $middleNineAd->end_time && !\Carbon\Carbon::now()->between($middleNineAd->start_time, $middleNineAd->end_time)){
        $hasMiddleNineAdTime = false;
    }
@endphp

@if($middleNineAd && $hasMiddleNineAdTime)
    <div class="advertisement marginBottom20">
        <div style="display: flex; justify-content: center; margin: 10px 0;">
            <div class="hidden-sm hidden-xs ad-box">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleNineAd->type == 3)
                    <a href="{{ $middleNineAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleNineAd->desktop_image_path) }}" alt="Middle Nine Ad">
                    </a>
                @else
                    {!! $middleNineAd->code !!}
                @endif
            </div>

            <div class="hidden-md hidden-lg ad-box">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleNineAd->type == 3)
                    <a href="{{ $middleNineAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleNineAd->mobile_image_path) }}" alt="Middle Nine Ad">
                    </a>
                @else
                    {!! $middleNineAd->code !!}
                @endif
            </div>
        </div>
    </div>
@endif
