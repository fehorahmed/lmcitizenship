@extends('frontend.layouts.app')
@section('content')
<div class="container user_panel">


    @if (Route::has('login'))


    @php

    //dump(Storage());
    @endphp

    <div id="my-app">
        <div class="row up_bottom" style="margin-top: 20px;">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        টাকা পরিশোধের তথ্যাদি
                    </div>
                    {{ Form::open(array('url' => '/pay_now_by_service', 'method' => 'post', 'value' => 'PATCH', 'id' =>
                    'pay_now', 'enctype' => 'multipart/form-data')) }}

                    {{ Form::hidden('payment_nature','Renew', []) }}

                    <div class="panel-body">

                        @include('frontend.common.message_handler')

                        <div class="row">
                            <div class="col-xs-12 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <b> সেবা নামঃ {{ $paydata['name'] }}
                                        <hr></b>
                                    {{ Form::label('payment_method', ' টাকা দেয়ার মাধ্যম ', array('class' => 'payment_method cmmone-class')) }}

                                    <select id="payment_method" name="payment_method" class="form-control" v-model="payment" v-on:change="paymentMethod">

                                        <option value="bKash">বিকাশ</option>
                                        <option value="Rocket">রকেট</option>
                                        <option value="Nogod">নগদ</option>
                                        <option value="DBBL">ডিবিবিএল</option>
                                        <option value="Cash">ক্যাশ</option>
                                        <option value="Bank">পে অর্ডার / ব্যাংক ড্রাফট</option>
                                        <option value="Others">অন্যান্য</option>
                                    </select>



                                </div>




                                <div class="form-group">
                                    <div class="input-group" style="margin-bottom: 5px">
                                        <div class="input-group-addon" style="min-width: 165px">
                                            <div class="input-group-text" id="rent_amount_co">
                                                মোট ফি
                                            </div>
                                        </div>
                                        {{ Form::number('amount',$paydata['amount'], ['required', 'class' => 'form-control', 'placeholder' => 'টাকার পরিমাণ..','readonly']) }}

                                        <div class="input-group-addon">
                                            <div class="input-group-text">টাকা</div>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="isActive">
                                    <div class="form-group">


                                        <div class="input-group" style="margin-bottom: 5px">
                                            <div class="input-group-addon" style="min-width: 165px">
                                                <div class="input-group-text" id="rent_amount_co">পে অর্ডার
                                                    / ব্যাংক ড্রাফট নং
                                                </div>
                                            </div>
                                            {{ Form::number('bank_transaction', null, ['class' => 'form-control', 'placeholder' => 'পে অর্ডার / ব্যাংক ড্রাফট নং..']) }}


                                        </div>

                                        <div class="input-group" style="margin-bottom: 5px">
                                            <div class="input-group-addon" style="min-width: 165px">
                                                <div class="input-group-text" id="rent_amount_co">ব্যাংকের
                                                    নাম
                                                </div>
                                            </div>
                                            {{ Form::text('bank_name', null, ['class' => 'form-control', 'placeholder' => 'ব্যাংকের নাম..']) }}

                                        </div>
                                        <div class="input-group" style="margin-bottom: 5px">
                                            <div class="input-group-addon" style="min-width: 165px">
                                                <div class="input-group-text" id="rent_amount_co">শাখা</div>
                                            </div>
                                            {{ Form::text('bank_branch', null, ['class' => 'form-control', 'placeholder' => 'শাখা..']) }}

                                        </div>

                                    </div>
                                </div>

                                <div v-else>
                                    <div class="form-group">


                                        <div class="input-group" style="margin-bottom: 5px">
                                            <div class="input-group-addon" style="min-width: 165px">
                                                <div class="input-group-text" id="rent_amount_co">লেনদেন
                                                    নম্বর লিখুন
                                                </div>
                                            </div>
                                            {{ Form::number('transaction_number', null, ['class' => 'form-control', 'placeholder' => ' লেনদেন নম্বর লিখুন...']) }}


                                        </div>

                                        <div class="input-group" style="margin-bottom: 5px">
                                            <div class="input-group-addon" style="min-width: 165px">
                                                <div class="input-group-text" id="rent_amount_co">
                                                    ট্রানস্যাকশন আইডি
                                                </div>
                                            </div>
                                            {{ Form::text('transaction_no', null, ['class' => 'form-control', 'placeholder' => 'ট্রানস্যাকশন আইডি..']) }}

                                        </div>
                                    </div>
                                </div>

                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text" id="rent_amount_co">তারিখ
                                        </div>
                                    </div>
                                    {{ Form::text('payment_date', null, ['class' => 'form-control date-pick', 'placeholder' => 'তারিখ..','autocomplete' => 'off']) }}

                                </div>





                                {{ Form::hidden('user_id', $paydata['user_id'], ['required']) }}
                                {{ Form::hidden('digi_center_user_id',$paydata['digi_center_user_id'], ['required']) }}
                                {{ Form::hidden('service_id', $paydata['service_id'], ['required']) }}
                                {{ Form::hidden('which_time', $paydata['which_time'], ['required']) }}
                                {{ Form::hidden('for_which_language', $paydata['language'], ['required']) }}

                                {{ Form::hidden('service_details_id', $paydata['service_details_id'], ['required']) }}


                                {{ Form::hidden('to_uni', $paydata['to_uni'], ['required']) }}
                                {{ Form::hidden('to_digi', $paydata['to_digi'], ['required']) }}


                            </div>
                            <div class="col-xs-12 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <b>
                                        Attachments
                                        <hr>
                                    </b>
                                </div>

                                @if($service->is_nid_info || $service->is_nid_file )

                                <div class="form-group input-box input-box-green">
                                    <label for="nid_info" class="cmmone-class"> NID <small>{{ ($service->is_nid_file )? '(jpg/jpeg/png)': ''}}</small></label>
                                    <div class="input-inner">
                                        @if($service->is_nid_info )
                                        {{ Form::text('nid_info', !empty($user) ? @$user->nidno : NULL, ['class' => 'form-control', 'placeholder' => ' National ID ', 'require']) }}
                                        @endif
                                        @if($service->is_nid_file )
                                        <input type="file" id="nid_file" name="nid_file" require>
                                        @endif
                                    </div>
                                </div>
                                @endif


                                @if($service->is_citizenship_file || $service->is_citizenship_info )
                                <div class="form-group input-box input-box-blue">
                                    <label for="citizenship_info" class="cmmone-class"> Citizenship Certificate <small>{{ ($service->is_citizenship_file )? '(jpg/jpeg/png)': ''}}</small></label>
                                    <div class="input-inner">
                                        @if($service->is_citizenship_info )
                                        {{ Form::text('citizenship_info',  NULL, ['class' => 'form-control', 'placeholder' => ' Citizenship Certificate ID ', 'require']) }}
                                        @endif
                                        @if($service->is_citizenship_file )
                                        <input type="file" id="citizenship_file" name="citizenship_file" require>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                @if($service->is_photo_file )
                                <div class="form-group input-box input-box-perpel">

                                    <label for="photo_file" class="cmmone-class"> Photo <small>(jpg/jpeg/png)</small></label>
                                    <div class="input-inner">
                                        <input type="file" id="photo_file" name="photo_file" require>

                                    </div>
                                </div>
                                @endif




                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::submit(' প্রদান করুন ', ['class' => 'btn btn-success', 'name' => 'submit']) }}
                        </div>

                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('cusjs')


<script>
    var myapp = new Vue({
        el: "#my-app",
        data: {
            isActive: true,
            payment: 'Bank',
            date: '',


        },
        mounted: function() {

            $(function() {
                $(".date-pick").datepicker({
                    format: 'dd-mm-yyyy'
                }).val();
            });
        },
        methods: {
            paymentMethod: function() {
                if (this.payment == "Bank") {
                    this.isActive = true;
                } else {
                    this.isActive = false;
                }

                $(function() {
                    $(".date-pick").datepicker({
                        format: 'dd-mm-yyyy'
                    }).val();
                });

            }
        }
    });
    Vue.config.devtools = true
</script>
@endsection