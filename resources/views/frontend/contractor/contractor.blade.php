@extends('frontend.layouts.app')
@section('content')

    <div class="container user_panel">


        @if (Route::has('login'))

            <div class="contractor_apply">
                {{Form::open(array('url' => 'contractor_apply_submit', 'method' => 'post', 'class' => 'form-horizontal','files'=>'true'))}}
                <h2>তালিকাভূক্তি / তালিকাভূক্তি নবায়নের আবেদন</h2>

                <div class="form-group">
                    {{ Form::label('reg_notification_no', 'তালিকাভুক্তি বিজ্ঞপ্তি নংঃ', array('class' => 'reg_notification_no col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::text('reg_notification_no', NULL, ['id' => null,  'class' => 'form-control reg_notification_no', 'placeholder' => 'তালিকাভুক্তি বিজ্ঞপ্তি নং...']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('application_type', 'আবেদনের ধরণঃ', array('class' => 'application_type col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        <div class="radio">
                            <label>
                                {{ Form::radio('application_type', 'New', true) }} প্রথমবার আবেদন

                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                {{ Form::radio('application_type', 'Renewal', false )}} নবায়নের আবেদন
                            </label>
                        </div>

                    </div>
                </div>
                <h3><span>আবেদনকারীর তথ্যঃ</span></h3>
                <div class="form-group">
                    {{ Form::label('applicant_name', 'আবেদনকারীর প্রকৃত নামঃ', array('class' => 'applicant_name col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::text('applicant_name', NULL, ['id' => null,  'class' => 'form-control applicant_name', 'placeholder' => 'আবেদনকারীর প্রকৃত নামঃ..']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('applicant_structural', 'আবেদনকারীর গাঠনিক প্রকৃতিঃ', array('class' => 'applicant_structural col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        <div class="radio">
                            <label>
                                {{ Form::radio('applicant_structural', 'Proprietorship', true) }} প্রোপ্রিয়েটরশীপ

                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                {{ Form::radio('applicant_structural', 'Partnerships', false) }} পার্টনারশীপ
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                {{ Form::radio('applicant_structural', 'Private Ltd', false) }} প্রাইভেট লিঃ

                            </label>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('date_of_creation', 'গঠনের তারিখঃ ', array('class' => 'date_of_creation col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::text('date_of_creation', NULL, ['id' => 'date_of_creation',  'class' => 'form-control date_of_creation', 'placeholder' => 'গঠনের তারিখঃ ..']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('business_address', 'ব্যাবসায়িক / পত্র যোগাযোগের ঠিকানাঃ ', array('class' => 'shop_ownner col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text" id="rent_amount_co">গ্রামঃ/রাস্তাঃ</div>
                                    </div>
                                    {{ Form::text('business_address[village]', null, ['required', 'class' => 'form-control', 'placeholder' => 'গ্রাম/রাস্তা....', ]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text" id="rent_amount_co"> পোস্ট অফিসঃ</div>
                                    </div>
                                    {{ Form::text('business_address[post_office]', null, ['required', 'class' => 'form-control', 'placeholder' => 'পোস্ট অফিস...', ]) }}
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text" id="rent_amount_co"> উপজেলাঃ</div>
                                    </div>
                                    {{ Form::text('business_address[upazila]', null, ['required', 'class' => 'form-control', 'placeholder' => 'উপজেলা...', ]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text" id="rent_amount_co"> জেলাঃ</div>
                                    </div>
                                    {{ Form::text('business_address[district]', null, ['required', 'class' => 'form-control', 'placeholder' => 'জেলা...', ]) }}
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text"> পোস্ট কোডঃ</div>
                                    </div>
                                    {{ Form::text('business_address[postcode]', null, [ 'class' => 'form-control', 'placeholder' => 'পোস্ট কোড...', ]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text"> টেলিফোনঃ</div>
                                    </div>
                                    {{ Form::text('business_address[telephone]', null, ['class' => 'form-control', 'placeholder' => 'টেলিফোন...', ]) }}
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text"> ফ্যাক্সঃ</div>
                                    </div>
                                    {{ Form::number('business_address[fax]', null, ['class' => 'form-control', 'placeholder' => ' ফ্যাক্স..', ]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text"> ই-মেইলঃ</div>
                                    </div>
                                    {{ Form::number('business_address[email]', null, ['class' => 'form-control', 'placeholder' => 'টই-মেইল...', ]) }}
                                </div>
                            </div>

                        </div>


                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('vat_reg_number', ' ভ্যাট রেজিস্ট্রেশন নম্বরঃ  ', array('class' => 'vat_reg_number col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::text('vat_reg_number', NULL, ['id' => 'vat_reg_number', 'class' => 'form-control vat_reg_number', 'placeholder' => ' ভ্যাট রেজিস্ট্রেশন নম্বর....']) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('tin_no', ' টিআইএনঃ  ', array('class' => 'tin_no col-sm-3 control-label')) }}
                    <div class="col-sm-9">
                        {{ Form::text('tin_no', NULL, ['id' => 'tin_no',  'class' => 'form-control tin_no', 'placeholder' => ' টিআইএন ...']) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('managing_director', 'স্বত্তাধিকারি/ ব্যাবস্থাপনা পরিচালকঃ  ', array('class' => 'managing_director col-sm-3 control-label')) }}

                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text">নামঃ</div>
                                    </div>
                                    {{ Form::number('managing_director[name]', null, ['required', 'class' => 'form-control', 'placeholder' => 'নাম...', ]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">

                                    {{ Form::radio('managing_director[gender]', 'Male', true) }} পুরুষ
                                    {{ Form::radio('managing_director[gender]', 'Female', false) }} নারী
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text"> পিতার নামঃ</div>
                                    </div>
                                    {{ Form::number('managing_director[father_name]', null, ['required', 'class' => 'form-control', 'placeholder' => 'পিতার নাম...', ]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text"> মাতার নামঃ</div>
                                    </div>
                                    {{ Form::number('managing_director[mother_name]', null, ['required', 'class' => 'form-control', 'placeholder' => 'মাতার নাম...', ]) }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text"> বয়সঃ</div>
                                    </div>
                                    {{ Form::number('managing_director[age]', null, ['required', 'class' => 'form-control', 'placeholder' => 'বয়স...', ]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text"> শিকক্ষাগত যোগ্যতাঃ</div>
                                    </div>
                                    {{ Form::number('managing_director[education]', null, ['required', 'class' => 'form-control', 'placeholder' => 'শিকক্ষাগত যোগ্যতাঃ..', ]) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text"> জাতীয় পরিচয়পত্র (যদি থাকে)
                                        </div>
                                    </div>
                                    {{ Form::number('managing_director[nid]', null, ['class' => 'form-control', 'placeholder' => 'জাতীয় পরিচয়পত্র (যদি থাকে)..', ]) }}
                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('detailed_contact', 'বিস্তারিত যোগাযোগঃ  ', array('class' => 'detailed_contact col-sm-3 control-label')) }}

                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text"> টেলিফোনঃ</div>
                                    </div>
                                    {{ Form::text('detailed_contact[telephon]', null, ['required', 'class' => 'form-control', 'placeholder' => 'টেলিফোন...', ]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text"> ফ্যাক্সঃ</div>
                                    </div>
                                    {{ Form::text('detailed_contact[fax]', null, ['required', 'class' => 'form-control', 'placeholder' => 'ফ্যাক্স..', ]) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text"> ই-মেইলঃ</div>
                                    </div>
                                    {{ Form::email('detailed_contact[email]', null, [ 'class' => 'form-control', 'placeholder' => 'ই-মেইল...', ]) }}
                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>


                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('bank_description', 'ব্যাংক হিসাবের বর্ণনাঃ  ', array('class' => 'shop_ownner col-sm-3 control-label')) }}

                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text"> ব্যাংকার নামঃ</div>
                                    </div>
                                    {{ Form::number('bank_description[bank_name]', null, ['required', 'class' => 'form-control', 'placeholder' => 'ব্যাংকার নাম...', ]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text"> ব্রাঞ্চঃ</div>
                                    </div>
                                    {{ Form::number('bank_description[bank_branch]', null, ['required', 'class' => 'form-control', 'placeholder' => 'ব্রাঞ্চ...', ]) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group" style="margin-bottom: 5px">
                                    <div class="input-group-addon" style="min-width: 165px">
                                        <div class="input-group-text"> একাউন্ট নংঃ</div>
                                    </div>
                                    {{ Form::number('bank_description[bank_account]', null, ['required', 'class' => 'form-control', 'placeholder' => 'একাউন্ট নং..', ]) }}
                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>


                    </div>
                </div>

                <h3><span>আবেদনকারীর অন্যান্য তথ্যঃ </span></h3>

                <div class="form-group">
                    {{ Form::label('applicant_nature', 'আবেদনকারীর প্রকৃতিঃ  ', array('class' => 'shop_ownner col-sm-3 control-label')) }}

                    <div class="col-sm-9">


                        <div class="input-group" style="margin-bottom: 5px">
                            {{ Form::checkbox('applicant_nature[type]', 'Bridge', false) }} পূর্ত ( নির্মাণ, সংস্কার,
                            কায়িক
                            সেবা )
                        </div>
                        <div class="input-group" style="margin-bottom: 5px">
                            {{ Form::checkbox('applicant_nature[type]', 'Mechanical', false) }} যান্ত্রিক
                        </div>
                        <div class="input-group" style="margin-bottom: 5px">
                            {{ Form::checkbox('applicant_nature[type]', 'Electrical', false) }} ইলেক্ট্রিক্যাল
                        </div>
                        <div class="input-group" style="margin-bottom: 5px">
                            {{ Form::checkbox('applicant_nature[type]', 'Others', false) }} অন্যান্য / বিবিধ
                            {{ Form::number('applicant_nature[note]', null, [ 'class' => 'form-control', 'placeholder' => 'অন্যান্য / বিবিধ..', ]) }}
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('number_of_employees', 'কর্মী সংখ্যাঃ  ', array('class' => 'number_of_employees col-sm-3 control-label')) }}

                    <div class="col-sm-9">
                        [মুখ্য জনবল, কারিগরী জনবলের জীবন বৃত্তান্ত]


                        <div class="input-group" style="margin-bottom: 5px">
                            <div class="input-group-addon" style="min-width: 165px">
                                <div class="input-group-text">কারিগরীঃ</div>
                            </div>
                            {{ Form::number('number_of_employees[technical]', null, ['required', 'class' => 'form-control', 'placeholder' => 'কারিগরী...', ]) }}
                        </div>
                        <div class="input-group" style="margin-bottom: 5px">
                            <div class="input-group-addon" style="min-width: 165px">
                                <div class="input-group-text"> সহযোগী স্টাফঃ</div>
                            </div>
                            {{ Form::number('number_of_employees[associate_staff]', null, ['required', 'class' => 'form-control', 'placeholder' => 'সহযোগী স্টাফ...', ]) }}
                        </div>
                        <div class="input-group" style="margin-bottom: 5px">
                            <div class="input-group-addon" style="min-width: 165px">
                                <div class="input-group-text"> অন্যান্যঃ</div>
                            </div>
                            {{ Form::number('number_of_employees[other]', null, ['required', 'class' => 'form-control', 'placeholder' => 'অন্যান্য...', ]) }}
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('shop_witch_type', 'নির্মাণ যন্ত্রপাতি ( যদি থাকে )  ', array('class' => 'shop_ownner col-sm-3 control-label')) }}

                    <div class="col-sm-9">
                        <div>
                            <table class="table">

                                <thead>
                                <tr>
                                    <th>নং</th>
                                    <th> যন্ত্রপাতির নাম</th>
                                    <th> সংখ্যা</th>
                                    <th>সংগ্রহ / ক্রয়ের বছর</th>
                                    <th>বর্তমান অবস্থা</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ Form::text('construction_machinery[1][equipment_name]', null, ['required', 'class' => 'form-control', 'placeholder' => 'যন্ত্রপাতির নাম..', ]) }}</td>
                                    <td>{{ Form::text('construction_machinery[1][qty]', null, ['required', 'class' => 'form-control', 'placeholder' => 'সংখ্যা..', ]) }}</td>
                                    <td>{{ Form::text('construction_machinery[1][purchase_year]', null, ['required', 'class' => 'form-control', 'placeholder' => 'সংগ্রহ / ক্রয়ের বছর..', ]) }}</td>
                                    <td>{{ Form::text('construction_machinery[1][current_status]', null, ['required', 'class' => 'form-control', 'placeholder' => 'টবর্তমান অবস্থা..', ]) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ Form::text('construction_machinery[2][equipment_name]', null, ['required', 'class' => 'form-control', 'placeholder' => 'যন্ত্রপাতির নাম..', ]) }}</td>
                                    <td>{{ Form::text('construction_machinery[2][qty]', null, ['required', 'class' => 'form-control', 'placeholder' => 'সংখ্যা..', ]) }}</td>
                                    <td>{{ Form::text('construction_machinery[2][purchase_year]', null, ['required', 'class' => 'form-control', 'placeholder' => 'সংগ্রহ / ক্রয়ের বছর..', ]) }}</td>
                                    <td>{{ Form::text('construction_machinery[2][current_status]', null, ['required', 'class' => 'form-control', 'placeholder' => 'টবর্তমান অবস্থা..', ]) }}</td>
                                </tr>


                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('shop_witch_type', '  নির্মাণকালীন খরচ বহনের আর্থিক সক্ষমতাঃ  ', array('class' => 'shop_ownner col-sm-3 control-label')) }}

                    <div class="col-sm-9">

                        <div>
                            <table class="table">

                                <thead>
                                <tr>
                                    <th>নং</th>
                                    <th> অর্থের উৎস</th>
                                    <th>অর্থের পরিমান</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ Form::text('financial_ability[1][source_of_money]', null, ['required', 'class' => 'form-control', 'placeholder' => 'অর্থের উৎস..', ]) }}</td>
                                    <td>{{ Form::text('financial_ability[1][amount]', null, ['required', 'class' => 'form-control', 'placeholder' => 'অর্থের পরিমান..', ]) }}</td>

                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ Form::text('financial_ability[2][source_of_money]', null, ['required', 'class' => 'form-control', 'placeholder' => 'অর্থের উৎস..', ]) }}</td>
                                    <td>{{ Form::text('financial_ability[2][amount]', null, ['required', 'class' => 'form-control', 'placeholder' => 'অর্থের পরিমান..', ]) }}</td>

                                </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <h3><span>নিষিদ্ধকরণ তথ্যঃ</span></h3>
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>আপনি কি সরকারি কোনো প্রতিষ্ঠান হতে কখনো নিষিদ্ধ হয়েছেন?</th>
                        <td>
                            {{ Form::radio('forbidden_info[is_forbidden]', 'Yes', true) }} হাঁ<br>
                            {{ Form::radio('forbidden_info[is_forbidden]', 'No', true) }} না

                        </td>
                        <td>
                            উত্তর হলে, কখন এবং কোথায় উল্লেখ করুন?<br>
                            {{ Form::text('forbidden_info[reason]', null, ['class' => 'form-control', 'placeholder' => 'উত্তর হলে, কখন এবং কোথায় উল্লেখ করুন?..', ]) }}
                        </td>
                    </tr>
                    </tbody>
                </table>

                <h3><span>প্রয়োজনীয় যোগ্যতাঃ</span></h3>
                <div class="form-group">

                    <div class="col-sm-12">
                        প্রয়োজনীয় যোগ্যতাঃ <br>
                        ক. বৈধ ট্রেড লাইসেন্স <br>
                        খ. টিআইএন সনদ <br>
                        গ. ২৫,০০০,০০/- (পঁচিশ লক্ষ) টাকার ব্যাংক স্বচ্ছলতার সনদ <br>
                        ঘ. ভ্যাট রেজিস্ট্রেশন <br>


                    </div>
                </div>

                <h3><span>সংযুক্তি</span></h3>

                <div class="form-group">

                    <div class="col-sm-12">
                        <div class="bs-example" data-example-id="bordered-table">
                            <table class="table table-bordered">

                                <tbody>

                                <tr>
                                    <td style="width: 5%"> 1</td>
                                    <td style="width: 80%">
                                        স্বত্বাধিকারী/ ব্যবস্থাপনা পরিচালন- এর ১ কপি পাসপোর্ট সাইজের ফটো ( নতুন আবেদনের
                                        ক্ষেত্রে)

                                    </td>
                                    <td style="width: 10%">{{  Form::file('management[photo]', []) }}</td>
                                    <td style="width: 5%">{{ Form::checkbox('management[is_photo]', null , false,[
                                     'data-class' => 'management_photo',
                                      'onchange' => 'upload_file(this)'
                                      ]) }}</td>
                                </tr>
                                <tr>
                                    <td> 2</td>
                                    <td>
                                        হালনাগাদ ( সর্বশেষ টিআইএন সনদ অথবা আয়কর রিটার্ন প্রাপ্তিস্বীকার প্রত্র।

                                    </td>
                                    <td>{{  Form::file('tin_doc[tin_file]', []) }}</td>
                                    <td>{{ Form::checkbox('tin_doc[is_file]', 'value', false) }}</td>
                                </tr>
                                <tr>
                                    <td> 3</td>
                                    <td>
                                        ভ্যাট রেজিস্ট্রেশন সনদ।

                                    </td>
                                    <td>{{  Form::file('vat_doc[vat_file]', []) }}</td>
                                    <td>{{ Form::checkbox('vat_doc[vat_file]', 'value', false) }}</td>
                                </tr>
                                <tr>
                                    <td> 4</td>
                                    <td>
                                        এফিডেভিট / আর্টিকেল অফ এসোসিয়েশন (প্রযোজ্য ক্ষেত্রে)

                                    </td>
                                    <td>{{  Form::file('article_of_association[aoa_file]', []) }}</td>
                                    <td>{{ Form::checkbox('article_of_association[is_aoa]', 'value', false) }}</td>
                                </tr>
                                <tr>
                                    <td> 5</td>
                                    <td>

                                        বৈধ হালনাগাদ ট্রেড লাইসেন্স।
                                    </td>
                                    <td>{{  Form::file('trade_licenses[trade_file]', []) }}</td>
                                    <td>{{ Form::checkbox('trade_licenses[is_trade]', 'value', false) }}</td>
                                </tr>
                                <tr>
                                    <td> 6</td>
                                    <td>
                                        স্বত্বাধিকারী/ ব্যবস্থাপনা পরিচাক বয়সের সপক্ষে কাগজপত্র (এন আই ডি)।

                                    </td>
                                    <td>{{  Form::file('management_nid[md_nid_file]', []) }}</td>
                                    <td>{{ Form::checkbox('management_nid[is_md_nid]', 'value', false) }}</td>
                                </tr>
                                <tr>
                                    <td> 7</td>
                                    <td>
                                        মুখ্য কারিগরি জনবলের জীবন বৃত্তান্ত।

                                    </td>
                                    <td>{{  Form::file('chief_manpower[manpower_file]', []) }}</td>
                                    <td>{{ Form::checkbox('chief_manpower[is_manpower]', 'value', false) }}</td>
                                </tr>
                                <tr>
                                    <td> 8</td>
                                    <td>
                                        স্থানীয় সরকার প্রতিষ্ঠান হতে স্বত্বাধিকারী/ ব্যবস্থাপনা পরিচালক - এর জাতীয়তা/
                                        চারিত্রিক সনদ।

                                    </td>
                                    <td>{{  Form::file('md_character[md_character_file]', []) }}</td>
                                    <td>{{ Form::checkbox('md_character[is_md_character]', 'value', false) }}</td>
                                </tr>
                                <tr>
                                    <td> 9</td>
                                    <td>
                                        নিম্নোক্ত বিষয়ের নিশ্চয়তা স্বরূপ এফিডেভিটঃ
                                        আবেদনকারী আইনতভাবে ক্রয়কারী সত্তার সাথে চুক্তিতে আবদ্ধ হতে সক্ষম এবং বাংলাদেশ
                                        সরকারের কোন প্রতিষ্ঠান কর্তৃক কারণে কখনো অযোগ্য বিবেচিত হয় নি।

                                    </td>
                                    <td>{{  Form::file('legally_bound[legally_bound_file]', []) }}</td>
                                    <td>{{ Form::checkbox('legally_bound[legally_bound_file]', 'value', false) }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>

                <div class="contractor_button">
                    <button type="button" class="btn btn-danger pull-left btn-lg" data-dismiss="modal">বাতিল</button>
                    <button type="submit" class="btn btn-success pull-right btn-lg">জমা দিন</button>

                </div>


                {{ Form::close() }}

            </div>


            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="upload_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <table class="table">
                                        <tr>
                                            <td width="40%" align="right"><label>Select File for Upload</label></td>
                                            <td width="30"><input type="file" name="select_file" id="select_file" /></td>
                                            <td width="30%" align="left"><input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload"></td>
                                        </tr>
                                        <tr>
                                            <td width="40%" align="right"></td>
                                            <td width="30"><span class="text-muted">jpg, png, gif</span></td>
                                            <td width="30%" align="left"></td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>




        @endif
    </div>
@endsection

@section('cusjs')
    <script>
        $(document).ready(function () {


            master_function();
            $(function () {
                $(".date-pick").datepicker({format: 'dd-mm-yyyy'}).val();
            });


            $('#upload_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:"{{ route('contractor_apply_file') }}",
                    method:"POST",
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {
                        $('#message').css('display', 'block');
                        $('#message').html(data.message);
                        $('#message').addClass(data.class_name);
                        $('#uploaded_image').html(data.uploaded_image);
                    }
                })
            });



            window.upload_file = function (self) {
                var id = $(self).data('class');
                $("#myModal").modal();
            }






            function master_function() {


            }

        });


    </script>
@endsection