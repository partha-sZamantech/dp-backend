@extends('backend.app')

@section('title', 'Ad Create')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('bn-mobile-ads.index') }}">Mobile Ads Position List</a></li>
            <li class="active">Create Ad Position</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <!-- form start -->
                    <form action="{{ route('bn-mobile-ads.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="ad_page" class="col-sm-2 control-label">Ad Type</label>
                                <div class="col-sm-6">
                                    <select class="form-control col-sm-6" name="ad_type" id="ad_type" onchange="showAdType(this)">
                                        @foreach(config('customdata.ad_types') as $key => $ad_type)
                                            <option value="{{ $key }}">{{ $ad_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ad_page" class="col-sm-2 control-label">Ad Page</label>
                                <div class="col-sm-6">
                                    <select class="form-control col-sm-6" name="ad_page" id="ad_page" onchange="showPositions(this)">
                                        @foreach(config('customdata.ad_pages') as $key => $ad_page)
                                            <option value="{{ $key }}">{{ $ad_page }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ad_position" class="col-sm-2 control-label">Ad Position</label>
                                <div class="col-sm-6">
                                    <select class="form-control col-sm-6" name="ad_position" id="ad_position">
                                        @foreach(config('customdata.mobile_ad_positions')[1] as $key => $ad_position)
                                            <option value="{{ $key }}">{{ $ad_position }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group type-dfp">
                                <label for="header_code" class="col-sm-2 control-label">Header Code</label>

                                <div class="col-sm-6">
                                    <textarea name="header_code" id="header_code" class="form-control" placeholder="<Header Code/>" rows="2" required></textarea>
                                </div>
                            </div>

                            <div class="form-group type-code type-dfp">
                                <label for="code" class="col-sm-2 control-label">Code</label>

                                <div class="col-sm-6">
                                    <textarea name="code" id="code" class="form-control" placeholder="<Code/>" rows="5" required></textarea>
                                </div>
                            </div>

{{--                            <div class="form-group type-image" style="display: none">--}}
{{--                                <label for="desktop_image_path" class="col-sm-2 control-label">Desktop Image</label>--}}
{{--                                <div class="col-sm-6">--}}
{{--                                    <input type="file" name="desktop_image_path" id="desktop_image_path" accept="image/*" class="form-control col-sm-6" style="height: auto">--}}
{{--                                    @if($errors->has('desktop_image_path'))--}}
{{--                                        <span class="text-danger">{{ $errors->first('desktop_image_path') }}</span> @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="form-group type-image" style="display: none">
                                <label for="mobile_image_path" class="col-sm-2 control-label">Mobile Image</label>
                                <div class="col-sm-6">
                                    <input type="file" name="mobile_image_path" id="mobile_image_path" accept="image/*" class="form-control col-sm-6" style="height: auto">
                                    @if($errors->has('mobile_image_path'))
                                        <span class="text-danger">{{ $errors->first('mobile_image_path') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group type-image" style="display: none">
                                <label for="external_link" class="col-sm-2 control-label">External Link</label>

                                <div class="col-sm-6">
                                    <input type="text" name="external_link" class="form-control" id="external_link" placeholder="Link">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="start_time" class="col-sm-2 control-label">Start Time</label>

                                <div class="col-sm-6">
                                    <input type=datetime-local step=1 name="start_time" id="start_time" class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="end_time" class="col-sm-2 control-label">End Time</label>

                                <div class="col-sm-6">
                                    <input type=datetime-local step=1 name="end_time" id="end_time" class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" checked>Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="2">Inactive
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                    <button type="submit" class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection

@section('custom-js')
    <script>
        let adPosition = document.querySelector('#ad_position');
        let positions = @json(config('customdata.mobile_ad_positions'));

        let dfpItems = document.querySelectorAll('.type-dfp');
        let codeItems = document.querySelectorAll('.type-code');
        let imageItems = document.querySelectorAll('.type-image');

        function showPositions(event) {
            adPosition.innerHTML = '';
            Object.keys(positions).forEach(function (key) {
                if (key == event.value) {
                    let vales = positions[key];
                    Object.keys(vales).forEach(function (key) {
                        let option = document.createElement('option');
                        option.value = key;
                        option.text = vales[key]
                        adPosition.append(option);
                    });
                }
            });
        }

        function showAdType(event) {
            if (event.value == 1) {//dfp
                imageItems.forEach(item => {
                    item.style.display = 'none';
                    item.querySelector('input').required = false;
                });
                codeItems.forEach(item => {
                    item.style.display = 'none';
                    item.querySelector('textarea').required = false;
                });
                dfpItems.forEach(item => {
                    item.style.display = 'block';
                    item.querySelector('textarea').required = true;
                });
            } else if (event.value == 2) {//html
                imageItems.forEach(item => {
                    item.style.display = 'none';
                    item.querySelector('input').required = false;
                });
                dfpItems.forEach(item => {
                    item.style.display = 'none';
                    item.querySelector('textarea').required = false;
                });
                codeItems.forEach(item => {
                    item.style.display = 'block';
                    item.querySelector('textarea').required = true;
                });

            } else if (event.value == 3){//image
                codeItems.forEach(item => {
                    item.style.display = 'none';
                    item.querySelector('textarea').required = false;
                });
                dfpItems.forEach(item => {
                    item.style.display = 'none';
                    item.querySelector('textarea').required = false;
                });
                imageItems.forEach((item, index) => {
                    item.style.display = 'block';
                    // Skip the mobile image
                    if (index != 1) {
                        item.querySelector('input').required = true;
                    }
                });
            } else { // Google AdSense
                imageItems.forEach(item => {
                    item.style.display = 'none';
                    item.querySelector('input').required = false;
                });
                dfpItems.forEach(item => {
                    item.style.display = 'none';
                    item.querySelector('textarea').required = false;
                });
                codeItems.forEach(item => {
                    item.style.display = 'block';
                    item.querySelector('textarea').required = true;
                });
            }
        }
    </script>
@endsection
