<div class="greybg-area people-que-area margin-top-25">
    <div class="section-hedding margin-top-10 margin-bottom-20">
        <h2>টপ চার্ট
            <span></span>
        </h2>
    </div>
    <div class="custom-tab readers-qs">
        <ul class="tab-list text-center">
            <li><a data-toggle="tab" href="#custom-tab-1">বাংলা</a></li>
            <li class="active"><a data-toggle="tab" href="#custom-tab-2">হিন্দি</a></li>
            <li><a data-toggle="tab" href="#custom-tab-3">ইংরেজি</a></li>
        </ul>
        <div class="tab-content">
            <!-- tab 1 end -->
            <div id="custom-tab-1" class="tab-pane fade">
                <!-- small news -->
                @if($dhallywoodContents)
                    @foreach($dhallywoodContents as $content)
                        <div class="category-small-news small-news-item">
                            <a href="{{ fDesktopURL($content->content_id, $content->category->cat_slug, (!is_null($content->subcategory) ? $content->subcategory->subcat_slug : null), $content->content_type) }}" class="link-overlay"></a>

                            @if($content->video_type == 1 && $content->video_id)
                                <img src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="small-news-preview" alt="{{ $content->content_heading }}">
                            @else
                                <img src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}" class="small-news-preview" alt="{{ $content->content_heading }}">
                            @endif

                            <div class="area-heading">
                                <h5>{{ fFormatDateEn2Bn(date("d F Y", strtotime($content->created_at))) }}</h5>
                            </div>
                            <div class="small-news-content">
                                <h4 class="line-clamp line-clamp-2">{{ $content->content_heading }}</h4>
                                <p class="line-clamp line-clamp-3">
                                    <span>{{ $content->content_brief }}</span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <!-- tab 2 end -->
            <div id="custom-tab-2" class="tab-pane fade in active">
                <!-- small news -->
                @if($bollywoodContents)
                    @foreach($bollywoodContents as $content)
                        <div class="category-small-news small-news-item">
                            <a href="{{ fDesktopURL($content->content_id, $content->category->cat_slug, (!is_null($content->subcategory) ? $content->subcategory->subcat_slug : null), $content->content_type) }}" class="link-overlay"></a>
                            @if($content->video_type == 1 && $content->video_id)
                                <img src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="small-news-preview" alt="{{ $content->content_heading }}">
                            @else
                                <img src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}" class="small-news-preview" alt="{{ $content->content_heading }}">
                            @endif

                            <div class="area-heading">
                                <h5>{{ fFormatDateEn2Bn(date("d F Y", strtotime($content->created_at))) }}</h5>
                            </div>
                            <div class="small-news-content">
                                <h4 class="line-clamp line-clamp-2">{{ $content->content_heading }}</h4>
                                <p class="line-clamp line-clamp-3">
                                    <span>{{ $content->content_brief }}</span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <!-- tab 3 end -->
            <div id="custom-tab-3" class="tab-pane fade">
                <!-- small news -->
                @if($hollywoodContents)
                    @foreach($hollywoodContents as $content)
                        <div class="category-small-news small-news-item">
                            <a href="{{ fDesktopURL($content->content_id, $content->category->cat_slug, (!is_null($content->subcategory) ? $content->subcategory->subcat_slug : null), $content->content_type) }}" class="link-overlay"></a>
                            @if($content->video_type == 1 && $content->video_id)
                                <img src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="small-news-preview" alt="{{ $content->content_heading }}">
                            @else
                                <img src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}" class="small-news-preview" alt="{{ $content->content_heading }}">
                            @endif

                            <div class="area-heading">
                                <h5>{{ fFormatDateEn2Bn(date("d F Y", strtotime($content->created_at))) }}</h5>
                            </div>
                            <div class="small-news-content">
                                <h4 class="line-clamp line-clamp-2">{{ $content->content_heading }}</h4>
                                <p class="line-clamp line-clamp-3">
                                    <span>{{ $content->content_brief }}</span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div><!--/. tab section end -->