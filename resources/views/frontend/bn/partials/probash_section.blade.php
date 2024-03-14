@if($probashContents->count())
    @php($probashTopContent = $probashContents->shift())
    @php($sURL = fDesktopURL($probashTopContent->content_id, $probashTopContent->category->cat_slug, ($probashTopContent->subcategory->subcat_slug ?? null), $probashTopContent->content_type))
    <div class="cat-box">
        <div class="imgbox">
            <a href="{{ $sURL }}">
                <img
                    src="{{ $probashTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$probashTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                    class="img-responsive" alt="{{ $probashTopContent->content_heading }}"
                    title="{{ $probashTopContent->content_heading }}">
                @if(!empty($probashTopContent->video_id))
                    <i class="fa fa-play news-video-icon-md"></i>
                @endif
                @if(!empty($probashTopContent->podcast_id))
                    <i class="fa fa-volume-up news-video-icon-md"></i>
                @endif
            </a>
        </div>
        <h3>
            <a href="{{ $sURL }}">
{{--                @if(!empty($probashTopContent->video_id) || !empty($probashTopContent->podcast_id))--}}
{{--                    <span class="video-audio-icon">--}}
{{--                                            @if(!empty($probashTopContent->video_id))--}}
{{--                            <i class="fa fa-play"></i>--}}
{{--                        @endif--}}
{{--                        @if(!empty($probashTopContent->podcast_id))--}}
{{--                            <i class="fa fa-volume-up"></i>--}}
{{--                        @endif--}}
{{--                                        </span>--}}
{{--                @endif--}}
                @if($probashTopContent->content_sub_heading)
                    {{--                                            <b class="sub-heading">{{ $probashTopContent->content_sub_heading }}</b>--}}
                    <span class="red-text">{{ $probashTopContent->content_sub_heading }}</span>/
                @endif
                {{ $probashTopContent->content_heading }}
            </a>
        </h3>
        <p>{{fFormatDateEn2Bn($probashTopContent->created_at->diffForHumans()) }}</p>
    </div>

    @php($probashOtherContents = $probashContents->all())

    @if($probashOtherContents)
        @foreach($probashOtherContents as $content)
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
