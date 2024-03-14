@extends('backend.app')

@section('title', 'E-paper Page Edit')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('epaper-pages.index', $epaper->id) }}"><i class="fa fa-dashboard"></i> E-paper Page List</a></li>
            <li class="active">Edit Page of {{ $epaper->name }}</li>
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
                        <h3 class="box-title">Edit Page of {{ $epaper->name }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('epaper-pages.update', [$epaper->id, $page->id]) }}" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-offset-1">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="page" class="col-sm-2 control-label">Choose Page <span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <img src="{{ asset(config('appconfig.epaperImagePath').$page->img_thumb_path) }}" style="width: 30%">
                                    <input type="file" name="page" id="page" class="form-control col-sm-6" style="height: auto">
                                    @if($errors->has('page')) <span class="text-danger">{{ $errors->first('page') }}</span> @endif
                                </div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection
