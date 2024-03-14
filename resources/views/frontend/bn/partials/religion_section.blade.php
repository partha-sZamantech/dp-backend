@if($religionContents)
    @php($religionTopContent = $religionContents->shift())
    @php($sURL = fDesktopURL($religionTopContent->content_id, $religionTopContent->category->cat_slug, ($religionTopContent->subcategory->subcat_slug ?? null), $religionTopContent->content_type))
    <div class="cat-box">
        <div class="imgbox">
            <a href="{{ $sURL }}">
                <img
                    src="{{ $religionTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$religionTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                    class="img-responsive" alt="{{ $religionTopContent->content_heading }}"
                    title="{{ $religionTopContent->content_heading }}">
                @if(!empty($religionTopContent->video_id))
                    <i class="fa fa-play news-video-icon-md"></i>
                @endif
                @if(!empty($religionTopContent->podcast_id))
                    <i class="fa fa-volume-up news-video-icon-md"></i>
                @endif
            </a>
        </div>
        <h3>
            <a href="{{ $sURL }}">
{{--                @if(!empty($religionTopContent->video_id) || !empty($religionTopContent->podcast_id))--}}
{{--                    <span class="video-audio-icon">--}}
{{--                                @if(!empty($religionTopContent->video_id))--}}
{{--                            <i class="fa fa-play"></i>--}}
{{--                        @endif--}}
{{--                        @if(!empty($religionTopContent->podcast_id))--}}
{{--                            <i class="fa fa-volume-up"></i>--}}
{{--                        @endif--}}
{{--                            </span>--}}
{{--                @endif--}}
                @if($religionTopContent->content_sub_heading)
                    {{--<b class="sub-heading">{{ $religionTopContent->content_sub_heading }}</b>--}}
                    <span class="red-text">{{ $religionTopContent->content_sub_heading }}</span>/
                @endif
                {{ $religionTopContent->content_heading }}
            </a>
        </h3>
        <p>{{fFormatDateEn2Bn($religionTopContent->created_at->diffForHumans()) }}</p>
    </div>

    @php($religionOtherContents = $religionContents->all())

    @if($religionOtherContents)
        @foreach($religionOtherContents as $content)
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
                                {{--                                                        <b class="sub-heading">{{ $intTopContent->content_sub_heading }}</b>--}}
                                <span
                                    class="red-text">{{ $content->content_sub_heading }}</span>/
                            @endif
                            {{ $content->content_heading }}
                        </a>
                    </h4>
                </div>
            </div>
        @endforeach
    @endif
@endif
