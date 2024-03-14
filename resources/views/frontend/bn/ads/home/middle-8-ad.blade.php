{{-- Position 9 = Middle 8 Ad - home page --}}
@php
    $middleEightAd = Cache::get('homePageAdsCacheKey')->where('position', 9)->first();

    $hasMiddleEightAdTime = true;
    if ($middleEightAd && $middleEightAd->start_time && $middleEightAd->end_time && !\Carbon\Carbon::now()->between($middleEightAd->start_time, $middleEightAd->end_time)){
        $hasMiddleEightAdTime = false;
    }
@endphp

@if($middleEightAd && $hasMiddleEightAdTime)
    <div class="desktop-ad-middle-8 marginBottom20">
        <div class="{{ $middleEightAd->type != 4 ? 'ad-box' : 'text-center' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($middleEightAd->type == 3)
                <a href="{{ $middleEightAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$middleEightAd->desktop_image_path) }}" alt="Middle Eight Ad">
                </a>
            @else
                {!! $middleEightAd->code !!}
            @endif
        </div>
    </div>
@endif
