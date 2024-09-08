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
                    <form action="{{ route('citizenship.payment') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ !empty($asset) ? $asset->id : null }}">


                        @include('frontend.common.message_handler')

                        @include('Citizenship::frontend.part.details', [
                            'fdata' => $fdata,
                            'user' => $user,
                        ])

                        <div class="row">

                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Payment Details</div>
                                    <div class="panel-body">


                                        <div id="my-app">
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio"
                                                                        name="payment_info[payment_method]"
                                                                        id="pm_bankdraft" onchange="paymentMethod(this,1)"
                                                                        value="Bank draft" data-id="1">
                                                                    পে অর্ডার / ব্যাংক ড্রাফট
                                                                </label>
                                                            </div>

                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio"
                                                                        name="payment_info[payment_method]" id="pm_bkash"
                                                                        value="Bkash" onchange="paymentMethod(this,2)"
                                                                        data-id="1">
                                                                    বিকাশ
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio"
                                                                        name="payment_info[payment_method]" id="pm_nagot"
                                                                        value="Nagat" onchange="paymentMethod(this,3)"
                                                                        data-id="1">
                                                                    নগদ
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio"
                                                                        name="payment_info[payment_method]" id="pm_cash"
                                                                        value="Cash" onchange="paymentMethod(this,4)"
                                                                        data-id="1" checked>
                                                                    ক্যাশ
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="card" style="padding:10px;border: 3px solid #eeeeee;">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <div class="input-group" style="margin-bottom: 5px">
                                                                        <div class="input-group-addon"
                                                                            style="min-width: 110px">
                                                                            <div class="input-group-text"
                                                                                id="rent_amount_co">
                                                                                ফি
                                                                            </div>
                                                                        </div>
                                                                        <input type="number" name="payment_info[rate]"
                                                                            id="payment_info_rate" class="form-control"
                                                                            placeholder="টাকার পরিমাণ.." readonly
                                                                            value="{{ $rate }}">
                                                                        <div class="input-group-addon">
                                                                            <div class="input-group-text">টাকা</div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="input-group" style="margin-bottom: 5px">
                                                                        <div class="input-group-addon"
                                                                            style="min-width: 110px">
                                                                            <div class="input-group-text"
                                                                                id="rent_amount_co">
                                                                                তথ্য কেন্দ্র ফি
                                                                            </div>
                                                                        </div>
                                                                        <input type="number" name="payment_info[dc_rate]"
                                                                            id="payment_info_dc_rate" class="form-control"
                                                                            placeholder="টাকার পরিমাণ.." readonly
                                                                            value="{{ $dc_rate ?? 0 }}">
                                                                        <div class="input-group-addon">
                                                                            <div class="input-group-text">টাকা</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="input-group" style="margin-bottom: 5px">
                                                                        <div class="input-group-addon"
                                                                            style="min-width: 110px">
                                                                            <div class="input-group-text"
                                                                                id="rent_amount_co">
                                                                                মোট ফি
                                                                            </div>
                                                                        </div>

                                                                        <input type="number" name="payment_info[total]"
                                                                            id="payment_info_total" class="form-control"
                                                                            placeholder="টাকার পরিমাণ.." readonly
                                                                            value="{{ $total }}">

                                                                        <div class="input-group-addon">
                                                                            <div class="input-group-text">টাকা</div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="padding:10px;border: 3px solid #c7b4b4;">
                                                        <div style="display: none;"
                                                            id="pay_bank">
                                                            <div class="form-group">


                                                                <div class="input-group" style="margin-bottom: 5px">
                                                                    <div class="input-group-addon"
                                                                        style="min-width: 165px">
                                                                        <div class="input-group-text" id="rent_amount_co">
                                                                            পে
                                                                            অর্ডার
                                                                            / ব্যাংক ড্রাফট নং
                                                                        </div>
                                                                    </div>
                                                                    <input type="number" name="payment_info[payorder]"
                                                                        id="payment_info_payorder" class="form-control"
                                                                        placeholder="পে অর্ডার / ব্যাংক ড্রাফট নং..">

                                                                </div>

                                                                <div class="input-group" style="margin-bottom: 5px">
                                                                    <div class="input-group-addon"
                                                                        style="min-width: 165px">
                                                                        <div class="input-group-text" id="rent_amount_co">
                                                                            ব্যাংকের
                                                                            নাম
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" name="payment_info[bank]"
                                                                        id="payment_info_bank" class="form-control"
                                                                        placeholder="ব্যাংকের নাম..">
                                                                </div>
                                                                <div class="input-group" style="margin-bottom: 5px">
                                                                    <div class="input-group-addon"
                                                                        style="min-width: 165px">
                                                                        <div class="input-group-text" id="rent_amount_co">
                                                                            শাখা
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" name="payment_info[branch]"
                                                                        id="payment_info_branch" class="form-control"
                                                                        placeholder="শাখা..">
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div style="display: none; "
                                                            id="rocket_bikash">
                                                            <div class="form-group">
                                                                <div class="input-group" style="margin-bottom: 5px">
                                                                    <div class="input-group-addon"
                                                                        style="min-width: 165px">
                                                                        <div class="input-group-text" id="rent_amount_co">
                                                                            লেনদেন
                                                                            নম্বর লিখুন
                                                                        </div>
                                                                    </div>
                                                                    <input type="number" name="payment_info[number]"
                                                                        id="payment_info_number" class="form-control"
                                                                        placeholder="লেনদেন নম্বর লিখুন...">

                                                                </div>

                                                                <div class="input-group" style="margin-bottom: 5px">
                                                                    <div class="input-group-addon"
                                                                        style="min-width: 165px">
                                                                        <div class="input-group-text" id="rent_amount_co">
                                                                            ট্রানস্যাকশন আইডি
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" name="payment_info[tid]"
                                                                        id="payment_info_tid" class="form-control"
                                                                        placeholder="ট্রানস্যাকশন আইডি..">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div style="display: show; "
                                                            id="cash">
                                                            <div class="form-group">


                                                                <div class="input-group" style="margin-bottom: 5px">
                                                                    <div class="input-group-addon"
                                                                        style="min-width: 165px">
                                                                        <div class="input-group-text" id="receipt_no">রশিদ
                                                                            নম্বর
                                                                        </div>
                                                                    </div>
                                                                    <input type="text" name="payment_info[receipt_no]"
                                                                        id="payment_info_receipt_no" class="form-control"
                                                                        placeholder="রশিদ নম্বর ...">

                                                                </div>

                                                                <div class="input-group" style="margin-bottom: 5px">
                                                                    <div class="input-group-addon"
                                                                        style="min-width: 165px">
                                                                        <div class="input-group-text" id="serial_no">
                                                                            সিরিয়াল নং
                                                                        </div>
                                                                    </div>

                                                                    <input type="text" name="payment_info[serial_no]"
                                                                        id="payment_info_serial_no" class="form-control"
                                                                        placeholder="সিরিয়াল নং ..">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="input-group" style="margin-bottom: 5px">
                                                            <div class="input-group-addon"
                                                                style="min-width: 165px">
                                                                <div class="input-group-text" id="rent_amount_co">
                                                                    তারিখ
                                                                </div>
                                                            </div>

                                                            <input placeholder="তারিখ.." name="payment_info[date]"
                                                                type="text" class="form-control g-date-pick"
                                                                v-model="date">


                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="remarks"
                                                                class="remarks cmmone-class">মন্তব্য</label>
                                                            <input type="text" class="form-control"
                                                                name="payment_info[notes]" id="payment_info_notes"
                                                                placeholder="মন্তব্য...">

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div id="hidendData">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading"> Attachments</div>
                                    <div class="panel-body">
                                        @if ($rules->is_nid_info || $rules->is_nid_file)
                                            <div class="form-group input-box input-box-green">
                                                <label for="nid_info" class="cmmone-class"> NID / Birth Certificate
                                                    <small>{{ $rules->is_nid_file ? '(jpg/jpeg/png)' : '' }}</small></label>
                                                <div class="input-inner">
                                                    @if ($rules->is_nid_info)
                                                        <input type="text" name="nid_info" id="nid_info"
                                                            class="form-control" placeholder="National ID / Birth Certificate" required>
                                                    @endif
                                                    @if ($rules->is_nid_file)
                                                        <input type="file" id="nid_file" class="form-control" name="nid_file" require>
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
                                                        <input type="text" name="citizenship_info"
                                                            id="citizenship_info" class="form-control"
                                                            placeholder="Citizenship Certificate ID" required>
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
                                    <button class="btn btn-info" type="submit">প্রদান করুন</button>
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
