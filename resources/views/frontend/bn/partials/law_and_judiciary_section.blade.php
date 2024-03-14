@if($lawContents)
    <div class="row">
        <div class="col-sm-6">

            @php($lawTopContent = $lawContents->shift())

            @if($lawTopContent)
                @php($sURL = fDesktopURL($lawTopContent->content_id, $lawTopContent->category->cat_slug, ($lawTopContent->subcategory->subcat_slug ?? null), $lawTopContent->content_type))

                <div class="cat-box">
                    <div class="imgbox">
                        <a href="{{ $sURL }}">
                            <img
                                src="{{ $lawTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$lawTopContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                class="img-responsive" alt="{{ $lawTopContent->content_heading }}"
                                title="{{ $lawTopContent->content_heading }}"/>
                            @if(!empty($lawTopContent->video_id))
                                <i class="fa fa-play news-video-icon-lg"></i>
                            @endif
                            @if(!empty($lawTopContent->podcast_id))
                                <i class="fa fa-volume-up news-video-icon-lg"></i>
                            @endif
                        </a>
                    </div>
                    <h3 class="leader">
                        <a href="{{ $sURL }}">
                            @if($lawTopContent->content_sub_heading)
                                {{--<b class="sub-heading">{{ $lawTopContent->content_sub_heading }}</b>--}}
                                <span
                                    class="red-text">{{ $lawTopContent->content_sub_heading }}</span>
                                /
                            @endif
                            {{ $lawTopContent->content_heading }}
                        </a>
                    </h3>

                    <p>
{{--                        @if(!empty($lawTopContent->video_id) || !empty($lawTopContent->podcast_id))--}}
{{--                            <span class="video-audio-icon">--}}
{{--                                                        @if(!empty($lawTopContent->video_id))--}}
{{--                                    <i class="fa fa-play"></i>--}}
{{--                                @endif--}}
{{--                                @if(!empty($lawTopContent->podcast_id))--}}
{{--                                    <i class="fa fa-volume-up"></i>--}}
{{--                                @endif--}}
{{--                                                    </span>--}}
{{--                        @endif--}}
                        {{ $lawTopContent->content_brief }}
                    </p>
                    {{fFormatDateEn2Bn($lawTopContent->created_at->diffForHumans()) }}
                </div>

            @endif

        </div>
        <div class="col-sm-6">
            <div class="row FlexRow">
                @php($lawOtherContents = $lawContents->all())

                @if($lawOtherContents)

                    @foreach($lawOtherContents as $content)
                        @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                        <div class="col-xs-6">
                            <div class="cat-box-sub">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        <img
                                            src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                            class="img-responsive"
                                            alt="{{ $content->content_heading }}"
                                            title="{{ $content->content_heading }}">
                                        @if(!empty($content->video_id))
                                            <i class="fa fa-play news-video-icon-md"></i>
                                        @endif
                                        @if(!empty($content->podcast_id))
                                            <i class="fa fa-volume-up news-video-icon-md"></i>
                                        @endif
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
{{--                                        @if(!empty($content->video_id) || !empty($content->podcast_id))--}}
{{--                                            <span class="video-audio-icon">--}}
{{--                                                                        @if(!empty($content->video_id))--}}
{{--                                                    <i class="fa fa-play"></i>--}}
{{--                                                @endif--}}
{{--                                                @if(!empty($content->podcast_id))--}}
{{--                                                    <i class="fa fa-volume-up"></i>--}}
{{--                                                @endif--}}
{{--                                                                    </span>--}}
{{--                                        @endif--}}
                                        @if($content->content_sub_heading)
                                            {{--                                                                    <b class="sub-heading">{{ $content->content_sub_heading }}</b>--}}
                                            <span
                                                class="red-text">{{ $content->content_sub_heading }}</span>
                                            /
                                        @endif
                                        {{ $content->content_heading }}
                                    </a>
                                </h3>
                                <p> {{fFormatDateEn2Bn($content->created_at->diffForHumans()) }}</p>
                            </div>
                        </div>

                    @endforeach

                @endif
            </div>
        </div>
    </div>
@endif
