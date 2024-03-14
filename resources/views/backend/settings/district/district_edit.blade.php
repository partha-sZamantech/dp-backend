@extends('backend.app')

@section('title', 'Edit District')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('districts.index') }}">District List</a></li>
        <li class="active">Edit District</li>
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
            <form action="{{ route('districts.update', $district->district_id) }}" method="post" class="form-horizontal col-sm-offset-1">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="box-body">
                <div class="form-group">
                  <label for="division" class="col-sm-2 control-label">Division</label>
                  <div class="col-sm-6">
                    <select class="form-control col-sm-6" name="division" id="division">
                      @foreach($divisions as $division)
                        <option value="{{ $division->division_id }}" {{ $district->division_id == $division->division_id ? 'selected' : '' }}>{{ $division->division_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>              
                <div class="form-group">
                  <label for="district_name" class="col-sm-2 control-label">District name <span class="required">*</span></label>

                  <div class="col-sm-6">
                    <input type="text" name="district_name" class="form-control" id="district_name" placeholder="District name" value="{{ $district->district_name }}">
                    @if($errors->has('district_name')) <span class="text-danger">{{ $errors->first('district_name') }}</span> @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="district_name_bn" class="col-sm-2 control-label">District name (Bn)</label>
                  <div class="col-sm-6">
                    <input type="text" name="district_name_bn" class="form-control" id="district_name_bn" placeholder="District name bangla" value="{{ $district->district_name_bn }}">
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