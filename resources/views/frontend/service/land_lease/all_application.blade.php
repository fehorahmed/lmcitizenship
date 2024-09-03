@php
    $tenders = App\LandLease::Where(['user_id' => $user['user_id']])->orderBy('id', 'decs')->get();

   // dump($tenders);
    $data_count =$tenders->count();
    $sl = 0;


@endphp

@if($data_count > 0)



    <div class="panel-body">
        <table class="table table-striped table-bordered styled-table_o">
            <tr>
                <th>ক্রঃ নং</th>
                <th>জমির বিবরণ</th>
                <th>জমির ঠিকানা</th>
                <th>ইজারার বিবরণ</th>
                <th> আবেদনের  ধরন</th>
                <th>আবেদনের তারিখ</th>
                <th>আবেদন</th>
            </tr>

            <tbody>
            @foreach($tenders as $list)

                @php
                    $sl++;

                    $tender = App\LandSession::Where(['id' => $list->tender_id])->get()->first();

                   $tp_info = json_decode($list->tender_payment_info, true);
                   // dump($tender);
                    $land = App\Land::Where(['id' => $list->land_id])->get()->first();




                @endphp
                <tr>
                    <td>{{ $sl }}</td>
                    <td>
                        <b title="মার্কেটের নাম"> LAND-{{$land->id}} </b><br>
                        <b title="জমির পরিমান">জমির পরিমানঃ </b> {{e_to_b($land->area_of_land)}} শতাংশ<br>
                        <b title="জমির অবস্থা">জমির অবস্থাঃ </b> {{$land->current_status_of_land}}<br>
                        <b title=" চুক্তি শুরু"> চুক্তি
                            শুরুঃ </b> {{e_to_b( date('d-F-Y', strtotime($tender->lease_start_date)))}}<br>
                        <b title=" চুক্তি শেষ"> চুক্তি
                            শেষঃ </b> {{e_to_b( date('d-F-Y', strtotime($tender->lease_end_date)))}}


                    </td>
                    <td>
                        <b title="উপজেলা">উপজেলাঃ </b> {{ e_to_b($land->upazila)}}<br>
                        <b title="মৌজা">মৌজাঃ </b> {{$land->mouza}}<br>
                        <b title="জে. এল. নং">জে. এল. নং </b> {{e_to_b($land->jl_no)}}<br>
                        <b title="খতিয়ান">খতিয়ানঃ </b> {{e_to_b($land->khotian)}}<br>
                        <b title="দাগ">দাগঃ </b> {{e_to_b($land->dhag)}}<br>
                    </td>
                    <td>
                        @php
                        $lease_amount =($tender)? $tender->rent: $land->lease_amount;
                        $lease_tax =($tender)? $tender->tax: $land->lease_tax;
                        $lease_vat =($tender)? $tender->vat: $land->lease_vat;
                        $lease_total_vat =  ($lease_vat * $lease_amount)/100;
                        $lease_total_tax =  ($lease_tax * $lease_amount)/100;
                        $lease_start_date =($tender)? $tender->lease_start_date: $land->lease_start;
                        $lease_end_date =($tender)? $tender->lease_end_date: $land->lease_end;

                        @endphp

                        <b title="উপজেলা">ইজারাঃ </b> {{ e_to_b($tender->rent)}} টাকা<br>
                        <b title="ভ্যাট"> বকেয়াঃ </b> {{e_to_b($tender->due)}} টাকা <br>
                        <b title="ট্যাক্স"> বকেয়া জরিমানাঃ </b> {{e_to_b($tender->fine)}}টাকা<br>
                        <b title="ট্যাক্স">  মোটঃ </b> {{e_to_b($tender->total_amount)}}টাকা<br>
                        @if($tender->due_info)
                            @php
                                $due_info = json_decode($tender->due_info, true);
                                //dump($due_info);
                            @endphp
                            <b title="ভ্যাট">  বকেয়ার সময়ঃ </b> <br>
                            {{e_to_b(date('d-F-y', strtotime($due_info['from'])))}}  থেকে {{e_to_b(date('d-F-y', strtotime($due_info['to'])))}}
                             ( {{e_to_b($due_info['year'])}}  বছর)
                            <br>

                        @endif

                    </td>
                    <td>
                        {{ e_to_b($list->application_status) }}


                    </td>
                    <td>
                        <b title=" আবেদনের শুরু">তারিখঃ </b> {{e_to_b( date('d-F-Y', strtotime($list->created_at)))}}<br>
                        <b title=" পেমেন্ট মেথডঃ ">পেমেন্ট মেথডঃ  </b> {{e_to_b($tp_info['payment_method'])}}<br>
                        <b title=" টাকার পরিমাণঃ ">টাকার পরিমাণঃ </b> {{e_to_b($tp_info['amount'])}} টাকা<br>
                        @if(!isset($tp_info['bank']))
                        <b title=" মোবাইল নম্বর ">মোঃ নং </b> {{e_to_b($tp_info['number'])}}<br>
                        <b title=" ট্যাক্স আইডি">ট্যাক্স আইডিঃ </b> {{$tp_info['tid']}}<br>
                        @else
                        <b title=" পে অর্ডার নং ">পে অর্ডার নং </b> {{e_to_b($tp_info['payorder'])}}<br>
                        <b title="ব্যাংকঃ ">ব্যাংকঃ </b> {{e_to_b($tp_info['bank'])}}<br>
                        <b title=" শাখা ">শাখাঃ </b> {{e_to_b($tp_info['branch'])}}<br>
                            @endif
                    </td>
                    <td>


                        <button type="button" class="btn btn-default btn-sm" disabled>
                            {{ e_to_b($list->request_status) }}
                        </button>

                        <div class="btn-group disabled " role="group" disabled="disabled">

                            <button type="button" class="btn btn-xs btn-danger dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <i class="fa fa-print" aria-hidden="true"></i>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" style="right: 0; left: inherit">
                                <li><a href="lease_aplication_print/{{$list->id}}" target="_blank">আবেদন</a></li>
                                <li><a href="lease_request_money_reicept/{{$list->id}}" target="_blank">মানি রিসিপ্ট</a></li>
                            </ul>
                        </div>


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
