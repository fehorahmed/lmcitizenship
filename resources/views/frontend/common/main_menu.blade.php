@php

    $menus = \App\Models\MainMenu::where(['type' => 'main', 'status' => 1,'position'=>'header'])->orderBy('order')->get();

@endphp
<div class="container">
    <div class="rwo">
        <div class="col-md-12">
            <div class="row">
                <div class="nav-area">
                    <!-- nav start -->
                    <div id="main-nav" class="stellarnav navone">
                        <ul>


                            <li class="">
                                <a href="{{ route('home') }}">হোম</a>
                            </li>
                            @foreach ($menus as $menu)
                                @if (count($menu->subMenu) > 0)
                                    <li class="has-sub">
                                        <a href="{{url('menu/'.$menu->url)}}">{{$menu->title}}</a>
                                        <ul>
                                            @foreach ($menu->subMenu as $item)
                                            <li class="">
                                                <a href="{{url('menu/'.$item->url)}}">{{$item->title}}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                <li class="">
                                    <a href="{{url('menu/'.$menu->url)}}">{{$item->title}}</a>
                                </li>
                                @endif
                            @endforeach


                        </ul>
                    </div>
                </div>
            </div>
            <!-- nav end -->
        </div>
    </div>
</div>
