<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 Not Found!</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/plugins/bootstrap-3.3.7/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend-assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/common/css/fonts.css') }}">
    <style>
        body{
            font-family:"Helvetica Neue", Helvetica, Arial, SolaimanLipi ,sans-serif,SolaimanLipiNormal;
        }

        .first-view{
            background: #f7f7f7;
            border-bottom: 1px solid #f3f3f3;
            padding:70px 0 50px;
            margin-bottom: 50px;
        }
        .first-view p{
            font-size:18px;
        }
        .logo{
            padding: 30px 0;
        }
        .nav{}
        .nav li{}
        .nav li a{
            color: #000;
            display: block;
            padding: 3px 0;
        }
        .nav li a:hover{}
        .btn-home{
            margin-top: 40px;
            font-size: 20px;
            color: #fff;
            display: inline-block;
            padding: 5px 20px 6px 15px;
            border-radius: 30px;
            background: #000;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -ms-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
            -webkit-box-shadow: 0px 4px 3px 0px #c2c2c2;
            -moz-box-shadow: 0px 4px 3px 0px #c2c2c2;
            box-shadow: 0px 4px 3px 0px #c2c2c2;

        }
        .btn-home:hover{
            color: #fff;
            padding: 5px 25px 6px 25px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="text-center logo">
    <a href="{{ url('/') }}">
        <img src="{{ asset(config('appconfig.commonImagePath').'logo.png') }}" alt="Logo" style="width:200px;">
    </a>
</div>

<div class="first-view">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text-center">
                <img src="{{ asset(config('appconfig.commonImagePath').'error-404.png') }}" alt="" style="max-width:100%;">
                <h1>পাওয়া যায়নি</h1>
                <p>
                    আপনি যে বিষয়টি অনুসন্ধান করছেন তা খুজে পাওয়া যায়নি। বিষয়টি সম্ভবত  ঢাকা প্রকাশ'র সাথে সংশ্লিষ্ট নয় অথবা আপনি ভুলভাবে অনুসন্ধান করছেন। অনুগ্রহ করে আপনার অনুসন্ধান বিষয়টি সম্বন্ধে নিশ্চিত হোন
                </p>
                <a href="{{ url('/') }}" class="btn-home"><i class="fa fa-long-arrow-left"></i> প্রচ্ছদ</a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <ul class="row list-unstyled nav navbar">
                @php($contents = \App\Http\Controllers\Backend\Bn\BnHelperController::getLatestContent(12))
                @foreach($contents as $content)
                <li class="col-sm-4"><a href="{{ fDesktopURL($content->content_id,$content->category->cat_slug,($content->subcategory->subcat_slug ?? ''), $content->content_type) }}"><i class="fa fa-angle-double-right"></i> {{ $content->content_heading }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

</body>
</html>