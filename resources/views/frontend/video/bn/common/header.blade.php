<p class="breadcrumb marginBottom10 video-category">
    @php($vCategories = bnVideoCategory())
    <a href="{{ route('video') }}"><i class="fa fa-home {{ request()->routeIs('video') ? 'red-text' : null }}"></i></a>
    <span>|</span>
    @foreach($vCategories as $category)
        <a href="{{ route('video.category', $category->slug) }}" class="{{ request()->is('video/' . $category->slug) ? 'red-text' : null }}">{{ $category->name_bn }}</a>
        @if(!$loop->last)
            <span>|</span>
        @endif
    @endforeach
</p>