@if($economyContents)
    @php($ecTopContent = $economyContents->shift())
    @php($sURL = fDesktopURL($ecTopContent->content_id, $ecTopContent->category->cat_slug, ($ecTopContent->subcategory->subcat_slug ?? null), $ecTopContent->content_type))
    <div class="cat-box">
        <div class="imgbox">
            <a href="{{ $sURL }}">
                <img
                    src="{{ $ecTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$ecTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                    class="img-responsive" alt="{{ $ecTopContent->content_heading }}"
                    title="{{ $ecTopContent->content_heading }}">
                @if(!empty($ecTopContent->video_id))
                    <i class="fa fa-play news-video-icon-md"></i>
                @endif
                @if(!empty($ecTopContent->podcast_id))
                    <i class="fa fa-volume-up news-video-icon-md"></i>
                @endif
            </a>
        </div>
        <h3>
            <a href="{{ $sURL }}">
                @if($ecTopContent->content_sub_heading)
                    {{--                                                    <b class="sub-heading">{{ $ecTopContent->content_sub_heading }}</b>--}}
                    <span
                        class="red-text">{{ $ecTopContent->content_sub_heading }}</span>
                    /
                @endif
                {{ $ecTopContent->content_heading }}
            </a>
        </h3>
        {{ $ecTopContent->category->cat_name_bn }} | {{fFormatDateEn2Bn($ecTopContent->created_at->diffForHumans()) }}
    </div>

    @php($ecOtherContents = $economyContents->all())

    @if($ecOtherContents)
        @foreach($ecOtherContents as $content)
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
                                {{--                                                    <b class="sub-heading">{{ $ecTopContent->content_sub_heading }}</b>--}}
                                <span
                                    class="red-text">{{ $content->content_sub_heading }}</span>
                                /
                            @endif
                            {{ $content->content_heading }}
                        </a>
                    </h4>
                </div>
            </div>
        @endforeach
    @endif
@endif
