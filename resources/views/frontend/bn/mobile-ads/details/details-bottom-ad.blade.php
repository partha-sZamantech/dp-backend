{{-- Mobile Details Bottom Ad --}}
@php
    $mobileDetailsBottomAd = Cache::get('mobileDetailsPageAdsCacheKey')->where('position', 6)->first();

    $hasMobileDetailsBottomAdTime = true;
    if ($mobileDetailsBottomAd && $mobileDetailsBottomAd->start_time && $mobileDetailsBottomAd->end_time && !\Carbon\Carbon::now()->between($mobileDetailsBottomAd->start_time, $mobileDetailsBottomAd->end_time)){
        $hasMobileDetailsBottomAdTime = false;
    }
@endphp

@if($mobileDetailsBottomAd && $hasMobileDetailsBottomAdTime)

    <div class="row marginBottom20 mobile-details-bottom-ad {{ $mobileDetailsBottomAd->type != 4 ? 'advertisement' : '' }}">
        <div class="col-sm-12">
            @if($mobileDetailsBottomAd->type != 4)
            <div style="display: flex; justify-content: center; margin: 10px 0;">
                @endif
                <div class="{{ $mobileDetailsBottomAd->type != 4 ? 'ad-box' : '' }}">
                    {{-- Type 1=DFP, 2=Code, 3=Image --}}
                    @if($mobileDetailsBottomAd->type == 3)
                        <a href="{{ $mobileDetailsBottomAd->external_link }}" target="_blank" rel="nofollow">
                            <img src="{{ asset(config('appconfig.adPath').$mobileDetailsBottomAd->mobile_image_path) }}" alt="Details Bottom Ad">
                        </a>
                    @else
                        {!! $mobileDetailsBottomAd->code !!}
                    @endif
                </div>
                @if($mobileDetailsBottomAd->type != 4)
            </div>
                @endif
        </div>
    </div>
@endif
