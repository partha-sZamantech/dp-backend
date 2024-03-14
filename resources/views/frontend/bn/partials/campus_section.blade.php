@if($campusContents)
    @php($campusTopContents = $campusContents->shift())
    @php($sURL = fDesktopURL($campusTopContents->content_id, $campusTopContents->category->cat_slug, ($campusTopContents->subcategory->subcat_slug ?? null), $campusTopContents->content_type))
    <div class="cat-box">
        <div class="imgbox">
            <a href="{{ $sURL }}">
                <img
                    src="{{ $campusTopContents->img_sm_path ? asset(config('appconfig.contentImagePath').$campusTopContents->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                    class="img-responsive" alt="{{ $campusTopContents->content_heading }}"
                    title="{{ $campusTopContents->content_heading }}">
                @if(!empty($campusTopContents->video_id))
                    <i class="fa fa-play news-video-icon-md"></i>
                @endif
                @if(!empty($campusTopContents->podcast_id))
                    <i class="fa fa-volume-up news-video-icon-md"></i>
                @endif
            </a>
        </div>
        <h3>
            <a href="{{ $sURL }}">
{{--                @if(!empty($campusTopContents->video_id) || !empty($campusTopContents->podcast_id))--}}
{{--                    <span class="video-audio-icon">--}}
{{--                                            @if(!empty($campusTopContents->video_id))--}}
{{--                            <i class="fa fa-play"></i>--}}
{{--                        @endif--}}
{{--                        @if(!empty($campusTopContents->podcast_id))--}}
{{--                            <i class="fa fa-volume-up"></i>--}}
{{--                        @endif--}}
{{--                                        </span>--}}
{{--                @endif--}}
                @if($campusTopContents->content_sub_heading)
                    {{--                                            <b class="sub-heading">{{ $campusTopContents->content_sub_heading }}</b>--}}
                    <span class="red-text">{{ $campusTopContents->content_sub_heading }}</span>/
                @endif
                {{ $campusTopContents->content_heading }}
            </a>
        </h3>
        <p>{{fFormatDateEn2Bn($campusTopContents->created_at->diffForHumans()) }}</p>
    </div>

    @php($campusOtherContents = $campusContents->all())

    @if(count($campusOtherContents))
        @foreach($campusOtherContents as $content)
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
