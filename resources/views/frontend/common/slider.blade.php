<section class="">
    <div class="container">
        <div class="row">
            <div class=" ads-box col-md-12">
                @if (isset($setting->banner))
                <img src="{{ asset($setting->banner) }}" alt="">
                @else
                <img src="{{ asset('frontend/img/slider/topbanner.jpeg') }}" alt="">
                @endif

            </div>
        </div>
    </div>
</section>
<section class="slider-area"style="display:none">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">

                        <?php

                        $slider = [];
                        // dump($slider);
                        $i = 0;
                        ?>
                        @foreach ($slider as $post)
                            <?php $img = \App\Image::find($post->images); ?>

                            <?php
                            if ($i == 1) {
                                $active = ' active';
                            } else {
                                $active = null;
                            }

                            ?>
                            <div class="item {{ $active }}">
                                <?php //dump(url($img->full_size_directory));
                                ?>
                                <img src="{{ url($img->full_size_directory) }}" alt="{!! $post->title !!}">
                            </div>

                            <?php $i++; ?>
                        @endforeach

                    </div>

                    {{-- <!-- Controls --> --}}
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="home-logo">
            @if (!empty($setting))
                <a href="{{ url('/') }}">
                    <img src="{{ url($setting->logo) }}" alt="">
                    <h2>{{ $setting->name }}</h2>
                </a>
            @endif
        </div>
    </div>
    </div>
</section>

<div class="container">
    <div class="rwo">
        <div class="col-md-12">
            <div class="row">
                <div class="nav-area">
                    <!-- nav start -->
                    <div id="main-nav" class="stellarnav navone">
                        <?php $parent_items = []; ?>
                        <ul>


                            <li>
                                <a href="{{route('home')}}">হোম</a>




                            </li>
                            <li class="has-sub">
                                <a href="http://esebampa.freelanceritbd.com/page/44/about-local- government">স্থানীয়
                                    সরকার সম্পর্কিত</a>
                                <ul>
                                    <li>
                                        <a href="http://esebampa.freelanceritbd.com/page/45/branch-info">শাখার পরিচিতি
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://esebampa.freelanceritbd.com/page/46/law-and-policy">আইন ও পলিসি
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://esebampa.freelanceritbd.com/page/47/activities">কার্যক্রম </a>
                                    </li>
                                </ul>


                                <a class="dd-toggle" href="#"><i class="fa fa-plus"></i></a>
                            </li>
                            <li>
                                <a href="http://esebampa.freelanceritbd.com/page/60/citizen-charter">নাগরিক সেবা</a>




                            </li>
                            <li class="has-sub">
                                <a href="http://esebampa.freelanceritbd.com/page/51/projects">প্রকল্পসমূহ</a>
                                <ul>
                                    <li>
                                        <a href="http://esebampa.freelanceritbd.com/page/52/ongoing-projects">চলতি
                                            প্রকল্পসমূহ </a>
                                    </li>
                                    <li>
                                        <a href="http://esebampa.freelanceritbd.com/page/53/previous-projects">পূর্ববর্তী
                                            প্রকল্পসমূহ </a>
                                    </li>
                                    <li>
                                        <a href="http://esebampa.freelanceritbd.com/page/54/project-inspection">প্রকল্প
                                            পরিদর্শন </a>
                                    </li>
                                    <li>
                                        <a href="http://esebampa.freelanceritbd.com/page/55/relief-program">ত্রাণ
                                            কর্মসুচী </a>
                                    </li>
                                    <li>
                                        <a href="http://esebampa.freelanceritbd.com/page/71/tr">টিআর </a>
                                    </li>
                                    <li>
                                        <a href="http://esebampa.freelanceritbd.com/page/72/kabikha">কাবিখা </a>
                                    </li>
                                    <li>
                                        <a href="http://esebampa.freelanceritbd.com/page/73/kabita">কাবিটা </a>
                                    </li>
                                    <li>
                                        <a href="http://esebampa.freelanceritbd.com/page/74/gr">জিআর </a>
                                    </li>
                                    <li>
                                        <a href="http://esebampa.freelanceritbd.com/page/75/lgsp">এলজিএসপি </a>
                                    </li>
                                    <li>
                                        <a href="http://esebampa.freelanceritbd.com/page/76/lgd">এলজিডি </a>
                                    </li>
                                </ul>


                                <a class="dd-toggle" href="#"><i class="fa fa-plus"></i></a>
                            </li>
                            <li>
                                <a href="http://esebampa.freelanceritbd.com/page/57/photo-gallery">ফটো গ্যালারী</a>




                            </li>
                            <li>
                                <a href="http://esebampa.freelanceritbd.com/page/58/video-gallery">ভিডিও গ্যালারী</a>




                            </li>
                            <li>
                                <a href="http://esebampa.freelanceritbd.com/page/56/contact">যোগাযোগ</a>




                            </li>
                            <li>
                                <a href="http://esebampa.freelanceritbd.com/page/61/e-services">ই –সেবা সমূহ</a>




                            </li>
                            <li class="has-sub">
                                <a href="manpower">জনবল</a>
                                <ul>
                                    <li>
                                        <a href="officers">কর্মকর্তাবৃন্দ </a>
                                    </li>
                                    <li>
                                        <a href="staffs">কর্মচারীবৃন্দ </a>
                                    </li>
                                </ul>


                                <a class="dd-toggle" href="#"><i class="fa fa-plus"></i></a>
                            </li>
                            <li class="has-sub">
                                <a href="public-representative">জনপ্রতিনিধি</a>
                                <ul>
                                    <li>
                                        <a href="panel-mayor">প্যানেল মেয়রগন এর তথ্য </a>
                                    </li>
                                    <li>
                                        <a href="councilor">কাউন্সিলর বৃন্দের তথ্য </a>
                                    </li>
                                </ul>
                                <a class="dd-toggle" href="#"><i class="fa fa-plus"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- nav end -->
        </div>
    </div>
</div>
