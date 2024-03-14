@extends('backend.app')

@section('title', 'Bn Poll List')

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
            <li class="active">Bn Poll</li>
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
                                <form action="{{ url('backend/bn-polls') }}" method="get">
                                    <div class="col-sm-5">
                                        <input name="keyword" class="form-control" type="text"
                                               placeholder="Search with Poll ID or Poll Title" value="{{ request()->keyword }}">
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
                                                <a href="{{ route('bn-polls.index') }}"
                                                   class="btn btn-warning btn-sm btn-block"><i class="fa fa-refresh"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('bn-polls.create') }}"
                                                   class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Yes</th>
                                <th>No</th>
                                <th>No opinion</th>
                                <th>Date Created</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($polls as $poll)
                                @php
                                    $yes_percentage         = round($poll->yes_vote > 0 ? ($poll->yes_vote * 100) / $poll->total_vote : 0);
                                    $no_percentage          = round($poll->no_vote > 0 ? ($poll->no_vote * 100) / $poll->total_vote : 0) ;
                                    $no_opinion_percentage  = round($poll->no_opinion > 0 ? ($poll->no_opinion * 100) / $poll->total_vote : 0);
                                @endphp

                                <tr>
                                    <td>{{ $poll->poll_id }}</td>
                                    <td>{{ $poll->poll_title }}</td>
                                    <td>{{ $yes_percentage }}% ({{ $poll->yes_vote }})</td>
                                    <td>{{ $no_percentage }}% ({{ $poll->no_vote }})</td>
                                    <td>{{ $no_opinion_percentage }}% ({{ $poll->no_opinion }})</td>
                                    <td>{{ date('d M Y', strtotime($poll->created_at)) }}</td>
                                    <td>
                                        <span class="btn btn-{{ $poll->status == 1 ? 'success' : 'danger' }} btn-xs">
                                            <i class="fa fa-{{ $poll->status == 1 ? 'check' : 'times'}}"></i>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('bn-polls.edit', $poll->poll_id) }}" class="btn btn-warning btn-xs">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="{{ route('bn-polls.destroy', $poll->poll_id) }}" method="post"
                                              style="display: inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-xs"
                                                    onclick="return confirm('Are you sure to delete this poll?')">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $polls->appends($exPartPagination)->links('vendor.pagination.default') }}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection

