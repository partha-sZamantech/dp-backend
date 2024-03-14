{{-- 1 = Details Top Ad - details page --}}
@php
    $detailsTopAd = Cache::get('detailsPageAdsCacheKey')->where('position', 1)->first();

    $hasDetailsTopAdTime = true;
    if ($detailsTopAd && $detailsTopAd->start_time && $detailsTopAd->end_time && !\Carbon\Carbon::now()->between($detailsTopAd->start_time, $detailsTopAd->end_time)){
        $hasDetailsTopAdTime = false;
    }
@endphp

@if($detailsTopAd && $hasDetailsTopAdTime)

    <div class="row advertisement marginBottom20">
        <div class="col-sm-12">
            <div style="display: flex; justify-content: center; margin: 10px 0;">
                <div class="hidden-sm hidden-xs ad-box" style="height: 90px">
                    {{-- Type 1=DFP, 2=Code, 3=Image --}}
                    @if($detailsTopAd->type == 3)
                        <a href="{{ $detailsTopAd->external_link }}" target="_blank" rel="nofollow">
                            <img src="{{ asset(config('appconfig.adPath').$detailsTopAd->desktop_image_path) }}" alt="Details Top Ad">
                        </a>
                    @else
                        {!! $detailsTopAd->code !!}
                    @endif
                </div>
        
                <div class="hidden-md hidden-lg ad-box" style="height: 50px">
                    {{-- Type 1=DFP, 2=Code, 3=Image --}}
                    @if($detailsTopAd->type == 3)
                        <a href="{{ $detailsTopAd->external_link }}" target="_blank" rel="nofollow">
                            <img src="{{ asset(config('appconfig.adPath').$detailsTopAd->mobile_image_path) }}" alt="Details Top Ad">
                        </a>
                    @else
                        {!! $detailsTopAd->code !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif