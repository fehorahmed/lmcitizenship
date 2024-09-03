@php


    $rents = App\Rent::Where(['user_id' => $user['user_id'], 'is_active'=>1]);
    if($is_date){
        $rents = $rents->whereDate('create_date', '>=',$start);
        $rents = $rents->whereDate('create_date', '<=',$end);
    }
    $rents = $rents->where('rent_status', 'Yes' );
    $rents = $rents->orderBy('id', 'DESC' )->get();

 $row_count =$rents->count();
    $sl = 0;


@endphp

@if($row_count > 0)



    <div class="panel-body">
        <table class="table table-striped table-bordered styled-table_o">
            <tr>
                <th>ক্রঃ নং</th>
                <th>মার্কেটের বিবরণ</th>
                <th>দোকানের বিবরণ</th>
                <th>ভাড়া বিবরণ</th>
                <th>স্ট্যাটাস</th>


            </tr>

            <tbody>
            @foreach($rents as $data)

                @php
                    $shop = \App\MarketShop::Where(['id' => $data->shop_id])->get()->first();
                    $market = \App\Market::Where(['id' => $shop->market_id])->get()->first();
                    $sl++;


              // dump($data);




                @endphp
                <tr>
                    <td>{{ $sl }}</td>
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
                            <a class="btn btn-danger btn-xs" href="{{ url('monthly_rent_print/'.$data->rent_master) }}"><i class="fa fa-print" aria-hidden="true"></i></a>
                               @endif

                        </small>



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