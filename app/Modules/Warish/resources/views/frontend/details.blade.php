@extends('frontend.layouts.app')

@section('content')
<div class="container user_panel">
    @php
    $rowNumber = 1;
    @endphp

    <h2 class="text-center">ওয়ারিশ</h2>

    <?php
        if(Session::has('myexcep')){
            dump(Session::get('myexcep'));
        }

   ?>
    <div class="row up_bottom">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading nav">
                    @include('Warish::frontend.part.menu')
                </div>

                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-6 text-left">
                            @if($fdata->aplication)
                            <a class="btn {{ btnStatus($fdata->aplication->status) }}" href="javascript:void(0)">
                                {{ $fdata->aplication->status }}
                            </a>
                            @endif
                        </div>

                        <div class="col-md-6 text-right">

                            <div class="btn-group" role="group" aria-label="...">

                                @if($fdata->aplication)
                                <a href="{{route('warish.pdf.application', $fdata->aplication->id)}}" target="_blank"
                                    class="btn btn-info">
                                    <i class="fa fa-print" aria-hidden="true"></i> আবেদনপত্র
                                </a>
                                <a href="{{route('warish.pdf.payment', $fdata->aplication->id)}}" target="_blank"
                                    class="btn btn-danger">
                                    <i class="fa fa-print" aria-hidden="true"></i> পেমেন্ট রশিদ
                                </a>

                                @endif
                                @if($fdata->aplication->status == 'Approved')

                                <a href="{{route('warish.pdf.certificate', $fdata->aplication->id)}}" target="_blank"
                                    class="btn btn-success">
                                    <i class="fa fa-print" aria-hidden="true"></i> ওয়ারিশ সনদ
                                </a>

                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel-miss">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th colspan="4">পরিচয়</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>নামঃ</td>
                                    <td>{{ isset($fdata->name)? $fdata->name:null }}</td>
                                    <td>পিতার নামঃ</td>
                                    <td>{{ isset($fdata->father)? $fdata->father:null }}</td>
                                </tr>
                                <tr>
                                    <td>গ্রামঃ</td>
                                    <td>{{ isset($fdata->moholla->bn_name)? $fdata->moholla->bn_name:$fdata->moholla->name }}</td>
                                    <td> ডাকঘরঃ</td>
                                    <td>{{ isset($fdata->postOffice->bn_name)? $fdata->postOffice->bn_name:$fdata->postOffice->name }}</td>
                                </tr>
                                <tr>
                                    <td>ওয়ার্ড নং </td>
                                    <td>{{ isset($fdata->ward->bn_name)? $fdata->ward->bn_name:$fdata->ward->name }}</td>
                                    <td> উপজেলাঃ</td>
                                    <td>{{ isset($fdata->upazila->bn_name)? $fdata->upazila->bn_name:null }}</td>
                                </tr>
                                <tr>
                                    <td>জেলাঃ</td>
                                    <td>{{ isset($fdata->district->bn_name)? $fdata->district->bn_name:null }}</td>
                                    <td> </td>
                                    <td></td>
                                </tr>


                            </tbody>
                        </table>



                        <br>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">নাম</th>
                                    <th scope="col">সম্পর্ক</th>
                                    <th scope="col">জন্ম তারিখ </th>
                                    <th scope="col">জাতীয় পরিচয়পত্র</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fdata->details as $key => $odata)


                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>
                                        {{ $odata['name'] }}


                                    </td>
                                    <td>


                                        {{  lv_warishtype()[$odata['relation']]  }}

                                    </td>
                                    <td>
                                        {{ date('d-m-Y', strtotime($odata['birthday'])) }}

                                    </td>

                                    <td>
                                        {{ $odata['nid'] }}

                                    </td>

                                </tr>

                                @endforeach


                            </tbody>


                        </table>


                    </div>




                </div>
            </div>
        </div>

    </div>

    @endsection

    @section('cusjs')

    @endsection
