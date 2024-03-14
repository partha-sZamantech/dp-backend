<div class="special-box">

    @if($specialTopContents)
        <div class="row">
            @php($spTopContent = $specialTopContents->shift())

            <div class="col-sm-7 lead">

                @if($spTopContent)

                    @php($sURL = fDesktopURL($spTopContent->content_id, $spTopContent->category->cat_slug, ($spTopContent->subcategory->subcat_slug ?? null), $spTopContent->content_type))
                    <div class="imgbox">
                        <a href="{{ $sURL }}" title="{{ $spTopContent->content_heading }}">
                            <img
                                src="{{ $spTopContent->img_bg_path ? asset(config('appconfig.contentImagePath').$spTopContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                class="img-responsive" alt="{{ $spTopContent->content_heading }}"
                                title="{{ $spTopContent->content_heading }}">
                            @if(!empty($spTopContent->video_id))
                                <i class="fa fa-play news-video-icon-lg"></i>
                            @endif
                            @if(!empty($spTopContent->podcast_id))
                                <i class="fa fa-volume-up news-video-icon-lg"></i>
                            @endif
                        </a>
                    </div>
                    <h3>
                        <a href="{{ $sURL }}" title="{{ $spTopContent->content_heading }}">
                            @if($spTopContent->content_sub_heading)
                                {{--                                                    <b class="sub-heading">{{ $spTopContent->content_sub_heading }}</b>--}}
                                <span
                                    class="red-text">{{ $spTopContent->content_sub_heading }}</span>
                                /
                            @endif
                            {{ $spTopContent->content_heading }}
                        </a>
                    </h3>
                    <p style="font-size: 18px; margin-bottom: 8px">
                        {!! fGetWord(fFormatString($spTopContent->content_details), 25) !!}
                    </p>
                    <p style="font-size: 15px;">
                        {{ $spTopContent->category->cat_name_bn }} | {{fFormatDateEn2Bn($spTopContent->created_at->diffForHumans()) }}
                    </p>
                @endif
                {{-- Mobile Home Two Ad --}}
                @if(isMobile())
                    @include('frontend.bn.mobile-ads.home.mobile-2-ad')
                @endif
            </div>

            @php($spTopRightThreeContents = $specialTopContents->splice(0,4))
            <div class="col-sm-5">
                @foreach($spTopRightThreeContents as $content)
                    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                        <div class="row news-top-middle-other">
                            <div class="col-md-5 col-sm-5 col-xs-5">
                                <a href="{{ $sURL }}">
                                    <div class="imgbox-sm">
                                        <img
                                            src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                            class="img-responsive" alt="{{ $content->content_heading }}"
                                            title="{{ $content->content_heading }}">
                                        @if(!empty($content->video_id))
                                            <i class="fa fa-play news-video-icon-sm"></i>
                                        @endif
                                        @if(!empty($content->podcast_id))
                                            <i class="fa fa-volume-up news-video-icon-sm"></i>
                                        @endif
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <h4 class="media-heading">
                                    <a href="{{ $sURL }}">
                                        @if($content->content_sub_heading)
                                        {{--<b class="sub-heading">{{ $content->content_sub_heading }}</b>--}}
                                            <span class="red-text">{{ $content->content_sub_heading }}</span>/
                                        @endif
                                        {{ $content->content_heading }}
                                    </a>
                                </h4>
                                {{ $content->category->cat_name_bn }} | {{fFormatDateEn2Bn($content->created_at->diffForHumans()) }}
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
