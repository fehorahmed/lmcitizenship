@php


    $all_application = \App\ShopAllocateRequest::Where(['aplication_user' => $user['user_id']])->orderBy('id', 'DESC' )->get();
    $row_count =$all_application->count();
    $sl = 0;


@endphp

@if($row_count > 0)



    <div class="panel-body">
        <table class="table table-striped table-bordered styled-table_o">
            <tr>
                <th>ক্রঃ নং</th>
                <th>দোকানের বিবরণ</th>
                <th>সেলামীর অর্থ বাবদ</th>
                <th>ভ্যাটের পরিমাণ</th>
                <th>আয়করে পরিমাণ</th>
                <th>আবেদন</th>
                <th>স্ট্যাটাস</th>

            </tr>

            <tbody>
            @foreach($all_application as $data)

                @php
                    $shop = \App\MarketShop::Where(['id' => $data->shop_id])->get()->first();
                    $market = \App\Market::Where(['id' => $shop->market_id])->get()->first();
                    $sl++;

                    $salami = json_decode($data->shop_salami_info,true);
                    $vat = json_decode($data->shop_vat_info,true);
                    $tax = json_decode($data->shop_tax_info,true);

               // dd($data);




                @endphp
                <tr>
                    <td>{{ $sl }}</td>
                    <td>
                        <small>
                            <b title="মার্কেটের নাম">নামঃ </b>{{$market->market_name}} <br>
                            <b title="মার্কেটের ঠিকানা">ঠিকানাঃ </b>{{$market->market_name}} <br>
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
                            <b title="দোকানের ভাড়াঃ">টাকার পরিমাণঃ </b>{{ e_to_b($salami['amount']) }} টাকা <br>
                            <b title="দোকানের সেলামীঃ">পে অর্ডার / ব্যাংক ড্রাফট
                                নং </b>{{ e_to_b($salami['payorder']) }}<br>
                            <b title="দোকানের ভ্যাটঃ">তারিখঃ </b>{{ e_to_b($salami['date']) }} <br>
                            <b title="দোকানের আয়করঃ">ব্যাংকের নামঃ </b>{{ $salami['bank'] }} <br>
                            <b title="দোকানের আয়করঃ">শাখাঃ </b>{{ $salami['branch'] }}
                        </small>

                    </td>
                    <td>
                        <small>
                            <b title="দোকানের ভাড়াঃ">টাকার পরিমাণঃ </b>{{ e_to_b($vat['amount']) }} টাকা <br>
                            <b title="দোকানের সেলামীঃ">পে অর্ডার / ব্যাংক ড্রাফট নং </b>{{ e_to_b($vat['payorder']) }}
                            <br>
                            <b title="দোকানের ভ্যাটঃ">তারিখঃ </b>{{ e_to_b($vat['date']) }} <br>
                            <b title="দোকানের আয়করঃ">ব্যাংকের নামঃ </b>{{ $vat['bank'] }} <br>
                            <b title="দোকানের আয়করঃ">শাখাঃ </b>{{ $vat['branch'] }}
                        </small>


                    </td>
                    <td>
                        <small>
                            <b title="দোকানের ভাড়াঃ">টাকার পরিমাণঃ </b>{{ e_to_b($tax['amount']) }} টাকা <br>
                            <b title="দোকানের সেলামীঃ">পে অর্ডার / ব্যাংক ড্রাফট নং </b>{{ e_to_b($tax['payorder']) }}
                            <br>
                            <b title="দোকানের ভ্যাটঃ">তারিখঃ </b>{{ e_to_b($tax['date']) }} <br>
                            <b title="দোকানের আয়করঃ">ব্যাংকের নামঃ </b>{{ $tax['bank'] }} <br>
                            <b title="দোকানের আয়করঃ">শাখাঃ </b>{{ $tax['branch'] }}
                        </small>

                    </td>
                    <td>
                        <small>
                            <b title="আবেদন শুরু">আবেদনঃ </b>{{ $data->shop_witch_type }}
                            <br>
                            <b title="আবেদন শেষ">তারিখঃ </b>{{ e_to_b(date("d-F-Y", strtotime($data->create_date))) }}
                            <br>
                        </small>


                    </td>
                    <td>
                        @php

                            if($data->request_status =='Applied' || $data->request_status =='On Review' || $data->request_status =='Granted'){
                                $status_color = 'btn-success';
                            }else{
                                $status_color = 'btn-danger';
                            }

                        @endphp

                        <button type="button" class="btn  btn-sm {{$status_color}}">
                            {{ $data->request_status }}
                        </button>

                        @if($data->request_status == 'Granted')
                            <a class="btn btn-danger btn-xs" href="{{ url('salami_print/'.$data->id) }}"><i class="fa fa-print" aria-hidden="true"></i></a>
                        @endif

                    </td>


                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@else

    <div class="sorry_not_font">
        <h3>দুঃখিত, এখন আবেদন করার জন্য কোন দোকান নেই।</h3>
    </div>

@endif

