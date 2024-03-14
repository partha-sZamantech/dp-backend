{{-- Position 5 = Details After Ad - details page --}}
@php
    $mobileDetailsAfterAd = Cache::get('mobileDetailsPageAdsCacheKey')->where('position', 5)->first();

    $hasMobileDetailsAfterAdTime = true;
    if ($mobileDetailsAfterAd && $mobileDetailsAfterAd->start_time && $mobileDetailsAfterAd->end_time && !\Carbon\Carbon::now()->between($mobileDetailsAfterAd->start_time, $mobileDetailsAfterAd->end_time)){
        $hasMobileDetailsAfterAdTime = false;
    }
@endphp

@if($mobileDetailsAfterAd && $hasMobileDetailsAfterAdTime)
    <div class="marginTop20 marginBottom20 mobile-details-after-ad {{ $mobileDetailsAfterAd->type != 4 ? 'advertisement' : '' }}">
        @if($mobileDetailsAfterAd->type != 4)
        <div style="display: flex; justify-content: center; margin: 10px 0;">
            @endif
            <div class="{{ $mobileDetailsAfterAd->type != 4 ? 'ad-box' : '' }}">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($mobileDetailsAfterAd->type == 3)
                    <a href="{{ $mobileDetailsAfterAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$mobileDetailsAfterAd->mobile_image_path) }}" alt="Details After Ad">
                    </a>
                @else
                    {!! $mobileDetailsAfterAd->code !!}
                @endif
            </div>
            @if($mobileDetailsAfterAd->type != 4)
        </div>
            @endif
    </div>
@endif
