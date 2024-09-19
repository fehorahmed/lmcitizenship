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
                        <?php
                    if (!empty($message)) {
                        echo $message;
                    }
                    ?>

                    {{ Form::open(array('url' => 'retrieve_password', 'method' => 'post', 'value' => 'PATCH', 'id' => '')) }}

                    <input type="hidden" class="form-control" name="user_id" value="{{ $user->id }}" required>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="email"> নতুন পাসওয়ার্ড </label>
                        <input type="password" placeholder="নতুন পাসওয়ার" class="form-control" name="password" required>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="email"> পুনরায় নতুন পাসওয়ার্ড </label>
                        <input type="password" placeholder="পুনরায় নতুন পাসওয়া"  class="@error('confirm_password') is-invalid @enderror form-control"   name="confirm_password" required>
                    </div>

                    {{--<p>--}}
                    {{--<small>Enter same password two time to reset your password.</small>--}}
                    {{--</p>--}}
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="  পাসওয়ার্ড বদলান " name="submit"/>
                    </div>

                    {{ Form::close() }}


                </div>
            </div>
        </div>
    </div>
@endsection
