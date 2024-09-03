@extends('frontend.layouts.app')

@section('content')
    <?php
    $data = Session::all();
    ?>
    <div class="container">
        <div class="row">
            <div class="breadcrumb-warp section-margin-two">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <?php
                        $breadcrumbs = new Creitive\Breadcrumbs\Breadcrumbs;

                        $breadcrumbs->setDivider(' » &nbsp;');
                        $breadcrumbs->addCrumb('Home', url('/'))
                            ->addCrumb('Order Review', 'product');
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
    <!--prosuct-view-section  -->
    <section class="prosuct-view-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="reloader">
                        <div class="about-text">
                            <h2 class="carddlist-title"><i class="fa fa-shopping-cart"></i> Order Review </h2>
                            <p>

                                Review your order properly before hitting
                                <b>
                                    @if($data['payment_method']['payment_method'] == 'cash_on_delivery')
                                        Confirm & Get Invoice
                                    @else
                                        Pay Now
                                    @endif
                                </b>
                                button down below.
                            </p>

                            @include('frontend.common.message_handler')

                            @if(Session::has('cart') && Session::has('user_details') && Session::has('payment_method'))

                                <table class=" table table-one table-striped" style="width:100%">
                                    <thead>
                                    <tr class="CartProduct cartTableHeader pd-table-header table-striped">
                                        <td style="width:15%; text-align: left;"> Product</td>
                                        <td style="width:40%; text-align: left;">Details</td>
                                        <td style="width:10%" class="delete">Unit Price</td>
                                        <td style="width:10%">Qty</td>

                                        <td style="width:15%; text-align: right;">Total</td>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @if(!empty($cartproducts))
                                        @foreach($cartproducts as $product)

                                            <?php
                                            $product_info = App\Product::find($product['item']['productid']);

                                            $totalqty[] = $product['qty'];
                                            $totalprice[] = $product['purchaseprice'] * $product['qty'];
                                            ?>

                                            <tr class="CartProduct">
                                                <td class="CartProductThumb cart-pd-thumb">
                                                    <div>
                                                        <a href="{{ seo_url_by_id($product['item']['productid']) }}">
                                                            <img src="{{ get_first_product_image($product['item']['productid'], $product_info) }}"
                                                                 alt="img" style="opacity: 1;"/>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="CartDescription">
                                                        <h4>
                                                            <a href="{{ seo_url_by_id($product['item']['productid']) }}">
                                                                {{ product_title($product['item']['productid']) }}
                                                            </a>
                                                        </h4>
                                                        <div class="price">
                                                            <small>
                                                        <span>
                                                            PP: {{ $tksign }} {{ $product['item']['purchaseprice'] }},
                                                        </span>
                                                                <span>
                                                            PC: {{ $product['item']['productcode'] }}
                                                        </span>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="delete">
                                                    {{ $tksign }} {{ number_format($product['purchaseprice']) }}
                                                </td>
                                                <td class="checker-one" style="text-align: center;">
                                                    {{ $product['qty'] }}
                                                </td>

                                                <td class="price price-one" style="text-align: right;">
                                                    <span> {{ $tksign }} {{ number_format($product['purchaseprice'] * $product['qty'])  }}</span>
                                                </td>
                                            </tr>

                                        @endforeach
                                    @endif

                                    <tr class="CartProductWhite" style="color: #000;">
                                        <td colspan="4">
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

                                    <tr class="CartProductWhite" style="color: #000;">
                                        <td colspan="4">
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
                                            <span style="color: black;">

                                                <?php
                                                //dump($grand_total);
                                                //dump($paymentsetting->decidable_amount);
                                                ?>

                                                @if($grand_total <= $paymentsetting->decidable_amount)
                                                    Free Delivery!
                                                @else
                                                    @if(!empty($data['user_details']) && ($data['user_details']['district'] == 'Dhaka'))
                                                        {{ $data['user_details']['deliveryfee'] }}
                                                    @else
                                                        {{ $data['user_details']['deliveryfee'] }}
                                                    @endif

                                                @endif

                                            </span>
                                        </td>
                                    </tr>

                                    <tr class="CartProductWhite" style="color: #000;">
                                        <td colspan="4">
                                            Payment Method
                                        </td>
                                        <td class="text-right">
                                            <span style="color: black;">
                                                <?php
                                                $data = Session::all();
                                                if (!empty($data['payment_method'])) { ?>
                                                @if($data['payment_method']['payment_method'] == 'cash_on_delivery')
                                                    Cash On Delivery
                                                @elseif($data['payment_method']['payment_method'] == 'bkash')
                                                    bKash
                                                @elseif($data['payment_method']['payment_method'] == 'debitcredit')
                                                    Debit/Credit Card
                                                @endif
                                                <?php } ?>

                                            </span>
                                        </td>
                                    </tr>

                                    <tr class="CartProductWhite" style="color: #000;">
                                        <td colspan="4">
                                            Total Price
                                        </td>
                                        <td class="text-right">
                                            <span style="color: black;">
                                            @if(!empty($totalprice))
                                                    {{ $tksign }} {{ number_format(array_sum($totalprice)) }}
                                                @endif
                                            </span>
                                        </td>
                                    </tr>

                                    <tr class="CartProductBlue" style="background: #0a70b9 none repeat scroll 0 0;">
                                        <td colspan="4">
                                            Grand Total
                                        </td>
                                        <td class="text-right">
                                            @if(!empty($grand_total))
                                                {{ $tksign }} {{ number_format($grand_total) }}
                                            @endif
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                                <div class="table-box">
                                    {{--<a class="btn pull-left btn-one colorwhite" target="_blank" href="{{ url('/') }}">--}}
                                    {{--<i class="fa fa-arrow-left"></i>--}}
                                    {{--More Buying--}}
                                    {{--</a>--}}

                                    <a class="btn pull-right btn-two" href="{{ url('checkout/pay_now') }}"
                                       id="confirm_order">
                                        @if($data['payment_method']['payment_method'] == 'cash_on_delivery')
                                            Confirm & Get Invoice
                                        @else
                                            Pay Now <i class="fa fa-arrow-right"></i>
                                        @endif

                                    </a>
                                </div>
                            @else
                                <h3>Opps... You have not added any product on your cart yet.</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>

            <?php
            //$data['user_details'];


            /**
            $data = Session::all();
            if (!empty($paymentsetting)) {
            dump($paymentsetting);
            }
            if (!empty($data['cart'])) {
            dump($data['cart']);
            }
            if (!empty($data['user_details'])) {
            dump($data['user_details']);
            }

            if (!empty($data['payment_method'])) {
            dump($data['payment_method']);
            }
             **/
            ?>
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
        tr.CartProduct td {
            color: #666;
        }

        tr.CartProductBlue td {
            color: #FFF;
        }
    </style>
@endsection