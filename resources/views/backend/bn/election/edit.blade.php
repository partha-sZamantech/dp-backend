@extends('backend.app')

@section('title', 'Election Edit')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('elections.index') }}">Election List</a></li>
            <li class="active">Edit Election</li>
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
                        <h3 class="box-title">Edit Election</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('elections.update', $election->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="box-body">

                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Title <span class="required">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ $election->title }}" required />
                                    @if($errors->has('title')) <span class="text-danger">{{ $errors->first('title') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="total_center" class="col-sm-2 control-label">Total Seat</label>
                                <div class="col-sm-6">
                                    <input type="text" name="total_center" class="form-control" id="total_center" placeholder="Total Seat" value="{{ $election->total_center }}">
                                    @if($errors->has('total_center')) <span class="text-danger">{{ $errors->first('total_center') }}</span> @endif
                                </div>
                            </div>

{{--                            <div class="form-group">--}}
{{--                                <label for="casted_center" class="col-sm-2 control-label">Casted Center</label>--}}
{{--                                <div class="col-sm-6">--}}
{{--                                    <input type="text" name="casted_center" class="form-control" id="casted_center" placeholder="Casted Center" value="{{ $election->casted_center }}">--}}
{{--                                    @if($errors->has('casted_center')) <span class="text-danger">{{ $errors->first('casted_center') }}</span> @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="form-group">
                                <label for="party_one_name" class="col-sm-2 control-label">Party One Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="party_one_name" class="form-control" id="party_one_name" placeholder="Party One Name" value="{{ $election->party_one_name }}">
                                    @if($errors->has('party_one_name')) <span class="text-danger">{{ $errors->first('party_one_name') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="party_one_votes" class="col-sm-2 control-label">Party One Total Seat</label>
                                <div class="col-sm-6">
                                    <input type="text" name="party_one_votes" class="form-control" id="party_one_votes" placeholder="Party One Total Vote" value="{{ $election->party_one_votes }}">
                                    @if($errors->has('party_one_votes')) <span class="text-danger">{{ $errors->first('party_one_votes') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="party_two_name" class="col-sm-2 control-label">Party Two Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="party_two_name" class="form-control" id="party_two_name" placeholder="Party Two Name" value="{{ $election->party_two_name }}">
                                    @if($errors->has('party_two_name')) <span class="text-danger">{{ $errors->first('party_two_name') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="party_two_votes" class="col-sm-2 control-label">Party Two Total Seat</label>
                                <div class="col-sm-6">
                                    <input type="text" name="party_two_votes" class="form-control" id="party_two_votes" placeholder="Party Two Total Vote" value="{{ $election->party_two_votes }}">
                                    @if($errors->has('party_two_votes')) <span class="text-danger">{{ $errors->first('party_two_votes') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="party_three_name" class="col-sm-2 control-label">Party Three Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="party_three_name" class="form-control" id="party_three_name" placeholder="Party Two Name" value="{{ $election->party_three_name }}">
                                    @if($errors->has('party_three_name')) <span class="text-danger">{{ $errors->first('party_three_name') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="party_three_votes" class="col-sm-2 control-label">Party Three Total Seat</label>
                                <div class="col-sm-6">
                                    <input type="text" name="party_three_votes" class="form-control" id="party_three_votes" placeholder="Party three Total Seat" value="{{ $election->party_three_votes }}">
                                    @if($errors->has('party_three_votes')) <span class="text-danger">{{ $errors->first('party_two_votes') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="party_three_name" class="col-sm-2 control-label">Party Four Name</label>
                                <div class="col-sm-6">
                                    <input type="text" name="party_four_name" class="form-control" id="party_four_name" placeholder="Party Two Name" value="{{ $election->party_four_name }}">
                                    @if($errors->has('party_four_name')) <span class="text-danger">{{ $errors->first('party_four_name') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="party_four_votes" class="col-sm-2 control-label">Party Four Total Seat</label>
                                <div class="col-sm-6">
                                    <input type="text" name="party_four_votes" class="form-control" id="party_four_votes" placeholder="Party four Total Seat" value="{{ $election->party_four_votes }}">
                                    @if($errors->has('party_four_votes')) <span class="text-danger">{{ $errors->first('party_four_votes') }}</span> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" {{ $election->status == 1 ? 'checked' : '' }}>Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="2" {{ $election->status == 2 ? 'checked' : '' }}>Inactive
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
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
