<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ঢাকা প্রকাশ')</title>
    <link rel="icon" type="image/png" href="{{asset(config('appconfig.commonImagePath').'favicon.png')}}">

    <link rel="stylesheet" type="text/css"
          href="{{ asset('frontend-assets/plugins/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('frontend-assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/nav/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/lazyload/lazyload.css') }}">

    <!-- Custom css -->
    <link rel="stylesheet" href="{{ asset('frontend-assets/common/css/style.css') }}?id=7655">

    @yield('custom-css')

    @yield('customMeta')
    <meta property="fb:app_id" content="{{config('appconfig.fb_app_id')}}"/>

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
</head>
<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v12.0&appId=2118935094895202&autoLogAppEvents=1" nonce="Q5ZCofvd"></script>
<button type="button" id="back_to_top">
    <i class="fa fa-angle-double-up" aria-hidden="true"></i>
</button>
<div id="overlay" onclick="overlay_click('overlay');"></div>

@yield('fb-sdk')

<div id="loader"></div>
<div id="wraper" class="animate-bottom">
    @include('frontend.photo.common.header')

    @yield('mainContent')

    @include('frontend.bn.common.footer')
</div>

@include('frontend.bn.ads.common.footer-sticky')


<script src="{{ asset('frontend-assets/plugins/lazyload/lazyload.js') }}"></script>
<script src="{{ asset('frontend-assets/plugins/nav/nav.js') }}"></script>

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

{{--<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
            appId: "e70f67c6-cd07-4af5-bdcb-eae0141e8f98",
        });
    });
</script>--}}
</body>
</html>



