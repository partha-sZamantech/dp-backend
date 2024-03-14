{{-- Position 10 = Middle 9 Ad - home page --}}
@php
    $middleNineAd = Cache::get('homePageAdsCacheKey')->where('position', 10)->first();

    $hasMiddleNineAdTime = true;
    if ($middleNineAd && $middleNineAd->start_time && $middleNineAd->end_time && !\Carbon\Carbon::now()->between($middleNineAd->start_time, $middleNineAd->end_time)){
        $hasMiddleNineAdTime = false;
    }
@endphp

@if($middleNineAd && $hasMiddleNineAdTime)
    <div class="desktop-ad-middle-9 marginBottom20">
        {{--@if($middleNineAd->type != 4)
        <div style="display: flex; justify-content: center; margin: 10px 0;">
            @endif--}}
            <div class="{{ $middleNineAd->type != 4 ? 'ad-box' : 'text-center' }}">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleNineAd->type == 3)
                    <a href="{{ $middleNineAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleNineAd->desktop_image_path) }}" alt="Middle Nine Ad">
                    </a>
                @else
                    {!! $middleNineAd->code !!}
                @endif
            </div>

            {{--<div class="hidden-md hidden-lg {{ $middleNineAd->type != 4 ? 'ad-box' : '' }}">
                --}}{{-- Type 1=DFP, 2=Code, 3=Image --}}{{--
                @if($middleNineAd->type == 3)
                    <a href="{{ $middleNineAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleNineAd->mobile_image_path) }}" alt="Middle Nine Ad">
                    </a>
                @else
                    {!! $middleNineAd->code !!}
                @endif
            </div>--}}
            {{--@if($middleNineAd->type != 4)
        </div>
            @endif--}}
    </div>
@endif
