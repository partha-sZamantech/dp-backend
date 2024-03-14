@extends('frontend.bn.app')

@section('title', 'পাঠক জরিপ । ঢাকা প্রকাশ')

@section('customMeta')
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="/poll"/>
    <meta property="og:site_name" content="{{ config('app.url') }}"/>
    <meta property="og:title" content="পাঠক জরিপ - ঢাকাপ্রকাশ"/>
    <meta property="og:image" content="{{ asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->og_image) }}"/>
    <meta name="keywords" content="পাঠক জরিপ, ঢাকাপ্রকাশ">
    <meta property="og:description" content="ঢাকাপ্রকাশ কর্তৃক আয়োজিত পাঠক জরিপে অংশগ্রহণ করুন"/>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@dhakaprokash24">
    <meta name="twitter:title" content="পাঠক জরিপ - ঢাকাপ্রকাশ">
    <meta name="twitter:description" content="ঢাকাপ্রকাশ কর্তৃক আয়োজিত পাঠক জরিপে অংশগ্রহণ করুন">
    <meta name="twitter:image" content="{{ asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->og_image) }}">
    <meta name="description" content="ঢাকাপ্রকাশ কর্তৃক আয়োজিত পাঠক জরিপে অংশগ্রহণ করুন"/>

    <link rel="canonical" href="{{url('/poll')}}">

@endsection

