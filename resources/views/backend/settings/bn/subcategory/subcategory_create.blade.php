@extends('backend.app')

@section('title', 'Subcategory Create')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('bn-subcategories.index') }}">Subcategory List</a></li>
            <li class="active">Add Subcategory</li>
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
                    <form action="{{ route('bn-subcategories.store') }}" method="post" class="form-horizontal col-sm-offset-1">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="categoryType" class="col-sm-3 control-label">Category</label>
                                <div class="col-sm-6">
                                    <select class="form-control col-sm-6" name="category" id="category">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->cat_id }}">{{ $category->cat_name_bn }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subcategoryName" class="col-sm-3 control-label">Subategory name
                                    <span class="required">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text" name="subcategoryName" class="form-control" id="subcategoryName" placeholder="Subcategory name">
                                    @if($errors->has('subcategoryName'))
                                        <span class="text-danger">{{ $errors->first('subcategoryName') }}</span> @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subcategoryNameBn" class="col-sm-3 control-label">Subcategory name (Bn)
                                    <span class="required">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text" name="subcategoryNameBn" class="form-control" id="subcategoryNameBn" placeholder="Subcategory name bangla">
                                    @if($errors->has('subcategoryNameBn'))
                                        <span class="text-danger">{{ $errors->first('subcategoryNameBn') }}</span> @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="metaKeyword" class="col-sm-3 control-label">Meta Keyword</label>

                                <div class="col-sm-6">
                                    <input type="text" name="metaKeyword" class="form-control" id="metaKeyword" placeholder="Meta keyword">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="metaDescription" class="col-sm-3 control-label">Meta Description</label>

                                <div class="col-sm-6">
                                    <textarea name="metaDescription" id="metaDescription" class="form-control" placeholder="Meta description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subcategoryPosition" class="col-sm-3 control-label">Subcategory
                                    Position</label>
                                <div class="col-sm-6">
                                    <select class="form-control col-sm-6" name="subcategoryPosition" id="subcategoryPosition">
                                        <option value="1">None</option>
                                        @for($i=1; $i <= 10; $i++)
                                            <option value="{{ $i+1 }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Status</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" checked>Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="2">Inactive
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                    <button type="submit" class="btn btn-default">Cancel</button>
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
