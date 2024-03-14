<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dhaka Prokash')</title>
    <link rel="icon" type="image/png" href="{{asset(config('appconfig.commonImagePath').'favicon.png')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/plugins/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/nav/nav.css') }}?id=27">
    <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/lazyload/lazyload.css') }}">
    @yield('custom-css')
    <!-- Custom css -->
    <link rel="stylesheet" href="{{ asset('frontend-assets/common/css/style.css') }}?id=3">
    <link rel="stylesheet" href="{{ asset('frontend-assets/common/css/english-page.css') }}?id=523">
    <meta property="fb:app_id" content="{{config('appconfig.fb_app_id')}}"/>
    <meta property="og:site_name" content="{{ config('app.url') }}"/>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@dhakaprokash24">
    <meta name="robots" content="index,follow">
    @yield('customMeta')
    <script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
    <script>
        window.googletag = window.googletag || {cmd: []};
        googletag.cmd.push(function() {
            @foreach(Cache::get('dfpHeaderCodeCacheKey') as $code)
            {!! $code !!}
            @endforeach
            googletag.pubads().enableSingleRequest();
            googletag.enableServices();
        });
    </script>

    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" type="application/javascript" async></script>
    <script>
        window.OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "775f079a-a043-41ba-a8bf-68e438d4746d",
            });
        });
    </script>

    {{--Auto Adsense Code--}}
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7072011042484597" crossorigin="anonymous"></script>
</head>
<body>
{{--<div id="fb-root"></div>--}}
{{--<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v12.0&appId=2118935094895202&autoLogAppEvents=1" nonce="Q5ZCofvd"></script>--}}
<div id="overlay" onclick="overlay_click('overlay');"></div>
<button type="button" id="back_to_top">
    <i class="fa fa-angle-double-up" aria-hidden="true"></i>
</button>

@yield("fb-sdk")
<!-- Load Facebook SDK for JavaScript -->
{{--<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>--}}

<div id="loader"></div>
<div id="wraper" class="animate-bottom">
    @include('frontend.en.common.header')

    @yield('mainContent')

    @include('frontend.en.common.footer')
</div>

<script src="{{ asset('frontend-assets/plugins/nav/nav.js') }}?id=26"></script>
@yield('custom-js')

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-209170157-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-209170157-1');
</script>

<!-- Custom js -->
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
