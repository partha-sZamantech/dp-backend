<div class="section-hedding left-style-box margin-bottom-10">
    <a href="{{ url('/photo') }}" class="link-overlay"></a>
    <h2>ছবি গ্যালারী
        <span></span>
    </h2>
</div>

<div class="row">
    <div class="gallery-content">
        @if($latestAlbums)
            <div class="col-md-7">
                @php($firstAlbum = $latestAlbums->shift())
                <div class="feature-item-1 h-265">
                    <a href="{{ fAlbumURL($firstAlbum->album_id, $firstAlbum->category->cat_slug, (!is_null($firstAlbum->subcategory) ? $firstAlbum->subcategory->subcat_slug : null)) }}" class="link-overlay img-btn"></a><!-- img link -->
                    <img src="{{ asset(config('appconfig.photoAlbumImagePath').$firstAlbum->img_path) }}" class="area-bg" alt="{{ $firstAlbum->album_name }}"><!-- img thumb -->
                    <div class="area-heading">
                        <h2>{{ $firstAlbum->album_name }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                @php($otherAlbums = $latestAlbums->all())
                @foreach($otherAlbums as $album)
                    @php($sURL = fAlbumURL($album->album_id, $album->category->cat_slug, (!is_null($album->subcategory) ? $album->subcategory->subcat_slug : null)))
                    <div class="feature-item-1 h-125{{ $loop->iteration == 2? ' margin-top-15' : '' }}">
                        <a href="{{ $sURL }}" class="link-overlay img-btn"></a><!-- img link -->
                        <img src="{{ asset(config('appconfig.photoAlbumImagePath').$album->img_path) }}" class="area-bg" alt="{{ $album->album_name }}"><!-- img thumb -->
                        <div class="area-heading">
                            <h2>{{ $album->album_name }}</h2>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>