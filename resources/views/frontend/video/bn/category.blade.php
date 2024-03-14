@extends('frontend.bn.app')

@section('title', $category->name_bn.' | ঢাকা প্রকাশ')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('frontend-assets/common/css/video-style.css') }}?id=2">

@endsection

@section('mainContent')
    <div class="main-content">
        <div class="container marginTop10">
            @include('frontend.video.bn.common.header')

            <div class="row videoRow">
                @if($videos)
                    @foreach($videos as $video)
                        @php($videoUrl = $video->target == 2 && $video->type == 1 ? ('https://www.youtube.com/watch?v='.$video->code) : ($video->target == 2 && $video->type == 2 ? ('https://www.facebook.com/dhakaprokash24/videos/'.$video->code) : fVideoURL($video->id, $video->category->slug)))
                        <div class="col-sm-4 video-box">
                            <a class="panel video-panel" href="{{ $videoUrl }}" target="{{ $video->target == 2 ? '_blank' : '' }}">
                                <div class="panel-body">
                                    <img src="{{ asset(config('appconfig.videoImagePath').$video->img_bg_path) }}" alt="{{ $video->title }}" class="img-responsive">
                                    <i class="fa fa-play video-icon"></i>
                                </div>
                                <div class="panel-footer">
                                    <p>{{ $video->title }}</p>
                                </div>
                            </a>
                        </div>
                        @if($loop->count > $loop->iteration && $loop->iteration % 3 ==0 )
            </div><div class="row videoRow">
                        @endif
                    @endforeach

            </div>
            {{ $videos->links('vendor.pagination.bn-default') }}
            @endif
        </div>
    </div>

    @include('frontend.en.ads.common.site-block-ad')
@endsection

@section('custom-js')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="{{ asset('frontend-assets/plugins/bootstrap/bootstrap.min.js') }}"></script>
@endsection
