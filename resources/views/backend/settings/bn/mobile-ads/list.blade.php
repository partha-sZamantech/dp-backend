@extends('backend.app')

@section('title', 'Ad List')

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
            <li class="active">Mobile Ads Position List</li>
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
                        <h3 class="box-title">List of Ad</h3>
                        @if(auth()->id() == 1)
                            <a href="{{ route('bn-mobile-ads.create') }}" class="btn btn-primary btn-sm pull-right">
                                <i class="fa fa-plus"></i>
                            </a>
                        @endif
                    </div>
                    <!-- /.box-header -->
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Page</th>
                            <th>Position</th>
                            <th>Type</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($ads as $ad)
                            <tr>
                                <td>{{ $ad->id }}</td>
                                <td>
                                    {{config('customdata.ad_pages')[$ad->page] }}
                                </td>

                                <td>
                                    {{config('customdata.mobile_ad_positions')[$ad->page][$ad->position] }}
                                </td>
                                <td>
                                    {{config('customdata.ad_types')[$ad->type] }}
                                </td>
                                <td>
                                    {{$ad->start_time ? date('Y-m-d h:i:s a', strtotime($ad->start_time)) : ''}}
                                </td>
                                <td>
                                    {{$ad->end_time ? date('Y-m-d h:i:s a', strtotime($ad->end_time)) : ''}}
                                </td>
                                <td>
                                    <span class="btn btn-{{ $ad->status == 1 ? 'success' : 'danger' }} btn-xs"><i
                                            class="fa fa-{{ $ad->status == 1 ? 'check' : 'times'}}"></i></span>
                                </td>
                                <td>
                                    <a href="{{ route('bn-mobile-ads.edit', $ad->id) }}" class="btn btn-warning btn-xs">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    {{--<form action="{{ route('bn-ads.destroy', $ad->id) }}" method="post" style="display: inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this ad position?')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{--                    {{ $ads->links('vendor.pagination.default') }}--}}
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection
