<div class="section-hedding left-style-box">
    <a href="{{ url('/photo') }}" class="link-overlay"></a>
    <h2>Photo Gallery
        <span></span>
    </h2>
</div>
<div class="gallery-content">
    @if($latestAlbums)
        <div class="home-gallery owl-carousel h-125">
            @foreach($latestAlbums as $album)
                @php($sURL = fAlbumURL($album->album_id, $album->category->cat_slug, (!is_null($album->subcategory) ? $album->subcategory->subcat_slug : null)))
                <div class="feature-item-1">
                    <a href="{{ $sURL }}" class="link-overlay img-btn"></a>
                    <!-- img link -->
                    <img src="{{ asset(config('appconfig.photoAlbumImagePath').$album->img_path) }}" class="area-bg" alt="{{ $album->album_name }}">
                    <!-- img thumb -->
                    <div class="area-heading">
                        <h2>{{ $album->album_name }}</h2>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>