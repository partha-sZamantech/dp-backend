<!-- Main slider area -->
<div class="slider-area margin-top-10">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="owl-carousel video-slides big-vdo-slides owl-dot-bottom-mid">
                    @php($firstLatestEnContents = $latestEnContents->splice(0,3))
                    @foreach($firstLatestEnContents as $content)
                        <div class="single-video-slide">
                            <div class="video-area">
                                <a class="img-btn reporting-video-bg" href="{{ fEnURL($content->content_id, $content->category->cat_slug, (!is_null($content->subcategory) ? $content->subcategory->subcat_slug : null), $content->content_type) }}">
                                    <img src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
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