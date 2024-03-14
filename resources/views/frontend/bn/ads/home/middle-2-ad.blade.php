{{-- 3 = Middle 2 Ad - home page --}}

@php
    $middleTwoAd = Cache::get('homePageAdsCacheKey')->where('position', 3)->first();

    $hasMiddleTwoAdTime = true;
    if ($middleTwoAd && $middleTwoAd->start_time && $middleTwoAd->end_time && !\Carbon\Carbon::now()->between($middleTwoAd->start_time, $middleTwoAd->end_time)){
        $hasMiddleTwoAdTime = false;
    }
@endphp

@if($middleTwoAd && $hasMiddleTwoAdTime)
    <div class="desktop-middle-ad-2 marginBottom10">
            <div class="{{ $middleTwoAd->type != 4 ? 'ad-box' : 'text-center' }}">
{{--                 Type 1=DFP, 2=Code, 3=Image--}}
                @if($middleTwoAd->type == 3)
                    <a href="{{ $middleTwoAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$middleTwoAd->desktop_image_path) }}" alt="Middle Two Ad">
                    </a>
                @else
                    {!! $middleTwoAd->code !!}
                @endif
            </div>
    </div>
@endif
