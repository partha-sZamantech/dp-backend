<div class="special-box">

    @if($specialTopContents)
        {{-- Middle 1 Ad --}}
        @if(!isMobile())
            @include('frontend.bn.ads.home.middle-1-ad')
        @endif

        <div class="row special-sub FlexRow partha-special">

            @php($spOtherContents = $specialTopContents->splice(0, 6))

            @if($spOtherContents)

                @foreach($spOtherContents as $content)

                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                    <div class="col-sm-4 col-xs-6">
                        <div class="single_sub">
                            <div class="imgbox">
                                <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                    <img
                                        src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
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
                            <div class="p-heading">
                                <h4  style="margin-bottom: 3px; line-height: 1.3">
                                    <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                        @if($content->content_sub_heading)
                                            {{--                                                            <b class="sub-heading">{{ $content->content_sub_heading }}</b>--}}
                                            <span
                                                class="red-text">{{ $content->content_sub_heading }}</span>
                                            /
                                        @endif
                                        {{ $content->content_heading }}
                                    </a>
                                </h4>
                            </div>
                            <div class="p-body">
                                <p style="font-size: 16px">
                                    <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
{{--                                        {{ fGetWord($content->content_brief, 15) }}--}}
{{--                                        {{ fGetWord($content->content_brief, 10) }}--}}
                                        {{Str::limit($content->content_brief, 80)}}
                                    </a>
                                </p>
                            </div>

                            <p class="p-date" style="font-size: 15px;">
                                {{ $content->category->cat_name_bn }} | {{fFormatDateEn2Bn($content->created_at->diffForHumans()) }}
                            </p>
                        </div>
                    </div>
                    @if($loop->iteration == 4)
                        {{-- Mobile Home Five Ad --}}
                        @if(isMobile())
                            @include('frontend.bn.mobile-ads.home.mobile-5-ad')
                        @endif
                    @endif
                @endforeach

            @endif

        </div>
    @endif
</div>
