@extends('backend.app')

@section('title', 'Bn Content Position List')

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
        <li class="active">Bn Content Position List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">List of BN Content Position</h3>
                        <div class="pull-right"> <a href="{{ route('fix_contentPosition') }}" class="btn btn-primary btn-sm ">Position Fixed</a>
                            <a href="{{ route('bn-content-position.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a></div>


                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-striped">
                            <tbody>
                            <tr>
                                <th>Position Name</th>
                                <th>Category ID</th>
{{--                                <th>News IDs </th>--}}
                                <th>Status </th>
                                <th style="width:100px;">Action</th>
                            </tr>
                            @foreach($content_positions as $content_position)
                                <tr>
                                    <td>
                                        {{ $content_position->position_name }}
                                        @if($content_position->special_cat_id)
                                            <small class="label label-info">Special</small>
                                        @endif
                                    </td>
                                    <td>{{ $content_position->special_cat_id ? $content_position->special_cat_id : $content_position->cat_id }}</td>
{{--                                    <td>{{ $content_position->content_ids }}</td>--}}
                                    <td>
                                        <span class="btn btn-{{ $content_position->status == 1 ? 'success' : 'danger' }} btn-xs"><i class="fa fa-{{ $content_position->status == 1 ? 'check' : 'times'}}"></i></span>
                                    </td>
                                    <td>
                                        <a href="{{ route('bn-content-position.change', $content_position->position_id) }}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Change Position</a>
                                        @if(auth()->user()->role == 1)
                                            <a href="{{ route('bn-content-position.edit', $content_position->position_id) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Edit </a>
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
