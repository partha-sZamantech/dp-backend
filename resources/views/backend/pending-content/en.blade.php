@extends('backend.app')

@section('title', 'En News List')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb" style="display: inline-block; width: 500px">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="active">En News List</li>
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
                    <div class="box-header with-border">
                        <div class="row" style="margin-bottom: 5px;">
                            <div class="col-sm-12">
                                <form action="{{ route('en-contents.index') }}" method="get">
                                    <label class="col-sm-1" for="searchBy">SearchBy</label>
                                    <div class="col-sm-2">
                                        <select class="form-control" id="searchBy" name="searchBy">
                                            <option value="1">News ID</option>
                                            <option value="2">News Text</option>
                                            <option value="3">Writer</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-7">
                                        <input name="keyword" class="form-control" placeholder="Search" type="text">
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                            <div class="btn-group" role="group">
                                                <button type="submit" class="btn bg-purple btn-sm btn-block"><i
                                                        class="fa fa-search"></i></button>
                                            </div>
                                            <div class="btn-group" role="group">
                                                <a href="{{ url('backend/en-contents/create') }}"
                                                   class="btn btn-primary btn-sm btn-block"><i
                                                        class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
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
                                    <a href="{{ fEnURL($content->content_id, $content->category->cat_slug,$content->subcategory->subcat_slug ?? '', $content->content_type) }}"
                                       target="_blank">{{ $content->content_heading }}</a><br>
                                    Uploader By: <span
                                        class="label label-primary">{{ optional($content->uploader)->name }}</span>
                                </td>
                                <td>
                                    <a href="#">{{ $content->category->cat_name }}</a><br/>
                                    Sub Category: <a href=""
                                                     class="badge label-success">{{ optional($content->subCategory)->subcat_name }}</a><br/>
                                    Special Category: <a href=""
                                                         class="badge label-primary">{{ optional($content->specialCategory)->cat_name }}</a>
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
                                    {{--Total Hit: <span class="badge label-default">{{ $content->total_hit }}</span>  --}}
                                </td>
                                <td>
                                    <a href="{{ route('en-contents.edit', $content->content_id) }}"
                                       class="btn btn-warning btn-xs">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    <form style="display: inline" method="post" action="{{ url('backend/pending/en-content/'.$content->content_id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('POST') }}
                                        <button onclick="return confirm('Are you sure to approve this news?')" class="badge label-success btn edit-content">
                                            <i class="fa fa-check"></i> Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('en-contents.destroy', $content->content_id) }}"
                                          method="post" style="display: inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-xs"
                                                onclick="return confirm('Are you sure to delete this news?')">
                                            <i class="fa fa-times"></i> Delete
                                        </button>
                                    </form>
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
            <form action="{{ route('en-contents.postQuickUpdate') }}" method="post">
                <input type="hidden" name="contentId" id="contentId">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Quick update information</h4>
                    </div>
                    <div class="modal-body">


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

        $(document).ready(function () {
            $(".edit-content").click(function () {
                var id = $(this).attr("id");

                $.get('{{ url("/backend/en-quickupdate-content?id=") }}' + id, function (data) {

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
                    optionSelecter(arrCategoryId, categoryId, 'category');

                    $('#subCategory').empty();
                    $.get('{{ url("/backend/en-subcat-populate?cat_id=") }}' + categoryId, function (data) {
                        $.each(data, function (index, subcatObj) {
                            $('#subCategory').append('<option value="' + subcatObj.subcat_id + '">' + subcatObj.subcat_name + '</option>');
                        });
                        $('#subCategory').prepend('<option value="1" selected>--None--</option>');
                        var arrSubCategoryId = document.getElementById('subCategory').getElementsByTagName('option');
                        optionSelecter(arrSubCategoryId, subCatId, 'subCategory');
                    });

                    $('#category').change(function () { // Pre-populate subcategory dropdown
                        var cat_id = $(this).val();
                        $('#subCategory').empty();
                        $.get('{{ url("/backend/en-subcat-populate?cat_id=") }}' + cat_id, function (data) {
                            $.each(data, function (index, subcatObj) {
                                $('#subCategory').append('<option value="' + subcatObj.subcat_id + '">' + subcatObj.subcat_name + '</option>');
                            });
                            $('#subCategory').prepend('<option value="1" selected>--None--</option>');
                        });
                    });

                    var arrSpecialcatId = document.getElementById('specialCategory').getElementsByTagName('option');
                    optionSelecter(arrSpecialcatId, specialcatId, 'specialCategory');

                    var arrDistrictId = document.getElementById('district').getElementsByTagName('option');
                    optionSelecter(arrDistrictId, districtId, 'district');

                    if (status == 1) {
                        $("#showNewsY").removeClass('active notActive');
                        //$("#showNewsY").removeClass('notActive');
                        $("#showNewsY").addClass('active');
                        $("#showNewsN").removeClass('active notActive');
                        //$("#showNewsN").removeClass('notActive');
                        $("#showNewsN").addClass('notActive');
                        $("#showNews").val('1');
                    } else if (status == 2) {
                        $("#showNewsY").removeClass('active notActive');
                        //$("#showNewsY").removeClass('notActive');
                        $("#showNewsY").addClass('notActive');
                        $("#showNewsN").removeClass('active notActive');
                        //$("#showNewsN").removeClass('notActive');
                        $("#showNewsN").addClass('active');
                        $("#showNews").val('2');
                    }

                    if (scroll == 2) {
                        $("#scrollY").removeClass('active notActive');
                        //$("#scrollY").removeClass('notActive');
                        $("#scrollY").addClass('active');
                        $("#scrollN").removeClass('active notActive');
                        //$("#scrollN").removeClass('notActive');
                        $("#scrollN").addClass('notActive');
                        $("#scroll").val('2');
                    } else if (scroll == 1) {
                        $("#scrollY").removeClass('active notActive');
                        //$("#scrollY").removeClass('notActive');
                        $("#scrollY").addClass('notActive');
                        $("#scrollN").removeClass('active notActive');
                        //$("#scrollN").removeClass('notActive');
                        $("#scrollN").addClass('active');
                        $("#scroll").val('1');
                    }
                });

                function optionSelecter(array, matchingID, elementID) {
                    for (i = 0; i < array.length; i++) {
                        if (array[i].value == matchingID) {
                            document.getElementById(elementID).getElementsByTagName('option')[i].selected = 'selected';
                            break;
                        }
                    }
                }
            });

            // Search form jquery
            var cat_id = $('#catType').val();
            $.get('{{ url("/backend/en-populate-category") }}', {'cat_id': cat_id}, function (data) {
                $.each(data, function (index, catObj) {
                    $('#catId').append('<option value="' + catObj.id + '" ' + (catObj.id == "{{-- $exPartPagination['catId'] --}}" ? "selected" : "") + '>' + catObj.name + '</option>');
                });
                $('#catId').prepend('<option value="" selected>--Choose category--</option>');
            });

            $('#catType').change(function () { // Pre-populate dropdown category-wise
                var cat_id = $(this).val();
                //alert(cat_id);
                $('#catId').empty();
                $.get('{{ url("/backend/en-populate-category") }}', {'cat_id': cat_id}, function (data) {
                    $.each(data, function (index, catObj) {
                        $('#catId').append('<option value="' + catObj.id + '">' + catObj.name + '</option>');
                    });
                    $('#catId').prepend('<option value="" selected>--Choose category--</option>');
                });
            });
        });

    </script>
@endsection
