@if($corporateContents->count())
    @php($corporateTopContent = $corporateContents->shift())
    @php($sURL = fDesktopURL($corporateTopContent->content_id, $corporateTopContent->category->cat_slug, ($corporateTopContent->subcategory->subcat_slug ?? null), $corporateTopContent->content_type))
    <div class="cat-box">
        <div class="imgbox">
            <a href="{{ $sURL }}">
                <img
                    src="{{ $corporateTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$corporateTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                    class="img-responsive" alt="{{ $corporateTopContent->content_heading }}"
                    title="{{ $corporateTopContent->content_heading }}">
                @if(!empty($corporateTopContent->video_id))
                    <i class="fa fa-play news-video-icon-md"></i>
                @endif
                @if(!empty($corporateTopContent->podcast_id))
                    <i class="fa fa-volume-up news-video-icon-md"></i>
                @endif
            </a>
        </div>
        <h3>
            <a href="{{ $sURL }}">
{{--                @if(!empty($corporateTopContent->video_id) || !empty($corporateTopContent->podcast_id))--}}
{{--                    <span class="video-audio-icon">--}}
{{--                        @if(!empty($corporateTopContent->video_id))--}}
{{--                            <i class="fa fa-play"></i>--}}
{{--                        @endif--}}
{{--                        @if(!empty($corporateTopContent->podcast_id))--}}
{{--                            <i class="fa fa-volume-up"></i>--}}
{{--                        @endif--}}
{{--                    </span>--}}
{{--                @endif--}}
                @if($corporateTopContent->content_sub_heading)
                    {{--<b class="sub-heading">{{ $corporateTopContent->content_sub_heading }}</b>--}}
                    <span class="red-text">{{ $corporateTopContent->content_sub_heading }}</span>/
                @endif
                {{ $corporateTopContent->content_heading }}
            </a>
        </h3>
        <p>{{fFormatDateEn2Bn($corporateTopContent->created_at->diffForHumans()) }}</p>
    </div>

    @php($corporateOtherContents = $corporateContents->all())

    @if($corporateOtherContents)
        @foreach($corporateOtherContents as $content)
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
