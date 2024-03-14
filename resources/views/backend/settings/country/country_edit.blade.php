@extends('backend.app')

@section('title', 'Country Edit')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('countries.index') }}">Country List</a></li>
        <li class="active">Edit Country</li>
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
            <form action="{{ route('countries.update', $country->country_id) }}" method="post" class="form-horizontal col-sm-offset-1">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
              <div class="box-body">
                <div class="form-group">
                  <label for="country_name" class="col-sm-2 control-label">Country name <span class="required">*</span></label>

                  <div class="col-sm-6">
                    <input type="text" name="country_name" class="form-control" id="country_name" value="{{ $country->country_name }}" placeholder="Category name">
                    @if($errors->has('country_name')) <span class="text-danger">{{ $errors->first('country_name') }}</span> @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="country_name_bn" class="col-sm-2 control-label">Country name (Bn)</label>

                  <div class="col-sm-6">
                    <input type="text" name="country_name_bn" class="form-control" id="country_name_bn" value="{{ $country->country_name_bn }}" placeholder="Category name bangla">
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