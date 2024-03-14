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
    </style>
@endsection

@section('mainContent')
    <div class="main-content">
        <div class="container">
            <p class="breadcrumb marginBottom10">
                <a href="{{ url('/') }}"><i class="fa fa-home"></i></a>
                <span>&raquo;</span>
                <a href="{{ url('/photo') }}">Photo</a>
                <span>&raquo;</span>
                <a href="{{ url('/photo/category') }}" class="active">Category</a>
                <span>&raquo;</span>
                <a href="{{ url('/photo/category/subcategory') }}" class="active">Subcategory</a>
            </p>

            <div class="marginBottom20">
                <div class="photo-gallery-items">
                    <div class="col-sm-3 photo-gallery-top-item">
                        <a href="#">
                            <img src="https://cdn.jagonews24.com/media/PhotoAlbumNew/BG/2019November/daily-pic-0-20211108181253.jpg"
                                 alt="" class="img-responsive">
                        </a>
                        <a href="#">
                            <h2>এক ঝলক ( ০৮ নভেম্বর, ২০২১)</h2>
                        </a>
                    </div>

                    <div class="col-sm-3 photo-gallery-top-item">
                        <a href="#">
                            <img src="https://cdn.jagonews24.com/media/PhotoAlbumNew/BG/2019November/daily-pic-0-20211108181253.jpg"
                                 alt="" class="img-responsive">
                        </a>
                        <a href="#">
                            <h2>এক ঝলক ( ০৮ নভেম্বর, ২০২১)</h2>
                        </a>
                    </div>

                    <div class="col-sm-3 photo-gallery-top-item">
                        <a href="#">
                            <img src="https://cdn.jagonews24.com/media/PhotoAlbumNew/BG/2019November/daily-pic-0-20211108181253.jpg"
                                 alt="" class="img-responsive">
                        </a>
                        <a href="#">
                            <h2>এক ঝলক ( ০৮ নভেম্বর, ২০২১)</h2>
                        </a>
                    </div>

                    <div class="col-sm-3 photo-gallery-top-item">
                        <a href="#">
                            <img src="https://cdn.jagonews24.com/media/PhotoAlbumNew/BG/2019November/daily-pic-0-20211108181253.jpg"
                                 alt="" class="img-responsive">
                        </a>
                        <a href="#">
                            <h2>এক ঝলক ( ০৮ নভেম্বর, ২০২১)</h2>
                        </a>
                    </div>

                    <div class="col-sm-3 photo-gallery-top-item">
                        <a href="#">
                            <img src="https://cdn.jagonews24.com/media/PhotoAlbumNew/BG/2019November/daily-pic-0-20211108181253.jpg"
                                 alt="" class="img-responsive">
                        </a>
                        <a href="#">
                            <h2>এক ঝলক ( ০৮ নভেম্বর, ২০২১)</h2>
                        </a>
                    </div>

                    <div class="col-sm-3 photo-gallery-top-item">
                        <a href="#">
                            <img src="https://cdn.jagonews24.com/media/PhotoAlbumNew/BG/2019November/daily-pic-0-20211108181253.jpg"
                                 alt="" class="img-responsive">
                        </a>
                        <a href="#">
                            <h2>এক ঝলক ( ০৮ নভেম্বর, ২০২১)</h2>
                        </a>
                    </div>
                    <div class="col-sm-3 photo-gallery-top-item">
                        <a href="#">
                            <img src="https://cdn.jagonews24.com/media/PhotoAlbumNew/BG/2019November/daily-pic-0-20211108181253.jpg"
                                 alt="" class="img-responsive">
                        </a>
                        <a href="#">
                            <h2>এক ঝলক ( ০৮ নভেম্বর, ২০২১)</h2>
                        </a>
                    </div>

                    <div class="col-sm-3 photo-gallery-top-item">
                        <a href="#">
                            <img src="https://cdn.jagonews24.com/media/PhotoAlbumNew/BG/2019November/daily-pic-0-20211108181253.jpg"
                                 alt="" class="img-responsive">
                        </a>
                        <a href="#">
                            <h2>এক ঝলক ( ০৮ নভেম্বর, ২০২১)</h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
@endsection
