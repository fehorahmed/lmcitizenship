<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('assets/pdf/css/style.css') }}">
    <title>Warish Certificate</title>
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
                                src="{{ asset('assets/pdf/images/lalmonirhat-powrasava.png') }}" alt="logo"></td>
                        <td style="text-align: center;width:40%;">
                            <h2>{{ $title[0] ?? '' }}</h2>
                            <h3>জেলা : {{ $title[1] ?? '' }}</h3>
                            স্থাপিত : {{ e_to_b(1972) }} <br>
                            ওয়েবসাইট : {{ $settings->website ?? '' }}<br>
                            ইমেইল : {{ $settings->email ?? '' }}

                        </td>
                        <td style="text-align: right;width:30%;">{!! $qr_code !!}</td>
                    </tr>
                </table>

            </div>
            <br>

            <table style="width: 100%">
                <tr>
                    <td style="text-align: left; width:30%"> স্মারক নং-
                        লা:পৌ:স:/{{ e_to_b(\Carbon\Carbon::parse($fdata->created_at)->format('Y')) }}/{{ e_to_b($fdata->id) }}
                    </td>
                    <td style="text-align: center;width:40%;">

                    </td>
                    <td style="text-align: right;width:30%;">
                        <p>তারিখঃ {{ e_to_b($fdata->created_at->format('d-m-Y')) }} </p>
                    </td>
                </tr>
            </table>
            <div style="text-align: center;">
                <h4>ওয়ারিশন</h4>

                <h3>সনদপত্র</h3>


            </div>

            <div class="cc-main-body">
                <p class="para" style="font-size: 16px;">
                    এই মর্মে ওয়ারিশন সনদ প্রদান করা যাইতেছে যে,
                    {{ isset($fdata->warish->upazila->bn_name) ? $fdata->warish->upazila->bn_name : $fdata->warish->upazila->name }}
                    পৌরসভার
                    <u>{{ isset($fdata->warish->ward->bn_name) ? e_to_b($fdata->warish->ward->bn_name) : $fdata->warish->ward->name }}</u>
                    নং ওয়ার্ডের
                    অন্তর্গত
                    <u>{{ isset($fdata->warish->moholla->bn_name) ? $fdata->warish->moholla->bn_name : $fdata->warish->moholla->name }}</u>
                    গ্রাম/মহল্লা নিবাসী
                    মৃত <u>{{ $fdata->warish->name }}</u>, পিং/জং
                    <u>{{ isset($fdata->warish->father) ? $fdata->warish->father : null }}</u>
                    , গত <u>{{ e_to_b(date('d.m.Y', strtotime($fdata->warish->date_of_death))) }}</u> ইং তারিখে
                    মৃত্যুবরন
                    করেন।
                    তাহার মৃত্যুঅন্তে নিম্নে বর্ণিত ওয়ারেশগণ রাখিয়া যান।
                </p>
                <br>
                @if (count($fdata->warish->details) > 8)
                    <table style=" width:100%; margin:auto;" class="bable2">
                        <thead>
                            <tr>
                                <th scope="col" style="width:80px">ক্রমিক নং</th>
                                <th scope="col">নাম</th>
                                <th scope="col">সম্পর্ক</th>
                                <th scope="col" style="width:80px">ক্রমিক নং</th>

                                <th scope="col">নাম</th>
                                <th scope="col">সম্পর্ক</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($fdata->warish->details as $key => $odata)
                                    <td style="text-align:center">
                                        {{ e_to_b($key + 1) }}
                                    </td>
                                    <td style="text-align:center">
                                        {{ $odata['name'] }}
                                    </td>
                                    <td style="text-align:center">

                                        {{ e2b($odata['relation']) }}

                                    </td>

                                    @if (($key + 1) % 2 == 0)
                            </tr>
                            <tr>
                @endif
                @endforeach

                </tr>
                </tbody>
                </table>
            @else
                <table style=" width:100%; margin:auto;" class="bable2">
                    <thead>
                        <tr>
                            <th scope="col" style="width:80px">ক্রমিক নং</th>
                            <th scope="col">নাম</th>
                            <th scope="col">সম্পর্ক</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($fdata->warish->details as $key => $odata)
                            <tr>


                                <td style="text-align:center">
                                    {{ e_to_b($key + 1) }}
                                </td>
                                <td style="text-align:center">
                                    {{ $odata['name'] }}
                                </td>
                                <td style="text-align:center">

                                    {{ e2b($odata['relation']) }}

                                </td>


                            </tr>
                        @endforeach


                    </tbody>
                </table>
                @endif
            </div>
            <br>
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
                        @if (isset($fdata->warish->ward->name))
                            {{ $fdata->warish->ward->commissioner_name }} <br>
                            @if (isset($fdata->warish->ward->commissioner_signature))
                                <img src="{{ asset($fdata->warish->ward->commissioner_signature) }}" alt=""
                                    height="50px" width="200px">
                                <br>
                            @endif
                            {{ isset($fdata->warish->ward->bn_name) ? $fdata->warish->ward->bn_name : $fdata->warish->ward->name }}
                            নং ওয়ার্ড
                            কাউন্সিলর
                            <br>
                            {{ $settings->name ?? '' }}
                            <br>
                            মোবাইলঃ {{ e_to_b($fdata->warish->ward->commissioner_phone ?? '') }}
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
