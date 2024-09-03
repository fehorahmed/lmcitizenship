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
                            ->addCrumb('Contact', 'contact');
                        echo $breadcrumbs->render();
                        ?>
                    </div>
                    <!-- breadcrumb  end-->
                </div>
            </div>
        </div>
    </div>
    <div class="">
        {{--{!! $page->description !!}--}}
        <div class="about-area">
            <div class="container">
                <div class="row">

                    <div class="col-md-5">
                        <div class="contact-bdr">
                            <div class="address-bar">
                                <div class="single-address ">
                                    <ul class="list-unstyled">
                                        <li><strong>PRAN-RFL Center</strong></li>
                                        <li>105 MIDDLE Badda</li>
                                        <li>Dhaka 1212, Bangladesh</li>
                                        <li>Phone:</li>
                                        <li>+88-02-9881792- Ext : 563</li>
                                        <li><strong>Email:</strong> info@regalfurniturebd.com</li>
                                        <li>FAX:+88 02 883 550</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="goole-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.0472057447214!2d90.42337821541088!3d23.78133329350973!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c796c76c1a8b%3A0x7ff1d179fba4c47c!2sPRAN-RFL+Group!5e0!3m2!1sen!2sbd!4v1517298467061"
                                        width="100%" height="150" frameborder="0" style="border:0"
                                        allowfullscreen=""></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="contact-form">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form action="{{route('email')}}" method="post">
                                {{ csrf_field() }}
                                <div class="single-form">
                                    <input type="text" name="name" placeholder="Name">
                                </div>
                                <div class="single-form">
                                    <input type="email" name="email" placeholder="Email">
                                </div>
                                <div class="single-form">
                                    <input type="text" name="number" placeholder="Valid bangladeshi mobile number">
                                </div>
                                <div class="form-text-area">
                                    <textarea name="description" id="" cols="30" rows="10"
                                              placeholder="Description"></textarea>
                                </div>
                                <div class="send-btn">
                                    <button>Send</button>
                                    {{--<a href="#">Send</a>--}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection