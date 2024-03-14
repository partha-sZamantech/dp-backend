@extends('backend.app')

@section('title', 'Video Category List')

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
        <li class="active">Video Category List</li>
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
              <h3 class="box-title">List of Video Category</h3>
              <a href="{{ route('bn-video-categories.create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i></a>
            </div>
            <!-- /.box-header -->
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Category Name</th>
                  <th>Category Name (Bn)</th>
                  <th>Category Position</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $key => $category)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>
                        {{ $category->name }}
                    </td>

                    <td>
                        {{ $category->name_bn }}
                    </td>
                    <td>{{ $category->position }}</td>
                    <td>
                      <span class="btn btn-{{ $category->status == 1 ? 'success' : 'danger' }} btn-xs"><i class="fa fa-{{ $category->status == 1 ? 'check' : 'times'}}"></i></span>
                    </td>
                    <td>
                      <a href="{{ route('bn-video-categories.edit', $category->id) }}" class="btn btn-warning btn-xs">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <form action="{{ route('bn-video-categories.destroy', $category->id) }}" method="post" style="display: inline">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this category?')">
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
