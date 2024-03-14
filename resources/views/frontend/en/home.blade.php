@extends('frontend.en.app')

@section('title', cache('enSiteSettings')->title)

@section('customMeta')
    <meta content="300" http-equiv="refresh">
    <meta name="description" content="{{ Cache::get('enSiteSettings')->meta_description }}"/>
    <link rel="canonical" href="{{ fEnRoot() }}">
    <meta name="keywords" content="{{ Cache::get('enSiteSettings')->meta_keyword }}">

    <meta property="og:url" content="{{fEnRoot()}}"/>
    <meta property="og:title" content="{{ Cache::get('enSiteSettings')->title }}"/>
    <meta property="og:image"
          content="{{ asset(config('appconfig.commonImagePath').Cache::get('enSiteSettings')->og_image) }}"/>
    <meta property="og:description" content="{{ Cache::get('enSiteSettings')->meta_description }}"/>

    <meta name="twitter:title" content="{{ Cache::get('enSiteSettings')->title }}">
    <meta name="twitter:description" content="{{ Cache::get('enSiteSettings')->meta_description }}">
    <meta name="twitter:image"
          content="{{ asset(config('appconfig.commonImagePath').Cache::get('enSiteSettings')->og_image) }}">

    <script type="application/ld+json" data-schema="Organization">{
        "@context":"https://schema.org",
        "@type":"Organization",
        "name":"DhakaProkash24.com",
        "alternateName":"Dhaka Prokash",
        "description": "{{ Cache::get('enSiteSettings')->meta_description }}",
        "foundingDate":"",
        "url":"{{fEnRoot()}}",
        "sameAs": [
            "https://www.facebook.com/dhakaprokash24",
            "https://twitter.com/dhakaprokash24",
            "https://www.youtube.com/channel/UCeB7K4IRCC_Rb1w5HswUPnQ",
            "https://www.linkedin.com/company/dhakaprokash"
        ],
        "image": [
            "{{ asset(config('appconfig.commonImagePath').Cache::get('enSiteSettings')->logo) }}"
        ],
        "logo":{
            "@type": "ImageObject",
            "name" : "Dhaka Prokash",
            "url": "{{ asset(config('appconfig.commonImagePath').Cache::get('enSiteSettings')->logo) }}",
            "width": 350 ,
            "height": 60
        },
        "email":"info@dhakaprokash24.com",
        "telephone":"+8809613331010",
        "address":{
            "@type":"PostalAddress",
            "description":"93, Kazi Nazrul Islam Avenue, (5th Floor) Karwan Bazar, Dhaka-1215.",
            "postalCode":"1215"
            }
        }
    </script>
    <script type="application/ld+json" data-schema="WebPage">{
        "@type":"Website",
        "name":"Dhaka Prokash",
        "description": "{{ Cache::get('enSiteSettings')->meta_description }}",
        "url":"{{fEnRoot()}}",
        "interactivityType":"mixed",
        "headline":"{{cache('enSiteSettings')->title}}",
        "keywords":"{{ Cache::get('enSiteSettings')->meta_keyword }}",
        "copyrightHolder": {
            "@type":"NewsMediaOrganization",
            "name":"Dhaka Prokash"
        },
        "potentialAction": {
            "@type":"SearchAction",
            "target":{
                "@type": "EntryPoint",
                "urlTemplate": "{{fEnRoot('search')}}?q={search_term_string}"
            },
            "query-input":"required name=search_term_string"
        },
        "mainEntityOfPage": {
            "@type":"WebPage",
            "@id":"{{fEnRoot()}}"
        },
        "@context":"https://schema.org"
    }
    </script>
@endsection

@php($enCacheSettings = Cache::get('enSiteSettings'))

@section('custom-css')
    @if($breakingContents->count())
        <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/breaking/breaking.css') }}?id=124">
    @endif

    <link rel="stylesheet" href="{{ asset('frontend-assets/common/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/common/css/english-page.css') }}?id=555">
@endsection

