@extends('backend.app')

@section('title', 'Bn Tag List')

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
            <li class="active">Bn Tag List</li>
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
                        <div class="row" style="margin-bottom: 5px;">
                            <div class="col-sm-12">
                                <form action="{{ url('backend/bn-tags') }}" method="get">
                                    <div class="col-sm-5">
                                        <input name="keyword" class="form-control"
                                               placeholder="Search with Tag Name or tag Slug" type="text"
                                               value="{{ request()->keyword }}">
                                    </div>
                                    <div class="col-sm-5">

                                    </div>
                                    <div class="col-sm-2">
                                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                            <div class="btn-group" role="group">
                                                <button type="submit" class="btn bg-purple btn-sm btn-block"><i
                                                        class="fa fa-search"></i></button>
                                            </div>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('bn-tags.index') }}"
                                                   class="btn btn-warning btn-sm btn-block"><i class="fa fa-refresh"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('bn-tags.create') }}"
                                                   class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tag Name</th>
                            <th>Tag Slug</th>
                            <th>Approval</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td>{{ $tag->tag_id }}</td>
                                <td>{{ $tag->tag_name }}</td>
                                <td>{{ $tag->tag_slug }}</td>
                                <td>
                                    <span class="btn btn-{{ $tag->approval == 1 ? 'success' : 'danger' }} btn-xs"><i
                                            class="fa fa-{{ $tag->approval == 1 ? 'check' : 'times'}}"></i></span>
                                </td>
                                <td>
                                    <a href="{{ route('bn-tags.edit', $tag->tag_id) }}" class="btn btn-warning btn-xs">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('bn-tags.destroy', $tag->tag_id) }}" method="post"
                                          style="display: inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-xs"
                                                onclick="return confirm('Are you sure to delete this tag?')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $tags->appends($exPartPagination)->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection
