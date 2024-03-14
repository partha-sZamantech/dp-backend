<header class="d-print-none">
    <div class="scrollmenu sidenav" id="mySidenav">

        {{-- Header Top Banner Ad--}}
        @include('frontend.bn.ads.common.top-banner-ad')

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
                            <i class="fa fa-map-marker"></i> ঢাকা &nbsp;
                            <i class="fa fa-calendar"></i> {{ $enDate }}
                            | {{ $bnDate[0]." ".$bnDate[1]." ".$bnDate[2] }}
                        </small>
                    </div>
                    <div class="col-sm-8 text-right d-flex align-items-center justify-content-end m-flex-direction-column">
                        <div class="search-container">
                            <form class="search_submit" action="" method="get" id="cse-search-box" role="search">
                                <input name="cx" value="" type="hidden">
                                <input name="cof" value="" type="hidden">
                                <input name="ie" value="utf-8" type="hidden">
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
                            <a class="btn facebook" href="https://www.facebook.com/dhakaprokash24" target="_blank" rel="nofollow">
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a class="btn twitter" href="https://twitter.com/dhakaprokash24" target="_blank" rel="nofollow">
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a class="btn youtube" href="https://www.youtube.com/channel/UCeB7K4IRCC_Rb1w5HswUPnQ" target="_blank" rel="nofollow">
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
                    <a href="{{ url('/') }}" class="lg-logo">
                        <img src="{{ asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->logo) }}" alt="Dhaka Prokash" style="width:350px;padding: 15px 0;">
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
                        <li class="{{ !request()->segment(1) ? 'active' : '' }}">
                            <a href="{{ url('/photo') }}"><i class="fa fa-home"></i></a>
                        </li>
                        @php
                            $categories = photoHeaderCategory();
                            $topCategories = $categories->take(8)->pluck('cat_slug')->toArray();
                        @endphp
                        @foreach($categories as $category)
                            @if(in_array($category->cat_slug, $topCategories))
                                <li class="{{ request()->segment(1) == $category->cat_slug ? 'active' : '' }}">
                                    <a href="{{ url('/photo/'.$category->cat_slug) }}">{{ $category->cat_name_bn }}</a>
                                </li>
                            @else
                                <li class="{{ request()->segment(1) == $category->cat_slug ? 'active' : '' }} visible-xs">
                                    <a href="{{ url('/photo/'.$category->cat_slug) }}">{{ $category->cat_name_bn }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
{{--                    <div class="all_category_btn hidden-xs">--}}
{{--                        <span onclick="open_mega_menu('all_category')"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp; সব </span>--}}
{{--                        <div class="all_category" id="all_category">--}}
{{--                            <div class="container">--}}
{{--                                <span class="caretd" onclick="close_mega_menu('all_category');">--}}
{{--                                    <i class="fa fa-close"></i>--}}
{{--                                </span>--}}
{{--                                <ul class="row">--}}
{{--                                    @foreach($categories as $category)--}}
{{--                                        <li class="col-sm-2">--}}
{{--                                            <a href="{{ url('/'.$category->cat_slug) }}">{{ $category->cat_name_bn }}</a>--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
{{--                                    <li class="col-sm-2"><a href="{{ url('/archive') }}">আর্কাইভ</a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
    <div class="logo-menu navbar-fixed-top visible-xs clearfix">
        <div style="display: flex; justify-content: space-between; align-items: center; margin: 0 10px">
            <div onclick="openNav('mySidenav')">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
            <a href="{{ url('/') }}">
                <img src="{{ asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->logo) }}" alt="Dhaka Prokash" style="width: 185px;">
            </a>
            <div class="mobile-en-btn">
                <a href="{{ fEnRoot() }}" style="color: white;">EN</a>
            </div>
        </div>
    </div>
</header>
