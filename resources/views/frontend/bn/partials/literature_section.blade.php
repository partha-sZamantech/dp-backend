<div class="cat-box-with-media rem-first-border special-top-middle">
    @if($literatureContents)
        @php($literatureTopContent = $literatureContents->shift())
        @php($sURL = fDesktopURL($literatureTopContent->content_id, $literatureTopContent->category->cat_slug, ($literatureTopContent->subcategory->subcat_slug ?? null), $literatureTopContent->content_type))
        <div class="media">
            <a href="{{ $sURL }}">
                <div>
                    <img
                        src="{{ $literatureTopContent->img_xs_path ? asset(config('appconfig.contentImagePath').$literatureTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                        class="cat-3-block-image img-responsive"
                        alt="{{ $literatureTopContent->content_heading }}"
                        title="{{ $literatureTopContent->content_heading }}">

                    <h4 class="cat3-block-media-heading">
                        @if($literatureTopContent->content_sub_heading)
                            {{--                                                                                                        <b class="sub-heading">{{ $literatureTopContent->content_sub_heading }}</b>--}}
                            <span
                                class="red-text">{{ $literatureTopContent->content_sub_heading }}</span>
                            /
                        @endif
                        {{ $literatureTopContent->content_heading }}
                    </h4>
                    <span style="font-size: 16px; margin-top: 22px!important;">
                        {!! fGetWord($literatureTopContent->content_details, 25) !!}
                        @if(!empty($literatureTopContent->video_id) || !empty($literatureTopContent->podcast_id))
                            <span class="video-audio-icon">
                                @if(!empty($literatureTopContent->video_id))
                                    <i class="fa fa-play"></i>
                                @endif
                                @if(!empty($literatureTopContent->podcast_id))
                                    <i class="fa fa-volume-up"></i>
                                @endif
                            </span>
                        @endif
                    </span>
                </div>
            </a>
        </div>
    @endif
</div>
<div class="cat-box-with-media default-height no-left marginTop5">
    <div class="row FlexRow">
        @if($literatureContents)
            @php($literatureOtherContents = $literatureContents->all())

            @if(count($literatureOtherContents))
                @foreach($literatureOtherContents as $content)
                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                    <div class="col-xs-6">
                        <div class="cat-box-sub">
                            <div class="imgbox">
                                <a href="{{ $sURL }}">
                                    <img
                                        src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                        class="img-responsive" alt="{{ $content->content_heading }}"
                                        title="{{ $content->content_heading }}">
                                </a>
                                @if(!empty($content->video_id))
                                    <i class="fa fa-play news-video-icon-md"></i>
                                @endif
                                @if(!empty($content->podcast_id))
                                    <i class="fa fa-volume-up news-video-icon-md"></i>
                                @endif
                            </div>
                            <h3>
                                <a href="{{ $sURL }}">
{{--                                    @if(!empty($content->video_id) || !empty($content->podcast_id))--}}
{{--                                        <span class="video-audio-icon">--}}
{{--                                                                @if(!empty($content->video_id))--}}
{{--                                                <i class="fa fa-play"></i>--}}
{{--                                            @endif--}}
{{--                                            @if(!empty($content->podcast_id))--}}
{{--                                                <i class="fa fa-volume-up"></i>--}}
{{--                                            @endif--}}
{{--                                                            </span>--}}
{{--                                    @endif--}}
                                    @if($content->content_sub_heading)
                                        {{--<b class="sub-heading">{{ $content->content_sub_heading }}</b>--}}
                                        <span
                                            class="red-text">{{ $content->content_sub_heading }}</span>
                                        /
                                    @endif
                                    {{ $content->content_heading }}
                                </a>
                            </h3>
                        </div>
                    </div>
                @endforeach
            @endif
        @endif
    </div>
</div>
