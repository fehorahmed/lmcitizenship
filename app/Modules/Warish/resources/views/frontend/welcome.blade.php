@extends('frontend.layouts.app')

@section('content')
<div class="container user_panel">
    @php
    $rowNumber = 1;
    @endphp

    <h2 class="text-center">ওয়ারিশ</h2>

    <?php 
        if(Session::has('myexcep')){
            dump(Session::get('myexcep'));
        }
       
   ?>
    <div class="row up_bottom">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading nav">
                    @include('warish::frontend.part.menu')
                </div>

                <div class="panel-body">


                    {!!($rules->welcomepage)? $rules->welcomepage : null !!}

                </div>
            </div>
        </div>


    </div>

    @endsection

    @section('cusjs')

    @endsection