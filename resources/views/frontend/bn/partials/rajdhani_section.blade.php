@foreach($rajdhaniContents as $content)
    @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
    <div class="media">
        <div class="media-left imgbox">
            <a href="{{ $sURL }}">
                <img
                    src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                    class="img-responsive" alt="{{ $content->content_heading }}"
                    title="{{ $content->content_heading }}">
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading">
                <a href="{{ $sURL }}">
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
                    @if($content->content_sub_heading)
                        {{--                                                        <b class="sub-heading">{{ $content->content_sub_heading }}</b>--}}
                        <span
                            class="red-text">{{ $content->content_sub_heading }}</span>/
                    @endif
                    {{ $content->content_heading }}
                </a>
            </h4>
        </div>
    </div>
@endforeach
