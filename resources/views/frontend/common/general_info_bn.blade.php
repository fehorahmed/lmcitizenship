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
                        <div class="panel-heading"> সাধারণ তথ্যাদি ( বাংলাতে )</div>
                        {{ Form::open(array('url' => '/general_info_bn', 'method' => 'post', 'value' => 'PATCH', 'id' => 'general_info_en')) }}
                        <div class="panel-body">

                            @include('frontend.common.message_handler')
                            {{ Form::hidden('profile_id', $user->id, ['required']) }}
                            <div class="form-group">
                                {{ Form::label('name_bn', ' নাম ', array('class' => 'name_bn cmmone-class')) }}
                                {{ Form::text('name_bn', !empty($user) ? $user->bnname : NULL, ['required', 'class' => 'form-control', 'placeholder' => ' নাম ']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('father_name_bn', ' পিতার নাম ', array('class' => 'father_name_bn cmmone-class')) }}
                                {{ Form::text('father_name_bn', !empty($user) ? $user->bnfathername : NULL, ['class' => 'form-control', 'placeholder' => ' পিতার নাম ']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('mother_name_bn', ' মাতার নাম ', array('class' => 'mother_name_bn cmmone-class')) }}
                                {{ Form::text('mother_name_bn', !empty($user) ? $user->bnmothername : NULL, ['class' => 'form-control', 'placeholder' => ' মাতার নাম ']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('monthly_income', ' মাসিক আয়  ', array('class' => 'monthly_income cmmone-class')) }}
                                {{ Form::text('monthly_income', !empty($user) ? $user->monthly_income : NULL, ['class' => 'form-control', 'placeholder' => ' মাসিক আয় ', 'id' => 'monthly_income']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('yearly_income', ' বার্ষিক আয় ', array('class' => 'yearly_income cmmone-class')) }}
                                {{ Form::text('yearly_income', !empty($user) ? $user->yearly_income : NULL, ['class' => 'form-control', 'placeholder' => ' বার্ষিক আয় ', 'id' => 'yearly_income', 'disabled' => 'disabled']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Profession', ' পেশা ', array('class' => 'profession cmmone-class')) }}
                                {{ Form::text('bnprofession', !empty($user) ? $user->bnprofession : NULL, ['class' => 'form-control', 'placeholder' => ' পেশা ']) }}
                            </div>
                            <div class="form-group">
                                <label class="cmmone-class">আপনি কি ভূমিহীন?</label>
                                <span style="padding:10px;">
                                    <label class="radio-inline"><input type="radio" name="landless" value="1" {{ $user->landless == 1 ? 'checked' : '' }}>হ্যাঁ</label>
                                    <label class="radio-inline"><input type="radio" name="landless" value="0" {{ $user->landless == 0 ? 'checked' : '' }}>না</label>
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="cmmone-class">আপনি কি নদী ভাঙ্গনের আয়তায় পড়েছেন?</label>
                                <span style="padding:10px;">
                                    <label class="radio-inline"><input type="radio" name="rivercorrosion" value="1" {{ $user->rivercorrosion == 1 ? 'checked' : '' }}>হ্যাঁ</label>
                                    <label class="radio-inline"><input type="radio" name="rivercorrosion" value="0" {{ $user->rivercorrosion == 0 ? 'checked' : '' }}>না</label>
                                </span>
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
    <link rel="stylesheet" href="{{ URL::asset('public/css/dropzone.min.css') }}">
    <script>
    $("#monthly_income").on("change keyup", function() {
        var sum = $(this).val() * 12;
        $('#yearly_income').val(sum);
        // console.log(sum);
    });
</script>
@endsection
