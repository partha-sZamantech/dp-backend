@if($lifestyleContents)
    @foreach($lifestyleContents as $content)
        @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
        <div class="row news-top-middle-other">
            <div class="col-md-5 col-sm-5 col-xs-5">
                <a href="{{ $sURL }}">
                    <div class="imgbox-sm">
                        <img
                            src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.jpg') }}"
                            class="img-responsive" alt="{{ $content->content_heading }}"
                            title="{{ $content->content_heading }}">
                        @if(!empty($content->video_id))
                            <i class="fa fa-play news-video-icon-sm"></i>
                        @endif
                        @if(!empty($content->podcast_id))
                            <i class="fa fa-volume-up news-video-icon-sm"></i>
                        @endif
                    </div>
                </a>
            </div>
            <div class="col-md-7 col-sm-7 col-xs-7">
                <h4 class="media-heading">
                    <a href="{{ $sURL }}">
                        @if($content->content_sub_heading)
                            {{--<b class="sub-heading">{{ $content->content_sub_heading }}</b>--}}
                            <span class="red-text">{{ $content->content_sub_heading }}</span>/
                        @endif
                        {{ $content->content_heading }}
                    </a>
                </h4>
                {{fFormatDateEn2Bn($content->created_at->diffForHumans()) }}
            </div>
        </div>
    @endforeach
@endif
