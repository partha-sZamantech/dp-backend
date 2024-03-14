@extends('backend.app')

@section('title', 'EN Video Edit')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="{{ route('en-videos.index') }}">EN Video List</a></li>
      <li class="active">EN Video edit</li>
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
            <h3 class="box-title">Edit Video</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form action="{{ route('en-videos.update', $video->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-offset-1">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="category">Category <span class="required">*</span></label>
                    <div class="col-sm-6">
                        <select name="category" id="category" class="form-control" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"{{ $video->cat_id == $category->id ? ' selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="type">Video Type <span class="required">*</span></label>
                <div class="col-sm-6">
                  <select name="type" id="type" class="form-control" onchange="toggleType(this)" required>
                    <option value="">Choose type</option>
                    <option value="1"{{ $video->type == 1 ? ' selected' : '' }}>Youtube</option>
                    <option value="2"{{ $video->type == 2 ? ' selected' : '' }}>Facebook</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Title <span class="required">*</span></label>
                <div class="col-sm-6">
                  <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ $video->title }}" required />
                  @if($errors->has('title')) <span class="text-danger">{{ $errors->first('title') }}</span> @endif
                </div>
              </div>

              <div class="form-group" id="image">
                <label for="image" class="col-sm-2 control-label">Image <span class="required">*</span></label>
                <div class="col-sm-6">
                    <img src="{{ asset(config('appconfig.videoImagePath').$video->img_sm_path) }}" style="width: 30%">
                    <div class="text-info" style="margin-bottom: 5px;">Dimension: 750 X 390 pixel & Max size: 100kb</div>
                    <input type="file" name="image" id="image" class="form-control col-sm-6" style="height: auto">
                    @if($errors->has('image')) <span class="text-danger">{{ $errors->first('image') }}</span> @endif
                </div>
              </div>

              <div class="form-group" id="code">
                <label for="code" class="col-sm-2 control-label">Code</label>
                <div class="col-sm-6">
                  <input type="text" name="code" class="form-control" id="code" placeholder="Code" value="{{ $video->code }}">
                  @if($errors->has('code')) <span class="text-danger">{{ $errors->first('code') }}</span> @endif
                </div>
              </div>

                <div class="form-group">
                    <label for="metaKeywords" class="col-sm-2 control-label">Meta Keywords</label>
                    <div class="col-sm-6">
                        <textarea name="metaKeywords" class="form-control" id="metaKeywords" placeholder="Meta Keywords">{{ $video->meta_keywords }}</textarea>
                        @if($errors->has('metaKeywords')) <span class="text-danger">{{ $errors->first('metaKeywords') }}</span> @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="metaDescription" class="col-sm-2 control-label">Meta Description</label>
                    <div class="col-sm-6">
                        <textarea name="metaDescription" class="form-control" id="metaDescription" placeholder="Meta Description">{{ $video->meta_description }}</textarea>
                        @if($errors->has('metaDescription')) <span class="text-danger">{{ $errors->first('metaDescription') }}</span> @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-6">
                        <label class="radio-inline">
                            <input type="radio" name="status" value="1" {{ $video->status == 1 ? 'checked' : '' }}>Active
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="2" {{ $video->status == 2 ? 'checked' : '' }}>Inactive
                        </label>
                    </div>
                </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6">
                  <button type="submit" class="btn btn-info">Update</button>
                  <button type="#" class="btn btn-default">Cancel</button>
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
