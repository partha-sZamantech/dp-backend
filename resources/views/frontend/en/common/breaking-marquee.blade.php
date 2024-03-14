<div class="breaking_news bn-bordernone bn-darkred" id="breaking-section">
    <div class="bn-title" style="width: auto;">
        <h2 style="display: inline-block;"><span>Breaking</span></h2>
    </div>
    <ul class="en_breaking_heading">
        @foreach($breakingContents as $content)
            @if($content->expired_time >= now())
                <li style="font-size: 19px;">
                    @if($content->news_link )
                        <a href="{{ $content->news_link }}" title="{{ $content->news_title }}">{{ $content->news_title }}</a>
                    @else
                        {{ $content->news_title }}
                    @endif
                </li>
            @endif
        @endforeach
    </ul>
    <div class="bn-navi">
        <span></span>
        <span></span>
    </div>
</div>
