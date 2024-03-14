@extends('backend.app')

@section('title', 'En Subcategory Edit')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="{{ route('en-subcategories.index') }}">En Subcategory List</a></li>
            <li class="active">Edit Subcategory</li>
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
                    <form action="{{ route('en-subcategories.update', $subcategory->subcat_id) }}" method="post" class="form-horizontal col-sm-offset-1">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="categoryType" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-6">
                                    <select class="form-control col-sm-6" name="category" id="category">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->cat_id }}" {{ $category->cat_id == $subcategory->cat_id ? 'selected' : '' }}>{{ $category->cat_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subcategoryName" class="col-sm-2 control-label">Subategory name
                                    <span class="required">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text" name="subcategoryName" class="form-control" id="subcategoryName" value="{{ $subcategory->subcat_name }}">
                                    @if($errors->has('subcategoryName'))
                                        <span class="text-danger">{{ $errors->first('subcategoryName') }}</span> @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="metaKeyword" class="col-sm-2 control-label">Meta Keyword</label>
                                <div class="col-sm-6">
                                    <input type="text" name="metaKeyword" class="form-control" id="metaKeyword" value="{{ $subcategory->subcat_meta_keyword }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="metaDescription" class="col-sm-2 control-label">Meta Description</label>
                                <div class="col-sm-6">
                                    <textarea name="metaDescription" id="metaDescription" class="form-control" placeholder="Meta description">{{ $subcategory->subcat_meta_description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subcategoryPosition" class="col-sm-2 control-label">Subcategory
                                    Position</label>
                                <div class="col-sm-6">
                                    <select class="form-control col-sm-6" name="subcategoryPosition" id="subcategoryPosition">
                                        <option value="1">None</option>
                                        @for($i=1; $i <= 10; $i++)
                                            <option value="{{ $i+1 }}" {{ $subcategory->subcat_position == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" {{ $subcategory->status == 1 ? 'checked' : '' }}>Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="2" {{ $subcategory->status == 2 ? 'checked' : '' }}>Inactive
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="submit" class="btn btn-info">Update</button>
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
