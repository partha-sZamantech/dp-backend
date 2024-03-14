@extends('frontend.bn.app')

@section('title', 'আর্কাইভ । ঢাকা প্রকাশ')

@section('custom-css')
    <link rel="stylesheet"
          href="{{ asset('frontend-assets/plugins/tiny-date-picker-master/tiny-date-picker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/tiny-date-picker-master/date-range-picker.css') }}">
@endsection

@section('customMeta')
    <link rel="canonical" href="{{ url('/archive') }}">
    <meta name="description" content="{{ Cache::get('bnSiteSettings')->meta_description }}"/>

    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url('/archive') }}"/>
    <meta property="og:title" content="আর্কাইভ । ঢাকা প্রকাশ"/>
    <meta property="og:image" content="{{ asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->og_image) }}"/>
    <meta property="og:description" content="{{ Cache::get('bnSiteSettings')->meta_description }}"/>

    <meta name="twitter:title" content="আর্কাইভ । ঢাকা প্রকাশ">
    <meta name="twitter:description" content="{{ Cache::get('bnSiteSettings')->meta_description }}">
    <meta name="twitter:image" content="{{ asset(config('appconfig.commonImagePath').Cache::get('bnSiteSettings')->og_image) }}">
@endsection

@section('mainContent')

    <div class="main-content marginTop10">
        <div class="container">
            <!-- Top Section -->
            <p class="breadcrumb">
                <a href="#"><i class="fa fa-home"></i></a>
                <span>&raquo;</span>
                <a href="#" class="active">সকল খবর</a>
            </p>
            <div class="archive-search">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="custom-select">
                                <select name="cat">
                                    <option value="">-- ক্যাটাগরি --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->cat_id }}"{{ $category->cat_id == $catId ? ' selected' : '' }}>{{ $category->cat_name_bn }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <script>
                                var x, i, j, selElmnt, a, b, c;
                                x = document.getElementsByClassName("custom-select");
                                for (i = 0; i < x.length; i++) {
                                    selElmnt = x[i].getElementsByTagName("select")[0];
                                    /*for each element, create a new DIV that will act as the selected item:*/
                                    a = document.createElement("DIV");
                                    a.setAttribute("class", "select-selected");
                                    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
                                    x[i].appendChild(a);
                                    /*for each element, create a new DIV that will contain the option list:*/
                                    b = document.createElement("DIV");
                                    b.setAttribute("class", "select-items select-hide");
                                    for (j = 1; j < selElmnt.length; j++) {
                                        /*for each option in the original select element,
                                         create a new DIV that will act as an option item:*/
                                        c = document.createElement("DIV");
                                        c.innerHTML = selElmnt.options[j].innerHTML;
                                        c.addEventListener("click", function (e) {
                                            /*when an item is clicked, update the original select box,
                                             and the selected item:*/
                                            var i, s, h;
                                            s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                                            h = this.parentNode.previousSibling;
                                            for (i = 0; i < s.length; i++) {
                                                if (s.options[i].innerHTML == this.innerHTML) {
                                                    s.selectedIndex = i;
                                                    h.innerHTML = this.innerHTML;
                                                    break;
                                                }
                                            }
                                            h.click();
                                        });
                                        b.appendChild(c);
                                    }
                                    x[i].appendChild(b);
                                    a.addEventListener("click", function (e) {
                                        e.stopPropagation();
                                        closeAllSelect(this);
                                        this.nextSibling.classList.toggle("select-hide");
                                        this.classList.toggle("select-arrow-active");
                                    });
                                }

                                function closeAllSelect(elmnt) {
                                    var x, y, i, arrNo = [];
                                    x = document.getElementsByClassName("select-items");
                                    y = document.getElementsByClassName("select-selected");
                                    for (i = 0; i < y.length; i++) {
                                        if (elmnt == y[i]) {
                                            arrNo.push(i)
                                        } else {
                                            y[i].classList.remove("select-arrow-active");
                                        }
                                    }
                                    for (i = 0; i < x.length; i++) {
                                        if (arrNo.indexOf(i)) {
                                            x[i].classList.add("select-hide");
                                        }
                                    }
                                }

                                document.addEventListener("click", closeAllSelect);
                            </script>
                        </div>
                        <div class="col-sm-5">
                            <script src="{{ asset('frontend-assets/plugins/tiny-date-picker-master/dist/date-range-picker.min.js') }}"></script>
                            <div class="ex-inputs">
                                <div class="ex-inputs-header">
                                    <!--<input class="ex-inputs-start" placeholder="তারিখ " />
                                    থেকে
                                    <input class="ex-inputs-end" placeholder="পর্যন্ত " />-->
                                    <div class="input-group">
                                        <label for="dateFrom" class="input-group-addon ">তারিখ
                                            <i class="fa fa-calendar"></i></label>
                                        <input name="dateFrom" class="form-control ex-inputs-start" id="dateFrom" type="text" value="{{ $dateFrom ?? '' }}" placeholder="তারিখ">
                                        <label for="dateTo" class="input-group-addon">থেকে
                                            <i class="fa fa-calendar"></i></label>
                                        <input name="dateTo" class="form-control ex-inputs-end" id="dateTo" type="text" value="{{ $dateTo ?? '' }}" placeholder="পর্যন্ত ">
                                    </div>
                                </div>
                                <div class="ex-inputs-picker"></div>
                            </div>
                            <script>
                                (function () {
                                    const root = document.querySelector('.ex-inputs');
                                    const txtStart = root.querySelector('.ex-inputs-start');
                                    const txtEnd = root.querySelector('.ex-inputs-end');
                                    const container = root.querySelector('.ex-inputs-picker');

                                    // Inject DateRangePicker into our container
                                    DateRangePicker.DateRangePicker(container)
                                        .on('statechange', function (_, rp) {
                                            // Update the inputs when the state changes
                                            var range = rp.state;
                                            txtStart.value = range.start ? [range.start.getFullYear(), range.start.getMonth() + 1, (range.start.getDate() < 10 ? '0' + range.start.getDate() : range.start.getDate())].join('-') : '';
                                            txtEnd.value = range.end ? [range.end.getFullYear(), range.end.getMonth() + 1, (range.end.getDate() < 10 ? '0' + range.end.getDate() : range.end.getDate())].join('-') : '';
                                        });

                                    // When the inputs gain focus, show the date range picker
                                    txtStart.addEventListener('focus', showPicker);
                                    txtEnd.addEventListener('focus', showPicker);

                                    function showPicker() {
                                        container.classList.add('ex-inputs-picker-visible');
                                    }

                                    // If focus leaves the root element, it is not in the date
                                    // picker or the inputs, so we should hide the date picker
                                    // we do this in a setTimeout because redraws cause temporary
                                    // loss of focus.
                                    var previousTimeout;
                                    root.addEventListener('focusout', function hidePicker() {
                                        clearTimeout(previousTimeout);
                                        previousTimeout = setTimeout(function () {
                                            if (!root.contains(document.activeElement)) {
                                                container.classList.remove('ex-inputs-picker-visible');
                                            }
                                        }, 10);
                                    });

                                }());
                            </script>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group" style="margin-bottom:8px;">
                                <input type="text" name="keyword" value="{{ $keyword ?? '' }}" class="form-control" placeholder="আপনি কী খুঁজছেন?">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="submit"><i class="fa fa-search"></i> <span class="hidden-xs">অনুসন্ধান</span></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <a href="{{ url('/archive') }}" class="btn btn-primary"><i class="fa fa-refresh"></i> সব সংবাদ</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row marginBottom20">
                <div class="col-sm-12">
                    <div class="archive-box">

                        @foreach($contents as $content)

                            @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                            <div class="single-archive-item">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="imgbox">
                                            <a href="{{ $sURL }}">
                                                <img src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}" class="img-responsive" alt="{{ $content->content_heading }}" title="{{ $content->content_heading }}">
                                            </a>
                                        </div>

                                    </div>

                                    <div class="col-sm-9">
                                        <small class="text-muted">
                                            <a href="{{ url($content->category->cat_slug) }}" class="jC_tag"> {{ $content->category->cat_name_bn }} </a>
                                            | <i class="fa fa-calendar"></i>
                                            {{ fFormatDateEn2Bn(date('d F Y, h:i a, l', strtotime($content->created_at))) }}
                                        </small>
                                        <h3>
                                            <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                @if(!empty($content->video_id) || !empty($content->podcast_id))
                                                    <span class="video-audio-icon">
                                                        @if(!empty($content->video_id))
                                                            <i class="fa fa-play"></i>
                                                        @endif
                                                        @if(!empty($content->podcast_id))
                                                            <i class="fa fa-volume-up"></i>
                                                        @endif
                                                    </span>
                                                @endif
                                                {{ $content->content_heading }}
                                            </a>
                                        </h3>
                                        <p class="hidden-xs text-muted">{{ $content->content_brief }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <hr>
                        {{ $contents->appends(['cat' => request('cat'), 'dateFrom' => request('dateFrom'), 'dateTo' => request('dateTo'), 'keyword' => request('keyword')])->links('vendor.pagination.bn-default') }}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
