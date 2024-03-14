@extends('backend.app')

@section('title', 'EN Video List')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb" style="display: inline-block; width: 500px">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">EN Videos</li>
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
                    <div class="box-header with-border">
                        <h3 class="box-title">List of EN Video</h3>
                        <a href="{{ route('en-videos.create') }}" class="btn btn-primary btn-sm pull-right"><i
                                class="fa fa-plus"></i> Add New</a>
                    </div>
                    <!-- /.box-header -->
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Title</th>
                            <th>Code</th>
                            <th>Uploader</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($videos as $video)
                            <tr>
                                <td>{{ $video->id }}</td>
                                <td>
                                    {{ $video->type == 1 ? 'Youtube' : 'Facebook' }}<br>
                                    <span class="badge label-success">{{ $video->category->name }}</span>
                                </td>
                                <td>
                                    {{ $video->title }}
                                </td>
                                <td>
                                    {{ $video->code }}
                                </td>
                                <td>
                                    {{ $video->created_by }}
                                </td>
                                <td>
                                    Insert: <span class="badge label-success">{{ $video->created_at }}</span><br/>
                                    Update: <span class="badge label-primary">{{ $video->updated_at }}</span><br/>
                                    Status:
                                    @if($video->status == 1)
                                        <span class="badge label-success"><i class="fa fa-check"></i></span>
                                    @else
                                        <span class="badge label-danger"><i class="fa fa-close"></i></span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('en-videos.edit', $video->id) }}" class="btn btn-warning btn-xs">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('en-videos.destroy', $video->id) }}" method="post"
                                          style="display: inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-xs"
                                                onclick="return confirm('Are you sure to delete this video?')">
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
