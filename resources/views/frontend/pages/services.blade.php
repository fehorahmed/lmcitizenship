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
    <div class="service-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="service-taitle">
                        <h1>OUR CLEANING SERVICES</h1>
                    </div>
                </div>
            </div>
            <div class="row">


                @foreach($services as $post)
                    @if($post->categories == env('SERVICES'))
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="service-item">
                                <a title="View Details" href="{{ url('services/' . $post->seo_url) }}">
                                    <div class="service-box">
                                        <?php $img = App\Image::find($post->images); ?>
                                        <img src="{{ url($img->full_size_directory) }}" alt="{!! $post->title !!}">
                                    </div>
                                </a>
                                <div class="service-box-inner">
                                    <a title="View Details" href="javascript:void(0)">book now</a>
                                </div>
                                <div class="service-box-info">
                                    <a title="View Details" href="javascript:void(0)">
                                        <h4>{!! $post->title !!}</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach


            </div>
        </div>
    </div>
    <!--our-services-area-end-->
    <!--contact-us-area-->
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