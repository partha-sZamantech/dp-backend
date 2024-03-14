@extends('frontend.en.app')

@section('title', 'Archive | Dhaka Prokash')

@section('custom-css')
    <link rel="stylesheet"
          href="{{ asset('frontend-assets/plugins/tiny-date-picker-master/tiny-date-picker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend-assets/plugins/tiny-date-picker-master/date-range-picker.css') }}">
@endsection

@section('customMeta')
    <link rel="canonical" href="{{ fEnRoot('archive') }}">
    <meta name="description" content="{{ Cache::get('enSiteSettings')->meta_description }}"/>

    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ fEnRoot('archive') }}"/>
    <meta property="og:title" content="Archive | Dhaka Prokash"/>
    <meta property="og:image"
          content="{{ asset(config('appconfig.commonImagePath').Cache::get('enSiteSettings')->og_image) }}"/>
    <meta property="og:description" content="{{ Cache::get('enSiteSettings')->meta_description }}"/>

    <meta name="twitter:title" content="Archive | Dhaka Prokash">
    <meta name="twitter:description" content="{{ Cache::get('enSiteSettings')->meta_description }}">
    <meta name="twitter:image"
          content="{{ asset(config('appconfig.commonImagePath').Cache::get('enSiteSettings')->og_image) }}">
@endsection

@section('mainContent')

    <div class="main-content marginTop10">
        <div class="container">
            <!-- Top Section -->
            <p class="breadcrumb">
                <a href="{{ fEnRoot() }}"><i class="fa fa-home"></i></a>
                <span>&raquo;</span>
                <a href="{{ fEnRoot('archive') }}" class="active color-text">All News</a>
            </p>
            <div class="archive-search">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="custom-select details-font">
                                <select name="cat">
                                    <option value="">-- Category --</option>
                                    @foreach($categories as $category)
                                        <option
                                            value="{{ $category->cat_id }}"{{ $category->cat_id == $catId ? ' selected' : '' }}>{{ $category->cat_name }}</option>
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
                            <script
                                src="{{ asset('frontend-assets/plugins/tiny-date-picker-master/dist/date-range-picker.min.js') }}"></script>
                            <div class="ex-inputs">
                                <div class="ex-inputs-header">
                                    <!--<input class="ex-inputs-start" placeholder="তারিখ " />
                                    থেকে
                                    <input class="ex-inputs-end" placeholder="পর্যন্ত " />-->
                                    <div class="input-group">
                                        <label for="dateFrom" class="input-group-addon details-font">Date <i
                                                class="fa fa-calendar"></i></label>
                                        <input name="dateFrom" class="form-control ex-inputs-start" id="dateFrom"
                                               type="text" value="{{ $dateFrom ?? '' }}" placeholder="From">
                                        <label for="dateTo" class="input-group-addon details-font">To <i
                                                class="fa fa-calendar"></i></label>
                                        <input name="dateTo" class="form-control ex-inputs-end" id="dateTo" type="text"
                                               value="{{ $dateTo ?? '' }}" placeholder="To">
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
                                <input type="text" name="keyword" value="{{ $keyword ?? '' }}"
                                       class="form-control details-font" placeholder="Search here...">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="submit"><i class="fa fa-search"></i> <span
                                            class="hidden-xs details-font" style="color:white;">Search</span></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <a href="{{ fEnRoot('archive') }}" class="btn btn-primary details-font"
                               style="color: white"><i class="fa fa-refresh"></i> All News</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row marginBottom20">
                <div class="col-sm-12">
                    <div class="archive-box">

                        @foreach($contents as $content)

                            @php($sURL = fEnURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))

                            <div class="single-archive-item">
                                <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="imgbox">
                                                <img
                                                    src="{{ $content->img_sm_path ? asset(config('appconfig.contentImagePath').$content->img_sm_path) : asset(config('appconfig.commonImagePath').'sm-default.jpg') }}"
                                                    class="img-responsive" alt="{{ $content->content_heading }}"
                                                    title="{{ $content->content_heading }}">
                                            </div>

                                        </div>
                                        <div class="col-sm-9">
                                            <h3 class="headline-font">
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
                                            </h3>
                                            <p class="hidden-xs text-muted details-font"
                                               style="font-size: 17px">{{ $content->content_brief }}</p>
                                            <small class="text-muted">
                                                <a href="{{ fEnRoot($content->category->cat_slug) }}"
                                                   class="jC_tag details-font color-text"> {{ $content->category->cat_name }} </a>
                                                | <i class="fa fa-calendar"></i>
                                                <span
                                                    class="details-font"> {{ date('d F Y, h:i a, l', strtotime($content->created_at)) }} </span>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                        <hr>
                        {{ $contents->appends(['cat' => request('cat'), 'dateFrom' => request('dateFrom'), 'dateTo' => request('dateTo'), 'keyword' => request('keyword')])->links('vendor.pagination.en-default') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
