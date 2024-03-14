@extends('frontend.bn.app')
@section('title', $tag->tag_name . ' । ঢাকা প্রকাশ')

@section('customMeta')
    <link rel="canonical" href="{{url('/topic/'.$tag->tag_slug)}}">
    <meta name="description" content="{{!empty($tag->description) ? $tag->description : ''}}">

    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{url('/topic/'.$tag->tag_slug)}}"/>
    <meta property="og:title" content="{{$tag->tag_name. ' । ঢাকা প্রকাশ'}}"/>
    <meta property="og:image" content="{{ asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->og_image) }}"/>
    <meta property="og:description" content="{{!empty($tag->description) ? $tag->description : ''}}"/>

    <meta name="twitter:title" content="{{$tag->tag_name. ' । ঢাকা প্রকাশ'}}">
    <meta name="twitter:description" content="{{!empty($tag->description) ? $tag->description : ''}}">
    <meta name="twitter:image" content="{{ asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->og_image) }}">
@endsection

@section('mainContent')

    <div class="main-content marginTop10">
        <div class="container">
            <!-- Top Section -->
            <p class="breadcrumb">
                <a href="/"><i class="fa fa-home"></i></a>
                <span>&raquo;</span>
                <a href="#">টপিক</a>
                <span>&raquo;</span>
                <a href="{{url('topic/'.$tag->tag_slug)}}" class="active">{{$tag->tag_name}}</a>
            </p>

            <div class="row marginBottom20">
                <div class="col-sm-12">
                    <div class="tag-box">
                        <p style="font-size: 32px">
                            <i class="fa fa-tag"></i><span style="margin-left: 10px">{{$tag->tag_name}}</span></p>
                    </div>

                    <hr>

                    <div class="tag-contents">
                        @foreach($contents as $content)

                            @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                            <div class="single-archive-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="imgbox">
                                            <a href="{{ $sURL }}">
                                                <img src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-sm-9">
                                        <small class="text-muted">
                                            <a href="{{ url($content->category->cat_slug) }}" class="jC_tag"> {{ $content->category->cat_name_bn }} </a>
                                            | <i class="fa fa-calendar"></i>
                                            {{ fFormatDateEn2Bn(date('d F Y, h:i a, l', strtotime($content->created_at))) }}
                                        </small>
                                        <h3><a href="{{ $sURL }}" title="{{ $content->content_heading }}">
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
                                            </a></h3>
                                        <p class="hidden-xs text-muted">{{ $content->content_brief }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <hr>
                        {{ $contents->links('vendor.pagination.bn-default') }}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
