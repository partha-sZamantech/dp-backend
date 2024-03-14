{{-- Position 5 = Details After Ad - details page --}}
@php
    $detailsAfterAd = Cache::get('detailsPageAdsCacheKey')->where('position', 5)->first();

    $hasDetailsAfterAdTime = true;
    if ($detailsAfterAd && $detailsAfterAd->start_time && $detailsAfterAd->end_time && !\Carbon\Carbon::now()->between($detailsAfterAd->start_time, $detailsAfterAd->end_time)){
        $hasDetailsAfterAdTime = false;
    }
@endphp

@if($detailsAfterAd && $hasDetailsAfterAdTime)
    <div class="advertisement marginTop20 marginBottom20">
        <div style="display: flex; justify-content: center; margin: 10px 0;">
            <div class="hidden-sm hidden-xs ad-box" style="height: 90px">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($detailsAfterAd->type == 3)
                    <a href="{{ $detailsAfterAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$detailsAfterAd->desktop_image_path) }}" alt="Details After Ad">
                    </a>
                @else
                    {!! $detailsAfterAd->code !!}
                @endif
            </div>

            <div class="hidden-md hidden-lg ad-box" style="height: 50px">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($detailsAfterAd->type == 3)
                    <a href="{{ $detailsAfterAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$detailsAfterAd->mobile_image_path) }}" alt="Details After Ad">
                    </a>
                @else
                    {!! $detailsAfterAd->code !!}
                @endif
            </div>
        </div>
    </div>
@endif