@extends('frontend.layouts.app')

@section('content')
    <!--slider-area-start-->
    @include('frontend.common.slider')
    @include('frontend.common.main_menu')
    <!--slider-area-end-->
    <!-- marquee-area-start-->
    @include('frontend.common.marquee')
    <!-- marquee-area-end-->

    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-9">
                <!-- notice area section -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="notice-title section-title">
                            <h2>নোটিশ বোর্ড</h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="notice-one">
                            <div class="notice-logo">
                                <div class="notice-caption">
                                    <h3>নোটিশ বোর্ড</h3>
                                </div>
                                <div class="notice-list" id="example2">
                                    <ul class="list-unstyled">
                                        @php
                                            $posts = [];
                                        @endphp

                                        @foreach ($posts as $p)
                                            <li><a href="{{ url('notice/' . $p->seo_url) }}">{{ $p->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="notice-btn"><a href="#">সকল</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- notice area section end -->

                <div class="man-service">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="google-map-title  section-title">
                                <h2>সেবা</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $w9 = dynamic_widget($widgets, ['id' => 9, 'heading' => null]);
                        @endphp
                        {!! $w9 !!}
                    </div>
                </div>
                <!-- newsMarquee section start -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="marqueeContent">
                            <div class="ptms_marquee news-marquee">
                                <div class="news-btn3"><a href="#">খবর:</a></div>
                                <div id="example">
                                    <ul class="list-unstyled">

                                        @php
                                            $posts = [];
                                        @endphp

                                        @foreach ($posts as $p)
                                            <li><a href="{{ url('news/' . $p->seo_url) }}">{{ $p->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="news-btn"><a href="#">সকল</a></div>
                        </div>
                    </div>
                </div>
                <div class="category-content">
                    @php
                        $w10 = dynamic_widget($widgets, ['id' => 10, 'heading' => null]);
                    @endphp
                    {!! $w10 !!}

                </div>
            </div>
            <!-- sidebar-ara section start -->
            <div class="col-md-3 col-sm-3">
                @include('frontend.common.right_sidebar')
            </div>
        </div>
    </div>

    <!-- google-map section start -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="google-map">
                    <div class="google-map-title  section-title">
                        <h2>মানচিত্র</h2>
                    </div>
                    <div class="textwidget">
                        @php
                            $w13 = dynamic_widget($widgets, ['id' => 12, 'heading' => null]);
                        @endphp
                        {!! $w13 !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="google-map-title section-title">
                    <h2>যোগাযোগ </h2>
                </div>
                <div class="contact-info">
                    @php
                        $w12 = dynamic_widget($widgets, ['id' => 11, 'heading' => null]);
                    @endphp
                    {!! $w12 !!}
                </div>
            </div>
        </div>
    </div>


    @php
        $side_bar_menu = dynamic_widget($widgets, [
            'id' => 1,
            'heading' => null,
        ]);
    @endphp
    {{-- {!!  $side_bar_menu !!} --}}

    @php
        $widget_info = widget_info($widgets, ['id' => 2, 'heading' => null, 'key' => 'name']);
        //echo $widget_info;
    @endphp


    @foreach ($posts as $post)
        @if ($post->categories == env('REVIEWS'))
            <div class="col-md-12">
                <div class="testimonial-item">
                    <div class="testi-img ">
                        @php
                            $img = App\Image::find($post->images);
                        @endphp
                        <img src="{{ url($img->full_size_directory) }}" alt="{!! $post->title !!}">
                    </div>
                    <div class="client-rating">
                        <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                    </div>
                    <div class="testi-text">
                        <p>{!! $post->description !!}</p>
                        <h4>{!! $post->title !!}</h4>
                        <span class="guest-rev">
                            <a href="#">{!! $post->sub_title !!}</a>
                        </span>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection

@section('cusjs')
@endsection
