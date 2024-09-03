<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> {{ isset($data->title)? $data->title: '' }}
        {{ ($data->payment_type)? ('['.e_to_b($data->payment_type).']') : null }} এর আবেদন</title>

    <style type="text/css">
        body {
            /* font-family: 'Nikosh', 'Arial', sans-serif; */
            font-size: 17px;
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

        @page {
            header: page-header;
            footer: page-footer;
            margin-top: 150px;
        }
    </style>
</head>

<body>

    <?php
    $rent_status =  [
        'Paid' => 'পরিশোধিত',
        'Unpaid' => 'অপরিশোধিত',
        'Pending' => 'অপেক্ষারত পেমেন্ট'
    ];

    $title = explode(',', $settings->name);





    //dump($shop);
    $mdata = $data;
    $i = 0;
    $total = [];


    // dump($data);

    ?>

    @if (Route::has('login'))

    <htmlpageheader name="page-header">
        <div class="container">

            <table style="width: 100%;  border: 0px solid #000;">
                <tr>
                    <td style="text-align: center; width:20%;">
                        {{-- <img src="{{ $settings->logo }}" alt="" width="80" height="80"> --}}
                    </td>
                    <td
                        style="width:60%;padding-left:30px; font-size: 25px; color:#000; text-align: center; font-weight: bold">
                        <div style="display: block">


                            <h2 style="font-size: 30px; ">
                                {{ $title[0] }}

                            </h2>
                            @if(isset($title[1]))

                            <h3 style="font-size: 20px; margin-top: 0;">{{$title[1]}}</h3>

                            @endif

                            <p style="font-size: 5px"> &nbsp;</p>
                            <p
                                style="background: #0b3e6f; color: #fff;border-radius:30px; border: 5px solid #0b3e6f; margin-top: 50px; font-size: 18px">
                                {{ $data->payment_type }} এর আবেদন

                            </p>
                            <p style="font-size: 5px"> &nbsp;</p>

                        </div>
                    </td>
                    <td style="text-align: center; width:20%;">

                    </td>
                </tr>
            </table>

            {{-- <table style="width:100%; border: 1px solid #000" class="bable2">

                <tr>

                    <td>Service: {{ $data->payment_type }}</td>


                </tr>
            </table> --}}

        </div>
    </htmlpageheader>
    <htmlpagefooter name="page-footer">

        <table border="0" style="width:100%;margin:auto;">
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
                <th>Title</th>
                <th> Discription</th>
            </tr>
            <tr>
                <td>
                    <p>User Info</p>
                </td>
                <td>
                    <p>নামঃ {{ $data->user->name }}<br>
                        পিতার নামঃ {{ $data->user->father_name }}<br>
                        মোবাইলঃ {{ $data->user->phone }}<br>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Digital Center</p>
                </td>
                <td>
                    <p>
                        {{ (isset($data->digi_user->name))?$data->digi_user->name :'N/A' }}<br>

                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Payment info</p>
                </td>
                @php
                    $payment_detail= json_decode($data->payment_info);
                    //  dd($payment_detail);
                @endphp
                <td>
                    <p>
                        <b>পেমেন্ট মেথডঃ </b> {{ e_to_b($payment_detail->payment_method) }}<br>
                        <b>পরিমাণঃ </b> {{ e_to_b($data->amount) }} টাকা<br>
                        <b>তারিখঃ </b> {{ e_to_b(date("d-F-Y", strtotime($payment_detail->date))) }}<br>
                    </p>
                </td>
            </tr>
            @if($payment_detail->payment_method == 'Cash')
            <tr>
                <td>
                    <p>Receipt no</p>
                </td>
                <td>
                    <p>{{ $payment_detail->receipt_no }}
                    </p>
                </td>
            </tr>
            @endif
            @if($payment_detail->tid)
            <tr>
                <td>
                    <p>Transaction ID</p>
                </td>
                <td>
                    <p>{{ $payment_detail->tid }}
                    </p>
                </td>
            </tr>
            @endif
            @if($payment_detail->number)
            <tr>
                <td>
                    <p>Transaction Number</p>
                </td>
                <td>
                    <p>{{ $payment_detail->number }}
                    </p>
                </td>
            </tr>
            @endif

            @if($payment_detail->bank)
            <tr>
                <td>
                    <p>Pay Order / Bank Draft no</p>
                </td>
                <td>
                    <p>{{ $payment_detail->payorder }}
                    </p>
                </td>
            </tr>
            @endif

            @if($payment_detail->bank)
            <tr>
                <td>
                    <p>Bank Branch</p>
                </td>
                <td>
                    <p>{{ $payment_detail->bank }}
                    </p>
                </td>
            </tr>
            @endif




        </table>
        <br>
        <br>
        <br>


        <table style="width:100%;margin:auto;" class="bable2">

            <tr style="background: #9E5BBA !important; color: #FFF;">
                <th colspan="3">Attachments</th>

            </tr>
            <tr>
                <td>
                    <p>National ID</p>
                    <p>{{ $data->nid_info }}</p>

                </td>
                <td>
                    <p>Citizenship ID</p>
                    <p>{{ $data->citizenship_info }}</p>

                </td>

                <td>
                    <p>User Photo</p>

                </td>
            </tr>
            <tr>
                <td>
                    @if($data->nid_file)

                    {{-- <p> <img src="{{ url($data->nid_file) }}" style="width:200px" /></p> --}}
                    @else
                    N/A
                    @endif
                </td>
                <td>
                    @if($data->nid_file)

                    {{-- <p> <img src="{{ url($data->citizenship_file) }}" style="width:200px" /></p> --}}
                    @else
                    N/A
                    @endif
                </td>

                <td>
                    @if($data->nid_file)
                    {{-- <p> <img src="{{ url($data->photo_file) }}" style="width:200px" /></p> --}}
                    @else
                    N/A
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    @if($data->photo_file)
                    <a href="{{ url($data->nid_file) }}"> Link</a>
                    @else
                    N/A
                    @endif
                </td>
                <td>
                    @if($data->photo_file)
                    <a href="{{ url($data->citizenship_file) }}"> Link</a>
                    @else
                    N/A
                    @endif
                </td>

                <td>
                    @if($data->photo_file)
                    <a href="{{ url($data->photo_file) }}"> Link</a>
                    @else
                    N/A
                    @endif
                </td>
            </tr>


        </table>

    </div>


    @endif
</body>

</html>
