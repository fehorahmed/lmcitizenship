@extends('frontend.layouts.app')
@section('content')
    <div class="container user_panel">


        @if (Route::has('login'))
            <?php
            new DateTime('now', new DateTimezone('Asia/Dhaka'));

            $rate = !empty($rules->rate) ? $rules->rate : null;
            $dc_rate = !empty($rules->dc_rate) ? $rules->dc_rate : null;
            $total = $rate + $dc_rate;
            ?>
            <div class="row up_bottom" style="margin-top: 20px;">
                <div class="col-md-12">

                    <form action="{{ route('user.warish.payment') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ !empty($asset) ? $asset->id : null }}">
                        <input type="hidden" name="warish_id" value="{{ !empty($fdata) ? $fdata->id : null }}">

                        @include('frontend.common.message_handler')
                        @include('Warish::frontend.part.details', ['fdata' => $fdata])


                        <div class="row">
                            <div class="col-md-5">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Payment Amount</div>
                                    <div class="panel-body">


                                        <div id="my-app">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="payment_info[payment_method]"
                                                                id="pm_bankdraft" onchange="paymentMethod(this,1)"
                                                                value="Bank draft" v-model="payment"
                                                                v-on:change="paymentMethod" data-id="1" checked>
                                                            পে অর্ডার / ব্যাংক ড্রাফট
                                                        </label>
                                                    </div>

                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="payment_info[payment_method]"
                                                                id="pm_bkash" value="Bkash"
                                                                onchange="paymentMethod(this,2)" v-model="payment"
                                                                v-on:change="paymentMethod" data-id="1">
                                                            বিকাশ
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="payment_info[payment_method]"
                                                                id="pm_nagot" value="Nagat"
                                                                onchange="paymentMethod(this,3)" v-model="payment"
                                                                v-on:change="paymentMethod" data-id="1">
                                                            নগদ
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="payment_info[payment_method]"
                                                                id="pm_cash" value="Cash"
                                                                onchange="paymentMethod(this,4)" v-model="payment"
                                                                v-on:change="paymentMethod" data-id="1" checked>
                                                            ক্যাশ
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="card" style="padding:10px;border: 3px solid #eeeeee;">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <div class="input-group" style="margin-bottom: 5px">
                                                                <div class="input-group-addon" style="min-width: 110px">
                                                                    <div class="input-group-text" id="rent_amount_co">
                                                                        ফি
                                                                    </div>
                                                                </div>
                                                                <input type="number" class="form-control"
                                                                    name="payment_info[rate]" id="payment_info[rate]"
                                                                    placeholder="টাকার পরিমাণ.." value="{{ $rate }}"
                                                                    readonly>
                                                                <div class="input-group-addon">
                                                                    <div class="input-group-text">টাকা</div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="input-group" style="margin-bottom: 5px">
                                                                <div class="input-group-addon" style="min-width: 110px">
                                                                    <div class="input-group-text" id="rent_amount_co">
                                                                        তথ্য কেন্দ্র ফি
                                                                    </div>
                                                                </div>
                                                                <input type="number" class="form-control"
                                                                    name="payment_info[dc_rate]" id="payment_info[dc_rate]"
                                                                    placeholder="টাকার পরিমাণ.." value="{{ $dc_rate }}"
                                                                    readonly>
                                                                <div class="input-group-addon">
                                                                    <div class="input-group-text">টাকা</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group" style="margin-bottom: 5px">
                                                                <div class="input-group-addon" style="min-width: 110px">
                                                                    <div class="input-group-text" id="rent_amount_co">
                                                                        মোট ফি
                                                                    </div>
                                                                </div>
                                                                <input type="number" class="form-control"
                                                                    name="payment_info[total]" id="payment_info[total]"
                                                                    placeholder="টাকার পরিমাণ.."
                                                                    value="{{ $total }}" readonly>
                                                                <div class="input-group-addon">
                                                                    <div class="input-group-text">টাকা</div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div><br>


                                                <div style="display: none; padding:10px;border: 3px solid #c7b4b4;"
                                                    id="pay_bank">
                                                    <div class="form-group">


                                                        <div class="input-group" style="margin-bottom: 5px">
                                                            <div class="input-group-addon" style="min-width: 165px">
                                                                <div class="input-group-text" id="rent_amount_co">পে
                                                                    অর্ডার
                                                                    / ব্যাংক ড্রাফট নং
                                                                </div>
                                                            </div>
                                                            <input type="number" class="form-control"
                                                                name="payment_info[payorder]" id="payment_info[payorder]"
                                                                placeholder="পে অর্ডার / ব্যাংক ড্রাফট নং..">

                                                        </div>
                                                        <div class="input-group" style="margin-bottom: 5px">
                                                            <div class="input-group-addon" style="min-width: 165px">
                                                                <div class="input-group-text" id="rent_amount_co">তারিখ
                                                                </div>
                                                            </div>

                                                            <input type="date" class="form-control date-pick"
                                                                name="payment_info[date]" id="payment_info[date]"
                                                                placeholder="তারিখ..">
                                                        </div>
                                                        <div class="input-group" style="margin-bottom: 5px">
                                                            <div class="input-group-addon" style="min-width: 165px">
                                                                <div class="input-group-text" id="rent_amount_co">ব্যাংকের
                                                                    নাম
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                name="payment_info[bank]" id="payment_info[bank]"
                                                                placeholder="ব্যাংকের নাম..">
                                                        </div>
                                                        <div class="input-group" style="margin-bottom: 5px">
                                                            <div class="input-group-addon" style="min-width: 165px">
                                                                <div class="input-group-text" id="rent_amount_co">শাখা
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                name="payment_info[branch]" id="payment_info[branch]"
                                                                placeholder="শাখা..">
                                                        </div>

                                                    </div>
                                                </div>

                                                <div style="display: none; padding:10px;border: 3px solid #30262645;"
                                                    id="rocket_bikash">
                                                    <div class="form-group">


                                                        <div class="input-group" style="margin-bottom: 5px">
                                                            <div class="input-group-addon" style="min-width: 165px">
                                                                <div class="input-group-text" id="rent_amount_co">লেনদেন
                                                                    নম্বর লিখুন
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                name="payment_info[number]" id="payment_info[number]"
                                                                placeholder="লেনদেন নম্বর লিখুন..">

                                                        </div>
                                                        <div class="input-group" style="margin-bottom: 5px">
                                                            <div class="input-group-addon" style="min-width: 165px">
                                                                <div class="input-group-text" id="rent_amount_co">তারিখ
                                                                </div>
                                                            </div>

                                                            <input placeholder="তারিখ.." name="payment_info[date]"
                                                                type="text" class="form-control date-pick"
                                                                v-model="date">


                                                        </div>
                                                        <div class="input-group" style="margin-bottom: 5px">
                                                            <div class="input-group-addon" style="min-width: 165px">
                                                                <div class="input-group-text" id="rent_amount_co">
                                                                    ট্রানস্যাকশন আইডি
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                name="payment_info[tid]" id="payment_info[tid]"
                                                                placeholder="ট্রানস্যাকশন আইডি..">

                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="display: show; padding:10px;border: 3px solid #9b8b8b94;"
                                                    id="cash">
                                                    <div class="form-group">


                                                        <div class="input-group" style="margin-bottom: 5px">
                                                            <div class="input-group-addon" style="min-width: 165px">
                                                                <div class="input-group-text" id="receipt_no">রশিদ নম্বর
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                name="payment_info[receipt_no]"
                                                                id="payment_info[receipt_no]" placeholder="রশিদ নম্বর..">

                                                        </div>
                                                        <div class="input-group" style="margin-bottom: 5px">
                                                            <div class="input-group-addon" style="min-width: 165px">
                                                                <div class="input-group-text" id="rent_amount_co">তারিখ
                                                                </div>
                                                            </div>

                                                            <input placeholder="তারিখ.." name="payment_info[date]"
                                                                type="text" class="form-control date-pick"
                                                                v-model="date">


                                                        </div>
                                                        <div class="input-group" style="margin-bottom: 5px">
                                                            <div class="input-group-addon" style="min-width: 165px">
                                                                <div class="input-group-text" id="serial_no">
                                                                    সিরিয়াল নং
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                name="payment_info[serial_no]"
                                                                id="payment_info[serial_no]" placeholder="সিরিয়াল নং ..">

                                                        </div>
                                                    </div>
                                                </div><br>

                                                <div class="form-group">
                                                    <label for="remarks" class="nid_no control-label">মন্তব্য </label>
                                                    <input type="text" class="form-control" name="payment_info[notes]"
                                                        id="payment_info[notes]" placeholder="মন্তব্য ..">

                                                </div>


                                            </div>


                                        </div>
                                    </div>

                                    <div id="hidendData">

                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-7">


                                <div class="panel panel-default">
                                    <div class="panel-heading"> Attachments</div>
                                    <div class="panel-body">


                                        @if ($rules->is_nid_info || $rules->is_nid_file)
                                            <div class="form-group input-box input-box-green">
                                                <label for="nid_info" class="cmmone-class"> NID
                                                    <small>{{ $rules->is_nid_file ? '(jpg/jpeg/png)' : '' }}</small></label>
                                                <div class="input-inner">
                                                    @if ($rules->is_nid_info)
                                                        {{ Form::text('nid_info', !empty($user) ? @$user->nidno : null, ['class' => 'form-control', 'placeholder' => ' National ID ', 'require']) }}
                                                    @endif
                                                    @if ($rules->is_nid_file)
                                                        <input type="file" id="nid_file" name="nid_file" require>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif


                                        @if ($rules->is_citizenship_file || $rules->is_citizenship_info)
                                            <div class="form-group input-box input-box-blue">
                                                <label for="citizenship_info" class="cmmone-class"> Citizenship
                                                    Certificate
                                                    <small>{{ $rules->is_citizenship_file ? '(jpg/jpeg/png)' : '' }}</small></label>
                                                <div class="input-inner">
                                                    @if ($rules->is_citizenship_info)
                                                        {{ Form::text('citizenship_info', null, ['class' => 'form-control', 'placeholder' => ' Citizenship Certificate ID ', 'require']) }}
                                                    @endif
                                                    @if ($rules->is_citizenship_file)
                                                        <input type="file" id="citizenship_file"
                                                            name="citizenship_file" require>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        @if ($rules->is_photo_file)
                                            <div class="form-group input-box input-box-perpel">

                                                <label for="photo_file" class="cmmone-class"> Photo
                                                    <small>(jpg/jpeg/png)</small></label>
                                                <div class="input-inner">
                                                    <input type="file" id="photo_file" name="photo_file" require>

                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="panel panel-default">

                            <div class="panel-footer">
                                <div class="form-group text-center">
                                    <input type="submit" class="btn btn-success btn-lg" name="submit"
                                        value="প্রদান করুন">
                                </div>
                            </div>
                        </div>

                    </form>




                </div>
            </div>
        @endif
    </div>
