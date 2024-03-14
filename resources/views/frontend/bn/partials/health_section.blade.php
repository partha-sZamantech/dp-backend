@if($healthContents)
    @php($healthTopContent = $healthContents->shift())
    @php($sURL = fDesktopURL($healthTopContent->content_id, $healthTopContent->category->cat_slug, ($healthTopContent->subcategory->subcat_slug ?? null), $healthTopContent->content_type))
    <div class="cat-box">
        <div class="imgbox">
            <a href="{{ $sURL }}">
                <img
                    src="{{ $healthTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$healthTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                    class="img-responsive" alt="{{ $healthTopContent->content_heading }}"
                    title="{{ $healthTopContent->content_heading }}">
                @if(!empty($healthTopContent->video_id))
                    <i class="fa fa-play news-video-icon-md"></i>
                @endif
                @if(!empty($healthTopContent->podcast_id))
                    <i class="fa fa-volume-up news-video-icon-md"></i>
                @endif
            </a>
        </div>
        <h3>
            <a href="{{ $sURL }}">
{{--                @if(!empty($healthTopContent->video_id) || !empty($healthTopContent->podcast_id))--}}
{{--                    <span class="video-audio-icon">--}}
{{--                                            @if(!empty($healthTopContent->video_id))--}}
{{--                            <i class="fa fa-play"></i>--}}
{{--                        @endif--}}
{{--                        @if(!empty($healthTopContent->podcast_id))--}}
{{--                            <i class="fa fa-volume-up"></i>--}}
{{--                        @endif--}}
{{--                                        </span>--}}
{{--                @endif--}}
                @if($healthTopContent->content_sub_heading)
                    {{--                                            <b class="sub-heading">{{ $healthTopContent->content_sub_heading }}</b>--}}
                    <span class="red-text">{{ $healthTopContent->content_sub_heading }}</span>/
                @endif
                {{ $healthTopContent->content_heading }}
            </a>
        </h3>
        <p>{{fFormatDateEn2Bn($healthTopContent->created_at->diffForHumans()) }}</p>
    </div>

    @php($healthOtherContents = $healthContents->all())

    @if($healthOtherContents)
        @foreach($healthOtherContents as $content)
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
