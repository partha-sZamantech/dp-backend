<div class="padma-special" style="padding-top: 0;">
    <div class="container">
        <div class="special-box special-event-section">
            <div class="padma-special-title">
                <a href="https://www.dhakaprokash24.com/topic/পদ্মা-সেতু" target="_blank" rel="nofollow">
                    <div class="special-event-title marginTop20">
                        <div class="desktop-image">
                            <img src="{{ asset('media/common/padma_special_1270.jpg') }}" alt="Inauguration of Padma">
                        </div>
                        <div class="mobile-image">
                            <img src="{{ asset('media/common/padma_special_mobile_570.png') }}" alt="Inauguration of Padma">
                        </div>
                    </div>
                </a>
{{--                <div id="countdown" class="img-responsive" style="display: none">--}}
{{--                    <span><i class="remaining">স্বপ্নপূরণের  আর মাত্র</i><br></span>--}}
{{--                    <span class="days time"><strong id="timerDay"></strong> <br><i class="padma-day">দিন</i></span>--}}
{{--                    <span class="hours time"><strong id="timerHour"></strong> <br><i class="padma-day">ঘণ্টা</i></span>--}}
{{--                    <span class="minutes time"><strong id="timerMinute"></strong> <br><i class="padma-day">মিনিট</i></span>--}}
{{--                    <span class="seconds time"><strong id="timerSecond"></strong> <br><i class="padma-day"> সেকেন্ড</i></span>--}}
{{--                </div>--}}

            </div>
            <div class="row marginTop10">
                <div class="col-md-6">
                    <div class="special-top-video-section">
                        @if($bnSpecialEventVideos->count())
                            @php($spEventFirstVideo = $bnSpecialEventVideos->shift())
                            @if($spEventFirstVideo->is_live == 1)
                                @if($spEventFirstVideo->type == 1)
                                    <iframe width="780" height="352" src="https://www.youtube.com/embed/{{ $spEventFirstVideo->code }}?enablejsapi=1&autoplay=1&mute=1&rel=0&showinfo=1&controls=1&loop=1&playlist={{$spEventFirstVideo->code}}" frameborder="0" allowfullscreen></iframe>
                                @elseif($spEventFirstVideo->type == 2)
                                    <div class="fb-video" data-href="https://www.facebook.com/watch/?v={{$spEventFirstVideo->code}}" data-width="auto" data-autoplay="true" data-show-captions="false"> </div>
                                @endif
                            @else
                                @php($videoUrl = $spEventFirstVideo->target == 2 && $spEventFirstVideo->type == 1 ? ('https://www.youtube.com/watch?v='.$spEventFirstVideo->code) : ($spEventFirstVideo->target == 2 && $spEventFirstVideo->type == 2 ? ('https://www.facebook.com/dhakaprokash24/videos/'.$spEventFirstVideo->code) : fVideoURL($spEventFirstVideo->id, $spEventFirstVideo->category->slug)))
                                <a style="margin-bottom: 20px; cursor: pointer" href="{{$videoUrl}}" target="_blank" rel="nofollow">
                                    <img src="{{ asset(config('appconfig.videoImagePath').$spEventFirstVideo->img_bg_path) }}" alt="{{ $spEventFirstVideo->title }}" style="width: 100%" />
                                    <i class="fa fa-play" style="font-size: 20px"></i>
                                    <h4 style="font-size: 25px">
                                        {{ $spEventFirstVideo->title }}
                                    </h4>
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        @if($specialArrangementContents)
                            @foreach($specialArrangementContents as $content)
                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                <div class="col-sm-6">
                                    <div class="cat-box-with-media rem-first-border special-top-middle" style="margin-bottom: 10px!important;">
                                        <div class="media">
                                            <a href="{{ $sURL }}">
                                                <div>
                                                    <img
                                                        src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                                        class="img-responsive" alt="{{ $content->content_heading }}"
                                                        title="{{ $content->content_heading }}">

                                                    <h4 class="media-heading">
                                                        @if($content->content_sub_heading)
                                                            <span class="red-text">{{ $content->content_sub_heading }}</span>/
                                                        @endif
                                                        {{ $content->content_heading }}
                                                    </h4>
                                                </div>
                                                <div style="clear: both; display: block">
                                            <span style="font-size: 16px;">
{{--                                                            {{ fGetWord($content->content_brief, 10) }}--}}
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
                                            </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @if($loop->iteration < $loop->count && $loop->iteration%2 == 0)
                                    </div>
                                    <div class="row">
                                @endif
                            @endforeach

                        @endif
                    </div>
                </div>
{{--                <div class="col-md-3">--}}
{{--                    @php($specialArrangementContentsOne = $specialArrangementContents->splice(0, 4))--}}
{{--                    @if($specialArrangementContentsOne)--}}
{{--                        <div class="cat-box-with-media rem-first-border special-top-middle">--}}
{{--                            @foreach($specialArrangementContentsOne as $content)--}}
{{--                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))--}}
{{--                                <div class="media">--}}
{{--                                    <a href="{{ $sURL }}">--}}
{{--                                        <div>--}}
{{--                                            <img--}}
{{--                                                src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"--}}
{{--                                                class="img-responsive" alt="{{ $content->content_heading }}"--}}
{{--                                                title="{{ $content->content_heading }}">--}}

{{--                                            <h4 class="media-heading">--}}
{{--                                                @if($content->content_sub_heading)--}}
{{--                                                    <span class="red-text">{{ $content->content_sub_heading }}</span>/--}}
{{--                                                @endif--}}
{{--                                                {{ $content->content_heading }}--}}
{{--                                            </h4>--}}
{{--                                        </div>--}}
{{--                                        <div style="clear: both; display: block">--}}
{{--                                            <span style="font-size: 16px;">--}}
{{--                                                            {{ fGetWord($content->content_brief, 10) }}--}}
{{--                                                @if(!empty($content->video_id) || !empty($content->podcast_id))--}}
{{--                                                    <span class="video-audio-icon">--}}
{{--                                                @if(!empty($content->video_id))--}}
{{--                                                            <i class="fa fa-play"></i>--}}
{{--                                                        @endif--}}
{{--                                                        @if(!empty($content->podcast_id))--}}
{{--                                                            <i class="fa fa-volume-up"></i>--}}
{{--                                                        @endif--}}
{{--                                                </span>--}}
{{--                                                @endif--}}
{{--                                            </span>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                <div class="col-md-3">--}}
{{--                    @php($specialArrangementContentsTwo = $specialArrangementContents->splice(0, 4))--}}
{{--                    @if($specialArrangementContentsTwo)--}}
{{--                        <div class="cat-box-with-media rem-first-border special-top-middle">--}}
{{--                            @foreach($specialArrangementContentsTwo as $content)--}}
{{--                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))--}}
{{--                                <div class="media">--}}
{{--                                    <a href="{{ $sURL }}">--}}
{{--                                        <div>--}}
{{--                                            <img--}}
{{--                                                src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"--}}
{{--                                                class="img-responsive" alt="{{ $content->content_heading }}"--}}
{{--                                                title="{{ $content->content_heading }}">--}}

{{--                                            <h4 class="media-heading">--}}
{{--                                                @if($content->content_sub_heading)--}}
{{--                                                    <span class="red-text">{{ $content->content_sub_heading }}</span>/--}}
{{--                                                @endif--}}
{{--                                                {{ $content->content_heading }}--}}
{{--                                            </h4>--}}
{{--                                        </div>--}}
{{--                                        <div style="clear: both; display: block">--}}
{{--                                            <span style="font-size: 16px;">--}}
{{--                                                            {{ fGetWord($content->content_brief, 10) }}--}}
{{--                                                @if(!empty($content->video_id) || !empty($content->podcast_id))--}}
{{--                                                    <span class="video-audio-icon">--}}
{{--                                                @if(!empty($content->video_id))--}}
{{--                                                            <i class="fa fa-play"></i>--}}
{{--                                                        @endif--}}
{{--                                                        @if(!empty($content->podcast_id))--}}
{{--                                                            <i class="fa fa-volume-up"></i>--}}
{{--                                                        @endif--}}
{{--                                                </span>--}}
{{--                                                @endif--}}
{{--                                            </span>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</div>

<style>
    /*Padma Special*/
    .padma-special {
        position: relative;
        background-color: #FBEBE9;
        border-bottom: 2px solid #A8B6C1;
    }

    .special-box hr {
        width: 100%;
        height: 4px;
        background: #942824;
        margin-top: 0px!important;
        margin-bottom: 5px!important;
    }

    .padma-special-title {
        position: relative;
    }

    /* Countdown */
    #countdown {
        padding: 3px 5px;
        background-color: rgba(255, 255, 255, .5);
        position: absolute;
        right: 30px;
        color: red !important;
        font-size: 16px !important;
        top: 62px !important;
        line-height: 22px !important;
        padding-right: 10px;
        font-weight: 700;
        border-radius: 4px;
    }

    .remaining {
        font-weight: bold !important;
        /*color: #b0275f !important;*/
        color: #4753fb !important;
        font-size: 18px !important;
    }

    .padma-day {
        font-style: normal;
        color: #222 !important;
        font-size: 17px !important;
        font-weight: normal;
    }

    #countdown .time {
        display: inline-block;
        padding: 0 4px !important;
    }

    #timerDay, #timerHour, #timerMinute, #timerSecond {
        font-size: 20px;
    }

    .mobile-image {
        display: none;
    }

    /*For countdowm*/
    @media (max-width: 1183px) {
        .re  cmaining {
            font-size: 12px !important;
        }

        #countdown {
            padding: 0px 0px;
            background-color: rgba(255, 255, 255, .5);
            position: absolute;
            right: 4px;
            color: red !important;
            font-size: 16px !important;
            top: 32px !important;
            line-height: 15px !important;
            padding-right: 10px;
            font-weight: 700;
            border-radius: 4px;
        }

        .padma-day {
            color: #222 !important;
            font-size: 12px !important;
         65   font-weight: normal;
        }

        #timerDay, #timerHour, #timerMinute, #timerSecond {
            font-size: 14px!important;
        }

    }

    @media (max-width: 500px) {
        .mobile-image {
            display: block;
        }

        .desktop-image {
            display: none;
        }
    }
</style>=
