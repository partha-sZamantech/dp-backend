<div class="row">
    <div class="col-sm-12">
        <div class="top-video">
            {{-- Position 11 = Home Page Right One Ad --}}
            {{--@php
                $homeTopRightOneAd = Cache::get('homePageAdsCacheKey')->where('position', 11)->first();

                $hasHomeTopRightOneAdTime = true;
                if ($homeTopRightOneAd && $homeTopRightOneAd->start_time && $homeTopRightOneAd->end_time && !\Carbon\Carbon::now()->between($homeTopRightOneAd->start_time, $homeTopRightOneAd->end_time)){
                    $hasHomeTopRightOneAdTime = false;
                }
            @endphp--}}
            {{-- Home Page Top Right One Ad 650x150--}}
            <div class="marginBottom10">
                {{--@if($homeTopRightOneAd && $hasHomeTopRightOneAdTime)
                    --}}{{-- Type 1=DFP, 2=Code, 3=Image --}}{{--
                    @if($homeTopRightOneAd->type == 3)
                        <a href="{{ $homeTopRightOneAd->external_link }}" target="_blank" rel="nofollow">
                            <img src="{{ asset(config('appconfig.adPath').$homeTopRightOneAd->desktop_image_path) }}" alt="Home Top Right One Ad" style="width: 100%">
                        </a>
                    @else
                        {!! $homeTopRightOneAd->code !!}
                    @endif
                @else--}}
                @