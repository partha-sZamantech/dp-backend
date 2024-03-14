@extends('backend.app')

@section('title', 'Magazine Edit')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('magazines.index') }}"><i class="fa fa-dashboard"></i> Magazine List</a></li>
            <li class="active">Magazine Edit</li>
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
                        <h3 class="box-title">Magazine Edit</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('magazines.update', $magazine->id) }}" method="post"
                          enctype="multipart/form-data" class="form-horizontal col-sm-offset-1">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="magazine_name" class="col-sm-2 control-label">Magazine name <span class="required">*</span></label>
                                <div class="col-sm-7">
                                    <input type="text" name="magazine_name" class="form-control" id="magazine_name" placeholder="Magazine name" value="{{ $magazine->name }}">
                                    @if($errors->has('magazine_name')) <span
                                        class="text-danger">{{ $errors->first('magazine_name') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="meta_keywords" class="col-sm-2 control-label">Meta Keywords <span class="required">*</span></label>
                                <div class="col-sm-7">
                                    <input type="text" name="meta_keywords" class="form-control" id="meta_keywords"
                                           placeholder="Comma seperated meta keywords" value="{{ $magazine->meta_keywords }}">
                                    @if($errors->has('meta_keywords')) <span
                                        class="text-danger">{{ $errors->first('meta_keywords') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="meta_description" class="col-sm-2 control-label">Meta Description <span class="required">*</span></label>
                                <div class="col-sm-7">
                                    <textarea name="meta_description" class="form-control" id="meta_description" placeholder="Meta Description">{{ $magazine->meta_description }}</textarea>
                                    @if($errors->has('meta_description')) <span class="text-danger">{{ $errors->first('meta_description') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="share_image" class="col-sm-2 control-label">Social Share Image <span class="required">*</span></label>
                                <div class="col-sm-7">
                                    <img src="{{ asset(config('appconfig.commonImagePath').$magazine->og_img_path) }}" style="width: 30%">
                                    <div class="text-info" style="margin-bottom: 5px;">Dimension: 750 X 390 pixel & Max size: 100kb</div>
                                    <input type="file" name="share_image" id="share_image" class="form-control col-sm-6" style="height: auto">
                                    @if($errors->has('share_image')) <span class="text-danger">{{ $errors->first('share_image') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-8">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" {{ $magazine->status == 1 ? 'checked' : '' }}>Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="2" {{ $magazine->status == 2 ? 'checked' : '' }}>Inactive
                                    </label>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                    <button type="submit" class="btn btn-info">Update</button>
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
