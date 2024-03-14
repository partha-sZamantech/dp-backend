@extends('backend.app')

@section('title', 'Create En Author')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('en-authors.index') }}">En Author List</a></li>
            <li class="active">Add Author</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <!-- form start -->
                    <form action="{{ route('en-authors.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-offset-1">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="author_type" class="col-sm-2 control-label">User Type</label>
                                <div class="col-sm-6">
                                    <select class="form-control col-sm-6" name="author_type" id="author_type">
                                        @foreach(config('customdata.author_types') as $key => $author_type)
                                            <option value="{{ $key }}">{{ $author_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="author_name" class="col-sm-2 control-label">Author Name
                                    <span class="required">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text" name="author_name" class="form-control" id="author_name" placeholder="Author name" value="{{ old('author_name') }}">
                                    @if($errors->has('author_name'))
                                        <span class="text-danger">{{ $errors->first('author_name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="author_slug" class="col-sm-2 control-label">Author Slug
                                    <span class="required">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text" name="author_slug" class="form-control" id="author_slug" placeholder="Author Slug" value="{{ old('author_slug') }}">
                                    @if($errors->has('author_slug'))
                                        <span class="text-danger">{{ $errors->first('author_slug') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="author_initial" class="col-sm-2 control-label">Author Initial
                                    <span class="required">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text" name="author_initial" class="form-control" id="author_initial" placeholder="Author initial" value="{{ old('author_initial') }}">
                                    @if($errors->has('author_initial'))
                                        <span class="text-danger">{{ $errors->first('author_initial') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="author_bio" class="col-sm-2 control-label">Author Bio</label>
                                <div class="col-sm-6">
                                    <textarea name="author_bio" id="author_bio" class="form-control" placeholder="Author biodata">{{ old('author_bio') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="author_image" class="col-sm-2 control-label">Author Image</label>
                                <div class="col-sm-6">
                                    <input type="file" name="author_image" id="author_image" class="form-control">
                                    @if($errors->has('author_image'))
                                        <span class="text-danger">{{ $errors->first('author_image') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                    <button type="reset" class="btn btn-default">Clear</button>
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

@section('custom-js')
    <script type="text/javascript">
        $("#author_name").blur(function () { // Create Author name slug and initial
            var str = this.value;
            $("#author_slug").val(str.trim().toLowerCase().replace(/  /g, '-').replace(/ /g, '-').replace(/[^\w-]+/g, '-'));
            $("#author_initial").val(str.match(/\b\w/g).join('').toUpperCase());
        });
    </script>
@endsection
