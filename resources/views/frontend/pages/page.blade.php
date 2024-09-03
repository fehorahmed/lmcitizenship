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
            <div class="col-md-12 col-sm-12">
                @if($slug == 'contact')
                @include('frontend.pages.contact_form')
                @else
                <div class="google-map-title section-title">
                    <h2>
                        {{ $page->title }}
                    </h2>
                </div>
                <div class="about-text">
                    @if($page->image)
                    <img src="{{ url(@$page->image->icon_size_directory) }}" style="width: 30%"
                        class="img-responsive" />
                    @endif
                    <?php echo $page->description; ?>
                </div>
                @endif
            </div>
            {{-- <div class="col-md-3 col-sm-9">
                @include('frontend.common.right_sidebar')
            </div> --}}
        </div>
    </div>
</div>
@endsection