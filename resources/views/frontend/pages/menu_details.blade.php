@extends('frontend.layouts.app')

@php
    $setting = \App\Models\Setting::first();
    if ($setting) {
        $name = $setting->name;
        $map_link = $setting->map;
    } else {
        $name = 'মোহনগঞ্জ পৌরসভা, নেত্রকোণা ।';
        $map_link = '';
    }

@endphp
@section('content')
    @include('frontend.common.main_menu')

    @include('frontend.common.marquee')


    <div class="container user_panel">
        {{-- @include('frontend.pages.message-section') --}}
        <div class="home-contact-box">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-12">
                        {!! $data->content??'' !!}
                    </div>
            </div>
        </div>
    </div>
@endsection
@section('cusjs')
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
