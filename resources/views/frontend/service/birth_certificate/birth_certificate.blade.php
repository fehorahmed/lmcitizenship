@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        @include('frontend.common.frontend_user_menu')
        <div class="row">
            <div class="col-md-12">
                @include('frontend.common.message_handler')
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"> জন্ম নিবন্ধন


                        <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal"
                                data-target="#myModal">
                            আবেদন
                        </button>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="row">Index</th>
                                <td>Date</td>
                                <td>Type</td>
                                <td>Languase</td>
                                <td>Amount</td>
                                <td>Status</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($requests as $list)
                            <tr>
                                @php
                                    $payment = \App\Payment::where(['id' => $list->payment_id])->get()->first();
                                    //dump($list);
                                   // dump($payment);
                                @endphp
                                <th scope="row">{{ $list->id }}</th>
                                <td>{{ date('d-m-Y', strtotime($list->created_at)) }}</td>
                                <td>{{ $list->request_type }}</td>
                                <td>{{ $list->request_lang }}</td>
                                <td>
                                    @if($payment->is_active == 1)
                                    <i class="fa fa-check-circle text-success" aria-hidden="true"></i>  &nbsp;&nbsp;
                                    @endif
                                        {{ $payment->amount }} TK

                                </td>
                                <td>{{ $list->request_status }}</td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>


        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    {{ Form::open(array('url' => 'birth_certificate_applay', 'method' => 'post', 'value' => 'PATCH', 'enctype' => 'multipart/form-data')) }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"> জন্ম নিবন্ধন </h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"> সাধারণ তথ্যাদি</div>
                                    <div class="panel-body">
                                        {{ Form::hidden('profile_id', $user->id) }}

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('request_lang', 'ভাষা ', array('class' => 'gender cmmone-class')) }}
                                                <select class="form-control" name="request_lang" id="sel1" required>
                                                    <option value="">Select</option>
                                                    <option value="bn">
                                                        বাংলা
                                                    </option>
                                                    <option value="en">
                                                        ইংরেজি
                                                    </option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('request_type', 'আবেদনের ধরন ', array('class' => 'gender cmmone-class')) }}
                                                <select class="form-control" name="request_type" id="sel1" required>
                                                    <option value="">Select</option>
                                                    <option value="First">
                                                        নতুন
                                                    </option>
                                                    <option value="Date of birth correction">
                                                        জন্ম তারিখ সংশোধন
                                                    </option>
                                                    <option value="Correction">
                                                        সংশোধন
                                                    </option>
                                                    <option value="Copy">
                                                        নকল
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('bnname', ' নাম ', array('class' => 'bnname cmmone-class')) }}
                                                {{ Form::text('bnname', !empty($user) ? $user->bnname : NULL, ['class' => 'form-control', 'placeholder' => ' নাম ']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('name', ' Name  ', array('class' => 'name cmmone-class')) }}
                                                {{ Form::text('name', !empty($user) ? @$user->name : NULL, ['class' => 'form-control', 'placeholder' => ' Name  ']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('bnfathername', ' পিতার নাম ', array('class' => 'bnfathername cmmone-class')) }}
                                                {{ Form::text('bnfathername', !empty($user) ? $user->bnfathername : NULL, ['class' => 'form-control', 'placeholder' => ' পিতার নাম ']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('enfathername', ' Father\'s name  ', array('class' => 'enfathername cmmone-class')) }}
                                                {{ Form::text('enfathername', !empty($user) ? @$user->enfathername : NULL, ['class' => 'form-control', 'placeholder' => ' Father\'s name  ']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('bnmothername', ' মাতার নাম ', array('class' => 'bnmothername cmmone-class')) }}
                                                {{ Form::text('bnmothername', !empty($user) ? $user->bnmothername : NULL, ['class' => 'form-control', 'placeholder' => ' মাতার নাম ']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('enmothername', ' Mother\'s name  ', array('class' => 'enmothername cmmone-class')) }}
                                                {{ Form::text('enmothername', !empty($user) ? @$user->enmothername : NULL, ['class' => 'form-control', 'placeholder' => ' Mother\'s name']) }}
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('gender', 'Gender ', array('class' => 'gender cmmone-class')) }}
                                                <select class="form-control" name="gender" id="sel1">
                                                    <option value="">Select</option>
                                                    <option value="Male" {{(@$user->gender == 'Male') ? 'selected' : ''}}>
                                                        Male
                                                    </option>
                                                    <option value="Female" {{(@$user->gender == 'Female') ? 'selected' : ''}}>
                                                        Female
                                                    </option>
                                                    <option value="Others" {{(@$user->gender == 'Others') ? 'selected' : ''}}>
                                                        Others
                                                    </option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('birthday', ' Birthday ', array('class' => 'birthday cmmone-class')) }}
                                                {{ Form::date('birthday', !empty($user) ? @$user->birthday : NULL, ['id' => 'date', 'class' => 'form-control', 'placeholder' => '  Birthday ']) }}
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading"> বর্তমান ঠিকানা (বাংলাতে)</div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            {{ Form::label('bnpreholdingno', ' হোল্ডিং নম্বর ', array('class' => 'bnpreholdingno cmmone-class')) }}
                                            {{ Form::text('bnpreholdingno', !empty($user) ? $user->bnpreholdingno : NULL, ['class' => 'form-control', 'placeholder' => 'হোল্ডিং নম্বর']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('bnprevillage', ' গ্রাম/মহল্লা  ', array('class' => 'bnprevillage cmmone-class')) }}
                                            {{ Form::text('bnprevillage', !empty($user) ? $user->bnprevillage : NULL, ['class' => 'form-control', 'placeholder' => ' গ্রাম/মহল্লা  ']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('bnpreroad', ' ইউনিয়ন  ', array('class' => 'bnpreroad cmmone-class')) }}
                                            {{ Form::text('bnpreroad', !empty($user) ? $user->bnpreroad : NULL, ['class' => 'form-control', 'placeholder' => ' ইউনিয়ন ']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('bnprewardno', ' ওয়ার্ড নং  ', array('class' => 'bnprewardno cmmone-class')) }}

                                            <select class="form-control " name="bnprewardno" id="bnprewardno">

                                                <option value="">Select</option>
                                                @foreach(reg_ward_list() as $list)

                                                    <option value="{{$list}}" {{(@$user->bnprewardno == $list) ? 'selected' : ''}}>
                                                        {{$list}}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('bnprepostoffice', ' পোষ্ট অফিস ', array('class' => 'bnprepostoffice cmmone-class')) }} {{ Form::text('bnprepostoffice',
                                !empty($user) ? $user->bnprepostoffice : NULL, ['class' => 'form-control', 'placeholder' => ' পোষ্ট অফিস ']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('bnpreupazilla', ' উপজেলা / থানা ', array('class' => 'bnpreupazilla cmmone-class')) }} {{ Form::text('bnpreupazilla',
                                !empty($user) ? $user->bnpreupazilla : NULL, ['class' => 'form-control', 'placeholder' => 'উপজেলা / থানা ']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('bnpredistrict', ' জেলা ', array('class' => 'bnpredistrict cmmone-class')) }}
                                            {{ Form::text('bnpredistrict', !empty($user)
                                            ? $user->bnpredistrict : NULL, ['class' => 'form-control', 'placeholder' => 'জেলা ']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading"> বর্তমান ঠিকানা (ইংরেজিতে)</div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            {{ Form::label('enpreholdingno', ' Holding Number ', array('class' => 'enpreholdingno cmmone-class')) }}
                                            {{ Form::text('enpreholdingno',
                                            !empty($user) ? $user->enpreholdingno : NULL, ['class' => 'form-control', 'placeholder' => 'Holding Number ']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('enprevillage', ' Village ', array('class' => 'enprevillage cmmone-class')) }} {{ Form::text('enprevillage', !empty($user)
                                ? $user->enprevillage : NULL, ['class' => 'form-control', 'placeholder' => 'Village ']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('enpreroad', 'Union ', array('class' => 'enpreroad cmmone-class')) }} {{ Form::text('enpreroad', !empty($user)
                                ? $user->enpreroad : NULL, ['class' => 'form-control', 'placeholder' => ' Union ']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('enprewardno', ' Ward No ', array('class' => 'enprewardno cmmone-class')) }}


                                            <select class="form-control " name="enprewardno" id="enprewardno">

                                                <option value="">Select</option>
                                                @foreach(reg_ward_list() as $list)

                                                    <option value="{{$list}}" {{(@$user->enprewardno == $list) ? 'selected' : ''}}>
                                                        {{$list}}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('enprepostoffice', 'Post Office ', array('class' => 'enprepostoffice cmmone-class')) }} {{ Form::text('enprepostoffice',
                                !empty($user) ? $user->enprepostoffice : NULL, ['class' => 'form-control', 'placeholder' => 'Post Office']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('enpredistrict', 'Upazila / Thana', array('class' => 'enpredistrict cmmone-class')) }}
                                            {{ Form::text('enpredistrict', !empty($user) ? $user->enpredistrict : NULL, ['class' => 'form-control', 'placeholder' => 'Upazila / Thana']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::label('enpreupazilla', ' District ', array('class' => 'enpreupazilla cmmone-class')) }}
                                            {{ Form::text('enpreupazilla', !empty($user) ? $user->enpreupazilla : NULL, ['class' => 'form-control', 'placeholder' => 'District']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" type="submit">Submit</button>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>


    </div>


@endsection

@section('cusjs')
    <link rel="stylesheet" href="{{ URL::asset('public/css/dropzone.min.css') }}">
    <script type="text/javascript" src="{{ URL::asset('public/plugins/dropzone.js') }}"></script>

    <script>
        $("#monthly_income").on("change keyup", function () {
            var sum = $(this).val() * 12;
            $('#yearly_income').val(sum);
            // console.log(sum);
        });

        jQuery(document).ready(function ($) {
            $("#enprewardno").on("change", function () {
                var ward = $("#enprewardno").val();
                $("#bnprewardno").val(ward);
            });

            $("#bnprewardno").on("change", function () {
                var ward = $("#bnprewardno").val();
                $("#enprewardno").val(ward);

            })
        });

    </script>
@endsection
