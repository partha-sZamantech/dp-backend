@extends('backend.app')

@section('title', 'Change User Password')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('users.index') }}">User List</a></li>
        <li class="active">Change User Password</li>
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
            <form action="{{ route('users.postChangePassword', $user->id) }}" method="post" class="form-horizontal col-sm-offset-1">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="box-body">
                <div class="form-group">
                  <label for="password" class="col-sm-2 control-label">New Password <span class="required">*</span></label>
                  <div class="col-sm-6">
                    <input type="password" name="password" class="form-control" id="password" placeholder="New Password">
                    @if($errors->has('password')) <span class="text-danger">{{ $errors->first('password') }}</span> @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="confirm_password" class="col-sm-2 control-label">Confirm Password <span class="required">*</span></label>
                  <div class="col-sm-6">
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm password">
                    @if($errors->has('password_confirmation')) <span class="text-danger">{{ $errors->first('password_confirmation') }}</span> @endif
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-6">
	                <button type="submit" class="btn btn-info">Change</button>
	                <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
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