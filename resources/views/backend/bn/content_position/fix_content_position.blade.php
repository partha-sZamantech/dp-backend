@extends('backend.app')

@section('title', 'Fix Bn Content Position')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('bn-content-position.index') }}">Fixed Bn Content Position</a></li>
            <li class="active">Add Position </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @if(session()->has('successMsg'))
            <div class="alert alert-success alert-dismissable fade in custom-alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ session('successMsg') }}
            </div>
        @endif
        <div class="row">
            <form action="{{ route('bnupdateContentPositionFixed') }}" method="post" class="form-horizontal" >
                {{ csrf_field() }}
                <div class="col-sm-6">
                    <div class="box box-solid">
                        <div class="box-group" id="accordion">
                            <div class="box box-default">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="special_position" class="col-sm-3">Special Position</label>
                                        <div class="col-sm-9">
                                            <select name="position_fix" id="position_fix" class="form-control">
                                                <option value="">--None--</option>
                                                @for($i=1; $i<=12; $i++)

                                                    <option value="{{ $i }}" @if($position->position_fix === $i) selected @endif>{{ $i }}</option>

                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-3 control-label"></div>
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-info"> Fix Position</button>
                                            <a href="" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection
