@extends('frontend.en.app')

@section('mainContent')
    <div class="category-all-section h-auto margin-top-30">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="greybg-area big-news-area margin-bottom-20">
                        <div class="section-hedding left-style-box">
                            <a href="#" class="link-overlay"></a>

                            <h2>Division - {{ $division->division_name }}{{ $district ? ', District - '.$district->district_name : '' }}{{ $upozilla ? ', Upozilla - '.$upozilla->upozilla_name : '' }}
                                <span></span>
                            </h2>
                        </div>
                        <div class="row">
                        @foreach($contents as $content)
                            @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, (!is_null($content->subcategory) ? $content->subcategory->subcat_slug : null), $content->content_type))
                            <!-- archive post type news -->
                                <div class="col-md-4">
                                    <div class="category-post-news">
                                        <a href="{{ $sURL }}" class="link-overlay"></a>
                                        <div class="section-img">
                                            @if($content->video_type == 1 && $content->video_id)
                                                <img src="https://img.youtube.com/vi/{{ $content->video_id }}/mqdefault.jpg" alt="{{ $content->content_heading }}">
                                            @else
                                                <img src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" alt="{{ $content->content_heading }}">
                                            @endif

                                        </div>
                                        <div class="section-content">
                                            <h4 class="line-clamp line-clamp-2">{{ $content->content_heading }}</h4>
                                            <p class="post-date">
                                                {{ fFormatDateEn2Bn(date("d F Y", strtotime($content->created_at))) }}
                                                <span>/</span> {{ fFormatDateEn2Bn($content->comments->count()) }}টি মন্তব্য
                                            </p>
                                            <p class="line-clamp line-clamp-4">{{ $content->content_brief }}</p>
                                            <span class="more-post">
                                                <a href="{{ $sURL }}">Details</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                @if($loop->count > 3 && $loop->iteration % 3 == 0)
                        </div><div class="row">
                        @endif

                        @if($loop->iteration == 6)
                            <!-- category ad -->
                                <div class="gallery-single-ad h-148">
                                    <img class="margin-top-20" src="{{ asset(config('appconfig.contentImagePath').'2017November/gallery-ad-1.jpg') }}" alt="">
                                </div>
                            @elseif($loop->iteration == 12)
                                <div class="gallery-single-ad">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="ad-container h-240">
                                                <img src="{{ asset(config('appconfig.contentImagePath').'2017November/meri-ad.png') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="ad-container h-240">
                                                <img src="{{ asset(config('appconfig.contentImagePath').'2017November/mojo-ad.jpg') }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @endforeach
                        </div>

                    </div>

                    <div class="more-replay margin-top-45">
                        {{ $contents->links() }}
                    </div>
                </div><!-- col md 8 end -->




                <div class="col-md-4">
                    <!-- calander -->
                    <div class="greybg-area calender-section margin-bottom-25">
                        <div class="section-hedding">
                            <h2>Archive <span></span></h2>
                        </div>
                        <div class='design'>
                            <div id="datepicker"></div>
                        </div>
                    </div>

                    <!-- facebook widget -->
                @include('frontend.en.layouts.facebook-likebox')

                <!-- side ad -->
                    <div class="ad-container h-240 margin-top-20">
                        <img src="{{ asset(config('appconfig.contentImagePath').'2017November/meri-ad.png') }}" alt="">
                    </div>

                    <!-- tab section -->
                    <div class="greybg-area people-que-area margin-top-25 margin-bottom-25">
                        <div class="custom-tab readers-qs">
                            @include('frontend.en.layouts.latestPopularBox')
                        </div>
                    </div><!--/. tab section end -->



                </div><!--/. col-md-4 end -->
            </div><!--/. row end -->
        </div>
    </div>

@endsection