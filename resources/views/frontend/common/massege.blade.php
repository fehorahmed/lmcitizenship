@extends('frontend.layouts.app')
@section('content')
<div class="container user_panel">
    @include('frontend.common.frontend_user_menu')



    <div class="row up_bottom" style="margin-top: 20px;">
        <div class="col-md-12">
            <div class="panel panel-default commone-hean">
                <div class="panel-heading">
                    টাকা পরিশোধের তথ্যাদি
                </div>

                <div class="panel-body">



                    <div class="row">
                        <div class="col-md-12">
                            @php
                            $service = \App\Service::where('id', $payment->service_id)->get()->first();

                            @endphp
                            <p><b>Service Name:</b> {{ $service->en_name  }} ({{ ($service->for_which_language == 'en')? 'English' : 'Bangla' }})</br>
                                <b>Payment method:</b> {{ $payment->payment_method }}</br>
                                <b>Transaction no:</b> {{ $payment->transaction_no }}</br>
                                <b>Amount:</b> {{ $payment->amount }}</br>
                                <b>Amount:</b> {{ $payment->amount }}</br>
                                <b>Payment ID:</b> {{ $payment->id }}</p>
                            <p class="text-danger"><b>{{ $massege}}</b> </p>




                        </div>
                    </div>



                </div>

            </div>
        </div>
    </div>

</div>
@endsection

@section('cusjs')

@endsection