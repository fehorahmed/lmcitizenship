@extends('frontend.layouts.app')

@section('content')
<div class="container user_panel">
    @include('frontend.common.frontend_user_menu')



    @php
    $data_count = $mine_income_statement->count();


    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="panel-title">
                                হিসাব ব্যবস্থাপক
                            </h5>
                        </div>
                        <div class="col-md-6 text-right">

                            <!-- Button trigger modal -->
                            <a href="{{ route('account.payment') }}" class="btn btn-danger">
                                Payment
                            </a>



                        </div>
                    </div>



                </div>
                <div class="panel-body">

                    {{ Form::open(array('url' => '/distal_account', 'method' => 'GET', 'value' => 'PATCH', 'id' => '', 'autocomplete' => 'off')) }}
                    <div class="row">

                        @php

                        $services = App\Service::get();

                        @endphp

                        <div class="col-xs-3">

                            <select name="service_id" class="form-control select2" style="width: 100%;">
                                <option value="">
                                    সেবার নাম পছন্দ করুন
                                </option>
                                @foreach($services as $list)
                                <option value="{{ $list->route }}"
                                    {{ (Request::post('service_id') == $list->id) ? 'selected' : '' }}>
                                    {{ $list->name }}
                                </option>
                                @endforeach

                            </select>
                        </div>


                        <div class="col-xs-5 form-inline">
                            <div class="form-group">
                                <input type="text" value="{{ Request::post('from_date')  }}" name="from_date"
                                    class="g-date-pick form-control" placeholder="From Date" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ Request::post('to_date')  }}" name="to_date"
                                    class="g-date-pick form-control" placeholder="To Date" autocomplete="off">
                            </div>

                        </div>


                        <div class="col-xs-2">
                            <input name="submit" class="btn btn-success" type="submit" value="Search">
                            @if($data_count > 0)
                            <input name="submit" class="btn btn-danger" formtarget="_blank" type="submit" value="Print">
                            @endif
                        </div>
                    </div>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>

    @if (Route::has('login'))
    <?php
            $user_own = Auth::user();
            $accounting = $mine_income_statement;
            $total = [];
            ?>


    <div class="row">
        <div class="col-md-12">
            {{-- @include('account::widget.dc_payment_summery',['user' => auth()->user()]) --}}
        </div>
        <div class="col-md-12">
            @if($data_count > 0)

            <table class="table table-striped table-bordered">
                <tbody>
                    <tr style="background: #9E5BBA !important; color: #FFF;">
                        <th> আই ডি</th>
                        <th> আবেদনকারী</th>
                        <th> সেবার নাম</th>

                        <th> পেমেন্ট বিবরণ</th>
                        <th> ট্রানসাকশান আই ডি</th>
                        <th> অ্যাকশান</th>
                    </tr>
                    @php
                        $n = 0;
                    @endphp
                    @foreach($mine_income_statement as $income)

                    @php
                    //dump($income);
                    $total[] = $income->amount;
                    @endphp
                    <tr>
                        <td>{{ e_to_b(++$n) }}</td>
                        <td>
                            <b>নামঃ </b>{{ isset($income->user->bnname)?$income->user->bnname: '' }}<br>
                            <b> পিতার নামঃ
                            </b>{{ isset($income->user->bnfathername)?$income->user->bnfathername:'' }}<br>
                            <b>মোবাইলঃ </b>{{ isset($income->user->phone)? e_to_b($income->user->phone): ''}}<br>
                        </td>

                        <td>{{ $income->title }}</td>

            

                        <td>
                            @include('account::widget.payment',['payment' => $income->discription])
                        </td>

                        <td>
                            @include('account::widget.payment-tran',['payment' => $income->discription])
                        </td>

                        <td>
                            {{ e_to_b($income->amount) }} টাকা
                        </td>

                    </tr>
                    @endforeach
                    <tr style="background: #9E5BBA !important; color: #FFF;">
                        <td colspan="5"> মোটঃ</td>
                        <td>
                            {{ e_to_b(array_sum($total) )}} টাকা
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="box-footer clearfix">
                {{-- {{ $mine_income_statement->links('component.paginator', ['object' => $mine_income_statement]) }}
                --}}
                {{ $mine_income_statement->appends(request()->query())->links('component.paginator', ['object' => $mine_income_statement]) }}
            </div>
            @else
            @include('frontend.common.nodatafound')
            @endif
        </div>
    </div>
    @endif
</div>
@endsection
@section('cusjs')
<style type="text/css">
    .custom_icons img {
        width: 40px !important;
        height: 40px !important;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #FFFFFF;
        min-width: 1000px;
        box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 1);
        z-index: 99999;
        right: 0;
        padding: 10px;
        border: 1px solid #DDDDDD;
    }
</style>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
            $.noConflict();
        });

        function flip(id) {
            jQuery(".panel_" + id).toggle();
        }

        $('#search').on('keyup', function () {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{URL::to('search')}}',
                data: {'search': $value},
                success: function (data) {
                    $('tbody').html(data);
                }
            });
        })
</script>
@endsection