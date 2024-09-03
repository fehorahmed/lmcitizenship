<!DOCTYPE html>
<html>

<head>
    @php
        // $settings = \App\Setting::first();
        $tp_info = json_decode($mdata->payment_info, true);
        $pagetaitle = 'নাগরিকত্ব সনদ পেমেন্ট রশিদ';
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

        @page {
            header: page-header;
            footer: page-footer;
            margin-top: 150px;
        }
    </style>
</head>

<body>

    <?php

    $title = explode(',', $settings->name);
    ?>

    @if (Route::has('login'))
        <htmlpageheader name="page-header">
            <div class="container">
                <table style="width: 100%;  border: 0px solid #000;">
                    <tr>
                        <td style="text-align: center; width:20%;">
                            <img src="{{ $settings->logo }}" alt="" width="80" height="80">
                        </td>
                        <td
                            style="width:60%;padding-left:30px; font-size: 25px; color:#000; text-align: center; font-weight: bold">
                            <div style="display: block">


                                <h2 style="font-size: 30px; margin-top:0px; margin-bottom:0px;">
                                    {{ $title[0] }}

                                </h2>
                                @if (isset($title[1]))
                                    <h3 style="font-size: 20px; margin-top: 0; margin-bottom:0px;">{{ $title[1] }}
                                    </h3>
                                @endif

                                <p style="font-size: 5px"> &nbsp;</p>
                                <p
                                    style="background: #0b3e6f; color: #fff;border-radius:30px; border: 5px solid #0b3e6f; margin-top: 0px; font-size: 18px">
                                    {{ $pagetaitle }}

                                </p>
                                <p style="font-size: 5px"> &nbsp;</p>

                            </div>
                        </td>
                        <td style="text-align: center; width:20%;">

                        </td>
                    </tr>
                </table>
                <br>
                <br>
                <br>
                <table style="width: 100%;  border: 1px solid #000;">
                    <tr>
                        <td>
                            <div class="text-gray-light">INVOICE TO:</div>
                            <h3 style="margin:0">
                                {{ $mdata->name ? $mdata->name : $mdata->bnname }}
                            </h3>
                            <div>
                                {{ $mdata->user ? $mdata->user->phone : '' }}
                            </div>

                        </td>
                        <td style="text-align: right;">
                            <h3>INVOICE {{ 'WR-' . $mdata->id }}</h3>
                            <div class="date">Date of Invoice: {{ date('d/m/Y', strtotime($mdata->created_at)) }}
                            </div>

                        </td>
                    </tr>
                </table>
                <table style="width:100%;margin:auto;" class="bable2">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">DESCRIPTION</th>
                            <th class="text-right">PRICE</th>
                            <th class="text-right">DC PRICE</th>

                            <th class="text-right">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>



                        <tr>
                            <td class="no">1</td>
                            <td class="text-left">
                                Certificate of Citizenship
                            </td>
                            <td class="text-right">
                                {{ isset($tp_info['rate']) ? $tp_info['rate'] : null }}
                            </td>
                            <td class="text-right">
                                {{ isset($tp_info['dc_rate']) ? $tp_info['dc_rate'] : null }}
                            </td>
                            <td class="text-right">
                                {{ isset($tp_info['total']) ? $tp_info['total'] : null }}
                            </td>

                        </tr>




                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right"><b>GRAND TOTAL</b></td>
                            <td class="text-right"><b> {{ isset($tp_info['total']) ? $tp_info['total'] : null }}</b>
                            </td>
                        </tr>

                    </tfoot>
                </table>

                <br><br>
                <table style="width: 100%;  border: 0px solid #000;">
                    <tr>
                        <td>
                            <div><b>Payment Information:</b></div>
                            {{-- @include('account::widget.payment-info', ['payment' => $mdata->payment_info]) --}}
                            <div class="paymentinfo">
                                @if ($mdata->payment_info)
                                    @php
                                        $tp_info = json_decode($mdata->payment_info, true);
                                    @endphp
                                    <small>
                                        @if (isset($tp_info['payment_method']))
                                            <p> <b title="মেথড">মেথডঃ </b>{{ e2b($tp_info['payment_method']) }}</p>
                                        @endif

                                        @if (isset($tp_info['total']))
                                            <p><b title="টাকার পরিমান  ">টাকার পরিমান #
                                                </b>{{ e2b($tp_info['total']) }} টাকা</p>
                                        @endif

                                        @if (isset($tp_info['payorder']))
                                            <p> <b title="ব্যাঙ্ক ড্রাফট নং">ব্যাঙ্ক ড্রাফট নং #
                                                </b>{{ $tp_info['payorder'] }}</p>
                                        @endif
                                        @if (isset($tp_info['bank']))
                                            <p> <b title="ব্যাঙ্ক">ব্যাঙ্কঃ </b>{{ e2b($tp_info['bank']) }} </p>
                                        @endif
                                        @if (isset($tp_info['branch']))
                                            <p> <b title="ব্রাঞ্চ">ব্রাঞ্চঃ </b>{{ e2b($tp_info['branch']) }} </p>
                                        @endif
                                        @if (isset($tp_info['number']))
                                            <p>
                                                <b title="ইজারা মোবাইল">লেনদেনের মোবাইল নম্বরঃ
                                                </b>{{ e2b($tp_info['number']) }}
                                            </p>
                                        @endif
                                        @if (isset($tp_info['tid']))
                                            <p> <b title="ট্যাক্স আইডি ">ট্রানঃ আইডিঃ </b>{{ e2b($tp_info['tid']) }}
                                            </p>
                                        @endif
                                        @if (isset($tp_info['date']))
                                            <p><b title="তারিখ">তারিখঃ
                                                </b>{{ e2b(date('d-F-Y', strtotime($tp_info['date']))) }} </p>
                                        @endif
                                    </small>
                                @endif
                            </div>
                        </td>
                        <td>
                            {{-- @if ($mdata->status == 'Approved')
                        <img src="{{ asset('public/img/paid.png') }}" style="width: 100px;">
                    @else
                        <img src="{{ asset('public/img/pending.png') }}" style="width: 100px;">
                    @endif --}}
                        </td>


                    </tr>


                </table>
            </div>
        </htmlpageheader>
        {{-- {{dd('asd')}} --}}
        {{-- <htmlpageheader name="page-header">
            <div class="container">

                <table style="width: 100%;  border: 0px solid #000;">
                    <tr>
                        <td style="text-align: center; width:20%;">
                            <img src="{{ $settings->com_logourl }}" alt="" width="80" height="80">
                        </td>
                        <td
                            style="width:60%;padding-left:30px; font-size: 25px; color:#000; text-align: center; font-weight: bold">
                            <div style="display: block">


                                <h2 style="font-size: 30px; ">
                                    {{ $title[0] }}

                                </h2>
                                @if (isset($title[1]))
                                    <h3 style="font-size: 20px; margin-top: 0;">{{ $title[1] }}</h3>
                                @endif

                                <p style="font-size: 5px"> &nbsp;</p>
                                <p
                                    style="background: #0b3e6f; color: #fff;border-radius:30px; border: 5px solid #0b3e6f; margin-top: 50px; font-size: 18px">
                                    {{ $pagetaitle }}

                                </p>
                                <p style="font-size: 5px"> &nbsp;</p>

                            </div>
                        </td>
                        <td style="text-align: center; width:20%;">

                        </td>
                    </tr>
                </table>


            </div>
        </htmlpageheader> --}}
        {{-- <htmlpagefooter name="page-footer">

            <table style="width:100%;margin:auto;">
                <tr>

                    <td style="padding: 10px; text-align: left; font-size:17px;">

                    </td>
                    <td style="padding: 10px; text-align: right; font-size: 17px;">
                        @php
                            $footer = ' পেইজ নং - {PAGENO}';
                        @endphp
                        <span style="color: #000; font-size: 12px">{{ e_to_b($footer) }}</span>
                    </td>

                </tr>
                <tr style="background:#ADD3CA">

                    <td style="padding: 10px; text-align: left; font-size:17px;">
                        ফ্রীলান্সার আইটি কর্তৃক সর্বসত্ত্ব সংরক্ষিত ।
                    </td>
                    <td style="padding: 10px; text-align: right; font-size: 17px;">
                        ডিজিটাল বাংলাদেশ বিনির্মাণে আমরা অঙ্গীকারব্ধ ।
                    </td>

                </tr>


            </table>

        </htmlpagefooter> --}}

        {{-- <div style="width: 90%; margin:auto">



            <table style="width: 100%;  border: 0px solid #000;">
                <tr>
                    <td>
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h3 style="margin:0">
                            {{ $mdata->name ? $mdata->name : $mdata->bnname }}
                        </h3>
                        <div>
                           {{ ($mdata->user )? $mdata->user->phone: ''}}
                        </div>

                    </td>
                    <td style="text-align: right;">
                        <h3>INVOICE {{ 'WR-' . $mdata->id }}</h3>
                        <div class="date">Date of Invoice: {{ date('d/m/Y', strtotime($mdata->created_at)) }}</div>

                    </td>
                </tr>
            </table>
            <br>

            <table style="width:100%;margin:auto;" class="bable2">

                <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-left">DESCRIPTION</th>
                        <th class="text-right">PRICE</th>
                        <th class="text-right">DC PRICE</th>

                        <th class="text-right">TOTAL</th>
                    </tr>
                </thead>
                <tbody>



                    <tr>
                        <td class="no">1</td>
                        <td class="text-left">
                            Certificate of Citizenship
                        </td>
                        <td class="text-right">
                            {{ isset($tp_info['rate']) ? $tp_info['rate'] : null }}
                        </td>
                        <td class="text-right">
                            {{ isset($tp_info['dc_rate']) ? $tp_info['dc_rate'] : null }}
                        </td>
                        <td class="text-right">
                            {{ isset($tp_info['total']) ? $tp_info['total'] : null }}
                        </td>

                    </tr>




                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right"><b>GRAND TOTAL</b></td>
                        <td class="text-right"><b> {{ isset($tp_info['total']) ? $tp_info['total'] : null }}</b>
                        </td>
                    </tr>

                </tfoot>
            </table>

            <br><br>
            <table style="width: 100%;  border: 0px solid #000;">
                <tr>
                    <td>
                        <div><b>Payment Information:</b></div>
                        @include('account::widget.payment-info', ['payment' => $mdata->payment_info])

                    </td>
                    <td>
                        @if ($mdata->status == 'Approved')
                            <img src="{{ asset('public/img/paid.png') }}" style="width: 100px;">
                        @else
                            <img src="{{ asset('public/img/pending.png') }}" style="width: 100px;">
                        @endif
                    </td>


                </tr>


            </table>
        </div> --}}
    @endif
</body>

</html>
