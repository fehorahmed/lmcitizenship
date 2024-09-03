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
                            ->addCrumb('Payment Canceled', 'product');
                        echo $breadcrumbs->render();
                        ?>
                    </div>
                    <!-- breadcrumb  end-->
                </div>
            </div>
        </div>
    </div>
    <section class="prosuct-view-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    @include('frontend.common.message_handler')

                    <h1>{{ $success }}</h1>
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
@endsection