@extends('backend.app')

@section('title', 'E-paper Page List')

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
        <li><a href="{{ route('epapers.index') }}">E-paper List</a></li>
        <li class="active">E-paper Page List</li>
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
                <h3 class="box-title">List of E-paper Page</h3>
                <a href="{{ route('epaper-pages.create', request()->epaper) }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i></a>
            </div>
          <!-- /.box-header -->
          <table class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>ID</th>
              <th>Date</th>
              <th style="width: 100px">Page Image</th>
              <th>Uploader</th>
              <th>Details</th>
              <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $page)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                  {{ \Carbon\Carbon::parse($page->date)->format('d-m-Y') }}
                </td>
                  <td>
                      <img src="{{ asset(config('appconfig.epaperImagePath').$page->img_thumb_path) }}" alt="">
                  </td>
                  <td>
                      {{ $page->uploader }}
                  </td>
                  <td>
                      Created: <span class="label label-default">{{ date('d-m-Y, h:ia', strtotime($page->created_at)) }}</span><br/>
                      Updated: <span class="label label-default">{{ date('d-m-Y, h:ia', strtotime($page->updated_at)) }}</span>
                  </td>
                <td>
                  <a href="{{ route('epaper-pages.edit', [request()->epaper, $page->id]) }}" class="btn btn-warning btn-sm">
                    <i class="fa fa-pencil"></i>
                  </a>
                  <form action="{{ route('epaper-pages.destroy', [request()->epaper, $page->id]) }}" method="post" style="display: inline">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this epaper page?')">
                      <i class="fa fa-times"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          {{ $pages->links() }}
        </div>
      </div>
    </div>
    <!-- /.row -->

  </section>
  <!-- /.content -->
@endsection
