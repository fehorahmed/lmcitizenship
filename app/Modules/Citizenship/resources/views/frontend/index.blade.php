@extends('frontend.layouts.app')
@section('content')
    <div class="container user_panel">
        @include('frontend.common.frontend_user_menu')

        <div class="panel panel-default commone-hean">

            <div class="panel-heading">
                বিস্তারিত
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>আবেদনকারী বিবরণ </th>
                            <th>পেমেন্ট বিস্তারিত</th>

                            <th colspan="2">ডাউনলোড</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fdata as $key => $item)
                            <tr>
                                <td rowspan="4">{{ $key + 1 }}</td>
                                <td rowspan="4">
                                    <small>
                                        <p> নামঃ {{ $item->name }}</p>
                                        <p> পিতার নামঃ {{ $item->father }}</p>
                                        <p> মাতার নামঃ {{ $item->mother }}</p>
                                    </small>
                                </td>
                                <td rowspan="4">


                                    {{-- @if ($item->payment_info)
                                        @include('account::widget.payment-info', [
                                            'payment' => $item->payment_info,
                                        ])
                                    @endif --}}
                                </td>
                                <td>আবেদন ফরম</td>
                                <td>
                                    <a href="{{ route('citizenship.pdf.aplication', $item->id) }}" class="btn btn-danger"
                                        target="_blank">
                                        <i class="fa fa-print" aria-hidden="true"></i> Aplication</a>

                                </td>
                            </tr>
                            <tr>
                                <td> পেমেন্ট রশিদ </td>
                                <td>
                                    <a href="{{ route('citizenship.pdf.payment', $item->id) }}" target="_blank"
                                        class="btn btn-danger">
                                        <i class="fa fa-print" aria-hidden="true"></i> Print
                                    </a>

                                </td>
                            </tr>
                            <tr>
                                <td> সনদ ডাউনলোড </td>
                                <td>
                                    @if ($item->status == 'Approved')
                                        {{-- <a href="{{ route('citizenship.pdf.certificate', $item->id) }}" class="btn btn-danger"
                                            target="_blank"> --}}
                                        <a href="{{ route('citizenship.pdf.certificate_2', $item->id) }}" class="btn btn-danger"
                                            target="_blank">
                                            <i class="fa fa-print" aria-hidden="true"></i> Certificate</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>স্ট্যাটাস </td>
                                <td>
                                    {{-- <button type="button" class="btn {{ btnStatus($item->status) }}"> --}}
                                    <button type="button" class="btn ">
                                        {{ $item->status }}
                                    </button>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('cusjs')
    <script>
        var myapp = new Vue({
            el: "#my-app",
            data: {
                isActive: true,
                payment: 'Bank draft',
                date: '',


            },
            mounted: function() {

                jQuery(function() {
                    jQuery(".date-pick").datepicker({
                        format: 'dd-mm-yyyy'
                    }).val();
                });
            },
            methods: {
                paymentMethod: function() {
                    if (this.payment == "Bank draft") {
                        this.isActive = true;
                    } else {
                        this.isActive = false;
                    }

                    jQuery(function() {
                        jQuery(".date-pick").datepicker({
                            format: 'dd-mm-yyyy'
                        }).val();
                    });

                }
            }
        });
        Vue.config.devtools = true
    </script>
@endsection
