@if($photoAlbums->count())
    @php($leadAlbum = $photoAlbums->shift())
    @php($leadAlbumURL = fAlbumURL($leadAlbum->album_id, $leadAlbum->category->cat_slug))
    <div class="gallery-container marginTop10 marginBottom10">
        <div class="container">
            <div class="gallery-title">
                <h2><a href="{{ url('/photo') }}">ফটো গ্যালারি</a>    {{$leadAlbum->feature_image['img']}}</h2>
            </div>

            <div class="gallery">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <a class="image-box" href="{{ $leadAlbumURL }}" style="border: none!important;">
                            <img src="{{ asset(config('appconfig.photoAlbumImagePath') . ($leadAlbum->feature_image['img'] ?? 'photo_album_placeholder_image.png')) }}"
                                 alt="{{ $leadAlbum->album_name }}">
                            <div class="overlay">
                                <b><p class="img-title">{{ $leadAlbum->album_name }}</p></b>
                            </div>
                            <span class="image-icon"><i class="fa fa-image"></i></span>
                        </a>
                    </div>
                    @foreach($photoAlbums as $album)
                        @php($albumURL = fAlbumURL($album->album_id, $album->category->cat_slug))
                        <div class="col-sm-6 col-md-3">
                            <a class="image-box" href="{{ $albumURL }}" style="border: none!important;">
                                <img src="{{ asset(config('appconfig.photoAlbumImagePath') . ($album->feature_image['img'] ?? 'photo_album_placeholder_image.png')) }}">
                                <div class="overlay">
                                    <p class="img-title-small">{{ $album->album_name }}</p>
                                </div>
                                <span class="image-icon"><i class="fa fa-image"></i></span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
