<div class="eid-special marginTop10" style="padding-top: 0;">
    <div class="container">
        <div class="special-box special-event-section">
            <a href="#" target="_blank" rel="nofollow">
                <div class="special-event-title marginTop20">
                    <div class="desktop-image">
                        <img src="{{ asset('media/common/eid_special_1270.jpg') }}" alt="Eid Ul Adha">
                    </div>
                    <div class="mobile-image">
                        <img src="{{ asset('media/common/eid_special_mobile_500.jpg') }}" alt="Eid Ul Adha">
                    </div>
                </div>
            </a>
            <div class="row marginTop10">
                <div class="col-md-6">
                    <div class="special-top-video-section">
                        @if($bnSpecialEventVideos->count())
                            @php($spEventFirstVideo = $bnSpecialEventVideos->shift())
                            @if($spEventFirstVideo->is_live == 1)
                                @if($spEventFirstVideo->type == 1)
                                    <iframe width="780" height="352"
                                            src="https://www.youtube.com/embed/{{ $spEventFirstVideo->code }}?enablejsapi=1&autoplay=1&mute=1&rel=0&showinfo=1&controls=1&loop=1&playlist={{ $spEventFirstVideo->code }}"
                                            frameborder="0" allowfullscreen></iframe>
                                @elseif($spEventFirstVideo->type == 2)
                                    <div class="fb-video"
                                         data-href="https://www.facebook.com/watch/?v={{$spEventFirstVideo->code}}"
                                         data-width="auto" data-autoplay="true" data-show-captions="false"></div>
                                @endif
                                <div class="eid-video-title">
                                    <h4 style="margin-bottom: 10px; line-height: 1.2; font-size: 22px; margin-left: 5px; color: white">
                                        {{ $spEventFirstVideo->title }}
                                    </h4>
                                </div>
                            @else
                                @php($videoUrl = $spEventFirstVideo->target == 2 && $spEventFirstVideo->type == 1 ? ('https://www.youtube.com/watch?v='.$spEventFirstVideo->code) : ($spEventFirstVideo->target == 2 && $spEventFirstVideo->type == 2 ? ('https://www.facebook.com/dhakaprokash24/videos/'.$spEventFirstVideo->code) : fVideoURL($spEventFirstVideo->id, $spEventFirstVideo->category->slug)))
                                <a style="margin-bottom: 20px; cursor: pointer" href="{{$videoUrl}}" target="_blank"
                                   rel="nofollow">
                                    <img
                                        src="{{ asset(config('appconfig.videoImagePath').$spEventFirstVideo->img_bg_path) }}"
                                        alt="{{ $spEventFirstVideo->title }}" style="width: 100%"/>
                                    <div class="eid-video-title">
                                        <i class="fa fa-play"></i>
                                        <h4 style="margin-bottom: 10px; line-height: 1.2; font-size: 25px; margin-left: 5px;">
                                            {{ $spEventFirstVideo->title }}
                                        </h4>
                                    </div>
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    @if($specialArrangementContents)
                        <div class="row special-sub FlexRow">
                            @foreach($specialArrangementContents->take(4) as $content)
                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
{{--                                @if($loop->index == 0 || $loop->index == 1)--}}
                                    <div class="col-sm-6">
                                        <div class="single_sub">
                                            <div class="imgbox">
                                                <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                    <img
                                                        src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                                        class="img-responsive" alt="{{ $content->content_heading }}"
                                                        title="{{ $content->content_heading }}">
                                                </a>
                                            </div>
                                            <h4 class="eid_special_video_content_heading"
                                                style="margin-bottom: 3px; line-height: 1.2; font-size: 20px">
                                                <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                    {{ $content->content_heading }}
                                                </a>
                                            </h4>
{{--                                            @if($loop->index == 1)--}}
{{--                                                <h4 class="visible-xs">--}}
{{--                                                    <a href="{{ $sURL }}" title="{{ $content->content_heading }}">--}}
{{--                                                        {{ $content->content_heading }}--}}
{{--                                                    </a>--}}
{{--                                                </h4>--}}
{{--                                            @endif--}}
                                        </div>
                                    </div>
{{--                                @else--}}
{{--                                    <div class="col-sm-4 col-xs-6">--}}
{{--                                        <div class="single_sub">--}}
{{--                                            <div class="imgbox">--}}
{{--                                                <a href="{{ $sURL }}" title="{{ $content->content_heading }}">--}}
{{--                                                    <img--}}
{{--                                                        src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"--}}
{{--                                                        class="img-responsive"--}}
{{--                                                        alt="{{ $content->content_heading }}"--}}
{{--                                                        title="{{ $content->content_heading }}">--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                            <h4 style="margin-bottom: 3px; line-height: 1.2; font-size: 18px">--}}
{{--                                                <a href="{{ $sURL }}" title="{{ $content->content_heading }}">--}}
{{--                                                    {{ $content->content_heading }}--}}
{{--                                                </a>--}}
{{--                                            </h4>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
