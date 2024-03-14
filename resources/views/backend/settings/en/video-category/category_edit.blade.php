@extends('backend.app')

@section('title', 'EN Video Category Edit')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="{{ route('en-video-categories.index') }}">EN Video Category List</a></li>
      <li class="active">Edit EN Video Category</li>
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
          <form action="{{ route('en-video-categories.update', $category->id) }}" method="post" class="form-horizontal col-sm-offset-1">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="box-body">
              <div class="form-group">
                <label for="categoryName" class="col-sm-3 control-label">Category name <span class="required">*</span></label>

                <div class="col-sm-6">
                  <input type="text" name="categoryName" class="form-control" id="categoryName" value="{{ $category->name }}">
                  @if($errors->has('categoryName')) <span class="text-danger">{{ $errors->first('categoryName') }}</span> @endif
                </div>
              </div>
              <div class="form-group">
                <label for="metaKeywords" class="col-sm-3 control-label">Meta Keywords</label>

                <div class="col-sm-6">
                  <input type="text" name="metaKeywords" class="form-control" id="metaKeywords" value="{{ $category->meta_keywords }}">
                </div>
              </div>
              <div class="form-group">
                <label for="metaDescription" class="col-sm-3 control-label">Meta Description</label>

                <div class="col-sm-6">
                  <textarea name="metaDescription" id="metaDescription" class="form-control" placeholder="Meta description">{{ $category->meta_description }}</textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="categoryPosition" class="col-sm-3 control-label">Category Position</label>
                <div class="col-sm-6">
                  <select class="form-control col-sm-6" name="categoryPosition" id="categoryPosition">
                    <option value="0">None</option>
                    @for($i=1; $i <= 40; $i++)
                      <option value="{{ $i }}" {{ $category->position == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Status</label>
                <div class="col-sm-6">
                  <label class="radio-inline">
                    <input type="radio" name="status" value="1" {{ $category->status == 1 ? 'checked' : '' }}>Active
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="status" value="2" {{ $category->status == 2 ? 'checked' : '' }}>Inactive
                  </label>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                  <button type="submit" class="btn btn-info">Update</button>
                  <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
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
