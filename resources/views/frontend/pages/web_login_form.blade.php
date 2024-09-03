@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                        @if(Session::has('success'))
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        </div>
                    @endif
                    {{--@endif--}}
                    @if($errors->any())
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                {{-- <h4>Warning!</h4> --}}
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel">
                    <div class="panel-heading panel-color"><i class="fa fa-check" aria-hidden="true"></i>  লগইন</div>
                    <div class="panel-body">
                        <div class="about-text-another">
                            @include('frontend.common.login_form')
                        </div>
                    </div>
                </div>
                <br>
                <br>
            </div>
        </div>
    </div>
@endsection