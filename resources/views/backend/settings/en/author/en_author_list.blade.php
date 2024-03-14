@extends('backend.app')

@section('title', 'Author List')

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
            <li class="active">En Author List</li>
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
                                <form action="{{ url('backend/en-authors') }}" method="get">
{{--                                    <label class="col-sm-1" for="author_type">Author Type</label>--}}
{{--                                    <div class="col-sm-2">--}}
{{--                                        <select class="form-control" id="author_type" name="author_type">--}}
{{--                                            <option value="all" {{ request()->author_type == 'all' ? 'selected' : '' }}>All</option>--}}
{{--                                            @foreach(config('customdata.author_types') as $key => $author_type)--}}
{{--                                                <option value="{{ $key }}" {{ request()->author_type == $key ? 'selected' : '' }}>--}}
{{--                                                    {{ $author_type }}--}}
{{--                                                </option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
                                    <div class="col-sm-5">
                                        <input name="keyword" class="form-control"
                                               placeholder="Search with Author name or Author Initial" type="text"
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
                                                <a href="{{ route('en-authors.create') }}"
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
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Author Name</th>
                            <th>Author Name Bn</th>
                            <th>Author Initial</th>
                            <th>Author Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($authors as $no => $author)
                            <tr>
                                <td>{{ $no+1 }}</td>
                                <td>{{ $author->author_name }}</td>
                                <td>{{ config('customdata.author_types')[$author->author_type] }}</td>
                                <td>{{ $author->author_initial }}</td>
                                <td>
                                    @if(!empty($author->img_path))
                                        <img src="{{ asset(config('appconfig.authorImagePath').$author->img_path) }}" alt="{{ $author->author_name }}" class="img-thumbnail" style="width: 100px; height: 100px;">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('en-authors.edit', $author->author_id) }}" class="btn btn-warning btn-xs">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('en-authors.destroy', $author->author_id) }}" method="post" style="display: inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this author?')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $authors->appends($exPartPagination)->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection
