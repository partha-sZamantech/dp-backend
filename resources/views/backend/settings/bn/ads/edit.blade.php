@extends('backend.app')

@section('title', 'Ad Edit')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('bn-ads.index') }}">Ads Position List</a></li>
            <li class="active">Edit Ad Position</li>
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
                    <form action="{{ route('bn-ads.update', $ad->id) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="ad_page" class="col-sm-2 control-label">Ad Type</label>
                                <div class="col-sm-6">
                                    <select class="form-control col-sm-6" name="ad_type" id="ad_type" onchange="showAdType(this)">
                                        @foreach(config('customdata.ad_types') as $key => $ad_type)
                                            <option value="{{ $key }}" {{ $ad->type == $key ? 'selected' : '' }}>{{ $ad_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ad_page" class="col-sm-2 control-label">Ad Page</label>
                                <div class="col-sm-6">
                                    <div class="form-control" id="external_link">{{ config('customdata.ad_pages')[$ad->page] }}</div>
                                    {{--<select class="form-control col-sm-6" name="ad_page" id="ad_page" onchange="showPositions(this)">
                                        @foreach(config('customdata.ad_pages') as $key => $ad_page)$ad->page
                                            <option value="{{ $key }}" {{ $ad->page == $key ? 'selected' : '' }}>{{ $ad_page }}</option>
                                        @endforeach
                                    </select>--}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ad_position" class="col-sm-2 control-label">Ad Position</label>
                                <div class="col-sm-6">
                                    <div class="form-control" id="external_link">{{ config('customdata.ad_positions')[$ad->page][$ad->position] }}</div>
                                    {{--<select class="form-control col-sm-6" name="ad_position" id="ad_position">
                                        @foreach(config('customdata.ad_positions')[$ad->page] as $key => $ad_position)
                                            <option value="{{ $key }}" {{ $ad->position == $key ? 'selected' : '' }}>{{ $ad_position }}</option>
                                        @endforeach
                                    </select>--}}
                                </div>
                            </div>

                            <div class="form-group type-dfp" style="display: {{$ad->type == 1 ? 'block' : 'none'}}">
                                <label for="header_code" class="col-sm-2 control-label">Header Code</label>

                                <div class="col-sm-6">
                                    <textarea name="header_code" id="header_code" class="form-control" placeholder="<Header Code/>" rows="2">{{$ad->dfp_header_code}}</textarea>
                                </div>
                            </div>

                            <div class="form-group type-code type-dfp" style="display: {{$ad->type == 1 || $ad->type == 2 || $ad->type == 4 ? 'block' : 'none'}}">
                                <label for="code" class="col-sm-2 control-label">Code</label>

                                <div class="col-sm-6">
                                    <textarea name="code" id="code" class="form-control" placeholder="<Code/>" rows="5">{{$ad->code}}</textarea>
                                </div>
                            </div>

                            <div class="form-group type-image" style="display: {{$ad->type == 3 ? 'block' : 'none'}}">
                                <label for="desktop_image_path" class="col-sm-2 control-label">Desktop Image</label>
                                <div class="col-sm-6">
                                    @if(!empty($ad->desktop_image_path))
                                        <img src="{{ asset(config('appconfig.adPath').$ad->desktop_image_path) }}" alt="ad-image" style="width: 300px; margin-bottom: 10px;">
                                    @endif
                                    <input type="file" name="desktop_image_path" id="desktop_image_path" accept="image/*" class="form-control col-sm-6" style="height: auto">
                                    @if($errors->has('desktop_image_path'))
                                        <span class="text-danger">{{ $errors->first('desktop_image_path') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group type-image" style="display: {{$ad->type == 3 ? 'block' : 'none'}}">
                                <label for="mobile_image_path" class="col-sm-2 control-label">Mobile Image</label>
                                <div class="col-sm-6">
                                    @if(!empty($ad->mobile_image_path))
                                        <img src="{{ asset(config('appconfig.adPath').$ad->mobile_image_path) }}" alt="ad-image" style="width: 300px; margin-bottom: 10px;">
                                    @endif
                                    <input type="file" name="mobile_image_path" id="mobile_image_path" accept="image/*" class="form-control col-sm-6" style="height: auto">
                                    @if($errors->has('mobile_image_path'))
                                        <span class="text-danger">{{ $errors->first('mobile_image_path') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group type-image" style="display: {{$ad->type == 3 ? 'block' : 'none'}}">
                                <label for="external_link" class="col-sm-2 control-label">External Link</label>

                                <div class="col-sm-6">
                                    <input type="text" name="external_link" class="form-control" id="external_link" placeholder="Link" value="{{$ad->external_link}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="start_time" class="col-sm-2 control-label">Start Time</label>

                                <div class="col-sm-6">
                                    <input type=datetime-local step=1 name="start_time" id="start_time" class="form-control" value="{{$ad->start_time ? date('Y-m-d\TH:i:s', strtotime($ad->start_time)) : ''}}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="end_time" class="col-sm-2 control-label">End Time</label>

                                <div class="col-sm-6">
                                    <input type=datetime-local step=1 name="end_time" id="end_time" class="form-control" value="{{$ad->end_time ? date('Y-m-d\TH:i:s', strtotime($ad->end_time)) : ''}}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" {{ $ad->status == 1 ? 'checked' : '' }}>Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="2" {{ $ad->status == 2 ? 'checked' : '' }}>Inactive
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-info">Update</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
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
        let positions = @json(config('customdata.ad_positions'));

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
            } else if (event.value == 3) {//image
                codeItems.forEach(item => {
                    item.style.display = 'none';
                    item.querySelector('textarea').required = false;
                });
                dfpItems.forEach(item => {
                    item.style.display = 'none';
                    item.querySelector('textarea').required = false;
                });
                imageItems.forEach(item => {
                    item.style.display = 'block';
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
