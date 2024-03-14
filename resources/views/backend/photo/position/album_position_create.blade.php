@extends('backend.app')

@section('title', 'Photo Album Position Create')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('bn-content-position.index') }}">Album Position List</a></li>
        <li class="active">Add Position</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <form action="{{ route('photo-album-positions.store') }}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                <div class="col-sm-12">
                    <div class="box box-solid">
                        <div class="box-group" id="accordion">
                            <div class="box box-default">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="position_name">Position Name <span class="required">*</span></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="position_name" id="position_name">
                                            @if($errors->has('position_name')) <span class="text-danger">{{ $errors->first('position_name') }}</span>@endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="category_id">Category ID</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" name="category_id" id="category_id">
                                            @if($errors->has('category_id')) <span class="text-danger">{{ $errors->first('category_id') }}</span>@endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="special_cat_id">Special Category ID</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" name="special_cat_id" id="special_cat_id">
                                            @if($errors->has('special_cat_id')) <span class="text-danger">{{ $errors->first('special_cat_id') }}</span>@endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="subcat_id">Sub Category ID</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" name="subcat_id" id="subcat_id">
                                            @if($errors->has('subcat_id')) <span class="text-danger">{{ $errors->first('subcat_id') }}</span>@endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="totalContent">Total Content</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" name="totalContent" id="totalContent">
                                            @if($errors->has('totalContent')) <span class="text-danger">{{ $errors->first('totalContent') }}</span>@endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Status</label>
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
                                        <div class="col-sm-3 control-label"></div>
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-info"><i class="fa fa-plus"></i> Insert</button>
                                            <a href="{{ route('photo-album-positions.index') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
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
