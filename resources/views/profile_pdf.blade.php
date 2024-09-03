<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="e2A8YhQ8rNNsHceVLtor8HAYPxkp3l0mMo7xqgaL">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> প্রোফাইল </title>
    <style type="text/css">


        table,
        th,
        td {
            border-collapse: collapse;
            border: 1px solid #EEEEEE !important;
            padding: 3px 5px;
        }

        table>tr>td>table>tr>td {
            border: 0px solid #000000 !important;
        }

        @page {
            size: 8.5in 11in;
            /* <length>{1,2} | auto | portrait | landscape */
            /* 'em' 'ex' and % are not allowed; length values are width height */
            margin: -35px 0 0 0;
            /* <any of the usual CSS values for margins> */
            /*(% of page-box width for LR, of height for TB) */
            margin-header: 0mm;
            /* <any of the usual CSS values for margins> */
            margin-footer: 0mm;
            /* <any of the usual CSS values for margins> */

        }
    </style>
</head>

<body>

    @if (Route::has('login'))
    <?php //$user = Auth::user();
    ?>
    <div class="row up_bottom">
        <div class="col-md-12">

            <table border="0" style="width:100%;margin:auto; ">
                <tr style="">
                    <td colspan="4" style="width: 100%; padding: 20px;background: #9E57B5; border: 1px solid  #9E5BBA; color: #FFFFFF;">
                        <table style="width: 100%; ">
                            <tr style="border: 1px solid  #9E5BBA">
                                <td style="border: 1px solid  #9E5BBA">
                                    {{-- <img src="{{ $settings->logo }}" alt="" width="80" height="80"> --}}
                                </td>
                                <td style="width:90%;padding-left:30px; font-size: 30px; color: #FFF; font-weight: bold">
                                    {{ $settings->name }}
                                    <p style="font-size: 20px;">
                                        {{ $settings->address }} ।
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td colspan="4" style="width: 100%; padding:5px 10px; margin-top: 10px; background:#E5C062; color: #000;">
                        <table style="width: 100%;  border: 0px solid #E5C062;">
                            <tr style=" border: 0px solid #E5C062;">
                                <td style="border: 0px solid #E5C062; font-size: 25px; font-weight: bold; text-align: center;">
                                    প্রোফাইল
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="width: 100%; padding:10px;background:#F8F9F9; border-color: #E5C062">
                        <table style="width:100%;">
                            <tr>
                                <td style="border-color:#E5C062">
                                    ইউজার আইডি
                                </td>
                                <td style="border-color:#E5C062">{{ $user->id }}</td>
                            </tr>

                            <tr>
                                <td style="border-color:#E5C062">
                                    নাম
                                </td>
                                <td style="border-color:#E5C062">{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td style="border-color:#E5C062">
                                    পিতার নাম
                                </td>
                                <td style="border-color:#E5C062">{{ $user->father_name }}</td>
                            </tr>

                            <tr>
                                <td style="border-color:#E5C062">
                                    মাতার নাম
                                </td>
                                <td style="border-color:#E5C062">{{ $user->mother_name }}</td>
                            </tr>

                        </table>
                    </td>
                    <td style="width: 20%; border-color:#E5C062">
                        {{-- <img src="{{ url('public/frontend/img/avatar.jpg') }}" width="145" /> --}}
                    </td>
                </tr>

                <tr>
                    <td colspan="4" style="width: 100%; padding:10px;background:#F8F9F9; border-color:#E5C062">
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 20%; border-color:#E5C062">লিঙ্গ (ইংরেজিতে)</td>
                                <td style="border-color:#E5C062">
                                    @if ($user->gender == 'Male')
                                    Male
                                    @else
                                    Female
                                    @endif
                                <td style="width: 20%; border-color:#E5C062">লিঙ্গ (বাংলায়)</td>
                                <td style="border-color:#E5C062">
                                    @if ($user->gender == 'Male')
                                    পুরুষ
                                    @else
                                    মহিলা
                                    @endif
                                </td>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%; border-color:#E5C062">ধর্ম (ইংরেজিতে)</td>
                    <td style="border-color:#E5C062">
                        @if ($user->religion == 'Islam')
                        Islam
                        @elseif($user->religion == 'Hindu') Hindu
                        @elseif($user->religion == 'Buddhist')
                        Buddhists
                        @elseif($user->religion == 'Christian')
                        Christian
                        @elseif($user->religion == 'Others')
                        Others
                        @endif
                    </td>
                    <td style="width: 20%; border-color:#E5C062">ধর্ম (বাংলায়)</td>
                    <td style="border-color:#E5C062">
                        @if ($user->religion == 'Islam')
                        ইসলাম
                        @elseif($user->religion == 'Hindu') হিন্দু
                        @elseif($user->religion == 'Buddhist')
                        বৌদ্ধ
                        @elseif($user->religion == 'Christian')
                        খ্রীষ্টান
                        @elseif($user->religion == 'Others')
                        অন্যান্য
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="border-color:#E5C062">বৈবাহিক অবস্থা (ইংরেজিতে)</td>
                    <td style="border-color:#E5C062">
                        @if ($user->marital_status == 'Married')
                        Married
                        @elseif($user->marital_status == 'Unmarried') Unmarried
                        @elseif($user->marital_status == 'Divorced')
                        Divorced
                        @elseif($user->marital_status == 'Widowed')
                        Widowed
                        @elseif($user->marital_status == 'Others')
                        Others
                        @endif
                    </td>
                    <td style="border-color:#E5C062">বৈবাহিক অবস্থা (বাংলায়)</td>
                    <td style="border-color:#E5C062">
                        @if ($user->marital_status == 'Married')
                        বিবাহিত
                        @elseif($user->marital_status == 'Unmarried') অবিবাহিত
                        @elseif($user->marital_status == 'Divorced')
                        তালাকপ্রাপ্ত
                        @elseif($user->marital_status == 'Widowed')
                        পতিহীনা
                        @elseif($user->marital_status == 'Others')
                        অন্যান্য
                        @endif
                    </td>
                </tr>
                {{-- <tr> --}}
                {{-- <td style="width:25%;">শিক্ষাগত যোগ্যতা</td>
                                <td style="width:25%;"> &nbsp;</td> --}}
                {{-- </tr> --}}
                {{-- <tr>
                            <td style="width:25%; border-color:#E5C062">পেশা</td>
                            <td style="width:25%; border-color:#E5C062">শিক্ষক</td>
                            <td style="width:25%; border-color:#E5C062">বাসিন্দা</td>
                            <td style="width:25%; border-color:#E5C062">অস্থায়ী</td>
                            </tr> --}}

                <tr>
                    <td style="border-color:#E5C062">জন্ম নিবন্ধন নং (ইংরেজিতে)</td>
                    <td style="width:25%; border-color:#E5C062">{{ $user->birthcertificateno }}</td>
                    <td style="border-color:#E5C062">জন্ম নিবন্ধন নং (বাংলায়)</td>
                    <td style="width:25%; border-color:#E5C062">{{ bn2enNumber($user->birthcertificateno) }}</td>
                </tr>
                <tr>
                    <td style="border-color:#E5C062">জম্ম তারিখ (ইংরেজিতে)</td>
                    <td style="width:25%; border-color:#E5C062">{{ $user->birthday() }}</td>
                    <td style="border-color:#E5C062">জম্ম তারিখ (বাংলায়)</td>
                    <td style="width:25%; border-color:#E5C062">{{ bn2enNumber($user->birthday()) }}</td>
                </tr>
                <tr>
                    <td style="border-color:#E5C062">বয়স (ইংরেজিতে)</td>
                    <td style="width:25%; border-color:#E5C062">{{ $user->age }} Years</td>
                    <td style="border-color:#E5C062">বয়স (বাংলায়)</td>
                    <td style="width:25%; border-color:#E5C062">{{ bn2enNumber($user->age) }} বছর</td>
                </tr>
                <tr>
                    <td style="border-color:#E5C062">ন্যাশনাল আইডি (ইংরেজিতে)</td>
                    <td style="width:25%; border-color:#E5C062">{{ $user->nidno }}</td>
                    <td style="border-color:#E5C062">মুক্তিযোদ্ধার সন্তান? (বাংলায়)</td>
                    <td style="width:25%; border-color:#E5C062">{{ $user->freedomfighters ? 'হ্যাঁ' : 'না' }}</td>
                </tr>
                <tr>
                    <td style="border-color:#E5C062">পাসপোর্ট নং (ইংরেজিতে)</td>
                    <td style="width:25%; border-color:#E5C062">{{ $user->passportno }}</td>
                </tr>
            </table>
            </td>

            </tr>
            <tr>
                <td colspan="4" style="width: 100%; padding:5px 10px; margin-top: 10px; background:#E5C062; border: 0px solid #E5C062; color: #000;">
                    <table style="width: 100%;  border: 0px solid #E5C062;">
                        <tr style=" border: 0px solid #E5C062;">
                            <td style="border: 0px solid #E5C062; font-size: 25px; font-weight: bold; text-align: center;">
                                বর্তমান ঠিকানা
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="width: 100%; padding:10px;background: #F8F9F9; border-color:#E5C062">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 20%; border-color:#E5C062">হোল্ডিং নম্বর (ইংরেজিতে)</td>
                            <td style="border-color:#E5C062">{{ $user->enpreholdingno }}</td>
                            <td style="width: 20%; border-color:#E5C062">হোল্ডিং নম্বর (বাংলায়)</td>
                            <td style="border-color:#E5C062">{{ $user->bnpreholdingno }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%; border-color:#E5C062">গ্রাম/মহল্লা (ইংরেজিতে)</td>
                            <td style="border-color:#E5C062">{{ $user->enprevillage }}</td>
                            <td style="width: 20%; border-color:#E5C062">গ্রাম/মহল্লা (বাংলায়)</td>
                            <td style="border-color:#E5C062">{{ $user->bnprevillage }}</td>
                        </tr>
                        <tr>
                            <td style="border-color:#E5C062">ওয়ার্ড নং (ইংরেজিতে)</td>
                            <td style="border-color:#E5C062">{{ $user->enprewardno }}</td>
                            <td style="border-color:#E5C062">ওয়ার্ড নং (বাংলায়)</td>
                            <td style="border-color:#E5C062">{{ $user->bnprewardno }}</td>
                        </tr>
                        <tr>
                            <td style="border-color:#E5C062">পোষ্ট অফিস (ইংরেজিতে)</td>
                            <td style="border-color:#E5C062">{{ $user->enprepostoffice }}</td>
                            <td style="border-color:#E5C062">পোষ্ট অফিস (বাংলায়)</td>
                            <td style="border-color:#E5C062">{{ $user->bnprepostoffice }}</td>
                        </tr>
                        <tr>
                            <td style="border-color:#E5C062">ইউনিয়ন (ইংরেজিতে)</td>
                            <td style="border-color:#E5C062">{{ $user->enpreroad }}</td>
                            <td style="border-color:#E5C062">ইউনিয়ন (বাংলায়)</td>
                            <td style="border-color:#E5C062">{{ $user->bnpreroad }}</td>
                        </tr>
                        <tr>
                            <td style="border-color:#E5C062">উপজেলা/থানা (ইংরেজিতে)</td>
                            <td style="border-color:#E5C062">{{ $user->enpreupazilla }}</td>
                            <td style="border-color:#E5C062">উপজেলা/থানা (বাংলায়)</td>
                            <td style="border-color:#E5C062">{{ $user->bnpreupazilla }}</td>
                        </tr>
                        <tr>
                            <td style="border-color:#E5C062">জেলা (ইংরেজিতে)</td>
                            <td style="border-color:#E5C062">{{ $user->enpredistrict }}</td>
                            <td style="border-color:#E5C062">জেলা (বাংলায়)</td>
                            <td style="border-color:#E5C062">{{ $user->bnpredistrict }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="width: 100%; padding:5px 10px; margin-top: 10px; background:#E5C062; border: 0px solid #E5C062; color: #000;">
                    <table style="width: 100%;  border: 0px solid #E5C062;">
                        <tr style=" border: 0px solid #E5C062;">
                            <td style="border: 0px solid #E5C062; font-size: 25px; font-weight: bold; text-align: center;">
                                স্থায়ী ঠিকানা
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="width: 100%; padding:10px;background:#F8F9F9; font-family: 'SolaimanLipi', sans-serif;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 20%; border-color:#E5C062">হোল্ডিং নম্বর (ইংরেজিতে)</td>
                            <td style="border-color:#E5C062">{{ $user->enparholdingno }}</td>
                            <td style="width: 20%; border-color:#E5C062">হোল্ডিং নম্বর (বাংলায়)</td>
                            <td style="border-color:#E5C062">{{ $user->bnparholdingno }}</td>
                        </tr>
                        <tr>
                            <td style="width: 20%; border-color:#E5C062">গ্রাম/মহল্লা (ইংরেজিতে)</td>
                            <td style="border-color:#E5C062"> {{ $user->enparvillage }}</td>
                            <td style="width: 20%; border-color:#E5C062">গ্রাম/মহল্লা (বাংলায়)</td>
                            <td style="border-color:#E5C062">{{ $user->bnparvillage }}</td>
                        </tr>
                        <tr>
                            <td style="border-color:#E5C062">ওয়ার্ড নং (ইংরেজিতে)</td>
                            <td style="border-color:#E5C062">{{ $user->enparwardno }}</td>
                            <td style="border-color:#E5C062">ওয়ার্ড নং (বাংলায়)</td>
                            <td style="border-color:#E5C062">{{ $user->bnparwardno }}</td>
                        </tr>
                        <tr>
                            <td style="border-color:#E5C062">পোষ্ট অফিস (ইংরেজিতে)</td>
                            <td style="border-color:#E5C062">{{ $user->enparpostoffice }}</td>
                            <td style="border-color:#E5C062">পোষ্ট অফিস (বাংলায়)</td>
                            <td style="border-color:#E5C062">{{ $user->bnparpostoffice }}</td>
                        </tr>
                        {{-- <tr>
                                <td style="border-color:#E5C062">ইউনিয়ন (ইংরেজিতে)</td>
                                <td style="border-color:#E5C062">{{ $user->enparroad }}
                </td>
                <td style="border-color:#E5C062">ইউনিয়ন (বাংলায়)</td>
                <td style="border-color:#E5C062">{{ $user->bnparroad }}</td>
            </tr>
            <tr>
                <td style="border-color:#E5C062">উপজেলা/থানা (ইংরেজিতে)</td>
                <td style="border-color:#E5C062">{{ $user->enparupazilla }}</td>
                <td style="border-color:#E5C062">উপজেলা/থানা (বাংলায়)</td>
                <td style="border-color:#E5C062">{{ $user->bnparupazilla }}</td>
            </tr>
            <tr>
                <td style="border-color:#E5C062">জেলা (ইংরেজিতে)</td>
                <td style="border-color:#E5C062">{{ $user->enpardistrict }}</td>
                <td style="border-color:#E5C062">জেলা (বাংলায়)</td>
                <td style="border-color:#E5C062">{{ $user->bnpardistrict }}</td> --}}
            </tr>
            </table>
            </td>
            </tr>
            <tr>
                <td colspan="4" style="width: 100%; padding:5px 10px; margin-top: 10px; background:#E5C062; border: 0px solid #E5C062; color: #000;">
                    <table style="width: 100%;  border: 0px solid #E5C062;">
                        <tr style=" border: 0px solid #E5C062;">
                            <td style="border: 0px solid #E5C062; font-size: 25px; font-weight: bold; text-align: center; border-color:#E5C062">
                                যোগাযোগের ঠিকানা (অফিস)
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="width: 100%; padding:10px;background:#F8F9F9;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 20%; border-color:#E5C062">
                                মোবাইল নাম্বার
                            </td>
                            <td style="border-color:#E5C062">
                                017505045650
                            </td>
                            <td style="width: 20%; border-color:#E5C062">
                                ই-মেইল ঠিকানা
                            </td>
                            <td style="border-color:#E5C062">
                                info@yourmail.com
                            </td>
                        </tr>
                        <tr>
                            <td style="border-color:#E5C062">
                                সংযুক্তি যদি থাকে (ইংরেজিতে)
                            </td>
                            <td style="border-color:#E5C062">
                                ---------
                            </td>
                            <td style="border-color:#E5C062">
                                সংযুক্তি যদি থাকে (বাংলায়)
                            </td>
                            <td style="border-color:#E5C062">
                                -----------
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr style="background: #ADD3CA">
                <td colspan="4" style="padding: 10px 0px; text-align: center; ">
                    ফ্রীলান্সার আইটি কর্তৃক সর্বসত্ত্ব সংরক্ষিত ।
                </td>
            </tr>
            </table>

            <div class="row">
                <div class="col-xs-6">
                    <?php
                    // dd($user);
                    //dump($settings[0]);
                    ?>
                </div>
            </div>

        </div>
    </div>
    @endif
</body>

</html>
