@extends('frontend.bn.app')

@section('title')
    {{$detailsContent->content_heading}}
@endsection
@php
    $sURL = fDesktopURL($detailsContent->content_id,$detailsContent->category->cat_slug,($detailsContent->subcategory ? $detailsContent->subcategory->subcat_slug : null),$detailsContent->content_type);
    $ogImage = url('share-image/'.$detailsContent->category->cat_slug).'?t='.date('Ymdhi').'&imgPath='.$detailsContent->img_bg_path;

    $readContentId = [];
    $related = null;

@endphp

@section('customMeta')
    <meta content="500" http-equiv="refresh">
    <meta name="description"
          content="{{ !empty($detailsContent->meta_details) ? $detailsContent->meta_details : fGetWord(fFormatString($detailsContent->content_brief),20) }}"/>
    <link rel="canonical" href="{{$sURL}}">
    <meta name="keywords" content="{{ $detailsContent->meta_keywords }}">

    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{ $sURL }}"/>
    <meta property="og:title" content="{{ $detailsContent->content_heading }}"/>
    <meta property="og:image" content="{{ $ogImage }}"/>
    <meta property="og:site_name" content="{{ config('app.url') }}"/>
    <meta property="og:description"
          content="{{ !empty($detailsContent->meta_details) ? $detailsContent->meta_details : fGetWord(fFormatString($detailsContent->content_brief),20) }}"/>
    <meta property="article:author" content="{{ url('/') }}"/>

    <meta name="twitter:title" content="{{ $detailsContent->content_heading }}">
    <meta name="twitter:description"
          content="{{ !empty($detailsContent->meta_details) ? $detailsContent->meta_details : fGetWord(fFormatString($detailsContent->content_brief),20) }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    <script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "NewsArticle",
		"url" : "{{$sURL}}",
		"mainEntityOfPage":{
			"@type":"WebPage",
			"name" : "{{ $detailsContent->content_heading }}",
			"@id":"{{$sURL}}"
		},
		"headline": "{{ $detailsContent->content_heading }}",
		"image": {
			"@type": "ImageObject",
			"url": "{{ $detailsContent->img_bg_path ? asset(config('appconfig.contentImagePath').$detailsContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
		},
		"datePublished": "{{ date('d F Y, h:i a', strtotime($detailsContent->created_at)) }}",
		"dateModified": "{{ date('d F Y, h:i a', strtotime($detailsContent->updated_at)) }}",
		"author": {
			"@type": "Person",
			"url": "{{$authors->count() ? url('/author/'.$authors->first()->author_slug): url('/')}}",
			"name": "{{$authors->count() ? $authors->first()->author_name_bn : 'ঢাকা প্রকাশ'}}"
		},
		"publisher": {
			"@type": "Organization",
			"name": "{{url('/')}}",
			"logo": {
				"@type": "ImageObject",
				"url": "{{ asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->logo) }}"
			}
		}
	}



    </script>
    <script type="application/ld+json">
	{
		"@context":"https://schema.org",
		"@type":"BreadcrumbList",
		"itemListElement":[
			{
				"@type":"ListItem",
				"position":1,
				"item":{
					"@id":"{{url('/')}}",
					"name":"Home"
				}
			},
			{
				"@type":"ListItem",
				"position":2,
				"item":{
					"@id":"{{url($detailsContent->category->cat_slug)}}",
					"name":"{{$detailsContent->category->cat_name_bn}}"
				}
			},
			{
				"@type":"ListItem",
				"position":3,
				"item":{
					"name": "{{$detailsContent->content_heading}}",
					"@id":"{{$sURL}}"
				}
			}
		]
	}



    </script>
@endsection

@section('fb-sdk')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/en_AUS/sdk.js#xfbml=1&version=v12.0&appId={{config('appconfig.fb_app_id')}}&autoLogAppEvents=1"></script>
@endsection

@section('custom-css')
    <style>
        .description img {
            cursor: zoom-in;
        }
        #fullpage {
            display: none;
            position: fixed;
            z-index: 99999999;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-size: contain;
            background-repeat: no-repeat no-repeat;
            background-position: center center;
            background-color: black;
            overflow: hidden;

        }
        /* Sticky Scroll */
        .col-sm-3.d-print-none {
            position: sticky;
            top: 50px;
        }
        .main-content .container {
            position: relative;
        }
        /* Sticky Scroll */
        figure.image figcaption {
            color: gray;
            font-size: 14px;
            border-bottom: 1px solid #ccc;
            padding: 0px 0px 5px 0px;
            line-height: 22px;
            margin-bottom: 10px;
        }
        .shareSocialIconss span {
            font-size: 12px;
        }
        .print_icon {
            display: inline-block;
            position: absolute;
            top: 5px;
            right: 0px;
        }
        .print_icon a{cursor: pointer;
            font-size: 16px;
            height: 40px;
            padding: 4px 8px;
            text-align: center;
            background-color: #222222;
            border-radius: 50%;
            color: #fff;}
        .socialShare_details a img {
            width: 28px;
            height: 28px;
        }
        .socialShare_details.d-flex a {
            margin-right: 9px;
        }
        div.shareSocialIconss img {
            width: 28px;
            height: 28px;
        }
        div.socialShare_details img, div.socialShare_details svg, div.shareSocialIconss img{
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }
        /*div.socialShare_details img:hover, div.socialShare_details svg:hover, div.shareSocialIconss img:hover {*/
        /*    -webkit-transform: scale(1.4);*/
        /*}*/
        div.socialShare_details img:hover, div.socialShare_details svg:hover, div.shareSocialIconss img:hover {
            /* -webkit-transform: scale(1.4); */
            top: -5px;
            position: relative;
        }

        .d-show-print {
            display: none;
        }

        .inside-news {
            width: 80%;
            margin-left: 9%;
        }

        .social-links_items {
            text-align: center;
            margin-right: -12px !important;
        }
        .postDetail_social h3 {
            text-align: center;
        }
        .social-links_items a:hover {
            color: transparent;
        }
        .social-links_items a {
            margin-right: 10px;
        }
        .social-links_items a:active, .social-links_items a:focus, .social-links_items a:visited {
            color: transparent;
        }
        /* Long Link Text block */
        .news-details .description p a {
            /*display: block;*/
            white-space: pre-wrap; /* css-3 */
            white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
            white-space: -pre-wrap; /* Opera 4-6 */
            white-space: -o-pre-wrap; /* Opera 7 */
            word-wrap: break-word; /* Internet Explorer 5.5+ */
        }
        /* Long Link Text block */
        @media print {
            a[href]:after {
                display: none !important;
                visibility: hidden;
            }

            #veta-version, #back_to_top {
                display: none !important
            }

            .d-show-print {
                display: block;
                border-bottom: 1px solid black !important;
                margin-bottom: 30px !important;
            }
        }

        @media screen and (max-width: 575px) {
            .inside-news {
                width: 100%;
                margin-left: 0;
            }
            .description iframe {
                width: 100%;
            }
        }


    </style>
@endsection

@section('mainContent')

    <div class="main-content">
        <div class="container marginTop10">
            <!-- Top Section -->
            <p class="breadcrumb marginBottom0">
                <a href="{{ url('/') }}"><i class="fa fa-home"></i></a>
                <span>&raquo;</span>
                <a href="{{ url($detailsContent->category->cat_slug) }}"
                   class="active">{{ $detailsContent->category->cat_name_bn }}</a>
                @if($detailsContent->subcategory)
                    <span>&raquo;</span>
                    <a href="{{ url($detailsContent->category->cat_slug . '/' . $detailsContent->subcategory->subcat_slug) }}"
                       class="active">{{ $detailsContent->subcategory->subcat_name_bn }}</a>
                @endif
            </p>

        {{-- Details Top Ad--}}
        @if(isMobile())
            @include('frontend.bn.mobile-ads.details.details-top-ad')
        @else
            @include('frontend.bn.ads.details.details-top-ad')
        @endif

        <!-- ================= Main Post Details =============== -->
            <div class="row marginBottom20 marginTop20">

                <div class="col-sm-9 single_news" data-href="{{$sURL}}" data-title="{{$detailsContent->content_heading}}" data-description="{{$detailsContent->content_brief}}" data-image_src="{{ url('share-image/'.$detailsContent->category->cat_slug).'?t='.date('Ymdhi').'&imgPath='.$detailsContent->img_bg_path }}" data-nid="{{$detailsContent->content_id}}" id="printArea">
                    <div class="d-show-print">
                        <img class="img-responsive"
                             src="{{ asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->logo) }}">
                        <hr/>
                    </div>
                    <div class="news-details">
                        @if($detailsContent->content_sub_heading)
                            <b class="sub-heading"
                               style="font-size: 20px; margin-top: 15px;">{{ $detailsContent->content_sub_heading }}</b>
                        @endif
                        <h1>{{ $detailsContent->content_heading }}</h1>

                        <!-- First Author Start --->
                        <div class="marginTop10">
                            <div class="row d-flex align-items-center m-d-flex-none">
                                <div class="col-md-6">
                                    <div class="author-image d-flex align-items-center">
                                        @if($authors->count())
                                            @foreach($authors as $author)
                                                <span style="{{ $loop->iteration > 1 ? 'margin-left: 10px' : '' }}">
                                                    @if($author->img_path)
                                                        <img
                                                            src="{{asset(config('appconfig.authorImagePath').$author->img_path)}}"
                                                            alt="{{$author->author_name_bn}}">
                                                    @else
                                                        <img
                                                            src="{{asset(config('appconfig.commonImagePath').'favicon.png')}}"
                                                            alt="ঢাকা প্রকাশ">
                                                    @endif
                                                    <a href="{{url('/author/'.$author->author_slug) }}">{{ $author->author_name_bn }}</a>
                                                </span>
                                                {{ $loop->count > 1 && $loop->iteration == 1 ? ',' : '' }}
                                            @endforeach

                                        @else
                                            <img src="{{asset(config('appconfig.commonImagePath').'favicon.png')}}"
                                                 alt="ঢাকা প্রকাশ">
                                            @if($detailsContent->author_name != null)
                                                <a href="javascript:void(0)">{{ $detailsContent->author_name }}</a>
                                            @else
                                                <a href="{{ url('/') }}">ঢাকা প্রকাশ</a>
                                            @endif
                                        @endif
                                    </div>
                                    <p class="news-time" style="margin: 5px 0">
                                        <i class="fa fa-clock-o"></i> {{ fFormatDateEn2Bn(date('d F Y, h:i a', strtotime($detailsContent->created_at))) }}
                                        {{ $detailsContent->updated_at ? '| আপডেট: ' . fFormatDateEn2Bn(date('d F Y, h:i a', strtotime($detailsContent->updated_at))) : '' }}
                                    </p>
                                </div>
                                <div class="col-md-6 text-right m-text-left d-print-none">
                                    <div class="row m-justify-content-start">
                                        <div class="col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                            <div class="social-share-box d-print-none" style="position: relative;">
                                                <!-- ShareThis BEGIN -->
                                                <div class="sharethis-inline-share-buttons" data-url="{{ $sURL }}" data-title="{{$detailsContent->content_heading}}"></div>
                                                <!-- ShareThis END -->

                                                <div class="print_icon">
                                                    <a style="cursor:pointer" onclick="printPageArea('printArea')" title="Print news" target="_blank" class="print-butn"><i class="fa fa-print fa-md"></i></a>
                                                </div>
{{--                                                <script >--}}
{{--                                                    $(document).ready(function (){--}}
{{--                                                        $('.print-butn').on('click',function(){--}}
{{--                                                            var html = '<html><head>'+$('head').html()+'</head><body>'+$('#logo_top').html();--}}

{{--                                                            var  content = $(this).parents('.news-details').clone()--}}
{{--                                                            content.prepend('<div style="padding:0px;margin-left:-10px">'+$('#logo_top').html());--}}
{{--                                                            content.find('.share_section').hide();--}}
{{--                                                            content.find('.dtl_google_news').hide();--}}
{{--                                                            content.find('#facebook_comments').hide();--}}
{{--                                                            content.find('#related_news').hide();--}}
{{--                                                            content.find('#tags_list').hide();--}}
{{--                                                            content.find('.add-dtl').hide();--}}
{{--                                                            content.find('.print-butn').hide();--}}
{{--                                                            content.find('.st-total').hide();--}}
{{--                                                            content.find('.ads').remove();--}}
{{--                                                            content = content.append($('#print_footer').removeClass("d-none"));--}}
{{--                                                            content.append('</div>');--}}

{{--                                                            $(content).printArea();--}}
{{--                                                        });--}}
{{--                                                    })--}}
{{--                                                </script>--}}
                                                <!--<div class="socialShare_details">-->

                                                <!--    <a href="javascript:void(0)" onclick="printPageArea('printArea')" class="socialIcon">-->
                                                <!--        <svg height="32" width="32" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" enable-background="new 0 0 32 32" xml:space="preserve"><path fill="#595959" d="M16,0L16,0c8.837,0,16,7.163,16,16l0,0c0,8.837-7.163,16-16,16l0,0C7.163,32,0,24.837,0,16l0,0 C0,7.163,7.163,0,16,0z"></path><path fill="#FFFFFF" d="M12,20h8v4h-8V20z M21.6,22.4v-4H10.4v4H8.8c-0.212,0-0.416-0.084-0.566-0.234C8.084,22.016,8,21.812,8,21.6 v-8c0-0.212,0.084-0.416,0.234-0.566C8.384,12.884,8.588,12.8,8.8,12.8h14.4c0.212,0,0.416,0.084,0.566,0.234 C23.916,13.184,24,13.388,24,13.6v8c0,0.212-0.084,0.416-0.234,0.566c-0.15,0.15-0.353,0.234-0.566,0.234H21.6z M10.4,14.4V16h2.4 v-1.6H10.4z M12,8h8c0.212,0,0.416,0.084,0.566,0.234C20.716,8.384,20.8,8.588,20.8,8.8v2.4h-9.6V8.8 c0-0.212,0.084-0.416,0.234-0.566C11.584,8.084,11.788,8,12,8z"></path></svg>-->
                                                <!--    </a>-->
                                                <!--</div>-->
                                            </div>
{{--                                        @include('frontend.bn.partials.social-icons-details-page')--}}
                                        </div>
                                    </div>
                                </div>
                                        {{--<iframe src="https://www.facebook.com/plugins/share_button.php?href={{$sURL}}&layout=button_count&size=large&width=105&height=28&appId" width="105" height="28" style="width: 105px; border: none; overflow: hidden; margin-bottom: 5px;" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>--}}
{{--                                        <div class="col-sm-6 col-xs-12">--}}
{{--                                            <div class="addthis_inline_share_toolbox"></div>--}}
{{--                                        </div>--}}

                            </div>
                        </div>
                        <!-- First Author Start $sURL --->



                        <hr style="margin: 0 0 12px 0">

                        <div class="imgbox">

                            @if($detailsContent->video_id)
                                @if($detailsContent->video_type == 1)
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <figure class="content-media content-media--video" id="featured-media">
                                            <iframe
                                                src="https://www.youtube.com/embed/{{ $detailsContent->video_id }}?enablejsapi=1&rel=1&showinfo=1&controls=1"
                                                frameborder="0" allowfullscreen></iframe>
                                        </figure>
                                    </div>
                                @elseif($detailsContent->video_type == 2)
                                    <div class="fb-video"
                                         data-href="https://www.facebook.com/watch/?v={{$detailsContent->video_id}}"
                                         data-width="auto" data-autoplay="false" data-show-captions="false"></div>
                                    {{--<div class="fb-video" data-href="https://www.facebook.com/{{ $detailsContent->video_id }}" data-autoplay="false" data-show-text="false" data-show-captions="false" data-allowfullscreen="true"></div>--}}
                                @endif

                            @else
                                <img style="cursor: zoom-in" onclick="getPic('{{ $detailsContent->img_bg_path ? asset(config('appconfig.contentImagePath').$detailsContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}')"
                                    src="{{ $detailsContent->img_bg_path ? asset(config('appconfig.contentImagePath').$detailsContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                    class="img-responsive" alt="{{ $detailsContent->content_heading }}"
                                    title="{{ $detailsContent->content_heading }}">
                            @endif
                        </div>

                        @if($detailsContent->img_bg_caption)
                            <div class="caption">
                                {{ $detailsContent->img_bg_caption }}
                            </div>
                        @endif

                        @if(!empty($detailsContent->podcast_id))
                            <iframe style="margin: 15px 0 0"
                                    src="https://widget.spreaker.com/player?episode_id={{$detailsContent->podcast_id}}&theme=light&playlist=false&playlist-continuous=false&chapters-image=true&episode_image_position=right&hide-logo=false&hide-likes=false&hide-comments=false&hide-sharing=false&hide-download=true"
                                    width="100%" height="200px" frameborder="0"></iframe>
                        @endif

                        <div>
                            @if($detailsContent->tags)
                                @php($tags = explode(',', $detailsContent->tags))
                                @if($tags[0] === 'ম্যান-টি-টোয়েন্টি-ওয়ার্ল্ড-কাপ-২০২২')
                                    <div>
                                        <img src="{{ asset('media/common/Report-Logo_2.png') }}"
                                             alt="Men T20 World Cup-2022"
                                             style="width: 187px!important; height: 88px!important; float: left!important; margin-right: 10px; margin-top: 5px;">
                                    </div>
                                @endif
                            @endif
                            <div class="description firstDescription" style="display: inline!important;">
                                {!! $detailsContent->content_details !!}
                            </div>
                        </div>
                    </div>

                    <div class="d-print-none">
                        <hr>
                        <div class="gist">
                            <p>বিভাগ :
                                <a href="{{ url($detailsContent->category->cat_slug) }}"> {{ $detailsContent->category->cat_name_bn }}</a>
                            </p>

                            @if($detailsContent->tags)
                                @php($tags = explode(',', $detailsContent->tags))
                                <p>বিষয় :
                                    @foreach($tags as $tag)
                                        <a href="{{ url('/topic/'.$tag) }}" class="bg-info"
                                           style="padding: 2px 5px; border-radius: 2px;">{{ $tag }}</a>
                                        @if(!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
                            @endif
                        </div>
                        <hr>
                    </div>
                    <!-- Start Facebook & Youtube -->
                    <div class="row d-print-none">
                        <div class="col-md-6 col-xs-6 col-sm-6">
{{--                            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fdhakaprokash24&tabs=timeline&width=250&height=70&small_header=true&adapt_container_width=true&hide_cover=true&show_facepile=false&appId" width="240" height="70" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>--}}
                            <div id="fb-root"></div>
                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0&appId=324551766607185&autoLogAppEvents=1" nonce="IOSWlxYX"></script>
                            <div class="fb-page" data-href="https://www.facebook.com/dhakaprokash24" data-tabs="timeline" data-width="240" data-height="70" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false"><blockquote cite="https://www.facebook.com/dhakaprokash24" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/dhakaprokash24">Dhaka Prokash</a></blockquote></div>
                        </div>
                        <div class="col-md-4 col-xs-4 col-sm-4" style="margin-top: 10px;margin-left: 20px;">
                            <script src="https://apis.google.com/js/platform.js"></script>
                            <div class="g-ytsubscribe" data-channelid="UCeB7K4IRCC_Rb1w5HswUPnQ" data-layout="full" data-count="hidden"></div>
                        </div>

                    </div>
                    <!-- End Facebook & Youtube -->
                    <div class="d-print-none" style="padding: .5rem 0">
                        <div class="fb-comments" data-href="{{$sURL}}" data-width="100%"
                             data-numposts="5"></div>
                    </div>

                    {{-- Details after ad--}}
                    @if(isMobile())
                        @include('frontend.bn.mobile-ads.details.details-after-ad')
                    @else
                        @include('frontend.bn.ads.details.details-after-ad')
                    @endif


                </div>

                <div class="col-sm-3 d-print-none">

                {{-- Details right one ad --}}
                @if(isMobile())
                    @include('frontend.bn.mobile-ads.details.details-right-one-ad')
                @else
                    @include('frontend.bn.ads.details.details-right-one-ad')
                @endif

                <!-- First Right Side Category Post -->
                    {{--                    @if(!isMobile())--}}
                    <div>
                        <div class="common-title common-title-brown mb-4">
                            <span class="common-title-shape">
                                <span class="common-title-link">এই বিভাগের আরও </span>
                            </span>
                        </div>
                        <div class="cat-box-with-media default-height">

                            @foreach($moreContents as $content)

                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                <div class="media">
                                    <div class="media-left">
                                        <div class="imgbox">
                                            <a href="{{ $sURL }}">
                                                <img
                                                    src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}"
                                                    class="img-responsive" alt="{{ $content->content_heading }}"
                                                    title="{{ $content->content_heading }}">
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
                                                {{ $content->content_heading }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>

                            @endforeach

                        </div>

                    </div>

                    <!-- Right Sidebar Facebook -->
                    <div class="detail-page-faceboksidebar" style="margin-top: 15px">
                        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fdhakaprokash24&tabs=timeline&width=340&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                    </div>
{{--                    <div class="recruitment-banner" style="margin-top: 10px; margin-bottom: 10px">--}}
{{--                        <a href="{{ asset('/images/banner.jpg') }}"><img src="{{ asset('/images/banner.jpg') }}" width="100%" /></a>--}}
{{--                    </div>--}}

                    {{--                    @endif--}}
                <!-- First Right Side Category Post -->
                    {{-- Details right two ad--}}
                    @if(isMobile())
                        @include('frontend.bn.mobile-ads.details.details-right-two-ad')
                    @else
                        @include('frontend.bn.ads.details.details-right-two-ad')
                    @endif

                    {{-- Details right three ad--}}
{{--                    @if(!isMobile())--}}
                        @include('frontend.bn.ads.details.details-right-three-ad')
{{--                    @endif--}}

                </div>


            </div>

            <!-- ================= Main Post Details =============== -->

            <!-- ================= First Related Post ================= -->
            @php( $relatedContentDetail = \App\Models\BnContent::with('category', 'subcategory')
        ->where('content_id', '<>', $detailsContent->content_id)
        //->where('cat_id', $detailsContent->cat_id)
        ->where('status', 1)
        ->where('deletable', 1)
        ->orderByDesc('content_id')
        ->take(5)
        ->get() )
            @if($relatedContentDetail)

                <div class="row related-news d-print-none">
                    <div class="col-sm-12">
                        <div class="common-title common-title-brown mb-4">
                            <span class="common-title-shape">
                                <a class="common-title-link" href="#">আরও পড়ুন</a>
                            </span>
                        </div>
                        <div class="row FlexRow">

                                @foreach($relatedContentDetail as $content)

                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                <!-- Skip First content -->
                                @if ($loop->first)
                                    <!-- Skipping first post content -->

                                    @else
                                <div class="col-sm-3 col-xs-6">
                                    <div class="single_related">
                                        <div class="imgbox">
                                            <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                <img
                                                    src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                                    class="img-responsive" alt="{{ $content->content_heading }}"
                                                    title="{{ $content->content_heading }}">
                                            </a>
                                        </div>
                                        <h3>
                                            <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
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
                                        </h3>
                                    </div>
                                </div>
                                @endif
                                <!-- Skip First content -->
                                @if($loop->iteration == 8) @endif

                                @endforeach
                        </div>
                        {{-- Details Bottom Ad--}}
                        @if(isMobile())
                            @include('frontend.bn.mobile-ads.details.details-bottom-ad')
                        @else
                            @include('frontend.bn.ads.details.details-bottom-ad')
                        @endif
                        <div class="row FlexRow">




                        </div>
                    </div>
                </div>
            @endif
        <!-- ================= End First Related Post ================= -->



            <!-- ============== Start Second Post Details =========== -->

            @foreach($moreDetailContent as $key=> $dcontent)
                {{--                @php($dcontent = \App\Models\BnContent::with('category', 'subcategory')--}}
                {{--                    ->where('cat_id', rand(1,20))--}}
                {{--                    ->where('status', 1)--}}
                {{--                    ->where('deletable', 1)--}}
                {{--                    ->orderBy('content_id', 'DESC')--}}
                {{--                    ->first())--}}


{{--                @php($getCategory = BnCategory::where('cat_id', $dcontent->cat_id)->first())--}}
                @php($moreNewsInside = \App\Models\BnContent::with('category:cat_id,cat_slug', 'subcategory:subcat_id,subcat_slug')
                ->select(['content_id', 'cat_id', 'subcat_id', 'content_heading', 'img_xs_path'])
                // ->whereRaw('FIND_IN_SET(?, tags)', $tags[0])
                //->where('content_id', '<>', $dcontent->content_id)
                ->whereNotIn('content_id', [$detailsContent->content_id, $dcontent->content_id])
                ->where('cat_id', $dcontent->cat_id)
                ->where('status', 1)
                ->where('deletable', 1)
                ->orderByDesc('content_id')
                ->limit(5)
                ->get())

                @php($postInsideContent[] = $moreNewsInside )


                @php($sURL = fDesktopURL($dcontent->content_id,$dcontent->category->cat_slug,($dcontent->subcategory ? $dcontent->subcategory->subcat_slug : null),$dcontent->content_type))
            <!-- ================= Main Post Details =============== -->
                <div class="row marginBottom20 marginTop20" style="margin-top: 40px">

                    <div class="col-sm-9 single_news" data-href="{{$sURL}}" data-title="{{$dcontent->content_heading}}" data-description="{{$dcontent->content_brief}}" data-image_src="{{ url('share-image/'.$dcontent->category->cat_slug).'?t='.date('Ymdhi').'&imgPath='.$dcontent->img_bg_path }}" data-nid="{{$dcontent->content_id}}" id="printArea{{$key}}">
                        <div class="d-show-print">
                            <img class="img-responsive"
                                 src="{{ asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->logo) }}">
                            <hr/>
                        </div>
                        <div class="news-details">
                            @if($dcontent->content_sub_heading)
                                <b class="sub-heading"
                                   style="font-size: 20px; margin-top: 15px;">{{ $dcontent->content_sub_heading }}</b>
                            @endif
                            <h1>{{ $dcontent->content_heading }}</h1>

                            <!-- First Author Start --->
                                @php($aAuthorSlugs = explode(',', $dcontent->author_slugs))
                                @php($sAuthorSlugs = "'" . implode("','",$aAuthorSlugs) . "'")
                                @php($authors = \App\Models\BnAuthor::query()
            ->select(['author_name_bn', 'author_slug', 'img_path'])
            ->whereIn('author_slug', $aAuthorSlugs)
            ->where('deletable', 1)
            ->orderByRaw("FIELD(author_slug, $sAuthorSlugs)")
            ->get())
                            <div class="marginTop10">
                                <div class="row d-flex align-items-center m-d-flex-none">
                                    <div class="col-md-6">
                                        <div class="author-image d-flex align-items-center">
                                            @if($authors->count())
                                                @foreach($authors as $author)
                                                    <span style="{{ $loop->iteration > 1 ? 'margin-left: 10px' : '' }}">
                                                        @if($author->img_path)
                                                            <img
                                                                src="{{asset(config('appconfig.authorImagePath').$author->img_path)}}"
                                                                alt="{{$author->author_name_bn}}">
                                                        @else
                                                            <img
                                                                src="{{asset(config('appconfig.commonImagePath').'favicon.png')}}"
                                                                alt="ঢাকা প্রকাশ">
                                                        @endif
                                                        <a href="{{url('/author/'.$author->author_slug) }}">{{ $author->author_name_bn }}</a>
                                                    </span>
                                                    {{ $loop->count > 1 && $loop->iteration == 1 ? ',' : '' }}
                                                @endforeach

                                            @else
                                                <img src="{{asset(config('appconfig.commonImagePath').'favicon.png')}}"
                                                     alt="ঢাকা প্রকাশ">
                                                @if($dcontent->author_name != null)
                                                    <a href="javascript:void(0)">{{ $dcontent->author_name }}</a>
                                                @else
                                                    <a href="{{ url('/') }}">ঢাকা প্রকাশ</a>
                                                @endif
                                            @endif
                                        </div>
                                        <p class="news-time" style="margin: 5px 0">
                                            <i class="fa fa-clock-o"></i> {{ fFormatDateEn2Bn(date('d F Y, h:i a', strtotime($dcontent->created_at))) }}
                                            {{ $dcontent->updated_at ? '| আপডেট: ' . fFormatDateEn2Bn(date('d F Y, h:i a', strtotime($dcontent->updated_at))) : '' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 text-right m-text-left d-print-none">
                                        <div class="row m-justify-content-start">
                                            <div class="col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                                <div class="social-share-box d-print-none" style="position: relative;">
                                                    <!-- ShareThis BEGIN -->
                                                    <div class="sharethis-inline-share-buttons" data-url="{{ $sURL }}" data-title="{{$dcontent->content_heading}}"></div>
                                                    <!-- ShareThis END -->
                                                    <div class="print_icon">
                                                        <a style="cursor:pointer" onclick="printPageArea('printArea{{$key}}')" title="Print news" target="_blank" class="print-butn"><i class="fa fa-print fa-md"></i></a>
                                                    </div>
                                                    <!--<div class="socialShare_details">-->

                                                    <!--    <a href="javascript:void(0)" onclick="printPageArea('printArea')" class="socialIcon">-->
                                                    <!--        <svg height="32" width="32" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" enable-background="new 0 0 32 32" xml:space="preserve"><path fill="#595959" d="M16,0L16,0c8.837,0,16,7.163,16,16l0,0c0,8.837-7.163,16-16,16l0,0C7.163,32,0,24.837,0,16l0,0 C0,7.163,7.163,0,16,0z"></path><path fill="#FFFFFF" d="M12,20h8v4h-8V20z M21.6,22.4v-4H10.4v4H8.8c-0.212,0-0.416-0.084-0.566-0.234C8.084,22.016,8,21.812,8,21.6 v-8c0-0.212,0.084-0.416,0.234-0.566C8.384,12.884,8.588,12.8,8.8,12.8h14.4c0.212,0,0.416,0.084,0.566,0.234 C23.916,13.184,24,13.388,24,13.6v8c0,0.212-0.084,0.416-0.234,0.566c-0.15,0.15-0.353,0.234-0.566,0.234H21.6z M10.4,14.4V16h2.4 v-1.6H10.4z M12,8h8c0.212,0,0.416,0.084,0.566,0.234C20.716,8.384,20.8,8.588,20.8,8.8v2.4h-9.6V8.8 c0-0.212,0.084-0.416,0.234-0.566C11.584,8.084,11.788,8,12,8z"></path></svg>-->
                                                    <!--    </a>-->
                                                    <!--</div>-->
                                                </div>
                                                {{--                                        @include('frontend.bn.partials.social-icons-details-page')--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- First Author Start --->


                            <hr style="margin: 0 0 12px 0">

                            <div class="imgbox">

                                @if($dcontent->video_id)
                                    @if($dcontent->video_type == 1)
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <figure class="content-media content-media--video" id="featured-media">
                                                <iframe
                                                    src="https://www.youtube.com/embed/{{ $dcontent->video_id }}?enablejsapi=1&rel=1&showinfo=1&controls=1"
                                                    frameborder="0" allowfullscreen></iframe>
                                            </figure>
                                        </div>
                                    @elseif($dcontent->video_type == 2)
                                        <div class="fb-video"
                                             data-href="https://www.facebook.com/watch/?v={{$dcontent->video_id}}"
                                             data-width="auto" data-autoplay="false" data-show-captions="false"></div>
                                        {{--<div class="fb-video" data-href="https://www.facebook.com/{{ $detailsContent->video_id }}" data-autoplay="false" data-show-text="false" data-show-captions="false" data-allowfullscreen="true"></div>--}}
                                    @endif

                                @else
                                    <img style="cursor: zoom-in" onclick="getPic('{{ $dcontent->img_bg_path ? asset(config('appconfig.contentImagePath').$dcontent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}')"
                                        src="{{ $dcontent->img_bg_path ? asset(config('appconfig.contentImagePath').$dcontent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                        class="img-responsive" alt="{{ $dcontent->content_heading }}"
                                        title="{{ $dcontent->content_heading }}">
                                @endif
                            </div>

                            @if($dcontent->img_bg_caption)
                                <div class="caption">
                                    {{ $dcontent->img_bg_caption }}
                                </div>
                            @endif

                            @if(!empty($dcontent->podcast_id))
                                <iframe style="margin: 15px 0 0"
                                        src="https://widget.spreaker.com/player?episode_id={{$dcontent->podcast_id}}&theme=light&playlist=false&playlist-continuous=false&chapters-image=true&episode_image_position=right&hide-logo=false&hide-likes=false&hide-comments=false&hide-sharing=false&hide-download=true"
                                        width="100%" height="200px" frameborder="0"></iframe>
                            @endif

                            <div>
                                @if($dcontent->tags)
                                    @php($tags = explode(',', $dcontent->tags))
                                    @if($tags[0] === 'ম্যান-টি-টোয়েন্টি-ওয়ার্ল্ড-কাপ-২০২২')
                                        <div>
                                            <img src="{{ asset('media/common/Report-Logo_2.png') }}"
                                                 alt="Men T20 World Cup-2022"
                                                 style="width: 187px!important; height: 88px!important; float: left!important; margin-right: 10px; margin-top: 5px;">
                                        </div>
                                    @endif
                                @endif
                                <div class="description loopDescription{{$key}}" style="display: inline!important;">
                                    {!! $dcontent->content_details !!}
                                </div>
                            </div>
                        </div>

<!-- Second post script here -->


{{--                        <script>--}}
{{--                            let insideMoreNews{{$key+1}} = @json($moreNewsInside);--}}

{{--                            let desc{{$key+1}} = document.getElementsByClassName('loopDescription{{$key+1}}');--}}

{{--                                let descParas{{$key+1}} = desc{{$key+1}}[0].querySelectorAll('p');--}}

{{--                                let insertRelatedNews{{$key+1}} = (title, src, href) => {--}}

{{--                                    let relatedNews{{$key+1}} = document.createElement(`div`);--}}
{{--                                    relatedNews{{$key+1}}.className = `inside-news marginTop20 marginBottom20`;--}}

{{--                                    let h5{{$key+1}} = document.createElement(`h5`);--}}
{{--                                    h5{{$key+1}}.style.fontSize = `16px`;--}}
{{--                                    h5{{$key+1}}.style.fontWeight = `bold`;--}}
{{--                                    h5{{$key+1}}.innerText = `আরও পড়ুন`;--}}
{{--                                    relatedNews{{$key+1}}.append(h5);--}}

{{--                                    let containerFluid{{$key+1}} = document.createElement(`div`);--}}
{{--                                    containerFluid{{$key+1}}.className = `container-fluid`;--}}
{{--                                    containerFluid{{$key+1}}.style.border = `2px solid grey`;--}}
{{--                                    relatedNews{{$key+1}}.append(containerFluid{{$key+1}});--}}

{{--                                    let link{{$key+1}} = document{{$key+1}}.createElement(`a`);--}}
{{--                                    link{{$key+1}}.href = href;--}}
{{--                                    containerFluid{{$key+1}}.append(link{{$key+1}});--}}

{{--                                    let headline{{$key+1}} = document.createElement(`div`);--}}
{{--                                    headline{{$key+1}}.className = `headline marginTop10 marginBottom10`;--}}
{{--                                    headline{{$key+1}}.style.cssText = `font-size:19px;font-weight: bold; width: 65%; float: left`;--}}
{{--                                    headline{{$key+1}}.innerText = title;--}}
{{--                                    link{{$key+1}}.append(headline{{$key+1}});--}}

{{--                                    let img{{$key+1}} = document.createElement(`img`);--}}
{{--                                    img{{$key+1}}.className = `marginTop10 marginBottom10`;--}}
{{--                                    img{{$key+1}}.style.cssText = `width: 85px;float: right`;--}}
{{--                                    img{{$key+1}}.src = src;--}}
{{--                                    img{{$key+1}}.title = title;--}}
{{--                                    img{{$key+1}}.alt = title;--}}
{{--                                    link{{$key+1}}.append(img{{$key+1}});--}}

{{--                                    return relatedNews{{$key+1}};--}}
{{--                                }--}}

{{--                                let googleNews{{$key+1}} = () => {--}}
{{--                                    let link{{$key+1}} = document.createElement(`a`);--}}
{{--                                    link{{$key+1}}.className = `text-center marginTop10 marginBottom10`;--}}
{{--                                    link{{$key+1}}.style.cssText =`text-decoration:none; display:flex; justify-content:center`;--}}
{{--                                    link{{$key+1}}.href = `https://news.google.com/publications/CAAqBwgKMNq9sgsw59jJAw?ceid=BD:bn&oc=3&hl=bn&gl=BD`;--}}
{{--                                    link{{$key+1}}.target = `_blank`;--}}

{{--                                    let img{{$key+1}} = document.createElement(`img`);--}}
{{--                                    img{{$key+1}}.src = `https://cdn-icons-png.flaticon.com/512/2702/2702605.png`;--}}
{{--                                    img{{$key+1}}.style.cssText = `width: 25px; margin-right: 8px`;--}}

{{--                                    let h4{{$key+1}} = document.createElement(`h4`);--}}
{{--                                    h4{{$key+1}}.style.cssText = `font-weight: bold`;--}}
{{--                                    h4{{$key+1}}.innerText = `সর্বশেষ খবর পেতে ঢাকা প্রকাশের গুগল নিউজ চ্যানেলটি সাবস্ক্রাইব করুন ।`;--}}
{{--                                    link{{$key+1}}.append(img{{$key+1}});--}}
{{--                                    lin{{$key+1}}.append(h4{{$key+1}});--}}

{{--                                    return link{{$key+1}};--}}
{{--                                }--}}

{{--                                let itemIncrement{{$key+1}} = 0;--}}
{{--                                descParas{{$key+1}}.forEach((item, i) => {--}}

{{--                                    if (i > 0 && i % 3 === 0 && insideMoreNews{{$key+1}}[itemIncrement{{$key+1}}]) {--}}
{{--                                        descParas{{$key+1}}[0].parentNode.insertBefore(insertRelatedNews{{$key+1}}(insideMoreNews{{$key+1}}[itemIncrement{{$key+1}}].content_heading, fJsNewsImgPath{{$key+1}}(insideMoreNews{{$key+1}}[itemIncrement{{$key+1}}].img_xs_path), fJsNewsURL{{$key+1}}(insideMoreNews{{$key+1}}[itemIncrement{{$key+1}}].content_id, insideMoreNews{{$key+1}}[itemIncrement{{$key+1}}].category.cat_slug, insideMoreNews{{$key+1}}[itemIncrement{{$key+1}}].subcategory?.subcat_slug)), descParas{{$key+1}}[i-1].nextSibling);--}}

{{--                                        itemIncrement{{$key+1}}++;--}}
{{--                                    }--}}
{{--                                })--}}


{{--                                if (descParas{{$key+1}}.length > 1) {--}}
{{--                                    descParas{{$key+1}}[0].parentNode.insertBefore(googleNews{{$key+1}}(), descParas{{$key+1}}[0].nextSibling);--}}
{{--                                }--}}

{{--                                function fJsNewsURL{{$key+1}}(content_id, cat_slug, subcat_slug='') {--}}
{{--                                    return location.origin+'/'+cat_slug+(subcat_slug ? subcat_slug : '')+'/news/'+content_id;--}}
{{--                                }--}}

{{--                                function fJsNewsImgPath{{$key+1}}(img_path) {--}}
{{--                                    return location.origin+'/media/content/images/'+img_path;--}}
{{--                                }--}}


{{--                        </script>--}}


                        <div class="d-print-none">
                            <hr>
                            <div class="gist">
                                <p>বিভাগ :
                                    <a href="{{ url($dcontent->category->cat_slug) }}"> {{ $dcontent->category->cat_name_bn }}</a>
                                </p>

                                @if($dcontent->tags)
                                    @php($tags = explode(',', $dcontent->tags))
                                    <p>বিষয় :
                                        @foreach($tags as $tag)

                                            <a href="{{ url('/topic/'.$tag) }}" class="bg-info"
                                               style="padding: 2px 5px; border-radius: 2px;">{{ $tag }}</a>
                                            @if(!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </p>
                                @endif
                            </div>
                            <hr>
                        </div>
                        <!-- Start Facebook & Youtube -->
                        <div class="row d-print-none">
                            <div class="col-md-6 col-xs-6 col-sm-6 ">
{{--                                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fdhakaprokash24&tabs=timeline&width=250&height=70&small_header=true&adapt_container_width=true&hide_cover=true&show_facepile=false&appId" width="240" height="70" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>--}}
                                <div id="fb-root"></div>
                                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0&appId=324551766607185&autoLogAppEvents=1" nonce="IOSWlxYX"></script>
                                <div class="fb-page" data-href="https://www.facebook.com/dhakaprokash24" data-tabs="timeline" data-width="240" data-height="70" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false"><blockquote cite="https://www.facebook.com/dhakaprokash24" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/dhakaprokash24">Dhaka Prokash</a></blockquote></div>

                            </div>
                            <div class="col-md-4 col-xs-4 col-sm-4" style="margin-top: 10px;margin-left: 20px;">
                                <script src="https://apis.google.com/js/platform.js"></script>
                                <div class="g-ytsubscribe" data-channelid="UCeB7K4IRCC_Rb1w5HswUPnQ" data-layout="full" data-count="hidden"></div>
                            </div>
                        </div>
                        <!-- End Facebook & Youtube -->
                        <div class="d-print-none" style="padding: .5rem 0">
                            <div class="fb-comments" data-href="{{$sURL}}" data-width="100%"
                                 data-numposts="5"></div>
                        </div>

                        {{-- Details after ad--}}
                        @if(isMobile())
                            @include('frontend.bn.mobile-ads.details.details-after-ad')
                        @else
                            @include('frontend.bn.ads.details.details-after-ad')
                        @endif


                    </div>

                    <div class="col-sm-3 d-print-none">

                        {{-- Details right one ad --}}



                        @if(isMobile())
                            @include('frontend.bn.mobile-ads.details.details-right-one-ad')
                        @else
                            @include('frontend.bn.ads.details.details-right-one-ad')
                        @endif
                        {{--                        @if(!isMobile())--}}
                        <div>
                            <div class="common-title common-title-brown mb-4">
                                    <span class="common-title-shape">
                                        <span class="common-title-link">এই বিভাগের আরও </span>
                                    </span>
                            </div>
                            <div class="cat-box-with-media default-height">
                                <?php
                                //                                    $randomCatId = rand(1,20);
                                //                                    if ($randomCatId == $dcontent->cat_id) {
                                //                                        $randomCatId = rand(1,20);
                                //                                    }

                                $moreContentsss = \App\Models\BnContent::with('category', 'subcategory')
                                    ->where('cat_id', $dcontent->cat_id)
                                    ->where('status', 1)
                                    ->where('content_id', '<>', $dcontent->content_id)
                                    ->where('deletable', 1)
                                    ->latest()
                                    ->limit(5)
                                    ->get();
                                ?>
                                @foreach($moreContentsss as $content)

                                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                    <div class="media">
                                        <div class="media-left">
                                            <div class="imgbox">
                                                <a href="{{ $sURL }}">
                                                    <img
                                                        src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}"
                                                        class="img-responsive" alt="{{ $content->content_heading }}"
                                                        title="{{ $content->content_heading }}">
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
                                                    {{ $content->content_heading }}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>

                                @endforeach

                            </div>
                        </div>
                        {{--                        @endif--}}

                        <!-- Right Sidebar Facebook -->
                        <div class="detail-page-faceboksidebar" style="margin-top: 15px">
                            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fdhakaprokash24&tabs=timeline&width=340&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                        </div>

                        {{-- Details right two ad--}}
                        @if(isMobile())
                            @include('frontend.bn.mobile-ads.details.details-right-two-ad')
                        @else
                            @include('frontend.bn.ads.details.details-right-two-ad')
                        @endif

                        {{-- Details right three ad--}}
{{--                        @if(!isMobile())--}}
                            @include('frontend.bn.ads.details.details-right-three-ad')
{{--                        @endif--}}

                    </div>

                </div>

                <!-- ================= Main Post Details =============== -->


                @if(!$loop->last)
                <!-- ================= Releted Post ================= -->

                    @php($readContentId[] = $dcontent->content_id)
                    @php($readTrim = array_values($readContentId))

                    @php( $related = \App\Models\BnContent::with('category', 'subcategory')
                //->whereNotIn('content_id', [$detailsContent->content_id])
                ->whereNotIn('content_id', $readTrim)
                ->where('content_id','<>', $detailsContent->content_id)
                ->where('status', 1)
                ->where('deletable', 1)
                ->orderByDesc('content_id')
                ->take(5)
                ->get() )

                    @if($related)

                        <div class="row related-news d-print-none">
                            <div class="col-sm-12">
                                <div class="common-title common-title-brown mb-4">
                                <span class="common-title-shape">
                                    <a class="common-title-link" href="#">আরও পড়ুন </a>
                                </span>
                                </div>
                                <div class="row FlexRow">

                                    @foreach($related as $content)

                                        @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                        @if($loop->first) @else
                                        <div class="col-sm-3 col-xs-6">
                                            <div class="single_related">
                                                <div class="imgbox">
                                                    <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                        <img
                                                            src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                                            class="img-responsive" alt="{{ $content->content_heading }}"
                                                            title="{{ $content->content_heading }}">
                                                    </a>
                                                </div>
                                                <h3>
                                                    <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
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
                                                </h3>
                                            </div>
                                        </div>
                                        @endif
                                        @if($loop->iteration == 8)

                                        @endif

                                    @endforeach
                                </div>
                                {{-- Details Bottom Ad--}}
                                @if(isMobile())
                                    @include('frontend.bn.mobile-ads.details.details-bottom-ad')
                                @else
                                    @include('frontend.bn.ads.details.details-bottom-ad')
                                @endif
                                <div class="row FlexRow">


                                    <!--- -->

                                </div>

                            </div>
                        </div>
                    @endif
                <!-- ================= Releted Post ================= -->
                @else
                    @php( $related = \App\Models\BnContent::with('category', 'subcategory')
           //->whereNotIn('content_id', [$detailsContent->content_id])
           //->whereNotIn('content_id', $readTrim)
           //->where('content_id','<>', $detailsContent->content_id)
           ->where('status', 1)
           ->where('deletable', 1)
           ->orderByDesc('content_id')
           ->take(20)
           ->get() )

                    @if($related)

                        <div class="row related-news d-print-none">
                            <div class="col-sm-12">
                                <div class="common-title common-title-brown mb-4">
                                <span class="common-title-shape">
                                    <a class="common-title-link" href="#">সর্বশেষ সংবাদ</a>
                                </span>
                                </div>
                                <div class="row FlexRow">

                                    @foreach($related as $content)

                                        @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                        <div class="col-sm-3 col-xs-6">
                                            <div class="single_related">
                                                <div class="imgbox">
                                                    <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                        <img
                                                            src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                                            class="img-responsive" alt="{{ $content->content_heading }}"
                                                            title="{{ $content->content_heading }}">
                                                    </a>
                                                </div>
                                                <h3>
                                                    <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
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
                                                </h3>
                                            </div>
                                        </div>

                                        @if($loop->iteration == 8)

                                        @endif

                                    @endforeach
                                </div>
                                {{-- Details Bottom Ad--}}
                                @if(isMobile())
                                    @include('frontend.bn.mobile-ads.details.details-bottom-ad')
                                @else
                                    @include('frontend.bn.ads.details.details-bottom-ad')
                                @endif

                                <div class="row FlexRow">


                                    <!--- -->

                                </div>

                            </div>
                        </div>
                    @endif
                <!-- ================= Releted Post ================= -->
                @endif

            @endforeach
        <!-- ============== End Second Post Details =========== -->

            {{-- Details Bottom Ad--}}
{{--            @if(isMobile())--}}
{{--                @include('frontend.bn.mobile-ads.details.details-bottom-ad')--}}
{{--            @else--}}
{{--                @include('frontend.bn.ads.details.details-bottom-ad')--}}
{{--            @endif--}}
        {{-- Details Bottom Ad--}}

            <!--- Social Media Link --->
            <div class="postDetail_social">
                <hr class="hr-postdesc-social">
                <h3>অনুসরণ করুন</h3>
                <div class="social-links_items">
                    <a target="_blank" href="https://www.facebook.com/dhakaprokash24">
                        <svg xmlns="http://www.w3.org/2000/svg" height="28" width="28" viewBox="0 0 32 32" enable-background="new 0 0 32 32" xml:space="preserve">
                    <path fill="#1877F2" d="M16,0L16,0c8.837,0,16,7.163,16,16l0,0c0,8.837-7.163,16-16,16l0,0C7.163,32,0,24.837,0,16l0,0 C0,7.163,7.163,0,16,0z"></path>
                            <path fill="#FFFFFF" d="M18,17.5h2.5l1-4H18v-2c0-1.03,0-2,2-2h1.5V6.14C21.174,6.097,19.943,6,18.643,6C15.928,6,14,7.657,14,10.7 v2.8h-3v4h3V26h4V17.5z"></path>
                </svg>
                    </a>
                    <a target="_blank" href="https://www.instagram.com/dhakaprokash24/">
                        <svg height="28" width="28" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" enable-background="new 0 0 32 32" xml:space="preserve">
                    <radialGradient id="SVGID_1_" cx="-246.536" cy="264.8975" r="1" gradientTransform="matrix(1.941947e-15 -31.7144 -29.4969 -1.806164e-15 7822.1538 -7784.2769)" gradientUnits="userSpaceOnUse">
                        <stop offset="0" style="stop-color: rgb(255, 221, 85);"></stop>
                        <stop offset="0.1" style="stop-color: rgb(255, 221, 85);"></stop>
                        <stop offset="0.5" style="stop-color: rgb(255, 84, 62);"></stop>
                        <stop offset="1" style="stop-color: rgb(200, 55, 171);"></stop>
                    </radialGradient>
                            <circle fill="url(#SVGID_1_)" cx="16" cy="16" r="16"></circle>
                            <radialGradient id="SVGID_2_" cx="-219.16" cy="276.2076" r="1" gradientTransform="matrix(2.7825 13.9007 57.2992 -11.4697 -15222.0215 6216.8076)" gradientUnits="userSpaceOnUse">
                                <stop offset="0" style="stop-color: rgb(55, 113, 200);"></stop>
                                <stop offset="0.128" style="stop-color: rgb(55, 113, 200);"></stop>
                                <stop offset="1" style="stop-color: rgb(102, 0, 255); stop-opacity: 0;"></stop>
                            </radialGradient>
                            <circle fill="url(#SVGID_2_)" cx="16" cy="16" r="16"></circle>
                            <path
                                fill="#FFFFFF"
                                d="M16.001,6c-2.716,0-3.057,0.012-4.123,0.06c-1.065,0.049-1.791,0.217-2.427,0.465 C8.793,6.78,8.235,7.122,7.679,7.678C7.123,8.234,6.781,8.792,6.525,9.449c-0.248,0.636-0.417,1.363-0.465,2.427 C6.012,12.943,6,13.284,6,16s0.012,3.056,0.06,4.122c0.049,1.065,0.217,1.791,0.465,2.427c0.256,0.658,0.597,1.216,1.153,1.771 c0.556,0.556,1.114,0.899,1.771,1.154c0.636,0.247,1.363,0.416,2.428,0.465C12.943,25.988,13.284,26,16,26 c2.716,0,3.056-0.012,4.123-0.06c1.065-0.049,1.792-0.217,2.428-0.465c0.657-0.255,1.215-0.598,1.77-1.154 c0.556-0.556,0.898-1.114,1.154-1.771c0.246-0.636,0.415-1.363,0.465-2.427C25.987,19.056,26,18.716,26,16s-0.012-3.057-0.06-4.123 c-0.05-1.065-0.219-1.791-0.465-2.427c-0.256-0.658-0.598-1.216-1.154-1.771c-0.556-0.556-1.113-0.898-1.771-1.153 c-0.638-0.247-1.365-0.416-2.429-0.465C19.054,6.012,18.714,6,15.998,6H16.001z M15.104,7.802c0.266,0,0.563,0,0.897,0 c2.67,0,2.987,0.01,4.041,0.057c0.975,0.045,1.504,0.207,1.857,0.344c0.467,0.181,0.799,0.398,1.149,0.748 c0.35,0.35,0.567,0.683,0.748,1.15c0.137,0.352,0.3,0.881,0.344,1.856c0.048,1.054,0.058,1.371,0.058,4.04 c0,2.669-0.01,2.985-0.058,4.04c-0.045,0.975-0.208,1.504-0.344,1.856c-0.181,0.467-0.398,0.799-0.748,1.149 c-0.35,0.35-0.682,0.567-1.149,0.748c-0.352,0.138-0.882,0.3-1.857,0.345c-1.054,0.048-1.371,0.058-4.041,0.058 c-2.67,0-2.987-0.01-4.041-0.058c-0.975-0.045-1.504-0.208-1.857-0.345c-0.467-0.181-0.8-0.398-1.15-0.748 c-0.35-0.35-0.567-0.683-0.748-1.149c-0.137-0.352-0.3-0.881-0.344-1.856c-0.048-1.054-0.058-1.371-0.058-4.041 s0.01-2.985,0.058-4.04c0.045-0.975,0.207-1.504,0.344-1.857c0.181-0.467,0.398-0.8,0.748-1.15c0.35-0.35,0.683-0.567,1.15-0.748 c0.352-0.137,0.882-0.3,1.857-0.345c0.922-0.042,1.28-0.054,3.144-0.056V7.802z M21.339,9.462c-0.662,0-1.2,0.537-1.2,1.2 c0,0.663,0.538,1.2,1.2,1.2c0.663,0,1.2-0.537,1.2-1.2C22.539,10,22.001,9.462,21.339,9.462L21.339,9.462z M16.001,10.865 c-2.836,0-5.135,2.299-5.135,5.135s2.299,5.134,5.135,5.134c2.836,0,5.135-2.298,5.135-5.134S18.837,10.865,16.001,10.865 L16.001,10.865z M16.001,12.667c1.841,0,3.333,1.492,3.333,3.333c0,1.841-1.493,3.333-3.333,3.333c-1.841,0-3.333-1.493-3.333-3.333 C12.667,14.159,14.16,12.667,16.001,12.667L16.001,12.667z"
                            ></path>
                </svg>
                    </a>
                    <a target="_blank" href="https://twitter.com/dhakaprokash24">
{{--                        <svg xmlns="http://www.w3.org/2000/svg" height="28" width="28" viewBox="0 0 32 32" enable-background="new 0 0 32 32" xml:space="preserve">--}}
{{--                    <path fill="#1DA1F2" d="M16,0L16,0c8.837,0,16,7.163,16,16l0,0c0,8.837-7.163,16-16,16l0,0C7.163,32,0,24.837,0,16l0,0 C0,7.163,7.163,0,16,0z"></path>--}}
{{--                            <path--}}
{{--                                fill="#FFFFFF"--}}
{{--                                d="M26.162,9.656c-0.764,0.338-1.573,0.56-2.402,0.658C24.634,9.791,25.288,8.969,25.6,8 c-0.82,0.488-1.719,0.83-2.656,1.015c-0.629-0.673-1.464-1.12-2.373-1.27c-0.909-0.15-1.843,0.004-2.656,0.439 c-0.813,0.435-1.459,1.126-1.838,1.966c-0.379,0.84-0.47,1.782-0.259,2.679c-1.663-0.083-3.29-0.516-4.775-1.268 c-1.485-0.753-2.795-1.81-3.845-3.102c-0.372,0.638-0.567,1.364-0.566,2.103c0,1.45,0.738,2.731,1.86,3.481 c-0.664-0.021-1.313-0.2-1.894-0.523v0.052c0,0.966,0.334,1.902,0.946,2.649c0.611,0.747,1.463,1.26,2.409,1.452 c-0.616,0.167-1.263,0.192-1.89,0.072c0.267,0.831,0.787,1.558,1.488,2.079c0.701,0.521,1.547,0.81,2.419,0.826 c-0.868,0.681-1.861,1.185-2.923,1.482c-1.062,0.297-2.173,0.382-3.268,0.25c1.912,1.229,4.137,1.882,6.41,1.88 c7.693,0,11.9-6.373,11.9-11.9c0-0.18-0.005-0.362-0.013-0.54c0.819-0.592,1.526-1.325,2.087-2.165L26.162,9.656z"--}}
{{--                            ></path>--}}
{{--                </svg>--}}
                        <svg height="28" width="28" viewBox="0 0 24 24" aria-hidden="true" class="r-k200y r-18jsvk2 r-4qtqp9 r-yyyyoo r-5sfk15 r-dnmrzs r-kzbkwu r-bnwqim r-1plcrui r-lrvibr"><g><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></g></svg>
                    </a>

                    <a target="_blank" href="https://www.youtube.com/c/DhakaProkash">
                        <svg xmlns="http://www.w3.org/2000/svg" height="28" width="28" viewBox="0 0 32 32" enable-background="new 0 0 32 32" xml:space="preserve">
                    <path fill="#FF0000" d="M16,0L16,0c8.837,0,16,7.163,16,16l0,0c0,8.837-7.163,16-16,16l0,0C7.163,32,0,24.837,0,16l0,0 C0,7.163,7.163,0,16,0z"></path>
                            <path
                                fill="#FFFFFF"
                                d="M25.543,10.498C26,12.28,26,16,26,16s0,3.72-0.457,5.502c-0.254,0.985-0.997,1.76-1.938,2.022 C21.896,24,16,24,16,24s-5.893,0-7.605-0.476c-0.945-0.266-1.687-1.04-1.938-2.022C6,19.72,6,16,6,16s0-3.72,0.457-5.502 c0.254-0.985,0.997-1.76,1.938-2.022C10.107,8,16,8,16,8s5.896,0,7.605,0.476C24.55,8.742,25.292,9.516,25.543,10.498L25.543,10.498 z M14,19.5l6-3.5l-6-3.5V19.5z"
                            ></path>
                </svg>
                    </a>
                </div>
                <hr class="hr-postdesc-social">
            </div>
            <!-- End Social Media Link -->
        </div>
    </div>
    <div id="fullpage" onclick="hideGetPic()"></div>
@endsection

@section('custom-js')
    <script>
        $(function() {
            $(window).on("scroll", function() {
                var Wscroll = $(this).scrollTop() + 200;
                $('.single_news').each(function(){
                    var ThisOffset = $(this).offset();
                    //   alert(ThisOffset);
                    if(Wscroll > ThisOffset.top &&  Wscroll < (ThisOffset.top + $(this).outerHeight(true)) ){

                        if(localStorage.getItem("LOL") != $(this).attr('data-nid')){
                            localStorage.setItem("LOL", $(this).attr('data-nid'));

                            var metaHref = metaHref = $(this).attr('data-href'),
                                metaTitle = $(this).attr('data-title'),
                                metaDescription = $(this).attr('data-description'),
                                metaImage_src = $(this).attr('data-image_src'),
                                metaNid = $(this).attr('data-nid');
                                // metaKeywords = $(this).attr('data-keywords');
                            // console.log($(this).attr('data-nid'));
                            ga("set", "page", metaHref);
                            ga("send", "pageview");
                            ga("send", "event", "Scroll Pageview", metaHref);

                            $('title').text(metaTitle);
                            $('meta[property="og:title"]').attr('content', metaTitle);
                            $('meta[property="og:description"]').attr('content', metaDescription);
                            $('meta[property="og:image"]').attr('content', metaImage_src);
                            // $('meta[property="og:image:alt"]').attr('content', metaTitle);
                            $('meta[property="og:url"]').attr('content', metaHref);
                            $('meta[name="description"]').attr('content', metaDescription);
                            // $('link[rel="image_src"]').attr('href', metaImage_src);
                            $('link[rel="canonical"]').attr('href', metaHref);
                            // $('link[rel="amphtml"]').attr('href', metaAmpHref);
                            // $('meta[name="keywords"]').attr('content', metaKeywords);
                            //
                            $('meta[name="twitter:description"]').attr('content', metaDescription);
                            $('meta[name="twitter:title"]').attr('content', metaTitle);
                            $('meta[name="twitter:image"]').attr('content', metaImage_src);

                            // const buttons = document.querySelector('.sharethis-inline-share-buttons')
                            // buttons.setAttribute('data-url', metaHref)
                            // buttons.setAttribute('data-title', `Check out this picture by ${uploaded_by}`)
                            //$.post('https://www.khaborerkagoj.com/home/hitcount/'+metaNid);

                            //$('meta[name="publish-date"]').attr('content', 'publish-date');
                            history.pushState('', metaTitle, metaHref);
                            //window.history.pushState('', metaNid, $(this).attr('data-href'));
                        }

                        // $('.news-loading-6').css('display','none');
                    }
                });
            });
        });
    </script>
    <!-- Inside Detail Ads -->
    @include('frontend.bn.ads.details.inside-details-ad')
    <!-- Inside Detail Ads -->
{{--    @include('frontend.bn.layouts.inside-loop-details-news')--}}

    @include('frontend.bn.layouts.inside-details-news')

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61a4980f05d9f37d"></script>
    <script src="{{ asset('frontend-assets/common/js/jquery.imageview.js') }}"></script>
    <script>
        $('#imageview').imageview();
    </script>

    <script>
        function moreShareFunction(){
            var x = document.getElementById("moreShare");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
        function closeShareBox(){
            var x = document.getElementById("moreShare");
            x.style.display = "none";
        }
        function copyLink(){
            var link = document.getElementById('copyLink').value
            navigator.clipboard.writeText(link)
        }
        // Specific Content Print
        function printPageArea(areaID){
            var printContent = document.getElementById(areaID).innerHTML;
            printContent  += "</br></br></br><hr><div><img style='margin-bottom: 20px; margin-top: 10px' src='http://127.0.0.1:8000/media/common/logo1672518180.png' alt='dfd' /></br><h3 style='margin: 0;  padding: 0'>যোগাযোগ: +৮৮০ ৯৬১ ৩৩৩ ১০১০</h3></br><h3 style='margin: 0;  padding: 0'>ইমেইল: info@dhakaprokash24.com</h3></br><h3 style='margin: 0; padding: 0'>ঠিকানা: ৯৩, কাজী নজরুল ইসলাম এভিনিউ, (ষষ্ঠ তলা) </br>কারওয়ান বাজার, ঢাকা-১২১৫।</h3></div>";
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }

        // Image Full Screen
        function getPic(src){s
            const fullPage = document.querySelector('#fullpage');
            fullPage.style.backgroundImage = 'url(' + src + ')';
            // fullPage.style.display = 'block';
            fullPage.style.width = "100%";
            fullPage.style.cursor = "zoom-out"
            const body = document.querySelector('body')
            body.style.overflow = 'hidden'
            // const content = document.querySelector('.main-content')
            // $(content).hide()
            // content.style.display = 'none'
            $(fullPage).fadeIn('show')
        }

        function hideGetPic(){
            const fullPage = document.querySelector('#fullpage');
            // fullPage.style.display = 'none';
            $(fullPage).fadeOut('show')
            // const content = document.querySelector('.main-content')
            // content.style.display = 'block';
            const body = document.querySelector('body')
            body.style.overflow = ''
        }
        // document.querySelectorAll('.firstDescription p').onclick = function(){
        //     prompt('Hello world');
        // }

        // First Detail Images Full Screen
        const detailImageFirst = document.querySelectorAll('.description p img')
        detailImageFirst.forEach(fimg => {
            fimg.addEventListener('click', () => {
                const fullPage = document.querySelector('#fullpage');
                fullPage.style.backgroundImage = 'url(' + fimg.src + ')';
                // fullPage.style.display = 'block';
                fullPage.style.width = "100%";
                fullPage.style.cursor = "zoom-out"
                const body = document.querySelector('body')
                body.style.overflow = 'hidden'
                // const content = document.querySelector('.main-content')
                // $(content).hide()
                // content.style.display = 'none'
                    $(fullPage).fadeIn('show')
            })
        })

        // Figure Image
        const detailFigureFirst = document.querySelectorAll('.firstDescription figure img')
        detailFigureFirst.forEach(ffigure => {
            ffigure.addEventListener('click', () => {
                const fullPage = document.querySelector('#fullpage');
                fullPage.style.backgroundImage = 'url(' + ffigure.src + ')';
                // fullPage.style.display = 'block';
                fullPage.style.width = "100%";
                fullPage.style.cursor = "zoom-out"
                const body = document.querySelector('body')
                body.style.overflow = 'hidden'
                // const content = document.querySelector('.main-content')
                // $(content).hide()
                // content.style.display = 'none'
                $(fullPage).fadeIn('show')
            })
        })
        // First Detail Images Full Screen

        // Loop Detail Images Full Screen
            for (let loopD = 0; loopD < 2; loopD++){
                const detailImageFirst = document.querySelectorAll('.loopDescription'+loopD+' p img')
                detailImageFirst.forEach(fimg => {
                    fimg.addEventListener('click', () => {
                        const fullPage = document.querySelector('#fullpage');
                        fullPage.style.backgroundImage = 'url(' + fimg.src + ')';
                        // fullPage.style.display = 'block';
                        fullPage.style.width = "100%";
                        fullPage.style.cursor = "zoom-out"
                        const body = document.querySelector('body')
                        body.style.overflow = 'hidden'
                        // const content = document.querySelector('.main-content')
                        // $(content).hide()
                        // content.style.display = 'none'
                        $(fullPage).fadeIn('show')
                    })
                })

                // Figure Image
                const detailFigureFirst = document.querySelectorAll('.loopDescription'+loopD+' figure img')
                detailFigureFirst.forEach(ffigure => {
                    ffigure.addEventListener('click', () => {
                        const fullPage = document.querySelector('#fullpage');
                        fullPage.style.backgroundImage = 'url(' + ffigure.src + ')';
                        // fullPage.style.display = 'block';
                        fullPage.style.width = "100%";
                        fullPage.style.cursor = "zoom-out"
                        const body = document.querySelector('body')
                        body.style.overflow = 'hidden'
                        // const content = document.querySelector('.main-content')
                        // $(content).hide()
                        // content.style.display = 'none'
                        $(fullPage).fadeIn('show')
                    })
                })
            }
        // Loop Detail Images Full Screen

    </script>


@endsection
