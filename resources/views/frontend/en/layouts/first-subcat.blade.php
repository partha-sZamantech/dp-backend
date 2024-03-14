<div class="section-hedding left-style-box margin-bottom-25">
    <a href="{{ url($category->cat_slug.'/'.$firstSubcat->subcat_slug) }}" class="link-overlay"></a>
    <h2>{{ $firstSubcat->subcat_name }}
        <span></span>
    </h2>
</div>
<div class="row">
    @if($firstSubcat->contents->count())
        @php($firstSubcatContents = $firstSubcat->contents->splice(0,3))
        <div class="col-md-6 padding-right-7-5">
            <div class="big-slider-2 owl-carousel owl-dot-bottom-mid">
                @foreach($firstSubcatContents as $content)
                    <a href="{{ fEnURL($content->content_id, $content->category->cat_slug, (!is_null($content->subcategory) ? $content->subcategory->subcat_slug : null), $content->content_type) }}" class="feature-item-2 single-slide-item">
                        <div class="area-heading">
                            <h2>{{ $content->content_heading }}</h2>
                        </div>
                        <img src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}" class="area-bg" alt="{{ $content->content_heading }}">
                    </a>
                @endforeach
            </div>
        </div>

        <div class="col-md-6 padding-left-7-5">
            <div class="row">
                <div class="col-md-6 padding-right-7-5">
                    @php($firstSubcatOtherContents = collect($firstSubcat->contents->all()))
                    @php($firstSubcatOtherContents = $firstSubcatOtherContents->splice(0, 6))
                    @foreach($firstSubcatOtherContents as $content)
                        @if($loop->first || $loop->iteration == 4)
                            <div class="category-mid-news">
                                <a href="{{ fEnURL($content->content_id, $content->category->cat_slug, (!is_null($content->subcategory) ? $content->subcategory->subcat_slug : null), $content->content_type) }}" class="link-overlay"></a>
                                <img src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" alt="{{ $content->content_heading }}">
                                <h4>{{ $content->content_heading }}</h4>
                            </div>
                        @else
                            <div class="category-small-news small-news-item">
                                <a href="{{ fEnURL($content->content_id, $content->category->cat_slug, (!is_null($content->subcategory) ? $content->subcategory->subcat_slug : null), $content->content_type) }}" class="link-overlay"></a>
                                <img src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}" class="small-news-preview" alt="{{ $content->content_heading }}">
                                <div class="area-heading">
                                    <h5>{{ date("d F Y", strtotime($content->created_at)) }}</h5>
                                </div>
                                <div class="small-news-content">
                                    <h4 class="line-clamp line-clamp-2">{{ $content->content_heading }}</h4>
                                    <p class="line-clamp line-clamp-3"><span>{{ $content->content_brief }}</span></p>
                                </div>
                            </div>
                        @endif
                        @if($loop->count > 3 && $loop->iteration == 3)
                </div>
                <div class="col-md-6 padding-left-7-5">
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>