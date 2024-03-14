@extends('backend.app')

@section('title', 'Photo Album Position List')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-ui.css') }}">
    <style>
        .ui-widget.ui-widget-content{max-height: 500px; overflow-y: scroll; overflow-x: hidden;}
        .item{list-style: none; background: lightgray; padding: 5px; margin: 2px 0; width: 100%; cursor: move;}
    </style>
@endsection

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb" style="display: inline-block; width: 500px">
            <li><a href="{{ route('bn-content-position.index') }}">Photo Album Position List</a></li>
            <li class="active">Set Position</li>
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
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-body">
                        <br>
                        <div class="form-inline">
                            {{ csrf_field() }}
                            <input type="hidden" name="position" value="{{ $album_position->position_id }}">
                            <div class="form-group">
                                @php
                                    $aid = explode('/', URL::current());
                                @endphp
                                <label for="positionName" class="control-label">Choose position </label>
                                <select id="positionName" name="positionName" class="form-control">
                                    @foreach($allpositions as $position)
                                        <option value="{{ $position->position_id }}" {{ $position->position_id == $aid[count($aid)-1]? 'selected' : '' }}>{{ $position->position_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="newsHeading" class="control-label">News Heading </label>
                                <input type="text" name="term" id="newsHeading" class="form-control" placeholder="News ID / Title..." required>
                                <input type="hidden" id="positionId" value="{{ $album_position->position_id }}">
                                <input type="hidden" name="albumId" id="albumId">
                            </div>
                            <div class="form-group">
                                <select name="position" id="position" class="form-control">
                                    @for($i=1; $i<=12; $i++);
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="positionSet" class="btn btn-primary">Set</button>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-1 text-right position-number">
                                <ul id="serial">
                                    @if(!empty($allAlbums))
                                        @for($i=1; $i <= count($allAlbums); $i++)
                                            <li>{{ $i }}</li>
                                        @endfor
                                    @endif
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul id="sortable" style="padding: 0">
                                    @if(!empty($allAlbums))
                                        @foreach($allAlbums as $album)
                                            <li class="item" id="item-{{ $album->album_id }}">
                                                {{ $album->album_name }}
                                                <span class="badge">{{ $album->album_id }}</span>
                                                <button id="removePosition" class="btn btn-xs btn-warning pull-right" onclick="removeLi({{ $album->album_id }})">X</button>
                                            </li>
                                        @endforeach
                                    @endif
                                    <input type="hidden" value="{{ $album_position->position_id }}" id="positionId">
                                    <button type="button" onclick="saveData({{ $album_position->position_id }})" class="btn btn-primary">Save</button>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection

@section('custom-js')
    <script>
        $("#positionSet").click(function () {
            var content = $("#newsHeading").val().split(' - ');
            if (content.length != 3){
                alert("Please select the news properly from the dropdown!");
            }else {
                if ($('#serial li').length == 0) {
                    $('#serial').prepend('<li>' + 1 + '</li>');
                    $('#sortable').prepend('<li class="item" id="item-' + content[0] + '" style="background: #ED0000; color: #FFF;">' + content[1] + ' <span class="badge">' + content[0] + '</span><button id="removePosition" class="btn btn-xs btn-warning pull-right" onclick="removeLi(' + content[0] + ')">X</button></li>')
                } else {
                    var serial = $('#serial li').length - 1;
                    var svalue = serial + 2;
                    $('#serial li:eq(' + serial + ')').after('<li>' + svalue + '</li>');
                    var position = $("#position").val() - 1;

                    if ($("#position").val() > $('#sortable li').length) {
                        position = $("#position").val() - 2;
                        $('#sortable li:eq(' + position + ')').after('<li class="item" id="item-' + content[0] + '" style="background: #ED0000; color: #FFF;">' + content[1] + ' <span class="badge">' + content[0] + '</span><button id="removePosition" class="btn btn-xs btn-warning pull-right" onclick="removeLi(' + content[0] + ')">X</button></li>');
                    } else {
                        $('#sortable li:eq(' + position + ')').before('<li class="item" id="item-' + content[0] + '" style="background: #ED0000; color: #FFF;">' + content[1] + ' <span class="badge">' + content[0] + '</span><button id="removePosition" class="btn btn-xs btn-warning pull-right" onclick="removeLi(' + content[0] + ')">X</button></li>');
                    }
                }
            }

        });

        $("#sortable").sortable();
        function saveData(posId) {
            var data = $("#sortable").sortable('serialize');
            var settings = {
                show_special: $('input[name=show_special]:checked', '#special-section-setting').val() == 1 ? 1 : 2,
                special_title: $("#special_title").val(),
                special_link: $("#special_link").val(),
            };

            if(data.length == 0){
                confirm("Please set at least a news!");
            }else{
                var id = posId;
                $.post('{{ url("backend/photo-album-position/change") }}', {'_token': '{{ csrf_token() }}', "data": data, "settings": settings, 'id': id}, function(data){
                    alert("The position has been changed!");
                    window.location.href = '{{ url("backend/photo-album-position/change") }}/'+data.position_id;
                });
            }

        }

        function removeLi(id) {
            $('#serial li:last-child').remove();
            $('#item-'+id).remove();
        }

        $(function() {
            $("#newsHeading").autocomplete({ // For news title autocomplete
                source: function(request, response) {
                    $.get("{{ url('backend/photo-album-position/keyword') }}", { posId: $('#positionId').val(), term: $('#newsHeading').val() }, response);
                },
                minLength: 1,
                select: function (event, ui) {
                    $('#albumId').val(ui.item.id);
                }
            });
        });

        $(function() {
            // Show/hide right setting section
            var positionId = '{{ $album_position->position_id }}';

            if (positionId == 2) {
                $("#special-section-setting").css('display', 'block');
            } else {
                $("#special-section-setting").css('display', 'none');
            }

            $('#positionName').change(function() {
                var position = $(this).val();

                if (position == 2) {
                    $("#special-section-setting").css('display', 'block');
                    $("#special-top-setting").css('display', 'none');
                } else {
                    $("#special-section-setting").css('display', 'none');
                }

                $('#newsHeading').val('');
                $('#positionId').val(position);
                //alert(position);
                $.get('{{ url("backend/photo-album-populate-position") }}', {'position': position}, function (data) {
                    $('#serial').empty();
                    var no = 1;
                    $.each(data.albums, function() {
                        //$('#sortable').append("<option value='"+ value.id +"'>" + value.name + "</option>");
                        $('#serial').append('<li>'+no+'</li>');
                        no++;
                    });

                    $('#sortable').empty();

                    $.each(data.albums, function(key, value) {
                        //$('#sortable').append("<option value='"+ value.id +"'>" + value.name + "</option>");
                        $('#sortable').append('<li class="item ui-sortable-handle" id="item-'+value.album_id+'">'+
                                value.album_name+
                                '<span class="badge">'+value.album_id +'</span>'+
                                '<button id="removePosition" class="btn btn-xs btn-warning pull-right" onclick="removeLi('+value.album_id+')">X</button>'+
                                '</li>'
                        );
                    });

                    $('#sortable').append('' +
                            '<input type="hidden" value="'+data.position.position_id+'" id="positionId">'+
                            '<button type="button" onclick="saveData('+data.position.position_id+')" class="btn btn-primary">Save</button>'
                    );

                    // Show setting data
                    // if (data.position.position_id == 2) {
                    //     if (data.settings.show_special == 1){
                    //         $("#yes").attr("checked", "checked")
                    //     } else {
                    //         $("#no").attr("checked", "checked")
                    //     }
                    //
                    //     $("#special_title").val(data.settings.special_title);
                    //     $("#special_link").val(data.settings.special_link);
                    // }
                });
            });
        });
    </script>
@endsection