@section('custom-css')
    <style>
        .inactive-poll-title {
            font-size: 19px;
            font-weight: bold;
            text-align: center;
            line-height: 1.5;
        }

        .poll-title {
            font-size: 17px;
            font-weight: bold;
            padding: 5px;
            text-align: center;
        }

        label.btn span {
            font-size: 15px;
        }

        label input[type="radio"] ~ i.fa.fa-circle-o {
            color: #404040;
            display: inline;
        }

        label input[type="radio"] ~ i.fa.fa-circle {
            display: none;
        }

        label input[type="radio"]:checked ~ i.fa.fa-circle-o {
            display: none;
        }

        label input[type="radio"]:checked ~ i.fa.fa-circle {
            color: #3375af;
            display: inline;
        }

        label:hover input[type="radio"] ~ i.fa {
            color: #3375af;
        }

        div[data-toggle="buttons"] {
            display: grid;
        }

        div[data-toggle="buttons"] label.active {
            color: #3375af;
        }

        .option {
            display: inline-block;
            padding: 6px 12px;
            background-color: #ecf4fb;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: normal;
            line-height: 2em;
            text-align: left;
            white-space: nowrap;
            vertical-align: top;
            cursor: pointer;
            border-radius: 6px;
            color: #404040;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;
            user-select: none;
        }

        div[data-toggle="buttons"] label:hover {
            color: #3375af;
        }

        div[data-toggle="buttons"] label:active, div[data-toggle="buttons"] label.active {
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .btn_vote {
            width: 100%;
            border: none;
            font-size: 15px !important;
        }

        .btn_vote_share {
            width: 100%;
            background-image: linear-gradient(to right, #405DE6, #833AB4, #1DA1F2);
            color: white;
            border: none;
            font-size: 15px !important;
        }

        .btn_vote_share:hover {
            color: yellow;
        }

        .highest-voted {
            background-color: #d8edff !important;
        }

        .d-none {
            display: none;
        }

        .selected_option {
            background-color: white !important;
            border: 1px solid #1DA1F2 !important;
            pointer-events: none !important;
            opacity: 0.5 !important;
        }

        .item .panel {
            border: 1px solid #ececec;;
        }

        .text-bold {
            font-weight: bold;
        }

        /*Chart CSS*/

        .column-chart {
            position: relative;
            z-index: 20;
            bottom: 0;
            left: 50%;
            width: 100%;
            height: 170px;
            margin-top: 10px;
            margin-left: -50%;
        }

        @media (min-width: 1024px) {
            .column-chart {
                width: 65%;
                margin-left: -43%;
            }
        }

        .column-chart:before,
        .column-chart:after {
            position: absolute;
            content: '';
            top: 0;
            left: 0;
            width: calc(100% + 30px);
            height: 25%;
            margin-left: -15px;
            border-top: 1px dashed #b4b4b5;
            border-bottom: 1px dashed #b4b4b5;
        }

        .column-chart:after {
            top: 50%;
        }

        .column-chart > .legend {
            position: absolute;
            z-index: -1;
            top: 0;
        }

        .column-chart > .legend.legend-left {
            left: 0;
            width: 25px;
            height: 75%;
            margin-left: -55px;
            border: 1px solid #b4b4b5;
            border-right: none;
        }

        .column-chart > .legend.legend-left > .legend-title {
            display: block;
            position: absolute;
            top: 50%;
            left: 0;
            width: 65px;
            height: 50px;
            line-height: 50px;
            margin-top: -25px;
            margin-left: -60px;
            font-size: 28px;
            letter-spacing: 1px;
        }

        .column-chart > .legend.legend-right {
            right: 0;
            width: 100px;
            height: 100%;
            margin-right: -57px;
        }

        .column-chart > .legend.legend-right > .item {
            position: relative;
            width: 100%;
            height: 25%;
        }

        .column-chart > .legend.legend-right > .item > h4 {
            display: block;
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 40px;
            line-height: 40px;
            margin-top: -20px;
            font-size: 16px;
            text-align: right;
        }

        .column-chart > .chart {
            position: relative;
            z-index: 20;
            bottom: 0;
            left: 50%;
            width: 98%;
            height: 100%;
            margin-left: -49%;
        }

        .column-chart > .chart > .item {
            position: relative;
            float: left;
            height: 100%;
        }

        .column-chart > .chart > .item:before {
            position: absolute;
            z-index: -1;
            content: '';
            bottom: 0;
            left: 50%;
            width: 1px;
            height: calc(100% + 15px);
            /*border-right: 1px dashed #b4b4b5;*/
        }

        .column-chart > .chart > .item > .bar {
            position: absolute;
            bottom: 0;
            left: 3px;
            width: 85%;
            height: 100%;
        }

        .column-chart > .chart > .item > .bar > span.percent {
            display: block;
            position: absolute;
            z-index: 25;
            bottom: -26px;
            left: 0;
            width: 100%;
            height: 26px;
            line-height: 26px;
            color: #fff;
            background-color: #3e50b4;
            font-size: 14px;
            font-weight: 700;
            text-align: center;
            letter-spacing: 1px;
        }

        .column-chart > .chart > .item > .bar > .item-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 20%;
            color: #fff;
            /*background-color: #ff4081;*/
        }

        .column-chart > .chart > .item > .bar > .item-progress > .title {
            position: absolute;
            bottom: 30px;
            left: 50%;
            font-size: 20px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
            -moz-transform: translateX(-50%) translateY(-50%) rotate(-90deg);
            -webkit-transform: translateX(-50%) translateY(-50%) rotate(-90deg);
            transform: translateX(-50%) translateY(-50%) rotate(-90deg);
            font-weight: bold;
            color: #b0d8fb;
        }

        /*@media (min-width: 360px) {*/
        /*    .column-chart > .chart > .item > .bar > .item-progress > .title {*/
        /*        font-size: 16px;*/
        /*    }*/
        /*}*/

        /*@media (min-width: 480px) {*/
        /*    .column-chart > .chart > .item > .bar > .item-progress > .title {*/
        /*        font-size: 20px;*/
        /*        font-weight: bold;*/
        /*        !*color: #00427a;*!*/
        /*        color: #b0d8fb;*/
        /*    }*/
        /*}*/
        /*End Chart CSS*/

        .result-row {
            border-bottom: 1px solid #eee;
        }

        .poll-image {
            width: 100%;
        }

    </style>
@endsection

@section('mainContent')
    <div class="main-content marginTop10">
        <div class="container">
            <div class="row marginTop20">
                @foreach($active_polls as $poll)
                    @php
                        $yes_percentage         = round($poll->yes_vote > 0 ? ($poll->yes_vote * 100) / $poll->total_vote : 0);
                        $no_percentage          = round($poll->no_vote > 0 ? ($poll->no_vote * 100) / $poll->total_vote : 0) ;
                        $no_opinion_percentage  = round($poll->no_opinion > 0 ? ($poll->no_opinion * 100) / $poll->total_vote : 0);
                    @endphp
                    <div class="col-sm-3">
                        <div class="item">
                            <div class="panel">
                                <div class="panel-header">
                                    <img class="img-responsive poll-image"
                                         src="{{ asset(config('appconfig.pollImagePath') . $poll->sm_image_path) }}">
                                </div>
                                <div class="panel-body">
                                    <p class="poll-title">{{ $poll->poll_title }}</p>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="options" data-toggle="buttons">
                                                <label class="btn option option_{{ $poll->poll_id }} {{ $yes_percentage >= $no_percentage && $yes_percentage >= $no_opinion_percentage ? 'highest-voted' : null }}">
                                                    <input class="opinion" type="radio" name="opinion{{ $poll->poll_id }}"
                                                           value="1">
                                                    <i class="fa fa-circle-o"></i>
                                                    <i class="fa fa-circle"></i>
                                                    <span>  হ্যা</span>
                                                    <span class="pull-right text-bold">  {{ $yes_percentage }}%</span>
                                                </label>
                                                <label class="btn option option_{{ $poll->poll_id }} {{ $no_percentage >= $yes_percentage && $no_percentage >= $no_opinion_percentage ? 'highest-voted' : null }}">
                                                    <input class="opinion" type="radio" name="opinion{{ $poll->poll_id }}"
                                                           value="2">
                                                    <i class="fa fa-circle-o"></i>
                                                    <i class="fa fa-circle"></i>
                                                    <span> না</span>
                                                    <span class="pull-right text-bold">  {{ $no_percentage }}%</span>
                                                </label>
                                                <label class="btn option option_{{ $poll->poll_id }} {{ $no_opinion_percentage >= $yes_percentage && $no_opinion_percentage >= $no_percentage ? 'highest-voted' : null }}">
                                                    <input class="opinion" type="radio" name="opinion{{ $poll->poll_id }}"
                                                           value="0">
                                                    <i class="fa fa-circle-o"></i>
                                                    <i class="fa fa-circle"></i>
                                                    <span> মন্তব্য নেই</span>
                                                    <span class="pull-right text-bold">  {{ $no_opinion_percentage }}%</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <button class="btn btn-primary btn_vote d-none" id="btnChange{{ $poll->poll_id }}" onclick="change_vote({{ $poll->poll_id }})">ভোট পরিবর্তন</button>
                                    <button class="btn btn-primary btn_vote" id="btnVote{{ $poll->poll_id }}"
                                            onclick="submit_vote({{ $poll->poll_id }})">ভোট দিন
                                    </button>
                                    <a class="btn btn_vote_share marginTop5" id="btnShare" href="//www.facebook.com/sharer.php?u=https://www.dhakaprokash24.com/poll" target="_blank">
                                        <i class="fa fa-facebook-square" style="margin-right: 8px;"></i>শেয়ার করুন
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-sm-3">
                    {{-- Category Right One Ad--}}
                    @include('frontend.bn.ads.category.category-right-one-ad')

                    {{-- Category Right Two Ad--}}
                    @include('frontend.bn.ads.category.category-right-two-ad')
                </div>
            </div>

            <div class="row marginBottom20">
                <div class="col-sm-10">
                    <div class="row marginTop20">
                        <div class="col-sm-12">
                            <div class="common-title common-title-brown mb-4">
                        <span class="common-title-shape">
                            <a class="common-title-link" href="javascript:void(0)">ফলাফল</a>
                        </span>
                            </div>
                        </div>
                    </div>

                    @foreach($inactive_polls as $key => $poll)
                        @php
                            $yes_percentage         = round($poll->yes_vote > 0 ? ($poll->yes_vote * 100) / $poll->total_vote : 0);
                            $no_percentage          = round($poll->no_vote > 0 ? ($poll->no_vote * 100) / $poll->total_vote : 0) ;
                            $no_opinion_percentage  = round($poll->no_opinion > 0 ? ($poll->no_opinion * 100) / $poll->total_vote : 0);
                        @endphp
                        <div class="row result-row marginTop20">
                            <div class="col-sm-4">
                                <img class="img-responsive poll-image"
                                     src="{{ asset(config('appconfig.pollImagePath') . $poll->sm_image_path) }}">
                            </div>
                            <div class="col-sm-4">
                                <p class="inactive-poll-title">{{ $poll->poll_title }}</p>
                            </div>
                            <div class="col-sm-4" style="margin-bottom: 50px">
                                @if($key % 2 != 0)
                                    <div id="piechart_{{ $key }}"></div>
                                @else
                                    <div class="column-chart">
                                        <div class="legend legend-right hidden-xs">
                                            <div class="item">
                                                <h4>100%</h4>
                                            </div>
                                            <!-- //.item -->

                                            <div class="item">
                                                <h4>75%</h4>
                                            </div>
                                            <!-- //.item -->

                                            <div class="item">
                                                <h4>50%</h4>
                                            </div>
                                            <!-- //.item -->

                                            <div class="item">
                                                <h4>25%</h4>
                                            </div>
                                            <!-- //.item -->
                                        </div>
                                        <!-- //.legend -->

                                        <div class="chart clearfix">
                                            <div class="item">
                                                <div class="bar">
                                                    <span class="percent">{{ $yes_percentage }}%</span>

                                                    <div class="item-progress" data-percent="{{ $yes_percentage }}" style="background-color: #003f5c">
                                                        <span class="title">হ্যা</span>
                                                    </div>
                                                    <!-- //.item-progress -->
                                                </div>
                                                <!-- //.bar -->
                                            </div>
                                            <!-- //.item -->

                                            <div class="item">
                                                <div class="bar">
                                                    <span class="percent">{{ $no_percentage }}%</span>

                                                    <div class="item-progress" data-percent="{{ $no_percentage }}" style="background-color: #bc5090">
                                                        <span class="title">না</span>
                                                    </div>
                                                    <!-- //.item-progress -->
                                                </div>
                                                <!-- //.bar -->
                                            </div>
                                            <!-- //.item -->

                                            <div class="item">
                                                <div class="bar">
                                                    <span class="percent">{{ $no_opinion_percentage }}%</span>

                                                    <div class="item-progress" data-percent="{{ $no_opinion_percentage }}" style="background-color: #ffa600">
                                                        <span class="title">মন্তব্যহীন</span>
                                                    </div>
                                                    <!-- //.item-progress -->
                                                </div>
                                                <!-- //.bar -->
                                            </div>
                                            <!-- //.item -->
                                        </div>
                                        <!-- //.chart -->
                                    </div>
                                    <!-- //.column-chart -->
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection

@section('custom-js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <script type="text/javascript">
        const chartData = {!! $output !!} ;

        // Load google charts
        google.charts.load('current', {'packages':['corechart']});

        chartData.forEach((value, index) => {
            if(index % 2 !== 0) {
                google.charts.setOnLoadCallback(drawChart);

                // Draw the chart and set the chart values
                function drawChart() {
                    var data = google.visualization.arrayToDataTable(chartData[index]);

                    // Optional; add a title and set the width and height of the chart
                    var options = {
                        'width':400,
                        'height':210,
                        is3D: true,
                        'chartArea': {'width': '100%', 'height': '100%'}
                    };

                    // Display the chart inside the <div> element with id="piechart"
                    var chart = new google.visualization.PieChart(document.getElementById('piechart_' + index));
                    chart.draw(data, options);
                }
            }
        });

    </script>

    <script>
        // Bar Chart
        $(document).ready(function(){
            columnChart();

            function columnChart(){
                var item = $('.chart', '.column-chart').find('.item'),
                    itemWidth = 100 / 3;
                item.css('width', itemWidth + '%');

                $('.column-chart').find('.item-progress').each(function(){
                    var itemProgress = $(this),
                        itemProgressHeight = $(this).parent().height() * ($(this).data('percent') / 100);
                    itemProgress.css('height', itemProgressHeight);
                });
            };
        });
        // Bar Chart End

        const votes = [];

        function submit_vote(poll_id) {
            const active_input = $("input:radio.opinion:checked");
            const active_option = active_input.closest("label");

            if (active_input.val()) {
                active_option.addClass("selected_option");
                active_input.prop("checked", false);

                $('.option_' + poll_id).removeClass("highest-voted");
                $('.option_' + poll_id).not(active_option).removeClass("selected_option");
                $('.option_' + poll_id).addClass("option");

                votes[poll_id] = active_input.val();

                $.post('{{ route('poll.submit_vote') }}',
                    {'_token': '{{ csrf_token() }}', 'poll_id': poll_id, 'value': active_input.val()},
                    function (data) {
                        $('#btnVote' + data).addClass('d-none');
                        $('#btnChange' + data).removeClass('d-none');
                    });
            }

        }

        function change_vote(poll_id) {
            const active_input = $("input:radio.opinion:checked");
            const active_option = active_input.closest("label");

            if (active_input.val()) {
                active_option.addClass("selected_option");
                active_input.prop("checked", false);

                $('.option_' + poll_id).removeClass("highest-voted");
                $('.option_' + poll_id).not(active_option).removeClass("selected_option");
                $('.option_' + poll_id).addClass("option");

                $.post('{{ route('poll.change_vote') }}',
                    {'_token': '{{ csrf_token() }}', 'poll_id': poll_id, 'value': active_input.val(), 'votes': votes},
                    function (data) {
                        votes[data.poll_id] = data.value;
                    });
            }
        }

    </script>
@endsection
