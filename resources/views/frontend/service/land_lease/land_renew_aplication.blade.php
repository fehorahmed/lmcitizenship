@extends('frontend.layouts.app')
@section('content')


    <div id="my-app">

        <div class="container">


            <div style="max-width: 550px; margin:  auto">

                {{Form::open(array('url' => 'land_renew_aply', 'method' => 'post','autocomplete' => 'off'))}}

                <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel" style="text-align: center;">
                        ইজারাকৃত জমি  ইজারা নাবায়নের  আবেদন।
                    </h4>
                </div>
                <div class="form-group">
                    <label for="renew" class="renew">  নবায়ন </label>
                    <select class="form-control" id="renew" name="renew">
                       @foreach($mdata as $key => $list)
                        <option value="{{$key}}" >
                            {{ e_to_b(date('F/Y', strtotime($list['start_date']))) }}  থেকে
                            {{ e_to_b(date('F/Y', strtotime($list['end_date']))) }}  পর্যন্ত  &nbsp;&nbsp; | &nbsp;&nbsp;
                            নবায়ন ফি  = {{ e_to_b($list['lease_amount']) }}  টাকা &nbsp;&nbsp;
                            ( জরিমানা {{ e_to_b($list['fine']) }} টাকা )


                        </option>
                           @endforeach
                    </select>
                </div>


                <div class="modal-body">
                    <div class="form-group">
                        <div class="radio">
                            <label>
                                <input type="radio" name="payment_info[payment_method]"
                                       id="pm_bankdraft"
                                       value="Bank draft"
                                       v-model="payment"
                                       v-on:change="paymentMethod"
                                       data-id="1" checked>
                                পে অর্ডার / ব্যাংক ড্রাফট
                            </label>
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="payment_info[payment_method]"
                                       id="pm_bkash"
                                       value="Bkash"
                                       v-model="payment"
                                       v-on:change="paymentMethod"
                                       data-id="1">
                                বিকাশ
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="payment_info[payment_method]"
                                       id="pm_nagot"
                                       value="Nagat"
                                       v-model="payment"
                                       v-on:change="paymentMethod"
                                       data-id="1">
                                নগদ
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="payment_info[payment_method]"
                                       id="pm_nagot"
                                       value="Cash"
                                       v-model="payment"
                                       v-on:change="paymentMethod"
                                       data-id="1">
                                ক্যাশ
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group" style="margin-bottom: 5px">
                            <div class="input-group-addon" style="min-width: 165px">
                                <div class="input-group-text" id="rent_amount_co">
                                    আবেদন ফি
                                </div>
                            </div>
                            {{ Form::number('payment_info[amount]',$land_setting->renew_fee, ['required', 'class' => 'form-control', 'placeholder' => 'টাকার পরিমাণ..','readonly']) }}

                            <div class="input-group-addon">
                                <div class="input-group-text">টাকা</div>
                            </div>
                        </div>
                    </div>


                    <div  v-if="isActive">
                        <div class="form-group">


                            <div class="input-group" style="margin-bottom: 5px">
                                <div class="input-group-addon" style="min-width: 165px">
                                    <div class="input-group-text" id="rent_amount_co">পে অর্ডার
                                        / ব্যাংক ড্রাফট নং
                                    </div>
                                </div>
                                {{ Form::number('payment_info[payorder]', null, ['class' => 'form-control', 'placeholder' => 'পে অর্ডার / ব্যাংক ড্রাফট নং..']) }}


                            </div>
                            <div class="input-group" style="margin-bottom: 5px">
                                <div class="input-group-addon" style="min-width: 165px">
                                    <div class="input-group-text" id="rent_amount_co">তারিখ
                                    </div>
                                </div>
                                {{ Form::text('payment_info[date]', null, ['class' => 'form-control date-pick', 'placeholder' => 'তারিখ..','autocomplete' => 'off']) }}


                            </div>
                            <div class="input-group" style="margin-bottom: 5px">
                                <div class="input-group-addon" style="min-width: 165px">
                                    <div class="input-group-text" id="rent_amount_co">ব্যাংকের
                                        নাম
                                    </div>
                                </div>
                                {{ Form::text('payment_info[bank]', null, ['class' => 'form-control', 'placeholder' => 'ব্যাংকের নাম..']) }}

                            </div>
                            <div class="input-group" style="margin-bottom: 5px">
                                <div class="input-group-addon" style="min-width: 165px">
                                    <div class="input-group-text" id="rent_amount_co">শাখা</div>
                                </div>
                                {{ Form::text('payment_info[branch]', null, ['class' => 'form-control', 'placeholder' => 'শাখা..']) }}

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
                                {{ Form::number('payment_info[number]', null, ['class' => 'form-control', 'placeholder' => ' লেনদেন নম্বর লিখুন...']) }}


                            </div>
                            <div class="input-group" style="margin-bottom: 5px">
                                <div class="input-group-addon" style="min-width: 165px">
                                    <div class="input-group-text" id="rent_amount_co">তারিখ
                                    </div>
                                </div>
                                {{ Form::text('payment_info[date]', null, ['class' => 'form-control date-pick', 'placeholder' => 'তারিখ..']) }}


                            </div>
                            <div class="input-group" style="margin-bottom: 5px">
                                <div class="input-group-addon" style="min-width: 165px">
                                    <div class="input-group-text" id="rent_amount_co">
                                        ট্রানস্যাকশন আইডি
                                    </div>
                                </div>
                                {{ Form::text('payment_info[tid]', null, ['class' => 'form-control', 'placeholder' => 'ট্রানস্যাকশন আইডি..']) }}

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('is_land_possession', 'জমি দখল আছে কি না?', array('class' => 'is_under_ground')) }}
                        {{ Form::select('is_land_possession',  [
                        'Yes' => 'হ্যাঁ',
                        'No' => 'না'], NULL,
                        ['class' => 'form-control', 'placeholder' => 'একটি বাছাই করুন...']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('notes', 'কি কারণে ইজারা নেয়া প্রয়োজন?', array('class' => 'notes')) }}
                        {{ Form::textarea('lease_reason', NULL, ['id' => null, 'rows' => 2, 'class' => 'form-control', 'placeholder' => 'কি কারণে ইজারা নেয়া প্রয়োজন?...']) }}

                        {{ Form::hidden('user_id', $user['user_id'], ['required']) }}
                        {{ Form::hidden('land_id',$land->id, ['required']) }}


                    </div>



                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">বাতিল
                    </button>
                    <button type="submit" class="btn btn-success">জমা দিন</button>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>

@endsection

@section('cusjs')
    <script>
        var myapp = new Vue({
            el:"#my-app",
            data:{
                isActive: true,
                payment: 'Bank draft',
                date: '',


            },
            mounted: function() {

                $(function () {
                    $(".date-pick").datepicker({format: 'dd-mm-yyyy'}).val();
                });
            },
            methods:{
                paymentMethod: function(){
                    if( this.payment == "Bank draft"){
                        this.isActive = true;
                    }else{
                        this.isActive = false;
                    }

                    $(function () {
                        $(".date-pick").datepicker({format: 'dd-mm-yyyy'}).val();
                    });

                }
            }
        });
        Vue.config.devtools = true
    </script>

@endsection