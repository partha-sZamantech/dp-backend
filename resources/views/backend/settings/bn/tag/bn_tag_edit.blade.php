@extends('backend.app')

@section('title', 'Bn Tag Edit')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('bn-tags.index') }}">Bn Tag List</a></li>
        <li class="active">Edit Bn Tag</li>
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
            <form action="{{ route('bn-tags.update', $tag->tag_id) }}" method="post" enctype="multipart/form-data" class="form-horizontal col-sm-offset-1">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
              <div class="box-body">
                <div class="form-group">
                  <label for="tagType" class="col-sm-2 control-label">Tag type</label>
                  <div class="col-sm-8">
                    <select class="form-control col-sm-6" name="tagType" id="tagType">
                      @foreach(config('customdata.tag_types') as $key => $tag_type)
                        <option value="{{ $key }}" {{ $tag->tag_type == $key ? 'selected' : '' }}>{{ $tag_type }}</option>
                      @endforeach
                  	</select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="tagName" class="col-sm-2 control-label">Tag name Bn <span class="required">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" name="tagName" class="form-control" id="tagName" value="{{ $tag->tag_name }}" placeholder="Tag name">
                    @if($errors->has('tagName')) <span class="text-danger">{{ $errors->first('tagName') }}</span> @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="tagSlug" class="col-sm-2 control-label">Tag slug <span class="required">*</span></label>
                  <div class="col-sm-8">
                    <input type="text" name="tagSlug" class="form-control" id="tagSlug" value="{{ $tag->tag_slug }}" placeholder="Tag slug">
                    @if($errors->has('tagSlug')) <span class="text-danger">{{ $errors->first('tagSlug') }}</span> @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="tagDescription" class="col-sm-2 control-label">Tag Description Bn</label>
                  <div class="col-sm-8">
                    <textarea name="tagDescription" id="tagDescription" class="form-control" placeholder="Tag description">{{ $tag->description }}</textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="tagPhoto" class="col-sm-2 control-label">Choose Photo</label>
                  <div class="col-sm-8">
                  	<img src="{{ asset(config('appconfig.tagImagePath').$tag->img_path) }}" style="width: 30%">
                    <input type="file" name="tagPhoto" id="tagPhoto" class="form-control col-sm-6" style="height: auto">
                  </div>
                </div>

    			<div class="form-group">
    				<label class="col-sm-2 control-label">Approval</label>
                	<div class="col-sm-8">
                  		<label class="radio-inline">
      				      <input type="radio" name="approval" value="1" {{ $tag->approval == 1 ? 'checked' : '' }}>Active
      				    </label>
      				    <label class="radio-inline">
      				      <input type="radio" name="approval" value="2" {{ $tag->approval == 2 ? 'checked' : '' }}>Inactive
      				    </label>
                  	</div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-8">
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