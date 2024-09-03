@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <br>
            <div class="col-md-8 col-md-offset-2">

                <div class="panel">
                    <div class="panel-heading panel-color"><i class="fa fa-check" aria-hidden="true"></i> Signup</div>
                    <div class="panel-body">
                        <div class="about-text-another">
                            @include('frontend.common.signup_form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection