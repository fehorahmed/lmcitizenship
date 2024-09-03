@extends('frontend.layouts.app')

@section('content')
<div class="container user_panel">
    <div class="well">
        @include('frontend.common.frontend_user_menu')
    </div>
    @if (Route::has('login'))
    <?php
    if (!empty(request()->get('id'))) {
        $user = \App\User::where('id', request()->get('id'))->get()->first();
        //dd($user);
    } else {
        $user = Auth::user();
    }


    //dump($user)
    ?>
    <div class="row up_bottom">
        <div class="col-md-12">

            <table class="table table-striped table-bordered styled-table_o">
                <thead>
                    <tr>
                        <th colspan="7">
                            <b> ই-ট্রেড লাইসেন্স</b>


                            <a href="{{ url('business_add') }}" class="btn btn-sm btn-success one-margin pull-right" style="margin-bottom: 0;">
                                নতুন ট্রেড লাইসেন্সের আবেদন
                            </a>
                        </th>

                    </tr>
                    <tr>
                        <th>#</th>
                        <th> Business Info</th>
                        <th> Address (BN)</th>
                        <th colspan="3" style="text-align :center"> License Fees </th>
                        <th class="text-right"> Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($businesses as $business)

                    @php




                    $payment = $business->paid;




                    $can_modify = false;
                    $can_modify = ($business->can_modify == 'Yes')? true : false;

                    if($business->paid){
                    $can_modify = false;
                    $can_modify = ($business->paid->can_modify == 'Yes')? true : false;
                    }
                    @endphp
                    <tr>
                        <th scope="row">{{ $business->id }}</th>
                        <td>
                            <strong title="Company Name">CN:</strong> {{ $business->company_name_bn }}<br />
                            <strong title="Company Type">CN:</strong> {{ $business->company_name_en }}<br />
                            @if($business->trad_cc)
                            <small class="{{ ($business->reg_end > date('Y-m-d'))? 'text-success' : 'text-danger' }}">
                                <strong title="Trad Licence No.">TDN:</strong> {{ ' TRAD/'.$business->trad_cc .'/'. $business->trad_id .'/'. $business->year_from}}
                                @if($business->reg_end < date('Y-m-d')) <a class="btn btn-danger btn-xs" href="http://localhost/pourashava/trad_license_pay_renew/{{$business->id}}" target="_blank">Renew</a>
                                    @endif
                            </small>

                            @endif

                        </td>
                        <td>
                            <strong title="Company Name">ব্যবসায়ের প্রকৃতি:</strong> {{ ($business->nature)?$business->nature->name :'N/A'}}<br />
                            <strong title="Company Type">ব্যবসায়ের ধরণ:</strong> {{ $business->type_business }}<br />


                        </td>
                        <td>
                            <small>
                                <strong title="Company Name">আবেদন :</strong> {{ $business->application_fee .' টাকা ' }}<br />
                                <strong title="Company Type">লাইসেন্স :</strong> {{ $business->license_fee .' টাকা '}}<br />
                                <strong title="Company Type">সাইনবোর্ড :</strong> {{ $business->signboard_fees .' টাকা '}}<br />

                            </small>
                        </td>
                        <td>
                            <small>

                                <strong title="Company Type">ভ্যাট :</strong> {{ $business->vat_fee .' টাকা '}}<br />
                                <strong title="Company Type">সার্ভিস :</strong> {{ $business->service_charge .' টাকা '}}<br />
                                <strong title="Company Type">বমোট ফিস :</strong> {{ $business->grand_total .' টাকা '}}<br />
                            </small>

                        </td>
                        <td>

                            @if(!$payment)
                            <a href="{{ url('trad_license_pay/'. $business->id) }}" class="btn btn-xs btn-success">
                                পেমেন্ট সম্পন্ন করুন
                            </a>
                            @else

                            <small>
                                <b>পেমেন্ট মেথডঃ </b> {{ e_to_b($payment->payment_method) }}<br>
                                <b>পরিমাণঃ </b> {{ e_to_b($payment->amount) }} টাকা<br>
                                <b>তারিখঃ </b> {{ e_to_b(date("d-F-Y", strtotime($payment->created_at))) }}<br>
                                @if($payment->is_active)
                                @if($payment->is_verify == 'Yes')
                                <a class="btn btn-success btn-xs" href="{{url('/pending_payment_view/'.$payment->id)}}" target="_blank">Verified</a>

                                @else
                                <a class="btn btn-warning btn-xs" href="{{url('/pending_payment_view/'.$payment->id)}}" target="_blank">Verification is in progress</a>
                                @endif
                                @else
                                <a class="btn btn-danger btn-xs" href="{{url('/pending_payment_view/'.$payment->id)}}" target="_blank">Pending</a>
                                @endif

                            </small>


                            @endif



                        </td>

                        <td class="text-right">

                            <div class="btn-group btn-group-sm" role="group">


                                @if($can_modify)
                                <a href="{{ url('/business_edit/'. $business->id) }}" class="btn btn-info" target="_blank">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                @endif

                                @if($payment && $payment->is_active && $payment->is_verify == 'Yes')

                                <a href="{{ url('view_trad_license/'.$business->id) }}" title="View Trad Licence" class="btn btn-warning" target="_blank">
                                    <i class="fa fa-print" aria-hidden="true"></i>
                                </a>
                                @endif
                                <!-- <a href="{{ url('remove_business/'. $business->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-times"></i>
                                </a> -->
                                @if($payment)
                                <a href="{{url('/pending_payment_view/'.$payment->id)}}" title="Money receipt" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-money" aria-hidden="true"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

@endsection

@section('cusjs')
<link rel="stylesheet" href="{{ URL::asset('public/css/dropzone.min.css') }}">
@endsection