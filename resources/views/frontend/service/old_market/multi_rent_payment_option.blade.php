@extends('frontend.layouts.app')
@section('content')

    @php
        $rent = [];
        $fine = [];
        //dd($mdata);
    @endphp
    <div id="my-app">



        <div class="container">



            <div style="max-width: 550px; margin:  auto">

                {{Form::open(array('url' => 'multi_rent_payment_option', 'method' => 'post','autocomplete' => 'off'))}}

                @foreach($mdata as $list)

                    @php
                        $rents = App\Rent::Where(['id' => $list])->get()->first();
                        $rent[] = $rents->rent_amount;
                        $fine[] = get_rent_fine($rents->id);
                    @endphp
                    {{ Form::hidden('month_rent['.$rents->id.'][charge]',0, []) }}
                    {{ Form::hidden('month_rent['.$rents->id.'][id]', $rents->id, ['required']) }}
                    {{ Form::hidden('month_rent['.$rents->id.'][rent]', $rents->rent_amount, ['required']) }}
                    {{ Form::hidden('month_rent['.$rents->id.'][fine]', get_rent_fine($rents->id), ['required']) }}
                    {{ Form::hidden('user_id', auth()->user()->id, ['required']) }}


                    @endforeach

                <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel" style="text-align: center;">
                        দোকান হস্তান্তরের আবেদন।
                    </h4>
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
                                      মাসিক ভাড়া
                                </div>
                            </div>
                            {{ Form::number('payment_info[rent]',array_sum($rent), ['required', 'class' => 'form-control', 'placeholder' => 'টাকার পরিমাণ..','readonly']) }}

                            <div class="input-group-addon">
                                <div class="input-group-text">টাকা</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group" style="margin-bottom: 5px">
                            <div class="input-group-addon" style="min-width: 165px">
                                <div class="input-group-text" id="rent_amount_co">
                                     জরিমানা
                                </div>
                            </div>
                            {{ Form::number('payment_info[fine]',array_sum($fine), ['required', 'class' => 'form-control', 'placeholder' => 'টাকার পরিমাণ..','readonly']) }}

                            <div class="input-group-addon">
                                <div class="input-group-text">টাকা</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group" style="margin-bottom: 5px">
                            <div class="input-group-addon" style="min-width: 165px">
                                <div class="input-group-text" id="rent_amount_co">
                                    মোট ফি
                                </div>
                            </div>
                            {{ Form::hidden('payment_info[charge]', 0, []) }}
                            {{ Form::number('payment_info[total]',(array_sum($rent) + array_sum($fine)), ['required', 'class' => 'form-control', 'placeholder' => 'টাকার পরিমাণ..','readonly']) }}

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

                                <input placeholder="তারিখ.." name="payment_info[date]" type="text" class="form-control date-pick" v-model="date">


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
                        {{ Form::label('remarks', '  মন্তব্য', array('class' => 'notes')) }}
                        {{ Form::textarea('payment_info[notes]', NULL, ['id' => null, 'rows' => 2, 'class' => 'form-control', 'placeholder' => 'কি কারণে  জমি হস্তান্তর করতে চান?...']) }}

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