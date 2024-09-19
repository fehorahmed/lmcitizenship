<div class="row up_top" style="margin-top: 20px;">
    <div class="col-md-12" style="margin-bottom: 5px;">
        @if (Auth::check())

            <ul class="nav navbar-nav">
                {{-- @if (Request::segment(1) == 'my_account')
            @else
            <li>
                <a title="Home" href="{{url('/')}}">
            <i class="fa fa-home"></i> হোম
            </a>
            </li>
            @endif --}}
                <li>
                    <a href="javascript:void(0)">
                        <i class="fa fa-user"></i> স্বাগতম , {{ Auth::user()->name }}
                    </a>
                </li>
                @if (Auth::user())
                    <li class="{{ Request::segment(1) == 'my_account' ? 'nav_active' : null }}">
                        <a href="{{ url('my_account') }}">
                            আমার ড্যাশবোর্ড
                        </a>
                    </li>
                @endif
                @if (Auth::user()->isDigitalCenter())
                    {{--   <li class="{{ Request::segment(1) == 'pending_payment' ? 'nav_active' : null }}">
                        <a href="{{ url('/pending_payment') }}">

                            অপেক্ষারত পেমেন্ট

                        </a>
                    </li>

                    <li class="{{ Request::segment(1) == 'distal_account' ? 'nav_active' : null }}">
                        <a href="{{ url('/distal_account') }}">
                            হিসাব ব্যবস্থাপক
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ url('/home') }}">
                            ওয়েবসাইট
                        </a>
                    </li> --}}
                @endif

                @if (Auth::user()->isDigitalCenter() || Auth::user()->isCommissioner())
                    <li class="{{ Route::is('digital.pending_payment') ? 'nav_active' : null }}">
                        <a href="{{ route('digital.pending_payment') }}">
                            অপেক্ষারত যাচাই
                            @if (pendding_payment_count())
                                <span class="text-danger notice_icon">{{ pendding_payment_count() }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="{{ Route::is('digital.income_statement') ? 'nav_active' : null }}">
                        <a href="{{ route('digital.income_statement') }}">
                            সনদ তালিকা

                        </a>
                    </li>
                    <li class="{{ Route::is('digital.cancel_statement') ? 'nav_active' : null }}">
                        <a href="{{ route('digital.cancel_statement') }}">
                            বাতিল তালিকা
                        </a>
                    </li>
                @endif
                {{-- @if (Auth::user()->isCommissioner())
                    <li class="{{ Route::is('digital.pending_payment') ? 'nav_active' : null }}">
                        <a href="{{ route('digital.pending_payment') }}">
                            অপেক্ষারত যাচাই
                            @if (pendding_payment_count())
                            <span class="text-danger notice_icon">{{ pendding_payment_count() }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="{{ Route::is('digital.income_statement') ? 'nav_active' : null }}">
                        <a href="{{ route('digital.income_statement') }}">
                            সনদ তালিকা

                        </a>
                    </li>
                @endif --}}
                @if (Auth::user()->isMember())
                    <li
                        class="dropdown
                    {{ Request::segment(1) == 'add_profile' || Request::segment(1) == 'profile_list' || Request::segment(1) == 'income_statement' ? 'nav_active' : null }}
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="true">
                            প্রোফাইল সম্পাদনা <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" style="text-align: left;">



                            <li>
                                <a href="{{ url('profile_edit') }}">প্রোফাইল</a>
                            </li>

                            <li>
                                <a href="{{ url('my_payment_history') }}">অর্থ প্রদান ইতিহাস</a>
                            </li>
                            <!-- <li>
                                <a href="{{ url('business') }}">ব্যবসা</a>
                            </li> -->

                        </ul>
                    </li>
                @endif
                <li class="pull-right">
                    @if (auth()->user()->isAdmin())
                        <a href="{{ url('/dashboard') }}">
                            <i class="fa fa-cog"></i> এডমিন ড্যাশবোর্ড
                        </a>
                    @else
                        {{-- <a href="{{ url('/logout') }}">
                            <i class="fa fa-sign-out"></i> লগ আউট
                        </a> --}}
                    @endif
                </li>
            </ul>

        @endif
    </div>

</div>

@if (Auth::user()->isDigitalCenter() || Auth::user()->isAdmin())
    <div class="row">
        <div class="col-md-12">
            @if (Auth::user()->isDigitalCenter())
                <p>
                    ধন্যবাদ, {{ Auth::user()->name }} । আপনি একজন <b> ডিজিটাল সেন্টার কর্মকর্তা।</b>
                    আপনি চাইলে যে কারোর প্রোফাইল তৈরি করতে পারবেন, যা পরবতীতে সকল প্রোফাইল তালিকা থেকে পরিবর্তন
                    ও পরিবর্ধন করতে পারবেন।
                </p>
            @elseif(Auth::user()->isAdmin())
                <p>
                    ধন্যবাদ, {{ Auth::user()->name }} ।
                </p>
            @else
                <p>
                    ধন্যবাদ, {{ Auth::user()->name }} । আপনি একজন <b> সাধারণ ব্যবহারকারী</b>
                </p>
            @endif
        </div>
    </div>

    @if (Request::segment(1) == 'distal_account' || Request::segment(1) == 'pending_bc')
    @else
        {{-- <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            ইউজার খুঁজুন
                        </h5>
                    </div>
                    <div class="panel-body">

                        {{ Form::open(['url' => '/search_users_on_frontend', 'method' => 'post', 'value' => 'PATCH', 'id' => '']) }}
                        <div class="row">
                            <div class="col-xs-2">
                                <select name="column" required class="form-control select2" style="width: 100%;">
                                    <option value="Name"
                                        {{ Request::post('column') == 'name' ? 'selected="selected"' : 'selected="selected"' }}>
                                        নাম
                                    </option>
                                    <option value="nidno"
                                        {{ Request::post('column') == 'nidno' ? 'selected="selected"' : '' }}>
                                        ন্যাশনাল আইডি
                                    </option>
                                    <option value="passportno"
                                        {{ Request::post('column') == 'passportno' ? 'selected="selected"' : '' }}>
                                        পাসপোর্ট নং
                                    </option>
                                    <option value="birthcertificateno"
                                        {{ Request::post('column') == 'birthcertificateno' ? 'selected="selected"' : '' }}>
                                        বার্থ সার্টিফিকেট
                                    </option>
                                    <option value="email"
                                        {{ Request::post('column') == 'email' ? 'selected="selected"' : '' }}>
                                        ইমেইল
                                    </option>
                                    <option value="phone"
                                        {{ Request::post('column') == 'phone' ? 'selected="selected"' : '' }}>
                                        ফোন
                                    </option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                {{ Form::text('search_key', Request::post('search_key'), ['required', 'class' => 'form-control', 'placeholder' => '  সার্চ  বিষয়  লিখুন (ইংরেজিতে) ']) }}
                            </div>
                            <div class="col-xs-1">
                                {{ Form::submit(' খুঁজুন ', ['class' => 'btn btn-success']) }}
                            </div>
                        </div>
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div> --}}
    @endif
@endif
