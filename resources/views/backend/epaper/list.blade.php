@extends('backend.app')

@section('title', 'E-paper List')

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
        <li class="active">E-paper List</li>
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
                <h3 class="box-title">List of E-paper</h3>
                <a href="{{ route('epapers.create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i></a>
            </div>
          <!-- /.box-header -->
          <table class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>ID</th>
              <th>Date</th>
              <th>Uploader</th>
              <th>Status</th>
              <th>Time</th>
              <th>Page</th>
              <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($epapers as $epaper)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                  {{ \Carbon\Carbon::parse($epaper->paper_date)->format('d-m-Y') }}
                </td>
                  <td>
                      {{ $epaper->uploader }}
                  </td>
                  <td>
                      <span class="btn btn-{{ $epaper->status == 1 ? 'success' : 'danger' }} btn-xs"><i class="fa fa-{{ $epaper->status == 1 ? 'check' : 'times'}}"></i></span>
                  </td>
                  <td>
                      Created: <span class="label label-default">{{ date('d-m-Y, h:ia', strtotime($epaper->created_at)) }}</span><br/>
                      Updated: <span class="label label-default">{{ date('d-m-Y, h:ia', strtotime($epaper->updated_at)) }}</span>
                  </td>
                <td>
                    <a href="{{ route('epaper-pages.create', $epaper->id) }}" class="btn btn-primary btn-sm">
                        Add Page
                    </a>
                    <a href="{{ route('epaper-pages.index', $epaper->id) }}" class="btn btn-success btn-sm">
                        Page List
                    </a>
                </td>
                <td>
                  <a href="{{ route('epapers.edit', $epaper->id) }}" class="btn btn-warning btn-sm">
                    <i class="fa fa-pencil"></i>
                  </a>
                  <form action="{{ route('epapers.destroy', $epaper->id) }}" method="post" style="display: inline">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this epaper?')">
                      <i class="fa fa-times"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          {{ $epapers->links('vendor.pagination.default') }}
        </div>
      </div>
    </div>
    <!-- /.row -->

  </section>
  <!-- /.content -->
@endsection
