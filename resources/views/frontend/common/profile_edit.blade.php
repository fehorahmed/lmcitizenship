@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        @include('frontend.common.frontend_user_menu')
        <div class="row">
            <div class="col-md-12">
                @include('frontend.common.message_handler')
            </div>
        </div>


        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#bnGeneralInformation" role="tab" data-toggle="tab"> সাধারণ তথ্যাদি </a>
                    </li>
                    {{-- <li role="presentation" class="">
                        <a href="#bnCurrentAddress" role="tab" data-toggle="tab"> ঠিকানা</a>
                    </li> --}}

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active in" role="tabpanel" id="bnGeneralInformation">
                        <div class="panel panel-default">
                            <div class="panel-heading"> সাধারণ তথ্যাদি </div>
                            <div class="panel-body">
                                <input type="hidden" name="profile_id" value="{{ $user->id }}">

                                <div class="col-md-6">
                                    <div class="form-group required">
                                        <label for="name" class="name cmmone-class">নাম</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Name" value="{{ old('name',$user->name)}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class="phone cmmone-class">মোবাইল</label>
                                        <input type="text" class="form-control" {{ $user->phone ? 'readonly' : '' }}
                                            name="phone" id="phone" placeholder="মোবাইল"
                                            value="{{ old('phone',$user->phone) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="email" class="email cmmone-class">ইমেইল</label>
                                            <input type="email" {{ $user->email ? 'readonly' : '' }} class="form-control"
                                                name="email" id="email" placeholder="ইমেইল"
                                                value="{{ $user->email ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="father_name" class="father_name cmmone-class">পিতার
                                                নাম</label>
                                            <input type="text" class="form-control" name="father_name" id="father_name"
                                                placeholder="পিতার নাম" value="{{ old('father_name',$user->father_name) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="husband_name" class="husband_name cmmone-class"> স্বামীর
                                                নাম</label>
                                            <input type="text" class="form-control" name="husband_name" id="husband_name"
                                                placeholder="স্বামীর নাম" value="{{ old('husband_name',$user->husband_name) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mother_name" class="mother_name cmmone-class">মাতার নাম</label>
                                        <input type="text" class="form-control" name="mother_name" id="mother_name"
                                            placeholder="মাতার নাম" value="{{  old('mother_name',$user->mother_name) }}">
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="passportno" class="passportno cmmone-class">Passport No </label>
                                        <input type="text" class="form-control" name="passportno" id="passportno"
                                            placeholder="Passport No " value="{{ $user->passportno ?? '' }}">
                                    </div>
                                </div> --}}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender" class="gender cmmone-class">Gender
                                        </label>
                                        <select class="form-control" name="gender" id="sel1">
                                            <option value="">Select</option>
                                            <option value="Male" {{ old('gender',$user->gender) == 'Male' ? 'selected' : '' }}>
                                                Male
                                            </option>
                                            <option value="Female" {{ old('gender',$user->gender) == 'Female' ? 'selected' : '' }}>
                                                Female
                                            </option>
                                            <option value="Others" {{ old('gender',$user->gender) == 'Others' ? 'selected' : '' }}>
                                                Others
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="religion" class="religion cmmone-class">ধর্ম
                                        </label>
                                        <select class="form-control " name="religion">
                                            <option value="">Select</option>
                                            <option value="1" {{ @$user->religion == '1' ? 'selected' : '' }}>
                                                Islam
                                            </option>
                                            <option value="2" {{ @$user->religion == '2' ? 'selected' : '' }}>
                                                Hindu
                                            </option>
                                            <option value="3" {{ @$user->religion == '3' ? 'selected' : '' }}>
                                                Buddhist
                                            </option>
                                            <option value="4" {{ @$user->religion == '4' ? 'selected' : '' }}>
                                                Christian
                                            </option>
                                            <option value="5" {{ @$user->religion == '5' ? 'selected' : '' }}>
                                                Others
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="marital_status" class="marital_status cmmone-class">বৈবাহিক অবস্থা
                                        </label>
                                        <select class="form-control " name="marital_status">
                                            <option value="">Select</option>
                                            <option value="Married"
                                                {{ @$user->marital_status == 'Married' ? 'selected' : '' }}>
                                                Married
                                            </option>
                                            <option value="Unmarried"
                                                {{ @$user->marital_status == 'Unmarried' ? 'selected' : '' }}>
                                                Unmarried
                                            </option>
                                            <option value="Divorced"
                                                {{ @$user->marital_status == 'Divorced' ? 'selected' : '' }}>
                                                Divorced
                                            </option>
                                            <option value="Widowed"
                                                {{ @$user->marital_status == 'Widowed' ? 'selected' : '' }}>
                                                Widowed
                                            </option>
                                            <option value="Others"
                                                {{ @$user->marital_status == 'Others' ? 'selected' : '' }}>
                                                Others
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label for="birthday" class="birthday cmmone-class">জন্মদিন
                                        </label>
                                        <input type="date" class="form-control" name="birthday" id="birthday"
                                            placeholder="Birthday " value="{{ $user->date_of_birth ?? '' }}">
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="monthly_income" class="monthly_income cmmone-class">মাসিক আয়
                                        </label>
                                        <input type="number" class="form-control" name="monthly_income"
                                            id="monthly_income" placeholder="মাসিক আয় "
                                            value="{{ $user->monthly_income ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="yearly_income" class="yearly_income cmmone-class">বার্ষিক আয়
                                        </label>
                                        <input type="number" class="form-control" name="yearly_income"
                                            id="yearly_income" placeholder="বার্ষিক আয় "
                                            value="{{ $user->yearly_income ?? '' }}">
                                    </div>
                                </div> --}}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="profession" class="profession cmmone-class">পেশা
                                        </label>
                                        <input type="text" class="form-control" name="profession" id="profession"
                                            placeholder="পেশা " value="{{ $user->profession ?? '' }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="cmmone-class">আপনি কি মুক্তিযোদ্ধার সন্তান?</label>
                                                <span style="padding:10px;">
                                                    <label class="radio-inline"><input type="radio" name="freedomfighters"
                                                            value="1"
                                                            {{ $user->freedomfighters == 1 ? 'checked' : '' }}>হ্যাঁ</label>
                                                    <label class="radio-inline"><input type="radio" name="freedomfighters"
                                                            value="0"
                                                            {{ $user->freedomfighters == 0 ? 'checked' : '' }}>না</label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="cmmone-class">স্থায়ী বাসিন্দা নাকি অস্থায়ী বাসিন্দা ?</label>
                                                <span style="padding:10px;">
                                                    <label class="radio-inline"><input type="radio" name="user_type"
                                                            value="1"
                                                            {{ $user->user_type == 1 ? 'checked' : '' }}>স্থায়ী বাসিন্দা</label>
                                                    <label class="radio-inline"><input type="radio" name="user_type"
                                                            value="0"
                                                            {{ $user->user_type == 0 ? 'checked' : '' }}>অস্থায়ী বাসিন্দা</label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nidno" class="nidno cmmone-class">জাতীয় পরিচয় পত্র</label>
                                                <input type="text" class="form-control" name="nidno" id="nidno"
                                                    placeholder="National ID" value="{{ old('nidno',$user->nid) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="birthcertificateno" class="birthcertificateno cmmone-class">জন্ম সার্টিফিকেট নং
                                                </label>
                                                <input type="text" class="form-control" name="birthcertificateno"
                                                    id="birthcertificateno" placeholder="Birth Certificate No "
                                                    value="{{ old('birthcertificateno',$user->birth_certificate_no) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nid_file" class="nid_file cmmone-class">জাতীয় পরিচয় পত্র ছবি
                                                </label>
                                               <input type="file" name="nid_file" class="form-control" id="nid_file">
                                            </div>
                                            @if (!empty($user->nid_file))
                                                <div class="form-group">
                                                    <div class="ar-profile" style="max-height:80px;max-width:100px;">
                                                        <img src="{{ asset($user->nid_file) }}"
                                                            class="img-thumbnail">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="birth_certificate_file" class="birth_certificate_file cmmone-class">জন্ম সার্টিফিকেট ছবি
                                                </label>
                                               <input type="file" name="birth_certificate_file" class="form-control" id="birth_certificate_file">
                                            </div>
                                            @if (!empty($user->birth_certificate_file))
                                                <div class="form-group">
                                                    <div class="ar-profile" style="max-height:80px;max-width:100px;">
                                                        <img src="{{ asset($user->birth_certificate_file) }}"
                                                            class="img-thumbnail">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="photo" class="picture cmmone-class">ছবি
                                        </label>
                                        <input type="file" class="form-control" name="photo" id="photo"
                                            placeholder="Photo" {{ $user->profile_photo_path ? '' : 'required' }}>

                                    </div>
                                    @if (!empty($user->profile_photo_path))
                                        <div class="form-group">
                                            <div class="ar-profile" style="max-height:100px;max-width:100px;">
                                                <img src="{{ asset($user->profile_photo_path) }}"
                                                    class="img-thumbnail">
                                            </div>
                                        </div>
                                    @endif
                                </div> --}}

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading"> বর্তমান ঠিকানা </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="present_division" class="present_division cmmone-class">বিভাগ
                                            </label>
                                            <select class="form-control" required name="present_division"
                                                id="present_division">
                                                <option value="">Select One</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}"
                                                        {{ old('present_division', $user->division_id) == $division->id ? 'selected' : '' }}>
                                                        {{ $division->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="present_district" class="present_district cmmone-class">জেলা
                                            </label>
                                            <select class="form-control" required name="present_district"
                                                id="present_district">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="present_upazila" class="present_upazila cmmone-class">উপজেলা
                                            </label>
                                            <select class="form-control" required name="present_upazila"
                                                id="present_upazila">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="present_union" class="present_union cmmone-class">উনিয়ন/পৌরসভা
                                            </label>
                                            <select class="form-control" required name="present_union"
                                                id="present_union">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="present_ward" class="present_ward cmmone-class">ওয়ার্ড নং
                                            </label>
                                            <select class="form-control" required name="present_ward"
                                                id="present_ward">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="present_moholla" class="present_moholla cmmone-class">গ্রাম/মহল্লা
                                            </label>
                                            <select class="form-control" required name="present_moholla"
                                                id="present_moholla">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="present_post_office" class="present_post_office cmmone-class">ডাকঘর
                                            </label>
                                            <select class="form-control" required name="present_post_office"
                                                id="present_post_office">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="present_address" class="present_address cmmone-class">মন্তব্য
                                            </label>
                                            <input type="text" class="form-control" name="present_address"
                                                id="present_address" placeholder="Address  "
                                                value="{{ old('present_address', $user->address) }}">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div style="display: flex; justify-content:space-between;" class="panel-heading">
                                        স্থায়ী ঠিকানা
                                        <div style="">
                                            <input type="checkbox" value="1" name="same_as_present"
                                                id="address_same">
                                            <label style="font-weight: 500;" for="address_same">বর্তমান ঠিকানা হিসাবে
                                                একই</label>
                                        </div>
                                        </h5>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">

                                            <label for="permanent_division"
                                                class="permanent_division cmmone-class">বিভাগ</label>
                                            <select class="form-control" name="permanent_division"
                                                id="permanent_division">
                                                <option value="">Select One</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}"
                                                        {{ old('permanent_division', $user->per_division_id) == $division->id ? 'selected' : '' }}>
                                                        {{ $division->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="permanent_district"
                                                class="permanent_district cmmone-class">জেলা
                                            </label>
                                            <select class="form-control" name="permanent_district"
                                                id="permanent_district">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="permanent_upazila" class="permanent_upazila cmmone-class">উপজেলা
                                            </label>
                                            <select class="form-control" name="permanent_upazila" id="permanent_upazila">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="permanent_union" class="permanent_union cmmone-class">উনিয়ন/পৌরসভা
                                            </label>
                                            <select class="form-control" name="permanent_union" id="permanent_union">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="permanent_ward" class="permanent_ward cmmone-class">ওয়ার্ড নং
                                            </label>
                                            <select class="form-control" name="permanent_ward" id="permanent_ward">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="permanent_moholla" class="permanent_moholla cmmone-class">গ্রাম/মহল্লা
                                            </label>
                                            <select class="form-control" name="permanent_moholla" id="permanent_moholla">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="permanent_post_office" class="permanent_post_office cmmone-class">ডাকঘর
                                            </label>
                                            <select class="form-control" name="permanent_post_office" id="permanent_post_office">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="permanent_address"
                                                class="permanent_address cmmone-class">মন্তব্য</label>
                                            <input type="text" class="form-control" name="permanent_address"
                                                id="permanent_address" placeholder="Address"
                                                value="{{ old('permanent_address', $user->per_address) }}">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- <div class="tab-pane fade" role="tabpanel" id="bnCurrentAddress" aria-labelledby="profile-tab">

                    </div> --}}
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group text-center">
                    <button class="btn btn-info" type="submit">Update</button>
                </div>
            </div>
        </form>

    </div>
@endsection

@section('cusjs')
    {{-- <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">
    <script type="text/javascript" src="{{ asset('plugins/dropzone.js') }}"></script> --}}

    <script>
        $("#monthly_income").on("change keyup", function() {
            var sum = $(this).val() * 12;
            $('#yearly_income').val(sum);
            // console.log(sum);
        });
        $(function() {
            $('#address_same').change(function() {
                if ($(this).prop('checked')) {
                    $('#permanent_division').prop('disabled', true);
                    $('#permanent_division').prop('required', false);
                    $('#permanent_district').prop('disabled', true);
                    $('#permanent_district').prop('required', false);
                    $('#permanent_upazila').prop('disabled', true);
                    $('#permanent_upazila').prop('required', false);

                    $('#permanent_union').prop('disabled', true);
                    $('#permanent_union').prop('required', false);
                    $('#permanent_ward').prop('disabled', true);
                    $('#permanent_ward').prop('required', false);
                    $('#permanent_moholla').prop('disabled', true);
                    $('#permanent_moholla').prop('required', false);

                    $('#permanent_post_office').prop('disabled', true);
                    $('#permanent_post_office').prop('required', false);

                    $('#permanent_address').prop('disabled', true);
                   // $('#permanent_address').prop('required', false);

                } else {
                    $('#permanent_division').prop('disabled', false);
                    $('#permanent_division').prop('required', true);
                    $('#permanent_district').prop('disabled', false);
                    $('#permanent_district').prop('required', true);
                    $('#permanent_upazila').prop('disabled', false);
                    $('#permanent_upazila').prop('required', true);

                    $('#permanent_union').prop('disabled', false);
                    $('#permanent_union').prop('required', true);
                    $('#permanent_ward').prop('disabled', false);
                    $('#permanent_ward').prop('required', true);
                    $('#permanent_moholla').prop('disabled', false);
                    $('#permanent_moholla').prop('required', true);

                    $('#permanent_post_office').prop('disabled', false);
                    $('#permanent_post_office').prop('required', true);

                    $('#permanent_address').prop('disabled', false);
                  //  $('#permanent_address').prop('required', true);
                }
            });

            $('#address_same').trigger('change');

            var districtSelected = '{{ old('permanent_district', $user->per_district_id) }}'
            $('#permanent_division').on('change', function() {
                var division_id = $(this).val();
                $('#permanent_district').html('<option value="">Select district</option>');

                $.ajax({
                    method: "GET",
                    url: '{{ route('get.district') }}',
                    data: {
                        division_id: division_id
                    }
                }).done(function(data) {
                    $.each(data, function(index, item) {
                        if (districtSelected == item.id) {
                            $('#permanent_district').append('<option selected value="' +
                                item.id +
                                '" selected>' + item.name + '</option>');
                        } else {
                            $('#permanent_district').append('<option value="' + item.id +
                                '">' + item
                                .name + '</option>');
                        }
                    });

                    $('#permanent_district').trigger('change');
                });

            });

            // personal address
            $('#permanent_division').trigger('change');
            var subDistrictSelected = '{{ old('permanent_upazila', $user->per_sub_district_id) }}';
            $('#permanent_district').on('change', function() {
                var district_id = $(this).val();
                $('#permanent_upazila').html('<option value="">Select sub district</option>');
                if (district_id != '' && district_id != null) {
                    $.ajax({
                        method: "GET",
                        url: '{{ route('get.sub_district') }}',
                        data: {
                            district_id: district_id
                        }
                    }).done(function(data) {
                        $.each(data, function(index, item) {
                            if (subDistrictSelected == item.id) {
                                $('#permanent_upazila').append('<option selected value="' +
                                    item
                                    .id +
                                    '" selected>' + item.name + '</option>');
                            } else {
                                $('#permanent_upazila').append('<option value="' + item.id +
                                    '">' +
                                    item.name + '</option>');
                            }
                        });
                        $('#permanent_upazila').trigger('change');
                    });
                }
            });
            $('#permanent_district').trigger('change');

            var per_unionSelected = '{{ old('permanent_union', $user->per_union_id) }}';
            var per_postOfficeSelected = '{{ old('permanent_post_office', $user->per_post_office_id) }}';
            $('#permanent_upazila').on('change', function() {
                var sub_district_id = $(this).val();
                $('#permanent_union').html('<option value="">Select union</option>');
                $('#permanent_post_office').html('<option value="">Select union</option>');
                if (sub_district_id != '' && sub_district_id != null) {
                    $.ajax({
                        method: "GET",
                        url: '{{ route('get.unions') }}',
                        data: {
                            sub_district_id: sub_district_id
                        }
                    }).done(function(data) {
                        $.each(data, function(index, item) {
                            if (per_unionSelected == item.id) {
                                $('#permanent_union').append('<option selected value="' +
                                    item
                                    .id +
                                    '" selected>' + item.name + '</option>');
                            } else {
                                $('#permanent_union').append('<option value="' + item.id +
                                    '">' +
                                    item.name + '</option>');
                            }
                        });
                        $('#permanent_union').trigger('change');
                    });
                    //Post Office
                    $.ajax({
                        method: "GET",
                        url: '{{ route('get.post-offices') }}',
                        data: {
                            sub_district_id: sub_district_id
                        }
                    }).done(function(data) {
                        $.each(data, function(index, item) {
                            if (per_postOfficeSelected == item.id) {
                                $('#permanent_post_office').append('<option selected value="' +
                                    item
                                    .id +
                                    '" selected>' + item.name + '</option>');
                            } else {
                                $('#permanent_post_office').append('<option value="' + item.id +
                                    '">' +
                                    item.name + '</option>');
                            }
                        });
                        $('#permanent_post_office').trigger('change');
                    });
                }
            });
            $('#permanent_upazila').trigger('change');
            var per_wardSelected = '{{ old('permanent_ward', $user->per_ward_id) }}';
            $('#permanent_union').on('change', function() {
                var union_id = $(this).val();
                $('#permanent_ward').html('<option value="">Select ward</option>');
                if (union_id != '' && union_id != null) {
                    $.ajax({
                        method: "GET",
                        url: '{{ route('get.wards') }}',
                        data: {
                            union_id: union_id
                        }
                    }).done(function(data) {
                        $.each(data, function(index, item) {
                            if (per_wardSelected == item.id) {
                                $('#permanent_ward').append('<option selected value="' +
                                    item
                                    .id +
                                    '" selected>' + item.name + '</option>');
                            } else {
                                $('#permanent_ward').append('<option value="' + item.id +
                                    '">' +
                                    item.name + '</option>');
                            }
                        });
                        $('#permanent_ward').trigger('change');
                    });
                }
            });
            $('#permanent_union').trigger('change');


            var per_mohollaSelected = '{{ old('permanent_moholla', $user->per_moholla_id) }}';
            $('#permanent_ward').on('change', function() {
                var ward_id = $(this).val();
                $('#permanent_moholla').html('<option value="">Select Moholla</option>');
                if (ward_id != '' && ward_id != null) {
                    $.ajax({
                        method: "GET",
                        url: '{{ route('get.mohollas') }}',
                        data: {
                            ward_id: ward_id
                        }
                    }).done(function(data) {
                        $.each(data, function(index, item) {
                            if (per_mohollaSelected == item.id) {
                                $('#permanent_moholla').append('<option selected value="' +
                                    item
                                    .id +
                                    '" selected>' + item.name + '</option>');
                            } else {
                                $('#permanent_moholla').append('<option value="' + item.id +
                                    '">' +
                                    item.name + '</option>');
                            }
                        });
                        $('#permanent_moholla').trigger('change');
                    });
                }
            });
            $('#permanent_ward').trigger('change');

            //Permanent End

            //Present /////////////
            var pre_districtSelected = '{{ old('present_district', $user->district_id) }}'
            $('#present_division').on('change', function() {

                var division_id = $(this).val();
                $('#present_district').html('<option value="">Select district</option>');

                $.ajax({
                    method: "GET",
                    url: '{{ route('get.district') }}',
                    data: {
                        division_id: division_id
                    }
                }).done(function(data) {
                    $.each(data, function(index, item) {
                        if (pre_districtSelected == item.id) {
                            $('#present_district').append('<option selected value="' + item
                                .id +
                                '" selected>' + item.name + '</option>');
                        } else {
                            $('#present_district').append('<option value="' + item.id +
                                '">' + item
                                .name + '</option>');
                        }
                    });

                    $('#present_district').trigger('change');
                });

            });

            // personal address
            $('#present_division').trigger('change');
            var pre_subDistrictSelected = '{{ old('present_upazila', $user->sub_district_id) }}';
            $('#present_district').on('change', function() {
                var district_id = $(this).val();
                $('#present_upazila').html('<option value="">Select sub district</option>');
                if (district_id != '' && district_id != null) {
                    $.ajax({
                        method: "GET",
                        url: '{{ route('get.sub_district') }}',
                        data: {
                            district_id: district_id
                        }
                    }).done(function(data) {
                        $.each(data, function(index, item) {
                            if (pre_subDistrictSelected == item.id) {
                                $('#present_upazila').append('<option selected value="' +
                                    item
                                    .id +
                                    '" selected>' + item.name + '</option>');
                            } else {
                                $('#present_upazila').append('<option value="' + item.id +
                                    '">' +
                                    item.name + '</option>');
                            }
                        });
                        $('#present_upazila').trigger('change');
                    });
                }
            });
            $('#present_district').trigger('change');

            var pre_unionSelected = '{{ old('present_union', $user->union_id) }}';
            var pre_postOfficeSelected = '{{ old('present_post_office', $user->post_office_id) }}';
            $('#present_upazila').on('change', function() {
                var sub_district_id = $(this).val();
                $('#present_union').html('<option value="">Select union</option>');
                $('#present_post_office').html('<option value="">Select union</option>');
                if (sub_district_id != '' && sub_district_id != null) {
                    $.ajax({
                        method: "GET",
                        url: '{{ route('get.unions') }}',
                        data: {
                            sub_district_id: sub_district_id
                        }
                    }).done(function(data) {
                        $.each(data, function(index, item) {
                            if (pre_unionSelected == item.id) {
                                $('#present_union').append('<option selected value="' +
                                    item
                                    .id +
                                    '" selected>' + item.name + '</option>');
                            } else {
                                $('#present_union').append('<option value="' + item.id +
                                    '">' +
                                    item.name + '</option>');
                            }
                        });
                        $('#present_union').trigger('change');
                    });
                    //Post Office
                    $.ajax({
                        method: "GET",
                        url: '{{ route('get.post-offices') }}',
                        data: {
                            sub_district_id: sub_district_id
                        }
                    }).done(function(data) {
                        $.each(data, function(index, item) {
                            if (pre_postOfficeSelected == item.id) {
                                $('#present_post_office').append('<option selected value="' +
                                    item
                                    .id +
                                    '" selected>' + item.name + '</option>');
                            } else {
                                $('#present_post_office').append('<option value="' + item.id +
                                    '">' +
                                    item.name + '</option>');
                            }
                        });
                        $('#present_post_office').trigger('change');
                    });
                }
            });
            $('#present_upazila').trigger('change');
            var pre_wardSelected = '{{ old('present_ward', $user->ward_id) }}';
            $('#present_union').on('change', function() {
                var union_id = $(this).val();
                $('#present_ward').html('<option value="">Select ward</option>');
                if (union_id != '' && union_id != null) {
                    $.ajax({
                        method: "GET",
                        url: '{{ route('get.wards') }}',
                        data: {
                            union_id: union_id
                        }
                    }).done(function(data) {
                        $.each(data, function(index, item) {
                            if (pre_wardSelected == item.id) {
                                $('#present_ward').append('<option selected value="' +
                                    item
                                    .id +
                                    '" selected>' + item.name + '</option>');
                            } else {
                                $('#present_ward').append('<option value="' + item.id +
                                    '">' +
                                    item.name + '</option>');
                            }
                        });
                        $('#present_ward').trigger('change');
                    });
                }
            });
            $('#present_union').trigger('change');


            var pre_mohollaSelected = '{{ old('present_moholla', $user->moholla_id) }}';
            $('#present_ward').on('change', function() {
                var ward_id = $(this).val();
                $('#present_moholla').html('<option value="">Select Moholla</option>');
                if (ward_id != '' && ward_id != null) {
                    $.ajax({
                        method: "GET",
                        url: '{{ route('get.mohollas') }}',
                        data: {
                            ward_id: ward_id
                        }
                    }).done(function(data) {
                        $.each(data, function(index, item) {
                            if (pre_mohollaSelected == item.id) {
                                $('#present_moholla').append('<option selected value="' +
                                    item
                                    .id +
                                    '" selected>' + item.name + '</option>');
                            } else {
                                $('#present_moholla').append('<option value="' + item.id +
                                    '">' +
                                    item.name + '</option>');
                            }
                        });
                        $('#present_moholla').trigger('change');
                    });
                }
            });
            $('#present_ward').trigger('change');

        });
    </script>
@endsection
