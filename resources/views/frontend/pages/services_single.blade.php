@extends('frontend.layouts.app')

@section('content')

    <div class="slider-page">
        <div class="single-slider-page">
            <div class="single-slider-page-table">
                <div class="single-slider-page-table-cell">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="services-text">


                                    <h1 class="services-tailte-text">Services</h1>
                                    <?php
                                    $breadcrumbs = new Creitive\Breadcrumbs\Breadcrumbs;

                                    $breadcrumbs->setDivider(' » &nbsp;');
                                    $breadcrumbs->addCrumb('Home', url('/'))
                                        ->addCrumb('Services', 'contact');
                                    echo $breadcrumbs->render();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="single-services-page area-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 content-sidebar">
                    <aside class="widget service-category-widget">
                        <h3>service provided</h3>
                        <ul>
                            @foreach($services as $post)
                                @if($post->categories == env('SERVICES'))
                                    <li>
                                        <i class="fa fa-long-arrow-right"></i>
                                        <a title="{!! $post->title !!}" href="{{ url('services/' . $post->seo_url) }}">
                                            {!! $post->title !!}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </aside>
                    <aside class="widget address-widget">
                        <h3>MORE INFORMATION</h3>
                        <p>123 Cleaning Company,</p>
                        <p>New Street CA 7854, Park Avenue</p>
                        <p>Sydney 25.</p>
                        <p><span>+(01) 800 527 4800</span></p>
                        <a title="Mail To" href="mailto:makeclean@example.com">Makeclean@example.com</a>
                    </aside>
                </div>
                <div class="col-md-9 col-sm-8 services-content-area">


                    <div class="section-header">
                        <h3>{!! $service_single->title !!}</h3>
                    </div><!-- Section Header /- -->

                    {!! $service_single->description !!}

                </div>
            </div>
        </div>
    </div>




    <div class="call-ation-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="call-ation-info  info-bg1">
                        <div class="contact-icone">
                            <img src="img/phone-icon.png" alt="">
                        </div>
                        <div class="contact-text">
                            <h1>Have a question? Call us now</h1>
                            <h3>1-800-300-2121</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="contact-info info-bg2 ">
                        <div class="contact-icone">
                            <img src="img/clock-icon.png" alt="">
                        </div>
                        <div class="contact-text">
                            <h1>We are open Monday-Friday</h1>
                            <h3><strong>08:00 - 17:00</strong></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="contact-tedxt-ifno info-bg3">
                        <div class="contact-icone">
                            <img src="img/pointer-icon.png" alt="">
                        </div>
                        <div class="contact-text">
                            <h1>need cleaning? our address</h1>
                            <h3>437 S Olive St, Los Angeles</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('cusjs')
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $.noConflict();


        });
    </script>

    <style type="text/css">

    </style>
@endsection