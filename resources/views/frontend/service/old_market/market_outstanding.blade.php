@php


    $rents = App\Rent::Where(['user_id' => $user['user_id'], 'is_active'=>1]);
    if($is_date){
        $rents = $rents->whereDate('create_date', '>=',$start);
        $rents = $rents->whereDate('create_date', '<=',$end);
    }
    $rents = $rents->where('rent_status', 'No' );
    $rents = $rents->orderBy('full_month', 'ASC' )->get();

    $row_count =$rents->count();
    $sl = 0;

    $due_arry = [];


@endphp

@if($row_count > 0)



    <div class="panel-body">
        <table class="table table-striped table-bordered styled-table_o">
            <tr>
                <th style="width: 5%">
                    <div class="checkbox">
                        <label><input type="checkbox" id="ckbCheckAll"></label>
                    </div>
                </th>
                <th style="width: 30%">মার্কেটের বিবরণ</th>
                <th style="width: 20%">দোকানের বিবরণ</th>
                <th style="width: 25%">ভাড়া বিবরণ</th>
                <th style="width: 20%">স্ট্যাটাস</th>



            </tr>

            <tbody>
            {{Form::open(array('url' => 'rent_pay_sumbit', 'method' => 'post', 'autocomplete' => 'off'))}}

            @foreach($rents as $data)

                @php
                    $shop = \App\MarketShop::Where(['id' => $data->shop_id])->get()->first();
                    $market = \App\Market::Where(['id' => $shop->market_id])->get()->first();
                    $rent_setting = \App\RentSetting::get()->first();
                    $sl++;
                    $due_arry['rent'][] = $data->rent_amount;
                    $due_arry['fine'][] = get_rent_fine($data->id);
                    $f_rent = $data->rent_amount;
                    $f_fine = get_rent_fine($data->id);
                    $f_total = $f_rent + $f_fine;
                    $ba_charge = ($f_total * $rent_setting->bank_charge) / 100;
                    $bk_charge = ($f_total * $rent_setting->bkash_charge) / 100;
                    $na_charge = ($f_total * $rent_setting->nagat_charge) / 100;
                //dump($data);





                @endphp
                <tr>
                    <td>
                        @if($data->rent_req != 'Yes')
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="checkBoxClass" name="month_pay[]" value="{{ $data->id }}"
                                data-rent="{{ $data->rent_amount }}"
                                data-fine="{{ get_rent_fine($data->id) }}"
                                >
                            </label>
                        </div>
                            @endif
                    </td>
                    <td>
                        <small>
                            <b title="মার্কেটের নাম">নামঃ </b>{{$market->market_name}} <br>
                            <b title="মার্কেটের ঠিকানা">ঠিকানাঃ </b>{{$market->market_name}} <br>

                        </small>
                    </td>
                    <td>
                        <small>
                            <b title="দোকান নং">দোকান
                                নং </b>{{ e_to_b($shop->shop_number) }} {{ ($shop->shop_floor)? ' ('.e_to_b($shop->shop_floor). ' তলায়)' : ''}}
                            <br>
                            <b title="দোকানের আয়তন">আয়তনঃ </b>{{ e_to_b($shop->total_volume) }} বর্গফুট<br>
                            <b title="দোকানের দৈর্ঘ্য">দৈর্ঘ্যঃ </b>{{ e_to_b($shop->shop_length) }} ফুট<br>
                            <b title="দোকানের প্রস্থ">প্রস্থঃ </b>{{ e_to_b($shop->shop_width) }} ফুট<br>

                        </small>

                    </td>
                    <td>
                        <small>
                            <b title="মার্কেটের নাম">মাসের নামঃ </b>{{e_to_b($data->month .' ('. $data->year.')')}} <br>
                            <b title="মার্কেটের ঠিকানা"> ভাড়াঃ </b>{{e_to_b($data->rent_amount)}} টাকা <br>
                            <b title=" জরিমানা "> জরিমানাঃ </b>{{ e_to_b(get_rent_fine($data->id))}} টাকা <br>

                        </small>


                    </td>
                    <td>
                        <small>
                            @if($data->rent_status == 'No')
                                <button class="btn btn-danger btn-xs">বাকি</button>

                            @else
                                <button class="btn btn-success btn-xs">পেইড</button>

                            @endif

                            @if($data->rent_status == 'Yes')
                                <a class="btn btn-danger btn-xs" href="{{ url('monthly_rent_print/'.$data->id) }}"><i class="fa fa-print" aria-hidden="true"></i></a>
                            @endif

                        </small>



                    </td>


                </tr>
            @endforeach
            <tr style="background:#9e5bba ;color: #fff">

                <th colspan="2">মোট বকেয়াঃ </th>
                <th>মোট ভাড়াঃ{{ e_to_b(number_format(array_sum($due_arry['rent']),2)) }} টাকা</th>
                <th>মোট জরিমানাঃ{{ e_to_b(number_format(array_sum($due_arry['fine']),2)) }} টাকা</th>
                <th id="multipaymet_sumbit">মোট বকেয়াঃ {{ e_to_b(number_format((array_sum($due_arry['rent']) + array_sum($due_arry['fine'])),2)) }} টাকা</th>

            </tr>
            <tr style="display: none" id="multi_pay_option">




                <th colspan="2"> ভাড়াঃ <span id="v_total_rent"></span> টাকা</th>
                <th> জরিমানাঃ  <span id="v_total_rent_fine"></span> টাকা</th>
                <th id="multipaymet_sumbit">মোটঃ <span id="v_total_rent_sum"></span> টাকা</th>
                <th>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" type="submit">পেমেন্ট অপশন
                    </button>
                </th>

            </tr>
            {{ Form::close() }}

            </tbody>
        </table>

    </div>

@else

    <div class="sorry_not_font">
        <h3>দুঃখিত, এখন আবেদন করার জন্য কোন দোকান নেই।</h3>
    </div>

@endif