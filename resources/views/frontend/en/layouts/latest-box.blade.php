@foreach($latestContents as $content)
    <div class="small-news-item">
        <a href="{{ fEnURL($content->content_id, $content->category->cat_slug, (!is_null($content->subcategory) ? $content->subcategory->subcat_slug : null), $content->content_type) }}" class="link-overlay"></a>

        @if($content->video_type == 1 && $content->video_id)
            <img src="https://img.youtube.com/vi/{{ $content->video_id }}/default.jpg" class="small-news-preview" alt="{{ $content->content_heading }}">
        @else
            <img src="{{ $content->img_xs_path ? asset(config('appconfig.contentImagePath').$content->img_xs_path) : asset(config('appconfig.commonImagePath').'xs-default.png') }}" class="small-news-preview" alt="{{ $content->content_heading }}">
        @endif

        <div class="small-news-content">
            <h4 class="line-clamp line-clamp-2">{{ $content->content_heading }}</h4>
            <p class="line-clamp line-clamp-3">
                <span>{{ $content->content_brief }}</span>
            </p>
        </div>
    </div>
@endforeach
