@extends('frontend.photo.app')

@section('title', '')

@section('customMeta')
    <meta property="og:url" content="/photo"/>
    {{--<meta property="og:site_name" content="{{ config('app.url') }}"/>
    <meta property="og:title" content="{{ Cache::get('bnSiteSettings')->title }}"/>
    <meta property="og:image" content="{{ asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->og_image) }}"/>
    <meta name="keywords" content="{{ Cache::get('bnSiteSettings')->meta_keyword }}">
    <meta property="og:description" content="{{ Cache::get('bnSiteSettings')->meta_description }}"/>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@dhakaprokash24">
    <meta name="twitter:title" content="{{ Cache::get('bnSiteSettings')->title }}">
    <meta name="twitter:description" content="{{ Cache::get('bnSiteSettings')->meta_description }}">
    <meta name="twitter:image" content="{{ asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->og_image) }}">
    <meta name="description" content="{{ Cache::get('bnSiteSettings')->meta_description }}"/>--}}

    <link rel="canonical" href="{{url('/photo')}}">
    <link rel="stylesheet"
          href="{{ asset(config('appconfig.frontendAssetPath').'frontend-assets/plugins/lightgallery/css/lightgallery.min.css') }}">
@endsection

@section('custom-css')
    <style>
        #stickyTopMenu {
            z-index: 1000;
        }

        /*.photo-gallery-top-item {*/
        /*    border: 1px solid #f1f1f1;*/
        /*    box-shadow: 0 0 5px 2px #f1f1f1;*/
        /*}*/
        .photo-gallery-top-item {
            margin-bottom: 10px;
        }

        .photo-gallery-top-item h2 {
            margin: 5px 0;
            padding: 5px;
            font-size: 22px;
            color: #000000;
            line-height: 1.4;
        }

        .photo-gallery-top-item:hover h2, .photo-gallery-top-item:hover a {
            color: red;
            text-decoration: none;
        }

        .single-block .img-box {
            overflow: hidden;
        }

        .single-block .photo-hover-adv {
            -webkit-transition: all 0.7s;
            -moz-transition: all 0.7s;
            -ms-transition: all 0.7s;
            -o-transition: all 0.7s;
            transition: all 0.7s;
            position: absolute;
            bottom: -100%;
            right: 5px;
        }

        .single-block:hover .photo-hover-adv {
            bottom: 5px;
        }

        .single-block {
            background: #efefef;
            margin: 0 0 21px;
        }

        .single-block .icon-box {
            position: absolute;
            top: 0;
            padding: 10px 15px;
            background: #95959591;
        }

        .single-block p {
            font-size: 19px;
            line-height: 1.6;
            padding: 8px 15px;
        }

        .img-responsive {
            width: 100%;
        }

        .icon-box .fa {
            color: #ffffff;
        }

        .single-block {
            overflow: hidden;
        }

        .single-block img {
            transition: transform .5s ease;
        }

        .single-block:hover img {
            transform: scale(1.1);
            cursor: zoom-in;
        }

        .single-block:hover .icon-box {
            background: red;
        }

        .bread_album_name {
            color: #6c6b6b;
        }
        
        .cat-box-with-media .media {
            margin-top: 7px!important;
        }

        .aside img {
            margin-bottom: 7px!important;
        }
    </style>
@endsection

