@extends('frontend.en.app')

@section('title', cache('enSiteSettings')->title)

@section('customMeta')
    <meta content="300" http-equiv="refresh">
    <meta name="description" content="{{ Cache::get('enSiteSettings')->meta_description }}"/>
    <link rel="canonical" href="{{ fEnRoot() }}">
    <meta name="keywords" content="{{ Cache::get('enSiteSettings')->meta_keyword }}">

    <meta property="og:url" content="{{fEnRoot()}}"/>
    <meta property="og:title" content="{{ Cache::get('enSiteSettings')->title }}"/>
    <meta property="og:image" content="{{ asset(config('appconfig.commonImagePath').Cache::get('enSiteSettings')->og_image) }}"/>
    <meta property="og:description" content="{{ Cache::get('enSiteSettings')->meta_description }}"/>

    <meta name="twitter:title" content="{{ Cache::get('enSiteSettings')->title }}">
    <meta name="twitter:description" content="{{ Cache::get('enSiteSettings')->meta_description }}">
    <meta name="twitter:image" content="{{ asset(config('appconfig.commonImagePath').Cache::get('enSiteSettings')->og_image) }}">

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
    
    <link rel="stylesheet" href="{{ asset('frontend-assets/common/css/home.css') }}?id=6">
@endsection

