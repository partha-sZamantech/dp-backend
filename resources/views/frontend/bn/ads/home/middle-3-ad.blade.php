{{-- Position 4 = Middle 3 Ad - home page --}}
@php
    $middleThreeAd = Cache::get('homePageAdsCacheKey')->where('position', 4)->first();

    $hasMiddleThreeAdTime = true;
    if ($middleThreeAd && $middleThreeAd->start_time && $middleThreeAd->end_time && !\Carbon\Carbon::now()->between($middleThreeAd->start_time, $middleThreeAd->end_time)){
        $hasMiddleThreeAdTime = false;
    }
@endphp

@if($middleThreeAd && $hasMiddleThreeAdTime)
    <div class="desktop-middle-ad-3">
        <div class="{{ $middleThreeAd->type != 4 ? 'ad-box' : 'text-center' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($middleThreeAd->type == 3)
                <a href="{{ $middleThreeAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$middleThreeAd->desktop_image_path) }}" alt="Middle Three Ad">
                </a>
            @else
                {!! $middleThreeAd->code !!}
            @endif
        </div>
    </div>
@endif
