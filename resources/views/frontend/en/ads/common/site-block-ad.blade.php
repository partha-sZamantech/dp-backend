{{-- Position 4 = Site Block Ad --}}
{{--@php
    $siteBlockAd = Illuminate\Support\Facades\Cache::get('commonAdsCacheKey')->where('position', 4)->first();

    if (!empty($siteBlockAd)) {
        $cookieKey = '__dp24m-site-block';
        $minuteDifference = 5;  //show after a specific period in minutes
    //        $numberToShow = 3;

        $hasSiteBlockAdTime = false;
        if (empty($siteBlockAd->end_time) && !Illuminate\Support\Facades\Cookie::has($cookieKey)) {
            $difference = (strtotime($siteBlockAd->end_time) - strtotime($siteBlockAd->start_time)) / 60;

            //Time Difference
            Illuminate\Support\Facades\Cookie::queue(Illuminate\Support\Facades\Cookie::make($cookieKey, 'popup-blocker', $minuteDifference, null, null, false, false));
            $hasSiteBlockAdTime = true;
        }
    }

    /*$hasSiteBlockAdTime = true;
    if ($siteBlockAd && $siteBlockAd->start_time && $siteBlockAd->end_time && !\Carbon\Carbon::now()->between($siteBlockAd->start_time, $siteBlockAd->end_time)){
        $hasSiteBlockAdTime = false;
    }*/
@endphp--}}

@php($siteBlockAd = Cache::get('commonAdsCacheKey')->where('position', 4)->first())

{{--@if($siteBlockAd && $hasSiteBlockAdTime)--}}
@if($siteBlockAd)
    <div class="site-block-container">
        <style>
            #siteblock.site-block {
                display: none;
                position: fixed;
                z-index: 10000;
                padding-top: 100px;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                text-align: center;
                overflow: auto;
                background-color: rgba(0, 0, 0, .6)
            }

            #siteblock .siteblock-content {
                margin: auto;
                display: table;
                position: relative;
                -webkit-animation-name: zoom;
                -webkit-animation-duration: .6s;
                animation-name: zoom;
                animation-duration: .6s;
                max-width: 90%
            }

            #siteblock .siteblock-content img {
                position: relative
            }

            #siteblock .block-close {
                position: absolute;
                background: #f8f8f8;
                opacity: 1;
                right: -10px;
                top: -10px;
                width: 26px;
                height: 26px;
                line-height: 27px;
                border-radius: 50%;
                box-shadow: 0 0 0 5px #ccc;
                z-index: 1
            }

            #siteblock .block-close:focus, #siteblock .block-close:hover {
                color: #fff;
                background: #000;
                text-decoration: none;
                cursor: pointer
            }

            #adTimeCountdown {
                position: absolute;
                color: #fff;
                z-index: 1;
                top: -60px;
                font-weight: 700;
                left: 50%;
                transform: translateX(-50%)
            }
        </style>

        <div id="siteblock" class="site-block">
            <div class="siteblock-content">
                <span id="adTimeCountdown"></span>
                <span class="block-close">&times;</span>
                <a href="{{ $siteBlockAd->external_link }}" target="_blank" rel="nofollow">
                    {{-- Type 1=DFP, 2=Code, 3=Image --}}
                    @if($siteBlockAd->type == 3)
                        <img src="{{ asset(config('appconfig.adPath').$siteBlockAd->desktop_image_path) }}" class="hidden-sm hidden-xs" alt="Interstitial Ad" style="max-width:660px;">

                        <img src="{{ asset(config('appconfig.adPath').$siteBlockAd->mobile_image_path) }}" class="hidden-md hidden-lg hidden-xl" alt="Interstitial Ad" style="max-width:320px;">
                    @else
                        {!! $siteBlockAd->code !!}
                    @endif
                </a>
            </div>
        </div>

        <script>
            var siteblock = document.getElementById('siteblock');
            var span = document.getElementsByClassName("block-close")[0];
            span.onclick = function () {
                siteblock.style.display = "none";
            };
            window.onclick = function (event) {
                if (event.target == siteblock) {
                    siteblock.style.display = "none";
                }
            };
            // set time for showing siteblock after 2 seconds of page loading
            setTimeout(function () {
                siteblock.style.display = "block";
            }, 100);
            // set time for stopping/closing siteblock for 5 seconds
            setTimeout(function () {
                siteblock.style.display = "none";
            }, 6000);
            // adTimeCountdown
            var timeleft = 6;
            var adTimeCountdown = setInterval(function () {
                document.getElementById("adTimeCountdown").innerHTML = timeleft;
                timeleft -= 1;
                if (timeleft < 0) {
                    clearInterval(adTimeCountdown);
                    document.getElementById("adTimeCountdown").innerHTML = "0"
                }
            }, 1000);
        </script>

    </div>
@endif
