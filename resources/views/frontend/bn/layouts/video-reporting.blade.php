<div class="section-hedding">
    <a href="{{ url('/video') }}" class="link-overlay"></a>
    <h2>ভিডিও রিপোর্টিং  <span></span></h2>
</div>
<div class="small-news-carousel owl-carousel owl-dot-bottom-mid">
    @if($reportingVideos)
        @foreach($reportingVideos as $video)
            <div class="video-area">
                @if($video->video_type == 1)
                    @php($imgPath = 'background-image: url(http://img.youtube.com/vi/'.$video->video_code.'/mqdefault.jpg)')
                @else
                    @php($imgPath = 'background-image: url('.asset(config('appconfig.videoImagePath').$video->img_path).')')
                @endif
                <a href="{{ fVideoURL($video->video_id,$video->category->cat_slug,($video->subcategory ? $video->subcategory->subcat_slug : null)) }}" class="video-play-btn reporting-video-bg mfp-iframe" style="{{ $imgPath }}">
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