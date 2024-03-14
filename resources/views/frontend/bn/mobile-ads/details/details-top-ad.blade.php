{{-- 1 = Details Top Ad - details page --}}
@php
    $mobileDetailsTopAd = Cache::get('mobileDetailsPageAdsCacheKey')->where('position', 1)->first();

    $hasMobileDetailsTopAdTime = true;
    if ($mobileDetailsTopAd && $mobileDetailsTopAd->start_time && $mobileDetailsTopAd->end_time && !\Carbon\Carbon::now()->between($mobileDetailsTopAd->start_time, $mobileDetailsTopAd->end_time)){
        $hasMobileDetailsTopAdTime = false;
    }
@endphp

@if($mobileDetailsTopAd && $hasMobileDetailsTopAdTime)

    <div class="row marginBottom15 marginTop20 mobile-details-top-ad {{ $mobileDetailsTopAd->type != 4 ? 'advertisement' : '' }}">
        <div class="col-sm-12">
            @if($mobileDetailsTopAd->type != 4)
            <div style="display: flex; justify-content: center; margin: 10px 0;">
            @endif
                <div class="{{ $mobileDetailsTopAd->type != 4 ? 'ad-box' : '' }}">
                    {{-- Type 1=DFP, 2=Code, 3=Image --}}
                    @if($mobileDetailsTopAd->type == 3)
                        <a href="{{ $mobileDetailsTopAd->external_link }}" target="_blank" rel="nofollow">
                            <img src="{{ asset(config('appconfig.adPath').$mobileDetailsTopAd->mobile_image_path) }}" alt="Details Top Ad">
                        </a>
                    @else
                        {!! $mobileDetailsTopAd->code !!}
                    @endif
                </div>
                @if($mobileDetailsTopAd->type != 4)
            </div>
                @endif
        </div>
    </div>
@endif
