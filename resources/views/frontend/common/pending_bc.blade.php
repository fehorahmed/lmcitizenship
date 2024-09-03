@extends('frontend.layouts.app')

@section('content')
    <div class="container user_panel">
        @include('frontend.common.frontend_user_menu')
        @if (Route::has('login'))
            <?php $user_own = Auth::user(); ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                ইউজার খুঁজুন
                            </h5>
                        </div>
                        <div class="panel-body">

                            {{ Form::open(array('url' => '/pending_bc', 'method' => 'get', 'value' => 'PATCH', 'id' => '')) }}
                            <div class="row">
                                <div class="col-xs-2">
                                    <div class="form-group">

                                        {{ Form::select('request_status',  [
                                        'Applied' => 'ফলিত',
                                        'Pending' => 'মুলতুবি',
                                        'Processing' => 'প্রক্রিয়াকরণ',
                                        'Ready for delivery' => 'সরবরাহের জন্য প্রস্তুত',
                                        'Delivery successful' => 'বিতরণ সফল',
                                        'Correction' => 'সংশোধন',
                                        'Cancel' => 'বাতিল'
                                        ],
                                         (!empty(Request::post('request_status')) ? Request::post('request_status') : NULL),
                                        ['class' => 'form-control', 'placeholder' => 'স্ট্যাটাস']) }}
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <select name="column" class="form-control select2" style="width: 100%;">
                                        <option value="Name" {{ (Request::post('column') == 'name') ? 'selected="selected"' : 'selected="selected"' }}>
                                            নাম
                                        </option>
                                        <option value="nidno" {{ (Request::post('column') == 'nidno') ? 'selected="selected"' : '' }}>
                                            ন্যাশনাল আইডি
                                        </option>
                                        <option value="passportno" {{ (Request::post('column') == 'passportno') ? 'selected="selected"' : '' }}>
                                            পাসপোর্ট নং
                                        </option>
                                        <option value="birthcertificateno" {{ (Request::post('column') == 'birthcertificateno') ? 'selected="selected"' : '' }}>
                                            বার্থ সার্টিফিকেট
                                        </option>
                                        <option value="email" {{ (Request::post('column') == 'email') ? 'selected="selected"' : '' }}>
                                            ইমেইল
                                        </option>
                                        <option value="phone" {{ (Request::post('column') == 'phone') ? 'selected="selected"' : '' }}>
                                            ফোন
                                        </option>
                                    </select>
                                </div>
                                <div class="col-xs-4">
                                    {{ Form::text('search_key', Request::post('search_key'), [ 'class' => 'form-control', 'placeholder' => '  সার্চ  বিষয়  লিখুন (ইংরেজিতে) ']) }}
                                </div>
                                <div class="col-xs-2">
                                    <input name="submit" class="btn btn-success" type="submit" value="Search">
                                    <input name="submit" class="btn btn-danger" formtarget="_blank" type="submit"
                                           value="Print">
                                </div>
                            </div>
                            {{ Form::close() }}

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12">

                    <table class="table table-striped table-bordered">
                        <tbody>
                        <tr style="background: #9E5BBA !important; color: #FFF;">
                            <th> আই ডি</th>
                            <th> আবেদনকারী</th>

                            <th> তারিখ</th>
                            <th> পেমেন্ট বিবরণ</th>
                            <th> ট্রানসাকশান আই ডি</th>
                            <th> স্ট্যাটাস</th>
                            <th> অ্যাকশান</th>
                        </tr>

                        @foreach($mdata as $list)
                            @php
                                //  dump($list);
                            @endphp

                            <tr>

                                <td>
                                    {{e_to_b( $list->id) }}
                                </td>

                                <td>
                                    <b>নামঃ </b>{{ ($list->bnname)?$list->bnname: $list->name }}<br>
                                    <b> পিতার নামঃ </b>{{ $list->bnfathername }}<br>
                                    <b>মোবাইলঃ </b>{{ e_to_b($list->user->phone )}}<br>


                                </td>


                                <td>{{ e_to_b(date('d-F-Y', strtotime($list->created_at))) }}</td>
                                <td>
                                    <b>পেমেন্ট মেথডঃ </b> {{ e_to_b($list->payment->payment_method) }}<br>
                                    <b>পরিমাণঃ </b> {{ e_to_b($list->payment->amount) }} টাকা<br>
                                    <b>তারিখঃ </b> {{ e_to_b(date("d-F-Y", strtotime($list->payment->created_at))) }}
                                    <br>

                                </td>
                                <td>{{ e_to_b($list->payment->transaction_no) }}</td>
                                <td>{{ e_to_b( $list->request_status)  }}</td>
                                <td>
                                    @if($list->payment->is_active == 0)
                                        <a href="{{ url('/payment_aprove/'.$list->payment->id) }}"
                                           class="btn btn-success btn-sm">Aprove</a>
                                    @else
                                        @if(!in_array($list->request_status, ['Cancel','Delivery successful'], true ))
                                        <a href="javascript:void(0)" data-toggle="modal" class="btn btn-success btn-sm"
                                           data-target="#pending_bc_statu_schange_{{$list->id}}">স্ট্যাটাস চেঞ্জ</a>
                                            @include('frontend.common.pending_bc_statu_schange')
                                        @endif


                                        <a href="{{ url('bc_aplication/'.$list->id) }}" class="btn btn-danger btn-sm"
                                           target="_blank"
                                        > আবেদন</a>

                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="box-footer clearfix">
                        {{-- {{ $mine_income_statement->links('component.paginator', ['object' => $mine_income_statement]) }} --}}
                        {{ $mdata->appends(request()->query())->links('component.paginator', ['object' => $mdata]) }}
                    </div>

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
