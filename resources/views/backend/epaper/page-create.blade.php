@extends('backend.app')

@section('title', 'E-paper Page Create')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('epaper-pages.index', request()->epaper) }}"><i class="fa fa-dashboard"></i> E-paper Page List</a></li>
            <li class="active">Add Page to <strong>{{ \Carbon\Carbon::parse($paper->date)->format('d-m-Y') }}</strong></li>
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
                        <h3 class="box-title">Add Page to <strong>{{ \Carbon\Carbon::parse($paper->date)->format('d-m-Y')   }}</strong></h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('epaper-pages.store', request()->epaper) }}" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-offset-1">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="page" class="col-sm-2 control-label">Choose Page <span class="required">*</span></label>
                                <div class="col-sm-5">
                                    <input type="file" name="page" id="page" class="form-control col-sm-6" style="height: auto">
                                    @if($errors->has('page')) <span class="text-danger">{{ $errors->first('page') }}</span> @endif
                                </div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-8">
                                    <button type="submit" class="btn btn-info">Submit</button>
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
