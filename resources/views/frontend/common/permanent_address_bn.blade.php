@extends('frontend.layouts.app')

@section('content')
    <div class="container user_panel">
            @include('frontend.common.frontend_user_menu')

        @if (Route::has('login'))
            <?php
            if (!empty(request()->get('id'))) {
                $user = \App\User::where('id', request()->get('id'))->get()->first();
                //dd($user);
            } else {
                $user = Auth::user();
            }
            ?>
            <div class="row up_bottom">
                <div class="col-md-12">
                    <div class="panel panel-default commone-hean">
                        <div class="panel-heading">স্থায়ী ঠিকানা ( বাংলাতে )</div>
                        {{ Form::open(array('url' => '/permanent_address_bn', 'method' => 'post', 'value' => 'PATCH', 'id' => 'general_info_en')) }}
                        <div class="panel-body">

                            @include('frontend.common.message_handler')
                            {{ Form::hidden('profile_id', $user->id, ['required']) }}
                            <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            {{ Form::label('holding_no_bn', ' হোল্ডিং নম্বর ', array('class' => 'holding_no_bn cmmone-class')) }}
                                            {{ Form::text('holding_no_bn', !empty($user) ? $user->bnparholdingno : NULL, ['class' => 'form-control', 'placeholder' => 'হোল্ডিং নম্বর']) }}
                                        </div>
                                    </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {{ Form::label('village_bn', ' গ্রাম/মহল্লা  ', array('class' => 'village_en cmmone-class')) }}
                                        {{ Form::text('village_bn', !empty($user) ? $user->bnparvillage : NULL, ['required', 'class' => 'form-control', 'placeholder' => ' গ্রাম/মহল্লা  ']) }}
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {{ Form::label('union_bn', ' ইউনিয়ন  ', array('class' => 'block_en cmmone-class')) }}
                                        {{ Form::text('union_bn', !empty($user) ? $user->bnparroad : NULL, ['class' => 'form-control', 'placeholder' => ' ইউনিয়ন ']) }}
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {{ Form::label('ward_no_bn', ' ওয়ার্ড নং  ', array('class' => 'ward_no_en cmmone-class')) }}
                                        {{ Form::text('ward_no_bn', !empty($user) ? $user->bnparwardno : NULL, ['class' => 'form-control', 'placeholder' => ' ওয়ার্ড নং ']) }}
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {{ Form::label('post_office_bn', ' পোষ্ট অফিস ', array('class' => 'post_office_en cmmone-class')) }}
                                        {{ Form::text('post_office_bn', !empty($user) ? $user->bnparpostoffice : NULL, ['class' => 'form-control', 'placeholder' => ' পোষ্ট অফিস ']) }}
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {{ Form::label('bnparupazilla', ' উপজেলা /  থানা ', array('class' => 'bnparupazilla cmmone-class')) }}
                                        {{ Form::text('upazilla_bn', !empty($user) ? $user->bnparupazilla : NULL, ['class' => 'form-control', 'placeholder' => ' Upazilla ']) }}
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    {{ Form::label('district_bn', ' জেলা ', array('class' => 'district_bn cmmone-class')) }}
                                    {{ Form::text('district_bn', !empty($user) ? $user->bnpardistrict : NULL, ['class' => 'form-control', 'placeholder' => ' District ']) }}
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::submit('  হালনাগাদ করুন ', ['class' => 'btn btn-success', 'name' => 'submit']) }}
                            </div>

                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('cusjs')
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $.noConflict();

            $('#division').on('change', function () {
                var division = $(this).val();

                $.ajax({
                    url: baseurl + '/get_district_by_division',
                    method: 'get',
                    data: {division: division},
                    success: function (data) {
                        //console.log(data);
                        $('#district').html(data);
                    },
                    error: function () {
                    }
                });
            });

            $('#district').on('change', function () {
                var district = $(this).val();

                $.ajax({
                    url: baseurl + '/get_thana_by_district',
                    method: 'get',
                    data: {district: district},
                    success: function (data) {
                        $('#thana').html(data);
                    },
                    error: function () {
                    }
                });
            });


            $('#thana').on('change', function () {
                var thana = $(this).val();

                $.ajax({
                    url: baseurl + '/get_showroom_by_thana',
                    method: 'get',
                    data: {thana: thana},
                    success: function (data) {
                        $('#contentreloader').html(data);
                        //$('.news-content').html(data);
                    },
                    error: function () {
                    }
                });
            });

        });
    </script>
@endsection