<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('assets/pdf/css/style.css') }}">
    <title></title>
</head>
@php
    $title = explode(',', $settings->name);
@endphp

<body class="cc-body">
    <button id="printPageButton" onClick="window.print();">Print</button>

    <div class="citizenship-certificate">
        <div class="container">
            <div class="cc-header">
                <table style="width: 100%">
                    <tr>
                        <td style="text-align: left; width:30%"> <img
                                src="{{ asset('assets/pdf/images/lalmonirhat-powrasava.jpeg') }}" alt="logo"></td>
                        <td style="text-align: center;width:40%;">
                            <h1>{{ $title[0] ?? '' }}</h1>
                            <h2>জেলা : {{ $title[1] ?? '' }}</h2>
                               স্থাপিত : {{ e_to_b(1972) }}
                        </td>
                        <td style="text-align: right;width:30%;">{!! $qr_code !!}</td>
                    </tr>
                </table>

            </div>
            <br>

            <table style="width: 100%">
                <tr>
                    <td style="text-align: left; width:30%"> লা:পৌ:স:/{{ e_to_b(\Carbon\Carbon::parse($fdata->created_at)->format('Y'))}}/{{ e_to_b($fdata->id) }}</td>
                    <td style="text-align: center;width:40%;">

                    </td>
                    <td style="text-align: right;width:30%;">
                        <p>তারিখঃ {{ e_to_b($fdata->created_at->format('d-m-Y')) }} </p>
                    </td>
                </tr>
            </table>
            <div style="text-align: center;">
                <h4>না গ রি ক ত্ব</h4>
                @if ($fdata->user->user_type==1)
                <h3>সনদপত্র</h3>
                @elseif ($fdata->user->user_type==0)
                <h3>প্রত্যায়ন পত্র</h3>
                @endif

            </div>



            <div class="cc-main-body">
                <p style="font-size: 16px; line-height:26px;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    এই মর্মে প্রত্যয়ন করা যাইতেছে যে <span
                        style="text-decoration: underline;">{{ $fdata->name }}</span>,
                    পিতাঃ <span
                        style="text-decoration: underline;">{{ isset($fdata->father) ? $fdata->father : null }}</span>,
                    মাতাঃ <span
                        style="text-decoration: underline;">{{ isset($fdata->mother) ? $fdata->mother : null }}</span>,


                    <?php if($fdata->bc_no !="" && $fdata->nid_no !=""){ ?>,

                    জন্ম নিবন্ধন নং {{ $fdata->bc_no }},

                    জাতীয় পরিচয়পত্র নং {{ $fdata->nid }},

                    <?php } else if(!empty($fdata->bc_no)) { ?>

                    জন্ম নিবন্ধন নং {{ $fdata->bc_no }},

                    <?php } else if(!empty($fdata->nid)) { ?>

                    জাতীয় পরিচয়পত্র নং {{ $fdata->nid }},

                    <?php } ?>

                    গ্রাম/মহল্লাঃ <span
                        style="text-decoration: underline;">{{ isset($fdata->moholla->bn_name) ? $fdata->moholla->bn_name : $fdata->moholla->name }}
                    </span>,
                    ডাকঘরঃ
                    {{ isset($fdata->postOffice->bn_name) ? $fdata->postOffice->bn_name : $fdata->postOffice->name }},
                    উপজেলাঃ
                    {{ isset($fdata->upazila->bn_name) ? $fdata->upazila->bn_name : $fdata->upazila->name }},
                    জেলাঃ {{ isset($fdata->district->bn_name) ? $fdata->district->bn_name : $fdata->district->name }}।

                    তিনি
                    {{ isset($fdata->postOffice->bn_name) ? $fdata->postOffice->bn_name : $fdata->postOffice->name }}
                    পৌরসভার
                    <span style="text-decoration: underline;">
                        {{ isset($fdata->ward->bn_name) ? $fdata->ward->bn_name : $fdata->ward->name }} নং</span>,
                    ওয়ার্ডের স্থায়ী
                    বাসিন্দা এবং বাংলাদেশের প্রকৃত নাগরিক। <br> <br>

                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    আমি তাহার উজ্জ্বল ভবিষ্যৎ কামনা করি।
                </p>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>

            <table style="width: 100%">
                <tr>

                    <td style="text-align: center;font-size: 16px; width:33.33%;">

                        @if (isset($fdata->transactionLog->digital_accept_by))
                            {{ $fdata->transactionLog->digitalAcceptBy->name ?? '' }}
                            <br>
                            <img src="{{ asset($fdata->transactionLog->digitalAcceptBy->signature) }}" alt=""
                                height="50px" width="200px">
                            <br>
                            প্রস্তুতকারী
                            <br>
                            {{ $settings->name ?? '' }}
                            <br>
                            মোবাইলঃ {{ e_to_b($fdata->transactionLog->digitalAcceptBy->phone) }}
                        @endif

                    </td>
                    <td style="text-align: center;font-size: 16px; width:33.33%;">
                        @if (isset($fdata->ward->name))
                            {{-- <p> নাম :</p> --}}
                            {{ isset($fdata->ward->bn_name) ? $fdata->ward->bn_name : $fdata->ward->name }} নং ওয়ার্ড
                            কাউন্সিলর
                            <br>

                            {{ $settings->name ?? '' }}
                        @endif
                    </td>
                    <td style="text-align: center;font-size: 16px; width:33.33%;">
                        @if (isset($settings))
                            {{ $settings->mayor_name ?? '' }} <br>
                            <img src="{{ asset($settings->mayor_signature) }}" alt="" height="50px"
                                width="200px">
                            <br>
                            প্রশাসক
                            <br>
                            {{ $settings->name ?? '' }}
                            <br>

                            মোবাইলঃ {{ e_to_b($settings->phone ?? '') }}
                        @endif

                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
