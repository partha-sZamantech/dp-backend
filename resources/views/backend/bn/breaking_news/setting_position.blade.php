@extends('backend.app')

@section('title', 'Change Breaking News Position')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-ui.css') }}">
    <style>
        .ui-widget.ui-widget-content{max-height: 500px; overflow-y: scroll; overflow-x: hidden;}
        .item{list-style: none; background: lightgray; padding: 5px; margin: 2px 0; width: 500px; cursor: move;}
    </style>
@endsection

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      @if(session()->has('successMsg'))
        <div class="alert alert-success alert-dismissable fade in custom-alert">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success!</strong> {{ session('successMsg') }}
        </div>
      @endif
      <ol class="breadcrumb">
        <li><a href="{{ route('bn-breaking-news.index') }}">Breaking News List</a></li>
        <li class="active">Change Breaking News Position</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-body">
                        @if($breakingNews->count())
                            <div class="row">
                                <div class="col-sm-1 text-right position-number">
                                    <ul id="serial">
                                        @if(!empty($breakingNews))
                                            @for($i=1; $i <= count($breakingNews); $i++)
                                                <li>{{ $i }}</li>
                                            @endfor
                                        @endif
                                    </ul>
                                </div>
                                <div class="col-sm-6" style="padding-left: 0">
                                    <ul id="sortable" style="padding: 0">
                                        @if(!empty($breakingNews))
                                            @foreach($breakingNews as $news)
                                                <li class="item" id="item-{{ $news->id }}">
                                                    {{ $news->news_title }}
                                                    <span class="badge">{{ $news->id }}</span>
    {{--                                                <button id="removePosition" class="btn btn-xs btn-warning pull-right" onclick="removeLi({{ $news->id }})">X</button>--}}
                                                </li>
                                            @endforeach
                                        @endif
                                        <button type="button" onclick="saveData()" class="btn btn-primary">Save</button>
                                    </ul>
                                </div>
                            </div>
                        @endif
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
        
        $("#sortable").sortable();
        function saveData() {
            var data = $("#sortable").sortable('serialize');

            if(data.length == 0){
                confirm("Please set at least a news!");
            }else{
                $.post('{{ route("bn-breaking-news.saveSettingPosition") }}', {'_token': '{{ csrf_token() }}', "data": data}, function(d){
                    alert("The setting & position has been saved successfully!");
                    window.location.href = '{{ route("bn-breaking-news.getSettingPosition") }}';
                });
            }

        }

        /*function removeLi(id) {
            $('#serial li:last-child').remove();
            $('#item-'+id).remove();
        }*/
    </script>
@endsection