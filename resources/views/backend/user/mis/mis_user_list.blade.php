@extends('backend.app')

@section('title', 'MIS User List')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      @if(session()->has('successMsg'))
        <div class="alert alert-success alert-dismissable fade in custom-alert">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> {{ session('successMsg') }}
        </div>
      @endif
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="active">MIS User List</li>
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
              <h3 class="box-title">List of MIS User</h3>
              <a href="{{ route('mis-users.create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i></a>
            </div>
            <!-- /.box-header -->
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>SL</th>
                  <th>User Name</th>
                  <th>Type</th>
                  <th>Department</th>
                  <th>Initial</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $no => $user)
                  <tr>
                    <td>{{ $no+1 }}</td>
                    <td>{{ $user->user_name }}</td>
                    <td>{{ config('customdata.user_types')[$user->user_type] }}</td>
                    <td>{{ config('customdata.dept_types')[$user->dept_type] }}</td>
                    <td>{{ $user->user_initial }}</td>
                    <td>
                      <a href="{{ route('mis-users.edit', $user->user_id) }}" class="btn btn-warning btn-xs">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <form action="{{ route('mis-users.destroy', $user->user_id) }}" method="post" style="display: inline">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this mis user?')">
                          <i class="fa fa-times"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection    