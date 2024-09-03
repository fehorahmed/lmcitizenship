{{-- <div class="google-map-title section-title">
        <h2>
            Pouroshobar seba
        </h2>
    </div> --}}
<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">

    <ul class="nav nav-tabs" id="myTabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#GeneralInformation" role="tab" data-toggle="tab"> সাধারণ তথ্যাদি </a>
        </li>
        <li role="presentation" class="">
            <a href="#allEseba" role="tab" data-toggle="tab"> সকল ই-সেবা </a>
        </li>
        <li role="presentation" class="">
            <a href="#allMobileSeba" role="tab" data-toggle="tab"> মোবাইল সেবা </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active in" role="tabpanel" id="GeneralInformation">
            <div class="panel panel-default">
                <div class="jumbotron">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                            <div class="man-service_one">
                                <div class="lang_enbn">
                                    <a class="btn btn-xs Bn_lang" target="_blank" href="{{ route('user.citizenship') }}"
                                        target="_blank">
                                        বাংলা
                                    </a>
                                    <a class="btn btn-xs En_lang" href="{{ route('user.citizenship') }}">
                                        EN
                                    </a>

                                </div>

                                <a target="_blank" href="{{ route('user.citizenship') }}" target="_blank">

                                    <img src="{{ url('public/icons/profile.png') }}">

                                </a>

                                <a target="_blank" href="{{ route('user.citizenship') }}">
                                    <h1>
                                        নাগরিকত্ব সনদ
                                    </h1>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                            <div class="man-service_one">
                                <div class="lang_enbn">
                                    <a class="btn btn-xs Bn_lang" target="_blank" href="{{ route('user.warish') }}"
                                        target="_blank">
                                        বাংলা
                                    </a>
                                    <a class="btn btn-xs En_lang" href="{{ route('user.warish') }}">
                                        EN
                                    </a>

                                </div>

                                <a target="_blank" href="{{ route('user.warish') }}" target="_blank">

                                    <img src="{{ url('public/icons/profile.png') }}">

                                </a>

                                <a target="_blank" href="{{ route('user.warish') }}">
                                    <h1>
                                        ওয়ারিশ সনদ
                                    </h1>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade " role="tabpanel" id="allEseba">
            <div class="panel panel-default">
                <div class="jumbotron">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%AE%E0%A7%8E%E0%A6%B8%E0%A7%8D%E0%A6%AF%20%E0%A6%93%20%E0%A6%AA%E0%A7%8D%E0%A6%B0%E0%A6%BE%E0%A6%A3%E0%A7%80">
                                <img src="{{ url('public/eseba_icons/agriculture.png') }}" alt="" width=""
                                    height="">
                            </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%AE%E0%A7%8E%E0%A6%B8%E0%A7%8D%E0%A6%AF%20%E0%A6%93%20%E0%A6%AA%E0%A7%8D%E0%A6%B0%E0%A6%BE%E0%A6%A3%E0%A7%80"
                                class="service-type">
                                মৎস্য ও প্রাণী </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%AD%E0%A6%B0%E0%A7%8D%E0%A6%A4%E0%A6%BF%E0%A6%B0%20%E0%A6%86%E0%A6%AC%E0%A7%87%E0%A6%A6%E0%A6%A8">
                                <img src="{{ url('public/eseba_icons/admission_cap.png') }}" alt=""
                                    width="" height="">
                            </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%AD%E0%A6%B0%E0%A7%8D%E0%A6%A4%E0%A6%BF%E0%A6%B0%20%E0%A6%86%E0%A6%AC%E0%A7%87%E0%A6%A6%E0%A6%A8"
                                class="service-type">
                                ভর্তির আবেদন </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%9F%E0%A7%8D%E0%A6%B0%E0%A7%87%E0%A6%9C%E0%A6%BE%E0%A6%B0%E0%A6%BF%20%E0%A6%9A%E0%A6%BE%E0%A6%B2%E0%A6%BE%E0%A6%A8">
                                <img src="{{ url('public/eseba_icons/invoice_forms.png') }}" alt=""
                                    width="" height="">
                            </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%9F%E0%A7%8D%E0%A6%B0%E0%A7%87%E0%A6%9C%E0%A6%BE%E0%A6%B0%E0%A6%BF%20%E0%A6%9A%E0%A6%BE%E0%A6%B2%E0%A6%BE%E0%A6%A8"
                                class="service-type">
                                ট্রেজারি চালান </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%9F%E0%A6%BF%E0%A6%95%E0%A6%BF%E0%A6%9F%20%E0%A6%AC%E0%A7%81%E0%A6%95%E0%A6%BF%E0%A6%82%20%E0%A6%93%20%E0%A6%95%E0%A7%8D%E0%A6%B0%E0%A7%9F">
                                <img src="{{ url('public/eseba_icons/ticket_train.png') }}" alt=""
                                    width="" height="">
                            </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%9F%E0%A6%BF%E0%A6%95%E0%A6%BF%E0%A6%9F%20%E0%A6%AC%E0%A7%81%E0%A6%95%E0%A6%BF%E0%A6%82%20%E0%A6%93%20%E0%A6%95%E0%A7%8D%E0%A6%B0%E0%A7%9F"
                                class="service-type">
                                টিকিট বুকিং ও ক্রয় </a>
                        </div>

                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%A8%E0%A6%BF%E0%A7%9F%E0%A7%8B%E0%A6%97%20%E0%A6%B8%E0%A6%82%E0%A6%95%E0%A7%8D%E0%A6%B0%E0%A6%BE%E0%A6%A8%E0%A7%8D%E0%A6%A4">
                                <img src="{{ url('public/eseba_icons/govt_admision.png') }}" alt=""
                                    width="" height="">
                            </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%A8%E0%A6%BF%E0%A7%9F%E0%A7%8B%E0%A6%97%20%E0%A6%B8%E0%A6%82%E0%A6%95%E0%A7%8D%E0%A6%B0%E0%A6%BE%E0%A6%A8%E0%A7%8D%E0%A6%A4"
                                class="service-type">
                                নিয়োগ সংক্রান্ত </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%AA%E0%A6%BE%E0%A6%B8%E0%A6%AA%E0%A7%8B%E0%A6%B0%E0%A7%8D%E0%A6%9F,%20%E0%A6%AD%E0%A6%BF%E0%A6%B8%E0%A6%BE%20%E0%A6%93%20%E0%A6%87%E0%A6%AE%E0%A6%BF%E0%A6%97%E0%A7%8D%E0%A6%B0%E0%A7%87%E0%A6%B6%E0%A6%A8">
                                <img src="{{ url('public/eseba_icons/passport_visa.png') }}" alt=""
                                    width="" height="">
                            </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%AA%E0%A6%BE%E0%A6%B8%E0%A6%AA%E0%A7%8B%E0%A6%B0%E0%A7%8D%E0%A6%9F,%20%E0%A6%AD%E0%A6%BF%E0%A6%B8%E0%A6%BE%20%E0%A6%93%20%E0%A6%87%E0%A6%AE%E0%A6%BF%E0%A6%97%E0%A7%8D%E0%A6%B0%E0%A7%87%E0%A6%B6%E0%A6%A8"
                                class="service-type">
                                পাসপোর্ট, ভিসা ও ইমিগ্রেশন </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%95%E0%A7%83%E0%A6%B7%E0%A6%BF">
                                <img src="{{ url('public/eseba_icons/agriculture.png') }}" alt=""
                                    width="" height="">
                            </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%95%E0%A7%83%E0%A6%B7%E0%A6%BF"
                                class="service-type">
                                কৃষি </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%87%E0%A6%89%E0%A6%9F%E0%A6%BF%E0%A6%B2%E0%A6%BF%E0%A6%9F%E0%A6%BF%20%E0%A6%AC%E0%A6%BF%E0%A6%B2">
                                <img src="{{ url('public/eseba_icons/utility.png') }}" alt="" width=""
                                    height="">
                            </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%87%E0%A6%89%E0%A6%9F%E0%A6%BF%E0%A6%B2%E0%A6%BF%E0%A6%9F%E0%A6%BF%20%E0%A6%AC%E0%A6%BF%E0%A6%B2"
                                class="service-type">
                                ইউটিলিটি বিল </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%85%E0%A6%A8%E0%A6%B2%E0%A6%BE%E0%A6%87%E0%A6%A8%20%E0%A6%86%E0%A6%AC%E0%A7%87%E0%A6%A6%E0%A6%A8">
                                <img src="{{ url('public/eseba_icons/online_application.png') }}" alt=""
                                    width="" height=""> </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%85%E0%A6%A8%E0%A6%B2%E0%A6%BE%E0%A6%87%E0%A6%A8%20%E0%A6%86%E0%A6%AC%E0%A7%87%E0%A6%A6%E0%A6%A8"
                                class="service-type">
                                অনলাইন আবেদন </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%85%E0%A6%A8%E0%A6%B2%E0%A6%BE%E0%A6%87%E0%A6%A8%20%E0%A6%A8%E0%A6%BF%E0%A6%AC%E0%A6%A8%E0%A7%8D%E0%A6%A7%E0%A6%A8">
                                <img src="{{ url('public/eseba_icons/birth_certificate.png') }}" alt=""
                                    width="" height=""> </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%85%E0%A6%A8%E0%A6%B2%E0%A6%BE%E0%A6%87%E0%A6%A8%20%E0%A6%A8%E0%A6%BF%E0%A6%AC%E0%A6%A8%E0%A7%8D%E0%A6%A7%E0%A6%A8"
                                class="service-type">
                                অনলাইন নিবন্ধন </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%AA%E0%A7%8D%E0%A6%B0%E0%A6%B6%E0%A6%BF%E0%A6%95%E0%A7%8D%E0%A6%B7%E0%A6%A3">
                                <img src="{{ url('public/eseba_icons/training.png') }}" alt=""
                                    width="" height="">
                            </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%AA%E0%A7%8D%E0%A6%B0%E0%A6%B6%E0%A6%BF%E0%A6%95%E0%A7%8D%E0%A6%B7%E0%A6%A3"
                                class="service-type">
                                প্রশিক্ষণ </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%AA%E0%A7%8B%E0%A6%B8%E0%A7%8D%E0%A6%9F%E0%A6%BE%E0%A6%B2%20%E0%A6%93%20%E0%A6%95%E0%A7%81%E0%A6%B0%E0%A6%BF%E0%A7%9F%E0%A6%BE%E0%A6%B0">
                                <img src="{{ url('public/eseba_icons/postal.png') }}" alt="" width=""
                                    height=""> </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%AA%E0%A7%8B%E0%A6%B8%E0%A7%8D%E0%A6%9F%E0%A6%BE%E0%A6%B2%20%E0%A6%93%20%E0%A6%95%E0%A7%81%E0%A6%B0%E0%A6%BF%E0%A7%9F%E0%A6%BE%E0%A6%B0"
                                class="service-type">
                                পোস্টাল ও কুরিয়ার </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%86%E0%A7%9F%E0%A6%95%E0%A6%B0">
                                <img src="{{ url('public/eseba_icons/tin.png') }}" alt="" width=""
                                    height=""> </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%86%E0%A7%9F%E0%A6%95%E0%A6%B0"
                                class="service-type">
                                আয়কর </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%B6%E0%A6%BF%E0%A6%95%E0%A7%8D%E0%A6%B7%E0%A6%BE-%E0%A6%AC%E0%A6%BF%E0%A6%B7%E0%A7%9F%E0%A6%95">
                                <img src="{{ url('public/eseba_icons/apply_education.png') }}" alt=""
                                    width="" height="">
                            </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%B6%E0%A6%BF%E0%A6%95%E0%A7%8D%E0%A6%B7%E0%A6%BE-%E0%A6%AC%E0%A6%BF%E0%A6%B7%E0%A7%9F%E0%A6%95"
                                class="service-type">
                                শিক্ষা-বিষয়ক </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%B0%E0%A7%87%E0%A6%A1%E0%A6%BF%E0%A6%93,%20%E0%A6%9F%E0%A6%BF%E0%A6%AD%E0%A6%BF%E0%A6%B0%20%E0%A6%96%E0%A6%AC%E0%A6%B0">
                                <img src="{{ url('public/eseba_icons/radio_tv.png') }}" alt=""
                                    width="" height="">
                            </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%B0%E0%A7%87%E0%A6%A1%E0%A6%BF%E0%A6%93,%20%E0%A6%9F%E0%A6%BF%E0%A6%AD%E0%A6%BF%E0%A6%B0%20%E0%A6%96%E0%A6%AC%E0%A6%B0"
                                class="service-type">
                                রেডিও, টিভির খবর </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%AF%E0%A6%BE%E0%A6%A8%E0%A6%AC%E0%A6%BE%E0%A6%B9%E0%A6%A8%20%E0%A6%B8%E0%A7%87%E0%A6%AC%E0%A6%BE">
                                <img src="{{ url('public/eseba_icons/transport.png') }}" alt=""
                                    width="" height="">
                            </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%AF%E0%A6%BE%E0%A6%A8%E0%A6%AC%E0%A6%BE%E0%A6%B9%E0%A6%A8%20%E0%A6%B8%E0%A7%87%E0%A6%AC%E0%A6%BE"
                                class="service-type">
                                যানবাহন সেবা </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%85%E0%A6%B0%E0%A7%8D%E0%A6%A5%20%E0%A6%93%20%E0%A6%AC%E0%A6%BE%E0%A6%A3%E0%A6%BF%E0%A6%9C%E0%A7%8D%E0%A6%AF">
                                <img src="{{ url('public/eseba_icons/business.png') }}" alt=""
                                    width="" height="">
                            </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%85%E0%A6%B0%E0%A7%8D%E0%A6%A5%20%E0%A6%93%20%E0%A6%AC%E0%A6%BE%E0%A6%A3%E0%A6%BF%E0%A6%9C%E0%A7%8D%E0%A6%AF"
                                class="service-type">
                                অর্থ ও বাণিজ্য </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%B8%E0%A7%8D%E0%A6%AC%E0%A6%BE%E0%A6%B8%E0%A7%8D%E0%A6%A5%E0%A7%8D%E0%A6%AF%20%E0%A6%AC%E0%A6%BF%E0%A6%B7%E0%A7%9F%E0%A6%95">
                                <img src="{{ url('public/eseba_icons/health.png') }}" alt="" width=""
                                    height=""> </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%B8%E0%A7%8D%E0%A6%AC%E0%A6%BE%E0%A6%B8%E0%A7%8D%E0%A6%A5%E0%A7%8D%E0%A6%AF%20%E0%A6%AC%E0%A6%BF%E0%A6%B7%E0%A7%9F%E0%A6%95"
                                class="service-type">
                                স্বাস্থ্য বিষয়ক </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%86%E0%A6%AA%E0%A6%A8%E0%A6%BE%E0%A6%B0%20%E0%A6%9C%E0%A6%BF%E0%A6%9C%E0%A7%8D%E0%A6%9E%E0%A6%BE%E0%A6%B8%E0%A6%BE">
                                <img src="{{ url('public/eseba_icons/your_question.png') }}" alt=""
                                    width="" height="">
                            </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%86%E0%A6%AA%E0%A6%A8%E0%A6%BE%E0%A6%B0%20%E0%A6%9C%E0%A6%BF%E0%A6%9C%E0%A7%8D%E0%A6%9E%E0%A6%BE%E0%A6%B8%E0%A6%BE"
                                class="service-type">
                                আপনার জিজ্ঞাসা </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%A1%E0%A6%BF%E0%A6%9C%E0%A6%BF%E0%A6%9F%E0%A6%BE%E0%A6%B2%20%E0%A6%B8%E0%A7%87%E0%A6%A8%E0%A7%8D%E0%A6%9F%E0%A6%BE%E0%A6%B0">
                                <img src="{{ url('public/eseba_icons/digital_center.png') }}" alt=""
                                    width="" height="">
                            </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%A1%E0%A6%BF%E0%A6%9C%E0%A6%BF%E0%A6%9F%E0%A6%BE%E0%A6%B2%20%E0%A6%B8%E0%A7%87%E0%A6%A8%E0%A7%8D%E0%A6%9F%E0%A6%BE%E0%A6%B0"
                                class="service-type">
                                ডিজিটাল সেন্টার </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%A4%E0%A6%A5%E0%A7%8D%E0%A6%AF%20%E0%A6%AD%E0%A6%BE%E0%A6%A3%E0%A7%8D%E0%A6%A1%E0%A6%BE%E0%A6%B0">
                                <img src="{{ url('public/eseba_icons/info_vandar.png') }}" alt=""
                                    width="" height="">
                            </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%A4%E0%A6%A5%E0%A7%8D%E0%A6%AF%20%E0%A6%AD%E0%A6%BE%E0%A6%A3%E0%A7%8D%E0%A6%A1%E0%A6%BE%E0%A6%B0"
                                class="service-type">
                                তথ্য ভাণ্ডার </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%AB%E0%A6%B0%E0%A6%AE%E0%A6%B8">
                                <img src="{{ url('public/eseba_icons/govt_forms.png') }}" alt=""
                                    width="" height="">
                            </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%AB%E0%A6%B0%E0%A6%AE%E0%A6%B8"
                                class="service-type">
                                ফরমস </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%AA%E0%A6%B0%E0%A7%80%E0%A6%95%E0%A7%8D%E0%A6%B7%E0%A6%BE%E0%A6%B0%20%E0%A6%AB%E0%A6%B2%E0%A6%BE%E0%A6%AB%E0%A6%B2">
                                <img src="{{ url('public/eseba_icons/exam_result.png') }}" alt=""
                                    width="" height="">
                            </a>
                            <a target="_blank"
                                href="https://bangladesh.gov.bd/site/view/eservices/%E0%A6%AA%E0%A6%B0%E0%A7%80%E0%A6%95%E0%A7%8D%E0%A6%B7%E0%A6%BE%E0%A6%B0%20%E0%A6%AB%E0%A6%B2%E0%A6%BE%E0%A6%AB%E0%A6%B2"
                                class="service-type">
                                পরীক্ষার ফলাফল </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade " role="tabpanel" id="allMobileSeba">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                        <a target="_blank"
                            href="https://bangladesh.gov.bd/site/view/mservices/%E0%A6%95%E0%A7%83%E0%A6%B7%E0%A6%BF">
                            <img src="{{ url('public/eseba_icons/agriculture.png') }}" alt="" width=""
                                height="">
                        </a>
                        <a target="_blank"
                            href="https://bangladesh.gov.bd/site/view/mservices/%E0%A6%95%E0%A7%83%E0%A6%B7%E0%A6%BF"
                            class="service-type">
                            কৃষি </a>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                        <a target="_blank"
                            href="https://bangladesh.gov.bd/site/view/mservices/%E0%A6%95%E0%A6%B2%20%E0%A6%B8%E0%A7%87%E0%A6%A8%E0%A7%8D%E0%A6%9F%E0%A6%BE%E0%A6%B0">
                            <img src="{{ url('public/eseba_icons/call_center.png') }}" alt="" width=""
                                height="">
                        </a>
                        <a target="_blank"
                            href="https://bangladesh.gov.bd/site/view/mservices/%E0%A6%95%E0%A6%B2%20%E0%A6%B8%E0%A7%87%E0%A6%A8%E0%A7%8D%E0%A6%9F%E0%A6%BE%E0%A6%B0"
                            class="service-type">
                            কল সেন্টার </a>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                        <a target="_blank"
                            href="https://bangladesh.gov.bd/site/view/mservices/%E0%A6%AE%E0%A7%8B%E0%A6%AC%E0%A6%BE%E0%A6%87%E0%A6%B2%20%E0%A6%B8%E0%A7%87%E0%A6%AC%E0%A6%BE">
                            <img src="{{ url('public/eseba_icons/mobile_service.png') }}" alt=""
                                width="" height="">
                        </a>
                        <a target="_blank"
                            href="https://bangladesh.gov.bd/site/view/mservices/%E0%A6%AE%E0%A7%8B%E0%A6%AC%E0%A6%BE%E0%A6%87%E0%A6%B2%20%E0%A6%B8%E0%A7%87%E0%A6%AC%E0%A6%BE"
                            class="service-type">
                            মোবাইল সেবা </a>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 eservice-cat ">
                        <a target="_blank"
                            href="https://bangladesh.gov.bd/site/view/mservices/%E0%A6%B9%E0%A7%87%E0%A6%B2%E0%A7%8D%E0%A6%AA%E0%A6%A1%E0%A7%87%E0%A6%B8%E0%A7%8D%E0%A6%95">
                            <img src="{{ url('public/eseba_icons/helpdesk.png') }}" alt="" width=""
                                height=""> </a>
                        <a target="_blank"
                            href="https://bangladesh.gov.bd/site/view/mservices/%E0%A6%B9%E0%A7%87%E0%A6%B2%E0%A7%8D%E0%A6%AA%E0%A6%A1%E0%A7%87%E0%A6%B8%E0%A7%8D%E0%A6%95"
                            class="service-type">
                            হেল্পডেস্ক </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
