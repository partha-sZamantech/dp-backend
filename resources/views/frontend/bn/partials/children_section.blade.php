@if($childrenContents->count())
    @php($childrenTopContent = $childrenContents->shift())
    @php($sURL = fDesktopURL($childrenTopContent->content_id, $childrenTopContent->category->cat_slug, ($childrenTopContent->subcategory->subcat_slug ?? null), $childrenTopContent->content_type))
    <div class="cat-box">
        <div class="imgbox">
            <a href="{{ $sURL }}">
                <img
                    src="{{ $childrenTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$childrenTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                    class="img-responsive" alt="{{ $childrenTopContent->content_heading }}"
                    title="{{ $childrenTopContent->content_heading }}">
                @if(!empty($childrenTopContent->video_id))
                    <i class="fa fa-play news-video-icon-md"></i>
                @endif
                @if(!empty($childrenTopContent->podcast_id))
                    <i class="fa fa-volume-up news-video-icon-md"></i>
                @endif
            </a>
        </div>
        <h3>
            <a href="{{ $sURL }}">
{{--                @if(!empty($childrenTopContent->video_id) || !empty($childrenTopContent->podcast_id))--}}
{{--                    <span class="video-audio-icon">--}}
{{--                        @if(!empty($childrenTopContent->video_id))--}}
{{--                            <i class="fa fa-play"></i>--}}
{{--                        @endif--}}
{{--                        @if(!empty($childrenTopContent->podcast_id))--}}
{{--                            <i class="fa fa-volume-up"></i>--}}
{{--                        @endif--}}
{{--                    </span>--}}
{{--                @endif--}}
                @if($childrenTopContent->content_sub_heading)
                    {{--                                            <b class="sub-heading">{{ $childrenTopContent->content_sub_heading }}</b>--}}
                    <span class="red-text">{{ $childrenTopContent->content_sub_heading }}</span>/
                @endif
                {{ $childrenTopContent->content_heading }}
            </a>
        </h3>
        <p>{{fFormatDateEn2Bn($childrenTopContent->created_at->diffForHumans()) }}</p>
    </div>

    @php($childrenOtherContents = $childrenContents->all())

    @if(count($childrenOtherContents))
        @foreach($childrenOtherContents as $content)
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
                                {{--                                                        <b class="sub-heading">{{ $content->content_sub_heading }}</b>--}}
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
