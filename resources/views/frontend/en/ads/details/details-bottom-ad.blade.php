{{-- Position 6 = Details Bottom Ad - details page --}}
@php
    $detailsBottomAd = Cache::get('detailsPageAdsCacheKey')->where('position', 6)->first();

    $hasDetailsBottomAdTime = true;
    if ($detailsBottomAd && $detailsBottomAd->start_time && $detailsBottomAd->end_time && !\Carbon\Carbon::now()->between($detailsBottomAd->start_time, $detailsBottomAd->end_time)){
        $hasDetailsBottomAdTime = false;
    }
@endphp

@if($detailsBottomAd && $hasDetailsBottomAdTime)

    <div class="row advertisement marginBottom20">
        <div class="col-sm-12">
            <div style="display: flex; justify-content: center; margin: 10px 0;">
                <div class="hidden-sm hidden-xs ad-box" style="height: 90px">
                    {{-- Type 1=DFP, 2=Code, 3=Image --}}
                    @if($detailsBottomAd->type == 3)
                        <a href="{{ $detailsBottomAd->external_link }}" target="_blank" rel="nofollow">
                            <img src="{{ asset(config('appconfig.adPath').$detailsBottomAd->desktop_image_path) }}" alt="Details Bottom Ad">
                        </a>
                    @else
                        {!! $detailsBottomAd->code !!}
                    @endif
                </div>
        
                <div class="hidden-md hidden-lg ad-box" style="height: 50px">
                    {{-- Type 1=DFP, 2=Code, 3=Image --}}
                    @if($detailsBottomAd->type == 3)
                        <a href="{{ $detailsBottomAd->external_link }}" target="_blank" rel="nofollow">
                            <img src="{{ asset(config('appconfig.adPath').$detailsBottomAd->mobile_image_path) }}" alt="Details Bottom Ad">
                        </a>
                    @else
                        {!! $detailsBottomAd->code !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif