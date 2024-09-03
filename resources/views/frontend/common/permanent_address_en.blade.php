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
                        <div class="panel-heading">Permanent Address (In English)</div>
                        {{ Form::open(array('url' => '/permanent_address_en', 'method' => 'post', 'value' => 'PATCH', 'id' => 'general_info_en')) }}
                        <div class="panel-body">

                            @include('frontend.common.message_handler')
                            {{ Form::hidden('profile_id', $user->id, ['required']) }}
                            <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            {{ Form::label('holding_no_en', ' Holding Number ', array('class' => 'holding_no_en cmmone-class')) }}
                                            {{ Form::text('holding_no_en', !empty($user) ? $user->enparholdingno : NULL, ['class' => 'form-control', 'placeholder' => 'Holding Number ']) }}
                                        </div>
                                    </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {{ Form::label('village_en', ' Village  ', array('class' => 'village_en cmmone-class')) }}
                                        {{ Form::text('village_en', !empty($user) ? $user->enparvillage : NULL, ['required', 'class' => 'form-control', 'placeholder' => ' Village  ']) }}
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {{ Form::label('union_en', 'Union ', array('class' => 'union_en cmmone-class')) }}
                                        {{ Form::text('union_en',  !empty($user) ? $user->enpreroad : NULL, ['class' => 'form-control', 'placeholder' => ' Union ']) }}
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {{ Form::label('ward_no_en', ' Ward No  ', array('class' => 'ward_no_en cmmone-class')) }}
                                        {{ Form::text('ward_no_en', !empty($user) ? $user->enparwardno : NULL, ['class' => 'form-control', 'placeholder' => 'Ward No ']) }}
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {{ Form::label('post_office_en', ' Post Office  ', array('class' => 'post_office_en cmmone-class')) }}
                                        {{ Form::text('post_office_en', !empty($user) ? $user->enparpostoffice : NULL, ['class' => 'form-control', 'placeholder' => ' Post Office  ']) }}
                                    </div>
                                </div>


                                <div class="col-xs-6">
                                    <div class="form-group">
                                    <?php $divisions = DB::table('districts')->distinct()->select('division')->get(); ?>
                                    {{ Form::label('division', 'Divisions', array('class' => 'upazilla_en cmmone-class')) }}
                                    <select name="division_en" id="division" class="form-control">
                                        <option>Choose a division</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->division }}">{{ $division->division }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>

                                <div class="col-xs-6">
                                        <div class="form-group">
                                    {{ Form::label('district_en', ' District ', array('class' => 'district_en cmmone-class  ')) }}
                                    <select name="district_en" id="district" class="form-control" readonly="readonly">
                                        <option value="{{ $user->enpardistrict }}">
                                            {{ $user->enpardistrict }}
                                        </option>
                                    </select>
                                        </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {{ Form::label('upazilla_en', 'Upazila / Thana', array('class' => 'upazilla_en cmmone-class')) }}
                                        <select name="upazilla_en" id="thana" class="form-control" readonly="readonly">
                                            <option value="{{ $user->enparupazilla }}">
                                                {{ $user->enparupazilla }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::submit(' Update ', ['class' => 'btn btn-success', 'name' => 'submit']) }}
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