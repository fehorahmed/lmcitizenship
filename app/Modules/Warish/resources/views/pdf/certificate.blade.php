<!DOCTYPE html>
<html>

<head>
    @php

        $tp_info = json_decode($mdata->payment_info, true);
        $pagetaitle = 'Warish certificate ';

    @endphp
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ $pagetaitle }} </title>

    <style type="text/css">
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




        .certificate-titel {
            background: #0b3e6f;
            color: #fff;
            text-align: center;
            padding: 5px;
            display: block
        }

        p {
            font-size: 16px;
        }
    </style>
</head>

<body>

    <?php

    $title = explode(',', $settings->name);
    ?>

    @if (Route::has('login'))

        <div style="width: 70%; margin:auto;  line-height:26px">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <table style="width: 100%;  border: 0px solid #000;">

                <tr>
                    <td style="text-align: left;width:40%;">
                        <p>ক্রমিক নং - </p>
                        {{-- {{ e_to_b($mdata->id) }} --}}
                    </td>
                    <td style="">

                    </td>
                    <td style="text-align: right; width:40%;">
                        <p>তারিখঃ {{ e_to_b(date('d.m.Y', strtotime($mdata->updated_at))) }} খ্রিস্টাব্দ</P>
                    </td>
                </tr>
            </table>
            <br>
            <p class="para" style="font-size: 16px;">
                এই মর্মে ওয়ারিশন সনদ প্রদান করা যাইতেছে যে,
                {{ isset($fdata->upazila->bn_name) ? $fdata->upazila->bn_name : $fdata->upazila->name }} পৌরসভার
                <u>{{ isset($fdata->ward->bn_name) ? e_to_b($fdata->ward->bn_name) : $fdata->ward->name }}</u> নং
                ওয়ার্ডের
                অন্তর্গত <u>{{ isset($fdata->moholla->bn_name) ? $fdata->moholla->bn_name : $fdata->moholla->name }}</u>
                গ্রাম/মহল্লা নিবাসী
                মৃত <u>{{ $fdata->name }}</u>, পিং/জং
                <u>{{ isset($fdata->father) ? $fdata->father : null }}</u>
                , গত <u>{{ e_to_b(date('d.m.Y', strtotime($fdata->date_of_death))) }}</u> ইং তারিখে মৃত্যুবরন
                করেন।
                তাহার মৃত্যুঅন্তে নিম্নে বর্ণিত ওয়ারেশগণ রাখিয়া যান।
            </p>

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


    </div>

    <br><br><br> <br>
    <table style="width: 100%;  border: 0px solid #000;">
        <tr>
            <td style="width: 8%; text-align: center"></td>

            <td style="width: 28%; text-align: center;font-size: 16px;">
                প্রস্তুতকারীর নাম, স্বাক্ষর ও সীল
            </td>
            <td style="width: 28%; text-align: center">
                <p>
                    @if (isset($rules->singtur_one_img))
                        {{-- <img src="{{ $rules->singtur_one_img }}" alt="" width="80"> --}}
                    @endif
                </p>
                <p style="font-size: 16px;text-align: center">
                    {!! $rules->singtur_one_text !!}
                </p>


            </td>

            <td style="width: 28%;text-align: center">
                <p>
                    @if (isset($rules->singtur_two_img))
                        {{-- <img src="{{ $rules->singtur_two_img }}" alt="" width="80"> --}}
                    @endif
                </p>
                <p style="font-size: 16px;text-align: center">
                    {!! $rules->singtur_two_text !!}
                </p>

            </td>
            <td style="width: 8%;"></td>

        </tr>

    </table>


    @endif
</body>

</html>
