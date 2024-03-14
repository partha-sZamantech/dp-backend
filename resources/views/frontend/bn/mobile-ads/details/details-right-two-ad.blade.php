{{-- Mobile Details Right 2 ad --}}
@php
    $mobileDetailsRightTwoAd = Cache::get('mobileDetailsPageAdsCacheKey')->where('position', 8)->first();

    $hasMobileDetailsRightTwoAdTime = true;
    if ($mobileDetailsRightTwoAd && $mobileDetailsRightTwoAd->start_time && $mobileDetailsRightTwoAd->end_time && !\Carbon\Carbon::now()->between($mobileDetailsRightTwoAd->start_time, $mobileDetailsRightTwoAd->end_time)){
        $hasMobileDetailsRightTwoAdTime = false;
    }
@endphp

@if($mobileDetailsRightTwoAd && $hasMobileDetailsRightTwoAdTime)

    <div class="marginBottom20{{ $mobileDetailsRightTwoAd->type != 4 ? 'advertisement' : '' }}">
        <div class="mobile-details-ad-2 {{ $mobileDetailsRightTwoAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($mobileDetailsRightTwoAd->type == 3)
                <a href="{{ $mobileDetailsRightTwoAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$mobileDetailsRightTwoAd->mobile_image_path) }}" alt="Details Right Two Ad">
                </a>
            @else
                {!! $mobileDetailsRightTwoAd->code !!}
            @endif
        </div>
    </div>
@endif
