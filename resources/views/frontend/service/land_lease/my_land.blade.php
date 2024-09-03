@extends('frontend.layouts.app')
@section('content')

    @php
        $is_date = false;
    if(Request::get('start_date') && Request::get('end_date')){
       $start = date( 'Y-m-d', strtotime(Request::get('start_date')));
       $end = date( 'Y-m-d', strtotime(Request::get('end_date')));
       $is_date = true;
    }
    $my_lands = App\Land::where(['user_id' => $user['user_id']])->get();
    $my_lands_count = $my_lands->count();
    $l_seting = App\LeaseSetting::get()->first();
  //dump($my_lands);


    @endphp






    @if($my_lands_count > 0)


        <div class="container wid-cont">
            <div class="land-widget">
                @foreach($my_lands as $list)

                    <div class="col-md-6 wid-area">
                        <div class="row wid-title-sec">
                            <div class="col-xs-7">
                                <h2 class="wid-titel">LAND-{{$list->id}}</h2>
                                <p class="wid-sub-title">({{ e_to_b(date('d-F-y', strtotime($list->lease_start))) }}  থেকে {{ e_to_b(date('d-F-y', strtotime($list->lease_end))) }})</p>
                            </div>
                            <div class="col-xs-5">
                                @if(!get_tranfer_status($list->lease_id))
                                <button type="button" class="btn btn-danger pull-right" data-toggle="modal"
                                        data-target="#land_transfer_model_{{$list->id}}">
                                     হস্তান্তর
                                </button>
                                @else
                                    {!! get_tranfer_status($list->lease_id) !!}
                                @endif
                                @if(date('Y-m-d') > $list->lease_end)

                                    <!-- Button trigger modal -->
                                    <a href="{{ url('land_renew_aplication/'.$list->id) }}" class="btn btn-danger pull-right">
                                        নাবায়ন
                                    </a>

                                    <div class="modal fade" id="land_renew_model_{{$list->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                {{Form::open(array('url' => 'land_renew_aply', 'method' => 'post','autocomplete' => 'off'))}}

                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">
                                                     ইজারাকৃত জমি  ইজারা নাবায়নের  আবেদন।
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="payment_info[payment_method]"
                                                                       id="pm_bankdraft"
                                                                       value="Bank draft" onchange="payment_option(this);"
                                                                       data-id="{{$list->id}}" checked>
                                                                পে অর্ডার / ব্যাংক ড্রাফট
                                                            </label>
                                                        </div>

                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="payment_info[payment_method]"
                                                                       id="pm_bkash"
                                                                       value="Bkash" onchange="payment_option(this);"
                                                                       data-id="{{$list->id}}">
                                                                বিকাশ
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="payment_info[payment_method]"
                                                                       id="pm_nagot"
                                                                       value="Nagat" onchange="payment_option(this);"
                                                                       data-id="{{$list->id}}">
                                                                নগদ
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group" style="margin-bottom: 5px">
                                                            <div class="input-group-addon" style="min-width: 165px">
                                                                <div class="input-group-text" id="rent_amount_co">টাকার
                                                                    পরিমাণ
                                                                </div>
                                                            </div>
                                                            {{ Form::number('payment_info[amount]',isset($l_seting->renew_fee)?$l_seting->renew_fee: null, ['required', 'class' => 'form-control', 'placeholder' => 'টাকার পরিমাণ..','readonly']) }}

                                                            <div class="input-group-addon">
                                                                <div class="input-group-text">টাকা</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="bank-draft-{{$list->id}}">
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

                                                    <div id="bkash-nogot-{{$list->id}}" class="hidden">
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

                                                        {{ Form::hidden('land_id',$list->id, ['required']) }}
                                                        {{ Form::hidden('user_id',$user['user_id'], ['required']) }}


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

                                    <!-- Modal -->
                                    @endif
                                <div class="modal fade" id="land_transfer_model_{{$list->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">
                                                    ইজারাকৃত জমি   হস্তান্তর  এর  আবেদন।
                                                </h4>
                                            </div>

                                            <div class="modal-body">

                                                <form class="form-inline">
                                                    <div class="form-group">
                                                        <div class="form-group">

                                                            {{ Form::select('land_class',  [
                                                            'phone' => '  মোবাইল',
                                                              'email' => '  ইমেইল'
                                                            ], Null, ['class' => 'form-control', 'id' => 'searche_type']) }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">

                                                        <input type="text" class="form-control" name="searche_user" id="searche_user" placeholder="Searche...">
                                                        <input type="hidden" name="searche_user" id="t_user" value="{{$list->user_id}}">
                                                        <input type="hidden" name="t_land" id="t_land" value="{{$list->id}}">
                                                    </div>

                                                    <button type="submit" class="btn btn-default">Sign in</button>
                                                    <div id="searche_view">

                                                    </div>

                                                    <br>
                                                    <br>
                                                    <br>


                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="wid-data">
                            <div class="row">
                                <div class="col-xs-6">
                                    <ul class="wid-data-list">
                                        <li><i class="fa fa-square" aria-hidden="true"></i> জমির পরিমানঃ <span
                                                    class="pull-right">{{ e_to_b($list->area_of_land) }} শতাংশ </span></li>
                                        <li><i class="fa fa-square" aria-hidden="true"></i> উপজেলাঃ <span
                                                    class="pull-right">{{ e_to_b($list->upazila) }}</span></li>
                                        <li><i class="fa fa-square" aria-hidden="true"></i> মৌজাঃ <span
                                                    class="pull-right">{{ e_to_b($list->mouza) }} </span></li>
                                </div>
                                <div class="col-xs-6">
                                    <ul class="wid-data-list">
                                        <li><i class="fa fa-square" aria-hidden="true"></i> জে. এল. নং <span
                                                    class="pull-right">{{ e_to_b($list->jl_no) }} </span></li>
                                        <li><i class="fa fa-square" aria-hidden="true"></i> খতিয়ানঃ <span
                                                    class="pull-right">{{ e_to_b($list->khotian) }} </span></li>
                                        <li><i class="fa fa-square" aria-hidden="true"></i> দাগঃ <span
                                                    class="pull-right">{{ e_to_b($list->dhag) }}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

            </div>
        </div>

    @endif
    <div class="container user_panel">


        @if (Route::has('login'))

            <br>

            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs p_nav_tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#my_land" aria-controls="my_land" role="tab" data-toggle="tab">আমার জমি</a>
                    </li>

                    <li role="presentation">
                        <a href="#all_application" aria-controls="all_application" role="tab" data-toggle="tab">সব
                            আবেদন</a>
                    </li>
                    {{--                        <li role="presentation"><a href="#shop_transaction" aria-controls="shop_transaction" role="tab" data-toggle="tab">লেনদেন</a></li>--}}
                    <li role="presentation">
                        <a href="#tender_land" aria-controls="tender_land" role="tab" data-toggle="tab">জমির দরপত্র</a>
                    </li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="my_land">
                        @include('frontend.service.land_lease.get_land')
                    </div>

                    <div role="tabpanel" class="tab-pane" id="all_application">
                        @include('frontend.service.land_lease.all_application')
                    </div>

                    <div role="tabpanel" class="tab-pane" id="tender_land">
                        @include('frontend.service.land_lease.tender_land')
                    </div>

                </div>

            </div>


        @endif
    </div>
@endsection

@section('cusjs')
    <script>
        $(document).ready(function () {

            // show active tab on reload
            if (location.hash !== '') $('a[href="' + location.hash + '"]').tab('show');

            // remember the hash in the URL without jumping
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                if (history.pushState) {
                    var main = "{{url('my_shop')}}";
                    var has = '#' + $(e.target).attr('href').substr(1);

                    $('#market_f_searche').attr('action', main + has);
                    history.pushState(null, null, '#' + $(e.target).attr('href').substr(1));
                } else {
                    location.hash = '#' + $(e.target).attr('href').substr(1);
                }
            });


            master_function();
            $(function () {
                $(".date-pick").datepicker({format: 'dd-mm-yyyy'}).val();
            });

            $(document).on('keyup', '#searche_user', function (e) {
                let src = $(this).val();
                find_land_transfer_user(src);
            });
            $(document).on('click', '#submit_transfer_user', function (e) {
                let user = $(this).data('user');
                let land = $(this).data('land');
                let url =  baseurl + '/land_transfer_user?user='+user+'&land='+land;
                window.location.replace(url);

            });

            function find_land_transfer_user(src) {
                let type = $('#searche_type').val();
                let user_id = $('#t_user').val();
                let land_id = $('#t_land').val();
                $.ajax({
                    url: baseurl + '/find_land_transfer_user',
                    method: 'get',
                    data: {search: src,type: type,user_id: user_id,land_id: land_id,},
                    success: function (data) {


                        $('#searche_view').html(data);

                    },
                    error: function () {
                    }
                });
            }


            function master_function() {


            }




            window.payment_option = function (self) {

                var id = $(self).data('id')
                var valu = $(self).val();
                var charge = $(self).data('charge');
                var total = $(self).data('total');
                var g_total = charge + total;
                $('#payment-charge' + id).val(charge);
                $('#payment-total' + id).val(g_total);
                // alert(charge + '--' + total)
                if (valu == 'Bkash' || valu == 'Nagat') {

                    $('#bkash-nogot-' + id).removeClass("hidden");
                    $('#bank-draft-' + id).addClass("hidden");

                } else {
                    $('#bkash-nogot-' + id).addClass("hidden");
                    $('#bank-draft-' + id).removeClass("hidden");
                }

                //alert('bkash-nogot-'+id);

            }

        });


    </script>
@endsection