@section('mainContent')
    <div class="main-content">
        {{-- Marquee/scroll news --}}
            @if($breakingContents->count())
                @include('frontend.en.common.breaking-marquee')
            @endif

            {{-- Middle One Ad --}}
            @include('frontend.en.ads.home.middle-1-ad')
        
        {{-- Special Section Eid --}}
        {{-- @include('frontend.bn.partials.special_section_eid') --}}

        {{-- Special Section Padma --}}
        {{-- @include('frontend.bn.partials.special_section_padma')--}}
            
        <div class="container">
            
            

            <!-- Top Section -->
            <div class="row marginBottom20 marginTop20">
                <div class="col-sm-9">
                    {{--Special Top--}}
                    <div class="special-box">
                        @if($specialTopContents->count())
                            <div class="row">
                                @php($spTopContent = $specialTopContents->shift())

                                <div class="col-sm-5 lead">

                                    @if($spTopContent)

                                        @php($sURL = fEnURL($spTopContent->content_id, $spTopContent->category->cat_slug, ($spTopContent->subcategory->subcat_slug ?? null), $spTopContent->content_type))
                                        <div class="imgbox">
                                            <a href="{{ $sURL }}" title="{{ $spTopContent->content_heading }}">
                                                <img src="{{ $spTopContent->img_bg_path ? asset(config('appconfig.contentImagePath').$spTopContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}" class="img-responsive" alt="{{ $spTopContent->content_heading }}" title="{{ $spTopContent->content_heading }}">
                                            </a>
                                        </div>
                                        <h3>

                                            <a href="{{ $sURL }}" title="{{ $spTopContent->content_heading }}">
                                                @if($spTopContent->content_sub_heading)
{{--                                                    <b class="sub-heading">{{ $spTopContent->content_sub_heading }}</b>--}}
                                                    <span class="red-text">{{ $spTopContent->content_sub_heading }}</span> /
                                                @endif
                                                {{ $spTopContent->content_heading }}
                                            </a>
                                        </h3>
                                        <p>
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
                                            {{ fGetWord(fFormatString($spTopContent->content_details), 35) }}
                                        </p>
                                    @endif

                                </div>

                                @php($spTopRightThreeContents = $specialTopContents->splice(0,3))
                                <div class="col-sm-4">
                                    <div class="cat-box-with-media rem-first-border special-top-middle">
                                        @foreach($spTopRightThreeContents as $content)
                                            @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                            <div class="media">
                                                <a href="{{ $sURL }}">
                                                    <div>
                                                        <img src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">

                                                        <h4 class="media-heading">
                                                            @if($content->content_sub_heading)
{{--                                                                <b class="sub-heading">{{ $content->content_sub_heading }}</b>--}}
                                                                <span class="red-text">{{ $content->content_sub_heading }}</span> /
                                                            @endif
                                                            {{ $content->content_heading }}

                                                        </h4>
                                                    </div>
                                                    <div style="clear: both; display: block">
                                                    {{ fGetWord($content->content_brief, 10) }}
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
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                @include('frontend.en.layouts.special-top-videos')
                            </div>

                            {{-- Middle One Ad --}}
                            @include('frontend.en.ads.home.middle-2-ad')

                            <div class="row special-sub FlexRow">
                                @php($spOtherContents = $specialTopContents->splice(0, 6))

                                @if($spOtherContents)

                                    @foreach($spOtherContents as $content)

                                        @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                        <div class="col-sm-4 col-xs-6">
                                            <div class="single_sub">
                                                <div class="imgbox">
                                                    <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                        <img src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                    </a>
                                                </div>
                                                <h4 style="margin-bottom: 3px">
                                                    <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                        @if($content->content_sub_heading)
{{--                                                            <b class="sub-heading">{{ $content->content_sub_heading }}</b>--}}
                                                            <span class="red-text">{{ $content->content_sub_heading }}</span> /
                                                        @endif
                                                        {{ $content->content_heading }}
                                                    </a>
                                                </h4>
                                                <p>
                                                    <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                        {{ fGetWord($content->content_brief, 15) }}

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
                                                    </a>
                                                </p>
                                            </div>
                                        </div>

                                    @endforeach

                                @endif

                            </div>
                        @endif
                    </div>

                    {{-- Middle Two Ad --}}
                    @include('frontend.en.ads.home.middle-3-ad')

                    {{--National--}}
                    <div class="marginBottom20">
                        <div class="marginBottom20">
                            <div class="common-title common-title-brown mb-4">
                                <span class="common-title-shape">
                                    <a class="common-title-link" href="{{ fEnRoot('national') }}">National</a>
                                </span>
                            </div>
                            <div class="cat-box-with-media rem-first-border ">
                                <div class="row">
                                    @if($nationalContents)
                                        <div class="col-sm-7">
                                            @php($nlMainContent = $nationalContents->shift())
                                            @if($nlMainContent)
                                                @php($sURL = fEnURL($nlMainContent->content_id, $nlMainContent->category->cat_slug, ($nlMainContent->subcategory->subcat_slug ?? null), $nlMainContent->content_type))
                                                <div class="cat-box">
                                                    <div class="imgbox">
                                                        <a href="{{ $sURL }}">
                                                            <img src="{{ $nlMainContent->img_bg_path ? asset(config('appconfig.contentImagePath').$nlMainContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}" class="img-responsive" alt="{{ $nlMainContent->content_heading }}" title="{{ $nlMainContent->content_heading }}">
                                                        </a>
                                                    </div>
                                                    <h3 class="leader">
                                                        <a href="{{ $sURL }}">
                                                            @if($nlMainContent->content_sub_heading)
{{--                                                                <b class="sub-heading">{{ $nlMainContent->content_sub_heading }}</b>--}}
                                                                <span class="red-text">{{ $nlMainContent->content_sub_heading }}</span> /
                                                            @endif
                                                            {{ $nlMainContent->content_heading }}
                                                        </a>
                                                    </h3>
                                                    <p>
                                                        @if(!empty($nlMainContent->video_id) || !empty($nlMainContent->podcast_id))
                                                            <span class="video-audio-icon">
                                                                @if(!empty($nlMainContent->video_id))
                                                                    <i class="fa fa-play"></i>
                                                                @endif
                                                                @if(!empty($nlMainContent->podcast_id))
                                                                    <i class="fa fa-volume-up"></i>
                                                                @endif
                                                            </span>
                                                        @endif
                                                        {{ $nlMainContent->content_brief }}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-sm-5">
                                            <div class="cat-box-with-media default-height rem-first-border">
                                                @php($nlOtherContents = $nationalContents->all())
                                                @if($nlOtherContents)
                                                    @foreach($nlOtherContents as $content)
                                                        @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                        <div class="media">
                                                            <div class="media-left">
                                                                <div class="imgbox">
                                                                    <a href="{{ $sURL }}">
                                                                        <img src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}" class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="media-body">
                                                                <h4 class="media-heading">
                                                                    <a href="{{ $sURL }}">
                                                                        @if($content->content_sub_heading)
{{--                                                                            <b class="sub-heading">{{ $content->content_sub_heading }}</b>--}}
                                                                            <span class="red-text">{{ $content->content_sub_heading }}</span> /
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
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Middle Three Ad --}}
                    @include('frontend.en.ads.home.middle-4-ad')

                    <div class="row marginBottom20">
                        {{--International--}}
                        <div class="col-sm-4 marginBottom20">
                            <div class="common-title common-title-brown mb-4">
                                <span class="common-title-shape">
                                    <a class="common-title-link" href="{{ fEnRoot('international') }}">International</a>
                                </span>
                            </div>
                            <div class="cat-box-with-media default-height no-left">
                                @if($internationalContents)
                                    @php($intTopContent = $internationalContents->shift())
                                    @php($sURL = fEnURL($intTopContent->content_id, $intTopContent->category->cat_slug, ($intTopContent->subcategory->subcat_slug ?? null), $intTopContent->content_type))
                                    <div class="cat-box">
                                        <div class="imgbox">
                                            <a href="{{ $sURL }}">
                                                <img src="{{ $intTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$intTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $intTopContent->content_heading }}" title="{{ $intTopContent->content_heading }}">
                                            </a>
                                        </div>
                                        <h3>
                                            <a href="{{ $sURL }}">
                                                @if($intTopContent->content_sub_heading)
{{--                                                    <b class="sub-heading">{{ $intTopContent->content_sub_heading }}</b>--}}
                                                    <span class="red-text">{{ $intTopContent->content_sub_heading }}</span> /
                                                @endif
                                                @if(!empty($intTopContent->video_id) || !empty($intTopContent->podcast_id))
                                                    <span class="video-audio-icon">
                                                        @if(!empty($intTopContent->video_id))
                                                            <i class="fa fa-play"></i>
                                                        @endif
                                                        @if(!empty($intTopContent->podcast_id))
                                                            <i class="fa fa-volume-up"></i>
                                                        @endif
                                                    </span>
                                                @endif
                                                {{ $intTopContent->content_heading }}
                                            </a>
                                        </h3>
                                    </div>

                                    @php($intOtherContents = $internationalContents->all())

                                    @if($intOtherContents)
                                        @foreach($intOtherContents as $content)
                                            @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="media-heading">
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
                                                                {{--                                                    <b class="sub-heading">{{ $intTopContent->content_sub_heading }}</b>--}}
                                                                <span class="red-text">{{ $content->content_sub_heading }}</span> /
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

                        <div class="col-sm-4 marginBottom20">
                            <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ fEnRoot('politics') }}">Politics</a>
                        </span>
                            </div>
                            <div class="cat-box-with-media default-height no-left">
                                @if($politicsContents)
                                    @php($ptTopContent = $politicsContents->shift())
                                    @php($sURL = fEnURL($ptTopContent->content_id, $ptTopContent->category->cat_slug, ($ptTopContent->subcategory->subcat_slug ?? null), $ptTopContent->content_type))
                                    <div class="cat-box">
                                        <div class="imgbox">
                                            <a href="{{ $sURL }}">
                                                <img src="{{ $ptTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$ptTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $ptTopContent->content_heading }}" title="{{ $ptTopContent->content_heading }}">
                                            </a>
                                        </div>
                                        <h3>
                                            <a href="{{ $sURL }}">
                                                @if($ptTopContent->content_sub_heading)
{{--                                                    <b class="sub-heading">{{ $ptTopContent->content_sub_heading }}</b>--}}
                                                    <span class="red-text">{{ $ptTopContent->content_sub_heading }}</span> /
                                                @endif
                                                @if(!empty($ptTopContent->video_id) || !empty($ptTopContent->podcast_id))
                                                    <span class="video-audio-icon">
                                                        @if(!empty($ptTopContent->video_id))
                                                            <i class="fa fa-play"></i>
                                                        @endif
                                                        @if(!empty($ptTopContent->podcast_id))
                                                            <i class="fa fa-volume-up"></i>
                                                        @endif
                                                    </span>
                                                @endif
                                                {{ $ptTopContent->content_heading }}
                                            </a>
                                        </h3>
                                    </div>

                                    @php($ptOtherContents = $politicsContents->all())

                                    @if($ptOtherContents)
                                        @foreach($ptOtherContents as $content)
                                            @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="media-heading">
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
                                                                {{--                                                    <b class="sub-heading">{{ $ptTopContent->content_sub_heading }}</b>--}}
                                                                <span class="red-text">{{ $content->content_sub_heading }}</span> /
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

                        <div class="col-sm-4 marginBottom20">
                            <div class="common-title common-title-brown mb-4">
                                <span class="common-title-shape">
                                    <a class="common-title-link" href="{{ fEnRoot('lifestyle') }}">Lifestyle</a>
                                </span>
                            </div>
                            <div class="cat-box-with-media default-height no-left">
                                @if($lifestyleContents->count())
                                    @php($lfTopContent = $lifestyleContents->shift())
                                    @php($sURL = fEnURL($lfTopContent->content_id, $lfTopContent->category->cat_slug, ($lfTopContent->subcategory->subcat_slug ?? null), $lfTopContent->content_type))
                                    <div class="cat-box">
                                        <div class="imgbox">
                                            <a href="{{ $sURL }}">
                                                <img src="{{ $lfTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$lfTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $lfTopContent->content_heading }}" title="{{ $lfTopContent->content_heading }}">
                                            </a>
                                        </div>
                                        <h3>
                                            <a href="{{ $sURL }}">
                                                @if(!empty($lfTopContent->video_id) || !empty($lfTopContent->podcast_id))
                                                    <span class="video-audio-icon">
                                                @if(!empty($lfTopContent->video_id))
                                                            <i class="fa fa-play"></i>
                                                        @endif
                                                        @if(!empty($lfTopContent->podcast_id))
                                                            <i class="fa fa-volume-up"></i>
                                                        @endif
                                            </span>
                                                @endif
                                                @if($lfTopContent->content_sub_heading)
                                                    {{--                                                    <b class="sub-heading">{{ $lfTopContent->content_sub_heading }}</b>--}}
                                                    <span class="red-text">{{ $lfTopContent->content_sub_heading }}</span> /
                                                @endif
                                                {{ $lfTopContent->content_heading }}
                                            </a>
                                        </h3>
                                    </div>

                                    @php($lfOtherContents = $lifestyleContents->all())

                                    @if($lfOtherContents)
                                        @foreach($lfOtherContents as $content)
                                            @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="media-heading">
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
                                                                {{--                                                    <b class="sub-heading">{{ $lfTopContent->content_sub_heading }}</b>--}}
                                                                <span class="red-text">{{ $content->content_sub_heading }}</span> /
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

                    {{-- Middle Four Ad --}}
                    @include('frontend.en.ads.home.middle-5-ad')

                </div>

                {{-- Right bar--}}
                <div class="col-sm-3">
                    {{-- Home Page Right One Ad--}}
                    @include('frontend.en.ads.home.right-1-ad')

                    {{-- Home Page Right Two Ad--}}
                    @include('frontend.en.ads.home.right-2-ad')

                    <!-- Tab links -->
                    <div class="marginBottom20" style="box-shadow: 0 2px 1px 1px #d5d5d5;">
                        @include('frontend.en.layouts.latestPopularBox')
                    </div>

                    {{-- Home Page Right Three Ad--}}
                    @include('frontend.en.ads.home.right-3-ad')

                    {{--Bangla--}}
                    <div class="marginBottom20 en_bg">
                        <div class="common-title common-title-brown mb-4">
                            <span class="common-title-shape">
                                <a class="common-title-link" href="{{ url('/') }}" target="_blank">বাংলা</a>
                            </span>
                        </div>
                        <div class="cat-box-with-media default-height rem-first-border">
                            @foreach($bnContents as $content)
                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                <div class="media">
                                    <div class="media-left imgbox">
                                        <a href="{{ $sURL }}">
                                            <img src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">
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
                                                        <span class="red-text">{{ $content->content_sub_heading }}</span> /
                                                @endif
                                                {{ $content->content_heading }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Home Page Right Four Ad--}}
                    @include('frontend.en.ads.home.right-4-ad')

                    {{-- If has special section show the section, otherwise show the ads --}}
                    @if($enCacheSettings->show_special == 1 && $specialSectionContents)

                        <div class="marginBottom20 special-widget-corona" style="background: antiquewhite; padding: 10px;">
                            <div class="common-title common-title-red mb-4">
                                <span class="common-title-shape">
                                    <a class="common-title-link" href="{{ $enCacheSettings->special_link ?? '' }}" target="_blank">{{ $enCacheSettings->special_title ?? 'বিশেষ আয়োজন' }}</a>
                                </span>
                            </div>
                            <div class="cat-box-with-media default-height rem-first-border" style="height: 470px; overflow: auto;">
                                @foreach($specialSectionContents as $content)
                                    @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-left imgbox">
                                            <a href="{{ $sURL }}">
                                                <img src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">
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
                                                        <span class="red-text">{{ $content->content_sub_heading }}</span> /
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
                        @include('frontend.en.ads.home.right-5-ad')

                        {{-- Home Page Right Six Ad--}}
                        @include('frontend.en.ads.home.right-6-ad')
                    @endif

                    {{-- Home Page Right Seven Ad--}}
                    @include('frontend.en.ads.home.right-7-ad')

                </div>
            </div>
            
            {{-- Special Section exception--}}
            <div class="hidden-sm hidden-xs marginBottom10 advertisement">
                <div class="header-ad" style="display: flex; justify-content: center; margin: 10px 0;">
                    <div class="ad-box">
                        <a href="https://www.dhakaprokash24.com/topic/পাসপোর্ট-পেতে-যত-ভোগান্তি" target="_blank" rel="nofollow">
                            <img src="{{ asset('media/common/Passport.jpg') }}" alt="পাসপোর্ট পেতে যত ভোগান্তি">
                        </a>
                    </div>
                </div>
            </div>

            <div class="hidden-md hidden-lg marginTop15 marginBottom10 text-center advertisement">
                <div class="header-ad" style="display: flex; justify-content: center;">
                    <div class="ad-box">
                        <a href="https://www.dhakaprokash24.com/topic/পাসপোর্ট-পেতে-যত-ভোগান্তি" target="_blank" rel="nofollow">
                            <img src="{{ asset('media/common/passport_750x140.jpg') }}" alt="পাসপোর্ট পেতে যত ভোগান্তি">
                        </a>
                    </div>
                </div>
            </div>

            <!-- Category Section -->
            <div class="row marginBottom20">
                <div class="col-sm-9 marginBottom20">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ fEnRoot('sports') }}">Sports</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media rem-first-border ">
                        <div class="row">
                            @if($sportsContents)
                                <div class="col-sm-7">
                                    @php($spTopContent = $sportsContents->shift())
                                    @if($spTopContent)
                                        @php($sURL = fEnURL($spTopContent->content_id, $spTopContent->category->cat_slug, ($spTopContent->subcategory->subcat_slug ?? null), $spTopContent->content_type))
                                        <div class="cat-box">
                                            <div class="imgbox">
                                                <a href="{{ $sURL }}">
                                                    <img src="{{ $spTopContent->img_bg_path ? asset(config('appconfig.contentImagePath').$spTopContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}" class="img-responsive" alt="{{ $spTopContent->content_heading }}" title="{{ $spTopContent->content_heading }}">
                                                </a>
                                            </div>
                                            <h3 class="leader">
                                                <a href="{{ $sURL }}">
                                                    @if($spTopContent->content_sub_heading)
{{--                                                        <b class="sub-heading">{{ $spTopContent->content_sub_heading }}</b>--}}
                                                        <span class="red-text">{{ $spTopContent->content_sub_heading }}</span> /
                                                    @endif
                                                    {{ $spTopContent->content_heading }}
                                                </a>
                                            </h3>
                                            <p>
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
                                                {{ $spTopContent->content_brief }}
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-5">
                                    <div class="cat-box-with-media default-height rem-first-border">
                                        @php($spOtherContents = $sportsContents->all())
                                        @if($spOtherContents)
                                            @foreach($spOtherContents as $content)
                                                @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                <div class="media">
                                                    <div class="media-left">
                                                        <div class="imgbox">
                                                            <a href="{{ $sURL }}">
                                                                <img src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}" class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4 class="media-heading">
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
                                                                    <span class="red-text">{{ $content->content_sub_heading }}</span> /
                                                                @endif
                                                                {{ $content->content_heading }}
                                                            </a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 marginBottom20">
                    <div>
                        <div class="common-title common-title-brown mb-4">
                            <span class="common-title-shape">
                                <a class="common-title-link" href="{{ fEnRoot('health') }}">Health</a>
                            </span>
                        </div>
                        <div class="cat-box-with-media default-height rem-first-border marginBottom20">

                            @if($healthContents)

                                @foreach($healthContents as $content)

                                    @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                    <div class="media">
                                        <div class="media-left">
                                            <div class="imgbox">
                                                <a href="{{ $sURL }}">
                                                    <img src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}" class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">
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
                                                        <span class="red-text">{{ $content->content_sub_heading }}</span> /
                                                    @endif
                                                    {{ $content->content_heading }}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>

                                @endforeach

                            @endif

                        </div>
                    </div>
                </div>
            </div>

            {{-- Middle Five Ad --}}
            @include('frontend.en.ads.home.middle-6-ad')

            <!-- 4 Category Section -->
            <div class="row marginBottom20">

                {{--Education--}}
                <div class="col-sm-3 marginBottom20">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ fEnRoot('education') }}">Education</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($educationContents->count())
                            @php($eduTopContent = $educationContents->shift())
                            @php($sURL = fEnURL($eduTopContent->content_id, $eduTopContent->category->cat_slug, ($eduTopContent->subcategory->subcat_slug ?? null), $eduTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        <img src="{{ $eduTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$eduTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $eduTopContent->content_heading }}" title="{{ $eduTopContent->content_heading }}">
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if($eduTopContent->content_sub_heading)
{{--                                            <b class="sub-heading">{{ $eduTopContent->content_sub_heading }}</b>--}}
                                            <span class="red-text">{{ $eduTopContent->content_sub_heading }}</span> /
                                        @endif
                                        @if(!empty($eduTopContent->video_id) || !empty($eduTopContent->podcast_id))
                                            <span class="video-audio-icon">
                                                @if(!empty($eduTopContent->video_id))
                                                    <i class="fa fa-play"></i>
                                                @endif
                                                @if(!empty($eduTopContent->podcast_id))
                                                    <i class="fa fa-volume-up"></i>
                                                @endif
                                            </span>
                                        @endif
                                        {{ $eduTopContent->content_heading }}
                                    </a>
                                </h3>
                            </div>

                            @php($eduOtherContents = $educationContents->all())

                            @if($eduOtherContents)
                                @foreach($eduOtherContents as $content)
                                    @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
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
                                                        <span class="red-text">{{ $content->content_sub_heading }}</span> /
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

                {{--Technology--}}
                <div class="col-sm-3 marginBottom20">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ fEnRoot('technology') }}">Technology</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($technologyContents->count())
                            @php($tecTopContent = $technologyContents->shift())
                            @php($sURL = fEnURL($tecTopContent->content_id, $tecTopContent->category->cat_slug, ($tecTopContent->subcategory->subcat_slug ?? null), $tecTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        <img src="{{ $tecTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$tecTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $tecTopContent->content_heading }}" title="{{ $tecTopContent->content_heading }}">
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if($tecTopContent->content_sub_heading)
{{--                                            <b class="sub-heading">{{ $tecTopContent->content_sub_heading }}</b>--}}
                                            <span class="red-text">{{ $tecTopContent->content_sub_heading }}</span> /
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
                                    </a>
                                </h3>
                            </div>

                            @php($tecOtherContents = $technologyContents->all())

                            @if($tecOtherContents)
                                @foreach($tecOtherContents as $content)
                                    @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
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
                                                        <span class="red-text">{{ $content->content_sub_heading }}</span> /
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

                {{--Economy--}}
                <div class="col-sm-3 marginBottom20">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ fEnRoot('economy') }}">Economy</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($economyContents)
                            @php($ecTopContent = $economyContents->shift())
                            @php($sURL = fEnURL($ecTopContent->content_id, $ecTopContent->category->cat_slug, ($ecTopContent->subcategory->subcat_slug ?? null), $ecTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        <img src="{{ $ecTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$ecTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $ecTopContent->content_heading }}" title="{{ $ecTopContent->content_heading }}">
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if(!empty($ecTopContent->video_id) || !empty($ecTopContent->podcast_id))
                                            <span class="video-audio-icon">
                                                        @if(!empty($ecTopContent->video_id))
                                                    <i class="fa fa-play"></i>
                                                @endif
                                                @if(!empty($ecTopContent->podcast_id))
                                                    <i class="fa fa-volume-up"></i>
                                                @endif
                                                    </span>
                                        @endif
                                        @if($ecTopContent->content_sub_heading)
                                            {{--                                                        <b class="sub-heading">{{ $intTopContent->content_sub_heading }}</b>--}}
                                            <span class="red-text">{{ $ecTopContent->content_sub_heading }}</span> /
                                        @endif
                                        {{ $ecTopContent->content_heading }}
                                    </a>
                                </h3>
                            </div>

                            @php($ecOtherContents = $economyContents->all())

                            @if($ecOtherContents)
                                @foreach($ecOtherContents as $content)
                                    @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
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
                                                        <span class="red-text">{{ $content->content_sub_heading }}</span> /
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

                {{--Religion--}}
                <div class="col-sm-3 marginBottom20">
                    <div>
                        <div class="common-title common-title-brown mb-4">
                            <span class="common-title-shape">
                                <a class="common-title-link" href="{{ fEnRoot('religion') }}">Religion</a>
                            </span>
                        </div>
                        <div class="cat-box-with-media default-height rem-first-border">

                            @if($religionContents->count())

                                @foreach($religionContents as $content)

                                    @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                    <div class="media">
                                        <div class="media-left">
                                            <div class="imgbox">
                                                <a href="{{ $sURL }}">
                                                    <img src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}" class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="{{ $sURL }}">
                                                    @if(!empty($content->video_id) || !empty($entTopContent->podcast_id))
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
                                                        <span class="red-text">{{ $content->content_sub_heading }}</span> /
                                                    @endif
                                                    {{ $content->content_heading }}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>

                                @endforeach

                            @endif

                        </div>
                    </div>
                </div>

            </div>

            {{-- Middle Six Ad --}}
            @include('frontend.en.ads.home.middle-7-ad')

            <!-- Category Section -->
            <div class="row marginBottom20">
                {{--Entertainment--}}
                <div class="col-sm-9 marginBottom20">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ fEnRoot('entertainment') }}">Entertainment</a>
                        </span>
                    </div>

                    <div class="cat-box-with-media">

                        @if($entertainmentContents)
                            <div class="row">
                                <div class="col-sm-6">

                                    @php($entTopContent = $entertainmentContents->shift())

                                    @if($entTopContent)
                                        @php($sURL = fEnURL($entTopContent->content_id, $entTopContent->category->cat_slug, ($entTopContent->subcategory->subcat_slug ?? null), $entTopContent->content_type))

                                        <div class="cat-box">
                                            <a href="{{ $sURL }}">
                                                <img src="{{ $entTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$entTopContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}" class="img-responsive" alt="{{ $entTopContent->content_heading }}" title="{{ $entTopContent->content_heading }}">
                                            </a>
                                            <h3 class="leader">
                                                <a href="{{ $sURL }}">
                                                    @if($entTopContent->content_sub_heading)
{{--                                                        <b class="sub-heading">{{ $entTopContent->content_sub_heading }}</b>--}}
                                                        <span class="red-text">{{ $entTopContent->content_sub_heading }}</span> /
                                                    @endif
                                                    {{ $entTopContent->content_heading }}
                                                </a>
                                            </h3>
                                            <p>
                                                @if(!empty($entTopContent->video_id) || !empty($entTopContent->podcast_id))
                                                    <span class="video-audio-icon">
                                                        @if(!empty($entTopContent->video_id))
                                                            <i class="fa fa-play"></i>
                                                        @endif
                                                        @if(!empty($entTopContent->podcast_id))
                                                            <i class="fa fa-volume-up"></i>
                                                        @endif
                                                    </span>
                                                @endif
                                                {{ $entTopContent->content_brief }}
                                            </p>
                                        </div>

                                    @endif

                                </div>

                                <div class="col-sm-6">
                                    <div class="row FlexRow">
                                        @php($entOtherContents = $entertainmentContents->all())

                                        @if($entOtherContents)

                                            @foreach($entOtherContents as $content)
                                                @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                                <div class="col-xs-6">
                                                    <div class="cat-box-sub">
                                                        <div class="imgbox">
                                                            <a href="{{ $sURL }}">
                                                                <img src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                            </a>
                                                        </div>
                                                        <h3>
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
                                                                    <span class="red-text">{{ $content->content_sub_heading }}</span> /
                                                                @endif
                                                                {{ $content->content_heading }}
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </div>

                                            @endforeach

                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{--Special--}}
                <div class="col-sm-3 marginBottom20">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ fEnRoot('special') }}">Special</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($specialContents->count())
                            @php($specialTopContent = $specialContents->shift())
                            @php($sURL = fEnURL($specialTopContent->content_id, $specialTopContent->category->cat_slug, ($specialTopContent->subcategory->subcat_slug ?? null), $specialTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        <img src="{{ $specialTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$specialTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $specialTopContent->content_heading }}" title="{{ $specialTopContent->content_heading }}">
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
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
                                            {{--                                                        <b class="sub-heading">{{ $intTopContent->content_sub_heading }}</b>--}}
                                            <span class="red-text">{{ $specialTopContent->content_sub_heading }}</span> /
                                        @endif
                                        {{ $specialTopContent->content_heading }}
                                    </a>
                                </h3>
                            </div>

                            @php($specialOtherContents = $specialContents->all())

                            @if($specialOtherContents)
                                @foreach($specialOtherContents as $content)
                                    @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
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
                                                        <span class="red-text">{{ $content->content_sub_heading }}</span> /
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

            {{-- Middle Seven Ad --}}
            {{--@include('frontend.en.ads.home.middle-8-ad')--}}

             {{--Video Section--}}
            {{--<div class="row marginBottom20">
                <div class="col-sm-12">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="#">Video</a>
                        </span>
                    </div>
                    <div class="well custom-well">
                        <div class="row FlexRow img-w-full">

                            @if($featureContents)

                                @foreach($featureContents as $content)

                                    @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                    <div class="col-sm-2">
                                        <div class="cat-box-sub">
                                            <div class="imgbox">
                                                <a href="{{ $sURL }}">
                                                    --}}{{--@if($content->video_type == 1 && $content->video_id)
                                                        <img src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="img-responsive" alt="{{ $content->content_heading }}">
                                                    @else
                                                        <img src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                    @endif--}}{{--
                                                    <img src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">

                                                    @if($content->video_id)
                                                        <div class="video-icon">
                                                            <i class="fa fa-play-circle-o"></i>
                                                        </div>
                                                    @endif
                                                </a>
                                            </div>
                                            <h3>
                                                <a href="{{ $sURL }}">
                                                    @if($content->content_sub_heading)
                                                        <b class="sub-heading">{{ $content->content_sub_heading }}</b>
                                                    @endif
                                                    {{ $content->content_heading }}
                                                </a>
                                            </h3>
                                        </div>
                                    </div>

                                @endforeach

                            @endif

                        </div>
                    </div>
                </div>
            </div>--}}

            {{-- Middle Eight Ad --}}
            {{--@include('frontend.en.ads.home.middle-9-ad')--}}

            <!-- 4 category sections -->
            {{--<div class="row marginBottom20">
                <div class="col-sm-3 marginBottom20">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ fEnRoot('career') }}">Career</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($careerContents)
                            @php($careerTopContent = $careerContents->shift())
                            @php($sURL = fEnURL($careerTopContent->content_id, $careerTopContent->category->cat_slug, ($careerTopContent->subcategory->subcat_slug ?? null), $careerTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        <img src="{{ $careerTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$careerTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $careerTopContent->content_heading }}" title="{{ $careerTopContent->content_heading }}">
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if($careerTopContent->content_sub_heading)
                                            <b class="sub-heading">{{ $careerTopContent->content_sub_heading }}</b>
                                        @endif
                                        @if(!empty($careerTopContent->video_id) || !empty($careerTopContent->podcast_id))
                                            <span class="video-audio-icon">
                                                @if(!empty($careerTopContent->video_id))
                                                    <i class="fa fa-play"></i>
                                                @endif
                                                @if(!empty($careerTopContent->podcast_id))
                                                    <i class="fa fa-volume-up"></i>
                                                @endif
                                            </span>
                                        @endif
                                        {{ $careerTopContent->content_heading }}
                                    </a>
                                </h3>
                            </div>

                            @php($careerOtherContents = $careerContents->all())

                            @if($careerOtherContents)
                                @foreach($careerOtherContents as $content)
                                    @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="{{ $sURL }}">
                                                    @if($content->content_sub_heading)
                                                        <b class="sub-heading">{{ $content->content_sub_heading }}</b>
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
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-sm-3 marginBottom20">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                          <a class="common-title-link" href="{{ fEnRoot('interview') }}">Interview </a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($interviewContents)
                            @php($interviewTopContent = $interviewContents->shift())
                            @php($sURL = fEnURL($interviewTopContent->content_id, $interviewTopContent->category->cat_slug, ($interviewTopContent->subcategory->subcat_slug ?? null), $interviewTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        <img src="{{ $interviewTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$interviewTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $interviewTopContent->content_heading }}" title="{{ $interviewTopContent->content_heading }}">
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if($interviewTopContent->content_sub_heading)
                                            <b class="sub-heading">{{ $interviewTopContent->content_sub_heading }}</b>
                                        @endif
                                        @if(!empty($interviewTopContent->video_id) || !empty($interviewTopContent->podcast_id))
                                            <span class="video-audio-icon">
                                                @if(!empty($interviewTopContent->video_id))
                                                    <i class="fa fa-play"></i>
                                                @endif
                                                @if(!empty($interviewTopContent->podcast_id))
                                                    <i class="fa fa-volume-up"></i>
                                                @endif
                                            </span>
                                        @endif
                                        {{ $interviewTopContent->content_heading }}
                                    </a>
                                </h3>
                            </div>

                            @php($interviewOtherContents = $interviewContents->all())

                            @if($interviewOtherContents)
                                @foreach($interviewOtherContents as $content)
                                    @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
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
                <div class="col-sm-3 marginBottom20">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ fEnRoot('district-upozilla') }}">District</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($disUpozContents)
                            @php($disUpoTopContent = $disUpozContents->shift())
                            @php($sURL = fEnURL($disUpoTopContent->content_id, $disUpoTopContent->category->cat_slug, ($disUpoTopContent->subcategory->subcat_slug ?? null), $disUpoTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        <img src="{{ $disUpoTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$disUpoTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $disUpoTopContent->content_heading }}" title="{{ $disUpoTopContent->content_heading }}">
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if($disUpoTopContent->content_sub_heading)
                                            <b class="sub-heading">{{ $disUpoTopContent->content_sub_heading }}</b>
                                        @endif
                                            @if(!empty($disUpoTopContent->video_id) || !empty($disUpoTopContent->podcast_id))
                                                <span class="video-audio-icon">
                                                    @if(!empty($disUpoTopContent->video_id))
                                                        <i class="fa fa-play"></i>
                                                    @endif
                                                    @if(!empty($disUpoTopContent->podcast_id))
                                                        <i class="fa fa-volume-up"></i>
                                                    @endif
                                                </span>
                                            @endif
                                        {{ $disUpoTopContent->content_heading }}
                                    </a>
                                </h3>
                            </div>

                            @php($distUpozOtherContents = $disUpozContents->all())

                            @if($distUpozOtherContents)
                                @foreach($distUpozOtherContents as $content)
                                    @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
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

                <div class="col-sm-3 marginBottom20">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/en/tourism') }}">Tourism</a>
                        </span>
                    </div>
                    <div class="cat-box-with-media default-height no-left">
                        @if($tourismContents)
                            @php($tourismTopContent = $tourismContents->shift())
                            @php($sURL = fEnURL($tourismTopContent->content_id, $tourismTopContent->category->cat_slug, ($tourismTopContent->subcategory->subcat_slug ?? null), $tourismTopContent->content_type))
                            <div class="cat-box">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        <img src="{{ $tourismTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$tourismTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $tourismTopContent->content_heading }}" title="{{ $tourismTopContent->content_heading }}">
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if($tourismTopContent->content_sub_heading)
                                            <b class="sub-heading">{{ $tourismTopContent->content_sub_heading }}</b>
                                        @endif
                                        @if(!empty($tourismTopContent->video_id) || !empty($tourismTopContent->podcast_id))
                                            <span class="video-audio-icon">
                                                    @if(!empty($tourismTopContent->video_id))
                                                    <i class="fa fa-play"></i>
                                                @endif
                                                @if(!empty($tourismTopContent->podcast_id))
                                                    <i class="fa fa-volume-up"></i>
                                                @endif
                                                </span>
                                        @endif
                                        {{ $tourismTopContent->content_heading }}
                                    </a>
                                </h3>
                            </div>

                            @php($tourismOtherContents = $tourismContents->all())

                            @if($tourismOtherContents)
                                @foreach($tourismOtherContents as $content)
                                    @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                    <div class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading">
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
            </div>--}}

            {{-- Middle Nine Ad --}}
            @include('frontend.en.ads.home.middle-10-ad')
        </div>
    </div>

    @include('frontend.en.ads.common.site-block-ad')
@endsection

@section('custom-js')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="{{ asset('frontend-assets/plugins/bootstrap/bootstrap.min.js') }}"></script>

    @if($breakingContents->count())
        <script src="{{ asset('frontend-assets/plugins/breaking/breaking.js') }}"></script>
        <script>
            $(window).load(function() {
                $("#breaking-section").breakingNews({
                    effect		:"slide-h",
                    autoplay	:true,
                    timer		:3000,
                    color		:'darkred'
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

            if(videoType==="1") {
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
