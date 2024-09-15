@extends('frontend.layouts.app')

@section('content')

    @php

        $rowNumber = 1;

    @endphp

    @include('frontend.common.slider')

    @include('frontend.common.marquee')

    <div class="container user_panel">

        @include('frontend.common.frontend_user_menu')

        <div class="row up_bottom">

            <div class="col-md-12">

                <div class="panel panel-default">


                </div>

            </div>

        </div>

        @if (Route::has('login'))
            <?php $user = Auth::user(); ?>

            @if (Auth::user()->isDigitalCenter())
                <div class="jumbotron">

                    <div class="row w-100">
                        <div class="col-md-3">
                            <div class="card border-info mx-sm-1 p-3">

                                <div class="text-info text-center mt-2">
                                    <h1>
                                        <?php $dc_history = paymentHistory(); ?>
                                        {{ $dc_history['today_register'] }}
                                    </h1>
                                </div>
                                <div class="text-info text-center mt-3">
                                    <h4>
                                        আজকের নতুন রেজিস্ট্রেশন
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-success mx-sm-1 p-3">

                                <div class="text-warning text-center mt-2">
                                    <h1>
                                        {{ $dc_history['total_register'] }}
                                    </h1>
                                </div>
                                <div class="text-warning text-center mt-3">
                                    <h4>
                                        মোট রেজিস্ট্রেশন
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-danger mx-sm-1 p-3">

                                <div class="text-danger text-center mt-2">
                                    <h1>
                                        {{ $dc_history['today_income'] }}
                                    </h1>
                                </div>
                                <div class="text-danger text-center mt-3">
                                    <h4>
                                        আজকের আয়
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-danger mx-sm-1 p-3">

                                <div class="text-danger text-center mt-2">
                                    <h1>
                                        {{ $dc_history['total_income'] }}
                                    </h1>
                                </div>
                                <div class="text-danger text-center mt-3">
                                    <h4>
                                        মোট আয়
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row w-100">
                        <div class="col-md-3">
                            <div class="card border-info mx-sm-1 p-3">

                                <div class="text-success text-center mt-2">
                                    <h1>
                                        {{ $dc_history['today_income_up'] }}
                                    </h1>
                                </div>

                                <div class="text-success text-center mt-3">
                                    <h4>

                                        পৌরসভার আজকের আয়
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-success mx-sm-1 p-3">

                                <div class="text-danger text-center mt-2">
                                    <h1>
                                        {{ $dc_history['total_income_up'] }}
                                    </h1>
                                </div>

                                <div class="text-danger text-center mt-3">
                                    <h4>
                                        পৌরসভার মোট আয়
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-danger mx-sm-1 p-3">

                                <div class="text-danger text-center mt-2">
                                    <h1>
                                        {{ $dc_history['up_paid'] }}
                                    </h1>
                                </div>
                                <div class="text-danger text-center mt-3">
                                    <h4>
                                        মোট পরিশোধিত
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-danger mx-sm-1 p-3">

                                <div class="text-danger text-center mt-2">
                                    <h1>
                                        {{ $dc_history['up_due'] }}
                                    </h1>
                                </div>
                                <div class="text-danger text-center mt-3">
                                    <h4>
                                        মোট বকেয়া
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif (Auth::user()->isCommissioner())

            <div class="jumbotron">

                <div class="row w-100">
                    <div class="col-md-3">
                        <div class="card border-info mx-sm-1 p-3">

                            <div class="text-info text-center mt-2">
                                <h1>
                                    <?php $dc_history = paymentHistory(); ?>
                                    {{ $dc_history['today_register'] }}
                                </h1>
                            </div>
                            <div class="text-info text-center mt-3">
                                <h4>
                                    আজকের নতুন রেজিস্ট্রেশন
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-success mx-sm-1 p-3">

                            <div class="text-warning text-center mt-2">
                                <h1>
                                    {{ $dc_history['total_register'] }}
                                </h1>
                            </div>
                            <div class="text-warning text-center mt-3">
                                <h4>
                                    মোট রেজিস্ট্রেশন
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-danger mx-sm-1 p-3">

                            <div class="text-danger text-center mt-2">
                                <h1>
                                    {{ $dc_history['today_income'] }}
                                </h1>
                            </div>
                            <div class="text-danger text-center mt-3">
                                <h4>
                                    আজকের আয়
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-danger mx-sm-1 p-3">

                            <div class="text-danger text-center mt-2">
                                <h1>
                                    {{ $dc_history['total_income'] }}
                                </h1>
                            </div>
                            <div class="text-danger text-center mt-3">
                                <h4>
                                    মোট আয়
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row w-100">
                    <div class="col-md-3">
                        <div class="card border-info mx-sm-1 p-3">

                            <div class="text-success text-center mt-2">
                                <h1>
                                    {{ $dc_history['today_income_up'] }}
                                </h1>
                            </div>

                            <div class="text-success text-center mt-3">
                                <h4>

                                    পৌরসভার আজকের আয়
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-success mx-sm-1 p-3">

                            <div class="text-danger text-center mt-2">
                                <h1>
                                    {{ $dc_history['total_income_up'] }}
                                </h1>
                            </div>

                            <div class="text-danger text-center mt-3">
                                <h4>
                                    পৌরসভার মোট আয়
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-danger mx-sm-1 p-3">

                            <div class="text-danger text-center mt-2">
                                <h1>
                                    {{ $dc_history['up_paid'] }}
                                </h1>
                            </div>
                            <div class="text-danger text-center mt-3">
                                <h4>
                                    মোট পরিশোধিত
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-danger mx-sm-1 p-3">

                            <div class="text-danger text-center mt-2">
                                <h1>
                                    {{ $dc_history['up_due'] }}
                                </h1>
                            </div>
                            <div class="text-danger text-center mt-3">
                                <h4>
                                    মোট বকেয়া
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @else
                <div class="jumbotron">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">

                            <div class="man-service_one">
                                <div class="lang_enbn">
                                    <a class="btn btn-xs Bn_lang" target="_blank" href="{{ route('user.citizenship') }}"
                                        target="_blank">
                                        বাংলা
                                    </a>
                                    <a class="btn btn-xs En_lang" href="{{ route('user.citizenship') }}">
                                        EN
                                    </a>

                                </div>
                                <a target="_blank" href="{{ route('user.citizenship') }}" target="_blank">

                                    <img src="{{ asset('icons/citizenship_logo.png') }}">

                                </a>
                                <a target="_blank" href="{{ route('user.citizenship') }}" target="_blank">

                                    <h1>
                                        নাগরিকত্ব সনদ
                                    </h1>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                            <div class="man-service_one">
                                <div class="lang_enbn">
                                    <a class="btn btn-xs Bn_lang" target="_blank" href="{{ route('user.warish') }}"
                                        target="_blank">
                                        বাংলা
                                    </a>
                                    <a class="btn btn-xs En_lang" href="{{ route('user.warish') }}">
                                        EN
                                    </a>

                                </div>

                                <a target="_blank" href="{{ route('user.warish') }}" target="_blank">

                                    <img src="{{ asset('icons/profile.png') }}">

                                </a>

                                <a target="_blank" href="{{ route('user.warish') }}">
                                    <h1>
                                        ওয়ারিশ সনদ
                                    </h1>
                                </a>
                            </div>
                        </div>
                        {{-- Citizenship Button  --}}

                        @if (function_exists('luova_citizenship'))
                            @include('citizenship::essential.button')
                        @endif


                    </div>
                </div>
            @endif
        @endif

    </div>

@endsection

@section('cusjs')
    <script>
        var count = "{{ $rowNumber + 1 }}";

        count = Number(count);

        jQuery(document).ready(function($) {



            $(".date-pick").datepicker({

                format: 'dd-mm-yyyy'

            }).val();



            // master_function();



            $(document).on('click', '.removeRow', function(e) {

                var id = $(this).data('id');
                $('#row-' + id).remove();
            });

        });
    </script>

    <style type="text/css">
        .my-card {

            position: absolute;

            left: 40%;

            top: -20px;

            border-radius: 50%;

        }



        .service_lock {

            cursor: not-allowed;

            position: relative;

        }



        .service_lock:after {

            content: "LOCK";

            position: absolute;

            width: 100%;

            height: 100%;

            top: 0;

            background: #ffffffdb;

            text-align: center;

            line-height: 130px;

            font-size: 35px;

            color: rgba(70, 76, 119, 0.5);

        }
    </style>
@endsection
