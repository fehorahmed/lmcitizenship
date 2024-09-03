@extends('frontend.layouts.app')
@section('content')
<div class="container user_panel">


    <?php
   // $service = \App\Service::where('id', request()->get('sid'))->get()->first();

  //  dump($birth);

    $total_payable = 0;
    $which_time = $birth->request_type;
    $language = $birth->request_lang;
    if ($service->id == 13 && $user->age > 5) {

        $extra = $user->age - 5;
        if($extra > 0){
            $extra = $extra*10;
        }

        $discount = 0;
    }else{


        $discount = 0;
        $extra = 0;
    }
  //  dump($extra);
    if(auth()->user()->isDigitalCenter()){
        if (request()->get('lang') == 'en') {
            $language = 'en';
            $total_payable = $service->uni_first_en + $service->digi_first_en - $discount + $extra;
            $uni_price = $service->uni_first_en - $discount+ $extra;
            $digi_price = $service->digi_first_en+ $extra;
        } else {
            $language = 'bn';
            $total_payable = $service->uni_first_bn + $service->digi_first_bn - $discount + $extra;

            $uni_price = $service->uni_first_bn - $discount+ $extra;
            $digi_price = $service->digi_first_bn + $extra;
        }
    }else{
        if (request()->get('lang') == 'en') {
            $language = 'en';
            $total_payable = $service->uni_first_en  - $discount + $extra;

            $uni_price = $service->uni_first_en - $discount + $extra;
            $digi_price = 0;
        } else {
            $language = 'bn';
            $total_payable = $service->uni_first_bn - $discount + $extra;
            $uni_price = $service->digi_first_bn - $discount + $extra;
            $digi_price = 0;
        }
        //  dump($service->name);
    }


    ?>
    <div class="row up_bottom" style="margin-top: 20px;">
        <div class="col-md-12">
            <div class="panel panel-default commone-hean">
                <div class="panel-heading">
                    টাকা পরিশোধের তথ্যাদি
                </div>
                {{ Form::open(array('url' => 'birth_pay_now', 'method' => 'post', 'value' => 'PATCH', 'id' =>
                'pay_now')) }}
                <div class="panel-body">

                    @include('frontend.common.message_handler')

                    <div class="row">
                        <div class="col-xs-12 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <b> সেবা নামঃ {{$service->name }} {{ (request()->get('lang') == 'en')? ' (ইংরেজি) ': ' (বাংলা)'}} <hr></b>
                                {{ Form::label('payment_method', ' টাকা দেয়ার মাধ্যম ', array('class' => 'payment_method cmmone-class')) }}



                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="radio-inline">
                                            <input type="radio" name="payment_method" value="bKash" {{ old('payment_method') == 'bKash' ? 'checked' : '' }} required>বিকাশ
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="payment_method" value="Rocket" {{ old('payment_method') == 'Rocket' ? 'checked' : '' }}>রকেট
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="payment_method" value="Nogod" {{ old('payment_method') == 'Nogod' ? 'checked' : '' }}>নগদ
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="payment_method" value="DBBL" {{ old('payment_method') == 'DBBL' ? 'checked' : '' }}>ডিবিবিএল
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="payment_method" value="Others" {{ old('payment_method') == 'Others' ? 'checked' : '' }}>অন্যান্য
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="payment_method" value="Cash" {{ old('payment_method') == 'Cash' ? 'checked' : '' }}>ক্যাশ
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if($service->id == 12)

                            <div class="form-group">
                                <label for="sub_trad_licence">ট্রেড লাইসেন্স ধরণ</label>
                                <select id="sub_trad_licence" class="custom-select form-control" name="sub_trad_licence" required>
                                    @foreach (short_code($service->multi_service_price) as $item)
                                    @php
                                    if(auth()->user()->isDigitalCenter()){
                                    $sub_trad_price = $item['dprice'] + $item['uprice'];
                                    }else {
                                    $sub_trad_price = $item['dprice'] + $item['uprice'];
                                    }


                                    @endphp
                                    <option value="{{ $item['bname'] }}" data-price="{{ $sub_trad_price }}" >{{ $item['bname'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @endif

                            <div class="form-group">
                                @if($service->id == 12)

                                <div id="pay_aboe_tag"></div>

                                @else
                                {{ Form::label('payment_method',  ' এই সেবার ডাউনলোডের জন্য মোট '.  $total_payable  .' টাকা পরিশোধ করতে হবে ', array('class'
                                => 'payment_method cmmone-class','id' => 'pay_able_label' )) }}
                                @endif




                                {{ Form::text('amount', $total_payable, ['required', 'class' => 'form-control', 'placeholder' => ' মোট টাকা ', 'readonly'
                                => true, 'id' => (($service->id == 12)? 'pay_able_amount' : '') ]) }}

                            </div>

                            <div class="form-group" id="cash">
                                <label for="transaction_no" class="transaction_no cmmone-class"> লেনদেন নম্বর লিখুন <span class="help-block pull-right" style="margin-top:0;"><span class="voucher"></span></span></label>
                                {{ Form::number('transaction_no', null, ['id' => 'one', 'class' => 'form-control', 'placeholder' => ' লেনদেন নম্বর লিখুন ']) }}
                            </div>



                            {{ Form::hidden('bc_id', $birth->id, ['required']) }}
                            {{ Form::hidden('user_id', $user->id, ['required']) }}
                            {{ Form::hidden('digi_center_user_id', $disital_id, ['required']) }}
                            {{ Form::hidden('service_id',$service->id, ['required']) }}
                            {{ Form::hidden('which_time', $which_time, ['required']) }}
                            {{ Form::hidden('for_which_language', $language, ['required']) }}

                            @if($which_time == 'First')
                            {{ Form::hidden('to_uni', $uni_price,
                            ['required']) }}
                            {{ Form::hidden('to_digi', $digi_price, ['required']) }}
                            @else
                            {{ Form::hidden('to_uni', $uni_price, ['required']) }}
                            {{ Form::hidden('to_digi', $digi_price, ['required']) }}
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
@endsection

@section('cusjs')
<script>
    $(document).ready(function(){
        $("input[name=payment_method]").click(function(){
            var value = $(this).val();
            if ($('input[value=Cash]').is(':checked')) {
                // $("#cash").show();
                // $("#one").prop('required', true);
                // $("#other").hide();
                // $("#two").prop('required', false);
                $.ajax({
                    url: "{{ route('getCashId') }}",
                    type: 'get',
                    success: function(res){
                        $(".voucher").html('পূর্বে এন্ট্রিকৃত ভাউচার নম্বর : '+ res);
                        $(".help-block").show();
                    }
                });
            } else {
                // $(".help-block").hide();
                $(".voucher").html('');
                // $("#other").show();
                // $("#two").prop('required', true);
                // $("#cash").hide();
                // $("#one").prop('required', false);
            }
        });
        master_function()


        $(document).on("change", '#sub_trad_licence', function (e) {
            master_function()

        });

        function master_function() {
            var price = $('#sub_trad_licence option:selected').attr('data-price');
            var total = parseFloat(price);
            $('#pay_able_amount').val(total);
            var pay_tag = '<label for="payment_method" class="payment_method cmmone-class" id="pay_able_label"> এই সেবার ডাউনলোডের জন্য মোট '+ total+' টাকা পরিশোধ করতে হবে <label>';
            $('#pay_aboe_tag').html(pay_tag);

        }
    });




</script>
@endsection