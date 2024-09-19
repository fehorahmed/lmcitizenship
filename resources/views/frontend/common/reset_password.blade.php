@extends('frontend.layouts.app')

@section('content')
    <!--slider-area-start-->
    @include('frontend.common.slider')
    @include('frontend.common.main_menu')
    <!--slider-area-end-->
    <!-- marquee-area-start-->
    @include('frontend.common.marquee')
    <!-- marquee-area-end-->

    <div class="about-area">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-5">
                    @if(Session::has('message'))
                        <div class="alert alert-danger">{{ Session::get('message') }}</div>
                    @endif

                    @if(Session::has('mail_sent'))
                        <div class="alert alert-info">{{ Session::get('mail_sent') }}</div>
                    @else
                    {{ Form::open(array('url' => 'reset_password', 'method' => 'post', 'value' => 'PATCH', 'id' => '')) }}

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email"> আপনার ইমেইল লিখুন </label>

                        <input id="email" type="email" placeholder="  আপনার ইমেইল লিখুন  " class="form-control" name="email"
                               value="{{ $email or old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <p>
                       <small>If your email registered before we will send you email and password reset URL.</small>
                    </p>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="  পাসওয়ার্ড  বদলান  " name="submit"/>
                    </div>

                    {{ Form::close() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
