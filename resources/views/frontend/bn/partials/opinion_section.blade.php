@if($opinionContents->count())
    @php($opinionTopContent = $opinionContents->shift())
    @php($sURL = fDesktopURL($opinionTopContent->content_id, $opinionTopContent->category->cat_slug, ($opinionTopContent->subcategory->subcat_slug ?? null), $opinionTopContent->content_type))
    <div class="cat-box">
        <div class="imgbox">
            <a href="{{ $sURL }}">
                <img
                    src="{{ $opinionTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$opinionTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                    class="img-responsive" alt="{{ $opinionTopContent->content_heading }}"
                    title="{{ $opinionTopContent->content_heading }}">
                @if(!empty($opinionTopContent->video_id))
                    <i class="fa fa-play news-video-icon-md"></i>
                @endif
                @if(!empty($opinionTopContent->podcast_id))
                    <i class="fa fa-volume-up news-video-icon-md"></i>
                @endif
            </a>
        </div>
        <h3>
            <a href="{{ $sURL }}">
{{--                @if(!empty($opinionTopContent->video_id) || !empty($opinionTopContent->podcast_id))--}}
{{--                    <span class="video-audio-icon">--}}
{{--                                            @if(!empty($opinionTopContent->video_id))--}}
{{--                            <i class="fa fa-play"></i>--}}
{{--                        @endif--}}
{{--                        @if(!empty($opinionTopContent->podcast_id))--}}
{{--                            <i class="fa fa-volume-up"></i>--}}
{{--                        @endif--}}
{{--                                        </span>--}}
{{--                @endif--}}
                @if($opinionTopContent->content_sub_heading)
                    {{--                                            <b class="sub-heading">{{ $opinionTopContent->content_sub_heading }}</b>--}}
                    <span class="red-text">{{ $opinionTopContent->content_sub_heading }}</span>/
                @endif
                {{ $opinionTopContent->content_heading }}
            </a>
        </h3>
    </div>

    @php($opinionOtherContents = $opinionContents->all())
    @if(count($opinionOtherContents))
        @foreach($opinionOtherContents as $content)
            @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
            <div class="media">
                <div class="media-body">
                    <h4 class="media-heading">
                        <a href="{{ $sURL }}">
                            @if(!empty($content->video_id) || !empty($content->podcast_id))
                                <span class="video-audio-icon">
                                                        @if(!empty($content->video_id))
                                        <i class="fa fa-play"></i>
                                    @endif
                                    @if(!empty($content->podcast_id))
                                        <i class="fa fa-volume-up"></i>
                                    @endif
                                                    </span>
                            @endif
                            @if($content->content_sub_heading)
                                {{--                                            <b class="sub-heading">{{ $content->content_sub_heading }}</b>--}}
                                <span
                                    class="red-text">{{ $content->content_sub_heading }}</span>/
                            @endif
                            {{ $content->content_heading }}
                        </a>
                    </h4>
                </div>
            </div>
        @endforeach
    @endif
@endif
