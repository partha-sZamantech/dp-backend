@extends('backend.app')

@section('title', 'Edit Manual Document')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('manual-docs.index') }}">Manual Document List</a></li>
        <li class="active">Edit Manual Document</li>
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
              <h3 class="box-title">Edit Manual Document</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ route('manual-docs.update', $doc->doc_id) }}" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-offset-1">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="box-body">
              	<div class="form-group">
              		<img src="{{ asset(config('appconfig.documentPath').$doc->doc_path) }}">
              	</div>
                <div class="form-group">
                  <label for="manualDocument" class="col-sm-2 control-label">Change Document</label>
                  <div class="col-sm-6">
                    <input type="file" name="manualDocument" id="manualDocument" class="form-control col-sm-6" style="height: auto">
                    @if($errors->has('manualDocument')) <span class="text-danger">{{ $errors->first('manualDocument') }}</span> @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-6">
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