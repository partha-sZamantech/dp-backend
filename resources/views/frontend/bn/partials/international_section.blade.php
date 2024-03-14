@if($internationalContents)
    @php($intTopContent = $internationalContents->shift())
    @if($intTopContent)
        @php($sURL = fDesktopURL($intTopContent->content_id, $intTopContent->category->cat_slug, ($intTopContent->subcategory->subcat_slug ?? null), $intTopContent->content_type))
        <div class="cat-box">
            <div class="imgbox">
                <a href="{{ $sURL }}">
                    <img
                        src="{{ $intTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$intTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                        class="img-responsive"
                        alt="{{ $intTopContent->content_heading }}"
                        title="{{ $intTopContent->content_heading }}">
                    @if(!empty($intTopContent->video_id))
                        <i class="fa fa-play news-video-icon-md"></i>
                    @endif
                    @if(!empty($intTopContent->podcast_id))
                        <i class="fa fa-volume-up news-video-icon-md"></i>
                    @endif
                </a>
            </div>
            <h3>
                <a href="{{ $sURL }}">
                    @if($intTopContent->content_sub_heading)
                        {{--                                                        <b class="sub-heading">{{ $intTopContent->content_sub_heading }}</b>--}}
                        <span
                            class="red-text">{{ $intTopContent->content_sub_heading }}</span>
                        /
                    @endif
                    {{ $intTopContent->content_heading }}
                </a>
            </h3>
            {{fFormatDateEn2Bn($intTopContent->created_at->diffForHumans()) }}
        </div>
    @endif

    @php($intOtherContents = $internationalContents->all())

    @if($intOtherContents)
        @foreach($intOtherContents as $content)
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
