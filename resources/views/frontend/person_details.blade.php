@extends('frontend.layouts.app')

@section('content')
    <!--slider-area-start-->
    @include('frontend.common.slider')
    @include('frontend.common.main_menu')
    <!--slider-area-end-->
    <!-- marquee-area-start-->
    @include('frontend.common.marquee')
    <!-- marquee-area-end-->
    <div class="container user_panel">
        <div class="home-chairman-sesction">

            <div class="row">
                <div class="col-md-12">
                    <div style="min-height: 50vh" class="home-chairman-sesction card">

                        <div class="google-map-title section-title">
                            <h2>
                                {{ $data->designation }}
                            </h2>
                        </div>
                        <div class="charman_wp ">
                            <img src="{{ asset($data->photo) }}" alt="">
                            <p><br></p>
                            <p><b>{{ $data->name }}</b><br></p>
                            <p> {{ $data->designation }}, {{ $data->address }}<b>&nbsp;</b><span
                                    style="background-color: rgb(255, 255, 255); color: rgb(68, 68, 68); font-family: kalpurush, "
                                    open="" sans";="" text-align:="" justify;"=""> </span></p>
                            <p style="text-align: justify; "> {{ $data->content }}&nbsp;<br></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
