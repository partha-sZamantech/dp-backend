@extends('backend.app')

@section('title', 'En Video Position Edit')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
          <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="active">EN Video Position</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <form action="{{ route('en-video-position.update', $position->position_id) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="col-sm-12">
                    <div class="box box-solid">
                        <div class="box-group" id="accordion">
                            <div class="box box-default">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="position_name">Position Name <span class="required">*</span></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="position_name" id="position_name" value="{{ $position->position_name }}">
                                            @if($errors->has('position_name')) <span class="text-danger">{{ $errors->first('position_name') }}</span>@endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="category_id">Category ID</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" name="category_id" id="category_id" value="{{ $position->cat_id }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="subcat_id">Sub Category ID</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" name="subcat_id" id="subcat_id" value="{{ $position->subcat_id }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="totalVideo">Total Video</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="totalVideo" id="totalVideo" placeholder="Total Video" value="{{ $position->total_video }}">
                                            @if($errors->has('totalVideo')) <span class="text-danger">{{ $errors->first('totalVideo') }}</span>@endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-3 control-label"></div>
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-info"><i class="fa fa-plus"></i> Update</button>
                                            <a href="" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection