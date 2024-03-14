@extends('backend.app')

@section('title', 'Upload Manual Photo')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('manual-photos.index') }}">Manual Photo List</a></li>
        <li class="active">Add Manual Photo</li>
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
              <h3 class="box-title">Upload Manual Photo</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route('manual-photos.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-offset-1">
              {{ csrf_field() }}
              <div class="box-body">
                  <div class="form-group">
                      <label for="manualPhoto" class="col-sm-2 control-label">Choose Photo</label>
                      <div class="col-sm-6">
                          <input type="file" name="manualPhoto" id="manualPhoto" class="form-control col-sm-6" style="height: auto">
                          @if($errors->has('manualPhoto'))
                              <span class="text-danger">{{ $errors->first('manualPhoto') }}</span> @endif
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
