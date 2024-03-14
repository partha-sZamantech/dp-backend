@if($motivationContents->count())
    @php($motivationTopContent = $motivationContents->shift())
    @php($sURL = fDesktopURL($motivationTopContent->content_id, $motivationTopContent->category->cat_slug, ($motivationTopContent->subcategory->subcat_slug ?? null), $motivationTopContent->content_type))
    <div class="cat-box">
        <div class="imgbox">
            <a href="{{ $sURL }}">
                <img
                    src="{{ $motivationTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$motivationTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                    class="img-responsive" alt="{{ $motivationTopContent->content_heading }}"
                    title="{{ $motivationTopContent->content_heading }}">
                @if(!empty($motivationTopContent->video_id))
                    <i class="fa fa-play news-video-icon-md"></i>
                @endif
                @if(!empty($motivationTopContent->podcast_id))
                    <i class="fa fa-volume-up news-video-icon-md"></i>
                @endif
            </a>
        </div>
        <h3>
            <a href="{{ $sURL }}">
{{--                @if(!empty($motivationTopContent->video_id) || !empty($motivationTopContent->podcast_id))--}}
{{--                    <span class="video-audio-icon">--}}
{{--                                            @if(!empty($motivationTopContent->video_id))--}}
{{--                            <i class="fa fa-play"></i>--}}
{{--                        @endif--}}
{{--                        @if(!empty($motivationTopContent->podcast_id))--}}
{{--                            <i class="fa fa-volume-up"></i>--}}
{{--                        @endif--}}
{{--                                        </span>--}}
{{--                @endif--}}
                @if($motivationTopContent->content_sub_heading)
                    {{--                                            <b class="sub-heading">{{ $motivationTopContent->content_sub_heading }}</b>--}}
                    <span class="red-text">{{ $motivationTopContent->content_sub_heading }}</span>/
                @endif
                {{ $motivationTopContent->content_heading }}
            </a>
        </h3>
        <p>{{fFormatDateEn2Bn($motivationTopContent->created_at->diffForHumans()) }}</p>
    </div>

    @php($motivationOtherContents = $motivationContents->all())

    @if($motivationOtherContents)
        @foreach($motivationOtherContents as $content)
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
                                <span class="red-text">{{ $content->content_sub_heading }}</span>/
                            @endif
                            {{ $content->content_heading }}
                        </a>
                    </h4>
                </div>
            </div>
        @endforeach
    @endif
@endif
