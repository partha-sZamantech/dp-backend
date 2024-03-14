<header class="d-print-none">
    {{-- Header Top Banner Ad--}}
    @include('frontend.bn.ads.common.top-banner-ad')

    <div class="scrollmenu sidenav" id="mySidenav">

        <div class="header-info">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 hidden-xs">

                        @php
                            $bn= new \App\Http\Controllers\Frontend\BanglaDateController(time(), 24);
                            // $bn= new \App\Http\Controllers\Frontend\BanglaDateController(time(), 0);
                              $bnDate=$bn->get_date();

                              $enDate = $bn->fFormatDate(date('l, d F Y'));
                        @endphp

                        <small style="display: block;">
                            <i class="fa fa-map-marker"></i> ঢাকা &nbsp;
                            <i class="fa fa-calendar"></i> {{ $enDate }}
                            | {{ $bnDate[0]." ".$bnDate[1]." ".$bnDate[2] }}
                        </small>

                        {{--<small style="display: block;">
                            <i class="fa fa-map-marker"></i> ঢাকা &nbsp;
                            <i class="fa fa-calendar"></i> {{ (new \App\Http\Controllers\Frontend\BanglaDateController())->fFormatDate(date('l, d F Y')) }}
                        </small>--}}
                    </div>
                    <div class="col-sm-8 text-right d-flex align-items-center justify-content-end m-flex-direction-column">
                        <div class="search-container">
                            <form class="search_submit" target="_blank" action="{{url('search')}}" method="get" id="cse-search-box" role="search">
                                <div class="input-group input-group-sm">
                                    <input class="form-control search_submit" placeholder="অনুসন্ধানের জন্য লিখুন..." name="q" id="q" type="text">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit" id="sa" name="sa" value=""><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>

                            {{--<button type="button" class="btn toggleSearchForm">
                                <i class="fa fa-search"></i>
                            </button>--}}
                        </div>

                        <div class="social-widgets d-flex align-items-center">
                            <a class="facebook" style="font-size: 20px;padding: 0px 8px;" href="https://www.facebook.com/dhakaprokash24" target="_blank" rel="nofollow">
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a class="twitter" style="font-size: 20px;padding: 0px 8px; display: flex" href="https://twitter.com/dhakaprokash24" target="_blank" rel="nofollow">
                                <svg height="18" width="18" viewBox="0 0 24 24" aria-hidden="true" class="r-k200y r-18jsvk2 r-4qtqp9 r-yyyyoo r-5sfk15 r-dnmrzs r-kzbkwu r-bnwqim r-1plcrui r-lrvibr"><g><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></g></svg>
{{--                                <i class="fa fa-twitter"></i>--}}
                            </a>

                            <a class="youtube" style="font-size: 20px;padding: 0px 8px;" href="https://www.youtube.com/c/DhakaProkash" target="_blank" rel="nofollow">
                                <i class="fa fa-youtube-play"></i>
                            </a>

                            <a class="instagram" style="font-size: 20px;padding: 0px 8px;" href="https://www.instagram.com/dhakaprokash24/" target="_blank" rel="nofollow">
                                <i class="fa fa-instagram"></i>
                            </a>

                            <a class="linkedin" style="font-size: 20px;padding: 0px 8px;" href="https://www.linkedin.com/company/dhakaprokash" target="_blank" rel="nofollow">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container header-container paddingTopBottom10 hidden-xs">
            <div class="row">
{{--                <div class="col-sm-4">--}}
{{--                    <img width="40" src="{{ asset('/images/newyear.jpg') }}" alt="Dhaka Prokash" style="width:350px;padding: 15px 0;">--}}
{{--                </div>--}}
{{--                <div class="col-sm-4 text-center">--}}
{{--                    <a href="{{ url('/') }}" class="lg-logo">--}}
{{--                        <img src="{{ asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->logo) }}" alt="Dhaka Prokash" style="width:350px;padding: 15px 0;">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="col-sm-4">--}}
{{--                    <img width="40" class="pull-right" src="{{ asset('/images/newyear.jpg') }}" alt="Dhaka Prokash" style="width:350px;padding: 15px 0;">--}}
{{--                </div>--}}
                <div class="col-sm-12 text-center">
                    <a href="{{ url('/') }}" class="lg-logo">
                        <img src="{{ asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->logo) }}" alt="Dhaka Prokash" style="width:350px;padding: 15px 0;">
                    </a>
                </div>
                {{-- Top Logo Right Ad--}}
{{--                <div class="col-sm-8 text-right" style="min-height: 90px">--}}
{{--                    @include('frontend.bn.ads.common.top-logo-right-ad')--}}
{{--                </div>--}}
            </div>
        </div>

        <div id="stickyTopMenu">
            <span class="closebtn" onclick="closeNav('mySidenav')">&times;</span>
            <div class="menu_container">
                <div class="container">
                    <ul>
                        <li class="{{ !request()->segment(1) ? 'active' : '' }}">
                            <a href="{{ url('') }}"><i class="fa fa-home"></i></a>
                        </li>
                        <li class="{{ request()->is('latest/posts')  ? 'active' : '' }}">
                            <a href="{{ url('/latest/posts') }}">সর্বশেষ</a>
                        </li>
                        @php
                            $categories = bnHeaderCategory();
                            $topCategories = $categories->take(12)->pluck('cat_slug')->toArray();
                        @endphp
                        @foreach($categories as $category)
                            @if(in_array($category->cat_slug, $topCategories))
                                <li class="{{ request()->segment(1) == $category->cat_slug ? 'active' : '' }}">
                                    <a href="{{ url('/'.$category->cat_slug) }}">{{ $category->cat_name_bn }}</a></li>
                            @else
                                <li class="{{ request()->segment(1) == $category->cat_slug ? 'active' : '' }} visible-xs">
                                    <a href="{{ url('/'.$category->cat_slug) }}">{{ $category->cat_name_bn }}</a></li>
                            @endif
                        @endforeach
                        <li>
                            <a href="{{ url('/video') }}" target="_blank">ভিজ্যুয়াল মিডিয়া</a>
                        </li>
                        <li class="visible-xs">
                            <a href="{{ url('/archive') }}">আর্কাইভ</a>
                        </li>
                        <li class="visible-xs">
                            <a href="{{ route('epaper', date('Y-m-d')) }}" target="_blank">ই-পেপার</a>
                        </li>
                    </ul>

                    <ul class="site_migrate hidden-xs">
                        <li><a href="{{ fEnRoot() }}">English</a></li>
                        <li><a href="{{ route('epaper', date('Y-m-d')) }}" target="_blank" style="font-weight: bold">ই-পেপার</a></li>
                    </ul>
                    <div class="all_category_btn hidden-xs">
                        <span onclick="open_mega_menu('all_category')"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp; সব </span>
                        <div class="all_category" id="all_category">
                            <div class="container">
                                <span class="caretd" onclick="close_mega_menu('all_category');">
                                    <i class="fa fa-close"></i>
                                </span>
                                <ul class="row">
                                    @foreach($categories as $category)
                                        <li class="col-sm-2 {{in_array($category->cat_slug, $topCategories) ? 'visible-xs': ''}}">
                                            <a href="{{ url('/'.$category->cat_slug) }}">{{ $category->cat_name_bn }}</a>
                                        </li>
                                    @endforeach
                                    <li class="col-sm-2"><a href="{{ url('/photo') }}">ফটো গ্যালারি</a></li>
                                    <li class="col-sm-2"><a href="{{ url('/archive') }}">আর্কাইভ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="logo-menu visible-xs clearfix">
        <div style="display: flex; justify-content: space-between; align-items: center; margin: 0 10px">
            <div onclick="openNav('mySidenav')">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
            <a href="{{ url('/') }}">
                <img src="{{ asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->logo) }}" alt="Dhaka Prokash" style="width: 200px;">
            </a>
            <div style="display: flex">
                <div class="mobile-en-btn">
                    <a href="{{ url('/english') }}" style="color: white;">EN</a>
                </div>

                <div class="mobile-en-btn" style="margin-left: 5px">
                    <a href="{{ route('epaper', date('Y-m-d')) }}" target="_blank" style="color: white;">e-P</a>
                </div>
            </div>
        </div>
    </div>
</header>
