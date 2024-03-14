<header class="d-print-none">
{{--     Header Top Banner Ad--}}
    @include('frontend.bn.ads.common.top-banner-ad')

    <div class="scrollmenu sidenav" id="mySidenav">

        <div class="header-info">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 hidden-xs">
                        @php
                            $bn= new \App\Http\Controllers\Frontend\BanglaDateController(time());
                            $bnDate=$bn->get_date();
                            $enDate = $bn->fFormatDate(date('l, d F Y'));
                        @endphp
                        <small style="display: block;">
                            <i class="fa fa-map-marker"></i> Dhaka &nbsp;
                            <i class="fa fa-calendar"></i> {{ date('l, d F Y') }}
                        </small>
                    </div>
                    <div class="col-sm-8 text-right d-flex align-items-center justify-content-end m-flex-direction-column">
                        <div class="search-container">
                            <form class="search_submit" target="_blank" action="{{fEnRoot('search')}}" method="get" id="cse-search-box" role="search">
                                <div class="input-group input-group-sm">
                                    <input class="form-control search_submit" placeholder="Write here to search" name="q" id="q" type="text">
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
                            <a class="btn facebook" href="https://www.facebook.com/dhakaprokash24" target="_blank" rel="nofollow">
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a class="btn twitter" href="https://twitter.com/dhakaprokash24" target="_blank" rel="nofollow">
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a class="btn youtube" href="https://www.youtube.com/c/DhakaProkash" target="_blank" rel="nofollow">
                                <i class="fa fa-youtube-play"></i>
                            </a>

                            <a class="btn instagram" href="https://www.instagram.com/dhakaprokash24/" target="_blank" rel="nofollow">
                                <i class="fa fa-instagram"></i>
                            </a>

                            <a class="btn linkedin" href="https://www.linkedin.com/company/dhakaprokash" target="_blank" rel="nofollow">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container header-container paddingTopBottom10 hidden-xs">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="{{ fEnRoot() }}" class="lg-logo">
                        <img src="{{ asset(config('appconfig.commonImagePath').Cache::get('enSiteSettings')->logo) }}" alt="Dhaka Prokash" style="width:350px;padding: 15px 0;">
                    </a>
                </div>
                {{-- Top Logo Right Ad--}}
                {{--<div class="col-sm-8 text-right" style="min-height: 90px">
                    @include('frontend.bn.ads.common.top-logo-right-ad')
                </div>--}}
            </div>
        </div>

        <div id="stickyTopMenu">
            <span class="closebtn" onclick="closeNav('mySidenav')">&times;</span>
            <div class="menu_container">
                <div class="container">
                    <ul>
                        <li class="{{ !request()->segment(2) ? 'active' : '' }}">
                            <a href="{{ fEnRoot() }}"><i class="fa fa-home"></i></a></li>
                        @php
                            $categories = enHeaderCategory();
                            $topCategories = $categories->take(11)->pluck('cat_slug')->toArray();
                        @endphp
                        @foreach($categories as $category)
                            @if(in_array($category->cat_slug, $topCategories))
                                <li class="{{ request()->segment(2) == $category->cat_slug ? 'active' : '' }}">
                                    <a href="{{ fEnRoot($category->cat_slug) }}" style="font-size: 15.5px">{{ $category->cat_name }}</a></li>
                            @else
                                <li class="{{ request()->segment(2) == $category->cat_slug ? 'active' : '' }} visible-xs">
                                    <a href="{{ fEnRoot($category->cat_slug) }}" style="font-size: 15.5px">{{ $category->cat_name }}</a></li>
                            @endif
                        @endforeach
                        <li class="visible-xs">
                            <a href="{{ fEnRoot('archive') }}">Archive</a>
                        </li>
                    </ul>

                    <ul class="site_migrate hidden-xs">
                        <li><a href="{{ url('/') }}">বাংলা</a></li>
                        <li><a href="{{ route('epaper', date('Y-m-d')) }}" target="_blank" style="font-weight: bold">ই-পেপার</a></li>
                    </ul>
                    <div class="all_category_btn hidden-xs">
                        <span onclick="open_mega_menu('all_category')"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp; All </span>
                        <div class="all_category" id="all_category">
                            <div class="container">
                                <span class="caretd" onclick="close_mega_menu('all_category');">
                                    <i class="fa fa-close"></i>
                                </span>
                                <ul class="row">
                                    @foreach($categories as $category)
                                        <li class="col-sm-2 {{in_array($category->cat_slug, $topCategories) ? 'visible-xs': ''}}">
                                            <a href="{{ fEnRoot($category->cat_slug) }}">{{ $category->cat_name }}</a>
                                        </li>
                                    @endforeach
                                    <li class="col-sm-2"><a href="{{ fEnRoot('archive') }}">Archive</a></li>
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
            <a href="{{ fEnRoot() }}">
                <img src="{{ asset(config('appconfig.commonImagePath').Cache::get('enSiteSettings')->logo) }}" alt="Dhaka Prokash" style="width: 185px;">
            </a>
            <div style="display: flex">
                <div class="mobile-en-btn">
                    <a href="{{ url('/') }}" style="color: white;">BN</a>
                </div>
{{--                <div class="mobile-en-btn" style="margin-left: 5px">--}}
{{--                    <a href="{{ route('epaper', date('Y-m-d')) }}" target="_blank" style="color: white;">e-P</a>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</header>
