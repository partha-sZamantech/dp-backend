@extends('frontend.bn.app')

@section('title', $video->title)

@php
    $ogImg = $video->img_bg_path;
    $ogImage = url('share-image/'.$video->category->slug).'?t='.date('Ymdhi').'&imgPath='.$ogImg.'&type=video';
    $sURL = fVideoURL($video->id, optional($video->category)->slug)
@endphp

@section('customMeta')
    <meta name="description" content="{{ $video->meta_description ?? $video->title }}"/>
    <link rel="canonical" href="{{$sURL}}">

    <meta property="og:type" content="video"/>
    <meta property="og:url" content="{{ $sURL }}"/>
    <meta property="og:title" content="{{ $video->title }}"/>
    <meta property="og:image" content="{{ $ogImage }}"/>
    <meta property="og:description" content="{{ $video->meta_description ?? $video->title }}"/>
    <meta property="og:video" content="{{ $video->type == 1 ? 'https://www.youtube.com/embed/' . $video->code :  'https://www.facebook.com/watch/?v='. $video->code}}" />

    <meta name="twitter:title" content="{{ $video->title }}">
    <meta name="twitter:description" content="{{ $video->meta_description ?? $video->title }}">
    <meta name="twitter:image" content="{{ $ogImage }}">
@endsection

@section('fb-sdk')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
            src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0&appId={{config('appconfig.fb_app_id')}}&autoLogAppEvents=1"></script>
@endsection

@section('mainContent')
    <div class="main-content">
        <div class="container marginTop10">
            <!-- Top Section -->
            <p class="breadcrumb marginBottom0">
                <a href="{{ route('video') }}"><i class="fa fa-home"></i></a>
                <span>&raquo;</span>
                <a href="{{ route('video.category',$video->category->slug) }}" class="active">{{ $video->category->name_bn }}</a>
            </p>

            <div class="row marginBottom20">
                <div class="col-sm-9">
                    <div class="news-details marginTop20">
                        <div class="imgbox">
                            @if($video->code)
                                @if($video->type == 1)
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <figure class="content-media content-media--video" id="featured-media">
                                            <iframe src="https://www.youtube.com/embed/{{ $video->code }}?rel=0&enablejsapi=1&autoplay=1&mute=1&showinfo=1&controls=1" frameborder="0" allowfullscreen></iframe>
                                        </figure>
                                    </div>
                                @elseif($video->type == 2)
                                    <div class="fb-video" data-href="https://www.facebook.com/watch/?v={{$video->code}}" data-width="auto" data-autoplay="true" data-show-captions="false"> </div>
                                @endif
                            @endif
                        </div>

                        <h1 class="marginTop10">{{ $video->title }}</h1>

                        <div class="marginTop10">
                            <div class="row d-flex align-items-center m-d-flex-none">
                                <div class="col-md-7">
                                    <p class="news-time" style="margin: 5px 0">
                                        <i class="fa fa-clock-o"></i> {{ fFormatDateEn2Bn(date('d F Y, h:i a', strtotime($video->created_at))) }}
                                        {{ $video->updated_at ? '| আপডেট: ' . fFormatDateEn2Bn(date('d F Y, h:i a', strtotime($video->updated_at))) : '' }}
                                    </p>
                                </div>
                                <div class="col-md-5 text-right m-text-left d-print-none">
                                    <div style="display: flex; align-items: center; justify-content: end" class="m-justify-content-start">
                                        <iframe src="https://www.facebook.com/plugins/share_button.php?href={{$sURL}}&layout=button_count&size=large&width=105&height=28&appId" width="105" height="28" style="width: 105px; border: none; overflow: hidden; margin-bottom: 5px;" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                                        <div class="addthis_inline_share_toolbox"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-print-none" style="padding: .5rem 0">
                        <div class="fb-comments" data-href="{{$sURL}}" data-width="100%"
                             data-numposts="5"></div>
                    </div>
                </div>

                <div class="col-sm-3 d-print-none">

                    {{-- Details right one ad --}}
                    @include('frontend.bn.ads.details.details-right-one-ad')

                    <div>
                        <div class="common-title common-title-brown mb-4">
                            <span class="common-title-shape">
                                <span class="common-title-link">আরও ভিডিও</span>
                            </span>
                        </div>

                        @if($bnVideos->count())
                            <div class="special-top-video-box marginTop20">
                                @foreach($bnVideos as $bnVideo)
                                    @php($videoUrl = $bnVideo->target == 2 && $bnVideo->type == 1 ? ('https://www.youtube.com/watch?v='.$bnVideo->code) : ($bnVideo->target == 2 && $bnVideo->type == 2 ? ('https://www.facebook.com/dhakaprokash24/videos/'.$bnVideo->code) : fVideoURL($bnVideo->id, $bnVideo->category->slug)))
                                    <div class="media">
                                        <div class="media-left">
                                            <div class="video-icon">
                                                <i class="fa fa-play"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="{{ $videoUrl }}" target="{{ $bnVideo->target == 2 ? '_blank' : '' }}" style="font-size: 20px">
                                                    {{ $bnVideo->title }}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="marginTop20">
                        <div class="common-title common-title-brown mb-4">
                            <span class="common-title-shape">
                                <span class="common-title-link">আরও</span>
                            </span>
                        </div>

                        <div class="cat-box-with-media default-height">

                            @foreach($latestContents as $content)

                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                <div class="media">
                                    <div class="media-left">
                                        <div class="imgbox">
                                            <a href="{{ $sURL }}">
                                                <img src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}" class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
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
                </div>
            </div>

        </div>
    </div>

@endsection

@section('custom-js')
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61a4980f05d9f37d"></script>
@endsection
