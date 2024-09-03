@extends('frontend.layouts.app')

@section('content')
    @include('frontend.common.slider')
    @include('frontend.common.marquee')

    <div class="container user_panel">
        <div class="well">
            @include('frontend.common.frontend_user_menu')
        </div>
        @if (Route::has('login'))
            <?php $user = Auth::user(); ?>
            <div class="row up_bottom">
                <div class="col-md-12">
                    <table border="0" class="table_custom" style="width:100%;margin:auto;">

                        <tr class="header_area" style="">
                            <td class="header_logo" style="width:10%">
                                <img src="{{ $settings[0]->com_logourl }}" alt="">
                            </td>
                            <td style="width:90%;padding-left:20px;color:#fff">
                                <b>{{ $settings[0]->com_name }}</b>
                                <br/>
                                {{ $settings[0]->com_address }}
                            </td>
                        </tr>

                        <tr class="from_head_titile">
                            <td colspan="4" align="center">
                                <b> প্রোফাইল </b>
                            </td>
                        </tr>

                        <tr class="input_fild">
                            <td class="profile_img" style="width:25%; height:220px; ">
                                <img src="{{ url(!empty($user->photo) ? $user->photo : null) }}" width="200"/>
                            </td>
                            <td style="width:75%;">
                                <table style="width:100%;">
                                    <tr class="input_a" style="width:100%">
                                        <td style="width:30%;">
                                            <b> ইউজার আইডি </b>
                                        </td>
                                        <td>{{ $user->id }}</td>
                                    </tr>
                                    <tr class="input_a" style="width:100%">
                                        <td style="width:30%;">
                                            <b>নাম ( ইংরেজিতে ) </b>
                                        </td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr class="input_a" style="width:100%">
                                        <td style="width:30%;">
                                            <b>নাম ( বাংলায় )</b>
                                        </td>
                                        <td>{{ $user->bnname }}</td>
                                    </tr>
                                    <tr class="input_a">
                                        <td>
                                            <b>পিতার নাম (ইংরেজিতে) </b>
                                        </td>
                                        <td>{{ $user->enfathername }}</td>
                                    </tr>
                                    <tr class="input_a">
                                        <td>
                                            <b>পিতার নাম (বাংলায়) </b>
                                        </td>
                                        <td>{{ $user->bnfathername }}</td>
                                    </tr>
                                    <tr class="input_a">
                                        <td class="">
                                            <b>মাতার নাম (ইংরেজিতে) </b>
                                        </td>
                                        <td>{{ $user->enmothername }}</td>
                                    </tr>
                                    <tr class="input_a">
                                        <td class="">
                                            <b>মাতার নাম (বাংলায়) </b>
                                        </td>
                                        <td>{{ $user->bnmothername }}</td>
                                    </tr>

                                </table>
                            </td>
                        </tr>

                        <tr class="" style="background:#ddd; ">
                            <td colspan="4" style="width: 100%;padding:10px;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width:25%;">লিঙ্গ</td>
                                        <td style="width:25%;">{{ $user->gender }}</td>
                                        <td style="width:25%;">ধর্ম</td>
                                        <td style="width:25%;">{{ $user->religion }}</td>
                                    </tr>
                                    {{--<tr>--}}
                                    {{--<td style="width:25%;">বৈবাহিক অবস্থা</td>--}}
                                    {{--<td style="width:25%;">{{ $user->marital_status }}</td>--}}
                                    {{--<td style="width:25%;">শিক্ষাগত যোগ্যতা</td>--}}
                                    {{--<td style="width:25%;"> &nbsp;</td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                    {{--<td style="width:25%;">পেশা</td>--}}
                                    {{--<td style="width:25%;">শিক্ষক</td>--}}
                                    {{--<td style="width:25%;">বাসিন্দা</td>--}}
                                    {{--<td style="width:25%;">অস্থায়ী</td>--}}
                                    {{--</tr>--}}


                                    <tr>
                                        <td style="width:25%;">ন্যাশনাল আইডি (ইংরেজিতে):</td>
                                        <td style="width:25%;">{{ $user->nidno }}</td>
                                        <td style="width:25%;">পাসপোর্ট নং ( ইংরেজিতে ):</td>
                                        <td style="width:25%;">{{ $user->passportno }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%;">জন্ম নিবন্ধন নং ( ইংরেজিতে ): <b></b></td>
                                        <td style="width:25%;">{{ $user->birthcertificateno }}</td>
                                        <td style="width:25%;">জম্ম তারিখ:</td>
                                        <td style="width:25%;">{{ $user->birthday }}</td>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                        <tr class="adrees_info">
                            <td colspan="4" style="width: 100%;padding: 10px;background:#355d44;">
                                <table style="width: 100%;">
                                    <tr class="">
                                        <td class="title_addr">
                                            <b>বর্তমান ঠিকানা</b>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="adrees_info">
                            <td colspan="4" style="width: 100%; padding:10px;background:#ddd;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width:25%;"><b>গ্রাম/মহল্লা ( ইংরেজিতে ):</b></td>
                                        <td style="width:25%;">{{ $user->enprevillage }}</td>
                                        <td style="width:25%;"><b>গ্রাম/মহল্লা ( বাংলায় )</b></td>
                                        <td style="width:25%;">{{ $user->bnprevillage }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%;"><b>রোড/ব্লক/সেক্টর ( ইংরেজিত ):</b></td>
                                        <td style="width:25%;">{{ $user->enpreroad }}</td>
                                        <td style="width:25%;"><b>রোড/ব্লক/সেক্টর ( বাংলায় ):</b></td>
                                        <td style="width:25%;">{{ $user->bnpreroad }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%;"><b>ওয়ার্ড নং ( ইংরেজিতে ):</b></td>
                                        <td style="width:25%;">{{ $user->enprewardno }}</td>
                                        <td style="width:25%;"><b>ওয়ার্ড নং ( বাংলায় ):</b></td>
                                        <td style="width:25%;">{{ $user->bnprewardno }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%;"><b>পোষ্ট অফিস ( ইংরেজিতে ):</b></td>
                                        <td style="width:25%;">{{ $user->enprepostoffice }}</td>
                                        <td style="width:25%;"><b>পোষ্ট অফিস ( বাংলায় ):</b></td>
                                        <td style="width:25%;">{{ $user->bnprepostoffice }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%;"><b>উপজেলা/থানা ( ইংরেজিতে ):</b></td>
                                        <td style="width:25%;">{{ $user->enpreupazilla }}</td>
                                        <td style="width:25%;"><b>উপজেলা/থানা ( বাংলায় ):</b></td>
                                        <td style="width:25%;">{{ $user->enpreupazilla }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%;"><b>জেলা( ইংরেজিতে ):</b></td>
                                        <td style="width:25%;">{{ $user->enpredistrict }}</td>
                                        <td style="width:25%;"><b>জেলা( বাংলায় ):</b></td>
                                        <td style="width:25%;">{{ $user->bnpredistrict }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="adrees_info">
                            <td colspan="4" style="width: 100%;padding: 10px;background:#355d44;">
                                <table style="width: 100%;">
                                    <tr class="">
                                        <td class="title_addr">
                                            <b>স্থায়ী ঠিকানা</b>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="adrees_info">
                            <td colspan="4" style="width: 100%; padding:10px;background:#ddd;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width:25%;"><b>গ্রাম/মহল্লা ( ইংরেজিতে ):</b></td>
                                        <td style="width:25%;">{{ $user->enparvillage }}</td>
                                        <td style="width:25%;"><b>গ্রাম/মহল্লা ( বাংলায় )</b></td>
                                        <td style="width:25%;">{{ $user->bnparvillage }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%;"><b>রোড/ব্লক/সেক্টর ( ইংরেজিত ):</b></td>
                                        <td style="width:25%;">{{ $user->enparroad }}</td>
                                        <td style="width:25%;"><b>রোড/ব্লক/সেক্টর ( বাংলায় ):</b></td>
                                        <td style="width:25%;">{{ $user->bnparroad }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%;"><b>ওয়ার্ড নং ( ইংরেজিতে ):</b></td>
                                        <td style="width:25%;">{{ $user->enparwardno }}</td>
                                        <td style="width:25%;"><b>ওয়ার্ড নং ( বাংলায় ):</b></td>
                                        <td style="width:25%;">{{ $user->bnparwardno }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%;"><b>পোষ্ট অফিস ( ইংরেজিতে ):</b></td>
                                        <td style="width:25%;">{{ $user->enparpostoffice }}</td>
                                        <td style="width:25%;"><b>পোষ্ট অফিস ( বাংলায় ):</b></td>
                                        <td style="width:25%;">{{ $user->bnparpostoffice }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%;"><b>উপজেলা/থানা ( ইংরেজিতে ):</b></td>
                                        <td style="width:25%;">{{ $user->enparupazilla }}</td>
                                        <td style="width:25%;"><b>উপজেলা/থানা ( বাংলায় ):</b></td>
                                        <td style="width:25%;">{{ $user->enparupazilla }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%;"><b>জেলা( ইংরেজিতে ):</b></td>
                                        <td style="width:25%;">{{ $user->enpardistrict }}</td>
                                        <td style="width:25%;"><b>জেলা( বাংলায় ):</b></td>
                                        <td style="width:25%;">{{ $user->bnpardistrict }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="adrees_info">
                            <td colspan="4" style="width: 100%;padding: 10px;background:#355d44;">
                                <table style="width: 100%;">
                                    <tr class="">
                                        <td class="title_addr">
                                            <b>যোগাযোগের ঠিকানা</b>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="adrees_info">
                            <td colspan="4" style="width: 100%; padding:10px;background:#ddd;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width:25%;">
                                            <b>মোবাইল</b>
                                        </td>
                                        <td style="width:25%;">
                                            +01750504565055
                                        </td>
                                        <td style="width:25%;">
                                            <b>ইমেল</b>
                                        </td>
                                        <td style="width:25%;">
                                            info@yourmail.com
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%;">
                                            <b>সংযুক্তি যদি থাকে ( ইংরেজিতে ):</b>
                                        </td>
                                        <td style="width:25%;">
                                            ---------
                                        </td>
                                        <td style="width:25%;">
                                            <b>সংযুক্তি যদি থাকে ( বাংলায় ):</b>
                                        </td>
                                        <td style="width:25%;">
                                            -----------
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="fotter_table">
                            <td colspan="4">
                                ফ্রিলয়ান্সার আইটি কর্তৃক সর্বসত্ত্ব সংরক্ষিত
                            </td>
                        </tr>
                    </table>

                    <div class="row">
                        <div class="col-xs-6">
                            <?php
                            //dump($user);
                            //dump($settings[0]);
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        @endif
    </div>
@endsection
@section('cusjs')
    <style type="text/css">
        .table_custom {
            box-shadow: 0px 0px 5px 4px #DCDCDC;
        }

        .input_a td {
            background: #ddd;
            border-right: 5px solid #fff;
            color: #333;
            padding: 3px 20px;
            border-bottom: 1px solid #fff;

        }

        .input_a td:last-child {
            border-right: none;
        }

        .header_area {
            /*background: linear-gradient(180deg, #456150, #00511F);*/
            text-align: left;
            padding: 10px 15px;
        }

        .header_logo {

        }

        .header_logo img {
            max-width: 150px;
            max-height: 170px;
            padding: 10px 0px;
        }

        .from_head_titile td {
            padding: 5px 0px;
            font-size: 14px;
            text-transform: capitalize;
            color: #333;
            background: #eee;
        }

        .header_area td {
            font-size: 18px;
            text-align: left;
            line-height: 24px;
            text-align: center;
        }

        .user_id {
            background: linear-gradient(to left, #43cea2, #00511F);
            text-align: center;
            color: #fff;
        }

        .profile_img {
            position: relative;
        }

        .profile_img img {
            position: absolute;
            top: 10px;
            width: 95%;
            height: 200px;
        }

        .input_fild td {
            font-size: 12px;
        }

        .title_addr {
            text-transform: capitalize;
            font-weight: bold;
            color: #fff;
            font-size: 16px;
            text-align: center;
        }

        .fotter_table {
            text-align: center;

        }

        .fotter_table td {
            padding: 8px 0px;
            background: linear-gradient(180deg, #456150, #00511F);
            color: #fff;

        }
    </style>
@endsection
