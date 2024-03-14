@extends('backend.app')

@section('title', 'Breaking News Edit')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="{{ route('en-breaking-news.index') }}">Breaking News List</a></li>
      <li class="active">Breaking News</li>
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
            <h3 class="box-title">Edit Breaking News</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form action="{{ route('en-breaking-news.update', $news->id) }}" method="post" class="form-horizontal col-sm-offset-1">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="box-body">
              <div class="form-group">
                <label for="news_title" class="col-sm-3 control-label">News Title <span class="required">*</span></label>

                <div class="col-sm-6">
                  <input type="text" name="news_title" class="form-control" id="news_title" placeholder="News Title" value="{{ $news->news_title }}" required>
                  @if($errors->has('news_title')) <span class="text-danger">{{ $errors->first('news_title') }}</span> @endif
                </div>
              </div>
              <div class="form-group">
                <label for="news_link" class="col-sm-3 control-label">News Link</label>

                <div class="col-sm-6">
                  <input type="text" name="news_link" class="form-control" id="news_link" placeholder="News Link" value="{{ $news->news_link }}">
                  @if($errors->has('news_link')) <span class="text-danger">{{ $errors->first('news_link') }}</span> @endif
                </div>
              </div>

              <div class="form-group">
                <label for="expires" class="col-sm-3 control-label">Expires (in hours) <span class="required">*</span></label>

                <div class="col-sm-6">
                  <input type="text" name="expires" class="form-control" id="expires" placeholder="Expires (in hours)" value="{{ $news->hours }}" required />
                  @if($errors->has('expires')) <span class="text-danger">{{ $errors->first('expires') }}</span> @endif
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
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