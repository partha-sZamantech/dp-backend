@if($politicsContents)
    @php($ptTopContent = $politicsContents->shift())
    @php($sURL = fDesktopURL($ptTopContent->content_id, $ptTopContent->category->cat_slug, ($ptTopContent->subcategory->subcat_slug ?? null), $ptTopContent->content_type))
    <div class="cat-box">
        <div class="imgbox">
            <a href="{{ $sURL }}">
                <img
                    src="{{ $ptTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$ptTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                    class="img-responsive" alt="{{ $ptTopContent->content_heading }}"
                    title="{{ $ptTopContent->content_heading }}">
                @if(!empty($ptTopContent->video_id))
                    <i class="fa fa-play news-video-icon-md"></i>
                @endif
                @if(!empty($ptTopContent->podcast_id))
                    <i class="fa fa-volume-up news-video-icon-md"></i>
                @endif
            </a>
        </div>
        <h3>
            <a href="{{ $sURL }}">
                @if($ptTopContent->content_sub_heading)
                    {{--                                                    <b class="sub-heading">{{ $ptTopContent->content_sub_heading }}</b>--}}
                    <span
                        class="red-text">{{ $ptTopContent->content_sub_heading }}</span>
                    /
                @endif
                {{ $ptTopContent->content_heading }}
            </a>
        </h3>
        {{ $ptTopContent->category->cat_name_bn }} | {{fFormatDateEn2Bn($ptTopContent->created_at->diffForHumans()) }}
    </div>

    @php($ptOtherContents = $politicsContents->all())

    @if($ptOtherContents)
        @foreach($ptOtherContents as $content)
            @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
            <div class="media">
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
                                {{--                                                    <b class="sub-heading">{{ $ptTopContent->content_sub_heading }}</b>--}}
                                <span
                                    class="red-text">{{ $content->content_sub_heading }}</span>
                                /
                            @endif
                            {{ $content->content_heading }}
                        </a>
                    </h4>
                </div>
            </div>
        @endforeach
    @endif
@endif