@endsection

@section('cusjs')
    <script type="text/javascript">
        console.clear();
        jQuery(document).ready(function($) {

            $(".date-pick").datepicker({
                format: 'dd-mm-yyyy'
            }).val();


        });

        function paymentMethod(value, id) {
            if (id === 1) {
                var pm_bankdraft = document.getElementById('pm_bankdraft').value;
                document.getElementById('pay_bank').style.display = "block";
                document.getElementById('rocket_bikash').style.display = "none";
                document.getElementById('cash').style.display = "none";
            } else if (id === 2) {
                var pm_bkash = document.getElementById('pm_bkash').value;
                document.getElementById('rocket_bikash').style.display = "block";
                document.getElementById('pay_bank').style.display = "none";
                document.getElementById('cash').style.display = "none";

            } else if (id === 3) {
                var pm_nagot = document.getElementById('pm_nagot').value;
                document.getElementById('rocket_bikash').style.display = "block";
                document.getElementById('pay_bank').style.display = "none";
                document.getElementById('cash').style.display = "none";
            } else if (id === 4) {
                var pm_cash = document.getElementById('pm_cash').value;
                document.getElementById('cash').style.display = "block";
                document.getElementById('pay_bank').style.display = "none";
                document.getElementById('rocket_bikash').style.display = "none";
            } else {
                console.log("not");
            }
        }
    </script>
@endsection
