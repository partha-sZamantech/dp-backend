@extends('backend.app')

@section('title', 'Breaking News List')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb" style="display: inline-block; width: 500px">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">Breaking News</li>
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
                        <h3 class="box-title">List of Breaking News</h3>
                        <a href="{{ route('en-breaking-news.create') }}" class="btn btn-primary btn-sm pull-right"><i
                                class="fa fa-plus"></i></a>
                        <a href="{{ route('en-breaking-news.getSettingPosition') }}"
                           class="btn btn-primary btn-sm pull-right margin-r-5"><i class="fa fa-cogs"></i> Change
                            Position</a>
                    </div>
                    <!-- /.box-header -->
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>News Title</th>
                            <th>News Link</th>
                            <th style="width: 170px">Expires</th>
                            <th style="width: 100px">Created by</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($breakingNews as $key => $news)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>
                                    {{ $news->news_title }}
                                </td>

                                <td>
                                    <a href="{{ $news->news_link }}" target="_blank">
                                        {{ $news->news_link }}
                                    </a>
                                </td>
                                <td>
                                    @if(now() > $news->expired_time)
                                        Expired
                                    @else
                                        {{ $news->expired_time->diffForHumans(now(), ['parts' => 2]) }} from now
                                    @endif
                                </td>
                                <td>
                                    {{ $news->created_by }}
                                </td>
                                <td>
                                    <a href="{{ route('en-breaking-news.edit', $news->id) }}"
                                       class="btn btn-warning btn-xs">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('en-breaking-news.destroy', $news->id) }}" method="post"
                                          style="display: inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-xs"
                                                onclick="return confirm('Are you sure to delete this breaking news?')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $breakingNews->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection
