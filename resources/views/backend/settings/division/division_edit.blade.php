@extends('backend.app')

@section('title', 'Edit Division')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('divisions.index') }}">Division List</a></li>
        <li class="active">Edit Division</li>
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
            <form action="{{ route('divisions.update', $division->division_id) }}" method="post" class="form-horizontal col-sm-offset-1">
	            {{ csrf_field() }}
	            {{ method_field('PUT') }}
              <div class="box-body">
                <div class="form-group">
                  <label for="division_name" class="col-sm-2 control-label">Division name <span class="required">*</span></label>

                  <div class="col-sm-6">
                    <input type="text" name="division_name" class="form-control" id="division_name" placeholder="Division name" value="{{ $division->division_name }}">
                    @if($errors->has('division_name')) <span class="text-danger">{{ $errors->first('division_name') }}</span> @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="division_name_bn" class="col-sm-2 control-label">Division name (Bn)</label>

                  <div class="col-sm-6">
                    <input type="text" name="division_name_bn" class="form-control" id="division_name_bn" placeholder="Division name bangla" value="{{ $division->division_name_bn }}">
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