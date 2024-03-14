
<div class="marginBottom20" style="padding-top: 0; background: #faebd7">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <style>
                    @-webkit-keyframes fadein {
                        from { opacity: 0; }
                        to { opacity: 1; }
                    }

                    @-moz-keyframes fadein {
                        from { opacity: 0; }
                        to { opacity: 1; }
                    }

                    @keyframes fadein {
                        from { opacity: 0; }
                        to { opacity: 1; }
                    }
                    /*.circleelection{*/
                    /*    width:23px;*/
                    /*    height: 23px;*/
                    /*    border-radius: 50%;*/
                    /*    border:1px solid red;*/
                    /*    position: absolute;*/
                    /*    bottom: 1px;*/
                    /*    left: 0;*/
                    /*}*/
                    #foo {
                        background-color: red;
                        width:20px !important;
                        height: 20px !important;
                        color: white;
                        border-radius: 50%;
                        -webkit-animation: fadein 600ms ease-in alternate infinite;
                        -moz-animation: fadein 600ms ease-in alternate infinite;
                        animation: fadein 600ms ease-in alternate infinite;
                        display: block;
                        position: absolute;
                        left: 2.3px;
                        top:6px;
                        border: 2px solid #3375af;
                    }
                    .electionTitlee{
                        color: red;
                        font-size: 25px;
                        text-align: center;
                        position:relative;
                    }
                    .electionHeader{
                        width: 400px;
                        margin: auto

                    }
                    @media all and (max-width:415px){
                        .electionTitlee{
                            font-size: 20px;
                        }
                        .electionHeader{
                            width: 100%;
                        }
                    }
                </style>
                <div class="common-title-brown mb-4" style=" text-align: center; font-weight: bold; border-bottom: 4px solid red; margin-bottom: 5px;">
                    <div class="electionHeader">
{{--                        <h3 class="electionTitlee"  > <span class="circleelection">--}}
{{--                                    <span id="foo"></span>--}}
{{--                                    </span> দ্বাদশ জাতীয় সংসদ নির্বাচন - ২০২৪</h3>--}}
                        <h3 class="electionTitlee"  >দ্বাদশ জাতীয় সংসদ নির্বাচন - ২০২৪</h3>
                    </div>


                </div>
{{--                <div class="cat-box-with-media rem-first-border">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-sm-6">--}}
{{--                            <img src="{{ asset('/election/election.jpg') }}" width="100%" alt="">--}}

{{--                        </div>--}}
{{--                        <div class="col-sm-6">--}}
{{--                            @if($electionData)--}}
{{--                                <div style="background: #FFFFFF; padding: 26px">--}}
{{--                                    <h3 class="marginTop0" style="color: #ed1b24; padding-bottom: 8px; border-bottom: 1px solid; font-weight: bold; font-size: 20px;">--}}
{{--                                        {{ $electionData->title }}</h3>--}}
{{--                                    <div>--}}
{{--                                        <div class="party-one row" style="font-size: 18px; padding: 5px 0;">--}}
{{--                                      --}}
{{--                                            <div class="col-md-6 col-xs-6">--}}
{{--                                                <h4 style="padding: 0; margin: 0">{{ $electionData->party_one_name }}</h4>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6 col-xs-6">--}}
{{--                                                <div class="pull-right">--}}
{{--                                                    <span style="font-weight: bold; margin-left: 10px">আসন:</span>--}}
{{--                                                    <span style="background: #eeeeee; padding: 5px;">{{ fFormatDateEn2Bn(fFormatAddCommaToNumber($electionData->party_one_votes)) }}</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="party-two row" style="margin-top: 10px; font-size: 18px; padding: 5px 0;">--}}
{{--                                            --}}{{--                                                <img src="{{ asset(config('appconfig.commonImagePath').'sakku.jpg') }}" style="width: 50px">--}}
{{--                                            <div class="col-md-6 col-xs-6">--}}
{{--                                                <h4 style="padding: 0; margin: 0;">{{ $electionData->party_two_name }}</h4>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6 col-xs-6">--}}
{{--                                                <div class="pull-right">--}}
{{--                                                    <span style="font-weight: bold; margin-left: 10px">আসন:</span>--}}
{{--                                                    <span style="background: #eeeeee; padding: 5px;">{{ fFormatDateEn2Bn(fFormatAddCommaToNumber($electionData->party_two_votes)) }}</span>--}}

{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="party-two row" style="margin-top: 10px; font-size: 18px; padding: 5px 0;">--}}
{{--                                            --}}{{--                                                <img src="{{ asset(config('appconfig.commonImagePath').'sakku.jpg') }}" style="width: 50px">--}}
{{--                                            <div class="col-md-6 col-xs-6">--}}
{{--                                                <h4 style="padding: 0; margin: 0;">{{ $electionData->party_three_name }}</h4>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6 col-xs-6">--}}
{{--                                                <div class="pull-right">--}}
{{--                                                    <span style="font-weight: bold; margin-left: 10px">আসন:</span>--}}
{{--                                                    <span style="background: #eeeeee; padding: 5px;">{{ fFormatDateEn2Bn(fFormatAddCommaToNumber($electionData->party_three_votes)) }}</span>--}}

{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                        <div class="party-two row" style="margin-top: 10px; font-size: 18px; padding: 5px 0;">--}}
{{--                                            --}}{{--                                                <img src="{{ asset(config('appconfig.commonImagePath').'sakku.jpg') }}" style="width: 50px">--}}
{{--                                            <div class="col-md-6 col-xs-6">--}}
{{--                                                <h4 style="padding: 0; margin: 0;">{{ $electionData->party_four_name }}</h4>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6 col-xs-6">--}}
{{--                                                <div class="pull-right">--}}
{{--                                                    <span style="font-weight: bold; margin-left: 10px">আসন:</span>--}}
{{--                                                    <span style="background: #eeeeee; padding: 5px;">{{ fFormatDateEn2Bn(fFormatAddCommaToNumber($electionData->party_four_votes)) }}</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                        <div class="row" style="margin-top: 10px; font-size: 18px; background: #eeeeee; padding: 5px 0;">--}}
{{--                                            <div class="col-md-6 col-xs-5">--}}
{{--                                                <span style="font-weight: bold;">মোট আসন:</span>--}}
{{--                                                <span>{{ fFormatDateEn2Bn(fFormatAddCommaToNumber($electionData->total_center)) }}</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6 col-xs-7">--}}
{{--                                                <div class="pull-right">--}}
{{--                                                    <span style=" font-weight: bold;">মোট প্রাপ্ত আসন:</span>--}}
{{--                                                    --}}{{--                                                       <span>{{ fFormatDateEn2Bn(fFormatAddCommaToNumber($electionData->total_center)) }}</span>--}}
{{--                                                    @php($total = $electionData->party_one_votes + $electionData->party_two_votes+ $electionData->party_three_votes + $electionData->party_four_votes)--}}
{{--                                                    <span>{{ fFormatDateEn2Bn(fFormatAddCommaToNumber($total))}}</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            @if(count($nibachonContent) > 0)
                @foreach($nibachonContent as $econtent)
                    @php($sURL = fDesktopURL($econtent->content_id, $econtent->category->cat_slug, ($econtent->subcategory->subcat_slug ?? null), $econtent->content_type))
                    <div class="col-sm-12 col-md-3 col-xs-12">
                        <style>
                            .electionclass:hover {
                                text-decoration: none;
                            }
                        </style>
                        <div style="padding: 10px 0px">

                            <a class="electionclass" href="{{ $sURL }}" title="{{ $econtent->content_heading }}">
                                <img
                                    src="{{ $econtent->img_bg_path ? asset(config('appconfig.contentImagePath').$econtent->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                    class="img-responsive" alt="{{ $econtent->content_heading }}" width="100%"
                                    title="{{ $econtent->content_heading }}">

                                <h4  style="margin-bottom: 3px; line-height: 1.3; color: red;">
                                    {{ $econtent->content_heading }}
                                </h4>

                                {{--                                        <p class="p-date" style="font-size: 15px; color: #3375af">--}}
                                {{--                                            {{fFormatDateEn2Bn($econtent->created_at->diffForHumans()) }}--}}
                                {{--                                        </p>--}}
                            </a>

                        </div>


                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

