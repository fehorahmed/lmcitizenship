@extends('frontend.layouts.app')
@section('content')


    @php
        $is_date = false;
    if(Request::get('start_date') && Request::get('end_date')){
       $start = date( 'Y-m-d', strtotime(Request::get('start_date')));
       $end = date( 'Y-m-d', strtotime(Request::get('end_date')));
       $is_date = true;
    }


    $my_shops = App\MarketShop::Where(['shop_ownner' => $user['user_id']])->get();
    $my_shops_count = $my_shops->count();

    @endphp


    @if (Route::has('login'))

        @if($my_shops_count > 0)
            <div class="container wid-cont">
                <div class="land-widget">
                    @foreach($my_shops as $key => $list)

                        @php
                            $market = App\Market::Where(['id' => $list->market_id])->get()->first();
                            $get_info = get_shop_rent_info($list->id, $user['user_id']);
                              //dump($list->as_id);
                        @endphp
                        <div class="col-md-6 wid-area">
                            <div class="row wid-title-sec">
                                <div class="col-xs-9">
                                    <h2 class="wid-titel">SHOP-{{$list->id}}</h2>
                                    <p class="wid-sub-title" style="font-size: 12px">
                                        <b>মার্কেটঃ </b> {{  $market->market_name }} <br>
                                        <i><b>ঠিকানাঃ </b> {{  $market->market_address }} </i>
                                    </p>

                                </div>
                                <div class="col-xs-3">

                                    @if(!get_shop_tranfer_status($list->as_id))
                                        <button type="button" class="btn btn-danger pull-right" data-toggle="modal"
                                                data-target="#land_transfer_model_{{$list->id}}">
                                            হস্তান্তর
                                        </button>
                                    @else
                                        {!! get_shop_tranfer_status($list->as_id) !!}
                                    @endif

                                    <div class="modal fade" id="land_transfer_model_{{$list->id}}" tabindex="-1"
                                         role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">
                                                        ইজারাকৃত জমি হস্তান্তর এর আবেদন।
                                                    </h4>
                                                </div>

                                                <div class="modal-body">

                                                    <form class="form-inline">
                                                        <div class="form-group">
                                                            <div class="form-group">

                                                                <select class="form-control searche_type"
                                                                        name="land_class">
                                                                    <option value="phone"> মোবাইল</option>
                                                                    <option value="email"> ইমেইল</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">

                                                            <input type="text" class="form-control searche_user"
                                                                   name="searche_user"
                                                                   placeholder="Searche..."
                                                                   data-user="{{$user['user_id']}}"
                                                                   data-shop="{{$list->id}}"
                                                                   data-asid="{{$list->as_id}}">


                                                        </div>

                                                        <div class="searche_view">

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
                                            <li><i class="fa fa-square" aria-hidden="true"></i> চুক্তি শুরুঃ <span
                                                        class="pull-right">
                                    {{ e_to_b(date('d-F-Y', strtotime($list->agreement_start))) }}
                                    </span></li>
                                            <li><i class="fa fa-square" aria-hidden="true"></i> চুক্তি শেষঃ <span
                                                        class="pull-right">
                                        {{ e_to_b(date('d-F-Y', strtotime($list->agreement_end))) }}
                                    </span></li>
                                            <li><i class="fa fa-square" aria-hidden="true"></i> দোকান নং <span
                                                        class="pull-right">{{ e_to_b($list->shop_number) }} </span></li>
                                        </ul>
                                    </div>
                                    <div class="col-xs-6">
                                        <ul class="wid-data-list">
                                            <li><i class="fa fa-square" aria-hidden="true"></i> দোকান ইনডেক্সঃ <span
                                                        class="pull-right">{{ ($list->shop_index)? e_to_b($list->shop_index): 'নাই' }} </span>
                                            </li>
                                            <li><i class="fa fa-square" aria-hidden="true"></i> মোট পেঃ <span
                                                        class="pull-right">{{ e_to_b($get_info['paid']). ' টাকা' }}</span>
                                            </li>
                                            <li><i class="fa fa-square" aria-hidden="true"></i> মোট বকেয়াঃ <span
                                                        class="pull-right">{{ e_to_b($get_info['due']). ' টাকা' }}</span>
                                            </li>
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


            <br>


            {{Form::open(array('url' => 'my_shop', 'method' => 'get', 'class' => 'form-inline', 'id' => 'market_f_searche', 'autocomplete' => 'on' ))}}

            <div class="form-group">
                <label for="start_date">Date</label>
                <input type="text" name="start_date" class="form-control date-pick" id="start_date"
                       placeholder="Start Date" autocomplete="off"
                       value="{{ ($is_date)? Request::get('start_date') : NULL }}">
            </div>
            <div class="form-group">
                <label for="end_date">To</label>
                <input type="text" name="end_date" class="form-control date-pick" id="end_date" placeholder="End Date"
                       autocomplete="off" value="{{ ($is_date)? Request::get('end_date') : NULL }}">
            </div>
            <button type="submit" class="btn btn-success">সাবমিট</button>
            <a href="{{ url('my_shop') }}" class="btn btn-danger">বাতিল</a>
            {{ Form::close() }}
            <br>
            <br>

            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs p_nav_tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#market_outstanding" aria-controls="market_outstanding" role="tab" data-toggle="tab">বকেয়া</a>
                    </li>
                    <li role="presentation">
                        <a href="#my_shop_info" aria-controls="my_shop_info" role="tab" data-toggle="tab">ভাড়া
                            প্রদান</a>
                    </li>
                    <li role="presentation">
                        <a href="#all_application" aria-controls="all_application" role="tab" data-toggle="tab">সব
                            আবেদন</a>
                    </li>
                    {{--                        <li role="presentation"><a href="#shop_transaction" aria-controls="shop_transaction" role="tab" data-toggle="tab">লেনদেন</a></li>--}}
                    <li role="presentation">
                        <a href="#find_new_shop" aria-controls="find_new_shop" role="tab" data-toggle="tab">নতুন দোকান
                            আবেদন</a>
                    </li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="market_outstanding">
                        @include('frontend.service.market.market_outstanding')
                    </div>
                    <div role="tabpanel" class="tab-pane" id="my_shop_info">
                        @include('frontend.service.market.my_shop_info')
                    </div>

                    <div role="tabpanel" class="tab-pane" id="all_application">
                        @include('frontend.service.market.all_application')
                    </div>

                    <div role="tabpanel" class="tab-pane" id="find_new_shop">
                        @include('frontend.service.market.find_new_shop')
                    </div>

                </div>

            </div>


        </div>





    @endif