@section('mainContent')

    <div class="main-content">

        <div class="container">
            {{-- Marquee/scroll news --}}
            @if($breakingContents->count())
                @include('frontend.en.common.breaking-marquee')
            @endif

            {{-- Middle Top Ad --}}
{{--            @include('frontend.en.ads.home.middle-1-ad')--}}

            <div class="marginTop20">
                <div class=" col-sm-12 no-padding ">
                    @if($specialTopContents ->count())
                        @php($spTopContent = $specialTopContents->shift())
                        <div class="col-sm-5  leftPadding0 rightPadding15 border-bottom-pc-none marginBottom10Mobile">
                            @if($spTopContent)
                                @php($sURL = fEnURL($spTopContent->content_id, $spTopContent->category->cat_slug, ($spTopContent->subcategory->subcat_slug ?? null), $spTopContent->content_type))
                                <a href="{{ $sURL }}" title="{{ $spTopContent->content_heading }}">
                                    <div class="imgBox">
                                        <img class="img-responsive " style=""
                                             src="{{ $spTopContent->img_bg_path ? asset(config('appconfig.contentImagePath').$spTopContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                             alt="{{ $spTopContent->content_heading }}"
                                             title="{{ $spTopContent->content_heading }}">
                                    </div>
                                    <h2 class="headline-font marginTop10 ">
                                        @if($spTopContent->content_sub_heading)
                                            <span class="color-text">{{ $spTopContent->content_sub_heading }}/</span>
                                        @endif
                                        {{ $spTopContent->content_heading }}
                                    </h2>
                                    <p class="details-font">
                                        @if(!empty($spTopContent->video_id) || !empty($spTopContent->podcast_id))
                                            <span class="video-audio-icon">
                                                @if(!empty($spTopContent->video_id))
                                                    <i class="fa fa-play"></i>
                                                @endif
                                                @if(!empty($spTopContent->podcast_id))
                                                    <i class="fa fa-volume-up"></i>
                                                @endif
                                            </span>
                                        @endif
                                        {{ fGetWord(fFormatString($spTopContent->content_details), 30) }}
                                    </p>
                                <a/>
                            @endif
                        </div>

                        <div class="col-sm-7 no-padding">
                            @php($secondSpecialTopContent = $specialTopContents->shift())
                                <div class="col-sm-12 no-padding">
                                    @if($secondSpecialTopContent)
                                        @php($sURL = fEnURL($secondSpecialTopContent->content_id, $secondSpecialTopContent->category->cat_slug, ($secondSpecialTopContent->subcategory->subcat_slug ?? null), $secondSpecialTopContent->content_type))
                                    <a href="{{ $sURL }}">
                                        <div class="col-sm-6 no-padding">
                                            <img class="img-responsive rightPadding15"
                                                 src="{{ $secondSpecialTopContent->img_bg_path ? asset(config('appconfig.contentImagePath').$secondSpecialTopContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                                 alt="{{$secondSpecialTopContent->content_heading}}" title="{{ $secondSpecialTopContent->content_heading }}">
                                        </div>
                                        <div class="col-sm-6 no-padding marginTop10Mobile">
                                            <h4 class="marginTop5 headline-font ">
                                                @if($secondSpecialTopContent->content_sub_heading)
                                                    <span
                                                        class="color-text">{{ $secondSpecialTopContent->content_sub_heading }}
                                                    </span>
                                                    /
                                                @endif
                                                {{ $secondSpecialTopContent->content_heading }}
                                            </h4>
                                            <p class="details-font font-details">
                                                @if(!empty($secondSpecialTopContent->video_id) || !empty($secondSpecialTopContent->podcast_id))
                                                    <span class="video-audio-icon">
                                                        @if(!empty($secondSpecialTopContent->video_id))
                                                            <i class="fa fa-play"></i>
                                                        @endif
                                                        @if(!empty($secondSpecialTopContent->podcast_id))
                                                            <i class="fa fa-volume-up"></i>
                                                        @endif
                                                    </span>
                                                @endif
                                                {{ fGetWord(fFormatString($secondSpecialTopContent->content_details), 30) }}
                                            </p>
                                        </div>
                                    </a>
                                    @endif
                                </div>

                            <div class="col-sm-12 marginTop10 no-padding" style="border-top: 1px solid #e2e2e2;">
                                @php($spLastTwoContents = $specialTopContents->splice(0,2))
                                <div class="col-sm-6  marginTop10 no-padding border-right-mob">
                                    <div class=" rem-first-border special-top-middle">
                                        @foreach($spLastTwoContents as $content)
                                            @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                            <div class="media">
                                                <a href="{{ $sURL }}">
                                                    <div class="imgBox">
                                                        <img class="img-responsive"
                                                             src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                                             alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                        <h4 class="media-heading headline-font marginTop5">
                                                            @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                                <span class="video-audio-icon">
                                                                     @if(!empty($content->video_id))
                                                                        <i class="fa fa-play"></i>
                                                                    @endif
                                                                    @if(!empty($content->podcast_id))
                                                                        <i class="fa fa-volume-up"></i>
                                                                    @endif
                                                                </span>
                                                            @endif
                                                            @if($content->content_sub_heading)
                                                                <span
                                                                    class="color-text">{{ $content->content_sub_heading }}
                                                                </span>
                                                                /
                                                            @endif
                                                            {{ $content->content_heading }}
                                                        </h4>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6 no-padding">
                                    @if($enSpecialTopVideos->count())
                                        @php($enEnglishTopThreeVideos = $enSpecialTopVideos->splice(0,3))
                                        <div class="col-sm-12 special-top-video-box leftPadding10 marginTop10">
                                            @foreach($enEnglishTopThreeVideos as $video)
                                                <div class="row video-margin-bottom no-padding">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <div class="video-icon">
                                                                <i class="fa fa-play-circle"></i>
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h4 class="media-heading headline-font">
                                                                <a href="{{ fEnVideoURL($video->id, $video->category->slug) }}"
                                                                   target="_blank"
                                                                   rel="nofollow"> {{ $video->title }} </a>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                </div>

                <div class="col-sm-12 no-padding">
                    <div class="col-sm-9 no-padding marginTopBottom20 marginBottom10Mobile">
                        {{-- Middle One Ad --}}
{{--                        @include('frontend.en.ads.home.middle-2-ad')--}}
                        <div class="row special-sub flexRow marginBottom10">
                            @php($spOtherContents = $specialTopContents->splice(0, 6))
                            @if($spOtherContents)
                                @foreach($spOtherContents as $content)
                                    @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="col-sm-4 col-xs-6">
                                        <div class="single_sub">
                                            <a href="{{ $sURL }}">
                                                <div class="imgbox">
                                                    <img class="img-responsive"
                                                         src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                                         alt=" {{ $content->content_heading }}"
                                                         title="{{ $content->content_heading }}">
                                                </div>
                                                <h4 class="headline-font" style="margin-bottom: 10px">
                                                    @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                        <span class="video-audio-icon">
                                                                     @if(!empty($content->video_id))
                                                                <i class="fa fa-play"></i>
                                                            @endif
                                                            @if(!empty($content->podcast_id))
                                                                <i class="fa fa-volume-up"></i>
                                                            @endif
                                                                </span>
                                                    @endif
                                                    @if($content->content_sub_heading)
                                                        <span
                                                            class="color-text">{{ $content->content_sub_heading }}
                                                        </span>
                                                        /
                                                    @endif
                                                    {{ $content->content_heading }}

                                                </h4>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        {{-- Middle Two Ad --}}
{{--                        @include('frontend.en.ads.home.middle-3-ad')--}}
                        <div class="col-sm-12 no-padding marginTop10">
                            {{--National--}}
                            <div class="col-sm-12 no-padding marginBottom10" style="border-top: 2px solid #3375AF">
                                <a href="{{ fEnRoot('national') }}" class="category-name">National
                                    <span>
                                        <i class="fa fa-long-arrow-down color-text">
                                        </i>
                                    </span>
                                </a>
                            </div>
                            <div class="col-sm-12 no-padding">
                                @if($nationalContents)
                                    <div
                                        class="col-sm-6 border-bottom-pc-none rightPadding10 leftPadding0 marginBottom10Mobile">
                                        @php($leadNationalContent = $nationalContents->shift())
                                        @if($leadNationalContent)
                                            @php($sURL = fEnURL($leadNationalContent->content_id, $leadNationalContent->category->cat_slug, ($leadNationalContent->subcategory->subcat_slug ?? null), $leadNationalContent->content_type))
                                            <a href="{{ $sURL }}">
                                                <img class="img-responsive "
                                                     src="{{ $leadNationalContent->img_bg_path ? asset(config('appconfig.contentImagePath').$leadNationalContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                                     alt="">
                                                <h3 class="headline-font marginTop10" style="margin-right: 10px">
                                                    @if($leadNationalContent->content_sub_heading)
                                                        <span class="color-text">{{ $leadNationalContent->content_sub_heading }} /</span>
                                                    @endif
                                                    {{ $leadNationalContent->content_heading }}
                                                </h3>
                                                <p class="details-font" ; style="margin-right: 10px">
                                                    @if(!empty($leadNationalContent->video_id) || !empty($leadNationalContent->podcast_id))
                                                        <span class="video-audio-icon">
                                                                @if(!empty($leadNationalContent->video_id))
                                                                <i class="fa fa-play"></i>
                                                            @endif
                                                            @if(!empty($leadNationalContent->podcast_id))
                                                                <i class="fa fa-volume-up"></i>
                                                            @endif
                                                            </span>
                                                    @endif
                                                    {{ fGetWord(fFormatString($leadNationalContent->content_details),45) }}
                                                </p>
                                            </a>
                                        @endif
                                    </div>
                                    @php($nationalContents = $nationalContents->all())
                                    @if($nationalContents)
                                        <div class="col-sm-6 rightPadding0 leftPadding10 marginBottom10Mobile">
                                            <div class=" first col-sm-12 no-padding border-bottom-mob marginBottom10">
                                                @foreach($nationalContents as $content)
                                                    @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                    <div class="col-sm-6 cat-column">
                                                        <a href="{{ $sURL }}">
                                                            <img class="img-responsive display-none-mob" style=""
                                                                 src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                                                 alt="">
                                                            <h4 class="headline-font">
                                                                @if($content->content_sub_heading)
                                                                    <span
                                                                        class="color-text">{{ $content->content_sub_heading }}</span>
                                                                    /
                                                                @endif
                                                                @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                                    <span class="video-audio-icon">
                                                                @if(!empty($content->video_id))
                                                                            <i class="fa fa-play"></i>
                                                                        @endif
                                                                        @if(!empty($content->podcast_id))
                                                                            <i class="fa fa-volume-up"></i>
                                                                        @endif
                                                            </span>
                                                                @endif
                                                                {{ $content->content_heading }}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    @if($loop->iteration === 2)
                                            </div>
                                            <div class="second col-sm-12 no-padding">
                                                @endif
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                    @endif
                            </div>
                        </div>
                        <div class="col-sm-12 no-padding">
                            {{--Middle Three Ad--}}
                            @if(!isMobile())
                                @include('frontend.bn.ads.home.middle-4-ad')
                            @endif
                        </div>
                        <div class=" col-sm-12 no-padding marginTop10">
                            {{--                        International--}}
                            <div class="col-sm-12 no-padding marginBottom10" style="border-top: 2px solid #3375AF">
                                <a href="{{ fEnRoot('international') }}" class="category-name">International
                                    <span>
                                        <i class="fa fa-long-arrow-down color-text">
                                        </i>
                                    </span>
                                </a>
                            </div>
                            @if($internationalContents)
                                <div class="d-flex m-flex-column col-sm-12 no-padding marginBottom10">
                                    @php($leadIntContent = $internationalContents->shift())
                                    @php($leadIntContentURL = fEnURL($leadIntContent->content_id, $leadIntContent->category->cat_slug, ($leadIntContent->subcategory->subcat_slug ?? null), $leadIntContent->content_type))
                                    <div class="order2 col-sm-6 leftPadding10 rightPadding10 border-bottom-pc-none">
                                        <a href="{{ $sURL }}">
                                            <div class="imgBox">
                                                <img class="img-responsive "
                                                     src="{{ $leadIntContent->img_bg_path ? asset(config('appconfig.contentImagePath').$leadIntContent->img_bg_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg')  }}"
                                                     alt="{{ $leadIntContent->content_heading }}">
                                            </div>
                                            <h3 class="headline-font marginTop10">
                                                @if($leadIntContent->content_sub_heading)
                                                    <span
                                                        class="color-text">{{ $leadIntContent->content_sub_heading }}</span>
                                                    /
                                                @endif
                                                @if(!empty($leadIntContent->video_id) || !empty($leadIntContent->podcast_id))
                                                    <span class="video-audio-icon">
                                                        @if(!empty($leadIntContent->video_id))
                                                            <i class="fa fa-play"></i>
                                                        @endif
                                                        @if(!empty($leadIntContent->podcast_id))
                                                            <i class="fa fa-volume-up"></i>
                                                        @endif
                                                    </span>
                                                @endif
                                                {{ $leadIntContent->content_heading }}

                                            </h3>
                                            <p class="details-font marginTop10">
                                                {{ fGetWord(fFormatString($leadIntContent->content_details),45) }}
                                            </p>
                                        </a>
                                    </div>
                                    @php($intContents = $internationalContents->all())
                                    @if($intContents)
                                        <div class="order1 col-sm-3  rightPadding10 leftPadding0 border-right-mob ">
                                            @foreach($intContents as $content)
                                                @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                <div
                                                    class="int-content col-sm-12 no-padding border-bottom marginTop10Mobile">
                                                    <a href="{{ $sURL }}">
                                                        <img class="img-responsive display-none-mob" style=""
                                                             src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                                             alt="">
                                                        <h4 class="headline-font ">
                                                            @if($content->content_sub_heading)
                                                                <span
                                                                    class="color-text">{{ $content->content_sub_heading }}</span>
                                                                /
                                                            @endif
                                                            @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                                <span class="video-audio-icon">
                                                                @if(!empty($content->video_id))
                                                                        <i class="fa fa-play"></i>
                                                                    @endif
                                                                    @if(!empty($content->podcast_id))
                                                                        <i class="fa fa-volume-up"></i>
                                                                    @endif
                                                            </span>
                                                            @endif
                                                            {{ $content->content_heading }}

                                                        </h4>
                                                        <p class="details-font display-none-mob display-none-pc">
                                                            {{ fGetWord(fFormatString($content->content_details),25) }}
                                                        </p>
                                                    </a>
                                                </div>
                                                @if($loop->iteration === 2)
                                        </div>
                                        <div class="order3 col-sm-3  rightPadding0 leftPadding10 border-left-mob ">
                                            @endif
                                            @endforeach
                                        </div>
                                    @endif
                                    @endif
                                </div>

                        </div>
                        <div class="col-sm-12 no-padding">
                            {{-- Middle four Ad --}}
{{--                            @include('frontend.en.ads.home.middle-5-ad')--}}
                        </div>
                        <div class="col-sm-12 no-padding marginTop10 marginBottom20mobile" style="border-top: 2px solid #3375AF">
                            {{--                        Politics--}}
                            <div class="col-sm-12 no-padding marginBottom10">
                                <a href="{{ fEnRoot('politics') }}" class="category-name">Politics
                                    <span>
                                        <i class="fa fa-long-arrow-down color-text">
                                        </i>
                                    </span>
                                </a>
                            </div>
                            @if($politicsContents)
                                @php($politicsContents = $politicsContents->splice(0,4))
                                <div class="col-sm-12 no-padding marginBottom10Mobile">
                                    @foreach($politicsContents as $content)
                                        @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                        <div class="col-sm-3 cat-column marginBottom10Mobile border-bottom-pc-none"
                                             style="border-right: none !important;">
                                            <a href="{{ $sURL }}">
                                                <img class="img-responsive " style=""
                                                     src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg')   }}"
                                                     alt="">
                                                <h4 class="headline-font">
                                                    @if($content->content_sub_heading)
                                                        <span
                                                            class="color-text">{{ $content->content_sub_heading }}</span>
                                                        /
                                                    @endif
                                                    @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                        <span class="video-audio-icon">
                                                        @if(!empty($content->video_id))
                                                                <i class="fa fa-play"></i>
                                                            @endif
                                                            @if(!empty($content->podcast_id))
                                                                <i class="fa fa-volume-up"></i>
                                                            @endif
                                                    </span>
                                                    @endif
                                                    {{ $content->content_heading }}
                                                </h4>
                                                <p class="details-font">
                                                    {{ fGetWord(fFormatString($content->content_details),8) }}
                                                </p>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-12 no-padding marginTop10" style="border-top: 2px solid #3375AF">
                            {{--                        Economy--}}
                            <div class="col-sm-12 no-padding marginBottom10">
                                <a href="{{ fEnRoot('economy') }}" class="category-name">Economy
                                    <span>
                                        <i class="fa fa-long-arrow-down color-text">
                                        </i>
                                    </span>
                                </a>
                            </div>
                            @if($economyContents)
                                @php($economyContents = $economyContents->splice(0,4))
                                <div class="col-sm-12 no-padding">
                                    @foreach($economyContents as $content)
                                        @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                        <div class="col-sm-3 cat-column marginBottom10Mobile"
                                             style="border-right: none !important;">
                                            <a href="{{ $sURL }}">
                                                <img class="img-responsive " style=""
                                                     src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg')   }}"
                                                     alt="">
                                                <h4 class="headline-font">
                                                    @if($content->content_sub_heading)
                                                        <span
                                                            class="color-text">{{ $content->content_sub_heading }}</span>
                                                        /
                                                    @endif
                                                    @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                        <span class="video-audio-icon">
                                                                @if(!empty($content->video_id))
                                                                <i class="fa fa-play"></i>
                                                            @endif
                                                            @if(!empty($content->podcast_id))
                                                                <i class="fa fa-volume-up"></i>
                                                            @endif
                                                        </span>
                                                    @endif
                                                    {{ $content->content_heading }}
                                                </h4>
                                                <p class="details-font">
                                                    {{ fGetWord(fFormatString($content->content_details),8) }}
                                                </p>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3 marginTop10 leftPadding10 rightPadding10">

                        <div class="marginTop10">
                            @include('frontend.bn.ads.home.right-1-ad')
                        </div>
                        <!-- Tab links -->
                        <div class="marginTop10 marginBottom20" style="box-shadow: 0 2px 1px 1px #d5d5d5;">
                            @include('frontend.en.layouts.latestPopularBox')
                        </div>

                        @include('frontend.en.ads.home.right-2-ad')

                        <div class="marginBottom20 en_bg">
                            <div class="marginBottom10" style="border-bottom: 1px solid">
                                <a href="" class="category-name">বাংলা
                                    <span>
                                        <i class="fa fa-caret-right color-text">
                                        </i>
                                        <i class="fa fa-caret-right color-text">
                                        </i>
                                    </span>
                                </a>
                            </div>
                            <div class="cat-box-with-media default-height rem-first-border">
                                @foreach($bnContents as $content)
                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media hover-color">
                                        <div class="media-body">
                                            <h4 class="details-font">
                                                <a href="{{ $sURL }}">
                                                    @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                        <span class="video-audio-icon">
                                                        @if(!empty($content->video_id))
                                                                <i class="fa fa-play"></i>
                                                            @endif
                                                            @if(!empty($content->podcast_id))
                                                                <i class="fa fa-volume-up"></i>
                                                            @endif
                                                    </span>
                                                    @endif
                                                    @if($content->content_sub_heading)
                                                        {{--                                                    <b class="sub-heading">{{ $content->content_sub_heading }}</b>--}}
                                                        <span
                                                            class="color-text">{{ $content->content_sub_heading }}</span>
                                                        /
                                                    @endif
                                                    {{ $content->content_heading }}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        @include('frontend.en.ads.home.right-3-ad')

                        @if(!isMobile())
                            @include('frontend.bn.ads.home.right-4-ad')
                        @endif

                        {{-- If has special section show the section, otherwise show the ads --}}
                        @if($enCacheSettings->show_special == 0 && $specialSectionContents)

                            <div class="marginBottom20 special-widget-corona no-padding"
                                 style="background: antiquewhite; padding: 10px;">
                                <div class="marginBottom10" style="border-bottom: 1px solid">
                                    <a href="{{ $enCacheSettings->special_link ?? '' }}"
                                       class="category-name">{{ $enCacheSettings->special_title ?? 'বিশেষ আয়োজন' }}
                                        <span>
                                        <i class="fa fa-caret-right color-text">
                                        </i>
                                        <i class="fa fa-caret-right color-text">
                                        </i>
                                    </span>
                                    </a>
                                </div>
                                <div class="cat-box-with-media default-height rem-first-border"
                                     style="height: 470px; overflow: auto;">
                                    @foreach($specialSectionContents as $content)
                                        @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                        <div class="media" style="padding: 0!important;">
                                            <div class="media-body">
                                                <h4 class="details-font" style="font-weight: 600">
                                                    <a href="{{ $sURL }}">
                                                        @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                            <span class="video-audio-icon">
                                                            @if(!empty($content->video_id))
                                                                    <i class="fa fa-play"></i>
                                                                @endif
                                                                @if(!empty($content->podcast_id))
                                                                    <i class="fa fa-volume-up"></i>
                                                                @endif
                                                        </span>
                                                        @endif
                                                        @if($content->content_sub_heading)
                                                            {{--                                                        <b class="sub-heading">{{ $intTopContent->content_sub_heading }}</b>--}}
                                                            <span
                                                                class="color-text">{{ $content->content_sub_heading }}</span>
                                                            /
                                                        @endif
                                                        {{ $content->content_heading }}
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        @else
                            {{-- Home Page Right Five Ad--}}
{{--                            @include('frontend.en.ads.home.right-5-ad')--}}

                            {{-- Home Page Right Six Ad--}}
{{--                            @include('frontend.en.ads.home.right-6-ad')--}}
                        @endif
                        {{-- Home Page Right Seven Ad--}}
{{--                        @include('frontend.en.ads.home.right-7-ad')--}}
                    </div>
                </div>
                <div class="col-sm-12 no-padding marginTop10">
                    <div class="col-sm-12 no-padding marginBottom10" style="border-top: 2px solid #3375AF">
                        <a href="{{ fEnRoot('sports') }}" class="category-name">Sports
                            <span>
                                        <i class="fa fa-long-arrow-down color-text">
                                        </i>
                                    </span>
                        </a>
                    </div>
                    @if($sportsContents)
                        <div class=" d-flex m-flex-column col-sm-12 no-padding">
                            @php($leadSpContent = $sportsContents->shift())
                            @php($leadSpContentURL = fEnURL($leadSpContent->content_id, $leadSpContent->category->cat_slug, ($leadSpContent->subcategory->subcat_slug ?? null), $leadSpContent->content_type))
                            <div
                                class="order2 col-sm-6 rightPadding10 leftPadding10 marginBottom10Mobile border-bottom-pc-none">
                                <a href="{{ $leadSpContentURL }}">
                                    <div class="imgBox">
                                        <img class="img-responsive english-lead-image"
                                             src="{{ $leadSpContent->img_bg_path ? asset(config('appconfig.contentImagePath').$leadSpContent->img_bg_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg')   }}"
                                             alt="{{ $leadSpContent->content_heading }}">
                                    </div>
                                    <h3 class="headline-font">
                                        @if($leadSpContent->content_sub_heading)
                                            <span class="color-text">{{ $leadSpContent->content_sub_heading }}</span> /
                                        @endif
                                        @if(!empty($leadSpContent->video_id) || !empty($leadSpContent->podcast_id))
                                            <span class="video-audio-icon">
                                                        @if(!empty($leadSpContent->video_id))
                                                    <i class="fa fa-play"></i>
                                                @endif
                                                @if(!empty($leadSpContent->podcast_id))
                                                    <i class="fa fa-volume-up"></i>
                                                @endif
                                                    </span>
                                        @endif
                                        {{ $leadSpContent->content_heading }}
                                    </h3>
                                    <p class=" details-font">
                                        {{ fGetWord(fFormatString($leadSpContent->content_details),45) }}
                                    </p>
                                </a>
                            </div>
                            @php($spContets = $sportsContents->all())
                            @if($spContets)
                                <div class="order1 col-sm-3 leftPadding0 rightPadding10 border-right-mob ">
                                    @foreach($spContets as $content)
                                        @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                        <div class="sports-content">
                                            <a href="{{ $sURL }}">
                                                <img class="img-responsive side-image"
                                                     src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                                     alt="">
                                                <h4 class="headline-font marginTop2">
                                                    @if($content->content_sub_heading)
                                                        <span
                                                            class="color-text">{{ $content->content_sub_heading }}</span>
                                                        /
                                                    @endif
                                                    @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                        <span class="video-audio-icon">
                                                                @if(!empty($content->video_id))
                                                                <i class="fa fa-play"></i>
                                                            @endif
                                                            @if(!empty($content->podcast_id))
                                                                <i class="fa fa-volume-up"></i>
                                                            @endif
                                                            </span>
                                                    @endif
                                                    <span class="">{{ $content->content_heading }}</span>
                                                </h4>
                                                <p class="details-font marginTop10">
                                                    {{ fGetWord(fFormatString($content->content_details),15) }}
                                                </p>
                                            </a>
                                        </div>
                                        @if($loop->iteration === 3)
                                </div>
                                <div class="order3 col-sm-3 rightPadding0 leftPadding10 border-left-mob">
                                    @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="col-sm-12 no-padding marginTop10">
                    {{-- Middle five Ad --}}
                    @if(!isMobile())
                        @include('frontend.bn.ads.home.middle-5-ad')
                    @endif
                </div>
                <div class="col-sm-12 no-padding marginTop10">
                    <div class="col-sm-12 no-padding marginBottom10" style="border-top: 2px solid #3375AF">
                        <a href="{{ fEnRoot('entertainment') }}" class="category-name">Entertainment
                            <span>
                                <i class="fa fa-long-arrow-down color-text">
                                </i>
                            </span>
                        </a>
                    </div>
                    @if($entertainmentContents)
                        @php($leadEntContent = $entertainmentContents->shift())
                        @php($leadEntContentURL = fEnURL($leadEntContent->content_id, $leadEntContent->category->cat_slug, ($leadEntContent->subcategory->subcat_slug ?? null), $leadEntContent->content_type))
                        <div class="col-sm-12 no-padding ">
                            <div class="col-sm-5  leftPadding0 rightPadding10 border-bottom-pc-none marginBottom10Mobile">
                                <a href="{{ $leadEntContentURL }}" style="text-decoration: none"
                                   title="{{ $leadEntContent->content_heading }}">
                                    <div class="imgBox">
                                        <img class="img-responsive " style=""
                                             src="{{ $leadEntContent->img_bg_path ? asset(config('appconfig.contentImagePath').$leadEntContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                             alt="{{ $leadEntContent->content_heading }}"
                                             title="{{ $leadEntContent->content_heading }}">
                                    </div>
                                    <h3 class="headline-font marginTop10 ">
                                        @if($leadEntContent->content_sub_heading)
                                            <span class="color-text">{{ $leadEntContent->content_sub_heading }}/</span>
                                        @endif
                                        {{ $leadEntContent->content_heading }}
                                    </h3>
                                    <p class="details-font">
                                        @if(!empty($leadEntContent->video_id) || !empty($leadEntContent->podcast_id))
                                            <span class="video-audio-icon">
                                        @if(!empty($leadEntContent->video_id))
                                                    <i class="fa fa-play"></i>
                                                @endif
                                                @if(!empty($leadEntContent->podcast_id))
                                                    <i class="fa fa-volume-up"></i>
                                                @endif
                                    </span>
                                        @endif
                                        {{ fGetWord(fFormatString($leadEntContent->content_details), 45) }}
                                    </p>
                                </a>
                            </div>
                            <div
                                class="col-sm-2 leftPadding10 rightPadding10 border-right-mob border-left-mob border-bottom-pc-none marginBottom10Mobile">
                                @php($nextContent = $entertainmentContents->shift())
                                @php($nextContentURL = fEnURL($nextContent->content_id, $nextContent->category->cat_slug, ($nextContent->subcategory->subcat_slug ?? null), $nextContent->content_type))
                                <a href="{{ $nextContentURL }}" style="text-decoration: none">
                                    <img class="img-responsive " style=""
                                         src="{{ $nextContent->img_bg_path ? asset(config('appconfig.contentImagePath').$nextContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                         alt="">
                                    <h4 class="headline-font marginTop10 ">
                                        @if($nextContent->content_sub_heading)
                                            <span class="color-text">{{ $nextContent->content_sub_heading }}/</span>
                                        @endif
                                        {{ $nextContent->content_heading }}
                                    </h4>
                                    <p class="details-font">
                                        @if(!empty($nextContent->video_id) || !empty($nextContent->podcast_id))
                                            <span class="video-audio-icon">
                                        @if(!empty($nextContent->video_id))
                                                    <i class="fa fa-play"></i>
                                                @endif
                                                @if(!empty($nextContent->podcast_id))
                                                    <i class="fa fa-volume-up"></i>
                                                @endif
                                    </span>
                                        @endif
                                        {{ fGetWord(fFormatString($nextContent->content_details), 45) }}
                                    </p>
                                </a>
                            </div>
                            <div class=" d-flex m-flex-column col-sm-5 rightPadding0 leftPadding0">
                                @php($entertainmentContents = $entertainmentContents->all())
                                <div class="order3 col-sm-12 leftPadding10 rightPadding0 ">
                                    @foreach($entertainmentContents as $content)
                                        @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                        <div class="entertainment-content" style="min-height: 30%">
                                            <a href="{{ $sURL }}">
                                                <img class="img-responsive pull-to-right side-image"
                                                     src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                                     alt="">
                                                <h4 class="headline-font marginTop2">
                                                    @if($content->content_sub_heading)
                                                        <span
                                                            class="color-text">{{ $content->content_sub_heading }}</span>
                                                        /
                                                    @endif
                                                    @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                        <span class="video-audio-icon">
                                                           @if(!empty($content->video_id))
                                                                <i class="fa fa-play"></i>
                                                            @endif
                                                            @if(!empty($content->podcast_id))
                                                                <i class="fa fa-volume-up"></i>
                                                            @endif
                                                       </span>
                                                    @endif
                                                    {{ $content->content_heading }}
                                                </h4>
                                                <p class="details-font marginTop10">
                                                    {{ fGetWord(fFormatString($content->content_details),20) }}
                                                </p>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-sm-12 no-padding marginTop10">
                    {{--                     Middle Six Ad--}}
                    @if(!isMobile())
                        @include('frontend.bn.ads.home.middle-6-ad')
                    @endif
                </div>
                <div class="col-sm-12 no-padding marginTop20 marginTop20mobile">
                    <div class="col-sm-6 rightPadding10 leftPadding0">
                        {{--                                                Opinion--}}
                        <div class="col-sm-12 no-padding marginBottom10" style="border-top: 2px solid #3375AF">
                            <a href="{{ fEnRoot('opinion') }}" class="category-name">Opinion
                                <span>
                                <i class="fa fa-long-arrow-down color-text">
                                </i>
                            </span>
                            </a>
                        </div>

                        @if($opinionContents)

                            <div class="col-sm-12 no-padding">
                                @php($leadOpContent = $opinionContents->shift())
                                @php($leadOpContentURL = fEnURL($leadOpContent->content_id, $leadOpContent->category->cat_slug, ($leadOpContent->subcategory->subcat_slug ?? null), $leadOpContent->content_type))
                                @if($leadOpContent)
                                    <div class="col-sm-6 cat-column marginBottom10Mobile border-bottom-pc-none">
                                        <a href="{{ $leadOpContentURL }}" style="text-decoration: none"
                                           title="{{ $leadOpContent->content_heading }}">
                                            <img class="img-responsive " style=""
                                                 src="{{ $leadOpContent->img_bg_path ? asset(config('appconfig.contentImagePath').$leadOpContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                                 alt="{{ $leadEntContent->content_heading }}"
                                                 title="{{ $leadOpContent->content_heading }}">
                                            <h3 class="headline-font marginTop10">
                                                {{ $leadOpContent->content_heading }}
                                            </h3>
                                            <p class="details-font">
                                                @if(!empty($leadOpContent->video_id) || !empty($leadOpContent->podcast_id))
                                                    <span class="video-audio-icon">
                                        @if(!empty($leadOpContent->video_id))
                                                            <i class="fa fa-play"></i>
                                                        @endif
                                                        @if(!empty($leadOpContent->podcast_id))
                                                            <i class="fa fa-volume-up"></i>
                                                        @endif
                                    </span>
                                                @endif
                                                {{ fGetWord(fFormatString($leadOpContent->content_details), 25) }}
                                            </p>
                                        </a>
                                    </div>
                                @endif
                                <div class="col-sm-6 cat-column marginBottom10Mobile border-bottom-pc-none">
                                    <div class=" rem-first-border special-top-middle">
                                        @foreach($opinionContents->all() as $content)
                                            @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                            <div class="ls-content col-sm-12 no-padding border-bottom">
                                                <a href="{{ $sURL }}">
                                                    <img class="img-responsive display-none-mob side-image"
                                                         src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                                         alt="">
                                                    <h4 class="headline-font marginTop2">
                                                        @if($content->content_sub_heading)
                                                            <span
                                                                class="color-text">{{ $content->content_sub_heading }}</span>
                                                            /
                                                        @endif
                                                        @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                            <span class="video-audio-icon">
                                                           @if(!empty($content->video_id))
                                                                    <i class="fa fa-play"></i>
                                                                @endif
                                                                @if(!empty($content->podcast_id))
                                                                    <i class="fa fa-volume-up"></i>
                                                                @endif
                                                       </span>
                                                        @endif
                                                        {{ $content->content_heading }}
                                                    </h4>
                                                    <p class="details-font marginTop10 display-none-pc display-none-mob">
                                                        {{ fGetWord(fFormatString($content->content_details),20) }}
                                                    </p>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        @endif
                    </div>
                    <div class="col-sm-6 leftPadding10 rightPadding0 marginTop20mobile">
                        {{--                                                Literature--}}
                        <div class="col-sm-12 no-padding marginBottom10" style="border-top: 2px solid #3375AF">
                            <a href="{{ fEnRoot('literature') }}" class="category-name">Literature
                                <span>
                                <i class="fa fa-long-arrow-down color-text">
                                </i>
                            </span>
                            </a>
                        </div>
                        @if($literatureContents->count())
                            <div class="col-sm-12 no-padding">
                                @php($leadLitContent = $literatureContents->shift())
                                @php($leadLitContentURL = fEnURL($leadLitContent->content_id, $leadLitContent->category->cat_slug, ($leadLitContent->subcategory->subcat_slug ?? null), $leadLitContent->content_type))
                                @if($leadLitContent)
                                    <div class="col-sm-6 leftPadding0 rightPadding10 marginBottom10Mobile border-bottom-pc-none border-right-mob">
                                        <a href="{{ $leadLitContentURL }}" style="text-decoration: none"
                                           title="{{ $leadLitContent->content_heading }}">
                                            <img class="img-responsive " style=""
                                                 src="{{ $leadLitContent->img_bg_path ? asset(config('appconfig.contentImagePath').$leadLitContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                                 alt="{{ $leadLitContent->content_heading }}"
                                                 title="{{ $leadLitContent->content_heading }}"
                                            >
                                            <h3 class="headline-font marginTop10">
                                                {{ $leadLitContent->content_heading }}
                                            </h3>
                                            <p class="details-font display-none-mob">
                                                @if(!empty($leadLitContent->video_id) || !empty($leadLitContent->podcast_id))
                                                    <span class="video-audio-icon">
                                                    @if(!empty($leadLitContent->video_id))
                                                            <i class="fa fa-play"></i>
                                                        @endif
                                                        @if(!empty($leadLitContent->podcast_id))
                                                            <i class="fa fa-volume-up"></i>
                                                        @endif
                                                </span>
                                                @endif
                                                {{ fGetWord(fFormatString($leadLitContent->content_details), 25) }}
                                            </p>
                                        </a>
                                    </div>
                                @endif
                                <div class=" d-flex m-flex-column col-sm-6 rightPadding0 leftPadding0">
                                    @php($litContents = $literatureContents->all())
                                    <div class="order3 col-sm-12 leftPadding10 rightPadding0 ">
                                        @foreach($litContents as $content)
                                            @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                            <div class="entertainment-content">
                                                <a href="{{ $sURL }}">
                                                    <img class="img-responsive display-none-mob display-none-pc side-image"
                                                         src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                                         alt="">
                                                    <h4 class="headline-font marginTop2">
                                                        @if($content->content_sub_heading)
                                                            <span
                                                                class="color-text">{{ $content->content_sub_heading }}</span>
                                                            /
                                                        @endif
                                                        @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                            <span class="video-audio-icon">
                                                           @if(!empty($content->video_id))
                                                                    <i class="fa fa-play"></i>
                                                                @endif
                                                                @if(!empty($content->podcast_id))
                                                                    <i class="fa fa-volume-up"></i>
                                                                @endif
                                                       </span>
                                                        @endif
                                                        {{ $content->content_heading }}
                                                    </h4>
                                                    <p class="details-font display-none-mob">
                                                        {{ fGetWord(fFormatString($content->content_details),20) }}
                                                    </p>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-sm-12 no-padding marginTop10">
                    {{-- Middle Seven Ad --}}
                    @if(!isMobile())
                        @include('frontend.bn.ads.home.middle-7-ad')
                    @endif
                </div>
                <div class="col-sm-12 no-padding marginTop10 marginBottom20">
                    <div class="col-sm-6 rightPadding10 leftPadding0">
                        {{--                        Education--}}
                        <div class="col-sm-12 no-padding marginBottom10" style="border-top: 2px solid #3375AF">
                            <a href="{{ fEnRoot('education') }}" class="category-name">Education
                                <span>
                                <i class="fa fa-long-arrow-down color-text">
                                </i>
                            </span>
                            </a>
                        </div>
                        @if($educationContents)
                            <div class="col-sm-12 no-padding">
                                @php($leadEdContent = $educationContents->shift())
                                @php($leadEdContentURL = fEnURL($leadEdContent->content_id, $leadEdContent->category->cat_slug, ($leadEdContent->subcategory->subcat_slug ?? null), $leadEdContent->content_type))
                                <div class="col-sm-6 cat-column marginBottom10Mobile border-bottom-pc-none">
                                    <a href="{{ $leadEdContentURL }}" style="text-decoration: none"
                                       title="{{ $leadEdContent->content_heading }}">
                                        <img class="img-responsive " style=""
                                             src="{{ $leadEdContent->img_bg_path ? asset(config('appconfig.contentImagePath').$leadEdContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg')  }}"
                                             alt="">
                                        <h3 class="headline-font marginTop10 ">
                                            @if($leadEntContent->content_sub_heading)
                                                <span
                                                    class="color-text">{{ $leadEdContent->content_sub_heading }}/</span>
                                            @endif
                                            {{ $leadEdContent->content_heading }}
                                        </h3>
                                        <p class="details-font display-none-mob">
                                            @if(!empty($leadEdContent->video_id) || !empty($leadEdContent->podcast_id))
                                                <span class="video-audio-icon">
                                            @if(!empty($leadEdContent->video_id))
                                                        <i class="fa fa-play"></i>
                                                    @endif
                                                    @if(!empty($leadEdContent->podcast_id))
                                                        <i class="fa fa-volume-up"></i>
                                                    @endif
                                                </span>
                                            @endif
                                            {{ fGetWord(fFormatString($leadEdContent->content_details), 25) }}
                                        </p>
                                    </a>
                                </div>
                                <div class=" d-flex m-flex-column col-sm-6 rightPadding0 leftPadding0">
                                    @php($edContents = $educationContents->all())
                                    <div class="order3 col-sm-12 leftPadding10 rightPadding0 ">
                                        @foreach($edContents as $content)
                                            @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                            <div class="entertainment-content">
                                                <a href="{{ $sURL }}">
                                                    <img class="img-responsive display-none-mob display-none-pc side-image"
                                                         src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                                         alt="">
                                                    <h4 class="headline-font marginTop2">
                                                        @if($content->content_sub_heading)
                                                            <span
                                                                class="color-text">{{ $content->content_sub_heading }}</span>
                                                            /
                                                        @endif
                                                        @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                            <span class="video-audio-icon">
                                                           @if(!empty($content->video_id))
                                                                    <i class="fa fa-play"></i>
                                                                @endif
                                                                @if(!empty($content->podcast_id))
                                                                    <i class="fa fa-volume-up"></i>
                                                                @endif
                                                       </span>
                                                        @endif
                                                        {{ $content->content_heading }}
                                                    </h4>
                                                    <p class="details-font display-none-mob">
                                                        {{ fGetWord(fFormatString($content->content_details),20) }}
                                                    </p>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-6 leftPadding10 rightPadding0 marginTop20mobile">
                        {{--                        Lifestyle--}}
                        <div class="col-sm-12 no-padding marginBottom10" style="border-top: 2px solid #3375AF">
                            <a href="{{ fEnRoot('lifestyle') }}" class="category-name">Lifestyle
                                <span>
                                <i class="fa fa-long-arrow-down color-text">
                                </i>
                            </span>
                            </a>
                        </div>
                        @if($lifestyleContents)
                            <div class="col-sm-12 no-padding">
                                @php($leadLsContent = $lifestyleContents->shift())
                                @php($leadLsContentURL = fEnURL($leadLsContent->content_id, $leadLsContent->category->cat_slug, ($leadLsContent->subcategory->subcat_slug ?? null), $leadLsContent->content_type))
                                <div
                                    class="col-sm-6 leftPadding0 rightPadding10 marginBottom10Mobile border-bottom-pc-none border-right-mob">
                                    <a href="{{ $leadLsContentURL }}" style="text-decoration: none"
                                       title="{{ $leadLsContent->content_heading }}">
                                        <img class="img-responsive " style=""
                                             src="{{ $leadLsContent->img_bg_path ? asset(config('appconfig.contentImagePath').$leadLsContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg')  }}"
                                             alt="">
                                        <h3 class="headline-font marginTop10 ">
                                            @if($leadLsContent->content_sub_heading)
                                                <span
                                                    class="color-text">{{ $leadLsContent->content_sub_heading }}/</span>
                                            @endif
                                            {{ $leadLsContent->content_heading }}
                                        </h3>
                                        <p class="details-font display-none-mob">
                                            @if(!empty($leadLsContent->video_id) || !empty($leadLsContent->podcast_id))
                                                <span class="video-audio-icon">
                                        @if(!empty($leadLsContent->video_id))
                                                        <i class="fa fa-play"></i>
                                                    @endif
                                                    @if(!empty($leadLsContent->podcast_id))
                                                        <i class="fa fa-volume-up"></i>
                                                    @endif
                                    </span>
                                            @endif
                                            {{ fGetWord(fFormatString($leadLsContent->content_details), 18) }}
                                        </p>
                                    </a>
                                </div>
                                <div class="col-sm-6 leftPadding10 rightPadding0 marginBottom10Mobile">
                                    @foreach($lifestyleContents as $content)
                                        @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                        <div class="ls-content col-sm-12 no-padding border-bottom">
                                            <a href="{{ $sURL }}">
                                                <img class="img-responsive display-none-mob side-image"
                                                     src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                                     alt="">
                                                <h4 class="headline-font marginTop2">
                                                    @if($content->content_sub_heading)
                                                        <span
                                                            class="color-text">{{ $content->content_sub_heading }}</span>
                                                        /
                                                    @endif
                                                    @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                        <span class="video-audio-icon">
                                                           @if(!empty($content->video_id))
                                                                <i class="fa fa-play"></i>
                                                            @endif
                                                            @if(!empty($content->podcast_id))
                                                                <i class="fa fa-volume-up"></i>
                                                            @endif
                                                       </span>
                                                    @endif
                                                    {{ $content->content_heading }}
                                                </h4>
                                                <p class="details-font marginTop10 display-none-pc display-none-mob">
                                                    {{ fGetWord(fFormatString($content->content_details),20) }}
                                                </p>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 no-padding marginTop10">
                    {{-- Middle Eight Ad --}}
                    @if(!isMobile())
                        @include('frontend.bn.ads.home.middle-8-ad')
                    @endif
                </div>
                <div class="row marginBottom10 marginTop10">

                    {{--Special--}}
                    <div class="col-sm-3">
                        <div class="col-sm-12 no-padding marginBottom10" style="border-top: 2px solid #3375AF">
                            <a href="" class="category-name">Special
                                <span>
                                        <i class="fa fa-long-arrow-down color-text">
                                        </i>
                            </span>
                            </a>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="cat-box-with-media default-height no-left">
                                @if($specialContents->count())
                                    @php($specialTopContent = $specialContents->shift())
                                    @php($sURL = fEnURL($specialTopContent->content_id, $specialTopContent->category->cat_slug, ($specialTopContent->subcategory->subcat_slug ?? null), $specialTopContent->content_type))
                                    <div class="cat-box">
                                        <a href="{{ $sURL }}">
                                            <div class="imgbox">
                                                <img
                                                    src="{{ $specialTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$specialTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                                    class="img-responsive"
                                                    alt="{{ $specialTopContent->content_heading }}"
                                                    title="{{ $specialTopContent->content_heading }}">
                                            </div>
                                            <h4 class="headline-font">
                                                @if(!empty($specialTopContent->video_id) || !empty($specialTopContent->podcast_id))
                                                    <span class="video-audio-icon">
                                                        @if(!empty($specialTopContent->video_id))
                                                            <i class="fa fa-play"></i>
                                                        @endif
                                                        @if(!empty($specialTopContent->podcast_id))
                                                            <i class="fa fa-volume-up"></i>
                                                        @endif
                                                    </span>
                                                @endif
                                                @if($specialTopContent->content_sub_heading)
                                                    <span class="color-text">{{ $specialTopContent->content_sub_heading }} /
                                                    </span>

                                                @endif
                                                {{ $specialTopContent->content_heading }}
                                            </h4>
                                        </a>
                                    </div>

                                    @php($specialOtherContents = $specialContents->all())

                                    @if($specialOtherContents)
                                        @foreach($specialOtherContents as $content)
                                            @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="headline-font" style="font-size: 16px">
                                                        <a href="{{ $sURL }}">
                                                            @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                                <span class="video-audio-icon">
                                                            @if(!empty($content->video_id))
                                                                        <i class="fa fa-play"></i>
                                                                    @endif
                                                                    @if(!empty($content->podcast_id))
                                                                        <i class="fa fa-volume-up"></i>
                                                                    @endif
                                                        </span>
                                                            @endif
                                                            @if($content->content_sub_heading)
                                                                {{--                                                        <b class="sub-heading">{{ $intTopContent->content_sub_heading }}</b>--}}
                                                                <span
                                                                    class="color-text">{{ $content->content_sub_heading }}</span>
                                                                /
                                                            @endif
                                                            {{ $content->content_heading }}
                                                        </a>
                                                    </h4>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    {{--Technology--}}
                    <div class="col-sm-3 marginTop20mobile">
                        <div class="col-sm-12 no-padding marginBottom10" style="border-top: 2px solid #3375AF">
                            <a href="" class="category-name">Technology
                                <span>
                                        <i class="fa fa-long-arrow-down color-text">
                                        </i>
                            </span>
                            </a>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="cat-box-with-media default-height no-left">
                                @if($technologyContents->count())
                                    @php($tecTopContent = $technologyContents->shift())
                                    @php($sURL = fEnURL($tecTopContent->content_id, $tecTopContent->category->cat_slug, ($tecTopContent->subcategory->subcat_slug ?? null), $tecTopContent->content_type))
                                    <div class="cat-box">
                                        <a href="{{ $sURL }}">
                                            <div class="imgbox">
                                                <img
                                                    src="{{ $tecTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$tecTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                                    class="img-responsive" alt="{{ $tecTopContent->content_heading }}"
                                                    title="{{ $tecTopContent->content_heading }}">
                                            </div>
                                            <h4 class="headline-font">
                                                @if($tecTopContent->content_sub_heading)
                                                    {{--                                            <b class="sub-heading">{{ $tecTopContent->content_sub_heading }}</b>--}}
                                                    <span
                                                        class="color-text">{{ $tecTopContent->content_sub_heading }}</span>
                                                    /
                                                @endif
                                                @if(!empty($tecTopContent->video_id) || !empty($tecTopContent->podcast_id))
                                                    <span class="video-audio-icon">
                                                @if(!empty($tecTopContent->video_id))
                                                            <i class="fa fa-play"></i>
                                                        @endif
                                                        @if(!empty($tecTopContent->podcast_id))
                                                            <i class="fa fa-volume-up"></i>
                                                        @endif
                                            </span>
                                                @endif
                                                {{ $tecTopContent->content_heading }}
                                            </h4>
                                        </a>
                                    </div>

                                    @php($tecOtherContents = $technologyContents->all())

                                    @if($tecOtherContents)
                                        @foreach($tecOtherContents as $content)
                                            @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                            <div class="media">
                                                <div class="media-body">
                                                    <a href="{{ $sURL }}">
                                                        <h4 class="headline-font" style="font-size: 16px">
                                                            @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                                <span class="video-audio-icon">
                                                                        @if(!empty($content->video_id))
                                                                        <i class="fa fa-play"></i>
                                                                    @endif
                                                                    @if(!empty($content->podcast_id))
                                                                        <i class="fa fa-volume-up"></i>
                                                                    @endif
                                                                    </span>
                                                            @endif
                                                            @if($content->content_sub_heading)
                                                                <span
                                                                    class="color-text">{{ $content->content_sub_heading }}</span>
                                                                /
                                                            @endif
                                                            {{ $content->content_heading }}
                                                        </h4>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    {{--Religion--}}
                    <div class="col-sm-3 marginTop20mobile">
                        <div class="col-sm-12 no-padding marginBottom10" style="border-top: 2px solid #3375AF">
                            <a href="{{ fEnRoot('religion') }}" class="category-name">Religion
                                <span>
                                        <i class="fa fa-long-arrow-down color-text">
                                        </i>
                            </span>
                            </a>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="cat-box-with-media default-height no-left">
                                @if($religionContents->count())
                                    @php($relTopContent = $religionContents->shift())
                                    @php($sURL = fEnURL($relTopContent->content_id, $relTopContent->category->cat_slug, ($relTopContent->subcategory->subcat_slug ?? null), $relTopContent->content_type))
                                    <div class="cat-box">
                                        <a href="{{ $sURL }}">
                                            <div class="imgbox">
                                                <img
                                                    src="{{ $relTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$relTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                                    class="img-responsive" alt="{{ $relTopContent->content_heading }}"
                                                    title="{{ $relTopContent->content_heading }}">
                                            </div>
                                            <h4 class="headline-font">
                                                @if($relTopContent->content_sub_heading)
                                                    {{--                                            <b class="sub-heading">{{ $tecTopContent->content_sub_heading }}</b>--}}
                                                    <span
                                                        class="color-text">{{ $relTopContent->content_sub_heading }}</span>
                                                    /
                                                @endif
                                                @if(!empty($relTopContent->video_id) || !empty($relTopContent->podcast_id))
                                                    <span class="video-audio-icon">
                                                @if(!empty($relTopContent->video_id))
                                                            <i class="fa fa-play"></i>
                                                        @endif
                                                        @if(!empty($relTopContent->podcast_id))
                                                            <i class="fa fa-volume-up"></i>
                                                        @endif
                                            </span>
                                                @endif
                                                {{ $relTopContent->content_heading }}
                                            </h4>
                                        </a>
                                    </div>

                                    @php($relOtherContents = $religionContents->all())

                                    @if($relOtherContents)
                                        @foreach($relOtherContents as $content)
                                            @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="headline-font" style="font-size: 16px">
                                                        <a href="{{ $sURL }}">
                                                            @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                                <span class="video-audio-icon">
                                                                        @if(!empty($content->video_id))
                                                                        <i class="fa fa-play"></i>
                                                                    @endif
                                                                    @if(!empty($content->podcast_id))
                                                                        <i class="fa fa-volume-up"></i>
                                                                    @endif
                                                                    </span>
                                                            @endif
                                                            @if($content->content_sub_heading)
                                                                <span
                                                                    class="color-text">{{ $content->content_sub_heading }}</span>
                                                                /
                                                            @endif
                                                            {{ $content->content_heading }}
                                                        </a>
                                                    </h4>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    {{--Health--}}
                    <div class="col-sm-3 marginTop20mobile">
                        <div class="col-sm-12 no-padding marginBottom10" style="border-top: 2px solid #3375AF">
                            <a href="{{ fEnRoot('health') }}" class="category-name">Health
                                <span>
                                        <i class="fa fa-long-arrow-down color-text">
                                        </i>
                            </span>
                            </a>
                        </div>
                        <div class="col-sm-12 no-padding">
                            <div class="cat-box-with-media default-height no-left">
                                @if($healthContents->count())
                                    @php($helTopContent = $healthContents->shift())
                                    @php($sURL = fEnURL($helTopContent->content_id, $helTopContent->category->cat_slug, ($helTopContent->subcategory->subcat_slug ?? null), $helTopContent->content_type))
                                    <div class="cat-box">
                                        <a href="{{ $sURL }}">
                                            <div class="imgbox">
                                                <img
                                                    src="{{ $helTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$helTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                                    class="img-responsive" alt="{{ $helTopContent->content_heading }}"
                                                    title="{{ $helTopContent->content_heading }}">
                                            </div>
                                            <h4 class="headline-font">
                                                @if($helTopContent->content_sub_heading)
                                                    <span
                                                        class="color-text">{{ $helTopContent->content_sub_heading }}</span>
                                                    /
                                                @endif
                                                @if(!empty($helTopContent->video_id) || !empty($helTopContent->podcast_id))
                                                    <span class="video-audio-icon">
                                                @if(!empty($helTopContent->video_id))
                                                            <i class="fa fa-play"></i>
                                                        @endif
                                                        @if(!empty($helTopContent->podcast_id))
                                                            <i class="fa fa-volume-up"></i>
                                                        @endif
                                            </span>
                                                @endif
                                                {{ $helTopContent->content_heading }}
                                            </h4>
                                        </a>
                                    </div>

                                    @php($helOtherContents = $healthContents->all())

                                    @if($helOtherContents)
                                        @foreach($helOtherContents as $content)
                                            @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="headline-font" style="font-size: 16px">
                                                        <a href="{{ $sURL }}">
                                                            @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                                <span class="video-audio-icon">
                                                                        @if(!empty($content->video_id))
                                                                        <i class="fa fa-play"></i>
                                                                    @endif
                                                                    @if(!empty($content->podcast_id))
                                                                        <i class="fa fa-volume-up"></i>
                                                                    @endif
                                                                    </span>
                                                            @endif
                                                            @if($content->content_sub_heading)
                                                                <span
                                                                    class="color-text">{{ $content->content_sub_heading }}</span>
                                                                /
                                                            @endif
                                                            {{ $content->content_heading }}
                                                        </a>
                                                    </h4>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if(!isMobile())
                    @include('frontend.bn.ads.home.middle-9-ad')
                @endif
            </div>
        </div>
    </div>

