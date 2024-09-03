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
    <!--prosuct-view-section  -->
    <section class="prosuct-view-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(Session::has('cart') && Session::has('user_details'))
                        <section>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="about-text">
                                            <h2 class="carddlist-title">
                                                {{ $tksign }} Payment Method
                                            </h2>
                                            <p>Please select the preferred Payment method to use on this order.</p>
                                            <p>
                                                All transactions are secure and encrypted, and we neverstore.
                                                To learn more, please view our privacy policy.
                                            </p>

                                            @include('frontend.common.message_handler')


                                            {{ Form::open(array('url' => '/checkout/store_payment_method', 'method' => 'post', 'value' => 'PATCH', 'id' => 'payment_method')) }}
                                            <div class="payment-method">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">Payment Method</div>
                                                    <div class="panel-body">

                                                        <div class="form-group">
                                                            @if($paymentsetting->cashondelivery_active == TRUE)
                                                                <div class="radio">
                                                                    <label>
                                                                        {{ Form::radio('payment_method', 'cash_on_delivery', FALSE, ['class' => 'radio', 'required']) }}
                                                                        Cash on delivery
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if($paymentsetting->rocket_active == TRUE)
                                                                <div class="radio">
                                                                    <label>
                                                                        {{ Form::radio('payment_method', 'rocket', FALSE, ['class' => 'radio']) }}
                                                                        Rocket
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if($paymentsetting->bkash_active == TRUE)
                                                                <div class="radio">
                                                                    <label>
                                                                        {{ Form::radio('payment_method', 'bkash', FALSE, ['class' => 'radio']) }}
                                                                        bKash
                                                                    </label>
                                                                </div>
                                                            @endif
                                                            @if($paymentsetting->mobilebanking_active == TRUE)
                                                                <div class="radio">
                                                                    <label>
                                                                        {{ Form::radio('payment_method', 'mobilebanking', FALSE, ['class' => 'radio']) }}
                                                                        Mobile Banking
                                                                    </label>
                                                                </div>
                                                            @endif

                                                            @if($paymentsetting->debitcredit_active == TRUE)
                                                                <div class="radio">
                                                                    <label>
                                                                        {{ Form::radio('payment_method', 'debitcredit', FALSE, ['class' => 'radio']) }}
                                                                        Debit or Credit Card
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="login-bar">

                                                                <input id="terms_check" type="checkbox"
                                                                       name="terms_check" {{ old('remember') ? 'checked' : ''}}>
                                                                I have read and agree to the
                                                                <span>
                                                                    <a style="color: #0A70B9" href="#">Terms & Conditions</a>
                                                                </span>
                                                            </label>

                                                        </div>

                                                        <div class="form-group">

                                                            <?php
                                                            $data = Session::all();
                                                            //dd($data['user_details']['deliveryfee']);
                                                            if (!empty($data['cart'])) {

                                                                foreach ($data['cart']->items as $item) {
                                                                    $totalqty[] = $item['qty'];
                                                                    $totalprice[] = $item['purchaseprice'] * $item['qty'];
                                                                }
                                                            }
                                                            $total_price = array_sum($totalprice);
                                                            $deliverycharge = $data['user_details']['deliveryfee'];
                                                            $grand_total = $total_price + $deliverycharge;
                                                            ?>

                                                            {{ Form::hidden('total_amount', $total_price) }}
                                                            {{ Form::hidden('grand_total', $grand_total) }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="table-box">

                                                                <a class="btn pull-left btn-one colorwhite"
                                                                   href="{{ url()->previous() }}">
                                                                    <i class="fa fa-arrow-left"></i>
                                                                    Back
                                                                </a>

                                                                <button id="checkout_payment_method"
                                                                        class="btn pull-right btn-two"
                                                                        type="submit">
                                                                    Next <i class="fa fa-arrow-right"></i>
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{ Form::close() }}

                                            <?php
                                            /**
                                            dump($paymentsetting);
                                            $data = Session::all();
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
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                        </section>
                    @else
                        <h3>Opps... You have not added any product on your cart yet.</h3>
                    @endif
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

            $('#checkout_payment_method').on('click', function () {
                if ($("#terms_check").prop('checked') == true) {
                    $('label.login-bar').css('border', '0px solid red');
                    $('label.login-bar').css('padding', '3px');
                } else {
                    $('label.login-bar').css('border', '1px solid red');
                    $('label.login-bar').css('padding', '3px');
                }
            });

        });
    </script>
    <style type="text/css">
        .checkbox label, .radio label {
            color: #666;
        }

        label.login-bar {
            padding: 3px;
        }
    </style>
@endsection