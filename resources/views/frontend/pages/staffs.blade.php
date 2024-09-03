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
                <div class="google-map-title section-title">
                    <h2>
                        {{$title}}
                    </h2>
                </div>
                <div class="about-text">
                    <table class="table table-striped">
                    @php
                        $n = 0;
                    @endphp
                        @if($items->count())
                        <thead>
                            <tr>
                                <th scope="col">ক্র.নং</th>
                                <th scope="col">ছবি</th>
                                <th scope="col">নাম</th>
                                <th scope="col">পদবী</th>
                                {{-- <th scope="col">Static</th> --}}
                                {{-- <th scope="col">Category</th> --}}
                                <th scope="col">মোবাইল নং</th>
                                <th scope="col">ইমেইল</th>
                                @if(Request::segment(1) == 'panel-mayor' || Request::segment(1) == 'councilor')
                                <th scope="col">ওয়ার্ড নং</th>
                                @endif
                                <th scope="col">মন্তব্য</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($items as $item)
                            <tr>
                                <th style="vertical-align:middle" scope="row" >{{++$n}}</th>
                                @php
                                $images = App\Image::find($item->image);
                                @endphp
                                <td style="vertical-align:middle"><img src="{{url($images->icon_size_directory)}}" alt="{{$images->original_name}} " class="margin img-fluid" style=" height: 90px; width: 95px;"> </td>
                                <td style="vertical-align:middle">{{$item->name}}</td>
                                <td style="vertical-align:middle">{{$item->designation}}</td>
                                {{-- <td style="vertical-align:middle">{{$item->static}}</td> --}}
                                {{-- <td style="vertical-align:middle">{{$item->category}}</td> --}}
                                <td style="vertical-align:middle">{{$item->phone}}</td>
                                <td style="vertical-align:middle">{{$item->email}}</td>
                                @if(Request::segment(1) == 'panel-mayor' || Request::segment(1) == 'councilor')
                                <td style="vertical-align:middle">{{$item->word}}</td>
                                @endif
                                <td style="vertical-align:middle">{{$item->comment}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        @else
                        <p> No Data to show</p>
                        @endif
                    </table>
                </div>
            </div>
            {{-- <div class="col-md-3 col-sm-9">
                @include('frontend.common.right_sidebar')
            </div> --}}
        </div>
    </div>
</div>
@endsection
