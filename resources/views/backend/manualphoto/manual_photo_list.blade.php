@extends('backend.app')

@section('title', 'Manual Photo List')

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
        <li class="active">Manual Photo List</li>
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
              <h3 class="box-title">List of Manual Photo</h3>
              <a href="{{ route('manual-photos.create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i></a>
            </div>
            <!-- /.box-header -->
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>SL</th>
                  <th>Photo</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($photos as $photo)
                  <tr>
                    <td>{{ $photo->photo_id }}</td>
                    <td>
                      <input type="text" value="{{ asset(config('appconfig.contentImagePath').$photo->img_path) }}" id="url-{{ $photo->photo_id }}" class="form-control"  style="display: inline; width: 90%" readonly>
                      <button type="button" onclick="copyUrl({{ $photo->photo_id }})" class="btn btn-primary">Copy</button><br/>
                      <img src="{{ asset(config('appconfig.contentImagePath').$photo->img_path) }}">
                    </td>
                    <td>
                      <a href="{{ route('manual-photos.edit', $photo->photo_id) }}" class="btn btn-warning btn-xs">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <form action="{{ route('manual-photos.destroy', $photo->photo_id) }}" method="post" style="display: inline">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this photo?')">
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

@section('custom-js')
  <script>
   function copyUrl(id){
    //alert('hello');
    document.getElementById('url-'+id).select();
    //alert(d);
    document.execCommand('copy');
   }
  </script>
@endsection