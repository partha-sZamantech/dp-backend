@extends('backend.app')
@section('title','Upozilla Insert')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('upozillas.index') }}">Upozilla List</a></li>
            <li class="active">Add Upozilla</li>
        </ol>
    </section>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <form action="{{ route('upozillas.store') }}" class="form-horizontal" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="district" class="col-sm-4 control-label">District <span class="required">*</span></label>
                                <div class="col-sm-3">
                                    <select id="district" name="district" class="form-control">
                                        @foreach($districts as $district)
                                            <option value="{{ $district->district_id.'|'. $district->division_id }}">{{ $district->district_name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                                @if($errors->has('district')) <span class="text-danger">{{ $errors->first('district') }}</span> @endif
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="upozilla_name">Upozilla Name <span class="required">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="upozilla_name" id="upozilla_name">
                                </div>
                                @if($errors->has('upozilla_name')) <span class="text-danger">{{ $errors->first('upozilla_name') }}</span> @endif
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="upozilla_name_bangla">Upozilla Name(Bangla)</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="upozilla_name_bangla" id="upozilla_name_bangla">
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="col-sm-3 col-sm-offset-4">
                                    <button type="submit" name="submit" class="btn btn-info"> Insert</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection