@if($specialArticleContents->count())
    @php($specialArticleTopContent = $specialArticleContents->shift())
    @php($sURL = fDesktopURL($specialArticleTopContent->content_id, $specialArticleTopContent->category->cat_slug, ($specialArticleTopContent->subcategory->subcat_slug ?? null), $specialArticleTopContent->content_type))
    <div class="cat-box">
        <div class="imgbox">
            <a href="{{ $sURL }}">
                <img
                    src="{{ $specialArticleTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$specialArticleTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                    class="img-responsive"
                    alt="{{ $specialArticleTopContent->content_heading }}"
                    title="{{ $specialArticleTopContent->content_heading }}">
                @if(!empty($specialArticleTopContent->video_id))
                    <i class="fa fa-play news-video-icon-md"></i>
                @endif
                @if(!empty($specialArticleTopContent->podcast_id))
                    <i class="fa fa-volume-up news-video-icon-md"></i>
                @endif
            </a>
        </div>
        <h3>
            <a href="{{ $sURL }}">
{{--                @if(!empty($specialArticleTopContent->video_id) || !empty($specialArticleTopContent->podcast_id))--}}
{{--                    <span class="video-audio-icon">--}}
{{--                                                @if(!empty($specialArticleTopContent->video_id))--}}
{{--                            <i class="fa fa-play"></i>--}}
{{--                        @endif--}}
{{--                        @if(!empty($specialArticleTopContent->podcast_id))--}}
{{--                            <i class="fa fa-volume-up"></i>--}}
{{--                        @endif--}}
{{--                                            </span>--}}
{{--                @endif--}}
                @if($specialArticleTopContent->content_sub_heading)
                    {{--                                            <b class="sub-heading">{{ $specialArticleTopContent->content_sub_heading }}</b>--}}
                    <span
                        class="red-text">{{ $specialArticleTopContent->content_sub_heading }}</span>
                    /
                @endif
                {{ $specialArticleTopContent->content_heading }}
            </a>
        </h3>
    </div>

    @php($specialArticleOtherContents = $specialArticleContents->all())

    @if(count($specialArticleOtherContents))
        @foreach($specialArticleOtherContents as $content)
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
                                {{--                                                        <b class="sub-heading">{{ $intTopContent->content_sub_heading }}</b>--}}
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
