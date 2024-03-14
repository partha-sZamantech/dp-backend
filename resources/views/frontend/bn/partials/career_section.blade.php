@if($careerContents->count())
    @php($careerTopContent = $careerContents->shift())
    @php($sURL = fDesktopURL($careerTopContent->content_id, $careerTopContent->category->cat_slug, ($careerTopContent->subcategory->subcat_slug ?? null), $careerTopContent->content_type))
    <div class="cat-box">
        <div class="imgbox">
            <a href="{{ $sURL }}">
                <img
                    src="{{ $careerTopContent->img_sm_path ? asset(config('appconfig.contentImagePath').$careerTopContent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                    class="img-responsive" alt="{{ $careerTopContent->content_heading }}"
                    title="{{ $careerTopContent->content_heading }}">
                @if(!empty($careerTopContent->video_id))
                    <i class="fa fa-play news-video-icon-md"></i>
                @endif
                @if(!empty($careerTopContent->podcast_id))
                    <i class="fa fa-volume-up news-video-icon-md"></i>
                @endif
            </a>
        </div>
        <h3>
            <a href="{{ $sURL }}">
{{--                @if(!empty($careerTopContent->video_id) || !empty($careerTopContent->podcast_id))--}}
{{--                    <span class="video-audio-icon">--}}
{{--                                                @if(!empty($careerTopContent->video_id))--}}
{{--                            <i class="fa fa-play"></i>--}}
{{--                        @endif--}}
{{--                        @if(!empty($careerTopContent->podcast_id))--}}
{{--                            <i class="fa fa-volume-up"></i>--}}
{{--                        @endif--}}
{{--                                            </span>--}}
{{--                @endif--}}
                @if($careerTopContent->content_sub_heading)
                    {{--                                            <b class="sub-heading">{{ $careerTopContent->content_sub_heading }}</b>--}}
                    <span class="red-text">{{ $careerTopContent->content_sub_heading }}</span>/
                @endif
                {{ $careerTopContent->content_heading }}
            </a>
        </h3>
        <p>{{fFormatDateEn2Bn($careerTopContent->created_at->diffForHumans()) }}</p>
    </div>

    @php($careerOtherContents = $careerContents->all())

    @if(count($careerOtherContents))
        @foreach($careerOtherContents as $content)
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
