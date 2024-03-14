{{-- Position 5 = Details After Ad - details page --}}
@php
    $detailsAfterAd = Cache::get('detailsPageAdsCacheKey')->where('position', 5)->first();

    $hasDetailsAfterAdTime = true;
    if ($detailsAfterAd && $detailsAfterAd->start_time && $detailsAfterAd->end_time && !\Carbon\Carbon::now()->between($detailsAfterAd->start_time, $detailsAfterAd->end_time)){
        $hasDetailsAfterAdTime = false;
    }
@endphp

@if($detailsAfterAd && $hasDetailsAfterAdTime)
    <div class="marginTop20 marginBottom20 desktop-details-after-ad {{ $detailsAfterAd->type != 4 ? 'advertisement' : '' }}">
        @if($detailsAfterAd->type != 4)
        <div style="display: flex; justify-content: center; margin: 10px 0;">
            @endif
            <div class="{{ $detailsAfterAd->type != 4 ? 'ad-box' : 'text-center' }}">
                {{-- Type 1=DFP, 2=Code, 3=Image --}}
                @if($detailsAfterAd->type == 3)
                    <a href="{{ $detailsAfterAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$detailsAfterAd->desktop_image_path) }}" alt="Details After Ad">
                    </a>
                @else
                    {!! $detailsAfterAd->code !!}
                @endif
            </div>

            {{--<div class="hidden-md hidden-lg {{ $detailsAfterAd->type != 4 ? 'ad-box' : '' }}">
                --}}{{-- Type 1=DFP, 2=Code, 3=Image --}}{{--
                @if($detailsAfterAd->type == 3)
                    <a href="{{ $detailsAfterAd->external_link }}" target="_blank" rel="nofollow">
                        <img src="{{ asset(config('appconfig.adPath').$detailsAfterAd->mobile_image_path) }}" alt="Details After Ad">
                    </a>
                @else
                    {!! $detailsAfterAd->code !!}
                @endif
            </div>--}}
            @if($detailsAfterAd->type != 4)
        </div>
            @endif
    </div>
@endif
