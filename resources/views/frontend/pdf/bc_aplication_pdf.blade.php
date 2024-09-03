<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>  জন্ম নিবন্ধনের আবেদন</title>

    <style type="text/css">
        body {
            font-family: 'Nikosh', 'Arial', sans-serif;
            font-size: 17px;
        }

        table, th, td {
            border-collapse: collapse;
            border: 0px solid #EEEEEE !important;
            padding: 3px 5px;
        }

        table > tr > td > table > tr > td {
            border: 0px solid #000000 !important;
        }
        table {
            table-layout: fixed;
            width: 100%;
        }

        table td {
            word-wrap: break-word;         /* All browsers since IE 5.5+ */
            overflow-wrap: break-word;     /* Renamed property in CSS3 draft spec */
        }

        .bable2 table, .bable2 th, .bable2 td {
            border: 1px solid black;
            border-collapse: collapse;
            table-layout: fixed;


        }
        .bable2{
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

        @page {
            header: page-header;
            footer: page-footer;
            margin-top: 150px;
        }



    </style>
</head>
<body>

<?php
$rent_status =  ['Paid' => 'পরিশোধিত',
    'Unpaid' => 'অপরিশোধিত',
    'Pending' => 'অপেক্ষারত পেমেন্ট' ];

$title = explode(',',$settings->com_name);





//dump($shop);
$mdata = $data;
$i = 0;
$total = [];
?>

@if (Route::has('login'))

    <htmlpageheader name="page-header">
        <div class="container">

            <table style="width: 100%;  border: 0px solid #000;">
                <tr>
                    <td style="text-align: center; width:20%;" >
                        <img src="{{ $settings->com_logourl }}" alt="" width="80" height="80">
                    </td>
                    <td style="width:60%;padding-left:30px; font-size: 25px; color:#000; text-align: center; font-weight: bold">
                        <div style="display: block">


                            <h2 style="font-size: 30px; ">
                                {{ $title[0] }}

                            </h2>
                            @if(isset($title[1]))

                                <h3 style="font-size: 20px; margin-top: 0;">{{$title[1]}}</h3>

                            @endif

                            <p style="font-size: 5px"> &nbsp;</p>
                            <p style="background: #0b3e6f; color: #fff;border-radius:30px; border: 5px solid #0b3e6f; margin-top: 50px; font-size: 18px">
                                জন্ম নিবন্ধনের আবেদন

                            </p>
                            <p style="font-size: 5px"> &nbsp;</p>

                        </div>
                    </td>
                    <td style="text-align: center; width:20%;" >

                    </td>
                </tr>
            </table>

            <table style="width:100%; border: 1px solid #000" class="bable2" >

                <tr>

                    <td> আবেদন আইডিঃ {{ e_to_b($mdata->id) }} </td>
                    <td>  ভাষাঃ {{ e_to_b($mdata->request_lang) }} </td>
                    <td>  আবেদনের ধরনঃ {{ e_to_b($mdata->request_type) }} </td>
                    <td>  স্ট্যাটাসঃ {{ e_to_b($mdata->request_status) }} </td>



                </tr>
            </table>

        </div>
    </htmlpageheader>
    <htmlpagefooter name="page-footer">

        <table border="0" style="width:100%;margin:auto;" >
            <tr>

                <td colspan="2" style="padding: 10px; text-align: left; font-size:17px;">

                </td>
                <td colspan="2" style="padding: 10px; text-align: right; font-size: 17px;">
                    @php
                        $footer = ' পেইজ নং - {PAGENO}'
                    @endphp
                    <span style="color: #000; font-size: 12px">{{ e_to_b($footer) }}</span>
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

    </htmlpagefooter>

    <div class="container">


        <table style="width:100%;margin:auto; text-align: left" class="bable2">

            <tr style="background: #9E5BBA !important; color: #FFF; text-align: left">
                <th style="color: #FFF;"> বিবরণ</th>
                <th style="color: #FFF;"> বাংলা</th>
                <th style="color: #FFF;"> ইংরেজি</th>
            </tr>
            <tr style="text-align: left">
                <th style="text-align: left">  নামঃ</th>
                <th style="text-align: left">  {{$mdata->bnname}} </th>
                <th style="text-align: left">  {{$mdata->name}}</th>
            </tr>
            <tr>
                <th style="text-align: left">  পিতার নামঃ</th>
                <th style="text-align: left">  {{$mdata->bnfathername}} </th>
                <th style="text-align: left">  {{$mdata->enfathername}}</th>
            </tr>

            <tr>
                <th style="text-align: left">  মাতার নামঃ</th>
                <th style="text-align: left">  {{$mdata->bnmothername}} </th>
                <th style="text-align: left">  {{$mdata->enmothername}}</th>
            </tr>
            <tr>
                <th style="text-align: left">  লিঙ্গঃ</th>
                <th style="text-align: left">  {{ e_to_b($mdata->gender) }} </th>
                <th style="text-align: left">  {{$mdata->gender}}</th>
            </tr>
            <tr>
                <th style="text-align: left">   জন্ম তারিখঃ</th>
                <th style="text-align: left">  {{ e_to_b(date('d-m-Y', strtotime($mdata->birthday))) }} </th>
                <th style="text-align: left">  {{ date('d-m-Y', strtotime($mdata->birthday)) }}</th>
            </tr>
            <tr style="background: #9E5BBA !important; color: #FFF; text-align: left">
                <th style="text-align: center; color: #FFF;" colspan="3">   বর্তমান ঠিকানা</th>

            </tr>
            <tr>
                <th style="text-align: left">  হোল্ডিং নম্বর</th>
                <th style="text-align: left">  {{$mdata->bnpreholdingno}} </th>
                <th style="text-align: left">  {{$mdata->enpreholdingno}}</th>
            </tr>
            <tr>
                <th style="text-align: left">  গ্রাম/মহল্লা</th>
                <th style="text-align: left">  {{$mdata->bnprevillage}} </th>
                <th style="text-align: left">  {{$mdata->enprevillage}}</th>
            </tr>
            <tr>
                <th style="text-align: left">  ইউনিয়ন</th>
                <th style="text-align: left">  {{$mdata->bnpreroad}} </th>
                <th style="text-align: left">  {{$mdata->enpreroad}}</th>
            </tr>
            <tr>
                <th style="text-align: left">  ওয়ার্ড নং</th>
                <<th style="text-align: left">  {{$mdata->bnprewardno}} </th>
                <th style="text-align: left">  {{$mdata->enprewardno}}</th>
            </tr>

            <tr>
                <th style="text-align: left">   পোষ্ট অফিস</th>
                <th style="text-align: left">  {{$mdata->bnprepostoffice}} </th>
                <th style="text-align: left">  {{$mdata->enprepostoffice}}</th>
            </tr>
            <tr>
                <th style="text-align: left">   উপজেলা / থানা</th>
                <th style="text-align: left">  {{$mdata->bnpreupazilla}} </th>
                <th style="text-align: left">  {{$mdata->enpreupazilla}}</th>
            </tr>
            <tr>
                <th style="text-align: left">   জেলা </th>
                <th style="text-align: left">  {{$mdata->bnpredistrict}} </th>
                <th style="text-align: left">  {{$mdata->enpreupazilla}}</th>

            </tr>







        </table>


    </div>


@endif
</body>
</html>