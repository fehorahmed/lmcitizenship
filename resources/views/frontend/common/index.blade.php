@extends('frontend.layouts.app')

@php
    $setting = \App\Models\Setting::first();
    if ($setting) {
        $name = $setting->name;
        $map_link = $setting->map;
    } else {
        $name = 'মোহনগঞ্জ পৌরসভা, নেত্রকোণা ।';
        $map_link = '';
    }

@endphp
@section('content')
    @include('frontend.common.slider')
    @include('frontend.common.main_menu')

    @include('frontend.common.marquee')


    <div class="container user_panel">
        @include('frontend.pages.message-section')
        @include('frontend.pages.home-seba-section')
        <div class="home-contact-box">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="google-map-title section-title">
                            <h2>
                                মানচিত্র
                            </h2>
                        </div>
                        <div class="map">
                            <div class="map">
                                <iframe src="{{ $map_link }}" width="100%" height="336" style="border:0;"
                                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="google-map-title section-title">
                            <h2>
                                মন্তব্য / জিজ্ঞাসা
                            </h2>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @include('frontend.pages.feedback_form')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="google-map-title section-title">
                            <h2>
                                যোগাযোগ
                            </h2>
                        </div>
                        <table class="table">
                            <tbody style="font-size: 16px;">
                                <tr>
                                    @foreach ($contacts as $contact)
                                        <td>
                                            <b>{{ $contact->designation }}
                                            </b><br>{{ $contact->address }}
                                            <br>মোবাইল : {{ $contact->phone }}<br>ই-মেইল:&nbsp;<a
                                                title="comillazp@gmail.com" href="mailto:{{ $contact->email }}"
                                                style="background-color: rgb(255, 255, 255); font-family: kalpurush, "
                                                open="" sans";="" font-size:="" 14px;="" text-align:=""
                                                justify;"="">{{ $contact->email }}</a>
                                        </td>
                                    @endforeach
                                    {{-- <td>
                                        <b>মেয়র
                                        </b><br>মোহনগঞ্জ পৌরসভা, নেত্রকোণা ।
                                        <br>মোবাইল : <span
                                            id="ctl00_CPHBody_FormView3_TelephoneNoLabel">০৯৫২৪-৫৬০৩০</span><br>ই-মেইল:
                                        <span
                                            id="ctl00_CPHBody_FormView3_EmailIDLabel">mohangonjpourashova@gmail.com</span><span
                                            id="ctl00_CPHBody_FormView3_TelephoneNoLabel"
                                            style="color: rgb(68, 68, 68); font-family: kalpurush, " open=""
                                            sans";="" font-size:="" 14px;="" text-align:="" justify;=""
                                            background-color:="" rgb(255,="" 255,="" 255);"=""></span>
                                    </td>
                                    <td>
                                        <b><b><span class="VIiyi" lang="bn"><span class="JLqJ4b ChMk0b"
                                                        data-language-for-alternatives="bn"
                                                        data-language-to-translate-into="en" data-phrase-index="0"
                                                        data-number-of-phrases="1"><span class="Q4iAWc">নির্বাহী
                                                        </span></span></span>প্রকৌশলী</b>
                                        </b><br>মোহনগঞ্জ পৌরসভা, নেত্রকোণা ।
                                        <br>মোবাইল : ০১৭৪০-৯৯০৮০৮<br>ই-মেইল: <span
                                            id="ctl00_CPHBody_FormView3_EmailIDLabel">mohangonjpourashova@gmail.com</span>
                                    </td>
                                    <td><b><span class="VIiyi" lang="bn"><span class="JLqJ4b ChMk0b"
                                                    data-language-for-alternatives="bn" data-language-to-translate-into="en"
                                                    data-phrase-index="0" data-number-of-phrases="1"><span
                                                        class="Q4iAWc">পৌর নির্বাহী </span></span></span></b><span
                                            class="kgnlhe FwR7Pc" data-term-type="tl" role="button" tabindex="0"
                                            data-sl="bn" data-tl="en" dir="ltr">কর্মকর্তা</span>
                                        <br>মোহনগঞ্জ পৌরসভা, নেত্রকোণা ।
                                        <br>মোবাইল : ০১৭১২-৩৪৫২৯৯<br>ই-মেইল: <span
                                            id="ctl00_CPHBody_FormView3_EmailIDLabel">mohangonjpourashova@gmail.com</span>
                                    </td> --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('cusjs')
    <style type="text/css">
        .my-card {
            position: absolute;
            left: 40%;
            top: -20px;
            border-radius: 50%;
        }

        .service_lock {
            cursor: not-allowed;
            position: relative;
        }

        .service_lock:after {
            content: "LOCK";
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            background: #ffffffdb;
            text-align: center;
            line-height: 130px;
            font-size: 35px;
            color: rgba(70, 76, 119, 0.5);
        }
    </style>
@endsection