@endsection

@section('cusjs')
    <script>
        $(document).ready(function () {

            $("#ckbCheckAll").click(function () {
                $(".checkBoxClass").prop('checked', $(this).prop('checked'));
                multi_payment();
            });

            $(document).on('change', '.checkBoxClass', function (e) {
                let click = $(this).val();
                let pss = 'Yes';

                if ($(this).is(':checked')) {

                    $('.checkBoxClass:checkbox').each(function () {
                        let test = $(this).val();


                        if (pss == 'Yes') {
                            //alert(test);
                            $(this).prop('checked', true);

                        } else {
                            $(this).prop('checked', false);
                        }
                        if (test == click) {
                            pss = 'No';
                        }


                    });
                } else {
                    //alert(pss)

                    $('.checkBoxClass:checkbox').each(function () {
                        $(".checkBoxClass").prop('checked', false);
                    });
                }
                pss = 'Yes';


                multi_payment();
            });


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

            $(document).on('keyup', '.searche_user', function (e) {
                let search = $(this).val();
                let type = $(this).closest('form').find('.searche_type').val();
                let user_id = $(this).data('user');
                let shop_id = $(this).data('shop');
                let asid = $(this).data('asid');
                let self = this;

                $.ajax({
                    url: baseurl + '/find_market_transfer_user',
                    method: 'get',
                    data: {search: search, type: type, user_id: user_id, shop_id: shop_id, asid: asid},
                    success: function (data) {
                        //console.log(data);
                        $(self).closest('form').find('.searche_view').html(data);

                    },
                    error: function () {
                    }
                });


            });


            $(function () {
                $(".date-pick").datepicker({format: 'dd-mm-yyyy'}).val();
            });


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


            function multi_payment() {
                let payment = false;
                let rent = 0;
                let fine = 0;
                $('.checkBoxClass:checkbox(:checked)').each(function () {
                    if ($(this).prop("checked") == true) {
                        payment = true;
                        rent += $(this).data('rent');
                        fine += $(this).data('fine');
                    }
                });
                if (payment) {
                    let total = parseFloat(rent) + parseFloat(fine);
                    $("#multi_pay_option").show();
                    $("#v_total_rent").html(rent);
                    $("#v_total_rent_fine").html(fine);
                    $("#v_total_rent_sum").html(total);

                } else {
                    $("#multi_pay_option").hide();
                }


            }

        });


    </script>
@endsection