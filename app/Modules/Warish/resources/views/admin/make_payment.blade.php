@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'নাগরিকত্ব - Make Payment' }}
@endsection

@push('styles')
    <link href="{{ asset('/') }}assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    {{-- @include('admin.master.flash') --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ward</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Create</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Make Payment</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card">
                    <div class="card-header bg-info ">
                        <h4 class=" text-white content-center">Make Payment</h4>
                    </div>
                    <div class="card-body">
                        <form id="campaign-form" class="form-horizontal" method="post" action=""
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="user" class="col-12 col-md-3 col-form-label">Select User</label>
                                <div class="col-12 col-md-9">
                                    <select name="user" id="user" class="form-control select2"
                                        data-toggle="select2">
                                        <option value="">Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('user') == $user->id ? 'selected' : '' }}>{{ $user->name }} -
                                                {{ $user->phone }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="payment_info[payment_method]" id="pm_bankdraft"
                                            onchange="paymentMethod(this,1)" value="Bank draft" v-model="payment"
                                            v-on:change="paymentMethod" data-id="1" checked>
                                        পে অর্ডার / ব্যাংক ড্রাফট
                                    </label>
                                </div>

                                <div class="radio">
                                    <label>
                                        <input type="radio" name="payment_info[payment_method]" id="pm_bkash"
                                            value="Bkash" onchange="paymentMethod(this,2)" v-model="payment"
                                            v-on:change="paymentMethod" data-id="1">
                                        বিকাশ
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="payment_info[payment_method]" id="pm_nagot"
                                            value="Nagat" onchange="paymentMethod(this,3)" v-model="payment"
                                            v-on:change="paymentMethod" data-id="1">
                                        নগদ
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="payment_info[payment_method]" id="pm_cash"
                                            value="Cash" onchange="paymentMethod(this,4)" v-model="payment"
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
                                            <input type="number" class="form-control" name="payment_info[rate]"
                                                id="payment_info[rate]" placeholder="টাকার পরিমাণ.."
                                                value="{{ $citizen_setting->rate ?? 0 }}" readonly>
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
                                            <input type="number" class="form-control" name="payment_info[dc_rate]"
                                                id="payment_info[dc_rate]" placeholder="টাকার পরিমাণ.."
                                                value="{{ $citizen_setting->dc_rate ?? 0 }}" readonly>
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
                                            <input type="number" class="form-control" name="payment_info[total]"
                                                id="payment_info[total]" placeholder="টাকার পরিমাণ.."
                                                value="{{ ($citizen_setting->rate ?? 0) + ($citizen_setting->dc_rate ?? 0) }}"
                                                readonly>
                                            <div class="input-group-addon">
                                                <div class="input-group-text">টাকা</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div style="display: none;" id="pay_bank">
                                <div class="form-group">


                                    <div class="input-group" style="margin-bottom: 5px">
                                        <div class="input-group-addon" style="min-width: 165px">
                                            <div class="input-group-text" id="rent_amount_co">পে
                                                অর্ডার
                                                / ব্যাংক ড্রাফট নং
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" name="payment_info[payorder]"
                                            value="{{ old('payment_info.payorder') }}" id="payment_info[payorder]"
                                            placeholder="পে অর্ডার / ব্যাংক ড্রাফট নং..">

                                    </div>

                                    <div class="input-group" style="margin-bottom: 5px">
                                        <div class="input-group-addon" style="min-width: 165px">
                                            <div class="input-group-text" id="rent_amount_co">ব্যাংকের
                                                নাম
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="payment_info[bank]"
                                            value="{{ old('payment_info.bank') }}" id="payment_info[bank]"
                                            placeholder="ব্যাংকের নাম..">
                                    </div>
                                    <div class="input-group" style="margin-bottom: 5px">
                                        <div class="input-group-addon" style="min-width: 165px">
                                            <div class="input-group-text" id="rent_amount_co">শাখা
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="payment_info[branch]"
                                            value="{{ old('payment_info.branch') }}" id="payment_info[branch]"
                                            placeholder="শাখা..">
                                    </div>

                                </div>
                            </div>

                            <div style="display: none;" id="rocket_bikash">
                                <div class="form-group">


                                    <div class="input-group" style="margin-bottom: 5px">
                                        <div class="input-group-addon" style="min-width: 165px">
                                            <div class="input-group-text" id="rent_amount_co">লেনদেন
                                                নম্বর লিখুন
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="payment_info[number]"
                                            value="{{ old('payment_info.number') }}" id="payment_info[number]"
                                            placeholder="লেনদেন নম্বর লিখুন..">

                                    </div>

                                    <div class="input-group" style="margin-bottom: 5px">
                                        <div class="input-group-addon" style="min-width: 165px">
                                            <div class="input-group-text" id="rent_amount_co">
                                                ট্রানস্যাকশন আইডি
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="payment_info[tid]"
                                            value="{{ old('payment_info.tid') }}" id="payment_info[tid]"
                                            placeholder="ট্রানস্যাকশন আইডি..">

                                    </div>
                                </div>
                            </div>

                            <div style="display: show;" id="cash">
                                <div class="form-group">


                                    <div class="input-group" style="margin-bottom: 5px">
                                        <div class="input-group-addon" style="min-width: 165px">
                                            <div class="input-group-text" id="receipt_no">রশিদ নম্বর
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="payment_info[receipt_no]"
                                            value="{{ old('payment_info.receipt_no') }}" id="payment_info[receipt_no]"
                                            placeholder="রশিদ নম্বর..">

                                    </div>

                                    <div class="input-group" style="margin-bottom: 5px">
                                        <div class="input-group-addon" style="min-width: 165px">
                                            <div class="input-group-text" id="serial_no">
                                                সিরিয়াল নং
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="payment_info[serial_no]"
                                            value="{{ old('payment_info.serial_no') }}" id="payment_info[serial_no]"
                                            placeholder="সিরিয়াল নং ..">

                                    </div>
                                </div>
                            </div>
                            <div class="input-group" style="margin-bottom: 5px">
                                <div class="input-group-addon" style="min-width: 165px">
                                    <div class="input-group-text" id="rent_amount_co">তারিখ
                                    </div>
                                </div>

                                <input placeholder="তারিখ.." name="payment_info[date]" type="text"
                                    value="{{ old('payment_info.date') }}" class="form-control date-pick"
                                    v-model="date">

                            </div>
                            <br>

                            <div class="form-group">
                                <label for="remarks" class="nid_no control-label">মন্তব্য </label>
                                <input type="text" class="form-control" name="payment_info[notes]"
                                    value="{{ old('payment_info.notes') }}" id="payment_info[notes]"
                                    placeholder="মন্তব্য ..">

                            </div>

                            <div class="text-center mb-2 mt-2">

                                <input type="submit" class="btn btn-primary  " value="Submit Payment">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#user').on('change', function() {
                var user_id = $(this).val();
                // alert(user_id);

                $.ajax({
                    method: "GET",
                    url: '{{ route('check.user.warish') }}',
                    data: {
                        user_id: user_id
                    }
                }).done(function(data) {
                    if (data.status) {
                        alert(data.message)
                    }
                });

            });

        });
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
@endpush
