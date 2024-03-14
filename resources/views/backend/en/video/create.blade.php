@extends('backend.app')

@section('title', 'EN Video Create')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="{{ route('en-videos.index') }}">EN Video List</a></li>
      <li class="active">EN Videos</li>
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
            <h3 class="box-title">Create EN Video</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form action="{{ route('en-videos.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="category">Category <span class="required">*</span></label>
                    <div class="col-sm-6">
                        <select name="category" id="category" class="form-control" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"{{ old('category') == $category->id ? ' selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="type">Video Type <span class="required">*</span></label>
                <div class="col-sm-6">
                  <select name="type" id="type" class="form-control" onchange="toggleType(this)" required>
                    <option value="">Choose type</option>
                    <option value="1"{{ old('type') == 1 ? ' selected' : '' }}>Youtube</option>
                    <option value="2"{{ old('type') == 2 ? ' selected' : '' }}>Facebook</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Title <span class="required">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ old('title') }}" required />
                  @if($errors->has('title')) <span class="text-danger">{{ $errors->first('title') }}</span> @endif
                </div>
              </div>

                <div class="form-group" id="image">
                    <label for="image" class="col-sm-2 control-label">Image <span class="required">*</span></label>
                    <div class="col-sm-6">
                        <div class="text-info" style="margin-bottom: 5px;">Dimension: 750 X 390 pixel & Max size: 100kb</div>
                        <input type="file" name="image" id="image" class="form-control col-sm-6" style="height: auto">
                        @if($errors->has('image')) <span class="text-danger">{{ $errors->first('image') }}</span> @endif
                    </div>
                </div>

              <div class="form-group">
                <label for="code" class="col-sm-2 control-label">Code</label>
                <div class="col-sm-6">
                  <input type="text" name="code" class="form-control" id="code" placeholder="Code" value="{{ old('code') }}">
                  @if($errors->has('code')) <span class="text-danger">{{ $errors->first('code') }}</span> @endif
                </div>
              </div>

                <div class="form-group">
                    <label for="metaKeywords" class="col-sm-2 control-label">Meta Keywords</label>
                    <div class="col-sm-6">
                        <textarea name="metaKeywords" class="form-control" id="metaKeywords" placeholder="Meta Keywords">{{ old('metaKeywords') }}</textarea>
                        @if($errors->has('metaKeywords')) <span class="text-danger">{{ $errors->first('metaKeywords') }}</span> @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="metaDescription" class="col-sm-2 control-label">Meta Description</label>
                    <div class="col-sm-6">
                        <textarea name="metaDescription" class="form-control" id="metaDescription" placeholder="Meta Description">{{ old('metaDescription') }}</textarea>
                        @if($errors->has('metaDescription')) <span class="text-danger">{{ $errors->first('metaDescription') }}</span> @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Status</label>
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
                  <button type="reset" class="btn btn-default">Reset</button>
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
