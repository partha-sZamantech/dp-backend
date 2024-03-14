@extends('backend.app')

@section('title', 'Election Create')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="{{ route('elections.index') }}">Election List</a></li>
      <li class="active">Add Election</li>
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
            <h3 class="box-title">Create Election</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form action="{{ route('elections.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
            {{ csrf_field() }}
            <div class="box-body">

              <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Title <span class="required">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ old('title') }}" required />
                  @if($errors->has('title')) <span class="text-danger">{{ $errors->first('title') }}</span> @endif
                </div>
              </div>

              <div class="form-group">
                <label for="total_center" class="col-sm-2 control-label">Total Seat</label>
                <div class="col-sm-6">
                  <input type="text" name="total_center" class="form-control" id="total_center" placeholder="Total Seat" value="{{ old('total_center') }}">
                  @if($errors->has('total_center')) <span class="text-danger">{{ $errors->first('total_center') }}</span> @endif
                </div>
              </div>

                <div class="form-group">
                    <label for="casted_center" class="col-sm-2 control-label">Casted Center</label>
                    <div class="col-sm-6">
                        <input type="text" name="casted_center" class="form-control" id="casted_center" placeholder="Casted Center" value="{{ old('casted_center') }}">
                        @if($errors->has('casted_center')) <span class="text-danger">{{ $errors->first('casted_center') }}</span> @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="party_one_name" class="col-sm-2 control-label">Party One Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="party_one_name" class="form-control" id="party_one_name" placeholder="Party One Name" value="{{ old('party_one_name') }}">
                        @if($errors->has('party_one_name')) <span class="text-danger">{{ $errors->first('party_one_name') }}</span> @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="party_two_name" class="col-sm-2 control-label">Party Two Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="party_two_name" class="form-control" id="party_two_name" placeholder="Party Two Name" value="{{ old('party_two_name') }}">
                        @if($errors->has('party_two_name')) <span class="text-danger">{{ $errors->first('party_two_name') }}</span> @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="party_one_votes" class="col-sm-2 control-label">Party One Total Vote</label>
                    <div class="col-sm-6">
                        <input type="text" name="party_one_votes" class="form-control" id="party_one_votes" placeholder="Party One Total Vote" value="{{ old('party_one_votes') }}">
                        @if($errors->has('party_one_votes')) <span class="text-danger">{{ $errors->first('party_one_votes') }}</span> @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="party_two_votes" class="col-sm-2 control-label">Party Two Total Vote</label>
                    <div class="col-sm-6">
                        <input type="text" name="party_two_votes" class="form-control" id="party_two_votes" placeholder="Party Two Total Vote" value="{{ old('party_two_votes') }}">
                        @if($errors->has('party_two_votes')) <span class="text-danger">{{ $errors->first('party_two_votes') }}</span> @endif
                    </div>
                </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6">
                  <button type="submit" class="btn btn-info">Submit</button>
                  <button type="reset" class="btn btn-default">Reset</button>
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
