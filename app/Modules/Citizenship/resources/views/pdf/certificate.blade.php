<!DOCTYPE html>
<html>

<head>
    @php

    $tp_info = json_decode($fdata->payment_info, true);
    $pagetaitle = ' নাগরিকত্ব সনদ';
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
            margin-top: 220px;
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

        </div>
    </htmlpageheader>
    <htmlpagefooter name="page-footer">
    </htmlpagefooter>



    <div style="width: 70%; margin:auto;  line-height:45px">
        <table style="width: 100%">
            <tr>
                <td style="font-size: 16px;">
                    সিরিয়াল নং :
                    {{-- {{ e2b($fdata->id) }} --}}
                </td>
                <td style="text-align: right;font-size: 16px;">
                    তারিখঃ {{ e2b(date('d-m-y', strtotime($fdata->created_at))) }} খ্রি.
                </td>
            </tr>
        </table>
        <br>

        <p style="font-size: 16px; line-height:26px;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    এই মর্মে প্রত্যয়ন করা যাইতেছে যে <span style="text-decoration: underline;">{{$fdata->name }}</span>,
       পিতা/স্বামীঃ <span style="text-decoration: underline;">{{ isset($fdata->father)? $fdata->father:null }}</span>,
            মাতাঃ <span style="text-decoration: underline;">{{ isset($fdata->mother)? $fdata->mother:null }}</span>,


           <?php if($fdata->bc_no !="" && $fdata->nid_no !=""){ ?>,

               জন্ম নিবন্ধন নং {{ $fdata->bc_no}},

              জাতীয় পরিচয়পত্র নং {{ $fdata->nid }},

            <?php } else if(!empty($fdata->bc_no)) { ?>

                 জন্ম নিবন্ধন নং {{ $fdata->bc_no}},

            <?php } else if(!empty($fdata->nid)) { ?>

                জাতীয় পরিচয়পত্র নং {{ $fdata->nid}},

          <?php } ?>

             গ্রাম/মহল্লাঃ <span style="text-decoration: underline;">{{ isset($fdata->moholla->bn_name)? $fdata->moholla->bn_name :$fdata->moholla->name }} </span>,
             ডাকঘরঃ {{ isset($fdata->postOffice->bn_name)?$fdata->postOffice->bn_name:$fdata->postOffice->name }}, উপজেলাঃ
            {{ isset($fdata->upazila->bn_name)? $fdata->upazila->bn_name:$fdata->upazila->name }},
            জেলাঃ {{ isset($fdata->district->bn_name)? $fdata->district->bn_name:$fdata->district->name }}।

            তিনি {{ isset($fdata->postOffice->bn_name)? $fdata->postOffice->bn_name:$fdata->postOffice->name }} পৌরসভার
            <span style="text-decoration: underline;"> {{ isset($fdata->ward->bn_name)? $fdata->ward->bn_name:$fdata->ward->name }} নং</span>,
                ওয়ার্ডের স্থায়ী
            বাসিন্দা এবং বাংলাদেশের প্রকৃত নাগরিক। <br> <br>

            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            আমি তাহার উজ্জ্বল ভবিষ্যৎ কামনা করি।
        </p>
        <br>




        <table style="width: 100%">
            <tr>

               <td style="text-align: center;font-size: 16px; width:33.33%;">
                    প্রস্তুতকারীর স্বাক্ষর ও সীল
                </td>
                <td style="text-align: center;font-size: 16px; width:33.33%;">
                    {!! $rules->singtur_one_text !!}
                </td>
                <td style="text-align: center;font-size: 16px; width:33.33%;">
                    {!! $rules->singtur_two_text !!}

                </td>
            </tr>
        </table>


    </div>


    @endif
</body>

</html>
