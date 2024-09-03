<div class="home-chairman-sesction">
    <div class="row">
        @foreach ($people as $item)
        <div class="col-md-6">
            <div class="google-map-title section-title">
                <h2>
                    {{ $item->designation }}
                </h2>
            </div>
            <div class="charman_wp ">
                <div>
                    @if ($item->photo)
                        <img src="{{ asset($item->photo) }}" alt="">
                    @else
                        <img src="storage/uploads/fullsize/2021-06/chairman-faridpur.jpg" alt="">
                    @endif
                </div>
                <div><br></div>
                <div>
                    <p><b>{{ $item->name }}</b></p>
                </div>
                <div>
                    <p>{{ $item->designation }},{{ $item->address }} <br></p>
                </div>
                <div style="text-align: justify;">
                    <p>{{ substr_replace($item->content, '........', 1050) }}
                    </p>
                    <p style="margin-bottom: 0px;" class="text-center"><a
                            href="{{ route('home.person.details', $item->id) }}"
                            class="btn btn-primary">বিস্তারিত</a></p>
                </div>
            </div>
        </div>
    @endforeach
    </div>
    <div class="row" style="display:none">
        <div class="col-md-6">
            <div class="google-map-title section-title">
                <h2>
                    widgets
                </h2>
            </div>
            <div class="charman_wp">
                widgets
            </div>
        </div>
        <div class="col-md-6">
            <div class="google-map-title section-title">
                <h2>
                    widgets
                </h2>
            </div>
            <div class="charman_wp">
                widgets
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-md-6">
            <div class="google-map-title section-title">
                <h2>
                    {{$widgets[14]['name']}}
                </h2>
            </div>
            <div class="charman_wp">
                {!! $widgets[14]['description'] !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="google-map-title section-title">
                <h2>
                    {{$widgets[15]['name']}}
                </h2>
            </div>
            <div class="charman_wp">
                {!! $widgets[15]['description'] !!}
            </div>
        </div>
    </div> --}}

</div>
