@extends('frontend.layouts.app')

@section('content')
    <!--slider-area-start-->
    @include('frontend.common.slider')
    <!--slider-area-end-->
    <!-- marquee-area-start-->
    @include('frontend.common.marquee')
    <!-- marquee-area-end-->

    <div class="about-area">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-9">
                    <div class="google-map-title section-title">
                        <h2>
                            {{ $post->title }}
                        </h2>
                    </div>
                    <div class="about-text">
                        <?php echo $post->description; ?>
                    </div>
                </div>
                <div class="col-md-3 col-sm-9">
                    @include('frontend.common.right_sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection