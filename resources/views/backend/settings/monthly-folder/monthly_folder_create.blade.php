@extends('backend.app')

@section('title', 'Create Monthly Folder')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('monthly-folders.index') }}">Monthly Folder List</a></li>
        <li class="active">Add Monthly Folder</li>
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
              <h3 class="box-title">Create Folder</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route('monthly-folders.store') }}" method="post" class="form-horizontal col-sm-offset-1">
            {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="folder_name" class="col-sm-2 control-label">Folder name <span class="required">*</span></label>

                  <div class="col-sm-6">
                    <input type="text" name="folder_name" class="form-control" id="folder_name" value="{{ date('YF') }}">
                    @if($errors->has('folder_name')) <span class="text-danger">{{ $errors->first('folder_name') }}</span> @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-6">
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