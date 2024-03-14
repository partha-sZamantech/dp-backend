@extends('backend.app')

@section('title', 'Create Division')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('divisions.index') }}">Division List</a></li>
        <li class="active">Add Division</li>
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
            <form action="{{ route('divisions.store') }}" method="post" class="form-horizontal col-sm-offset-1">
            {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="division_name" class="col-sm-2 control-label">Division name <span class="required">*</span></label>

                  <div class="col-sm-6">
                    <input type="text" name="division_name" class="form-control" id="division_name" placeholder="Division name">
                    @if($errors->has('division_name')) <span class="text-danger">{{ $errors->first('division_name') }}</span> @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="division_name_bn" class="col-sm-2 control-label">Division name (Bn)</label>

                  <div class="col-sm-6">
                    <input type="text" name="division_name_bn" class="form-control" id="division_name_bn" placeholder="Division name bangla">
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