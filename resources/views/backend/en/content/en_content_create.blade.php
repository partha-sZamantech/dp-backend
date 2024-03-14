@extends('backend.app')

@section('title', 'Create English News')

@section('custom-css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/adminlte/plugins/cropbox/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/adminlte/plugins/tag-it-master/css/jquery.tagit.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/adminlte/plugins/tag-it-master/css/tagit.ui-zendesk.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/css/token-input.css') }}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
	  	<li><a href="{{ route('en-contents.index') }}">En News List</a></li>
        <li class="active">Add News</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- form start -->
        <form action="{{ route('en-contents.store') }}" method="post" enctype="multipart/form-data">
	        <div class="col-md-8" style="padding-right: 0">
	          <!-- Horizontal Form -->
	          <div class="box box-info">
	              {{ csrf_field() }}
	              <div class="box-body">
	                <div class="form-group">
	                  	<label for="newsHeading">News Heading <span class="required">*</span></label>
	                    <input type="text" name="newsHeading" class="form-control" id="newsHeading" placeholder="News Heading" value="{{ old('newsHeading') }}">
	                    @if($errors->has('newsHeading')) <span class="text-danger">{{ $errors->first('newsHeading') }}</span> @endif
	                </div>

	                <div class="form-group">
	                  	<label for="newsHeading">News Subheading</label>
	                    <input type="text" name="newsSubheading" class="form-control" id="newsSubheading" placeholder="News Subheading" value="{{ old('newsSubheading') }}">
	                </div>

                      <div class="form-group">
                          <label for="metaKeywords">Meta Keywords <span class="required">*</span></label>
                          <textarea name="metaKeywords" id="metaKeywords" class="form-control" placeholder="Comma separated meta keywords">{{ old('metaKeywords') }}</textarea>
                          @if($errors->has('metaKeywords')) <span class="text-danger">{{ $errors->first('metaKeywords') }}</span> @endif
                      </div>

	                <div class="form-group">
	                	<label for="briefNews">Meta Description <span class="required">*</span></label>
	                	<textarea name="briefNews" id="briefNews" class="form-control" rows="4" placeholder="Meta Description / Brief News">{{ old('briefNews') }}</textarea>
                        @if($errors->has('briefNews')) <span class="text-danger">{{ $errors->first('briefNews') }}</span> @endif
	                </div>

	                <div class="form-group">
	                	<label for="detailsNews">Details News <span class="required">*</span></label>
	                	<textarea name="detailsNews" id="detailsNews" class="form-control textarea" rows="10" placeholder="Details News">{{ old('detailsNews') }}</textarea>
	                	<input name="image" type="file" id="upload" class="hidden" onchange="">
                        @if($errors->has('detailsNews')) <span class="text-danger">{{ $errors->first('detailsNews') }}</span> @endif
	                </div>

	                <div class="form-group">
	                	<div class="row">
							<div class="col-sm-12">
								<div class="box box-success text-center">
									<h3>Large Image <span class="required">*</span></h3>
									<div class="text-danger" style="margin-bottom: 5px;">Dimension: 750 X 390 pixel & Max size: 100kb</div>

									@if($errors->has('largeImage')) <span class="text-danger">{{ $errors->first('largeImage') }}</span> @endif
									<div class="row">
										<div class="col-sm-4">
											<!-- <input type="file" name="ImageBGLocalPath" class="ImageBGLocalPath" id="ImageBGLocalPath"> -->
											<input type="file" name="largeImage" class="largeImage" id="largeImage">
										</div>
										<div class="col-sm-8">
											<label for="largeImage" class="btn bg-purple btn-flat pull-left">Local</label>
											{{--<input type="text" name="ImageBGPath" class="form-control" id="ImageBGPath" readonly>--}}
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<input type="text" name="ImageBGCaption" class="form-control" id="ImageBGCaption" placeholder="Image caption" value="{{ old('ImageBGCaption') }}" style="margin-top: 5px;">
										</div>
									</div>
								</div>
							</div>
	                	</div>
	                </div>
	              </div>
	              <!-- /.box-body -->
	          </div>
	        </div>
	        <div class="col-md-4">
	        	<div class="box box-info">
	        		<div class="box-body form-horizontal">
	        			<div class="form-group">
							<label for="contentType" class="col-sm-3">Content Type </label>
							<div class="col-sm-9">
								<select name="contentType" class="form-control" id="contentType">
									<option value="1"{{ old('contentType') == 1 ? ' selected' : '' }}>News</option>
									<option value="2"{{ old('contentType') == 2 ? ' selected' : '' }}>Article</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="category" class="col-sm-3">Category</label>
							<div class="col-sm-9">
								<select name="category" class="form-control" id="category">
									@foreach($categories as $category)
										<option value="{{ $category->cat_id }}"{{ old('category') == $category->cat_id ? ' selected' : '' }}>{{ $category->cat_name }}</option>
									@endforeach
								</select>
							</div>
							@if($errors->has('category')) <span class="text-danger">{{ $errors->first('category') }}</span> @endif
						</div>

                        <div class="form-group">
                            <label for="category_position" class="col-sm-3">Category Position</label>
                            <div class="col-sm-9">
                                <select name="category_position" id="category_position" class="form-control">
                                    <option value="">--None--</option>
                                    @for($i=1; $i<=12; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

						<div class="form-group">
							<label for="subCategory" class="col-sm-3">SubCategory</label>
							<div class="col-sm-9">
								<select id="subCategory" name="subCategory" class="form-control "></select>
							</div>
						</div>

						<div class="form-group">
							<label for="specialCategory" class="col-sm-3">Special Category</label>
							<div class="col-sm-9">
								<select name="specialCategory" id="specialCategory" class="form-control">
									<option value="1">--None--</option>
									@foreach($specialCategories as $specialCategory)
										<option value="{{ $specialCategory->cat_id}}"{{ old('specialCategory') == $specialCategory->cat_id ? ' selected' : '' }}>{{ $specialCategory->cat_name }}</option>
									@endforeach
								</select>
							</div>
						</div>

                        <div class="form-group">
                            <label for="special_position" class="col-sm-3">Special Position</label>
                            <div class="col-sm-9">
                                <select name="special_position" id="special_position" class="form-control">
                                    <option value="">--None--</option>
                                    @for($i=1; $i<=12; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

						<div class="form-group">
							<label for="country" class="col-sm-3">Country</label>
							<div class="col-sm-9">
								<select name="country" id="country" class="form-control">
									@foreach($countries as $country)
										<option value="{{ $country->country_id }}" {{ $country->country_name == 'Bangladesh' ? 'selected' : '' }}>{{ $country->country_name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="district" class="col-sm-3">District</label>
							<div class="col-sm-9">
								<select name="district" id="district" class="form-control">
									@foreach($districts as $district)
										<option value="{{ $district->district_id }}"{{ old('district') == $district->district_id ? ' selected' : '' }}>{{ $district->district_name }}</option>
									@endforeach
								</select>
							</div>
						</div>

                        <div class="form-group">
                            <label for="writer" class="col-sm-3">Author</label>
                            <div class="col-sm-9">
                                <select name="writer" id="writer" class="form-control">
                                    @foreach($authors as $author)
                                        <option value="{{ $author->author_slug }}"{{ $author->author_slug == old('writer') ? ' selected' : '' }}>{{ $author->author_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="reporter" class="col-sm-3">Reporter</label>
                            <div class="col-sm-9">
                                <select name="reporter" id="reporter" class="form-control">
                                    @foreach($mis_reporters as $reporter)
                                        <option value="{{ $reporter->user_id }}">{{ $reporter->user_name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('reporter')) <span class="text-danger">{{ $errors->first('reporter') }}</span> @endif
                            </div>
                        </div>

						<div class="form-group">
							<label class="col-sm-3">Related ID</label>
							<div class="col-sm-9">
								<ul class="myTags" id="prevNewsIds"></ul>
							</div>
						</div>

                        <div class="form-group">
                            <label class="col-sm-3" for="podcastId">Postcast ID</label>
                            <div class="col-sm-9">
                                <input type="text" id="podcastId" name="podcastId" class="form-control" value="{{ old('podcastId') }}">
                            </div>
                        </div>

						<div class="form-group">
							<label class="col-sm-3" for="videoType">Video Type</label>
							<div class="col-sm-9">
								<select name="videoType" id="videoType" class="form-control">
									<option value="">Choose type</option>
									<option value="1"{{ old('videoType') == 1 ? ' selected' : '' }}>Youtube</option>
									<option value="2"{{ old('videoType') == 2 ? ' selected' : '' }}>Facebook</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3" for="videoId">Video ID</label>
							<div class="col-sm-9">
								<input type="text" id="videoId" name="videoId" class="form-control" value="{{ old('videoId') }}">
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-3">Normal Tag</label>
							<div class="col-sm-9">
								<input class="form-control" id="normal-tags" name="normalTags" autocomplete="off">
							</div>
						</div>

                        {{-- 1=PowerAdmin, 2=NewsAdmin, 3=AdvAdmin, 4=CatAdmin, 5=BN News Admin, 6=EN News Admin--}}
                        @if(auth()->user()->role === 1 ||  auth()->user()->role === 2)
                        <div class="form-group row">
                            <label for="status" class="col-sm-3">Show?</label>
                            <input type="hidden" name="status" id="status" value="1">
                            <div class="col-sm-9 btn-group radioBtn">
                                <a class="btn btn-primary btn-sm active" data-toggle="status" data-title="1">Yes</a>
                                <a class="btn btn-primary btn-sm notActive" data-toggle="status" data-title="2">No</a>
                            </div>
                        </div>
                        @endif

		        		<div class="form-group">
		        			<div class="col-sm-8">
			                	<button type="submit" class="btn btn-info btn-block">Submit</button>
			                </div>
			                <div class="col-sm-4" style="padding-left: 0;">
			                	<a href="{{ URL::previous() }}" class="btn btn-default btn-block">Back</a>
		        			</div>
		                </div>

	        		</div>
	        	</div>
	        </div>
        </form>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->

	<!-- Modal EXSM Archive -->
	<div class="modal fade" id="ExSMImageArchive" tabindex="-1" role="dialog" aria-labelledby="ExSMImageArchive">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="ExSMImageArchive">Extra SM Image Archive</h4>
				</div>
				<div class="modal-body">
					<div class="filemanager">
						<div class="search">
							<input type="search" class="form-control" placeholder="Find a file.." />
						</div>
					</div>
					<div class="result"></div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal SM Archive -->
	<div class="modal fade" id="SMImageArchive" tabindex="-1" role="dialog" aria-labelledby="SMImageArchive">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="SMImageArchive">SM Image Archive</h4>
				</div>
				<div class="modal-body">
					<div class="filemanager">
						<div class="search">
							<input type="search" class="form-control" placeholder="Find a file.." />
						</div>
					</div>
					<div class="result"></div>
				</div>
			</div>
		</div>
	</div>

<!-- BG Archive Modal-->
	<div class="modal fade" id="BGImageArchive" tabindex="-1" role="dialog" aria-labelledby="BGImageArchive">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="BGImageArchive">BG Image Archive</h4>
				</div>
				<div class="modal-body">
					<div class="filemanager">
						<div class="search">
							<input type="search" class="form-control" placeholder="Find a file.." />
						</div>
					</div>
					<div class="result"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- End archive modal -->


	<!-- Start upload modal SM crop-->
	<div class="modal fade" id="cropSM" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Crop image</h4>
				</div>
				<div class="modal-body">
					<div class="imageBox">
						<div class="thumbBox"></div>
					</div>
					<div class="action">
						<input type="file" id="file" style="float:left; width:250px">
						<input type="button" id="btnCrop" value="Crop" style="float:right">
						<input type="button" id="btnZoomIn" value="+" style="float:right">
						<input type="button" id="btnZoomOut" value="-" style="float:right">
					</div>
					<div class="cropped"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- End upload modal -->
@endsection

@section('custom-js')
	<script type="text/javascript" src="{{ asset('backend/adminlte/plugins/cropbox/jquery/cropbox-min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/adminlte/plugins/tag-it-master/js/tag-it.min.js') }}"></script>

	<script type="text/javascript">
	    $(function () {
	        // radio yes-no
	        $('.radioBtn a').on('click', function () {
	            var sel = $(this).data('title');
	            var tog = $(this).data('toggle');
	            $('#' + tog).prop('value', sel);

	            $('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
	            $('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
	        });
	    });

		$(window).load(function() {
			var options ={thumbBox: '.thumbBox',imgSrc: ''};
			var cropper = $('.imageBox').cropbox(options);
			$('#file').on('change', function(){
				$('.cropped').empty();
				var reader = new FileReader();
				reader.onload = function(e) {options.imgSrc = e.target.result;cropper = $('.imageBox').cropbox(options);};
				reader.readAsDataURL(this.files[0]);
				this.files = [];
			});
			$('#btnCrop').on('click', function(){
				var img = cropper.getDataURL();
				$('.cropped').empty();
				$('.cropped').append('<img src="'+img+'">');
				$(".cropped img").dblclick(function() {
					var ImgSrc=$(this).attr("src");
					var ImageSMPath = document.getElementById("ImageSMPath");
					ImageSMPath.value=ImgSrc;
					var filename = document.getElementById('file').files[0].name;
					document.getElementById("ImageSMLocalName").value=filename;
					//console.log(ImageSMName)
					$('#cropSM').modal('hide');
				});
			});
			$('#btnZoomIn').on('click', function(){cropper.zoomIn();});
			$('#btnZoomOut').on('click', function(){cropper.zoomOut();});
		});

		var catId = $("#category").val();

        $.get('{{ url("backend/en-subcat-populate?cat_id=") }}'+catId, function(data){
            $('#subCategory').prepend('<option value="1" selected>--None--</option>');
            $.each(data, function(index, subcatObj){
				$('#subCategory').append('<option value="'+subcatObj.subcat_id+'">'+subcatObj.subcat_name+'</option>');
			});
        });

		// Sub category populated when select a category
		$('#category').change(function(){ // Pre-populate subcategory dropdown
			var cat_id = $(this).val();
			$('#subCategory').empty();
			$.get('{{ url("backend/en-subcat-populate?cat_id=") }}'+cat_id, function(data){
				$.each(data, function(index, subcatObj){
					$('#subCategory').append('<option value="'+subcatObj.subcat_id+'">'+subcatObj.subcat_name+'</option>');
				});
				$('#subCategory').prepend('<option value="1" selected>--None--</option>');
			});
		});

		// Previous news id's tag-it
		$('#prevNewsIds').tagit({
			fieldName: "prevNewsIds[]"
		});

		// Previous Photo galary id tag-it
		$('#photoGalaryIds').tagit({
			fieldName: "photoGalaryIds[]"
		});
		// Previous meta keyword tag-it
		$('#metaKeyword').tagit({
			fieldName: "metaKeyword[]"
		});

	</script>
	<script src="{{ asset('backend/js/jquery.tokeninput.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#normal-tags").tokenInput("{{ url('backend/en-normaltag-search')}}",{preventDuplicates: true});
		});
	</script>
	<script src="{{ asset('backend/adminlte/cute-file-browser/js/script.js') }}"></script>
    <script src="{{ asset('backend/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '.textarea',
            plugins:'advlist autolink lists textcolor colorpicker link code wordcount media image imagetools searchreplace charmap anchor visualblocks fullscreen table contextmenu paste',
            menubar: true,
            height : "300",
            toolbar1: 'insertfile | bold italic fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor link code media image',
            rel_list: [
                {title: 'nofollow', value: 'nofollow'},
                {title: 'follow', value: 'follow'}
            ],
            fontsize_formats: "8pt 10pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 28pt 30pt 36pt",
            file_picker_callback: function(callback, value, meta) {
                if (meta.filetype == 'image') {
                    $('#upload').trigger('click');
                    $('#upload').on('change', function() {
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            var imagevalue = e.target.result;
                            var filename = $("#upload").val().substring($("#upload").val().lastIndexOf('\\') + 1);
                            $.post('{{ url("backend/attach-photo-upload") }}', {"_token": "{{ csrf_token() }}", 'filename': filename, 'imagevalue': imagevalue}, function (data) {
								var data = '{{ config('app.url') }}'+'/media/content/images/'+data;
                                //console.log(data);
                                callback(data, {
                                    alt: '',
									width: '100%',
									height: 'auto'
                                });
                            });
                        };
                        reader.readAsDataURL(file);
                    });
                }
            },
            toolbar: "...| removeformat | ...",
            media_live_embeds: true,
            relative_urls : false,
            remove_script_host : false,
            extended_valid_elements: 'script[type|src|charset]'
        });
    </script>

@endsection
