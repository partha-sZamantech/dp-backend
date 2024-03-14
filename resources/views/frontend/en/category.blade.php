@extends('frontend.en.app')

@section('title', $category->cat_name . ' । Dhaka Prokash')

@section('customMeta')
    <!--<meta content="300" http-equiv="refresh">-->
    <link rel="canonical" href="{{fEnRoot($category->cat_slug)}}">
    <meta name="description" content="{{!empty($category->cat_meta_description) ? $category->cat_meta_description : ''}}">

    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{fEnRoot($category->cat_slug)}}"/>
    <meta property="og:title" content="{{$category->cat_name. ' । Dhaka Prokash'}}"/>
    <meta property="og:image" content="{{ asset(config('appconfig.commonImagePath').Cache::get('enSiteSettings')->og_image) }}"/>
    <meta property="og:description" content="{{!empty($category->cat_meta_description) ? $category->cat_meta_description : ''}}"/>

    <meta name="twitter:title" content="{{$category->cat_name. ' । Dhaka Prokash'}}">
    <meta name="twitter:description" content="{{!empty($category->cat_meta_description) ? $category->cat_meta_description : ''}}">
    <meta name="twitter:image" content="{{ asset(config('appconfig.commonImagePath').Cache::get('enSiteSettings')->og_image) }}">
@endsection

@section('mainContent')
    <div class="main-content marginTop10">
        <div class="container">
            <!-- Top Section -->
            <p class="breadcrumb marginBottom0">
                <a href="{{ fEnRoot() }}"><i class="fa fa-home"></i></a>
                <span>&raquo;</span>
                <a href="{{ fEnRoot($category->cat_slug) }}" class="active color-text">{{ $category->cat_name }}</a>
            </p>

            {{-- Category after breadcrumb ad--}}
            @include('frontend.bn.ads.category.category-top-ad')

            <div class="row marginBottom20 marginTop20">
                <div class="col-sm-9">
                    <div class="cat-lead-box">
                        @if($contents->count())
                            @php($topCatContent = $contents->shift())
                            @php($sURL = fEnURL($topCatContent->content_id, $topCatContent->category->cat_slug, ($topCatContent->subcategory->subcat_slug ?? null), $topCatContent->content_type))
                            <div class="row">
                                <a href="{{ $sURL }}">
                                    <div class="col-sm-6">
                                        <div class="imgbox">
                                            <img src="{{ $topCatContent->img_bg_path ? asset(config('appconfig.contentImagePath').$topCatContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"  class="img-responsive" alt="{{ $topCatContent->content_heading }}" title="{{ $topCatContent->content_heading }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h3 class="headline-font">
                                            @if(!empty($topCatContent->video_id) || !empty($topCatContent->podcast_id))
                                                <span class="video-audio-icon">
                                                @if(!empty($topCatContent->video_id))
                                                        <i class="fa fa-play"></i>
                                                    @endif
                                                    @if(!empty($topCatContent->podcast_id))
                                                        <i class="fa fa-volume-up"></i>
                                                    @endif
                                                </span>
                                            @endif
                                            @if($topCatContent->content_sub_heading)
                                                {{--                                                        <b class="sub-heading">{{ $topCatContent->content_sub_heading }}</b>--}}
                                                <span class="color-text">{{ $topCatContent->content_sub_heading }}</span> /
                                            @endif
                                            {{ $topCatContent->content_heading }}
                                        </h3>
                                        <p class="hidden-xs details-font">{{ fGetWord(fFormatString($topCatContent->content_details), 60) }}</p>
                                    </div>
                                </a>
                            </div>

                            <div class="cat-box-with-media default-height">
                                <div class="row">
                                    @if($contents)
                                        @foreach($contents as $content)
                                            @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                            <div class="col-sm-6">
                                                <div class="media">
                                                    <a href="{{ $sURL }}">
                                                        <div class="media-left">
                                                            <div class="imgbox">
                                                                <img src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"  class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h4 class=" headline-font ">
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
                                                            </h4>
                                                            <p>
                                                                <small class="text-muted details-font">
                                                                    <i class="fa fa-calendar"></i>
                                                                    {{ date('d F Y, h:i a', strtotime($content->created_at)) }}
                                                                </small>
                                                            </p>

                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endif
                        <hr>

                        {{ $contents->links('vendor.pagination.en-default') }}

                    </div>


                    {{-- Category Bottom Ad--}}
                    @include('frontend.en.ads.category.category-bottom-ad')

                </div>
                <div class="col-sm-3">
                    {{-- Category Right One Ad--}}
                    @include('frontend.en.ads.category.category-right-one-ad')

                    <div>
                        @if($otherCatContents->count())
                            <div class="common-title common-title-brown mb-4">
                                <span class="common-title-shape">
                                    <a class="common-title-link" href="{{ fEnRoot($otherCatContents->first()->category->cat_slug) }}">{{ $otherCatContents->first()->category->cat_name }}</a>
                                </span>
                            </div>
                            <div class="cat-box-with-media default-height">
                                @foreach($otherCatContents as $content)

                                    @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                                    <div class="media">
                                        <a href="{{ $sURL }}">
                                            <div class="media-left">
                                                <div class="imgbox">
                                                    <img src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}"  class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <p class="headline-font" style="font-size: 17px">
                                                    @if($content->content_sub_heading)
                                                        {{--                                                        <b class="sub-heading">{{ $intTopContent->content_sub_heading }}</b>--}}
                                                        <span class="red-text">{{ $content->content_sub_heading }}</span> /
                                                    @endif
                                                    {{ $content->content_heading }}
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Category Right Two Ad--}}
                    @include('frontend.en.ads.category.category-right-two-ad')
                </div>
            </div>
        </div>
    </div>
@endsection
