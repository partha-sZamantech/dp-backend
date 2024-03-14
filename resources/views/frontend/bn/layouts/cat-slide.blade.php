<!-- Main slider area -->
<div class="slider-area margin-top-10">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="owl-carousel video-slides big-vdo-slides owl-dot-bottom-mid">
                    @php($firstLatestBnContents = $latestBnContents->splice(0,3))
                    @foreach($firstLatestBnContents as $content)
                        <div class="single-video-slide">
                            <div class="video-area">
                                <a class="img-btn reporting-video-bg" href="{{ fDesktopURL($content->content_id, $content->category->cat_slug, (!is_null($content->subcategory) ? $content->subcategory->subcat_slug : null), $content->content_type) }}">

                                    @if($content->video_type == 1 && $content->video_id)
                                        <img src="https://img.youtube.com/vi/{{ $content->video_id }}/mqdefault.jpg" class="small-news-preview" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                    @else
                                        <img src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">

                                    @endif

                                </a>
                                <h4 class="left-vdo-heading">{{ $content->content_heading }}</h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="gallery-slide-ad main-silde-area-ad">
                    <a href="#">
                        <img src="{{ asset(config('appconfig.contentImagePath').'2017November/main-slide-ad-1.jpg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>