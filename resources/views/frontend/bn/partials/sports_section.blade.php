<div class="row">
    @if($sportsContents)
        <div class="col-sm-7">
            @php($spTopContent = $sportsContents->shift())
            @if($spTopContent)
                @php($sURL = fDesktopURL($spTopContent->content_id, $spTopContent->category->cat_slug, ($spTopContent->subcategory->subcat_slug ?? null), $spTopContent->content_type))
                <div class="cat-box">
                    <div class="imgbox">
                        <a href="{{ $sURL }}">
                            <img
                                src="{{ $spTopContent->img_bg_path ? asset(config('appconfig.contentImagePath').$spTopContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                class="img-responsive"
                                alt="{{ $spTopContent->content_heading }}"
                                title="{{ $spTopContent->content_heading }}">
                            @if(!empty($spTopContent->video_id))
                                <i class="fa fa-play news-video-icon-lg"></i>
                            @endif
                            @if(!empty($spTopContent->podcast_id))
                                <i class="fa fa-volume-up news-video-icon-lg"></i>
                            @endif
                        </a>
                    </div>
                    <h3 class="leader">
                        <a href="{{ $sURL }}">
                            @if($spTopContent->content_sub_heading)
                                {{--<b class="sub-heading">{{ $spTopContent->content_sub_heading }}</b>--}}
                                <span
                                    class="red-text">{{ $spTopContent->content_sub_heading }}</span>
                                /
                            @endif
                            {{ $spTopContent->content_heading }}
                        </a>
                    </h3>
                    <p>
                        {!! fGetWord($spTopContent->content_details, 45) !!}
                    </p>
                    <p>{{fFormatDateEn2Bn($spTopContent->created_at->diffForHumans()) }}</p>
                </div>
            @endif
        </div>
        <div class="col-sm-5">
            @php($spOtherContents = $sportsContents->all())
            @if($spOtherContents)
                @foreach($spOtherContents as $content)
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
                            <p>{{fFormatDateEn2Bn($content->created_at->diffForHumans()) }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    @endif
</div>
