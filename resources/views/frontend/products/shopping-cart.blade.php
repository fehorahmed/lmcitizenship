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
                            ->addCrumb('Order List', 'product');
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
                            <h2 class="carddlist-title"><i class="fa fa-shopping-cart"></i> Order List </h2>
                            @if(Session::has('cart'))
                                <table class=" table table-one table-striped" style="width:100%">
                                    <thead>
                                    <tr class="CartProduct cartTableHeader pd-table-header table-striped">
                                        <td style="width:15%; text-align: left;"> Product</td>
                                        <td style="width:35%; text-align: left;">Details</td>
                                        <td style="width: 5%; text-align: left;">Unit</td>
                                        <td style="width:10%" class="delete">&nbsp;</td>
                                        <td style="width:10%">QTY</td>

                                        <td style="width:15%; text-align: right;">Total</td>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @if(!empty($cartproducts))
                                        @foreach($cartproducts as $product)

                                            <?php
                                            //dump($product);
                                            ?>
                                            <?php
                                            $product_info = App\Product::find($product['item']['productid']);

                                            $totalqty[] = $product['qty'];
                                            $totalprice[] = $product['purchaseprice'] * $product['qty'];

                                            ?>

                                            <tr class="CartProduct">
                                                <td class="CartProductThumb cart-pd-thumb">
                                                    <div>
                                                        <a href="{!! product_seo_url($product_info->seo_url, $product_info->id) !!}">
                                                            <img src="{{ get_first_product_image($product['item']['productid'], $product_info) }}"
                                                                 alt="img" style="opacity: 1;"/>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="CartDescription">
                                                        <h4>
                                                            <a href="{!! product_seo_url($product_info->seo_url, $product_info->id) !!}">
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
                                                <td>
                                                    <div class="CartDescription">
                                                        <div class="price">
                                                            <span>
                                                                @if($product_info->unit == env('SFT'))
                                                                    <span class="unit_p">SFT</span>
                                                                @elseif($product_info->unit == env('CFT'))
                                                                    <span class="unit_p">CFT</span>
                                                                @elseif($product_info->unit == env('PIECE'))
                                                                    <span class="unit_p">PCS</span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="delete">
                                                    <a href="javascript:void(0)"
                                                       onclick="remove_cart_item({{ $product['item']['productid'] . ', ' . $product['item']['productcode'] }})">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </td>
                                                <td class="checker-one" style="text-align: center;">
                                                    <input
                                                            name="qty[]"
                                                            type="number"
                                                            id="qty_change_checker"
                                                            value="{{ $product['qty'] }}"
                                                            data-productcode="{{ $product['item']['productcode'] }}"
                                                            data-productid="{{ $product['item']['productid'] }}"
                                                            data-price="{{ $product['item']['purchaseprice'] }}"
                                                            style="width:40px;">
                                                </td>

                                                <td class="price price-one">
                                                    <span> {{ $tksign }} {{ number_format($product['purchaseprice'] * $product['qty'])  }}</span>
                                                </td>
                                            </tr>

                                        @endforeach
                                    @endif

                                    <tr class="CartProduct" style="background: #0a70b9 none repeat scroll 0 0;">
                                        <td colspan="4">

                                        </td>
                                        <td>
                                            Quantity
                                        </td>
                                        <td class="text-right">
                                            @if(!empty($totalqty))
                                                {{ array_sum($totalqty) }}
                                            @endif
                                        </td>
                                    </tr>

                                    <tr class="CartProduct" style="background: #0a70b9 none repeat scroll 0 0;">
                                        <td colspan="4">

                                        </td>
                                        <td>
                                            Total Price
                                        </td>
                                        <td class="text-right">
                                            @if(!empty($totalprice))
                                                {{ $tksign }} {{ number_format(array_sum($totalprice)) }}
                                            @endif
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                                <div class="table-box">
                                    <a class="btn pull-left btn-one colorwhite" target="_blank" href="{{ url('/') }}">
                                        <i class="fa fa-arrow-left"></i>
                                        More Buying
                                    </a>

                                    <a class="btn pull-right btn-two" href="{{ url('checkout/address') }}"
                                       id="confirm_order">
                                        Confirm Order <i class="fa fa-arrow-right"></i>
                                    </a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button class="btn pull-right btn-three"
                                            id="update_cart">
                                        <i class="fa fa-undo"></i>
                                        Update cart
                                    </button>
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
        </div>
    </section>
@endsection
@section('cusjs')
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $.noConflict();

            $('input[name="qty[]"]').on('keyup', function () {
                var qty = $(this).val();
                var productcode = $(this).data('productcode');
                var productid = $(this).data('productid');

                jQuery('#confirm_order').removeAttr("href");
                jQuery("#confirm_order").removeClass('btn-two');
                jQuery("#update_cart").addClass('btn-three');
            });

            $('input[name="qty[]"]').on('change', function () {
                var qty = $(this).val();
                var productcode = $(this).data('productcode');
                var productid = $(this).data('productid');

                jQuery('#confirm_order').removeAttr("href");
                jQuery("#confirm_order").removeClass('btn-two');
                jQuery("#update_cart").addClass('btn-three');
            });

            $("#update_cart").on('click', function () {

                var dataArray = [];

                $('input[name="qty[]"]').each(function () {
                    var qty = $(this).val();
                    var id = $(this).data('productid');
                    var code = $(this).data('productcode');

                    var data = {
                        'qty': qty,
                        'productid': id,
                        'productcode': code,
                    };
                    dataArray.push(data);

                    //console.log(dataArray);


                }).promise().done(function () {


                    var m = JSON.stringify(dataArray);
                    //console.log(dataArray);

                    $.ajax({
                        url: baseurl + '/update_qty',
                        type: 'POST',
                        dataType: "json",
//                        data: m,
                        data: {cart: m},
                        success: function (data) {
                            //alert(data);
                            location.reload();
                            update_mini_cart();

                        },
                        error: function () {
                            //alert(data);
                        }
                    });
                });
            });

        });


    </script>
@endsection