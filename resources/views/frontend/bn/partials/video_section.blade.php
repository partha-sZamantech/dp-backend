<div class="row marginBottom20">
    <div class="col-sm-12">
        <div class="common-title common-title-brown mb-4">
            <span class="common-title-shape">
                <a class="common-title-link" href="{{ url('/feature') }}">ভিডিও</a>
            </span>
        </div>
        <div class="well custom-well">
            <div class="row FlexRow img-w-full">

                @if($featureContents)

                    @foreach($featureContents as $content)

                        @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                        <div class="col-sm-2">
                            <div class="cat-box-sub">
                                <div class="imgbox">
                                    <a href="{{ $sURL }}">
                                        @if($content->video_type == 1 && $content->video_id)
                                            <img src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="img-responsive" alt="{{ $content->content_heading }}">
                                        @else
                                            <img src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                        @endif
                                        <img src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">

                                        @if($content->video_id)
                                            <div class="video-icon">
                                                <i class="fa fa-play-circle-o"></i>
                                            </div>
                                        @endif
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ $sURL }}">
                                        @if($content->content_sub_heading)
                                            <b class="sub-heading">{{ $content->content_sub_heading }}</b>
                                        @endif
                                        {{ $content->content_heading }}
                                    </a>
                                </h3>
                            </div>
                        </div>

                    @endforeach

                @endif

            </div>
        </div>
    </div>
</div>

