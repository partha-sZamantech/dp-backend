{{-- 1 = Details Top Ad - details page --}}
@php
    $detailsTopAd = Cache::get('detailsPageAdsCacheKey')->where('position', 1)->first();

    $hasDetailsTopAdTime = true;
    if ($detailsTopAd && $detailsTopAd->start_time && $detailsTopAd->end_time && !\Carbon\Carbon::now()->between($detailsTopAd->start_time, $detailsTopAd->end_time)){
        $hasDetailsTopAdTime = false;
    }
@endphp

@if($detailsTopAd && $hasDetailsTopAdTime)
    <div class="marginTop20 marginBottom20 {{ $detailsTopAd->type != 4 ? 'advertisement' : '' }}" align="center">
        @if($detailsTopAd->type != 4)
            <div style="display: flex; justify-content: center;">
                @endif
                <div class="hidden-sm hidden-xs {{ $detailsTopAd->type != 4 ? 'ad-box' : '' }}" style="{{ $detailsTopAd->type == 2 ? 'min-width: 728px; max-height: 90px' : '' }}">
                    {{-- Type 1=DFP, 2=Code, 3=Image --}}
                    @if($detailsTopAd->type == 3)
                        <a href="{{ $detailsTopAd->external_link }}" target="_blank" rel="nofollow">
                            <img src="{{ asset(config('appconfig.adPath').$detailsTopAd->desktop_image_path) }}" alt="Details Top Ad">
                        </a>
                    @else
                        {!! $detailsTopAd->code !!}
                    @endif
                </div>

                <div class="hidden-md hidden-lg {{ $detailsTopAd->type != 4 ? 'ad-box' : '' }}" style="{{ $detailsTopAd->type == 2 ? 'min-width: 320px; max-height: 50px' : '' }}">
                    {{-- Type 1=DFP, 2=Code, 3=Image --}}
                    @if($detailsTopAd->type == 3)
                        <a href="{{ $detailsTopAd->external_link }}" target="_blank" rel="nofollow">
                            <img src="{{ asset(config('appconfig.adPath').$detailsTopAd->mobile_image_path) }}" alt="Details Top Ad">
                        </a>
                    @else
                        {!! $detailsTopAd->code !!}
                    @endif
                </div>
                @if($detailsTopAd->type != 4)
            </div>
        @endif
    </div>
@endif
