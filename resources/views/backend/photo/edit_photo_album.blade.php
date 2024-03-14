@extends('backend.app')

@section('title', 'Photo Album Edit')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('photo-albums.index') }}"><i class="fa fa-dashboard"></i> Photo Album List</a></li>
            <li class="active">Photo Album Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Photo Album Edit</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('photo-albums.update', $album->album_id) }}" method="post"
                          enctype="multipart/form-data" class="form-horizontal col-sm-offset-1">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="category" class="col-sm-2 control-label">Choose Category</label>
                                <div class="col-sm-8">
                                    <select class="form-control col-sm-6" name="category" id="category">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->cat_id }}" {{ $album->category->cat_id == $category->cat_id ? 'selected' : '' }}>{{ $category->cat_name_bn }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="albumName" class="col-sm-2 control-label">Album name <span class="required">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" name="albumName" class="form-control" id="albumName" placeholder="Album name" value="{{ $album->album_name }}">
                                    @if($errors->has('albumName')) <span class="text-danger">{{ $errors->first('albumName') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="shortDescription" class="col-sm-2 control-label">Short Description <span class="required">*</span></label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="shortDescription" rows="2" placeholder="Album Short Description">{{ $album->short_description }}</textarea>
                                    @if($errors->has('shortDescription')) <span
                                        class="text-danger">{{ $errors->first('shortDescription') }}</span> @endif
                                </div>
                            </div>

                            <div id="moreBlock">
                                @php($photos = $album->album_details)
                                @foreach($photos as $key => $photo)
                                    <div id="uploadBlock" data-no="{{ $key }}">
                                        @if(!$loop->first || !$loop->last)<hr>@endif
                                        <div class="form-group">

                                            <label for="photo" class="col-sm-2 control-label">
                                                Choose Photo
                                                @if($loop->first)<span class="required">*</span>@endif
                                            </label>
                                            <div class="col-sm-8">
                                                <img src="{{ asset(config('appconfig.photoAlbumImagePath').($photo['img'] ?? '')) }}" alt="Image">
                                                <div class="text-danger" style="margin-bottom: 5px;">Dimension: 750 X 480 pixel
                                                    &amp; Max size: 100kb
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <input type="file" name="photo[{{ $key }}]" id="photo" class="form-control" style="height: auto">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="well well-sm no-margin" style="padding: 3px 9px;">
                                                            <label><input type="checkbox" name="featureImage[{{ $key }}]" class="featureImage" id="featureImage-{{ $key }}" onchange="changeCheckbox({{ $key }})" value="2"
                                                                    {{ $photo['featureImage'] == 2 ? ' checked' : '' }}> Album Cover?</label>
                                                            @if(!$loop->first)
                                                                <button type="button" id="removeBlock" class="btn btn-xs btn-danger pull-right"><i class="fa fa-close"></i></button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($errors->has('photo')) <span class="text-danger">{{ $errors->first('photo') }}</span> @endif
                                                @if($errors->has('photo.*')) <span class="text-danger">{{ $errors->first('photo.*') }}</span> @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="photoCaption" class="col-sm-2 control-label">Photo Caption <span class="required">*</span></label>
                                            <div class="col-sm-8">
                                                <textarea name="photoCaption[{{ $key }}]" id="photoCaption" class="form-control col-sm-6" rows="3">{{ $photo['caption'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2"></label>
                                <div class="col-sm-8">
                                    <button type="button" id="addMore" class="btn btn-primary">Add More</button>
                                </div>
                            </div>
                            <hr>

                            {{--                            <div class="form-group">--}}
{{--                                <label for="photographerName" class="col-sm-2 control-label">Photographer name</label>--}}
{{--                                <div class="col-sm-8">--}}
{{--                                    <input type="text" name="photographerName" class="form-control"--}}
{{--                                           id="photographerName" placeholder="Photographer name"--}}
{{--                                           value="{{ $album->photographer_name }}">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            {{--<div class="form-group">--}}
                            {{--<label for="normal-tag" class="col-sm-2 control-label">Tag</label>--}}
                            {{--<div class="col-sm-8">--}}
                            {{--<input class="form-control" id="normal-tags" name="normalTags" autocomplete="off">--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-8">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" {{ $album->status == 1 ? 'checked' : '' }}>Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="2" {{ $album->status == 2 ? 'checked' : '' }}>Inactive
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                    <button type="submit" class="btn btn-info">Update</button>
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

    <script type="text/javascript">
        {{--$("#normal-tags").tokenInput("{{ url('backend/normaltag-search')}}",{preventDuplicates: true});--}}

        $(function () {
            // radio yes-no
            $('.radioBtn a').on('click', function () {
                var sel = $(this).data('title');
                var tog = $(this).data('toggle');
                $('#' + tog).prop('value', sel);

                $('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
                $('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
            });



            $("#addMore").click(function () {
                var nod = $("#moreBlock #uploadBlock").last().attr('data-no');
                ++nod;
                console.log(nod);

                $('#moreBlock').append(
                        `<div id="uploadBlock" data-no="`+nod+`">
                        <hr>
                        <div class="form-group">
                            <label for="photo" class="col-sm-2 control-label">Choose Photo</label>
                            <div class="col-sm-8">
                                <div class="text-danger" style="margin-bottom: 5px;">Dimension: 750 X 480 pixel
                                    &amp; Max size: 100kb
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <input type="file" name="photo[`+nod+`]" id="photo" class="form-control" style="height: auto">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="well well-sm no-margin" style="padding: 3px 9px;">
                                            <label><input type="checkbox" name="featureImage[`+nod+`]" id="featureImage-`+nod+`" class="featureImage" onchange="changeCheckbox(`+nod+`)" value="2"> Album Cover?</label>
                                            <button type="button" id="removeBlock" class="btn btn-xs btn-danger pull-right"><i class="fa fa-close"></i></button>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photoCaption" class="col-sm-2 control-label">Photo Caption</label>
                                <div class="col-sm-8">
                                    <textarea name="photoCaption[`+nod+`]" id="photoCaption" class="form-control col-sm-6" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>`
                );

            });


            $("#moreBlock").on('click', '#removeBlock', function (e) {
//                alert('ok');
                $(this).parents("#uploadBlock").remove();
            });
        });

        function changeCheckbox(id) {
            $('#moreBlock input.featureImage').not($("#featureImage-"+id)).prop('checked', false);
        }
        {{--$.get('{{ url("/backend/photo-subcat-populate?cat_id=") }}'+1, function(data){--}}
        {{--$.each(data, function(index, subcatObj){--}}
        {{--$('#subcategory').append('<option value="'+subcatObj.subcat_id+'">'+subcatObj.subcat_name_bn+'</option>');--}}
        {{--});--}}
        {{--$('#subcategory').prepend('<option value="1" selected>--None--</option>');--}}
        {{--});--}}

        {{--$('#category').on('change', function(e){ // Pre-populate subcategory dropdown--}}
        {{--console.log(e);--}}
        {{--var cat_id = e.target.value;--}}
        {{--$('#subcategory').empty();--}}
        {{--$.get('{{ url("/backend/photo-subcat-populate?cat_id=") }}'+cat_id, function(data){--}}
        {{--$.each(data, function(index, subcatObj){--}}
        {{--$('#subcategory').append('<option value="'+subcatObj.subcat_id+'">'+subcatObj.subcat_name_bn+'</option>');--}}
        {{--});--}}
        {{--$('#subcategory').prepend('<option value="1" selected>--None--</option>');--}}
        {{--});--}}
        {{--});--}}


    </script>
@endsection
