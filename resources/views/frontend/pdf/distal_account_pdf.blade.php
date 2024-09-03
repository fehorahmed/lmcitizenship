<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title> সমস্ত জমি </title>

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
                            হিসাব ব্যবস্থাপক

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
                <td>  সেবার নামঃ  {{ (!empty(Request::post('service_id')) ? get_service_name(Request::post('service_id')) : NULL) }} </td>
                <td>ভাষাঃ {{ (!empty(Request::post('for_which_language')) ? e_to_b(Request::post('for_which_language')) : NULL) }} </td>
                <td>     তারিখঃ  {{ (!empty(Request::post('from_date')) ? e_to_b(Request::post('from_date')) : NULL) }}  -
                    {{ (!empty(Request::post('to_date')) ? e_to_b(Request::post('to_date')) : NULL) }}
                </td>

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


    <table style="width:100%;margin:auto;" class="bable2">

        <tr style="background: #9E5BBA !important; color: #FFF;">
            <th>আই ডি</th>
            <th>  আবেদনকারী</th>
            <th> সেবার নাম</th>
            <th> ভাষা </th>
            <th> পেমেন্ট বিবরণ</th>
            <th> ট্রানসাকশান আই ডি</th>
            <th>  টাকা</th>


        </tr>


        @foreach($mdata as $income)
            @php
                $total[] = $income->amount;
            @endphp

            <tr>
                <td>{{ e_to_b($income->id) }}</td>

                <td>
                    <b>নামঃ </b>{{ $income->user->name }}<br>
                    <b> পিতার নামঃ </b>{{ $income->user->bnfathername }}<br>
                    <b>মোবাইলঃ </b>{{ e_to_b($income->user->phone )}}<br>
                </td>

                <td>{{ $income->service->name }}</td>
                <td>{{ ($income->for_which_language =='bn')? 'বাংলা': 'ইংরেজি' }}</td>
                <td>
                    <b>পেমেন্ট মেথডঃ </b> {{ e_to_b($income->payment_method) }}<br>
                    <b>পরিমাণঃ </b> {{ e_to_b($income->amount) }} টাকা<br>
                    <b>তারিখঃ </b> {{ e_to_b(date("d-F-Y", strtotime($income->created_at))) }}<br>

                </td>
                <td>{{ e_to_b($income->transaction_no) }}</td>
                <td>
                    {{ e_to_b($income->amount) }} টাকা

                </td>
            </tr>
        @endforeach
        <tr style="background: #9E5BBA !important; color: #FFF;">

            <td colspan="6">  মোটঃ </td>

            <td>
                {{ e_to_b(array_sum($total) )}}  টাকা
            </td>



        </tr>


    </table>


</div>


@endif
</body>
</html>