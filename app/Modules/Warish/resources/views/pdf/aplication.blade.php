<!DOCTYPE html>
<html>

<head>
    @php

        $tp_info = json_decode($mdata->payment_info, true);
        $pagetaitle = 'Warish application ';
    @endphp
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ $pagetaitle }} </title>

    <style type="text/css">
        /* @page {
            header: page-header;
            footer: page-footer;
            margin-top: 150px;
            background: url("/frontend/img/warish_aplication.jpg") no-repeat 0 0;
            background-image-resize: 6;
        } */

        body {
            font-family: solaimanlipi;
            margin: 0;
            padding: 0;
            transform: scale(0.8);
            /* Scale content to 80% */
            transform-origin: top left;
            /* Scale from the top-left corner */
        }

        table,
        th,
        td {
            border-collapse: collapse;
            border: 0px solid #EEEEEE !important;
            padding: 3px 5px;
        }

        table>tr>td>table>tr>td {
            border: 0px solid #000000 !important;
        }

        table {
            table-layout: fixed;
            width: 100%;
        }

        table td {
            word-wrap: break-word;
            /* All browsers since IE 5.5+ */
            overflow-wrap: break-word;
            /* Renamed property in CSS3 draft spec */
        }

        .bable2 table,
        .bable2 th,
        .bable2 td {
            border: 1px solid black;
            border-collapse: collapse;
            table-layout: fixed;


        }

        .bable2 {
            border: 1px solid black;
            table-layout: fixed;


        }

        .container {
            width: 100%;
            margin: auto;
            padding: 0 15px;
            display: block;
        }

        .design-head {
            background: #fff;
            color: #0b3e6f;
            font-weight: bold;
            font-size: 24px;
            border: 5px solid #0b3e6f;
            width: 150px;
            margin: auto;
            text-align: center;
        }

        .para {
            text-indent: 40px;
            text-align: justify;

        }


        .aplication {
            line-height: 20px;
        }

        .aplication p {
            margin: 0px;
        }

        .certificate-titel {
            background: #0b3e6f;
            color: #fff;
            text-align: center;
            padding: 5px;
            display: block
        }
    </style>
</head>

