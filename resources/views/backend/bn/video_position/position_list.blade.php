@extends('backend.app')

@section('title', 'Bn Video Position List')

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
        <li class="active">Bn Video Position List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">List of BN Video Position</h3>
                        @if(auth()->id() == 1)
                          <a href="{{ route('bn-video-position.create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i></a>
                        @endif
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-striped">
                            <tbody>
                            <tr>
                                <th>Position Name</th>
                                <th>Category ID</th>
                                <th>News IDs </th>
                                <th style="width:100px;">Action</th>
                            </tr>
                            @foreach($video_positions as $video_position)
                                <tr>
                                    <td>
                                        {{ $video_position->position_name }}
                                    </td>
                                    <td>{{ $video_position->cat_id }}</td>
                                    <td>{{ $video_position->video_ids }}</td>
                                    <td>
                                        <a href="{{ route('bn-video-position.change', $video_position->position_id) }}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Change Position</a>
                                        @if(auth()->id() == 1)
                                            <a href="{{ route('bn-video-position.edit', $video_position->position_id) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Edit </a>
                                            {{--<form action="{{ route('bn-content-position.destroy', $content_position->position_id) }}" method="post" style="display: inline;">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete the content position?')"><i class="fa fa-remove"></i> Delete</button>
                                            </form>--}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection
