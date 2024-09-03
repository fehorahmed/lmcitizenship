@php
    $tenders = App\LandLease::Where(['user_id' => $user['user_id'], 'request_status' => 'Granted'])->orderBy('id', 'desc')->get();

   // dump($tenders);
    $data_count =$tenders->count();
    $sl = 0;


@endphp

@if($data_count > 0)



    <div class="panel-body">
        <table class="table table-striped table-bordered styled-table_o">
            <tr>
                <th>ক্রঃ নং</th>
                <th> ইজারার মেয়াদ </th>
                <th>জমির বিবরণ</th>
                <th>ইজারার বিবরণ</th>

                <th>ইজারার টাকা</th>

{{--                <th>ট্যাক্সের টাকা</th>--}}
                <th>আবেদন</th>
            </tr>

            <tbody>
            @foreach($tenders as $list)

                @php
                    $sl++;

                    $tender = App\LandSession::Where(['id' => $list->tender_id])->get()->first();
                   // dump($tender);
                   $tp_info = json_decode($list->tender_payment_info, true);
                  // dump($list);
                    $land = App\Land::Where(['id' => $tender->land_id])->get()->first();



                @endphp
                <tr>
                    <td>{{ e_to_b($sl) }}</td>
                    <td>
                        <b title="মার্কেটের নাম"> LAND-{{$land->id}}</b> <span class="label label-default">{{e_to_b($tender->s_type)}}</span> <br>
                        <small>

                            <b title=" চুক্তি শুরু"> চুক্তি
                                শুরুঃ </b> {{e_to_b( date('d-F-Y', strtotime($tender->lease_start_date)))}}<br>
                            <b title=" চুক্তি শেষ"> চুক্তি
                                শেষঃ </b> {{e_to_b( date('d-F-Y', strtotime($tender->lease_end_date)))}} <br>
                        </small>
                    </td>

                    <td>

                        <small>

                            <b title="জমির পরিমান">জমির পরিমানঃ </b> {{e_to_b($land->area_of_land)}} শতাংশ<br>
                            <b title="জমির অবস্থা">জমির অবস্থাঃ </b> {{$land->current_status_of_land}}<br>
                            <b title="উপজেলা">উপজেলাঃ </b> {{ e_to_b($land->upazila)}}<br>
                            <b title="মৌজা">মৌজাঃ </b> {{$land->mouza}}<br>
                            <b title="জে. এল. নং">জে. এল. নং </b> {{e_to_b($land->jl_no)}}<br>
                            <b title="খতিয়ান">খতিয়ানঃ </b> {{e_to_b($land->khotian)}}<br>
                            <b title="দাগ">দাগঃ </b> {{e_to_b($land->dhag)}}<br>
                        </small>
                    </td>
                    <td>
                        <small>
                            <b title="উপজেলা">ইজারাঃ </b> {{ e_to_b($tender->rent)}} টাকা<br>
                            <b title="ভ্যাট"> বকেয়াঃ </b> {{e_to_b($tender->due)}} টাকা <br>
                            <b title="ট্যাক্স"> বকেয়া জরিমানাঃ </b> {{e_to_b($tender->fine)}}টাকা<br>
                            <b title="ট্যাক্স">
                                মোটঃ </b> {{e_to_b($tender->total_amount)}}টাকা<br>


                        </small>
                    </td>

                    <td>
                        @if($list->land_rent_info)
                            @php
                                $rent = json_decode($list->land_rent_info, true);
                            $total = (isset($rent['total']))?$rent['total']:$rent['amount'];
                            @endphp

                            <small>
                                <b title="দোকানের ভাড়াঃ">টাকার পরিমাণঃ </b>{{ e_to_b($total)}} টাকা <br>
                                <b title="দোকানের সেলামীঃ">পে অর্ডার / ব্যাংক ড্রাফট
                                    নং </b>{{ e_to_b($rent['payorder']) }}
                                <br>
                                <b title="দোকানের ভ্যাটঃ">তারিখঃ </b>{{ e_to_b($rent['date']) }} <br>
                                <b title="দোকানের আয়করঃ">ব্যাংকের নামঃ </b>{{ $rent['bank'] }} <br>
                                <b title="দোকানের আয়করঃ">শাখাঃ </b>{{ $rent['branch'] }}
                            </small>

                        @else

                        @endif
                    </td>
{{--                    <td>--}}
{{--                        @if($list->land_vat_info)--}}
{{--                            @php--}}
{{--                                $vat = json_decode($list->land_vat_info, true);--}}
{{--                            @endphp--}}
{{--                            <small>--}}
{{--                                <b title="দোকানের ভাড়াঃ">টাকার পরিমাণঃ </b>{{ e_to_b($vat['amount']) }} টাকা <br>--}}
{{--                                <b title="দোকানের সেলামীঃ">পে অর্ডার / ব্যাংক ড্রাফট--}}
{{--                                    নং </b>{{ e_to_b($vat['payorder']) }}--}}
{{--                                <br>--}}
{{--                                <b title="দোকানের ভ্যাটঃ">তারিখঃ </b>{{ e_to_b($vat['date']) }} <br>--}}
{{--                                <b title="দোকানের আয়করঃ">ব্যাংকের নামঃ </b>{{ $vat['bank'] }} <br>--}}
{{--                                <b title="দোকানের আয়করঃ">শাখাঃ </b>{{ $vat['branch'] }}--}}
{{--                            </small>--}}
{{--                        @else--}}

{{--                        @endif--}}
{{--                    </td>--}}
{{--                   --}}
{{--                    <td>--}}
{{--                        @if($list->land_tax)--}}
{{--                            @php--}}
{{--                                $tax = json_decode($list->land_vat_info, true);--}}
{{--                            @endphp--}}
{{--                            <small>--}}
{{--                                <b title="দোকানের ভাড়াঃ">টাকার পরিমাণঃ </b>{{ e_to_b($tax['amount']) }} টাকা <br>--}}
{{--                                <b title="দোকানের সেলামীঃ">পে অর্ডার / ব্যাংক ড্রাফট--}}
{{--                                    নং </b>{{ e_to_b($vat['payorder']) }}--}}
{{--                                <br>--}}
{{--                                <b title="দোকানের ভ্যাটঃ">তারিখঃ </b>{{ e_to_b($tax['date']) }} <br>--}}
{{--                                <b title="দোকানের আয়করঃ">ব্যাংকের নামঃ </b>{{ $tax['bank'] }} <br>--}}
{{--                                <b title="দোকানের আয়করঃ">শাখাঃ </b>{{ $tax['branch'] }}--}}
{{--                            </small>--}}
{{--                        @else--}}

{{--                        @endif--}}
{{--                    </td>--}}
                    <td>
                        @if($list->payment_status)
                            <button class="btn btn-info btn-xs"> {{e_to_b($list->payment_status)}}
                            </button>
                            <a  href="aplication_money_reicept/{{$list->id}}" target="_blank" class="btn btn-danger btn-xs">
                                <i class="fa fa-print" aria-hidden="true"></i>
                            </a>
                        @else


                            <button class="btn btn-info btn-xs" data-toggle="modal"
                                    data-target="#payment-option-land-{{$list->id}}">পেমেন্ট অপশন
                            </button>

                            @include('frontend.service.land_lease.land_payment')

                        @endif


                    </td>


                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@else

    <div class="sorry_not_font">
        <h3>দুঃখিত, এখন আবেদন করার জন্য কোন জমি নেই।</h3>
    </div>

@endif

