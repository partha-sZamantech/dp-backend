{{-- Position 6 = Middle 5 Ad - home page --}}
@php
    $middleFiveAd = Cache::get('homePageAdsCacheKey')->where('position', 6)->first();

    $hasMiddleFiveAdTime = true;
    if ($middleFiveAd && $middleFiveAd->start_time && $middleFiveAd->end_time && !\Carbon\Carbon::now()->between($middleFiveAd->start_time, $middleFiveAd->end_time)){
        $hasMiddleFiveAdTime = false;
    }
@endphp

@if($middleFiveAd && $hasMiddleFiveAdTime)
    <div class="desktop-ad-middle-5 marginBottom20">
        {{--@if($middleFiveAd->type != 4)
        <div style="display: flex; justify-content: center; margin: 10px 0;">
            @endif--}}
            <div class="{{ $middleFiveAd->type != 4 ? 'ad-box' : 'text-center' }}">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($middleFiveAd->type == 3)
                    <a href="{{ $middleFiveAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleFiveAd->desktop_image_path) }}" alt="Middle Five Ad">
                    </a>
                @else
                    {!! $middleFiveAd->code !!}
                @endif
            </div>
            {{--@if($middleFiveAd->type != 4)
        </div>
            @endif--}}
    </div>
@endif
