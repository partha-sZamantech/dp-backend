@extends('frontend.bn.app')

@section('title', request()->get('q') . ' । Search । ঢাকা প্রকাশ')

@section('customMeta')
    <link rel="canonical" href="{{url('search')}}">
@endsection

@section('mainContent')
    <div class="main-content">
        <div class="container">
            <p class="breadcrumb">
                <a href="/"><i class="fa fa-home"></i></a>
                <span>&raquo;</span>
                <a href="#" class="{{ !empty(request()->get('q')) ? '' : 'active' }}">অনুসন্ধান</a>
                @if(!empty(request()->get('q')))
                    <span>&raquo;</span>
                    <a href="#" class="active">{{ !empty(request()->get('q')) ? request()->get('q') : 'Search' }}</a>
                @endif
            </p>

            <div class="row marginBottom20">
                <div class="col-sm-12">
                    <script async src="https://cse.google.com/cse.js?cx=795e3fcdce38dac0a"></script>
                    <div class="gcse-search"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