@section('mainContent')
    <div class="main-content">
        <div class="container">
            <p class="breadcrumb marginBottom10 marginTop10">
                <a href="{{ url('/') }}"><i class="fa fa-home"></i></a>
                <span>&raquo;</span>
                <a href="{{ url('/photo') }}">ফটো গ্যালারি</a>
                <span>&raquo;</span>
                <a href="{{ url('/photo/' . $detailAlbum->category->cat_slug) }}" class="active">{{ $detailAlbum->category->cat_name_bn }}</a>
                <span>&raquo;</span>
{{--                <a href="{{ url('/photo/category/subcategory') }}" class="active">Subcategory</a>--}}
                <span class="bread_album_name"><b>{{ $detailAlbum->album_name }}</b></span>
            </p>

            <div class="marginBottom20">
                <section class="box-white photo">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-8 main-content photo-print-block">
                                <div class="row">
                                    <div class="col-sm-12 photo-title">
                                        <h1>{{ $detailAlbum->album_name }}</h1>

                                        <hr>

                                         <div class="marginTop10">
                                            <div class="row d-flex align-items-center m-d-flex-none">
                                                <div class="col-md-8">
                                                    <p class="news-time" style="margin-bottom: 0">
                                                        <i class="fa fa-clock-o"></i> {{ fFormatDateEn2Bn(date('d F Y, h:i a', strtotime($detailAlbum->created_at))) }}
                                                        {{ $detailAlbum->updated_at ? '| আপডেট: ' . fFormatDateEn2Bn(date('d F Y, h:i a', strtotime($detailAlbum->updated_at))) : '' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-4 text-right m-text-left d-print-none">
                                                    <div class="addthis_inline_share_toolbox"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <blockquote>{{ $detailAlbum->short_description }}</blockquote>

                                        <hr>

                                    </div>
                                    <div class="demo-gallery">
                                        <ul id="lightgallery" class="list-unstyled">
                                            @php($photos = $detailAlbum->album_details)
                                            @foreach($photos as $photo)
                                            <li class="col-sm-12"
                                                data-responsive="{{ asset(config('appconfig.photoAlbumImagePath'). ($photo['img'] ?? 'photo_album_placeholder_image.png')) }}"
                                                data-src="{{ asset(config('appconfig.photoAlbumImagePath'). ($photo['img'] ?? 'photo_album_placeholder_image.png')) }}"
                                                data-sub-html="{{ $photo['caption'] }}">
                                                <div class="single-block auto">
                                                    <div class="img-box">
                                                        <img
                                                            src="{{ asset(config('appconfig.photoAlbumImagePath') . 'photo_album_placeholder_image.png') }}"
                                                            data-src="{{ asset(config('appconfig.photoAlbumImagePath'). ($photo['img'] ?? 'photo_album_placeholder_image.png')) }}"
                                                            alt="{{ $photo['caption'] }}"
                                                            class="lazyload img-responsive">
                                                        <div class="icon-box">
                                                            <i class="fa fa-expand" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                    <p>{{ $photo['caption'] }}</p>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <aside class="col-sm-4 aside hidden-print">
                                <div>
                                    <div class="common-title common-title-brown mb-4">
                                        <span class="common-title-shape">
                                            <span class="common-title-link">আরও </span>
                                        </span>
                                    </div>
                                    <div class="cat-box-with-media default-height">
                                        @foreach($moreAlbums as $album)
                                            @php($albumURL = fAlbumURL($album->album_id, $album->category->cat_slug))
                                            <div class="media">
                                                <div class="media-left">
                                                    <div class="imgbox">
                                                        <a href="{{ $albumURL }}">
                                                            <img
                                                                src="{{ asset(config('appconfig.photoAlbumImagePath'). ($album->feature_image['img'] ?? 'photo_album_placeholder_image.png')) }}"
                                                                class="lazyload img-responsive"
                                                                alt="{{ $album->album_name }}"
                                                                title="{{ $album->album_name }}">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        <a href="{{ $albumURL }}">{{ $album->album_name }}</a>
                                                    </h4>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script
        src="{{ asset(config('appconfig.frontendAssetPath').'frontend-assets/plugins/lightgallery/js/lightgallery.min.js') }}"></script>
    <script
        src="{{ asset(config('appconfig.frontendAssetPath').'frontend-assets/plugins/lightgallery/js/lg-thumbnail.min.js') }}"></script>
    <script
        src="{{ asset(config('appconfig.frontendAssetPath').'frontend-assets/plugins/lightgallery/js/lg-video.min.js') }}"></script>
    <script
        src="{{ asset(config('appconfig.frontendAssetPath').'frontend-assets/plugins/lightgallery/js/lg-autoplay.min.js') }}"></script>
    <script
        src="{{ asset(config('appconfig.frontendAssetPath').'frontend-assets/plugins/lightgallery/js/lg-hash.min.js') }}"></script>
    <script
        src="{{ asset(config('appconfig.frontendAssetPath').'frontend-assets/plugins/lightgallery/js/lg-pager.min.js') }}"></script>
    <script
        src="{{ asset(config('appconfig.frontendAssetPath').'frontend-assets/plugins/lightgallery/js/jquery.mousewheel.min.js') }}"></script>
    <script>
        $('#lightgallery').lightGallery({mode: 'lg-fade', cssEasing: 'cubic-bezier(0.25, 0, 0.25, 1)'});
    </script>

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61a4980f05d9f37d"></script>
@endsection
