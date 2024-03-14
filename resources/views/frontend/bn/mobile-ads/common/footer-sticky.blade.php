{{-- Mobile Footer Sticky Ad --}}
@php
    $mobileFooterStickyAd = Illuminate\Support\Facades\Cache::get('mobileCommonAdsCacheKey')->where('position', 3)->first();
@endphp

{{--@if($mobileFooterStickyAd && $hasFooterStickyAdTime)--}}
@if($mobileFooterStickyAd)
    @if($mobileFooterStickyAd->type != 4)
    <div class="mobile-footer-sticky-ad footer-ad d-print-none {{ $mobileFooterStickyAd->type != 4 ? 'advertisement' : '' }}" style="display: flex; justify-content: center; margin-top: 4px;">
    @else
    <div class="footer-ad d-print-none {{ $mobileFooterStickyAd->type != 4 ? 'advertisement' : '' }}" style="text-align: center">
    @endif
        <div class="{{ $mobileFooterStickyAd->type != 4 ? 'ad-box' : '' }}">
            {{-- Type 1=DFP, 2=Code, 3=Image --}}
            @if($mobileFooterStickyAd->type == 3)
                <a href="{{ $mobileFooterStickyAd->external_link }}" target="_blank" rel="nofollow">
                    <img src="{{ asset(config('appconfig.adPath').$mobileFooterStickyAd->mobile_image_path) }}" alt="Footer Ad">
                </a>
            @else
                {!! $mobileFooterStickyAd->code !!}
            @endif
        </div>

        <div class="ad-close-btn" onclick="hideFooterAd()"></div>
        <script type="text/javascript">
            function hideFooterAd() {
                document.querySelector('.footer-ad').style.display = "none";
                document.querySelector('footer').style.paddingBottom = "0";
            }
        </script>
    </div>
@else
    <script>
        document.querySelector('footer').style.paddingBottom = "0";
    </script>
@endif
