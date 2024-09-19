@php
    $setting = \App\Models\Setting::first();
    // dd($menus[0]->subMenu);
    if ($setting) {
        $name = $setting->name;
        $map_link = $setting->map;
    } else {
        $name = 'মোহনগঞ্জ পৌরসভা, নেত্রকোণা ।';
        $map_link = '';
    }

@endphp
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


