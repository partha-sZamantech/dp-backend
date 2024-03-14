<div class="col-sm-3">
    <div class="special-top-video-section">
        <div class="common-title common-title-brown">
            <span class="common-title-shape">
                <a class="common-title-link" href="{{ route('video') }}" target="_blank">ভিজ্যুয়াল মিডিয়া</a>
            </span>
        </div>
        @if(count($bnSpecialTopVideos))
            @php($spTopFirstVideo = $bnSpecialTopVideos->shift())
            <a style="margin-bottom: 20px; cursor: pointer" href="{{fVideoURL($spTopFirstVideo->id, $spTopFirstVideo->category->slug)}}" target="_blank" rel="nofollow">
                <img src="{{ asset(config('appconfig.videoImagePath').$spTopFirstVideo->img_sm_path) }}" alt="{{ $spTopFirstVideo->title }}"/>
                <h4>{{ $spTopFirstVideo->title }}</h4>
            </a>

            @if($bnSpecialTopVideos->count())
                <div class="special-top-video-box">
                    @foreach($bnSpecialTopVideos as $video)
                        <div class="media">
                            <div class="media-left">
                                <div class="video-icon">
                                    <i class="fa fa-play"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="{{ fVideoURL($video->id, $video->category->slug) }}" target="_blank" rel="nofollow">
                                        {{ $video->title }}
                                    </a>
                                </h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</div>
