@extends('frontend.layouts.app')

@section('content')
    <div class="container user_panel">
        @include('frontend.common.frontend_user_menu')
        @if (Route::has('login'))
            <?php $user = Auth::user(); ?>
            <div class="row up_bottom">
                <div class="col-md-12">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div style="color:white;background-color:red;margin: 2px;padding: 5px;">{{$error}}</div>
                        @endforeach
                    @endif
                    {{ Form::open(array('url' => 'add_profile_now', 'method' => 'post', 'value' => 'PATCH', 'id' => 'add_profile_now')) }}
                    {{ Form::hidden('role_id', 8) }}
                    <div class="form-group">
                        {{ Form::label('name', '  নাম  ', array('class' => 'title cmmone-class')) }}
                        {{ Form::text('name', NULL, ['class' => 'form-control', 'placeholder' => 'নাম লিখুন ']) }}
                    </div>
                    {{-- <div class="form-group">
                        {{ Form::label('email', 'ইমেইল', array('class' => 'sub_title cmmone-class')) }}
                        {{ Form::text('email', NULL, ['class' => 'form-control', 'placeholder' => ' ইমেইল  লিখুন ']) }}
                    </div> --}}
                    {{--<div class="form-group">--}}
                    {{--{{ Form::label('username', 'ইউজারনেম', array('class' => 'sub_title cmmone-class')) }}--}}
                    {{--{{ Form::text('username', NULL, ['required', 'class' => 'form-control', 'placeholder' => '  ইউজারনেম   লিখুন ']) }}--}}
                    {{--</div>--}}

                    <div class="form-group">
                        {{ Form::label('phone', 'মোবাইল নম্বর', array('class' => 'sub_title cmmone-class')) }}
                        <div class="input-group">
                            <span class="input-group-addon">+88</span>
                            {{ Form::text('phone', NULL, ['class' => 'form-control', 'placeholder' => 'মোবাইল নম্বর লিখুন ']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('password', ' পাসওয়ার্ড ', array('class' => 'sub_title cmmone-class')) }}
                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'পাসওয়ার্ড']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('password_confirmation', 'পাসওয়ার্ড পুনরায় দিন ', array('class' => 'sub_title cmmone-class')) }}
                        {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'পাসওয়ার্ড']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('সাইন আপ', ['class' => 'btn btn-success']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        @endif
    </div>
@endsection
@section('cusjs')
    <style type="text/css">

    </style>
@endsection
