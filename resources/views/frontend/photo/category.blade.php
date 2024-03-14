@extends('frontend.photo.app')

@section('title', cache('bnSiteSettings')->title)

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

    <style>
        /*.photo-gallery-top-item {*/
        /*    border: 1px solid #f1f1f1;*/
        /*    box-shadow: 0 0 5px 2px #f1f1f1;*/
        /*}*/
        .photo-gallery-top-item {
            margin-bottom: 10px;
        }
        
        .photo-gallery-top-item img{
            border: 1px solid #f1f1f1;
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

        .category_album_cover {
            transition: transform 0.2s ease-in-out;
        }

        .category_album_cover:hover {
            transform: scale(1.1);
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
                <a href="{{ url('/photo/' . $category->cat_slug) }}" class="active">{{ $category->cat_name_bn }}</a>
            </p>

            <div class="row marginBottom20">
                <div class="col-sm-12">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/photo/' . $category->cat_slug) }}">{{ $category->cat_name_bn }}</a>
                        </span>
                    </div>
                </div>

                <div class="photo-gallery-items">
                    <div class="col-sm-12">
                        <div class="row">
                            @foreach($categoryAlbums as $album)
                                @php($albumURL = fAlbumURL($album->album_id, $album->category->cat_slug))
                                <div class="col-sm-3 photo-gallery-top-item">
                                    <a href="{{ $albumURL }}">
                                        <img src="{{ asset(config('appconfig.photoAlbumImagePath'). ($album->feature_image['img'] ?? 'photo_album_placeholder_image.png')) }}"
                                             alt="{{ $album->album_name }}" class="img-responsive category_album_cover">
                                    </a>
                                    <a href="{{ $albumURL }}">
                                        <h2>{{ $album->album_name }}</h2>
                                    </a>
                                </div>
                                @if($loop->iteration % 4 == 0)
                                    </div>
                                    <div class="row">
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <hr>

                    {{ $categoryAlbums->links('vendor.pagination.bn-default') }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
@endsection
