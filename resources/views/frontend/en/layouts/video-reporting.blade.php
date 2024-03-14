<div class="section-hedding">
    <a href="{{ url('/video') }}" class="link-overlay"></a>
    <h2>Video Reporting  <span></span></h2>
</div>
<div class="small-news-carousel owl-carousel owl-dot-bottom-mid">
    @if($reportingVideos)
        @foreach($reportingVideos as $video)
            <div class="video-area">
                @if($video->video_type == 1)
                    @php($imgPath = 'background-image: url(http://img.youtube.com/vi/'.$video->video_code.'/mqdefault.jpg)')
                    <a href="https://www.youtube.com/watch?v={{ $video->video_code }}" class="video-play-btn reporting-video-bg mfp-iframe" style="{{ $imgPath }}">
                @else
                    @php($imgPath = 'background-image: url('.asset(config('appconfig.videoImagePath').$video->img_path).')')
                    <a href="https://www.facebook.com/{{ $video->video_code }}" data-href="https://www.facebook.com/{{ $video->video_code }}" data-autoplay="false" data-show-text="false" data-show-captions="false" data-allowfullscreen="true" class="video-play-btn reporting-video-bg mfp-iframe" style="{{ $imgPath }}">
                        @endif
                        <div class="video-icon-table">
                            <div class="video-icon-tablecell">
                                <i class="fa fa-play"></i>
                            </div>
                        </div>
                    </a>
            </div>
        @endforeach
    @endif
</div>
