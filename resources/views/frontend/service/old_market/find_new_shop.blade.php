@php
    $find_shop = \App\AllotmentSession::Where(['is_active' => 1,'status' => 'Yes'])->orderBy('create_date', 'DESC' )->get();

   // dump($find_shop);
    $find_shop_count =$find_shop->count();
    $sl = 0;


@endphp

@if($find_shop_count > 0)



    <div class="panel-body">
        <table class="table table-striped table-bordered styled-table_o">
            <tr>
                <th>ক্রঃ নং</th>
                <th>মার্কেটের বিবরণ</th>
                <th>দোকানের বিবরণ</th>
                <th>বরাদ্দের বিবরণ</th>
                <th>আবেদনের তারিখ</th>
                <th>আবেদন</th>
            </tr>

            <tbody>
            @foreach($find_shop as $fshop)

                @php
                    $data = \App\MarketShop::Where(['id' => $fshop->shop_id])->get()->first();
                    $market = \App\Market::Where(['id' => $data->market_id])->get()->first();
                    $sl++;



                    $get_existing = \App\ShopAllocateRequest::Where(['aplication_user' => $user['user_id']]);
                        $get_existing = $get_existing->where(function($get_existing){
                            $get_existing->Where('request_status', 'Applied')
                                ->orWhere('request_status', 'Applied')
                                ->orWhere('request_status', 'On Review')
                                ->orWhere('request_status', 'Correction');
                        })->get();

                       //dump();




                @endphp
                <tr>
                    <td>{{ $sl }}</td>
                    <td>
                        <b title="মার্কেটের নাম">নামঃ </b>{{$market->market_name}} <br>
                        <b title="মার্কেটের ঠিকানা">ঠিকানাঃ </b>{{$market->market_name}} <br>


                    </td>
                    <td>
                        <b title="দোকান নং">দোকান
                            নং </b>{{ e_to_b($data->shop_number) }} {{ ($data->shop_floor)? ' ('.e_to_b($data->shop_floor). ' তলায়)' : ''}}
                        <br>
                        <b title="দোকানের আয়তন">আয়তনঃ </b>{{ e_to_b($data->total_volume) }} বর্গফুট<br>
                        <b title="দোকানের দৈর্ঘ্য">দৈর্ঘ্যঃ </b>{{ e_to_b($data->shop_length) }} ফুট<br>
                        <b title="দোকানের প্রস্থ">প্রস্থঃ </b>{{ e_to_b($data->shop_width) }} ফুট<br>
                    </td>
                    <td>
                        <b title="দোকানের ভাড়াঃ">ভাড়াঃ </b>{{ e_to_b($data->next_rent) }}
                        টাকা {{ ' ('.e_to_b($data->rent_type).')'}}<br>
                        <b title="দোকানের সেলামীঃ">সেলামীঃ </b>{{ e_to_b($data->shop_next_salami) }} টাকা<br>
                        <b title="দোকানের ভ্যাটঃ">ভ্যাটঃ </b>{{ e_to_b($data->shop_next_vat) }} % <br>
                        <b title="দোকানের আয়করঃ">আয়করঃ </b>{{ e_to_b($data->shop_next_tax) }} %


                    </td>
                    <td>
                        <b title="আবেদন শুরু">শুরুঃ </b>{{ e_to_b(date("d-F-Y", strtotime($data->allotment_apply_start))) }}
                        <br>
                        <b title="আবেদন শেষ">শেষঃ </b>{{ e_to_b(date("d-F-Y", strtotime($data->allotment_apply_end))) }}
                        <br>

                    </td>
                    <td>
                        @if($get_existing->count() > 0)
                            <button type="button" class="btn btn-default btn-sm" disabled>
                            আবেদন করেছেন
                            </button>
                        @else
                        <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#apply_for_shop{{$data->id}}">
                                আবেদন
                            </button>

                            <!-- Modal -->
                            @include('frontend.service.market.apply_for_shop_modal')

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
