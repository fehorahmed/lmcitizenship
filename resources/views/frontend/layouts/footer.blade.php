<!-- <div class="footer-top-one">
    <div class="container">
        <div class="row">
            <div class="footer-wap">
                <div class="col-md-3 col-sm-3">
                    <div class="single-footer">
                        <div class="footer-caption">
                            <h3>ই-আবেদন</h3>
                        </div>
                        <div class="footer-list">
                            <?php $parent_items = []; //dump($parent_items);
                            ?>
                            <ul>
                                @if (isset($parent_items))
@foreach ($parent_items as $parent)
<li>
                                            <a href="{{ $parent->link }}">
                                                {{ $parent->label }}
                                            </a>
                                        </li>
@endforeach
@endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="single-footer">
                        <div class="footer-caption">
                            <h3>ই-আবেদন</h3>
                        </div>
                        <div class="footer-list">
                            <?php $parent_items = []; ?>
                            <ul>
                                @if (isset($parent_items))
@foreach ($parent_items as $parent)
<li>
                                            <a href="{{ $parent->link }}">
                                                {{ $parent->label }}
                                            </a>
                                        </li>
@endforeach
@endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="single-footer">
                        <div class="footer-caption">
                            <h3>সকল আবেদন যাচাই</h3>
                        </div>
                        <div class="footer-list">
                            <?php $parent_items = []; ?>
                            <ul>
                                @if (isset($parent_items))
@foreach ($parent_items as $parent)
<li>
                                            <a href="{{ $parent->link }}">
                                                {{ $parent->label }}
                                            </a>
                                        </li>
@endforeach
@endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="single-footer">
                        <div class="footer-caption">
                            <h3>সকল সনদ যাচাই</h3>
                        </div>
                        <div class="footer-list">
                            <?php $parent_items = []; ?>
                            <ul>
                                @if (isset($parent_items))
@foreach ($parent_items as $parent)
<li>
                                            <a href="{{ $parent->link }}">
                                                {{ $parent->label }}
                                            </a>
                                        </li>
@endforeach
@endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- footer-top area end -->
@php
        $setting = \App\Models\Setting::first();
        $menus = \App\Models\MainMenu::where(['status'=>1, 'position'=>'footer'])->orderBy('order')->get();
    if ($setting) {
        $name = $setting->name;
        $map_link = $setting->map;
    } else {
        $name = 'মোহনগঞ্জ পৌরসভা, নেত্রকোণা ।';
        $map_link = '';
    }

@endphp
<div class="footer-btn">
    <div class="container">
        <div class="footer-btn-warp">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-down-left">
                        <div class="ftr-menu">
                            <ul class="list-unstyled">
                                @foreach ($menus as $menu)
                                <li><a href="{{url('menu/'.$menu->url)}}">{{$menu->title}}</a></li>
                                @endforeach

                            </ul>
                        </div>
                        <p>{{ $name }} </p>
                    </div>
                    <div class="footer-down-right">
                        <ul class="list-unstyled">
                            <li>সামাজিক যোগাযোগ</li>
                            <li><a href="#"><img src="http://localhost:8044/public/frontend/img/socile/1.png"
                                        alt=""></a>
                            </li>
                            <li><a href="#"><img src="http://localhost:8044/public/frontend/img/socile/2.png"
                                        alt=""></a>
                            </li>
                            <li><a href="#"><img src="http://localhost:8044/public/frontend/img/socile/3.png"
                                        alt=""></a>
                            </li>
                        </ul>
                        <div class="copy-right">
                            <p>ডিজাইন &amp; ডেভেলপড বাইঃ এফএলআইটি ০১৯৪৮২৬৩৩৫৮ / ০১৭২৯৭২৪২৩২</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    {{-- @php
                    dump(getvisitor());
                @endphp --}}

                    <div class="ftr-menu text-center">
                        <ul class="list-unstyled"
                            style=" border: 2px solid #185b9d; display: inline-block; padding: 5px; margin-bottom: 4px;">


                            <li>
                                <i class="fa fa-users" aria-hidden="true"></i>
                                Today Visitor:
                                {{-- {{ getvisitor()['unique24h'] }} --}}

                            </li>
                            <li>
                                <i class="fa fa-bar-chart" aria-hidden="true"></i> Total Visitor :
                                {{-- {{ getvisitor()['uniqueTotal'] }} --}}

                            </li>
                        </ul>
                    </div>





                </div>


            </div>
        </div>
    </div>
</div>

<div class="outer-socile">
    <div class="souter-socile-list">
        <ul class="list-unstyled">
            <li><a href="#"><img src="{{ URL::asset('public/frontend/img/socile/facebook.jpg') }}"
                        alt=""></a></li>
            <li><a href="#"><img src="{{ URL::asset('public/frontend/img/socile/twitter.jpg') }}"
                        alt=""></a></li>
            <li><a href="#"><img src="{{ URL::asset('public/frontend/img/socile/youtube.jpg') }}"
                        alt=""></a></li>
            <li><a href="#"><img src="{{ URL::asset('public/frontend/img/socile/gmail.jpg') }}"
                        alt=""></a></li>
        </ul>
    </div>
</div>