<body>



    @if (Route::has('login'))


        <div class="container" style="background:#ADD3CA">

            <table style="width: 100%;  border: 0px solid #000;">

                <tr>
                    <td style="text-align: center; width:25%;">
                        {{-- <img src="{{ $settings->logo }}" alt="" width="80" height="80"> --}}
                    </td>
                    <td
                        style="width:50%;padding-left:30px; font-size: 25px; color:#000; text-align: center; font-weight: bold">
                        <div style="display: block">


                            <h3 style="font-size: 30px; ">
                                {{ $settings->name }}

                            </h3>

                        </div>
                    </td>
                    <td style="text-align: center; width:25%;">



                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; width:25%;">
                        <p>ক্রমিক নং - {{ e_to_b($mdata->id) }}</P>
                    </td>
                    <td
                        style="width:50%;padding-left:30px; font-size: 25px; color:#000; text-align: center; font-weight: bold">
                        <div style="display: block">


                        </div>
                    </td>
                    <td style="text-align: center; width:25%;">
                        <p>তারিখঃ - {{ e_to_b(date('d.m.Y', strtotime($mdata->updated_at))) }} খ্রিস্টাব্দ</P>
                    </td>
                </tr>
            </table>


        </div>

        {{-- <htmlpagefooter name="page-footer">

            <table border="0" style="width:100%;margin:auto;">
                <tr>

                    <td colspan="2" style="padding: 10px; text-align: left; font-size:17px;">

                    </td>
                    <td colspan="2" style="padding: 10px; text-align: right; font-size: 17px;">

                    </td>

                </tr>
                <tr style="background:#ADD3CA">

                    <td colspan="2" style="padding: 10px; text-align: left; font-size:17px;">
                        ফ্রীলান্সার আইটি কর্তৃক সর্বসত্ত্ব সংরক্ষিত ।
                    </td>
                    <td colspan="2" style="padding: 10px; text-align: right; font-size: 17px;">
                        ডিজিটাল বাংলাদেশ বিনির্মাণে আমরা অঙ্গীকারব্ধ ।
                    </td>

                </tr>


            </table>

        </htmlpagefooter> --}}

        <br>
        <br>
        <div style="width: 90%; margin:auto">
            <div class="aplication">
                <p>বরাবর</p>
                <p class="para">মেয়র</p>
                <p class="para"> মোহনগঞ্জ পৌরসভা, মোহনগঞ্জ ।</p>
                <p class="para"> বিষয়ঃ ওয়ারেশ কায়েম সনদ পাইবার আবেদন।</p>
                <p>জনাব,</p>
                <p class="para">
                    সম্মান পূর্বক নিবেদন এইে যে, মৃত {{ $fdata->name }}, পিং/জং
                    {{ isset($fdata->father) ? $fdata->father : null }},
                    আপনার পৌর এলাকার {{ isset($fdata->ward->bn_name) ? $fdata->ward->bn_name : $fdata->ward->name }} নং
                    ওয়ার্ডের অর্ন্তগত
                    {{ isset($fdata->moholla->bn_name) ? $fdata->moholla->bn_name : $fdata->moholla->name }} গ্রাম /
                    মহল্লার অধিবাসী মৃত্যুঅন্তে নিম্নবর্ণিত
                    ওযারিশগণ রাখিয়া গিয়াছেন।
                </p>


            </div>
            <h4>ওয়ারিশগণ বিবরণঃ </h4>
            @if (count($fdata->details) > 8)
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
                            @foreach ($fdata->details as $key => $odata)
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

            @foreach ($fdata->details as $key => $odata)
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



    <h4>মোটঃ {{ e2b(count($fdata->details)) }} জন ।</h4>
    <p>
        এই মর্মে অঙ্গীকারাবদ্ধ হইতেছি যে, উল্লেখিত যাবতীয় তথ্য সঠিক । তথ্যে ভুল ত্রুটি থাকিলে কর্তৃপক্ষ আমার
        বিরুদ্ধে
        শাস্তিমূলক ব্যবস্থা গ্রহণ করিতে পারিবেন । এমমতাবস্থায় বর্ণিত তথ্যেও ভিত্তিতে
        {{ e2b($fdata->qty) }} খানা ওয়ারেশ সনদ
        প্রদানের আদেশ দানে মর্জি হয় ।
    </p>







    <table style="width: 100%;  border: 0px solid #000;">
        <tr>
            <td style="width: 60%; text-align: left">
                <br><br><br>
            </td>

            <td style="width: 40%;text-align: left">

                নামঃ {{ $fdata->application_name }}<br>
                সর্ম্পকঃ {{ e2b($fdata->application_relation) }}<br>
                ঠিকানাঃ {{ $fdata->application_address }}<br>
            </td>
        </tr>
        <tr>
            <td style="width: 60%; text-align: left">

            </td>

            <td style="width: 40%;text-align: left">
                <br>
                <br>

                প্রয়োজনীয় ব্যবস্থা নেয়ার জন্য বলা হল ।

            </td>


        </tr>


    </table>

    <br>
    <br>
    <br>

    <table style="width: 100%;  border: 0px solid #000;">
        <tr>
            <td style="width: 40%; text-align: left">

                ওয়ার্ড কাউন্সিলরের মতামত ও সুপারিশ
                <br>
                <br>
                <br>
                {{ isset($fdata->ward->bn_name) ? e_to_b($fdata->ward->bn_name) : $fdata->ward->name }} নং ওয়ার্ড কাউন্সিলরের স্বাক্ষর


            </td>
            <td style="width: 30%; text-align: center">

            </td>
            <td style="width: 30%;text-align: center">
                <p>
                    @if (isset($rules->singtur_two_img))
                        <img src="{{ $rules->singtur_two_img }}" alt="" width="80">
                    @endif
                </p>
                <p style="text-align: center">
                    {!! $rules->singtur_two_text !!}
                </p>

            </td>

        </tr>
    </table>

    </div>
    @endif
</body>

</html>
