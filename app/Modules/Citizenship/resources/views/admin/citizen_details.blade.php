@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'নাগরিকত্ব সনদ আবেদন' }}
@endsection

@push('styles')
    <link href="{{ asset('/') }}assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet" type="text/css" />
@endpush

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
                    <h4 class="page-title">নাগরিকত্ব সনদ আবেদন</h4>
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
                                <button type="button" class="btn btn-info">
                                    {{ $fdata->status }}
                                </button>
                            </div>
                            <div class="col-md-6 text-end">

                                <div class="btn-group" role="group" aria-label="...">

                                    <button type="button" data-id="{{ $fdata->id }}" class="btn btn-info"
                                        id="change-status-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa fa-pencil" aria-hidden="true"></i> Change status
                                    </button>
                                    <a href="{{ route('citizenship.pdf.aplication', $fdata->id) }}" class="btn btn-danger"
                                        target="_blank">
                                        <i class="fa fa-print" aria-hidden="true"></i> Application</a>
                                    <a href="{{ route('citizenship.pdf.certificate_2', $fdata->id) }}" class="btn btn-info"
                                        target="_blank">
                                        <i class="fa fa-print" aria-hidden="true"></i> Certificate 2</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">

                            <tbody>
                                <tr>
                                    <td>নামঃ</td>
                                    <td>{{ $fdata->name }}</td>
                                    <td>মোবাইলঃ</td>
                                    <td>{{ $fdata->user ? $fdata->user->phone : null }}</td>
                                </tr>
                                <tr>
                                    <td>পিতার নামঃ</td>
                                    <td>{{ $fdata->father }}</td>
                                    <td> মাতার নামঃ </td>
                                    <td>{{ $fdata->mother }}</td>
                                </tr>
                                <tr>
                                    <td>গ্রামঃ</td>
                                    <td>{{ $fdata->moholla->name ?? '' }},{{ $fdata->address ?? '' }} </td>
                                    <td>ডাকঘরঃ</td>
                                    <td>{{ $fdata->postOffice->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td> ওয়ার্ড নং </td>
                                    <td>{{ $fdata->ward->name }}</td>
                                    <td>উপজেলাঃ</td>
                                    <td>{{ $fdata->upazila->bn_name }}</td>
                                </tr>
                                <tr>
                                    <td> জেলাঃ </td>
                                    <td>{{ $fdata->district->bn_name }}</td>
                                    <td>বিভাগঃ</td>
                                    <td>{{ $fdata->division->bn_name }}</td>
                                </tr>
                                <tr>
                                    <td>জন্ম নিবন্ধন নং </td>
                                    <td>{{ $fdata->bc_no }}</td>
                                    <td>জাতীয় পরিচয় পত্র নং</td>
                                    <td>{{ $fdata->nid }}</td>
                                </tr>

                                @if ($fdata->user->nid_file || $fdata->user->birth_certificate_file)
                                    <tr>
                                        <td colspan="2">
                                            <p>NID Document</p>
                                            <a href="{{ asset($fdata->user->nid_file) }}" target="_blank"> <img
                                                    src="{{ asset($fdata->user->nid_file) }}" alt="" width="150"
                                                    height="80"> </a>
                                        </td>
                                        <td colspan="2">
                                            <p>Birth Certificate Document</p>
                                            <a href="{{ asset($fdata->user->birth_certificate_file) }}" target="_blank"> <img
                                                    src="{{ asset($fdata->user->birth_certificate_file) }}" alt="" width="150"
                                                    height="80"> </a>
                                        </td>
                                    </tr>
                                @endif


                            </tbody>
                        </table>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
            <div class="col-md-6">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title box-success" style="display: block;">


                            {{-- <a href="{{ route('admin.citizenship.index') }}" class="btn btn-danger">
                                back
                            </a> --}}
                            <a href="{{ route('citizenship.pdf.payment', $fdata->id) }}" target="_blank"
                                class="btn btn-danger pull-right">
                                <i class="fa fa-print" aria-hidden="true"></i> Print
                            </a>
                        </h3>
                    </div>
                    <div class="box-body jumbotron" style="background:#fff">


                        <div class="container" style="min-width: 500px">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-gray-light">INVOICE TO:</div>
                                    <h2 style="margin:0">
                                        {{ $fdata->name ? $fdata->name : $fdata->user->bnname }}
                                    </h2>
                                    <div>


                                    </div>

                                </div>
                                <div class="col-md-6 text-right">
                                    <h2>INVOICE {{ 'LM-' . $fdata->id }}</h2>
                                    <div class="date">Date of Invoice: {{ date('d/m/Y', strtotime($fdata->created_at)) }}
                                    </div>

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
                                            {{ $fdata->rate }}
                                        </td>
                                        <td class="text-right">
                                            {{ $fdata->dc_rate }}

                                        </td>
                                        <td class="text-right">

                                            {{ $fdata->rate + $fdata->dc_rate }}
                                        </td>

                                    </tr>




                                </tbody>
                                <tfoot>
                                    <tr>

                                        <td colspan="4" class="text-right"><b>GRAND TOTAL</b></td>
                                        <td class="text-right"><b> {{ $fdata->amount }} </b>
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

                                    @if ($fdata->payment_info)
                                        {{-- @include('account::widget.payment-info',['payment' => $fdata->payment_info,]) --}}
                                        <div class="paymentinfo">
                                            @if ($fdata->payment_info)
                                                @php
                                                    $tp_info = json_decode($fdata->payment_info, true);
                                                @endphp
                                                <small>
                                                    @if (isset($tp_info['payment_method']))
                                                        <p> <b title="মেথড">মেথডঃ
                                                            </b>{{ e2b($tp_info['payment_method']) }}</p>
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
                                                        <p> <b title="ব্যাঙ্ক">ব্যাঙ্কঃ </b>{{ e2b($tp_info['bank']) }}
                                                        </p>
                                                    @endif
                                                    @if (isset($tp_info['branch']))
                                                        <p> <b title="ব্রাঞ্চ">ব্রাঞ্চঃ </b>{{ e2b($tp_info['branch']) }}
                                                        </p>
                                                    @endif
                                                    @if (isset($tp_info['number']))
                                                        <p>
                                                            <b title="ইজারা মোবাইল">লেনদেনের মোবাইল নম্বরঃ
                                                            </b>{{ e2b($tp_info['number']) }}
                                                        </p>
                                                    @endif
                                                    @if (isset($tp_info['tid']))
                                                        <p> <b title="ট্যাক্স আইডি ">ট্রানঃ আইডিঃ
                                                            </b>{{ e2b($tp_info['tid']) }}</p>
                                                    @endif
                                                    @if (isset($tp_info['date']))
                                                        <p><b title="তারিখ">তারিখঃ
                                                            </b>{{ e2b(date('d-F-Y', strtotime($tp_info['date']))) }} </p>
                                                    @endif
                                                </small>
                                            @endif
                                        </div>
                                    @endif

                                </div>
                                <div class="col-md-6">
                                    @if ($fdata->transactionLog->is_active == 'Yes')
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
                    url: "{{ route('admin.citizenship.change-status') }}",
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
