{{-- 2 = Mobile Middle One Ad - home page --}}
@php
    $mobileHomeAdOne = Cache::get('mobileHomePageAdsCacheKey')->where('position', 1)->first();

    $hasMobileHomeOneAdTime = true;
    if ($mobileHomeAdOne && $mobileHomeAdOne->start_time && $mobileHomeAdOne->end_time && !\Carbon\Carbon::now()->between($mobileHomeAdOne->start_time, $mobileHomeAdOne->end_time)){
        $hasMobileHomeOneAdTime = false;
    }
@endphp

@if($mobileHomeAdOne && $hasMobileHomeOneAdTime)
    <div class="mobile-home-ad-1 marginTop15 {{ $mobileHomeAdOne->type != 4 ? 'advertisement' : '' }}">
        @if($mobileHomeAdOne->type != 4)
            <div class="header-ad" style="display: flex; justify-content: center;">
                @endif
                <div class="{{ $mobileHomeAdOne->type != 4 ? 'ad-box' : '' }}">
                    {{-- Type 1=DFP, 2=Code, 3=Image --}}
                    @if($mobileHomeAdOne->type == 3)
                        <a href="{{ $mobileHomeAdOne->external_link }}" target="_blank" rel="nofollow">
                            <img src="{{ asset(config('appconfig.adPath').$mobileHomeAdOne->mobile_image_path) }}" alt="Mobile Home One Ad">
                        </a>
                    @else
                        {!! $mobileHomeAdOne->code !!}
                    @endif
                </div>
                @if($mobileHomeAdOne->type != 4)
            </div>
        @endif
    </div>
@endif
