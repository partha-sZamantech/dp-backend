<div class="cat-box-with-media rem-first-border special-top-middle">
    @php($technologyTopContent = $technologyContents->shift())
    @php($sURL = fDesktopURL($technologyTopContent->content_id, $technologyTopContent->category->cat_slug, ($technologyTopContent->subcategory->subcat_slug ?? null), $technologyTopContent->content_type))
    <div class="media">
        <a href="{{ $sURL }}">
            <div>
                <img
                    src="{{ $technologyTopContent->img_xs_path ? asset(config('appconfig.contentImagePath').$technologyTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                    class="cat-3-block-image img-responsive"
                    alt="{{ $technologyTopContent->content_heading }}"
                    title="{{ $technologyTopContent->content_heading }}">

                <h4 class="cat3-block-media-heading">
                    @if($technologyTopContent->content_sub_heading)
                        {{--                                                                                                        <b class="sub-heading">{{ $technologyTopContent->content_sub_heading }}</b>--}}
                        <span
                            class="red-text">{{ $technologyTopContent->content_sub_heading }}</span>
                        /
                    @endif
                    {{ $technologyTopContent->content_heading }}
                </h4>
                <span style="font-size: 16px; margin-top: 22px!important;">
                    {!! fGetWord($technologyTopContent->content_details, 25) !!}
                    @if(!empty($technologyTopContent->video_id) || !empty($technologyTopContent->podcast_id))
                        <span class="video-audio-icon">
                            @if(!empty($technologyTopContent->video_id))
                                <i class="fa fa-play"></i>
                            @endif
                            @if(!empty($technologyTopContent->podcast_id))
                                <i class="fa fa-volume-up"></i>
                            @endif
                        </span>
                    @endif
                </span>
                <p style="margin-top:3px">{{fFormatDateEn2Bn($technologyTopContent->created_at->diffForHumans()) }}</p>
            </div>
        </a>
    </div>
</div>
<div class="cat-box-with-media default-height no-left marginTop5">
    <div class="row FlexRow">
        @php($technologyOtherContents = $technologyContents->all())

        @if(count($technologyOtherContents))
            @foreach($technologyOtherContents as $content)
                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                <div class="col-xs-6">
                    <div class="cat-box-sub">
                        <div class="imgbox">
                            <a href="{{ $sURL }}">
                                <img
                                    src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                    class="img-responsive" alt="{{ $content->content_heading }}"
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
{{--                                @if(!empty($content->video_id) || !empty($content->podcast_id))--}}
{{--                                    <span class="video-audio-icon">--}}
{{--                                                            @if(!empty($content->video_id))--}}
{{--                                            <i class="fa fa-play"></i>--}}
{{--                                        @endif--}}
{{--                                        @if(!empty($content->podcast_id))--}}
{{--                                            <i class="fa fa-volume-up"></i>--}}
{{--                                        @endif--}}
{{--                                                        </span>--}}
{{--                                @endif--}}
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
