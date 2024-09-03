<header class="top-area">
    <div class="container">
        <div class="row">
            <div class="headertop">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="topLogoName">
                        <div class="textwidget">
                            <a href="{{ url('https://bangladesh.gov.bd/index.php') }}" target="_blank">
                                জাতীয় তথ্য বাতায়ন
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12 col-xs-12">
                    <div class="mlt-form mlt-form2"style="display:none">
                        <select class="form-control" onchange="getUnion(myFunction)" id="changingUpazilla">
                            <option value="">উপজেলা সিলেক্ট করুন </option>
                            @php
                                $upazilla = [];

                            @endphp
                            @foreach ($upazilla as $list)
                                <option value="{{ $list->id }}">
                                    {{ $list->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-12">
                    <div class="mlt-form mlt-form2"style="display:none">
                        <select class="form-control" onchange="javascript:location.href = this.value;" id="union">
                            <option>ইউনিয়ন সিলেক্ট করুন</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 headerDate">
                    <div class="row">
                        <div class="multilangual">

                            <ul class="list-unstyled">
                                <li style="border: none">

                                    <?php

                                    $d = date('D F j, Y');
                                    // $d = en2bnSomeCommonString($d);
                                    // $d = bn2enNumber($d);

                                    echo $d;

                                    ?>

                                </li>
                                @if (url()->current() != 'http://freelanceritbd.com/shariatpur')
                                    @if (Auth::check())
                                        <li>
                                            <a href="{{ url('my_account') }}">
                                                আমার ড্যাশবোর্ড
                                            </a>
                                        </li>
                                        <li>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <a href=""><button type="submit" class="">Logout</button></a>
                                            </form>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('login') }}">
                                                লগইন
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('register') }}">
                                                রেজিস্টার
                                            </a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
