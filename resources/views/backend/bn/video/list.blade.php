@extends('backend.app')

@section('title', 'BN Video List')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb" style="display: inline-block; width: 500px">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">BN Videos</li>
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
                <div class="row">
                    <div class="col-sm-5">
                        <form action="{{ route('bn-videos.index') }}" method="get" class="">
                            <div class="row">
                                <div class="col-sm-9">
                                    <input name="keyword" class="form-control" placeholder="Search by title or code" type="text">
                                </div>

                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                        <div class="btn-group" role="group">
                                            <button type="submit" class="btn bg-purple btn-sm btn-block"><i
                                                    class="fa fa-search"></i> Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6"></div>
                    <div class="col-sm-1">
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <a href="{{ route('bn-videos.create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Add New</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Type</th>
                  <th>Title</th>
                  <th>Code</th>
{{--                  <th>Link</th>--}}
                  <th>Uploader</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($videos as $video)
                  <tr>
                    <td>{{ $video->id }}</td>
                    <td>
                        {{ $video->type == 1 ? 'Youtube' : 'Facebook' }}<br>
                        <span class="badge label-success">{{ $video->category->name_bn }}</span>
                    </td>
                    <td>
                      {{ $video->title }}
                    </td>
                    <td>
                      {{ $video->code }}<br>
                        @if($video->is_live == 1)
                            <span class="badge label-success">Live</span>
                        @endif
                    </td>

                    {{--<td>
                      <a href="{{ $video->link }}" target="_blank">
                      {{ $video->link }}
                      </a>
                    </td>--}}
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
                      <a href="{{ route('bn-videos.edit', $video->id) }}" class="btn btn-warning btn-xs">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <form action="{{ route('bn-videos.destroy', $video->id) }}" method="post" style="display: inline">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this video?')">
                          <i class="fa fa-times"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            {{ $videos->links('vendor.pagination.default') }}
          </div>
        </div>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection
