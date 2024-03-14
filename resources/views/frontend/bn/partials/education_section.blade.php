@if($educationContents)
    @php($eduTopContent = $educationContents->shift())
    @php($sURL = fDesktopURL($eduTopContent->content_id, $eduTopContent->category->cat_slug, ($eduTopContent->subcategory->subcat_slug ?? null), $eduTopContent->content_type))
    <div class="cat-box">
        <div class="imgbox">
            <a href="{{ $sURL }}">
                <img
                    src="{{ $eduTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$eduTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                    class="img-responsive" alt="{{ $eduTopContent->content_heading }}"
                    title="{{ $eduTopContent->content_heading }}">
                @if(!empty($eduTopContent->video_id))
                    <i class="fa fa-play news-video-icon-md"></i>
                @endif
                @if(!empty($eduTopContent->podcast_id))
                    <i class="fa fa-volume-up news-video-icon-md"></i>
                @endif
            </a>
        </div>
        <h3>
            <a href="{{ $sURL }}">
{{--                @if(!empty($eduTopContent->video_id) || !empty($eduTopContent->podcast_id))--}}
{{--                    <span class="video-audio-icon">--}}
{{--                                            @if(!empty($eduTopContent->video_id))--}}
{{--                            <i class="fa fa-play"></i>--}}
{{--                        @endif--}}
{{--                        @if(!empty($eduTopContent->podcast_id))--}}
{{--                            <i class="fa fa-volume-up"></i>--}}
{{--                        @endif--}}
{{--                                        </span>--}}
{{--                @endif--}}
                @if($eduTopContent->content_sub_heading)
                    {{--<b class="sub-heading">{{ $eduTopContent->content_sub_heading }}</b>--}}
                    <span class="red-text">{{ $eduTopContent->content_sub_heading }}</span>/
                @endif
                {{ $eduTopContent->content_heading }}
            </a>
        </h3>
        <p>{{fFormatDateEn2Bn($eduTopContent->created_at->diffForHumans()) }}</p>
    </div>

    @php($eduOtherContents = $educationContents->all())

    @if($eduOtherContents)
        @foreach($eduOtherContents as $content)
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
