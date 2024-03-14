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

@endsection

@section('custom-css')
    <style>
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

        /*Photo Gallery*/
        .gallery-title {
            border-bottom: 3px solid #fff;
        }

        .gallery-title:hover {
            border-bottom: 3px solid #942824;
        }

        .gallery-title a {
            color: #fff;
            text-decoration: none;
        }

        .gallery-title a:hover {
            color: red;
            text-decoration: none;
        }

        .gallery-title h2 {
            margin-top: 0px !important;
        }

        .gallery-container {
            background-color: #00427A;
            color: #35373a;
            /*padding: 20px 50px;*/
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .gallery {
            padding-right: 7px;
            padding-left: 7px;
            padding-top: 20px;
            padding-bottom: 0px;
        }

        /* Override bootstrap column paddings */
        .gallery .row > div {
            padding: 5px;
        }

        .gallery .image-box img {
            width: 100%;
            border-radius: 0;
        }

        .image-box {
            display: block;
            width: 100%;
            height: 100%;
            position: relative;
            border: 1px solid #f5f3f3;
        }

        .overlay {
            display: block;
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 60%, rgba(0, 0, 0, 0.8) 70%, rgba(0, 0, 0, 1) 100%);
            opacity: 0.9;
            top: 0;
        }

        .img-title {
            position: absolute;
            bottom: 1%;
            color: white;
            margin-left: 5%;
            margin-right: 5%;
            font-size: 30px;
        }

        .img-title-small {
            position: absolute;
            bottom: 1%;
            color: white;
            margin-left: 5%;
            margin-right: 5%;
            font-size: 19px;
        }

        .image-icon {
            position: absolute;
            height: 30px;
            display: flex;
            width: 30px;
            background-color: #DE1818;
            border-radius: 15px;
            justify-content: center;
            align-items: center;
            left: 5px;
            top: 5px;
        }

        .image-icon i {
            color: #fff;
        }

        .image-box:hover .img-title {
            color: red;
        }

        .image-box:hover .img-title-small {
            color: red;
        }

        .image-box:hover .overlay {
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 60%, rgba(255, 255, 255, 0.7) 70%, rgba(255, 255, 255, 1) 100%);
        }

        .photo-gallery-top-item h2 {
            font-size: 20px !important;
            line-height: 1.2 !important;
        }

        .lead_description {
            background-color: #f0efef;
        }

        .lead_description p {
            font-size: 18px;
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        @media (max-width: 768px) {
            .gallery {
                padding: 10px;
            }

            .photo-gallery-items .row {
                display: flex;
                flex-direction: column;
            }

            .one {
                order: 1;
            }

            .two {
                order: 2;
            }

            .three {
                order: 3;
            }
        }

        @media (max-width: 960px) {
            .img-title {
                font-size: 20px !important;
            }

            .img-title-small {
                font-size: 20px !important;
            }
        }
    </style>
@endsection

@section('mainContent')
    <div class="main-content">
        <div class="container">
            <p class="breadcrumb marginBottom10 marginTop10">
                <a href="{{ url('/') }}"><i class="fa fa-home"></i></a>
                <span>&raquo;</span>
                <a href="{{ url('/photo') }}" class="active">ফটো গ্যালারি</a>
            </p>
        </div>

        {{--Photo Gallery--}}
        @include('frontend.bn.partials.photo_gallery')
        
        <div class="container">
            <div class="row marginBottom20 marginTop20">
                <div class="col-sm-12">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/photo/bangladesh') }}">বাংলাদেশ</a>
                        </span>
                    </div>
                </div>
                @if($bangladeshAlbums)
                    @php
                        $leadBangladeshAlbum = $bangladeshAlbums->shift();
                        $leadBangladeshAlbumURL = fAlbumURL($leadBangladeshAlbum->album_id, $leadBangladeshAlbum->category->cat_slug);
                    @endphp
                    <div class="photo-gallery-items">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3 two">
                                    @foreach($bangladeshAlbums as $album)
                                        @php($albumURL = fAlbumURL($album->album_id, $album->category->cat_slug))
                                        @if($loop->iteration > 4)
                                            <div class="col-sm-3">
                                        @endif

                                        <div class="photo-gallery-top-item">
                                            <a class="image-box" href="{{ $albumURL }}">
                                                <img
                                                    src="{{ asset(config('appconfig.photoAlbumImagePath'). ($album->feature_image['img'] ?? 'photo_album_placeholder_image.png')) }}"
                                                    alt="{{ $album->album_name }}"
                                                    class="img-responsive">
                                                <span class="image-icon"><i class="fa fa-image"></i></span>
                                            </a>
                                            <a href="{{ $albumURL }}">
                                                <h2>{{ $album->album_name }}</h2>
                                            </a>
                                        </div>

                                        @if($loop->iteration > 4)
                                            </div>
                                        @endif

                                        @if($loop->iteration == 2)
                                            </div>

                                            <div class="col-sm-6 one" style="border-left: 1px solid #cecece; border-right: 1px solid #cecece;">
                                                <a class="image-box" href="{{ $leadBangladeshAlbumURL }}">
                                                    <img
                                                        src="{{ asset(config('appconfig.photoAlbumImagePath'). ($leadBangladeshAlbum->feature_image['img'] ?? 'photo_album_placeholder_image.png')) }}"
                                                        alt="{{ $leadBangladeshAlbum->album_name }}" class="img-responsive">
                                                    <div class="overlay">
                                                        <b><p class="img-title">{{ $leadBangladeshAlbum->album_name }}</p></b>
                                                    </div>
                                                    <span class="image-icon"><i class="fa fa-image"></i></span>
                                                </a>
                                                <div class="marginTop10 lead_description">
                                                    <p>{{ fGetWord($leadBangladeshAlbum->short_description, 20) }}</p>
                                                </div>
                                            </div>

                                            <div class="col-sm-3 three">
                                        @endif

                                    @if($loop->iteration == 4)
                                        </div>
                                    </div>
                                    <div class="row marginTop10">
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row marginBottom20">
                <div class="col-sm-12">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/photo/entertainment') }}">বিনোদন</a>
                        </span>
                    </div>
                </div>

                @if($entertainmentAlbums)
                    <div class="photo-gallery-items">
                        <div class="col-sm-12">
                            <div class="row">
                                @foreach($entertainmentAlbums as $album)
                                    @php($albumURL = fAlbumURL($album->album_id, $album->category->cat_slug))
                                    @if($loop->iteration <= 2)
                                        <div class="col-sm-6">
                                    @else
                                        <div class="col-sm-3">
                                    @endif
                                        <div class="photo-gallery-top-item">
                                            <a class="image-box" href="{{ $albumURL }}">
                                                <img src="{{ asset(config('appconfig.photoAlbumImagePath'). ($album->feature_image['img'] ?? 'photo_album_placeholder_image.png')) }}"
                                                     alt="{{ $album->album_name }}" class="img-responsive">
                                                <span class="image-icon"><i class="fa fa-image"></i></span>
                                            </a>
                                            <a href="{{ $albumURL }}">
                                                <h2>{{ $album->album_name }}</h2>
                                            </a>
                                        </div>
                                    </div>
                                    @if($loop->iteration == 2)
                                        </div>
                                        <div class="row">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row marginBottom20">
                <div class="col-sm-12">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/photo/sports') }}">খেলা</a>
                        </span>
                    </div>
                </div>
                @if($sportsAlbums)
                    <div class="photo-gallery-items">
                        <div class="col-sm-12">
                            <div class="row">
                                @foreach($sportsAlbums as $album)
                                    @php($albumURL = fAlbumURL($album->album_id, $album->category->cat_slug))
                                    <div class="col-sm-3 photo-gallery-top-item">
                                        <a class="image-box" href="{{ $albumURL }}">
                                            <img src="{{ asset(config('appconfig.photoAlbumImagePath'). ($album->feature_image['img'] ?? 'photo_album_placeholder_image.png')) }}"
                                                alt="{{ $album->album_name }}" class="img-responsive">
                                            <span class="image-icon"><i class="fa fa-image"></i></span>
                                        </a>
                                        <a href="{{ $albumURL }}">
                                            <h2>{{ $album->album_name }}</h2>
                                        </a>
                                    </div>
                                    @if($loop->iteration == 4)
                                        </div>
                                        <div class="row">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row marginBottom20">
                <div class="col-sm-12">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/photo/lifestyle') }}">লাইফস্টাইল</a>
                        </span>
                    </div>
                </div>
                @if($lifestyleAlbums)
                    @php($leadLifestyleAlbum = $lifestyleAlbums->shift())
                    @php($leadLifestyleAlbumURL = fAlbumURL($leadLifestyleAlbum->album_id, $leadLifestyleAlbum->category->cat_slug))

                    <div class="photo-gallery-items">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3 two">
                                    @foreach($lifestyleAlbums as $album)
                                        @php($albumURL = fAlbumURL($album->album_id, $album->category->cat_slug))
                                        @if($loop->iteration > 4)
                                            <div class="col-sm-3">
                                                @endif

                                                <div class="photo-gallery-top-item">
                                                    <a class="image-box" href="{{ $albumURL }}">
                                                        <img
                                                            src="{{ asset(config('appconfig.photoAlbumImagePath'). ($album->feature_image['img'] ?? 'photo_album_placeholder_image.png')) }}"
                                                            alt="{{ $album->album_name }}"
                                                            class="img-responsive">
                                                        <span class="image-icon"><i class="fa fa-image"></i></span>
                                                    </a>
                                                    <a href="{{ $albumURL }}">
                                                        <h2>{{ $album->album_name }}</h2>
                                                    </a>
                                                </div>

                                                @if($loop->iteration > 4)
                                            </div>
                                        @endif

                                        @if($loop->iteration == 2)
                                </div>

                                <div class="col-sm-6 one" style="border-left: 1px solid #cecece; border-right: 1px solid #cecece;">
                                    <a class="image-box" href="{{ $leadLifestyleAlbumURL }}">
                                        <img
                                            src="{{ asset(config('appconfig.photoAlbumImagePath'). ($album->feature_image['img'] ?? 'photo_album_placeholder_image.png')) }}"
                                            alt="{{ $leadLifestyleAlbum->album_name }}" class="img-responsive">
                                        <div class="overlay">
                                            <b><p class="img-title">{{ $leadLifestyleAlbum->album_name }}</p></b>
                                        </div>
                                        <span class="image-icon"><i class="fa fa-image"></i></span>
                                    </a>
                                    <div class="marginTop10 lead_description">
                                        <p>{{ substr($leadLifestyleAlbum->short_description, 0, 200) . '...' }}</p>
                                    </div>
                                </div>

                                <div class="col-sm-3 three">
                                    @endif

                                    @if($loop->iteration == 4)
                                </div>
                            </div>
                            <div class="row marginTop10">
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row marginBottom20">
                <div class="col-sm-12">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/photo/international') }}">আন্তর্জাতিক</a>
                        </span>
                    </div>
                </div>

                @if($internationalAlbums)
                    <div class="photo-gallery-items">
                        <div class="col-sm-12">
                            <div class="row">
                                @foreach($internationalAlbums as $album)
                                    @php($albumURL = fAlbumURL($album->album_id, $album->category->cat_slug))
                                    @if($loop->iteration <= 2)
                                        <div class="col-sm-6">
                                    @else
                                        <div class="col-sm-3">
                                    @endif
                                        <div class="photo-gallery-top-item">
                                            <a class="image-box" href="{{ $albumURL }}">
                                                <img src="{{ asset(config('appconfig.photoAlbumImagePath'). ($album->feature_image['img'] ?? 'photo_album_placeholder_image.png')) }}"
                                                     alt="{{ $album->album_name }}" class="img-responsive">
                                                <span class="image-icon"><i class="fa fa-image"></i></span>
                                            </a>
                                            <a href="{{ $albumURL }}">
                                                <h2>{{ $album->album_name }}</h2>
                                            </a>
                                        </div>
                                    </div>
                                    @if($loop->iteration == 2)
                                        </div>
                                        <div class="row">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row marginBottom20">
                <div class="col-sm-12">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/photo/science-and-technology') }}">বিজ্ঞান ও প্রযুক্তি</a>
                        </span>
                    </div>
                </div>

                @if($technologyAlbums)
                    @php($leadTechnologyAlbum = $technologyAlbums->shift())
                    @php($leadTechnologyAlbumURL = fAlbumURL($leadTechnologyAlbum->album_id, $leadTechnologyAlbum->category->cat_slug))
                    <div class="photo-gallery-items">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3 two">
                                    @foreach($technologyAlbums as $album)
                                        @php($albumURL = fAlbumURL($album->album_id, $album->category->cat_slug))
                                        @if($loop->iteration > 4)
                                            <div class="col-sm-3">
                                                @endif

                                                <div class="photo-gallery-top-item">
                                                    <a class="image-box" href="{{ $albumURL }}">
                                                        <img
                                                            src="{{ asset(config('appconfig.photoAlbumImagePath'). ($album->feature_image['img'] ?? 'photo_album_placeholder_image.png')) }}"
                                                            alt="{{ $album->album_name }}"
                                                            class="img-responsive">
                                                        <span class="image-icon"><i class="fa fa-image"></i></span>
                                                    </a>
                                                    <a href="{{ $albumURL }}">
                                                        <h2>{{ $album->album_name }}</h2>
                                                    </a>
                                                </div>

                                                @if($loop->iteration > 4)
                                            </div>
                                        @endif

                                        @if($loop->iteration == 2)
                                </div>

                                <div class="col-sm-6 one" style="border-left: 1px solid #cecece; border-right: 1px solid #cecece;">
                                    <a class="image-box" href="{{ $leadTechnologyAlbumURL }}">
                                        <img
                                            src="{{ asset(config('appconfig.photoAlbumImagePath'). ($leadTechnologyAlbum->feature_image['img'] ?? 'photo_album_placeholder_image.png')) }}"
                                            alt="{{ $leadTechnologyAlbum->album_name }}" class="img-responsive">
                                        <div class="overlay">
                                            <b><p class="img-title">{{ $leadTechnologyAlbum->album_name }}</p></b>
                                        </div>
                                        <span class="image-icon"><i class="fa fa-image"></i></span>
                                    </a>
                                    <div class="marginTop10 lead_description">
                                        <p>{{ substr($leadTechnologyAlbum->short_description, 0, 200) . '...' }}</p>
                                    </div>
                                </div>

                                <div class="col-sm-3 three">
                                    @endif

                                    @if($loop->iteration == 4)
                                </div>
                            </div>
                            <div class="row marginTop10">
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row marginBottom20">
                <div class="col-sm-12">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/photo/travel') }}">ভ্রমণ</a>
                        </span>
                    </div>
                </div>

                @if($travelAlbums)
                    <div class="photo-gallery-items">
                        <div class="col-sm-12">
                            <div class="row">
                                @foreach($travelAlbums as $album)
                                    @php($albumURL = fAlbumURL($album->album_id, $album->category->cat_slug))
                                    @if($loop->iteration <= 2)
                                        <div class="col-sm-6">
                                    @else
                                        <div class="col-sm-3">
                                    @endif
                                        <div class="photo-gallery-top-item">
                                            <a class="image-box" href="{{ $albumURL }}">
                                                <img src="{{ asset(config('appconfig.photoAlbumImagePath'). ($album->feature_image['img'] ?? 'photo_album_placeholder_image.png')) }}"
                                                     alt="{{ $album->album_name }}" class="img-responsive">
                                                <span class="image-icon"><i class="fa fa-image"></i></span>
                                            </a>
                                            <a href="{{ $albumURL }}">
                                                <h2>{{ $album->album_name }}</h2>
                                            </a>
                                        </div>
                                    </div>
                                    @if($loop->iteration == 2)
                                        </div>
                                        <div class="row">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row marginBottom20">
                <div class="col-sm-12">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ url('/photo/others') }}">বিবিধ</a>
                        </span>
                    </div>
                </div>

                @if($otherAlbums)
                    <div class="photo-gallery-items">
                        <div class="col-sm-12">
                            <div class="row">
                                @foreach($otherAlbums as $album)
                                    @php($albumURL = fAlbumURL($album->album_id, $album->category->cat_slug))
                                    <div class="col-sm-3 photo-gallery-top-item">
                                        <a class="image-box" href="{{ $albumURL }}">
                                            <img src="{{ asset(config('appconfig.photoAlbumImagePath'). ($album->feature_image['img'] ?? 'photo_album_placeholder_image.png')) }}"
                                                 alt="{{ $album->album_name }}" class="img-responsive">
                                            <span class="image-icon"><i class="fa fa-image"></i></span>
                                        </a>
                                        <a href="{{ $albumURL }}">
                                            <h2>{{ $album->album_name }}</h2>
                                        </a>
                                    </div>
                                    @if($loop->iteration == 4)
                                        </div>
                                        <div class="row">
                                   @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
@section('custom-js')
@endsection
