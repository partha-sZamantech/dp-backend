@extends('frontend.bn.app')

@section('title', 'ভিডিও | ঢাকা প্রকাশ')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('frontend-assets/common/css/video-style.css') }}?id=7">
@endsection

@section('mainContent')
    <div class="main-content">
        <div class="container marginTop10">
            @include('frontend.video.bn.common.header')
        </div>

        @if($specialTopVideos)
            @if(Cache::get('bnSiteSettings')->show_video_live_tv == 1)
                @php($specialTopVideos = $specialTopVideos->take(4))
            @else
                @php($leadSpecialTopVideo = $specialTopVideos->shift())
            @endif
            <div class="row video-top-section">
                <div class="col-sm-12">
                    <div class="container">
                        <div class="row topRow">
                        <div class="col-sm-3 two">
                            @foreach($specialTopVideos as $video)
                                @php($videoUrl = $video->target == 2 && $video->type == 1 ? ('https://www.youtube.com/watch?v='.$video->code) : ($video->target == 2 && $video->type == 2 ? ('https://www.facebook.com/dhakaprokash24/videos/'.$video->code) : fVideoURL($video->id, $video->category->slug)))
                                @if($loop->iteration > 4)
                                    <div class="col-sm-3">
                                @endif

                                    <div class="photo-gallery-top-item {{ $loop->iteration % 2 != 0 ? 'custom-border-bottom' : null }}">
                                        <a class="image-box" href="{{ $videoUrl }}">
                                            <img
                                                src="{{ asset(config('appconfig.videoImagePath'). ($video->img_sm_path ?? 'photo_album_placeholder_image.png')) }}"
                                                alt="{{ $video->title }}"
                                                class="img-responsive">
                                            <div class="overlay">
                                                <p class="img-title-small">{{ $video->title }}</p>
                                            </div>
                                            <i class="fa fa-play video-icon"></i>
                                        </a>
                                    </div>

                                @if($loop->iteration > 4)
                                    </div>
                                @endif

                                @if($loop->iteration == 2)
                        </div>

                        <div class="col-sm-6 one">
                            @if(Cache::get('bnSiteSettings')->show_video_live_tv == 1)
                                <iframe
                                    src="https://player.twitch.tv/?channel=dhakaprokash&branding=false&muted=false&enableExtensions=falase&parent=localhost&parent=dhakaprokash24.com&parent=www.dhakaprokash24.com&autoplay=true"
                                    frameborder="0"
                                    scrolling="no"
                                    allowfullscreen="true"
                                    height="355"
                                    width="623">
                                </iframe>
                            @else
                                @if($leadSpecialTopVideo->is_live == 1)
                                    @if($leadSpecialTopVideo->type == 1)
                                        <iframe width="620" height="352" src="https://www.youtube.com/embed/{{$leadSpecialTopVideo->code}}?enablejsapi=1&autoplay=1&mute=1&rel=0&showinfo=1&controls=1&loop=1&playlist={{$leadSpecialTopVideo->code}}" frameborder="0" allowfullscreen></iframe>
                                    @elseif($leadSpecialTopVideo->type == 2)
                                        <div class="fb-video" data-href="https://www.facebook.com/watch/?v={{$leadSpecialTopVideo->code}}" data-width="auto" data-autoplay="true" data-show-captions="false"></div>
                                    @endif
                                @else
                                    @php($leadVideoUrl = $leadSpecialTopVideo->target == 2 && $leadSpecialTopVideo->type == 1 ? ('https://www.youtube.com/watch?v='.$leadSpecialTopVideo->code) : ($leadSpecialTopVideo->target == 2 && $leadSpecialTopVideo->type == 2 ? ('https://www.facebook.com/dhakaprokash24/videos/'.$leadSpecialTopVideo->code) : fVideoURL($leadSpecialTopVideo->id, $leadSpecialTopVideo->category->slug)))

                                    <a class="image-box" href="{{ $leadVideoUrl }}">
                                        <img
                                            src="{{ asset(config('appconfig.videoImagePath'). ($leadSpecialTopVideo->img_bg_path ?? 'photo_album_placeholder_image.png')) }}"
                                            alt="{{ $leadSpecialTopVideo->title }}" class="img-responsive">
                                        <i class="fa fa-play video-icon video-icon-lead"></i>
                                        <div class="lead_description">
                                            <p>{{ $leadSpecialTopVideo->title }}</p>
                                        </div>
                                    </a>
                                @endif
                            @endif
                        </div>

                        <div class="col-sm-3 three">
                            @endif

                            @if($loop->iteration == 4)
                        </div>
                        @endif
                        @endforeach
                    </div>
                    </div>
                </div>
            </div>
        @endif
            
        <div class="container">
            <div class="row marginTop20">
                <div class="col-sm-12">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ route('video.category','national') }}">জাতীয়</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row videoRow">
                @if($nationalVideos)
                    @foreach($nationalVideos as $video)
                        @php($videoUrl = $video->target == 2 && $video->type == 1 ? ('https://www.youtube.com/watch?v='.$video->code) : ($video->target == 2 && $video->type == 2 ? ('https://www.facebook.com/dhakaprokash24/videos/'.$video->code) : fVideoURL($video->id, $video->category->slug)))
                        <div class="col-sm-3 video-box" style="align-items: stretch!important;display: flex">
                            <a class="panel video-panel" href="{{ $videoUrl }}" target="{{ $video->target == 2 ? '_blank' : '' }}" >
                                <div class="panel-body">
                                    <img src="{{ asset(config('appconfig.videoImagePath').$video->img_sm_path) }}" alt="{{ $video->title }}" class="img-responsive">
                                    <i class="fa fa-play video-icon"></i>
                                </div>
                                <div class="panel-footer">
                                    <p>{{ $video->title }}</p>
                                </div>
                            </a>
                        </div>
                        @if($loop->count > $loop->iteration && $loop->iteration % 4 == 0)
            </div><div class="row videoRow">
                @endif
                @endforeach
                @endif
            </div>

            <div class="row marginTop20">
                <div class="col-sm-12">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ route('video.category','entertainment') }}">বিনোদন</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row videoRow">
                @if($entertainmentVideos)
                    @foreach($entertainmentVideos as $video)
                        @php($videoUrl = $video->target == 2 && $video->type == 1 ? ('https://www.youtube.com/watch?v='.$video->code) : ($video->target == 2 && $video->type == 2 ? ('https://www.facebook.com/dhakaprokash24/videos/'.$video->code) : fVideoURL($video->id, $video->category->slug)))
                        <div class="col-sm-3 video-box" style="align-items: stretch!important;display: flex">
                            <a class="panel video-panel" href="{{ $videoUrl }}" target="{{ $video->target == 2 ? '_blank' : '' }}" >
                                <div class="panel-body">
                                    <img src="{{ asset(config('appconfig.videoImagePath').$video->img_sm_path) }}" alt="{{ $video->title }}" class="img-responsive">
                                    <i class="fa fa-play video-icon"></i>
                                </div>
                                <div class="panel-footer">
                                    <p>{{ $video->title }}</p>
                                </div>
                            </a>
                        </div>
                        @if($loop->count > $loop->iteration && $loop->iteration % 4 == 0)
            </div><div class="row videoRow">
                @endif
                @endforeach
                @endif
            </div>

            <div class="row marginTop20">
                <div class="col-sm-12">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ route('video.category','saradesh') }}">সারাদেশ</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row videoRow">
                @if($saradeshVideos)
                    @foreach($saradeshVideos as $video)
                        @php($videoUrl = $video->target == 2 && $video->type == 1 ? ('https://www.youtube.com/watch?v='.$video->code) : ($video->target == 2 && $video->type == 2 ? ('https://www.facebook.com/dhakaprokash24/videos/'.$video->code) : fVideoURL($video->id, $video->category->slug)))
                        <div class="col-sm-3 video-box" style="align-items: stretch!important;display: flex">
                            <a class="panel video-panel" href="{{ $videoUrl }}" target="{{ $video->target == 2 ? '_blank' : '' }}" >
                                <div class="panel-body">
                                    <img src="{{ asset(config('appconfig.videoImagePath').$video->img_sm_path) }}" alt="{{ $video->title }}" class="img-responsive">
                                    <i class="fa fa-play video-icon"></i>
                                </div>
                                <div class="panel-footer">
                                    <p>{{ $video->title }}</p>
                                </div>
                            </a>
                        </div>
                        @if($loop->count > $loop->iteration && $loop->iteration % 4 == 0)
            </div><div class="row videoRow">
                @endif
                @endforeach
                @endif
            </div>

            <div class="row marginTop20">
                <div class="col-sm-12">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ route('video.category','international') }}">সারাবিশ্ব</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row videoRow">
                @if($internationalVideos)
                    @foreach($internationalVideos as $video)
                        @php($videoUrl = $video->target == 2 && $video->type == 1 ? ('https://www.youtube.com/watch?v='.$video->code) : ($video->target == 2 && $video->type == 2 ? ('https://www.facebook.com/dhakaprokash24/videos/'.$video->code) : fVideoURL($video->id, $video->category->slug)))
                        <div class="col-sm-3 video-box" style="align-items: stretch!important;display: flex">
                            <a class="panel video-panel" href="{{ $videoUrl }}" target="{{ $video->target == 2 ? '_blank' : '' }}" >
                                <div class="panel-body">
                                    <img src="{{ asset(config('appconfig.videoImagePath').$video->img_sm_path) }}" alt="{{ $video->title }}" class="img-responsive">
                                    <i class="fa fa-play video-icon"></i>
                                </div>
                                <div class="panel-footer">
                                    <p>{{ $video->title }}</p>
                                </div>
                            </a>
                        </div>
                        @if($loop->count > $loop->iteration && $loop->iteration % 4 == 0)
            </div><div class="row videoRow">
                @endif
                @endforeach
                @endif
            </div>

            <div class="row marginTop20">
                <div class="col-sm-12">
                    <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="{{ route('video.category','lifestyle') }}">লাইফস্টাইল</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row videoRow">
                @if($lifestyleVideos)
                    @foreach($lifestyleVideos as $video)
                        @php($videoUrl = $video->target == 2 && $video->type == 1 ? ('https://www.youtube.com/watch?v='.$video->code) : ($video->target == 2 && $video->type == 2 ? ('https://www.facebook.com/dhakaprokash24/videos/'.$video->code) : fVideoURL($video->id, $video->category->slug)))
                        <div class="col-sm-3 video-box" style="align-items: stretch!important;display: flex">
                            <a class="panel video-panel" href="{{ $videoUrl }}" target="{{ $video->target == 2 ? '_blank' : '' }}" >
                                <div class="panel-body">
                                    <img src="{{ asset(config('appconfig.videoImagePath').$video->img_sm_path) }}" alt="{{ $video->title }}" class="img-responsive">
                                    <i class="fa fa-play video-icon"></i>
                                </div>
                                <div class="panel-footer">
                                    <p>{{ $video->title }}</p>
                                </div>
                            </a>
                        </div>
                        @if($loop->count > $loop->iteration && $loop->iteration % 4 == 0)
            </div><div class="row videoRow">
                @endif
                @endforeach
                @endif
            </div>

        </div>
    </div>

    @include('frontend.en.ads.common.site-block-ad')
@endsection

@section('custom-js')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="{{ asset('frontend-assets/plugins/bootstrap/bootstrap.min.js') }}"></script>


@endsection
