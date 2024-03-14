@extends('frontend.en.app')

@section('title', $detailsContent->content_heading)

@php
    $sURL = fEnURL($detailsContent->content_id, $detailsContent->category->cat_slug, ($detailsContent->subcategory ? $detailsContent->subcategory->subcat_slug : null), $detailsContent->content_type);
    $ogImage = url('share-image/'.$detailsContent->category->cat_slug).'?t='.date('Ymdhi').'&imgPath='.$detailsContent->img_bg_path;
    /*$ogImage = asset(config('appconfig.contentImagePath').$detailsContent->img_bg_path);*/
@endphp

@section('customMeta')
    <!--<meta content="300" http-equiv="refresh">-->
    <meta name="description" content="{{ !empty($detailsContent->meta_details) ? $detailsContent->meta_details : fGetWord(fFormatString($detailsContent->content_brief),20) }}"/>
    <link rel="canonical" href="{{$sURL}}">

    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{ $sURL }}"/>
    <meta property="og:title" content="{{ $detailsContent->content_heading }}"/>
    <meta property="og:image" content="{{ $ogImage }}"/>
    <meta name="keywords" content="{{ $detailsContent->meta_keywords }}">
    <meta property="og:description" content="{{ !empty($detailsContent->meta_details) ? $detailsContent->meta_details : fGetWord(fFormatString($detailsContent->content_brief),20) }}"/>
    <meta property="article:author" content="{{url('/')}}"/>

    <meta name="twitter:title" content="{{ $detailsContent->content_heading }}">
    <meta name="twitter:description" content="{{ !empty($detailsContent->meta_details) ? $detailsContent->meta_details : fGetWord(fFormatString($detailsContent->content_brief),20) }}">
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
			"url": "{{!empty($author) ? fEnRoot('author/'.$author->author_slug): fEnRoot()}}",
			"name": "{{!empty($author) ? $author->author_name : 'Dhaka Prokash'}}"
		},
		"publisher": {
			"@type": "Organization",
			"name": "{{fEnRoot()}}",
			"logo": {
				"@type": "ImageObject",
				"url": "{{ asset(config('appconfig.commonImagePath').Cache::get('enSiteSettings')->logo) }}"
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
					"@id":"{{fEnRoot()}}",
					"name":"Home"
				}
			},
			{
				"@type":"ListItem",
				"position":2,
				"item":{
					"@id":"{{url($detailsContent->category->cat_slug)}}",
					"name":"{{$detailsContent->category->cat_name}}"
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
            src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0&appId={{config('appconfig.fb_app_id')}}&autoLogAppEvents=1"></script>
@endsection

@section('custom-css')
    <style>
        @media print {
            a[href]:after {
                display: none !important;
                visibility: hidden;
            }
            #veta-version, #back_to_top{display: none !important}
        }
    </style>
@endsection

@section('mainContent')

    <div class="main-content marginTop10">
        <div class="container">
            <!-- Top Section -->
            <p class="breadcrumb marginBottom0">
                <a href="{{ fEnRoot() }}"><i class="fa fa-home"></i></a>
                <span>&raquo;</span>
                <a href="{{ fEnRoot($detailsContent->category->cat_slug) }}" class="active color-text">{{ $detailsContent->category->cat_name }}</a>
            </p>

            {{-- Details Top Ad--}}
            @if(isMobile())
                @include('frontend.bn.mobile-ads.details.details-top-ad')
            @else
                @include('frontend.bn.ads.details.details-top-ad')
            @endif

            <div class="row marginBottom20">
                <div class="col-sm-9">
                    <div class="news-details">
                        <h1 class="headline-font">{{ $detailsContent->content_heading }}</h1>

                        <div class="marginTop10">
                            <div class="row d-flex align-items-center m-d-flex-none">
                                <div class="col-md-6">
                                    <div class="author-image d-flex align-items-center details-font">
                                        @if(!empty($author) && !empty($author->img_path))
                                            <img src="{{asset(config('appconfig.authorImagePath').$author->img_path)}}" alt="{{$author->author_name}}">
                                        @else
                                            <img src="{{asset(config('appconfig.commonImagePath').'favicon.png')}}" alt="Dhaka Prokash">
                                        @endif
                                        <a href="{{!empty($author) ? fEnRoot('author/'.$author->author_slug): '#'}}" style="font-size: 20px">{{!empty($author) ? $author->author_name : 'Dhaka Prokash'}}</a>
                                    </div>
                                    <p class="news-time details-font" style="margin: 5px 0; font-size: 15px">
                                        <i class="fa fa-clock-o"></i> {{ date('d F Y, h:i a', strtotime($detailsContent->created_at)) }}
                                        {{ $detailsContent->updated_at ? '| Updated: ' . date('d F Y, h:i a', strtotime($detailsContent->updated_at)) : '' }}
                                    </p>
                                </div>
                                <div class="col-md-6 text-right m-text-left d-print-none">
                                    <div class="row m-justify-content-start">
                                        <div class="col-sm-6 col-xs-12" style="margin-bottom: 5px">
                                            @include('frontend.en.partials.social-icons-details-page')
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="addthis_inline_share_toolbox"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr style="margin: 0 0 12px 0">

                        <div class="imgbox">

                            @if($detailsContent->video_id)
                                @if($detailsContent->video_type == 1)
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <figure class="content-media content-media--video" id="featured-media">
                                            <iframe src="https://www.youtube.com/embed/{{ $detailsContent->video_id }}?enablejsapi=1&rel=1&showinfo=1&controls=1" frameborder="0" allowfullscreen></iframe>
                                        </figure>
                                    </div>
                                @elseif($detailsContent->video_type == 2)
                                    <div class="fb-video" data-href="https://www.facebook.com/watch/?v={{$detailsContent->video_id}}" data-width="auto" data-autoplay="false" data-show-captions="false"> </div>
                                    {{--<div class="fb-video" data-href="https://www.facebook.com/{{ $detailsContent->video_id }}" data-autoplay="false" data-show-text="false" data-show-captions="false" data-allowfullscreen="true"></div>--}}
                                @endif

                            @else
                                <img src="{{ $detailsContent->img_bg_path ? asset(config('appconfig.contentImagePath').$detailsContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}" class="img-responsive" alt="{{ $detailsContent->content_heading }}" title="{{ $detailsContent->content_heading }}">
                            @endif
                        </div>

                        @if($detailsContent->img_bg_caption)
                            <div class="caption details-font">
                                {{ $detailsContent->img_bg_caption }}
                            </div>
                        @endif

                        @if(!empty($detailsContent->podcast_id))
                            <iframe style="margin: 15px 0 0" src="https://widget.spreaker.com/player?episode_id={{$detailsContent->podcast_id}}&theme=light&playlist=false&playlist-continuous=false&chapters-image=true&episode_image_position=right&hide-logo=false&hide-likes=false&hide-comments=false&hide-sharing=false&hide-download=true" width="100%" height="200px" frameborder="0"></iframe>
                        @endif

                        <div class="description details-font">{!! $detailsContent->content_details !!}</div>
                    </div>

                    <div class="d-print-none">
                        <hr>
                        <div class="gist details-font" style="color: black">
                            <p>Category :
                                <a href="{{ fEnRoot($detailsContent->category->cat_slug) }}"> {{ $detailsContent->category->cat_name }}</a>
                            </p>

                            @if($detailsContent->tags)
                                @php($tags = explode(',', $detailsContent->tags))
                                <p>Topic :
                                    @foreach($tags as $tag)
                                        <a href="{{ fEnRoot('topic/'.$tag) }}" class="bg-info" style="padding: 2px 5px; border-radius: 2px;">{{ $tag }}</a>
                                        @if(!$loop->last), @endif
                                    @endforeach
                                </p>
                            @endif
                        </div>
                        <hr>
                    </div>

                    <div class="d-print-none" style="padding: .5rem 0">
                        <div class="fb-comments" data-href="{{$sURL}}" data-width="100%"
                             data-numposts="5"></div>
                    </div>

                    {{-- Details after ad--}}
                    @include('frontend.en.ads.details.details-after-ad')

                </div>
                <div class="col-sm-3 d-print-none">

                    {{-- Details right one ad --}}
                    @include('frontend.en.ads.details.details-right-one-ad')

                    <div>
                        <div class="common-title common-title-brown mb-4">
                            <span class="common-title-shape">
                                <span class="common-title-link">More News </span>
                            </span>
                        </div>
                        <div class="cat-box-with-media default-height">

                            @foreach($moreContents as $content)

                                @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                <div class="media">
                                    <a href="{{ $sURL }}">
                                        <div class="media-left">
                                            <div class="imgbox">
                                                <img src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}" class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p class="headline-font" style="font-size: 17px">
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
                                            </p>
                                        </div>
                                    </a>
                                </div>

                            @endforeach

                        </div>
                    </div>

                    {{-- Details right two ad--}}
                    @include('frontend.en.ads.details.details-right-two-ad')

                    {{-- Details right three ad--}}
                    @include('frontend.en.ads.details.details-right-three-ad')

                </div>
            </div>

            @if($relatedContents)
                <div class="row related-news d-print-none">
                    <div class="col-sm-12">
                        <div class="common-title common-title-brown mb-4">
                            <span class="common-title-shape">
                                <a class="common-title-link" href="#">Read More</a>
                            </span>
                        </div>
                        <div class="row FlexRow">

                            @foreach($relatedContents as $content)

                                @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                <div class="col-sm-3 col-xs-6 marginBottom10">
                                    <div class="single_related">
                                        <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                            <div class="imgbox">
                                                <img src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">

                                            </div>
                                            <h4 class="headline-font">
                                                {{ $content->content_heading }}
                                            </h4>
                                        </a>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>
                </div>
            @endif

            {{-- Details Bottom Ad--}}
            @include('frontend.en.ads.details.details-bottom-ad')

        </div>
    </div>

@endsection

@section('custom-js')
    @include('frontend.en.ads.details.inside-details-ad')

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61a4980f05d9f37d"></script>
@endsection
