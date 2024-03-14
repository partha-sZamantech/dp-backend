@if($entertainmentContents)
    <div class="row">
        <div class="col-sm-6">

            @php($entTopContent = $entertainmentContents->shift())

            @if($entTopContent)
                @php($sURL = fDesktopURL($entTopContent->content_id, $entTopContent->category->cat_slug, ($entTopContent->subcategory->subcat_slug ?? null), $entTopContent->content_type))

                <div class="cat-box">
                    <div class="imgbox">
                        <a href="{{ $sURL }}">
                            <img
                                src="{{ $entTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$entTopContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                class="img-responsive" alt="{{ $entTopContent->content_heading }}"
                                title="{{ $entTopContent->content_heading }}"/>
                            @if(!empty($entTopContent->video_id))
                                <i class="fa fa-play news-video-icon-lg"></i>
                            @endif
                            @if(!empty($entTopContent->podcast_id))
                                <i class="fa fa-volume-up news-video-icon-lg"></i>
                            @endif
                        </a>
                    </div>
                    <h3 class="leader">
                        <a href="{{ $sURL }}">
                            @if($entTopContent->content_sub_heading)
                                {{--<b class="sub-heading">{{ $entTopContent->content_sub_heading }}</b>--}}
                                <span
                                    class="red-text">{{ $entTopContent->content_sub_heading }}</span>
                                /
                            @endif
                            {{ $entTopContent->content_heading }}
                        </a>
                    </h3>
                    <p>
{{--                        @if(!empty($entTopContent->video_id) || !empty($entTopContent->podcast_id))--}}
{{--                            <span class="video-audio-icon">--}}
{{--                                                        @if(!empty($entTopContent->video_id))--}}
{{--                                    <i class="fa fa-play"></i>--}}
{{--                                @endif--}}
{{--                                @if(!empty($entTopContent->podcast_id))--}}
{{--                                    <i class="fa fa-volume-up"></i>--}}
{{--                                @endif--}}
{{--                                                    </span>--}}
{{--                        @endif--}}
                        {{ $entTopContent->content_brief }}
                    </p>
                    <p>{{fFormatDateEn2Bn($entTopContent->created_at->diffForHumans()) }}</p>
                </div>

            @endif

        </div>

        <div class="col-sm-6">
            <div class="row FlexRow">
                @php($entOtherContents = $entertainmentContents->all())

                @if($entOtherContents)

                    @foreach($entOtherContents as $content)
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
                                            {{--<b class="sub-heading">{{ $content->content_sub_heading }}</b>--}}
                                            <span
                                                class="red-text">{{ $content->content_sub_heading }}</span>
                                            /
                                        @endif
                                        {{ $content->content_heading }}
                                    </a>
                                </h3>
                                <p>{{fFormatDateEn2Bn($content->created_at->diffForHumans()) }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endif
