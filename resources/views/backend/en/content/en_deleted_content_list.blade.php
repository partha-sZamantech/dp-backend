@extends('backend.app')

@section('title', 'News List')

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
        <li class="active">En Deleted News List</li>
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
              <h3 class="box-title">List of News</h3>
              <div class="pull-right">
                <a href="{{ url('backend/bn-contents/create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                @if($contents->count() > 0 && $contents[0]->deletable == 1)
                  <a href="{{ url('backend/deleted-bn-contents') }}" class="btn btn-info btn-sm">Deleted List</a>
                @else
                  <a href="{{ url('backend/bn-contents') }}" class="btn btn-info btn-sm">Content List</a>
                @endif
              </div>
            </div>
            <!-- /.box-header -->
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>News Heading</th>
                  <th style="width: 200px;">Category</th>
                  <th style="width: 190px;">News Situation</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($contents as $no => $content)
                  <tr>
                    <td>{{ $content->content_id }}</td>
                    <td>{{ $content->content_heading }}</td>
                    <td>
                      <a href="#">{{ $content->category->cat_name_bn }}</a><br/>
                      Sub Category: <a href="" class="badge label-success">{{ $content->subCategory->subcat_name_bn }}</a><br/>
                      Special Category: <a href="" class="badge label-primary">{{ $content->specialCategory->cat_name_bn }}</a>
                    </td>
                    <td>
                      Insert: <span class="badge label-success">{{ $content->created_at }}</span><br/>
                      Update: <span class="badge label-primary">{{ $content->updated_at }}</span><br/>
                      Status:
                            @if($content->status == 1)
                                <span class="badge label-success"><i class="fa fa-check"></i></span>
                            @else
                                <span class="badge label-danger"><i class="fa fa-close"></i></span>
                            @endif
                      Total Hit: <span class="badge label-default">{{ $content->total_hit }}</span>                            
                    </td>
                    <td>
                        <a href="{{ url('backend/enable-bn-content/'.$content->content_id) }}" class="btn btn-warning btn-xs" onclick="return confirm('Are you sure want to enable the content?')">Enable</a>
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