<div class="special-section" style="padding-top: 0;">
    <div class="container">
        <div class="special-box special-event-section">
            <a href="https://www.dhakaprokash24.com/topic/ঘূর্ণিঝড়-সিত্রাং" target="_blank" rel="nofollow">
                <div class="special-event-title marginTop20">
                    <div class="desktop-image">
                        <img src="{{ asset('media/common/Sitrang_ws.jpg') }}" alt="ঘূর্ণিঝড় সিত্রাং">
                    </div>
                    <div class="mobile-image">
                        <img src="{{ asset('media/common/Sitrang-750x140_Mobile_ws.jpg') }}" alt="ঘূর্ণিঝড় সিত্রাং">
                    </div>
                </div>
            </a>
            @if($specialArrangementContents)
                @php($leadContent = $specialArrangementContents->shift())
                @php($leadURL = fDesktopURL($leadContent->content_id, $leadContent->category->cat_slug, ($leadContent->subcategory->subcat_slug ?? null), $leadContent->content_type))
                <div class="row marginTop10">
                    <div class="col-md-6">
                        <a class="lead-content" href="{{ $leadURL }}" target="_blank" rel="nofollow">
                            <img src="{{ asset(config('appconfig.contentImagePath').$leadContent->img_bg_path) }}"
                                 alt="{{ $leadContent->content_heading }}" style="width: 100%"/>
                            <div class="lead-title">
                                @if(!empty($leadContent->video_id))
                                    <i class="fa fa-play"></i>
                                @endif
                                <p>{{ $leadContent->content_heading }}</p>
                                <h5>{!! fGetWord($leadContent->content_details, 25) !!}</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <div class="row special-sub FlexRow">
                            @foreach($specialArrangementContents->take(4) as $content)
                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                <div class="col-sm-6">
                                    <div class="single_sub">
                                        <div class="imgbox">
                                            <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                <img
                                                    src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                                    class="img-responsive" alt="{{ $content->content_heading }}"
                                                    title="{{ $content->content_heading }}">
                                            </a>
                                        </div>
                                        <h4 class="other-content-title"
                                            style="margin-bottom: 3px; line-height: 1.2; font-size: 20px">
                                            <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                {{ $content->content_heading }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>

    .lead-title {
        margin-top: -6px;
        background-color: #2C4377;
        border: 1px solid #2C4377;
        margin-bottom: 5px;
    }

    .lead-title > .fa-play {
        position: absolute;
        top: 40%;
        left: 50%;
        height: 50px;
        width: 50px;
        background: rgba(0, 0, 0, .14);
        transform: translate(-50%, -50%);
        text-align: center;
        line-height: 38px;
        color: #fff;
        border-radius: 50%;
        padding-left: 4px;
        border: 5px solid #fff;
        -webkit-box-shadow: 0 0 30px 2px grey;
        -moz-box-shadow: 0 0 30px 2px gray;
        box-shadow: 0 0 30px 2px grey;
        opacity: .8;
        font-size: 20px;
    }

    .lead-title p {
        margin-bottom: 10px;
        line-height: 1.2;
        font-size: 24px;
        margin-left: 10px;
        margin-top: 14px;
    }

    .lead-title h5 {
        margin-bottom: 10px;
        line-height: 1.2;
        margin-left: 10px;
        margin-top: 14px;
    }

    .lead-title h5:hover {
        color: white!important;
    }

    .lead-content {
        margin-bottom: 20px;
        cursor: pointer;
        text-decoration: none !important;
        color: white;
    }

    .lead-content:hover .lead-title p {
        color: yellow;
    }

    .special-section {
        position: relative;
        background-color: #878B93;
        border-bottom: 2px solid #00427A;
    }

    .special-section .container {
        margin-bottom: 15px !important;
    }

    .special-box hr {
        width: 100%;
        height: 4px;
        background: #942824;
        margin-top: 0px !important;
        margin-bottom: 5px !important;
    }

    .section-banner {
        position: relative;
    }

    .mobile-image {
        display: none;
    }
    
    .other-content-title a {
        color: white!important;
    }

    .other-content-title a:hover {
        color: yellow!important;
    }

    @media (max-width: 500px) {
        .mobile-image {
            display: block;
        }

        .desktop-image {
            display: none;
        }
    }
</style>
