    <div class="section-hedding left-style-box">
        <a href="{{ url('/video') }}" class="link-overlay"></a>
        <h2>Video Gallery
            <span></span>
        </h2>
    </div>
    <div class="gallery-content">
        <div class="home-gallery owl-carousel h-125">
            @foreach($latestVideos as $video)
                <div class="feature-item-1 single-slide-item">
                    @if($video->video_type == 1)
                        @php($imgPath = 'http://img.youtube.com/vi/'.$video->video_code.'/mqdefault.jpg')
                        <a href="https://www.youtube.com/watch?v={{ $video->video_code }}" class="link-overlay video-play-btn mfp-iframe"></a>
                        <img src="{{ $imgPath }}" class="area-bg" alt="">
                    @else
                        @php($imgPath = asset(config('appconfig.videoImagePath').$video->img_path))
                        <a href="https://www.facebook.com/{{ $video->video_code }}" data-href="https://www.facebook.com/{{ $video->video_code }}" data-autoplay="false" data-show-text="false" data-show-captions="false" data-allowfullscreen="true" class="link-overlay video-play-btn mfp-iframe"></a>
                        <img src="{{ $imgPath }}" class="area-bg" alt="{{ $video->video_title }}">
                    @endif
                    <!--vdo thumb-->
                    <div class="area-heading">
                        <h2>{{ $video->video_title }}</h2>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
