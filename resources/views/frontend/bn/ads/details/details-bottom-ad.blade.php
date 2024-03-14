{{-- Position 6 = Details Bottom Ad - details page --}}
@php
    $detailsBottomAd = Cache::get('detailsPageAdsCacheKey')->where('position', 6)->first();

    $hasDetailsBottomAdTime = true;
    if ($detailsBottomAd && $detailsBottomAd->start_time && $detailsBottomAd->end_time && !\Carbon\Carbon::now()->between($detailsBottomAd->start_time, $detailsBottomAd->end_time)){
        $hasDetailsBottomAdTime = false;
    }
@endphp

@if($detailsBottomAd && $hasDetailsBottomAdTime)

    <div class="row marginBottom20 desktop-details-bottom-ad {{ $detailsBottomAd->type != 4 ? 'advertisement' : '' }}">
        <div class="col-sm-12">
            @if($detailsBottomAd->type != 4)
            <div style="display: flex; justify-content: center; margin: 10px 0;">
                @endif

                <div class="details-bottom {{ $detailsBottomAd->type != 4 ? 'ad-box' : 'text-center' }}">
                    {{-- Type 1=DFP, 2=Code, 3=Image --}}
                    @if($detailsBottomAd->type == 3)
                        <a href="{{ $detailsBottomAd->external_link }}" target="_blank" rel="nofollow">
                            <img src="{{ asset(config('appconfig.adPath').$detailsBottomAd->desktop_image_path) }}" alt="Details Bottom Ad">
                        </a>
                    @else
                        {!! $detailsBottomAd->code !!}
                    @endif
                </div>
                @if($detailsBottomAd->type != 4)
            </div>
                @endif
        </div>
    </div>
@endif
