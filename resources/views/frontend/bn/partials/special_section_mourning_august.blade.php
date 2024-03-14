<div class="special-section" style="padding-top: 0;">
    <div class="container">
        <div class="special-box special-event-section">
            <a href="https://www.dhakaprokash24.com/topic/একুশে-আগস্ট-গ্রেনেড-হামলা">
                <div class="special-event-title marginTop20">
                    <div class="desktop-image">
                        <img src="{{ asset('media/common/21-august-grenade-attack.jpg') }}" alt="শোকাবহ আগস্ট">
                    </div>
                    <div class="mobile-image">
                        <img src="{{ asset('media/common/21-august-grenade-attack.jpg') }}" alt="শোকাবহ আগস্ট">
                    </div>
                </div>
            </a>
            @if($specialArrangementContents)
                <div class="row marginTop20">
                    <div class="col-sm-3 two">
                        @foreach($specialArrangementContents->take(4) as $content)
                            @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                            <div class="single_sub other-content">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                        <img
                                            src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                            class="img-responsive" alt="{{ $content->content_heading }}"
                                            title="{{ $content->content_heading }}">
                                    </a>
                                </div>
                                <h4 class="other-content-title">
                                    <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                        {{ $content->content_heading }}
                                    </a>
                                </h4>
                            </div>
                            @if($loop->iteration == 2)
                    </div>
                    <div class="col-md-6 one">
                        <div class="special-top-video-section">
                            @if($bnSpecialEventVideos->count())
                                @php($spEventFirstVideo = $bnSpecialEventVideos->shift())
                                @if($spEventFirstVideo->is_live == 1)
                                    @if($spEventFirstVideo->type == 1)
                                        <iframe width="780" height="352"
                                                src="https://www.youtube.com/embed/{{ $spEventFirstVideo->code }}?enablejsapi=1&autoplay=1&mute=1&rel=0&showinfo=1&controls=1&loop=1&playlist={{$spEventFirstVideo->code}}"
                                                frameborder="0" allowfullscreen></iframe>
                                    @elseif($spEventFirstVideo->type == 2)
                                        <div class="fb-video"
                                             data-href="https://www.facebook.com/watch/?v={{$spEventFirstVideo->code}}"
                                             data-width="auto" data-autoplay="true" data-show-captions="false"></div>
                                    @endif
                                    <div class="august-video-title">
                                        <h4 style="margin-bottom: 10px; line-height: 1.2; font-size: 22px; margin-left: 5px; color: white">
                                            {{ $spEventFirstVideo->title }}
                                        </h4>
                                    </div>
                                @else
                                    @php($videoUrl = $spEventFirstVideo->target == 2 && $spEventFirstVideo->type == 1 ? ('https://www.youtube.com/watch?v='.$spEventFirstVideo->code) : ($spEventFirstVideo->target == 2 && $spEventFirstVideo->type == 2 ? ('https://www.facebook.com/dhakaprokash24/videos/'.$spEventFirstVideo->code) : fVideoURL($spEventFirstVideo->id, $spEventFirstVideo->category->slug)))
                                    <a style="margin-bottom: 20px; cursor: pointer" href="{{$videoUrl}}" target="_blank"
                                       rel="nofollow">
                                        <img
                                            src="{{ asset(config('appconfig.videoImagePath').$spEventFirstVideo->img_bg_path) }}"
                                            alt="{{ $spEventFirstVideo->title }}" style="width: 100%"/>
                                        <div class="august-video-title">
                                            <i class="fa fa-play"></i>
                                            <h4>{{ $spEventFirstVideo->title }}</h4>
                                        </div>
                                    </a>
                                @endif
                            @endif
                        </div>

                        <div class="row">
                            @foreach($bnSpecialEventVideos->take(2) as $video)
                                @php($videoUrl = $video->target == 2 && $video->type == 1 ? ('https://www.youtube.com/watch?v='.$video->code) : ($video->target == 2 && $video->type == 2 ? ('https://www.facebook.com/dhakaprokash24/videos/'.$video->code) : fVideoURL($video->id, $video->category->slug)))
                                <div class="col-sm-12 {{ $loop->iteration == 2 ? 'marginTop5' : null }}" style="margin-bottom: {{ $loop->iteration == 2 ? '5' : null }}px">
                                    <div class="august-media">
                                        <div class="august-media-content">
                                            <div class="august-media-left">
                                                <div class="special-video-icon">
                                                    <i class="fa fa-play-circle"></i>
                                                </div>
                                            </div>
                                            <div class="august-media-body">
                                                <h4 class="august-media-heading">
                                                    <a href="{{ $videoUrl }}" target="_blank" rel="nofollow">
                                                        {{ $video->title }}
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="col-sm-3 three">
                        @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>

    .special-video-icon .fa {
        background-color: #3e3e3e!important;
        font-size: 38px!important;
        color: red!important;
        /*text-shadow: 1px 1px 6px gray;*/
    }

    .special-section {
        position: relative;
        background-color: #333;
        border-bottom: 2px solid #D00303;
    }

    .special-section .container {
        margin-bottom: 15px !important;
    }

    .special-box hr {
        width: 100%;
        height: 4px;
        background: #942824;
        margin-top: 0px !important;
        margin-bottom: 5px !important;
    }

    .mobile-image {
        display: none;
    }

    .other-content-title {
        line-height: 1.2;
        font-size: 20px;
        margin-left: 7px;
        margin-right: 7px;
        padding-bottom: 22px;
        padding-top: 3px;
    }

    .other-content-title a {
        color: white!important;
    }

    .other-content-title a:hover {
        color: red!important;
    }

    .custom-border-bottom {
        position: relative;
    }

    .custom-border-bottom:after {
        position: absolute;
        content: '';
        border-bottom: 1px solid #979f9f;
        width: 100%;
        transform: translateX(-50%);
        bottom: -11px;
        left: 50%;
    }

    .one {
        position: relative;
    }

    /*.one:after {*/
    /*    position: absolute;*/
    /*    content: "";*/
    /*    border-left: 1px #6c757d solid;*/
    /*    top: 1%;*/
    /*    right: 0;*/
    /*    height: 95%;*/
    /*    margin-top: auto;*/
    /*    margin-bottom: auto;*/
    /*}*/

    /*.one:before {*/
    /*    position: absolute;*/
    /*    content: "";*/
    /*    border-right: 1px #6c757d solid;*/
    /*    top: 1%;*/
    /*    left: 0;*/
    /*    height: 95%;*/
    /*    margin-top: auto;*/
    /*    margin-bottom: auto;*/
    /*}*/

    .august-media {
        background-color: #3e3e3e;
    }

    .august-media-content {
        display: flex!important;
        align-items: center!important;
        padding: 4px 5px;
    }

    .august-media-heading {
        margin-left: 15px;
        font-size: 19px!important;
    }

    .august-media-heading a {
        color: white!important;
    }

    .august-media:hover .special-video-icon .fa {
        background-color: #3e3e3e!important;
        color: white!important;
        text-shadow: 0px 0px 0px gray;
    }

    .august-media:hover .august-media-heading a {
        color: red!important;
    }

    .august-video-title {
        margin-top: -6px;
        background-color: #061e33;
        border: 1px solid #061e33;
        margin-bottom: 5px;
        color: white;
    }

    .august-video-title > .fa-play {
        position: absolute;
        top: 40%;
        left: 50%;
        height: 50px;
        width: 50px;
        background: rgba(0,0,0,.14);
        transform: translate(-50%,-50%);
        text-align: center;
        line-height: 38px;
        color: #fff;
        border-radius: 50%;
        padding-left: 4px;
        border: 5px solid #fff;
        -webkit-box-shadow: 0 0 30px 2px grey;
        -moz-box-shadow: 0 0 30px 2px gray;
        box-shadow: 0 0 30px 2px grey;
        opacity: .8;
        font-size: 20px;
    }

    .august-video-title h4 {
        margin-bottom: 10px;
        line-height: 1.2;
        font-size: 25px;
        margin-left: 5px;
    }

    .other-content {
        margin-bottom: 25px!important;
        background-color: #3e3e3e!important;
    }

    .special-top-video-section:hover .august-video-title h4{
        color: yellow;
    }

    @media (max-width: 768px) {
        .special-event-section .row {
            display: flex;
            flex-direction: column;
        }

        .one:after {
            border: none!important;
        }

        .one:before {
            border: none!important;
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

    @media (max-width: 500px) {
        .mobile-image {
            display: block;
        }

        .desktop-image {
            display: none;
        }
    }
</style>
