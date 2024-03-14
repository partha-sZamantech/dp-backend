<div class="row">
    <div class="col-sm-12 marginBottom10">
        <div class="special-top-video-section">
            @if(count($bnSpecialTopVideos))
                @if(Cache::get('bnSiteSettings')->show_live_tv == 1)
                    <iframe
                        src="https://player.twitch.tv/?channel=dhakaprokash24&branding=false&muted=false&enableExtensions=falase&parent=localhost&parent=dhakaprokash24.com&parent=www.dhakaprokash24.com&autoplay=true"
                        frameborder="0"
                        scrolling="no"
                        allowfullscreen="true"
                        height="291"
                        width="100%">
                    </iframe>
                @else
                    @php($spTopFirstVideo = $bnSpecialTopVideos->shift())
                    @if($spTopFirstVideo->is_live == 1)
                        @if($spTopFirstVideo->type == 1)
                            <iframe width="518" height="292" src="https://www.youtube.com/embed/{{$spTopFirstVideo->code}}?enablejsapi=1&autoplay=1&mute=1&rel=0&showinfo=1&controls=1&loop=1&playlist={{$spTopFirstVideo->code}}" frameborder="0" allowfullscreen style="width: 100%!important;"></iframe>
                        @elseif($spTopFirstVideo->type == 2)
                            <div class="fb-video" data-href="https://www.facebook.com/watch/?v={{$spTopFirstVideo->code}}" data-width="auto" data-autoplay="true" data-show-captions="false"></div>
                        @endif
                    @else
                        @php($videoUrl = $spTopFirstVideo->target == 2 && $spTopFirstVideo->type == 1 ? ('https://www.youtube.com/watch?v='.$spTopFirstVideo->code) : ($spTopFirstVideo->target == 2 && $spTopFirstVideo->type == 2 ? ('https://www.facebook.com/dhakaprokash24/videos/'.$spTopFirstVideo->code) : fVideoURL($spTopFirstVideo->id, $spTopFirstVideo->category->slug)))

                        <a style="margin-bottom: 20px; cursor: pointer" href="{{$videoUrl}}" target="_blank" rel="nofollow">
                            <img src="{{ asset(config('appconfig.videoImagePath').$spTopFirstVideo->img_bg_path) }}" alt="{{ $spTopFirstVideo->title }}" style="width: 100%" />
                            <i class="fa fa-play" style="font-size: 20px"></i>
                            <h4>
                                {{ $spTopFirstVideo->title }}
                            </h4>
                        </a>
                    @endif
                @endif
            @endif
        </div>
    </div>
{{--    <div class="col-sm-12 special-top-video-box">--}}
{{--        @if($bnSpecialTopVideos->count())--}}
{{--            <div class="row">--}}
{{--                @foreach($bnSpecialTopVideos->take(6) as $video)--}}
{{--                    @php($videoUrl = $video->target == 2 && $video->type == 1 ? ('https://www.youtube.com/watch?v='.$video->code) : ($video->target == 2 && $video->type == 2 ? ('https://www.facebook.com/dhakaprokash24/videos/'.$video->code) : fVideoURL($video->id, $video->category->slug)))--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <div class="media">--}}
{{--                            <div class="media-left">--}}
{{--                                <div class="video-icon">--}}
{{--                                    <i class="fa fa-play"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="media-body">--}}
{{--                                <h4 class="media-heading">--}}
{{--                                    <a href="{{ $videoUrl }}" target="_blank" rel="nofollow">--}}
{{--                                        {{ $video->title }}--}}
{{--                                    </a>--}}
{{--                                </h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @if($loop->iteration == 2)--}}
{{--            </div><div class="row">--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}

    <div class="col-sm-12 special-top-video-box">
        @if($bnSpecialTopVideos->count())
            <div class="row" style="border-bottom: 1px solid #f0e7e7">
                @foreach($bnSpecialTopVideos->take(4) as $video)
                    @php($videoUrl = $video->target == 2 && $video->type == 1 ? ('https://www.youtube.com/watch?v='.$video->code) : ($video->target == 2 && $video->type == 2 ? ('https://www.facebook.com/dhakaprokash24/videos/'.$video->code) : fVideoURL($video->id, $video->category->slug)))
                    <div class="col-sm-6">
                        <div class="media">
                            <div class="media-left">
                                <div class="video-icon">
                                    <i class="fa fa-play-circle"></i>
                                </div>
                            </div>
                            <div class="media-body" style="border-right: {{ ($loop->iteration % 2 != 0) ? '1' : null }}px solid #f0e7e7">
                                <h4 class="media-heading">
                                    <a href="{{ $videoUrl }}" target="_blank" rel="nofollow">
                                        {{ $video->title }}
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div>
                    @if($loop->iteration % 2 == 0)
            </div><div class="row" style="border-bottom: 1px solid #f0e7e7">
                @endif
                @endforeach
            </div>
        @endif
        {{--        <div class="row" style="display: flex; justify-content: right; margin-top: 20px;">--}}
{{--            <script> app="www.cricwaves.com"; mo="Z_W"; nt="n"; Width='300px'; Height='170px'; co ="aus"; ad="1"; </script>--}}
{{--            <script type="text/javascript" src="//www.cricwaves.com/cricket/widgets/script/scoreWidgets.js?v=0.111"></script>--}}
{{--        </div>--}}
    </div>
</div>
