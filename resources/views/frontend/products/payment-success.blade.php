@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="breadcrumb-warp section-margin-two">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <?php
                        $breadcrumbs = new Creitive\Breadcrumbs\Breadcrumbs;

                        $breadcrumbs->setDivider(' » &nbsp;');
                        $breadcrumbs->addCrumb('Home', url('/'))
                            ->addCrumb('Payment Method', 'product');
                        echo $breadcrumbs->render();
                        ?>
                    </div>
                    <!-- breadcrumb  end-->
                </div>
            </div>
        </div>
    </div>
    <?php $tksign = '&#2547; '; ?>
    <!--breadcrumb-area end  -->
    <section class="prosuct-view-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4" style="text-align: center;">

                    {{ Form::open(array('url' => '/pdf/invoice', 'method' => 'post', 'value' => 'PATCH', 'id' => 'pdf_invoice')) }}
                    {{ Form::hidden('order_id', $orders_master->id, ['class' => 'btn btn-success']) }}
                    {{ Form::hidden('random_code', $orders_master->order_random, ['class' => 'btn btn-success']) }}
                    {{ Form::hidden('secret_key', $orders_master->secret_key, ['class' => 'btn btn-success']) }}
                    {{ Form::submit('Download Invoice PDF', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                    <br/><br/>

                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </section>
    <section class="prosuct-view-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    @include('frontend.common.message_handler')

                    <div class="pdf">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="invoice-title">
                                    <h3>Invoice</h3>
                                    <h3 class="pull-right">
                                        Order # {{ $orders_master->id }}
                                    </h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <address>
                                            <strong>Delivery Address</strong><br>
                                            {!! nl2br($orders_master->address) !!}
                                        </address>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <address>
                                            <strong>Payment Method</strong>
                                            <br>
                                            @if($orders_master->payment_method == 'cash_on_delivery')
                                                Cash On Delivery
                                            @else
                                                {{ $orders_master->payment_method }}
                                            @endif
                                        </address>
                                        <address>
                                            <strong>Order Date</strong>
                                            <br>
                                            {{ $orders_master->order_date }}<br><br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Order summary</strong></h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                        <tr>
                                            <td><strong>Image</strong></td>
                                            <td><strong>Product Name</strong></td>
                                            <td><strong>Unit</strong></td>
                                            <td class="text-center"><strong>Price</strong></td>
                                            <td class="text-center"><strong>Qty</strong></td>
                                            <td class="text-right"><strong>Totals</strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @if(!empty($orders_detail))
                                            @foreach($orders_detail as $line)
                                                <?php
                                                $item = App\Product::find($line->product_id);
                                                $totalqty[] = $line->qty;
                                                $totalprice[] = $line->local_purchase_price * $line->qty;
                                                ?>

                                                <tr>
                                                    <td>
                                                        {{ $line->img }}
                                                        <img src="{{ get_first_product_image($line->product_id, $item) }}"
                                                             style="height: 70px; width: 70px;"/>
                                                    </td>
                                                    <td>
                                                        {{ $line->product_name }}
                                                    </td>
                                                    <td>
                                                        <span>
                                                            @if($item->unit == env('SFT'))
                                                                <span class="unit_p">SFT</span>
                                                            @elseif($item->unit == env('CFT'))
                                                                <span class="unit_p">CFT</span>
                                                            @elseif($item->unit == env('PIECE'))
                                                                <span class="unit_p">PCS</span>
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $tksign }}{{ number_format($item->local_selling_price) }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $line->qty }}
                                                    </td>
                                                    <td class="text-right">
                                                        {{ $tksign }}{{ number_format($line->local_purchase_price * $line->qty) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        <tr class="CartProductWhite"
                                            style="">
                                            <td colspan="5">
                                                Total Products
                                            </td>
                                            <td class="text-right">
                                                @if(!empty($totalqty))
                                                    {{ array_sum($totalqty) }}
                                                @endif
                                            </td>
                                        </tr>

                                        @php
                                            $total_price = array_sum($totalprice);
                                            $deliverycharge = $data['user_details']['deliveryfee'];
                                            $grand_total = $total_price + $deliverycharge;
                                        @endphp

                                        <tr class="CartProductWhite"
                                            style="">
                                            <td colspan="5">
                                                Delivery Charge
                                                @if($grand_total <= $paymentsetting->decidable_amount)
                                                    @if(!empty($data['user_details']) && ($data['user_details']['district'] == 'Dhaka'))
                                                        (Inside Dhaka)
                                                    @else
                                                        (Outside Dhaka)
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <span style="color: #000000;">

                                                    {{ $tksign }} {{ $orders_master->delivery_fee }}

                                                </span>
                                            </td>
                                        </tr>

                                        <tr class="CartProductWhite"
                                            style="color: #000000;">
                                            <td colspan="5">
                                                Total Price
                                            </td>
                                            <td class="text-right">
                                                @if(!empty($orders_master->total_amount))
                                                    {{ $tksign }} {{ number_format($orders_master->total_amount) }}
                                                @endif
                                            </td>
                                        </tr>

                                        <tr class="CartProductBlue"
                                            style="background: #0a70b9 none repeat scroll 0 0; color: #FFFFFF;">
                                            <td colspan="5">
                                                Grand Total
                                            </td>
                                            <td class="text-right">
                                                @if(!empty($orders_master->grand_total))
                                                    {{ $tksign }} {{ number_format($orders_master->grand_total) }}
                                                @endif
                                            </td>
                                        </tr>
                                        <?php
                                        //dd($orders_master);
                                        ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    //dump($orders_master);
                    //dump($orders_master);
                    //Session::flush();

                    Session::forget('cart');
                    Session::forget('user_details');
                    Session::forget('payment_method');
                    ?>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('cusjs')
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $.noConflict();

        });


    </script>
    <style type="text/css">
        .panel-body {
            color: #666;
        }

        .invoice-title h2, .invoice-title h3 {
            display: inline-block;
        }

        .table > tbody > tr > .no-line {
            border-top: none;
        }

        .table > thead > tr > .no-line {
            border-bottom: none;
        }

        .table > tbody > tr > .thick-line {
            border-top: 2px solid;
        }
    </style>
@endsection