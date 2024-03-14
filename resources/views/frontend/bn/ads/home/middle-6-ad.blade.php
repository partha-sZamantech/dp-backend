{{-- Position 7 = Middle 6 Ad - home page --}}
@php
    $middleSixAd = Cache::get('homePageAdsCacheKey')->where('position', 7)->first();

    $hasMiddleSixAdTime = true;
    if ($middleSixAd && $middleSixAd->start_time && $middleSixAd->end_time && !\Carbon\Carbon::now()->between($middleSixAd->start_time, $middleSixAd->end_time)){
        $hasMiddleSixAdTime = false;
    }
@endphp

@if($middleSixAd && $hasMiddleSixAdTime)
    <div class="desktop-ad-middle-6 marginBottom20">
        <div class="{{ $middleSixAd->type != 4 ? 'ad-box' : 'text-center' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($middleSixAd->type == 3)
                <a href="{{ $middleSixAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$middleSixAd->desktop_image_path) }}" alt="Middle Six Ad">
                </a>
            @else
                {!! $middleSixAd->code !!}
            @endif
        </div>
    </div>
@endif
