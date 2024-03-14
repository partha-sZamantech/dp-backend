@extends('frontend.bn.app')

@section('title', 'Bangla Bijoy to Unicode Converter')

@section('custom-css')
    <link href="{{ asset('frontend-assets/plugins/converter/css/bootstrapec92.css?v=')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend-assets/plugins/converter/css/centerec92.css?v=')}}" rel="stylesheet" type="text/css">
    <style>
        #stickyTopMenu, .container.header-container.hidden-xs, .footer-top {
            display: none !important;
        }
        .container.header-container.paddingTopBottom10.hidden-xs {
            display: block !important;
        }
    </style>
@endsection

@section('customMeta')
    <meta name=robots content="index, follow">

    <meta name="title" content="Bangla Bijoy to Unicode Converter">
    <meta name="description"
          content="Start Bijoy to Unicode font by bangla converter. Easy to use this tool will make your Bengali language readable anywhere in web page."/>
    <meta name="keywords" content="Bangla converter, bijoy to Unicode, unicode to bijoy">

    <meta property="og:image" content="{{asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->og_image)}}"/>
    <meta property="og:image:secure_url" content="{{asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->og_image)}}"/>
    <meta property="og:image:type" content="image/jpeg"/>
    <meta property="og:image:width" content="400"/>
    <meta property="og:image:height" content="300"/>
    <meta property="og:image:alt" content="Bangla Bijoy to Unicode Converter"/>
@endsection

@section('custom-js')
    <script type="text/javascript" src="{{ asset('frontend-assets/plugins/converter/js/bijoy2uni.js') }}?id=1234"></script>
    <script type="text/javascript" src="{{ asset('frontend-assets/plugins/converter/js/uni2bijoy.js') }}?id=1234"></script>
    <script type="text/javascript" src="{{ asset('frontend-assets/plugins/converter/js/common.js') }}?id=1234"></script>
    <script type="text/javascript" src="{{ asset('frontend-assets/plugins/converter/js/layout.js') }}?id=1234"></script>
    <script type="text/javascript" src="{{ asset('frontend-assets/plugins/converter/js/js.js') }}?id=1234"></script>
    <script type="text/javascript" src="{{ asset('frontend-assets/plugins/converter/js/layout-event.js') }}?id=1234"></script>
    <script type="text/javascript" src="{{ asset('frontend-assets/plugins/converter/js/count.js') }}?id=1234"></script>
@endsection

@section('mainContent')
    <table width="100%" border="0" align="center" style="margin: 0 auto; background:#d3d3d3">
        <tr>
            <td align="center">
                <table width="90%" style="max-width:1050px; margin:10px" border="0">
                    <form name="myForm" action="#" method="post">

                        <tr>
                            <td>
                                <h1 style="font-size:16px;font-weight:bold; font-family:SolaimanLipi">ইউনিকোড
                                    কি-বোর্ডের লেখা এখানে পেস্ট করুন</h1>

                                <TEXTAREA class="unicode_textarea" onKeyPress="return KeyBoardPress(event);" id=EDT
                                          onKeyDown="return KeyBoardDown(event);" name="textarea" onBlur="InputLengthCheck();"
                                          onKeyUp="InputLengthCheck();" autofocus="autofocus" value=""
                                          placeholder=""></TEXTAREA>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" height="60px" valign="middle">
                                <div class="convert_button_left">
                                    <button type="button" class="bijoy_button btn btn-primary"
                                            onClick="ConvertToTextArea('CONVERTEDT');" name="ConvertToAsciiButton"><span
                                            class="fa fa-arrow-down" aria-hidden="true"></span> ইউনিকোড টু বিজয়
                                    </button>

                                    <button type="button" class="unicode_button btn btn-success"
                                            onClick="ConvertFromTextArea('CONVERTEDT');" name="ConvertButton"><span
                                            class="fa fa-arrow-up" aria-hidden="true"></span> বিজয় টু ইউনিকোড
                                    </button>

                                    <button type="reset" class="reset_button btn btn-danger" name=ClearButton><span
                                            class="fa fa-refresh" aria-hidden="true"></span> মুছে ফেলুন
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h1 style="font-size:16px;text-align:left;font-weight:bold;font-family: SutonnyMJ;">
                                    বিজয় কি-বোর্ডের লেখা এখানে পেস্ট করুন</h1>
                                <TEXTAREA class="bijoy_textarea" id="CONVERTEDT" autofocus value=""
                                          placeholder=""></TEXTAREA>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div>
                                    <input readonly type="hidden" name="CharsTyped" size="2"
                                           style="font-weight:bold; border: 0px solid #2D69AE; color:#808080; text-align:left;">

                                    <input readonly type="hidden" name="WordsTyped" size="3"
                                           style="font-weight:bold; border: 1px solid #2D69AE; color:#808080; text-align:right;">

                                    <input readonly type="hidden" name="CharsLeft" size="8">

                                    <input readonly type="hidden" name="WordsLeft" size="8">

                                </div>
                            </td>
                        </tr>
                    </form>
                </table>
            </td>
        </tr>
    </table>
@endsection
