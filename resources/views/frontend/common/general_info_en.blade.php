@extends('frontend.layouts.app')

@section('content')
    <div class="container user_panel">
        @include('frontend.common.frontend_user_menu')
        <?php
        if (!empty(request()->get('id'))) {
            $user = \App\User::where('id', request()->get('id'))->get()->first();
            //dd($user);
        } else {
            $user = Auth::user();
        }
        ?>
        <div class="row">
            <div class="col-md-12">

                <p>
                    আপনি {{ $user->name }} এর প্রোফাইলের তথ্যাদি হালনাগাদ করছেন
                </p>
            </div>
        </div>

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
                        <div class="panel-heading"> General information (In English)</div>
                        {{ Form::open(array('url' => '/general_info_en', 'method' => 'post', 'value' => 'PATCH', 'id' => 'general_info_en','enctype' => 'multipart/form-data')) }}
                        <div class="panel-body">

                            @include('frontend.common.message_handler')
                            {{ Form::hidden('profile_id', $user->id, ['required']) }}
                            <div class="form-group">
                                {{ Form::label('name_en', ' Name  ', array('class' => 'name_en cmmone-class')) }}
                                {{ Form::text('name_en', !empty($user) ? @$user->name : NULL, ['required', 'class' => 'form-control', 'placeholder' => ' Name  ']) }}
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {{ Form::label('father_name_en', ' Father\'s name  ', array('class' => 'father_name_en cmmone-class')) }}
                                        {{ Form::text('father_name_en', !empty($user) ? @$user->enfathername : NULL, ['class' => 'form-control', 'placeholder' => ' Father\'s name  ']) }}
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {{ Form::label('mother_name_en', ' Mother\'s name  ', array('class' => 'mother_name_en cmmone-class')) }}
                                        {{ Form::text('mother_name_en', !empty($user) ? @$user->enmothername : NULL, ['class' => 'form-control', 'placeholder' => ' Mother\'s name']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        {{ Form::label('nid_en', ' National ID ', array('class' => 'nid_en cmmone-class')) }}
                                        {{ Form::text('nid_en', !empty($user) ? @$user->nidno : NULL, ['required', 'class' => 'form-control', 'placeholder' => ' National ID ']) }}
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        {{ Form::label('passport_no', ' Passport No ', array('class' => 'passport_no cmmone-class')) }}
                                        {{ Form::text('passport_no', !empty($user) ? @$user->passportno : NULL, ['class' => 'form-control', 'placeholder' => ' Passport No ']) }}
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        {{ Form::label('birthcertificateno', ' Birth Certificate No ', array('class' => 'birthcertificateno cmmone-class')) }}
                                        {{ Form::text('birthcertificateno', !empty($user) ? @$user->birthcertificateno : NULL, ['class' => 'form-control', 'placeholder' => '  Birth Certificate No ']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        {{ Form::label('gender', ' Gender ', array('class' => 'gender cmmone-class')) }}
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
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        {{ Form::label('religion', ' Religion ', array('class' => 'religion cmmone-class')) }}
                                        <select class="form-control " name="religion">
                                            <option value="">Select</option>
                                            <option value="Islam" {{(@$user->religion == 'Islam') ? 'selected' : ''}}>
                                                Islam
                                            </option>
                                            <option value="Hindu" {{(@$user->religion == 'Hindu') ? 'selected' : ''}}>
                                                Hindu
                                            </option>
                                            <option value="Buddhist" {{(@$user->religion == 'Buddhist') ? 'selected' : ''}}>
                                                Buddhist
                                            </option>
                                            <option value="Christian" {{(@$user->religion == 'Christian') ? 'selected' : ''}}>
                                                Christian
                                            </option>
                                            <option value="Others" {{(@$user->religion == 'Others') ? 'selected' : ''}}>
                                                Others
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        {{ Form::label('marital_status', ' Marital Status ', array('class' => 'religion cmmone-class')) }}
                                        <select class="form-control " name="marital_status">
                                            <option value="">Select</option>
                                            <option value="Married" {{(@$user->marital_status == 'Married') ? 'selected' : ''}}>
                                                Married
                                            </option>
                                            <option value="Unmarried" {{(@$user->marital_status == 'Unmarried') ? 'selected' : ''}}>
                                                Unmarried
                                            </option>
                                            <option value="Divorced" {{(@$user->marital_status == 'Divorced') ? 'selected' : ''}}>
                                                Divorced
                                            </option>
                                            <option value="Widowed" {{(@$user->marital_status == 'Widowed') ? 'selected' : ''}}>
                                                Widowed
                                            </option>
                                            <option value="Others" {{(@$user->marital_status == 'Others') ? 'selected' : ''}}>
                                                Others
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        {{ Form::label('birthday', ' Birthday ', array('class' => 'birthday cmmone-class')) }}
                                        {{ Form::date('birthday', !empty($user) ? @$user->birthday : NULL, ['id' => 'date', 'class' => 'form-control', 'placeholder' => '  Birthday ']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        {{ Form::label('picture', ' Photo ', array('class' => 'picture cmmone-class')) }}
                                        {{ Form::hidden('picture', !empty($user) ? @$user->photo : NULL, ['required', 'class' => 'form-control', 'placeholder' => ' Photo ']) }}
                                    </div>

                                    <?php if(!empty($user->photo)) : ?>
                                    <div class="form-group">
                                        <div class="ar-profile">
                                            <img src="{{ url(!empty($user->photo) ? @$user->photo : NULL) }}"/>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <input type="file" id="upload_police" name="profile_photo">
                                    </div>
                                </div>
                                {{--<div class="col-xs-6">--}}
                                {{--<div class="form-group">--}}
                                {{--{{ Form::label('service_type', 'সেবা', array('class' => 'service_type')) }}--}}
                                {{--{{ Form::text('service_type', NULL, ['class' => 'form-control', 'placeholder' => 'সেবা']) }}--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </div>
                            <div class="form-group">
                                {{ Form::submit('Update', ['class' => 'btn btn-success', 'name' => 'submit']) }}
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
    <link rel="stylesheet" href="{{ URL::asset('public/css/dropzone.min.css') }}">
    <script type="text/javascript" src="{{ URL::asset('public/plugins/dropzone.js') }}"></script>

@endsection