<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
            padding: 5px 0;
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
    <a href="">
        <img src="{{ asset(config('appconfig.commonImagePath').'logo.png') }}" alt="Logo" style="width:200px;">
    </a>
</div>

<div class="first-view">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text-center">
                <img src="{{ asset(config('appconfig.commonImagePath').'error-404.png') }}" alt="" style="max-width:100%;">
                <h1>Nothing found!</h1>
                <p>
                    You are not finding what you are searching for. The matter is probably not related to Dhaka Prakash or you are wrongly searching. Please be sure to check your inquiry
                </p>
                <a href="{{ url('/english') }}" class="btn-home"><i class="fa fa-long-arrow-left"></i> Go Home</a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <ul class="list-unstyled nav navbar">
                <li><a href=""><i class="fa fa-angle-double-right"></i> Mirza Abbas, his wife get anticipatory bail</a></li>
                <li><a href=""><i class="fa fa-angle-double-right"></i> Joy, relief as Singaporean cameraman returns after two months in Myanmar prison</a></li>
                <li><a href=""><i class="fa fa-angle-double-right"></i> Suicide bomb attack kills 6 Afghan police</a></li>
                <li><a href=""><i class="fa fa-angle-double-right"></i> China, Russia oppose UN criticism of Myanmar over Rohingya</a></li>
            </ul>
        </div>
        <div class="col-sm-4">
            <ul class="list-unstyled nav navbar">
                <li><a href=""><i class="fa fa-angle-double-right"></i> Mirza Abbas, his wife get anticipatory bail</a></li>
                <li><a href=""><i class="fa fa-angle-double-right"></i> Joy, relief as Singaporean cameraman returns after two months in Myanmar prison</a></li>
                <li><a href=""><i class="fa fa-angle-double-right"></i> Suicide bomb attack kills 6 Afghan police</a></li>
                <li><a href=""><i class="fa fa-angle-double-right"></i> China, Russia oppose UN criticism of Myanmar over Rohingya</a></li>
            </ul>
        </div>
        <div class="col-sm-4">
            <ul class="list-unstyled nav navbar">
                <li><a href=""><i class="fa fa-angle-double-right"></i> Mirza Abbas, his wife get anticipatory bail</a></li>
                <li><a href=""><i class="fa fa-angle-double-right"></i> Joy, relief as Singaporean cameraman returns after two months in Myanmar prison</a></li>
                <li><a href=""><i class="fa fa-angle-double-right"></i> Suicide bomb attack kills 6 Afghan police</a></li>
                <li><a href=""><i class="fa fa-angle-double-right"></i> China, Russia oppose UN criticism of Myanmar over Rohingya</a></li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
