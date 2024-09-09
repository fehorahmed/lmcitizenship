<!DOCTYPE html>
<html>

<head>
    @php
        // $settings = \App\Setting::first();
        $tp_info = json_decode($citizen->payment_info, true);
        $pagetaitle = 'নাগরিকত্ব সনদ এর আবেদন পত্র ';
    @endphp
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ $pagetaitle }} </title>
    {{-- <link rel="stylesheet" href="{{ asset('css/pdf.css') }}"> --}}
    <style type="text/css">


        body {
            font-family: 'nikosh';
            font-size: 17px;
        }

        @page {
            header: page-header;
            footer: page-footer;
            margin-top: 100px;

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

            display: block
        }
    </style>
</head>

<body>

    <?php
    //  dd(storage_path('fonts'));
    $title = explode(',', $settings->name ?? 'ffsd');
    ?>

    @if (Route::has('login'))
        <div style="background-color: #ADD3CA; text-align:center; margin-bottom:10px;">
            <h2>{{ $title[0] }}</h2>
            <p>{{ $title[1] }}</p>
        </div>
        <table style="width: 100%">
            <tr>
                <td style="width: 33.33%"></td>
                <td class="certificate-titel" style="width: 33.33%">
                    <p style="" class="">{{ $pagetaitle }}</p>
                </td>
                <td style="width: 33.33%"></td>
            </tr>
        </table>

        <table class="bable2" style="margin-top: 10px;">
            <tbody>
                <tr>
                    <td>নামঃ </td>
                    <td>{{ $citizen->name }}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>পিতার নামঃ </td>
                    <td>{{ $citizen->father }} </td>
                </tr>
                <tr>
                    <td> মাতার নামঃ </td>
                    <td>{{ $citizen->mother }} </td>
                </tr>
                <tr>
                    <td>গ্রামঃ</td>
                    <td> {{ isset($citizen->moholla->bn_name) ? $citizen->moholla->bn_name :$citizen->moholla->name }}, {{ $citizen->address }}</td>
                    <td>ডাকঘরঃ</td>
                    <td>{{ isset($citizen->postOffice->bn_name) ? $citizen->postOffice->bn_name : $citizen->postOffice->name }}</td>
                </tr>
                <tr>
                    <td> ওয়ার্ড নং </td>
                    <td>{{ isset($citizen->ward->bn_name) ? $citizen->ward->bn_name :$citizen->ward->name }}</td>
                    <td>উপজেলাঃ</td>
                    <td>{{ isset($citizen->upazila->bn_name) ? $citizen->upazila->bn_name :$citizen->upazila->name }}</td>
                </tr>
                <tr>
                    <td> জেলাঃ </td>
                    <td>{{ isset($citizen->district->bn_name) ? $citizen->district->bn_name :$citizen->district->name }}</td>
                    <td>মোবাইলঃ</td>
                    <td>{{ $citizen->user->phone }}</td>
                </tr>
                <tr>
                    <td> জন্ম নিবন্ধন নং </td>
                    <td>{{ $citizen->bc_no }}</td>
                    <td>জাতীয় পরিচয় পত্র নং</td>
                    <td>{{ $citizen->nid }}</td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        {{-- <table style="width: 100%;  border: 0px solid #000;">
            <tr>
                <td style="width: 30%; text-align: center">
                    <p>
                        @if (isset($rules->singtur_one_img))
                        <img src="{{ $rules->singtur_one_img }}" alt="" width="80">
                        @endif
                    </p>
                    <p style="text-align: center">
                        {!! $rules->singtur_one_text??'' !!}
                    </p>


                </td>
                <td style="width: 40%; text-align: center">

                </td>
                <td style="width: 30%;text-align: center">
                    <p>
                        @if (isset($rules->singtur_two_img))
                        <img src="{{ $rules->singtur_two_img }}" alt="" width="80">
                        @endif
                    </p>
                    <p style="text-align: center">
                        {!! $rules->singtur_two_text??'' !!}
                    </p>

                </td>


            </tr>


        </table> --}}

        {{-- <htmlpagefooter name="page-footer">

        <table border="0" style="width:100%;margin:auto;">
            <tr>

                <td colspan="2" style="padding: 10px; text-align: left; font-size:17px;">

                </td>
                <td colspan="2" style="padding: 10px; text-align: right; font-size: 17px;">
                    @php
                    $footer = ' পেইজ নং - {PAGENO}'
                    @endphp
                    <span style="color: #000; font-size: 12px">{{ ($footer) }}</span>
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


        {{-- <div style="width: 90%; margin:auto">

        <table style="width: 100%">
            <tr>
                <td style="width: 33.33%"></td>
                <td style="width: 33.33%" class="certificate-titel">
                    <p class="certificate-titel">{{ $pagetaitle }}</p>
                </td>
                <td style="width: 33.33%"></td>
            </tr>
        </table>
        <br>
        <br>




        <table style="width:100%;margin:auto;" class="bable2">

            <tbody>
                <tr>
                    <td>নামঃ</td>
                    <td colspan="3">{{ $citizen->name }}</td>

                </tr>
                <tr>
                    <td> {{ ($citizen->father)? 'পিতার' : 'স্বামীর' }} নামঃ</td>
                    <td>{{ ($citizen->father)?$citizen->father : $citizen->husband }}</td>
                    <td> মাতার নামঃ </td>
                    <td>{{ $citizen->mother }}</td>
                </tr>
                <tr>
                    <td>গ্রামঃ</td>
                    <td>{{ $citizen->village }}</td>
                    <td>ডাকঘরঃ</td>
                    <td>{{ $citizen->postoffice }}</td>
                </tr>
                <tr>
                    <td> ওয়ার্ড নং </td>
                    <td>{{ ($citizen->ward_no )}}</td>
                    <td>উপজেলাঃ</td>
                    <td></td>
                </tr>
                <tr>
                    <td> জেলাঃ </td>
                    <td></td>
                    <td>মোবাইলঃ</td>
                    <td>{{ $citizen->user->phone }}</td>
                </tr>
                <tr>
                    <td> জন্ম নিবন্ধন নং </td>
                    <td>{{ $citizen->bc_no }}</td>
                    <td>জাতীয় পরিচয় পত্র নং</td>
                    <td>{{ $citizen->nid }}</td>
                </tr>

            </tbody>
        </table>


        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <table style="width: 100%;  border: 0px solid #000;">
            <tr>
                <td style="width: 30%; text-align: center">
                    <p>
                        @if (isset($rules->singtur_one_img))
                        <img src="{{ $rules->singtur_one_img }}" alt="" width="80">
                        @endif
                    </p>
                    <p style="text-align: center">
                        {!! $rules->singtur_one_text !!}
                    </p>


                </td>
                <td style="width: 40%; text-align: center">

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




    </div> --}}
    @endif

</body>

</html>