@endsection

@section('custom-js')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="{{ asset('frontend-assets/plugins/bootstrap/bootstrap.min.js') }}"></script>

    @if($breakingContents->count())
        <script src="{{ asset('frontend-assets/plugins/breaking/breaking.js') }}"></script>
        <script>
            $(window).load(function () {
                $("#breaking-section").breakingNews({
                    effect: "slide-h",
                    autoplay: true,
                    timer: 3000,
                    color: 'darkred'
                });
            });
        </script>
    @endif

    <script>
        let showModal = (title, videoType, videoID) => {
            let modal = document.createElement('div');
            modal.className = "modal";
            modal.id = "popup-video";
            modal.setAttribute("tabindex", "-1");
            modal.setAttribute("role", "dialog");
            modal.setAttribute("aria-labelledby", "popup-video-label");

            let modalDialog = document.createElement('div');
            modalDialog.className = "modal-dialog modal-lg";
            modalDialog.setAttribute("role", "document");

            let modalHeader = document.createElement('div');
            modalHeader.className = "modal-header";
            modalHeader.style.background = '#FFF';

            let modalBody = document.createElement('div');
            modalBody.className = "modal-body";
            modalBody.style.background = '#FFF';

            modalHeader.innerHTML = `<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                     <h4 class="modal-title" id="myModalLabel">${title}</h4>`;

            if (videoType === "1") {
                modalBody.innerHTML = `<div class="embed-responsive embed-responsive-16by9">
                            <figure class="content-media content-media--video" id="featured-media">
                                <iframe src="https://www.youtube.com/embed/${videoID}?enablejsapi=1&rel=1&showinfo=1&controls=1&autoplay=1" frameborder="0" allowfullscreen data-width="220" allow='autoplay'></iframe>
                            </figure>
                        </div>`;
            } else {
                modalBody.innerHTML = `<iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https://www.facebook.com/${videoID}&show_text=false&width=560&t=0" width="100%" height="480" style="border:none;overflow:hidden" allowfullscreen="true" allow="autoplay;" allowFullScreen="true"></iframe>`;
            }

            modalDialog.append(modalHeader);
            modalDialog.append(modalBody);
            modal.append(modalDialog);

            document.body.append(modal);

            $('#popup-video').modal('show');

            $('#popup-video').on('hide.bs.modal', function (e) {
                document.getElementById('popup-video').remove();
            })
        };
    </script>

    <script src="{{ asset('frontend-assets/plugins/tab/tab.js') }}?id=123"></script>
@endsection




