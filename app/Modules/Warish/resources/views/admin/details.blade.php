@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'ওয়ারিশ' }}
@endsection

@push('styles')
    <link href="{{ asset('/') }}assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet" type="text/css" />
@endpush

@php
    $tp_info = json_decode($mdata->payment_info, true);
@endphp

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <div class="d-flex">

                        </div>
                    </div>
                    <h4 class="page-title">ওয়ারিশ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                {{-- Asset Details --}}
                                @if ($mdata)
                                    <a class="btn {{ btnStatus($mdata->status) }}" href="javascript:void(0)">
                                        {{ $mdata->status }}
                                    </a>
                                @endif
                            </div>
                            <div class="col-md-6 text-end">

                                <div class="btn-group" role="group" aria-label="...">

                                    <button type="button" data-id="{{ $mdata->id }}" class="btn btn-info"
                                        id="change-status-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa fa-pencil" aria-hidden="true"></i> Change status
                                    </button>
                                    <a href="{{ route('warish.pdf.application', $mdata->id) }}" class="btn btn-danger"
                                        target="_blank">
                                        <i class="fa fa-print" aria-hidden="true"></i> আবেদনপত্র</a>
                                        @if($mdata->status == 'Approved')
                                        <a href="{{ route('warish.pdf.certificate_2', $mdata->id) }}" class="btn btn-info"
                                            target="_blank">
                                            <i class="fa fa-print" aria-hidden="true"></i> ওয়ারিশ সনদ</a>


                                        @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">

                            <tbody>
                                <tr>
                                    <th colspan="4">পরিচয়</th>
                                </tr>
                                <tr>
                                    <td>পিতার নামঃ</td>
                                    <td>{{ isset($fdata->father) ? $fdata->father : null }}</td>
                                    <td>মাতার নামঃ</td>
                                    <td>{{ isset($fdata->mother) ? $fdata->mother : null }}</td>
                                </tr>
                                <tr>
                                    <td>গ্রামঃ</td>
                                    <td>{{ isset($fdata->moholla->bn_name) ? $fdata->moholla->bn_name : $fdata->moholla->name }}
                                    </td>
                                    <td> ডাকঘরঃ</td>
                                    <td>{{ isset($fdata->postOffice->bn_name) ? $fdata->postOffice->bn_name : $fdata->postOffice->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>ওয়ার্ড নং </td>
                                    <td>{{ isset($fdata->ward->bn_name) ? $fdata->ward->bn_name : $fdata->ward->name }}</td>
                                    <td> উপজেলাঃ</td>
                                    <td>{{ isset($fdata->upazila->bn_name) ? $fdata->upazila->bn_name : $fdata->upazila->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>জেলাঃ</td>
                                    <td>{{ isset($fdata->district->bn_name) ? $fdata->district->bn_name : $fdata->district->name }}
                                    </td>
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
                                    <th scope="col">জন্মদিন </th>
                                    <th scope="col">জাতীয় পরিচয়পত্র</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fdata->details as $key => $odata)
                                    <tr>
                                        <td scope="row">{{ $key + 1 }}</td>
                                        <td>
                                            {{ $odata['name'] }}


                                        </td>
                                        <td>


                                            {{ lv_warishtype()[$odata['relation']] }}

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
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
            <div class="col-md-6">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title box-success" style="display: block;">


                            <div class="btn-group" role="group" aria-label="...">

                                @if($mdata)
                                {{-- <a href="{{route('warish.pdf.application', $mdata->id)}}" target="_blank" class="btn btn-info">
                                    <i class="fa fa-print" aria-hidden="true"></i> আবেদনপত্র
                                </a> --}}
                                <a href="{{route('warish.pdf.payment', $mdata->id)}}" target="_blank" class="btn btn-danger">
                                    <i class="fa fa-print" aria-hidden="true"></i> পেমেন্ট রশিদ
                                </a>
                                @endif
                                {{-- @if($mdata->status == 'Approved')

                                <a href="{{route('warish.pdf.certificate', $mdata->id)}}" target="_blank"
                                    class="btn btn-success">
                                    <i class="fa fa-print" aria-hidden="true"></i> ওয়ারিশ সনদ
                                </a>

                                @endif --}}
                            </div>
                        </h3>
                    </div>
                    <div class="box-body jumbotron" style="background:#fff">


                        <div class="container" style="min-width: 500px">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-gray-light">INVOICE TO:</div>
                                    <h2 style="margin:0">
                                        {{ ($mdata->user->name)? $mdata->user->name: $mdata->user->bnname}}
                                    </h2>
                                    <div>

                                        {{ ($mdata->user )? $mdata->user->phone: ''}}
                                    </div>

                                </div>
                                <div class="col-md-6 text-right">
                                    <h2>INVOICE {{'LM-W-'.$mdata->id}}</h2>
                                    <div class="date">Date of Invoice: {{date('d/m/Y',strtotime($mdata->created_at))}}</div>

                                </div>
                            </div>

                            <table class="table table-striped" style="width:100%">
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
                                            Certificate of Inheritance
                                        </td>
                                        <td class="text-right">
                                            {{ isset($tp_info['rate'])?$tp_info['rate']:null }}
                                        </td>
                                        <td class="text-right">
                                            {{ isset($tp_info['dc_rate'])? $tp_info['dc_rate']:null }}
                                        </td>
                                        <td class="text-right">
                                            {{ isset($tp_info['total'])?$tp_info['total']:null }}
                                        </td>

                                    </tr>




                                </tbody>
                                <tfoot>
                                    <tr>

                                        <td colspan="4" class="text-right"><b>GRAND TOTAL</b></td>
                                        <td class="text-right"><b> {{ isset($tp_info['total'])?$tp_info['total']:null }}</b>
                                        </td>
                                    </tr>

                                </tfoot>
                            </table>

                            <br>
                            <br>
                            <br>
                            <br>


                            <div class="row">
                                <div class="col-md-6">
                                    <div><b>Payment Information:</b></div>
                                    <div class="notice">
                                        @if($mdata->payment_info)

                                        <small>
                                            @if(isset($tp_info['payment_method']))
                                            <b title="মেথড">মেথডঃ </b>{{ e_to_b($tp_info['payment_method'])}} </br>
                                            @endif

                                            @if(isset($tp_info['total']))
                                            <b title="টাকার পরিমান  ">টাকার পরিমান # </b>{{ e_to_b($tp_info['total'])}}
                                            টাকা</br>
                                            @endif

                                            @if(isset($tp_info['payorder']))
                                            <b title="ব্যাঙ্ক ড্রাফট নং">ব্যাঙ্ক ড্রাফট নং # </b>{{ $tp_info['payorder']}} </br>
                                            @endif
                                            @if(isset($tp_info['bank']))
                                            <b title="ব্যাঙ্ক">ব্যাঙ্কঃ </b>{{ e_to_b($tp_info['bank'])}} </br>
                                            @endif
                                            @if(isset($tp_info['branch']))
                                            <b title="ব্রাঞ্চ">ব্রাঞ্চঃ </b>{{ e_to_b($tp_info['branch'])}} </br>
                                            @endif
                                            @if(isset($tp_info['number']))
                                            <b title="ইজারা মোবাইল">মোবাইলঃ </b>{{ e_to_b($tp_info['number'])}} </br>
                                            @endif
                                            @if(isset($tp_info['tid']))
                                            <b title="ট্যাক্স আইডি ">ট্যাক্স আইডিঃ </b>{{ $tp_info['tid']}}</br>
                                            @endif
                                            @if(isset($tp_info['date']))
                                            <b title="তারিখ">তারিখঃ </b>{{ e_to_b(date('d-F-Y', strtotime($tp_info['date'])))}}
                                            </br>
                                            @endif
                                        </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @if($mdata->status == 'Approved')
                                    <img src="{{ asset('img/paid.png') }}" style="width: 100px;">
                                    @else
                                    <img src="{{ asset('img/pending.png') }}" style="width: 100px;">
                                    @endif
                                </div>


                            </div>


                        </div>


                    </div>
                </div>

            </div>
        </div>
        <!-- end row -->
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="modal-id" id="modal-id">
                    <label for="modal-status">Select Status</label>
                    <select name="modal-status" class="form-control" id="modal-status">
                        <option value="">Select One</option>
                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Modification">Modification</option>
                        <option value="Canceled">Canceled</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="modal-update" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#change-status-btn').click(function() {
                var id = $(this).attr('data-id');
                $('#modal-id').val(id)
            })

            $('#modal-update').click(function() {
                var modal_id = $('#modal-id').val()
                var modal_status = $('#modal-status').val()

                if (modal_id == null || modal_id == '') {
                    alert('Please reload the page.')
                }
                if (modal_status == null || modal_status == '') {
                    alert('Please select the status.')
                }

                $.ajax({
                    url: "{{ route('admin.warish.change-status') }}",
                    type: 'GET',
                    data: {
                        id: modal_id,
                        status: modal_status
                    },
                    success: function(response) {
                        if (response.status) {
                            location.reload()
                        } else {
                            alert(response.message)
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

            })


        })
    </script>
@endpush
