@if($artCulContents->count())
    @php($acTopContent = $artCulContents->shift())
    @php($sURL = fDesktopURL($acTopContent->content_id, $acTopContent->category->cat_slug, ($acTopContent->subcategory->subcat_slug ?? null), $acTopContent->content_type))
    <div class="cat-box">
        <div class="imgbox">
            <a href="{{ $sURL }}">
                <img
                    src="{{ $acTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$acTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                    class="img-responsive" alt="{{ $acTopContent->content_heading }}"
                    title="{{ $acTopContent->content_heading }}">
                @if(!empty($acTopContent->video_id))
                    <i class="fa fa-play news-video-icon-md"></i>
                @endif
                @if(!empty($acTopContent->podcast_id))
                    <i class="fa fa-volume-up news-video-icon-md"></i>
                @endif
            </a>
        </div>
        <h3>
            <a href="{{ $sURL }}">
{{--                @if(!empty($acTopContent->video_id) || !empty($acTopContent->podcast_id))--}}
{{--                    <span class="video-audio-icon">--}}
{{--                                            @if(!empty($acTopContent->video_id))--}}
{{--                            <i class="fa fa-play"></i>--}}
{{--                        @endif--}}
{{--                        @if(!empty($acTopContent->podcast_id))--}}
{{--                            <i class="fa fa-volume-up"></i>--}}
{{--                        @endif--}}
{{--                                        </span>--}}
{{--                @endif--}}
                @if($acTopContent->content_sub_heading)
                    {{--                                            <b class="sub-heading">{{ $acTopContent->content_sub_heading }}</b>--}}
                    <span class="red-text">{{ $acTopContent->content_sub_heading }}</span>/
                @endif
                {{ $acTopContent->content_heading }}
            </a>
        </h3>
        <p>{{fFormatDateEn2Bn($acTopContent->created_at->diffForHumans()) }}</p>
    </div>

    @php($acOtherContents = $artCulContents->all())

    @if(count($acOtherContents))
        @foreach($acOtherContents as $content)
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
