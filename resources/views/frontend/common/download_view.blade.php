@extends('frontend.layouts.app')

@section('content')
    @include('frontend.common.slider')
    @include('frontend.common.marquee')


    <div class="container user_panel">
            @include('frontend.common.frontend_user_menu')
        @if (Route::has('login'))
            <?php $user = Auth::user(); ?>

            {{----}}

            <div class="row up_bottom">
                <div class="col-md-3">
                    @include('frontend.common.user_panel_sidebar')
                </div>
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            ডাউনলোড বিভাগ
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="well">
                                        আপনি নিচের আইকনে ক্লিক করে আপনার প্রয়োজনীয় ফাইল ডাউনলোড করে নিতে পারবেন । বুঝতে
                                        সম্যসা হলে নিচে থাকা মোবাইল নম্বরে যোগাযোগ করতে পারেন।
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @if(!empty($user->name) && !empty($user->bnprevillage) && !empty($user->bnparvillage) && !empty($user->enprevillage) && !empty($user->enparvillage))
                                    <div class="col-md-4 col-sm-6">
                                        <div class="man-service_one">
                                            <div class="lang_enbn">
                                                <a class="Bn_lang" href="{{ url('profile_pdf') }}"
                                                   target="_blank">বাংলা</a>
                                                <a class="En_lang" href="#">EN</a>
                                            </div>
                                            <a href="{{ url('profile_pdf') }}" target="_blank">
                                                <img src="{{ url('public/icons/profile.png') }}">
                                            </a>
                                            <a href="{{ url('profile_pdf') }}">
                                                <h1>
                                                    প্রোফাইল
                                                </h1>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-4 col-sm-6">
                                    <div class="man-service_one">
                                        <div class="lang_enbn">
                                            <a class="Bn_lang" href="{{ url('citizen_certificate_pdf') }}"
                                               target="_blank">বাংলা</a>
                                            <a class="En_lang" href="#">EN</a>
                                        </div>
                                        <a href="{{ url('citizen_certificate_pdf') }}" target="_blank">
                                            <img src="{{ url('public/icons/nagorik.png') }}">
                                        </a>
                                        <a href="{{ url('citizen_certificate_pdf') }}" target="_blank">
                                            <h1>
                                                নাগরিক সনদ
                                            </h1>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="man-service_one">
                                        <div class="lang_enbn">
                                            <a class="Bn_lang" href="{{ url('domestic_certificate_pdf') }}"
                                               target="_blank">বাংলা</a>
                                            <a class="En_lang" href="#">EN</a>
                                        </div>
                                        <a href="{{ url('domestic_certificate_pdf') }}" target="_blank">
                                            <img src="{{ url('public/icons/family.png') }}">
                                        </a>
                                        <a href="{{ url('domestic_certificate_pdf') }}" target="_blank">
                                            <h1>
                                                পারিবারিক সনদ
                                            </h1>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="man-service_one">
                                        <div class="lang_enbn">
                                            <a class="Bn_lang" href="{{ url('monthly_income_certificate_pdf') }}"
                                               target="_blank">বাংলা</a>
                                            <a class="En_lang" href="#">EN</a>
                                        </div>
                                        <a href="{{ url('monthly_income_certificate_pdf') }}" target="_blank">
                                            <img
                                                    src="{{ url('public/icons/trade_license.png') }}"
                                                    alt=""></a>
                                        <a href="{{ url('monthly_income_certificate_pdf') }}" target="_blank">
                                            <h1> মাসিক আয়ের সনদ </h1>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="man-service_one">
                                        <div class="lang_enbn">
                                            <a class="Bn_lang" href="{{ url('yearly_income_certificate_pdf') }}"
                                               target="_blank">বাংলা</a>
                                            <a class="En_lang" href="#">EN</a>
                                        </div>
                                        <a href="{{ url('yearly_income_certificate_pdf') }}" target="_blank">
                                            <img
                                                    src="{{ url('public/icons/trade_license.png') }}"
                                                    alt="">
                                        </a>
                                        <a href="{{ url('yearly_income_certificate_pdf') }}" target="_blank">
                                            <h1> বার্ষিক আয়ের সনদ </h1>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="man-service_one">
                                        <div class="lang_enbn">
                                            <a class="Bn_lang" href="{{ url('succession_certificate_pdf') }}"
                                               target="_blank">বাংলা</a>
                                            <a class="En_lang" href="#">EN</a>
                                        </div>
                                        <a href="{{ url('succession_certificate_pdf') }}" target="_blank">
                                            <img src="{{ url('public/icons/warish.png') }}">
                                        </a>
                                        <a href="{{ url('succession_certificate_pdf') }}" target="_blank">
                                            <h1>
                                                উত্তরাধিকার সনদ
                                            </h1>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="man-service_one">
                                        <div class="lang_enbn">
                                            <a class="Bn_lang" href="{{ url('martial_status_pdf') }}" target="_blank">বাংলা</a>
                                            <a class="En_lang" href="#">EN</a>
                                        </div>
                                        <a href="#">
                                            <img src="http://103.218.26.178:2145/pourashova/storage/uploads/fullsize/2018-11/dininglist.png"
                                                 alt="">
                                        </a>
                                        <a href="">
                                            <h1> বৈবাহিক সনদপত্র </h1>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="man-service_one">
                                        <div class="lang_enbn">
                                            <a class="Bn_lang" href="#" target="_blank">বাংলা</a>
                                            <a class="En_lang" href="#">EN</a>
                                        </div>
                                        <a href="#">
                                            <img src="http://103.218.26.178:2145/pourashova/storage/uploads/fullsize/2018-11/dininglist.png"
                                                 alt="">
                                        </a>
                                        <a href="">
                                            <h1> ভূমিহীন সনদপত্র </h1>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="man-service_one">
                                        <div class="lang_enbn">
                                            <a class="Bn_lang" href="#" target="_blank">বাংলা</a>
                                            <a class="En_lang" href="#">EN</a>
                                        </div>
                                        <a href="#">
                                            <img src="http://103.218.26.178:2145/pourashova/storage/uploads/fullsize/2018-11/dininglist.png"
                                                 alt="">
                                        </a>
                                        <a href="">
                                            <h1> ভোটার আইডি স্থানান্তর সনদপত্র </h1>
                                        </a>
                                    </div>
                                </div>


                                <div class="col-md-4 col-sm-6">
                                    <div class="man-service_one">
                                        <div class="lang_enbn">
                                            <a class="Bn_lang" href="#" target="_blank">বাংলা</a>
                                            <a class="En_lang" href="#">EN</a>
                                        </div>
                                        <a href="#">
                                            <img src="http://103.218.26.178:2145/pourashova/storage/uploads/fullsize/2018-11/dininglist.png"
                                                 alt="">
                                        </a>
                                        <a href="">
                                            <h1> নদী ভাঙন সনদপত্র </h1>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="man-service_one">
                                        <div class="lang_enbn">
                                            <a class="Bn_lang" href="#" target="_blank">বাংলা</a>
                                            <a class="En_lang" href="#">EN</a>
                                        </div>
                                        <a href="#">
                                            <img src="http://103.218.26.178:2145/pourashova/storage/uploads/fullsize/2018-11/disabledallowance.png"
                                                 alt="">
                                        </a>
                                        <a href="">
                                            <h1>প্রতিবন্ধী ভাতা</h1>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="man-service_one">
                                        <div class="lang_enbn">
                                            <a class="Bn_lang" href="#" target="_blank">বাংলা</a>
                                            <a class="En_lang" href="#">EN</a>
                                        </div>
                                        <a href="#">
                                            <img
                                                    src="http://103.218.26.178:2145/pourashova/storage/uploads/fullsize/2018-11/vgd.png"
                                                    alt="">
                                        </a>
                                        <a href="">
                                            <h1>ভি জি ডি</h1>
                                        </a>
                                    </div>
                                </div>
                                {{--<div class="col-md-4 col-sm-6">--}}
                                {{--<div class="man-service_one">--}}
                                {{--<div class="lang_enbn">--}}
                                {{--<a class="Bn_lang" href="#" target="_blank">বাংলা</a>--}}
                                {{--<a class="En_lang" href="#">EN</a>--}}
                                {{--</div>--}}
                                {{--<a href="#">--}}
                                {{--<img src="http://103.218.26.178:2145/pourashova/storage/uploads/fullsize/2018-11/dailycollection.png"--}}
                                {{--alt="">--}}
                                {{--</a>--}}
                                {{--<a href="">--}}
                                {{--<h1>দৈনিক কালেকশন</h1>--}}
                                {{--</a>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-4 col-sm-6">--}}
                                {{--<div class="man-service_one">--}}
                                {{--<div class="lang_enbn">--}}
                                {{--<a class="Bn_lang" href="#" target="_blank">বাংলা</a>--}}
                                {{--<a class="En_lang" href="#">EN</a>--}}
                                {{--</div>--}}
                                {{--<a href="#"><img--}}
                                {{--src="http://103.218.26.178:2145/pourashova/storage/uploads/fullsize/2018-11/monthlycollection.png"--}}
                                {{--alt=""></a>--}}
                                {{--<a href=""><h1>মাসিক কালেকশন</h1></a>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-4 col-sm-6">--}}
                                {{--<div class="man-service_one">--}}
                                {{--<div class="lang_enbn">--}}
                                {{--<a class="Bn_lang" href="#" target="_blank">বাংলা</a>--}}
                                {{--<a class="En_lang" href="#">EN</a>--}}
                                {{--</div>--}}
                                {{--<a href="#">--}}
                                {{--<img--}}
                                {{--src="http://103.218.26.178:2145/pourashova/storage/uploads/fullsize/2018-11/yearlycollection.png"--}}
                                {{--alt="">--}}
                                {{--</a>--}}
                                {{--<a href=""><h1>অর্থ বছরের কালেকশন</h1></a>--}}
                                {{--</div>--}}
                                {{--</div>--}}

                                <div class="col-md-4 col-sm-6">
                                    <div class="man-service_one">
                                        <div class="lang_enbn">
                                            <a class="Bn_lang" href="{{ url('profile_pdf') }}" target="_blank">বাংলা</a>
                                            <a class="En_lang" href="#">EN</a>
                                        </div>
                                        <a href="#">
                                            <img src="{{ url('public/icons/trade_license.png') }}" target="_blank">
                                        </a>
                                        <a href="" target="_blank">
                                            <h1>
                                                ট্রেড লাইসেন্স
                                            </h1>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
