@extends('frontend.layouts.app')

@section('content')
    @include('frontend.common.slider')
    @include('frontend.common.marquee')

    <div class="container user_panel">
        @include('frontend.common.frontend_user_menu')

        @if (Route::has('login'))
            <?php $user = Auth::user(); ?>
            <div class="row up_bottom">
                <div class="col-md-3">

                    @include('frontend.common.user_panel_sidebar')

                </div>
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">প্রোফাইল</div>
                        <div class="panel-body">


                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection

@section('cusjs')
    <link rel="stylesheet" href="{{ URL::asset('public/css/dropzone.min.css') }}">
@endsection