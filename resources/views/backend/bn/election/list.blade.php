@extends('backend.app')

@section('title', 'Election List')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb" style="display: inline-block; width: 500px">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">Elections</li>
        </ol>
        @if(session()->has('successMsg'))
        <div class="alert alert-success alert-dismissable fade in custom-alert" style="display: inline-block">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> {{ session('successMsg') }}
        </div>
        @endif
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            {{--<div class="box-header with-border">
              <h3 class="box-title">List of Election</h3>
              <a href="{{ route('elections.create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Add New</a>
            </div>--}}
            <!-- /.box-header -->

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Total Seat</th>
                  <th>Party One</th>
                  <th>Party Two</th>
                  <th>Party Three</th>
                  <th>Party Four</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($elections as $election)
                  <tr>
                    <td>{{ $election->id }}</td>
                    <td>
                      {{ $election->title }}
                    </td>
                    <td>
                      {{ $election->total_center }}
                    </td>

                    <td>
                      {{ $election->party_one_name }}
                    </td>

                      <td>
                          {{ $election->party_two_name }}
                      </td>
                      <td>
                          {{ $election->party_three_name }}
                      </td>
                      <td>
                          {{ $election->party_four_name }}
                      </td>
                      <td>
                          <span class="btn btn-{{ $election->status == 1 ? 'success' : 'danger' }} btn-xs"><i class="fa fa-{{ $election->status == 1 ? 'check' : 'times'}}"></i></span>
                      </td>
                    <td>
                      <a href="{{ route('elections.edit', $election->id) }}" class="btn btn-warning btn-xs">
                        <i class="fa fa-pencil"></i>
                      </a>
                      {{--<form action="{{ route('elections.destroy', $election->id) }}" method="post" style="display: inline">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this election?')">
                          <i class="fa fa-times"></i>
                        </button>
                      </form>--}}
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
