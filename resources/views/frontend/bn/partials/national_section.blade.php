<div class="row">
    @if($nationalContents)
        <div class="col-sm-7">
            @php($nlMainContent = $nationalContents->shift())
            @if($nlMainContent)
                @php($sURL = fDesktopURL($nlMainContent->content_id, $nlMainContent->category->cat_slug, ($nlMainContent->subcategory->subcat_slug ?? null), $nlMainContent->content_type))
                <div class="cat-box">
                    <div class="imgbox">
                        <a href="{{ $sURL }}">
                            <img
                                src="{{ $nlMainContent->img_bg_path ? asset(config('appconfig.contentImagePath').$nlMainContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                class="img-responsive"
                                alt="{{ $nlMainContent->content_heading }}"
                                title="{{ $nlMainContent->content_heading }}">
                            @if(!empty($nlMainContent->video_id))
                                <i class="fa fa-play news-video-icon-lg"></i>
                            @endif
                            @if(!empty($nlMainContent->podcast_id))
                                <i class="fa fa-volume-up news-video-icon-lg"></i>
                            @endif
                        </a>
                    </div>
                    <h3 class="leader">
                        <a href="{{ $sURL }}">
                            @if($nlMainContent->content_sub_heading)
                                {{--                                                                <b class="sub-heading">{{ $nlMainContent->content_sub_heading }}</b>--}}
                                <span
                                    class="red-text">{{ $nlMainContent->content_sub_heading }}</span>
                                /
                            @endif
                            {{ $nlMainContent->content_heading }}
                        </a>
                    </h3>
                    <p>
                        {{ $nlMainContent->content_brief }}
                    </p>
                    <p style="font-size: 15px;">
                        {{fFormatDateEn2Bn($nlMainContent->created_at->diffForHumans()) }}
                    </p>
                </div>
            @endif
        </div>

        <div class="col-sm-5">
                @php($nlOtherContents = $nationalContents->all())
                @if($nlOtherContents)
                    @foreach($nlOtherContents as $content)
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
                                   {{fFormatDateEn2Bn($content->created_at->diffForHumans()) }}
                                </div>

                            </div>
                    @endforeach
                @endif
        </div>
    @endif
</div>
