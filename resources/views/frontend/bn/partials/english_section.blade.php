@if($englishContents)
    <div class="english-section marginBottom20">
        <div class="container">
            <div class="common-title common-title-brown mb-4">
                <span class="common-title-shape">
                    <a class="common-title-link" href="{{ fEnRoot() }}" target="_blank">ENGLISH</a>
                </span>
            </div>
            <div class="row marginBottom20">
                @php
                    $leadContent = $englishContents->shift();
                    $leadURL = fEnURL($leadContent->content_id, $leadContent->category->cat_slug, ($leadContent->subcategory->subcat_slug ?? null), $leadContent->content_type);
                @endphp
                <div class="col-sm-3 two">
                    @foreach($englishContents->take(6) as $content)
                        @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                        <div class="english-content {{ $loop->iteration % 3 != 0 ? 'english-content-border-bottom' : null }}">
                            <a href="{{ $sURL }}">
                                <p class="content-title">
                                    @if($content->content_sub_heading)
                                        <span class="red-text">{{ $content->content_sub_heading }}</span>/
                                    @endif
                                    {{ $content->content_heading }}
                                </p>
                            </a>
                            <p class="content-description">{!! fGetWord(fFormatString($content->content_details), 15) !!}</p>
                        </div>
                        @if($loop->iteration == 3)
                </div>
                <div class="col-sm-6 one">
                    <div class="english-lead-content">
                        <div class="imgBox">
                            <a href="{{ $leadURL }}" title="{{ $leadContent->content_heading }}">
                                <img
                                    src="{{ $leadContent->img_bg_path ? asset(config('appconfig.contentImagePath').$leadContent->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                    class="img-responsive english-lead-image" alt="{{ $leadContent->content_heading }}"
                                    title="{{ $leadContent->content_heading }}">
                            </a>
                        </div>
                        <a href="{{ $leadURL }}" title="{{ $leadContent->content_heading }}">
                            <p class="content-title">
                                @if($leadContent->content_sub_heading)
                                    <span class="red-text">{{ $leadContent->content_sub_heading }}</span>/
                                @endif
                                {{ $leadContent->content_heading }}
                            </p>
                        </a>
                        <p class="content-description">{!! fGetWord(fFormatString($leadContent->content_details), 40) !!}</p>
                    </div>
                </div>
                <div class="col-sm-3 three">
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
<style>
    .english-section {
        background-color: #fff4e6;
        padding-top: 10px;
        border-bottom: 2px solid gray;
    }

    .english-section .container {
        margin-bottom: 15px !important;
    }

    .english-content-border-bottom {
        border-bottom: 1px solid #c8c8c8;;
    }

    .english-content {
        margin-bottom: 15px;
    }

    .english-content a {
        text-decoration: none;
    }

    .english-lead-content {
        padding: 0px 10px;
    }

    .english-lead-content a {
        text-decoration: none;
    }

    .english-lead-image {
        text-decoration: none;
    }

    .english-lead-content .imgBox {
        overflow: hidden;
    }

    .english-lead-image {
        transition: transform 0.2s ease-in-out;
    }

    .english-lead-image:hover {
        transform: scale(1.1);
    }

    .english-lead-content .content-title {
        margin-top: 10px;
    }

    .content-title {
        color: black;
        font-weight: bold;
        font-size: 20px;
    }

    .content-title:hover {
        color: red;
    }

    .content-description {
        text-align: justify;
        margin-bottom: 15px;
    }

    @media(max-width: 768px) {
        .english-section .container .row {
            display: flex;
            flex-direction: column;
        }

        .english-lead-content {
            padding: 0px 0px;
        }

        .one {
            order: 1;
        }

        .two {
            order: 2;
        }

        .three {
            order: 3;
        }
    }

</style>
