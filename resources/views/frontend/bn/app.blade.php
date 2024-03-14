<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ঢাকা প্রকাশ')</title>
    <link rel="icon" type="image/png" href="{{asset(config('appconfig.commonImagePath').'favicon.png')}}">

    <link rel="stylesheet" type="text/css"
          href="{{ asset('frontend-assets/plugins/bootstrap/bootstrap.min.css?v=2') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('frontend-assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/nav/nav.css') }}?id=2">
    <link rel="stylesheet" href="{{ asset('frontend-assets/common/css/responsive.css') }}">
    @if($_SERVER['REQUEST_URI'] !== '/')
        <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/lazyload/lazyload.css') }}">
    @endif

<!-- Custom css -->
    <link rel="stylesheet" href="{{ asset('frontend-assets/common/css/style.css') }}?id=24">
    <link rel="stylesheet" href="{{ asset('frontend-assets/common/css/custom.css') }}">
    <style>
        body {
            overflow-x: auto; /* Must be 'scroll' not 'auto' */
            -webkit-overflow-scrolling: touch;
        }
    </style>
    @yield('custom-css')

    <meta property="fb:pages" content="2273091126341395" />
    <meta property="fb:app_id" content="{{config('appconfig.fb_app_id')}}"/>
    <meta property="og:site_name" content="{{ config('app.url') }}"/>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@dhakaprokash24">
    <meta name="robots" content="index,follow">
    @yield('customMeta')

<!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-75HYGMGRDV"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-75HYGMGRDV');
    </script>

    <script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
    {{--<script>
        window.googletag = window.googletag || {cmd: []};
        googletag.cmd.push(function() {
            googletag.defineSlot('/22808327549/home_page_middle_two', [[320, 100], [930, 180], [970, 250], [970, 66], [320, 50], [970, 90]], 'div-gpt-ad-1663011772051-0').addService(googletag.pubads());

            googletag.defineSlot('/22808327549/home_page_middle_top', [[970, 250], [930, 180], [980, 90], [1024, 768], [960, 90], [970, 66], [980, 120], [728, 90], [950, 90], [970, 90]], 'div-gpt-ad-1663697188736-0').addService(googletag.pubads());
            // googletag.defineSlot('/22808327549/header_top_970_banner', [[970, 90], [970, 250], [970, 66]], 'div-gpt-ad-1664129741486-0').addService(googletag.pubads());
            googletag.defineSlot('/22808327549/header_top_970_banner', [[970, 90], [970, 250], [970, 66]], 'div-gpt-ad-1664214171220-0').addService(googletag.pubads());
            googletag.pubads().enableSingleRequest();
            googletag.enableServices();
        });
    </script>--}}
    @php
        $codes = isMobile() ? Cache::get('mobileDfpHeaderCodeCacheKey') : Cache::get('dfpHeaderCodeCacheKey');
    @endphp
    <script>
        window.googletag = window.googletag || {cmd: []};
        googletag.cmd.push(function() {
            @foreach($codes as $code)
            {!! $code !!}
            @endforeach
            googletag.pubads().enableSingleRequest();
            googletag.enableServices();
        });
    </script>

 <!-- Old One Signal -->
{{--    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" type="application/javascript" async></script>--}}
{{--    <script>--}}
{{--        window.OneSignal = window.OneSignal || [];--}}
{{--        OneSignal.push(function() {--}}
{{--            OneSignal.init({--}}
{{--                appId: "775f079a-a043-41ba-a8bf-68e438d4746d",--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
<!-- Old One Signal -->

    <!-- New One Signal -->
    <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
    <script>
        window.OneSignalDeferred = window.OneSignalDeferred || [];
        OneSignalDeferred.push(function(OneSignal) {
            OneSignal.init({
                appId: "95c4d1fd-0551-41ac-81b9-7c413358437b",
            });
        });
    </script>
    <!-- New One Signal -->

    {{--Auto Adsense Code--}}
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7072011042484597" crossorigin="anonymous"></script>
    <!-- Load ShareThis  -->
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=651137566b9a9300123b73f3&product=inline-share-buttons' async='async'></script>
    <!-- Load ShareThis  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<button type="button" id="back_to_top">
    <i class="fa fa-angle-double-up" aria-hidden="true"></i>
</button>
<div id="overlay" onclick="overlay_click('overlay');"></div>

@yield('fb-sdk')
<!-- Load Facebook SDK for JavaScript -->
{{--<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>--}}


<div id="loader"></div>
<div id="wraper" class="animate-bottom">
    @include('frontend.bn.common.header')

    @yield('mainContent')

    @include('frontend.bn.common.footer')
</div>

@if(isMobile())
    @include('frontend.bn.mobile-ads.common.footer-sticky')
@else
    @include('frontend.bn.ads.common.footer-sticky')
@endif
{{--@include('frontend.bn.partials.aniversery')--}}
<!-- facebook box -->
<div class="facebookBox" style="position:fixed; right:0;bottom:0">
{{--    <iframe--}}
{{--        src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fdhakaprokash24&tabs=timeline&width=340&height=70&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId"--}}
{{--        width="340"--}}
{{--        height="70"--}}
{{--        style="border: none; overflow: hidden;"--}}
{{--        scrolling="no"--}}
{{--        frameborder="0"--}}
{{--        allowfullscreen="true"--}}
{{--        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"--}}
{{--    ></iframe>--}}
    <div id="fb-root"></div>
    <script async src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0&appId=324551766607185&autoLogAppEvents=1" nonce="IOSWlxYX"></script>
    <div class="fb-page" data-href="https://www.facebook.com/dhakaprokash24" data-tabs="timeline" data-width="" data-height="70" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/dhakaprokash24" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/dhakaprokash24">Dhaka Prokash</a></blockquote></div>

</div>
<!--  Popup Global -->
@include('frontend.bn.ads.common.site-block-ad')
<!--  Popup Global -->
<!-- facebook box -->
<script src="{{ asset('frontend-assets/plugins/nav/nav.js') }}?id=26"></script>

@yield('custom-js')

{{--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-209170157-1"></script>--}}
{{--<script>--}}
{{--    window.dataLayer = window.dataLayer || [];--}}

{{--    function gtag() {--}}
{{--        dataLayer.push(arguments);--}}
{{--    }--}}

{{--    gtag('js', new Date());--}}

{{--    gtag('config', 'UA-209170157-1');--}}
{{--</script>--}}

<!-- Custom js -->
{{--<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
            appId: "e70f67c6-cd07-4af5-bdcb-eae0141e8f98",
        });
    });
</script>--}}

<script>
    let navbar = document.getElementById("stickyTopMenu");
    let navbarMobile = document.querySelector('.logo-menu');
    let sticky = navbar.offsetTop;
    let stickyMobile = navbarMobile.offsetTop;

    let scrollToTopBtn = document.getElementById("back_to_top");
    window.onscroll = function() {scrollFunction()};
    scrollToTopBtn.onclick = function() {topFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollToTopBtn.classList.add('show');
        } else {
            scrollToTopBtn.classList.remove('show');
        }

        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
        if (window.pageYOffset >= stickyMobile) {
            navbarMobile.classList.add("sticky")
        } else {
            navbarMobile.classList.remove("sticky");
        }
    }
    function topFunction() {
        document.querySelector('html').scrollIntoView({
            behavior: 'smooth'
        });
    }
</script>
</body>
</html>



