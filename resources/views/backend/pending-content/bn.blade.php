@extends('backend.app')

@section('title', 'News List')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb" style="display: inline-block; width: 500px">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">Bangla News List</li>
        </ol>
        @if(session()->has('successMsg'))
            <div class="alert alert-success alert-dismissable fade in custom-alert" style="display: inline-block">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ session('successMsg') }}
            </div>
        @endif
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-info">
{{--                    <div class="box-header with-border">--}}
{{--                        <div class="row" style="margin-bottom: 5px;">--}}
{{--                            <div class="col-sm-12">--}}
{{--                                <form action="{{ url('backend/bn-contents') }}" method="get">--}}
{{--                                    <label class="col-sm-1" for="searchBy">SearchBy</label>--}}
{{--                                    <div class="col-sm-2">--}}
{{--                                        <select class="form-control" id="searchBy" name="searchBy">--}}
{{--                                            @php $types = [1 => 'News ID', 2 => 'News Text', 3 => 'Writer', 4 => 'Uploader'] @endphp--}}
{{--                                            @foreach($types as $key => $type)--}}
{{--                                                <option value="{{ $key }}" {{ request()->searchBy == $key ? 'selected' : '' }}>{{ $type }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-5">--}}
{{--                                        <input name="keyword" class="form-control" placeholder="Search" type="text" value="{{ request()->keyword }}">--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-2">--}}

{{--                                    </div>--}}
{{--                                    <div class="col-sm-2">--}}
{{--                                        <div class="btn-group btn-group-justified" role="group" aria-label="...">--}}
{{--                                            <div class="btn-group" role="group">--}}
{{--                                                <button type="submit" class="btn bg-purple btn-sm btn-block"><i--}}
{{--                                                        class="fa fa-search"></i></button>--}}
{{--                                            </div>--}}
{{--                                            <div class="btn-group" role="group">--}}
{{--                                                <a href="{{ route('bn-contents.create') }}"--}}
{{--                                                   class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                    </div>--}}
                    <!-- /.box-header -->

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>News Heading</th>
                            <th style="width: 200px;">Category</th>
                            <th style="width: 190px;">News Situation</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contents as $no => $content)
                            <tr>
                                <td>{{ $content->content_id }}</td>
                                <td>
                                    <a href="{{ fDesktopURL($content->content_id, $content->category->cat_slug, (!is_null($content->subcategory) ? $content->subcategory->subcat_slug : null), $content->content_type) }}"
                                       target="_blank">{{ $content->content_heading }}</a><br/>
                                    {{--                                    Author: <span class="label label-success">{{ Str::title(str_replace('-', ' ', $content->author_slugs)) }}</span><br/>--}}
                                    Uploader By: <span class="label label-primary">{{ optional($content->uploader)->name }}</span><br>
                                    Author: <span class="label label-primary">{{ $content->author_slugs != null ? Str::of($content->author_slugs)->replace('-', ' ')->title() : $content->author_name }}</span>
                                </td>
                                <td>
                                    <a href="#">{{ $content->category->cat_name_bn }}</a><br/>
                                    Sub Category: <a href=""
                                                     class="badge label-success">{{ optional($content->subCategory)->subcat_name_bn }}</a><br/>
                                    Special Category: <a href=""
                                                         class="badge label-primary">{{ optional($content->specialCategory)->cat_name_bn }}</a>
                                </td>
                                <td>
                                    Insert: <span class="badge label-success">{{ $content->created_at }}</span><br/>
                                    Update: <span class="badge label-primary">{{ $content->updated_at }}</span><br/>
                                    Status:
                                    @if($content->status == 1)
                                        <span class="badge label-success"><i class="fa fa-check"></i></span>
                                    @else
{{--                                        <span class="badge label-danger"><i class="fa fa-close"></i></span>--}}
                                        <span class="badge label-danger">Pending For Approval</span>

                                    @endif
                                    {{--Total Hit: <span class="badge label-default">{{ $content->total_hit }}</span>--}}
                                </td>
                                <td>
                                    <a href="{{ route('bn-contents.edit', $content->content_id) }}"
                                       class="btn btn-warning btn-xs">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
{{--                                    <button class="badge label-success btn edit-content" id="{{ $content->content_id }}" data-toggle="modal" data-target="#quickUpdate">--}}
                                    <form style="display: inline" method="post" action="{{ url('backend/pending/bn-content/'.$content->content_id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('POST') }}
                                        <button onclick="return confirm('Are you sure to approve this news?')" class="badge label-success btn edit-content">
                                            <i class="fa fa-check"></i> Approve
                                        </button>
                                    </form>

                                    {{-- 1=PowerAdmin, 2=NewsAdmin, 3=AdvAdmin, 4=CatAdmin, 5=BN News Admin, 6=EN News Admin--}}
                                    @if(auth()->user()->role === 1 ||  auth()->user()->role === 2)
                                        <form action="{{ url('backend/bn-contents/'.$content->content_id) }}" method="post"
                                              style="display: inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-xs"
                                                    onclick="return confirm('Are you sure to delete this news?')">
                                                <i class="fa fa-times"></i> Delete
                                            </button>
                                        </form>
                                    @else
                                        <button disabled type="submit" class="btn btn-danger btn-xs"
                                                onclick="return confirm('Are you sure to delete this news?')">
                                            <i class="fa fa-times"></i> Delete
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $contents->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->

    <!-- Start quick update modal -->
    <div class="modal fade" id="quickUpdate" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="width: 550px;">
            <form action="{{ route('bn-contents.postQuickUpdate') }}" method="post">
                <input type="hidden" name="contentId" id="contentId">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Quick update information</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Start -->
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <label for="category" class="input-group-addon">Category</label>--}}
{{--                                        <select class="form-control select2" name="category" id="category"--}}
{{--                                                style="width:100%;">--}}
{{--                                            @foreach($categories as $category)--}}
{{--                                                <option--}}
{{--                                                    value="{{ $category->cat_id }}">{{ $category->cat_name_bn }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label for="subCategory" class="input-group-addon">Sub Category</label>
                                        <select id="subCategory" name="subCategory"
                                                class="form-control select2"></select>
                                    </div>
                                </div>
                            </div>
                        </div>

{{--                        <div class="row">--}}
{{--                            <div class="col-sm-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <label for="specialCategory" class="input-group-addon">Special Category</label>--}}
{{--                                        <select id="specialCategory" name="specialCategory" class="form-control select2"--}}
{{--                                                style="width:100%;">--}}
{{--                                            @foreach($specialCategories as $specialCategory)--}}
{{--                                                <option--}}
{{--                                                    value="{{ $specialCategory->cat_id }}">{{ $specialCategory->cat_name_bn }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row">--}}
{{--                            <div class="col-sm-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <label for="district" class="input-group-addon">District</label>--}}
{{--                                        <select id="district" name="district" class="form-control select2"--}}
{{--                                                style="width:100%;">--}}
{{--                                            @foreach($districts as $district)--}}
{{--                                                <option--}}
{{--                                                    value="{{ $district->district_id }}">{{ $district->district_name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="btn-group radioBtn">
                                        <a id="showNewsY" class="btn btn-primary btn-sm" data-toggle="showNews"
                                           data-title="1">Y</a>
                                        <a id="showNewsN" class="btn btn-primary btn-sm" data-toggle="showNews"
                                           data-title="2">N</a>
                                    </div>
                                    <label for="showNews" class="">Show News?</label>
                                    <input type="hidden" name="showNews" id="showNews">
                                </div>
                            </div>
                            {{--<div class="col-sm-4">
                                <div class="form-group">
                                    <div class="btn-group radioBtn">
                                        <a id="scrollY" class="btn btn-primary btn-sm" data-toggle="scroll"
                                           data-title="2">Y</a>
                                        <a id="scrollN" class="btn btn-primary btn-sm" data-toggle="scroll"
                                           data-title="1">N</a>
                                    </div>
                                    <label for="scroll" class="">Scroll?</label>
                                    <input type="hidden" name="scroll" id="scroll">
                                </div>
                            </div>--}}

                        </div>
                        <!-- End -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-flat">Quick Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End quick update modal -->
@endsection

@section('custom-js')
    <script>
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

        $(document).ready(function(){
            $(".edit-content").click(function(){
                var id = $(this).attr("id");

                $.get('{{ url("/backend/quickupdate-content?id=") }}'+id, function(data) {

                    $('#contentId').val(data.content_id);
                    var categoryId = data.cat_id;
                    var subCatId = data.subcat_id;
                    var specialcatId = data.special_cat_id;
                    var districtId = data.district_id;
                    var status = data.status;
                    var scroll = data.scroll;
                    var standoutTag = data.standout_tag;
                    var instantArticle = data.instant_article;

                    var arrCategoryId = document.getElementById('category').getElementsByTagName('option');
                    optionSelecter(arrCategoryId,categoryId,'category');

                    $('#subCategory').empty();
                    $.get('{{ url("/backend/subcat-populate?cat_id=") }}'+categoryId, function(data){
                        $.each(data, function(index, subcatObj){
                            $('#subCategory').append('<option value="'+subcatObj.subcat_id+'">'+subcatObj.subcat_name_bn+'</option>');
                        });
                        $('#subCategory').prepend('<option value="1" selected>--None--</option>');
                        var arrSubCategoryId = document.getElementById('subCategory').getElementsByTagName('option');
                        optionSelecter(arrSubCategoryId,subCatId,'subCategory');
                    });

                    $('#category').change(function(){ // Pre-populate subcategory dropdown
                        var cat_id = $(this).val();
                        $('#subCategory').empty();
                        $.get('{{ url("/backend/subcat-populate?cat_id=") }}'+cat_id, function(data){
                            $.each(data, function(index, subcatObj){
                                $('#subCategory').append('<option value="'+subcatObj.subcat_id+'">'+subcatObj.subcat_name_bn+'</option>');
                            });
                            $('#subCategory').prepend('<option value="1" selected>--None--</option>');
                        });
                    });

                    var arrSpecialcatId = document.getElementById('specialCategory').getElementsByTagName('option');
                    optionSelecter(arrSpecialcatId,specialcatId,'specialCategory');

                    var arrDistrictId = document.getElementById('district').getElementsByTagName('option');
                    optionSelecter(arrDistrictId,districtId,'district');

                    if(status == 1){
                        $("#showNewsY").removeClass('active notActive');
                        //$("#showNewsY").removeClass('notActive');
                        $("#showNewsY").addClass('active');
                        $("#showNewsN").removeClass('active notActive');
                        //$("#showNewsN").removeClass('notActive');
                        $("#showNewsN").addClass('notActive');
                        $("#showNews").val('1');
                    }else if(status == 2){
                        $("#showNewsY").removeClass('active notActive');
                        //$("#showNewsY").removeClass('notActive');
                        $("#showNewsY").addClass('notActive');
                        $("#showNewsN").removeClass('active notActive');
                        //$("#showNewsN").removeClass('notActive');
                        $("#showNewsN").addClass('active');
                        $("#showNews").val('2');
                    }

                    if(scroll == 2){
                        $("#scrollY").removeClass('active notActive');
                        //$("#scrollY").removeClass('notActive');
                        $("#scrollY").addClass('active');
                        $("#scrollN").removeClass('active notActive');
                        //$("#scrollN").removeClass('notActive');
                        $("#scrollN").addClass('notActive');
                        $("#scroll").val('2');
                    }else if(scroll == 1){
                        $("#scrollY").removeClass('active notActive');
                        //$("#scrollY").removeClass('notActive');
                        $("#scrollY").addClass('notActive');
                        $("#scrollN").removeClass('active notActive');
                        //$("#scrollN").removeClass('notActive');
                        $("#scrollN").addClass('active');
                        $("#scroll").val('1');
                    }
                });

                function optionSelecter( array, matchingID, elementID){
                    for (i = 0; i < array.length; i++) {
                        if(array[i].value==matchingID){
                            document.getElementById(elementID).getElementsByTagName('option')[i].selected='selected';
                            break;
                        }
                    }
                }
            });

            // Search form jquery
            {{--var cat_id = $('#catType').val();--}}
            {{--var extCatId = '{{ $exPartPagination['catId'] }}';--}}
            {{--$.get('{{ url("/backend/populate-category") }}', {'cat_id':cat_id}, function(data){--}}
            {{--    $.each(data, function(index, catObj){--}}
            {{--        $('#catId').append('<option value="'+catObj.id+'" '+(catObj.id == extCatId ? "selected" : "")+'>'+catObj.name+'</option>');--}}
            {{--    });--}}
            {{--    $('#catId').prepend('<option value=""'+(extCatId ? '' : ' selected')+'>--Choose category--</option>');--}}
            {{--});--}}

            $('#catType').change(function(){ // Pre-populate dropdown category-wise
                var cat_id = $(this).val();
                //alert(cat_id);
                $('#catId').empty();
                $.get('{{ url("/backend/populate-category") }}', {'cat_id':cat_id}, function(data){
                    $.each(data, function(index, catObj){
                        $('#catId').append('<option value="'+catObj.id+'">'+catObj.name+'</option>');
                    });
                    $('#catId').prepend('<option value="" selected>--Choose category--</option>');
                });
            });
        });

    </script>
@endsection
