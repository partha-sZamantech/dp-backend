<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'latest')" id="defaultOpen">Latest</button>
    <button class="tablinks" onclick="openCity(event, 'popular')">Popular</button>
</div>

<!-- Tab content -->
<div id="latest" class="tabcontent fixed-height">
    {{--  <ul>
          @if($latestContents)
              @foreach($latestContents as $content)
                  <li><a href="{{ fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type) }}">{{ $content->content_heading }}</a></li>
              @endforeach
          @endif
      </ul>--}}
    <ul class="cat-box-with-media default-height rem-first-border">
        @if($latestContents)
            @foreach($latestContents as $content)
                @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                <li class="media">
                    <div class="media-left">
                        <div class="imgbox">
                            <a href="{{ $sURL }}">
                                @if($content->video_type == 1 && $content->video_id)
                                    <img src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="img-responsive" alt="{{ $content->content_heading }}">
                                @else
                                    <img src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}"  class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                @endif

                                @if($content->video_id)
                                    <div class="video-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                @endif
                            </a>
                        </div>
                    </div>
                    <div class="media-body">
                        <h4 class="details-font" style="font-size: 17px">
                            <a href="{{ $sURL }}">
                                @if($content->content_sub_heading)
                                    {{--                                    <b class="sub-heading">{{ $content->content_sub_heading }}</b>--}}
                                    <span class="color-text">{{ $content->content_sub_heading }}</span> /
                                @endif
                                {{ $content->content_heading }}
                            </a>
                        </h4>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</div>

<div id="popular" class="tabcontent fixed-height">
    {{--<ul>
        @if($popularContents)
            @foreach($popularContents as $content)
                <li><a href="{{ fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type) }}">{{ $content->content_heading }}</a></li>
            @endforeach
        @endif
    </ul>--}}
    <ul class="cat-box-with-media default-height rem-first-border">
        @if($popularContents)
            @foreach($popularContents as $content)
                @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                <li class="media">
                    <div class="media-left">
                        <div class="imgbox">
                            <a href="{{ $sURL }}">
                                @if($content->video_type == 1 && $content->video_id)
                                    <img src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="img-responsive" alt="{{ $content->content_heading }}">
                                @else
                                    <img src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}"  class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                @endif

                                @if($content->video_id)
                                    <div class="video-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                @endif
                            </a>
                        </div>
                    </div>
                    <div class="media-body">
                        <h4 class=" details-font" style="font-size: 17px">
                            <a href="{{ $sURL }}">
                                @if($content->content_sub_heading)
                                    {{--                                    <b class="sub-heading">{{ $content->content_sub_heading }}</b>--}}
                                    <span class="color-text">{{ $content->content_sub_heading }}</span> /
                                @endif
                                {{ $content->content_heading }}
                            </a>
                        </h4>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</div>
