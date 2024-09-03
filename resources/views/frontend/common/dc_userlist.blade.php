@extends('frontend.layouts.app')

@section('content')
    <div class="container user_panel">
        @include('frontend.common.frontend_user_menu')
        @if (Route::has('login'))
            <?php $user_own = Auth::user(); ?>
            <div class="row up_bottom">
                <div class="col-md-12">

                    <table class="table table-striped table-bordered">
                        <tbody>
                        <tr style=" background: #9E5BBA !important; color: #FFF;">
                            <th>
                                নাম
                            </th>
                            <th>
                                ইউজার তথ্য
                            </th>
                            <th>
                                অন্যান্য ইউজার তথ্য
                            </th>
                            <th>
                                সংযোজন
                            </th>
                            <th>
                                ডাউনলোড
                            </th>
                        </tr>
                        @foreach($mine_users as $user)
                            @if($user->id === $user_own->id)
                                <?php $bg = 'style="background-color: #dff0f9;"'; ?>
                            @endif

                            <tr {!! !empty($bg) ? $bg : null !!}>
                                <td>
                                    {{ $user->name }}<br/>
                                    <small>
                                        <b title="Created"> Added:</b> {{ $user->created_at }}<br/>
                                        <b title="Updated"> Updated:</b> {{ $user->updated_at }}
                                    </small>
                                </td>
                                <td>
                                    <small>
                                        <b title="Email"> ইমেইল -</b> {{ $user->email }}<br/>
                                        <b title="National ID">
                                            এন আইডি -</b> {{ $user->nidno }}<br/>
                                        <b title="Passport No.">
                                            পাসপোর্ট -</b> {{ $user->passportno }}<br/>
                                        <b title="Birth Certificate No."> বার্থ সা- </b>
                                        {{ $user->birthcertificateno }}
                                    </small>
                                </td>
                                <td>
                                    <small>
                                        <b title="Date of Birth"> জন্মতারিখ
                                            :</b> {{ $user->birthday }}<br/>
                                        <b title="Gender"> লিঙ্গ:</b> {{ $user->gender }}<br/>
                                        <b title="Religion"> ধর্ম:</b> {{ $user->religion }}<br/>
                                        <b title="Marital Status">
                                            বৈবাহিক অবস্থা:</b> {{ $user->marital_status }}<br/>
                                        <b title="Phone"> ফোন:</b> {{ $user->phone }}
                                    </small>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-default btn-xs dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-plus"></i> হালনাগাদ <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            {{-- <li>
                                                <a target="_blank"
                                                   href="{{ url('general_info_en?id=' . $user->id) }}"
                                                   title="General Information (In English)">
                                                    General Information (ENG)
                                                </a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('general_info_bn?id=' . $user->id) }}"
                                                   title="সাধারণ তথ্যাদি ( বাংলাতে )">
                                                    সাধারণ তথ্যাদি ( বাংলা )
                                                </a>
                                            </li>
                                            <li>
                                                <a target="_blank"
                                                   href="{{ url('present_address_en?id=' . $user->id) }}"
                                                   title="Present Address (In English)">
                                                    Present Address (ENG)
                                                </a>
                                            </li>
                                            <li>
                                                <a target="_blank"
                                                   href="{{ url('present_address_bn?id=' . $user->id) }}"
                                                   title="বর্তমান ঠিকানা ( বাংলাতে )">
                                                    বর্তমান ঠিকানা ( বাংলা )
                                                </a>
                                            </li>
                                            <li>
                                                <a target="_blank"
                                                   href="{{ url('permanent_address_en?id=' . $user->id) }}"
                                                   title="Permanent Address (In English)">
                                                    Permanent Address (ENG)
                                                </a>
                                            </li>
                                            <li>
                                                <a target="_blank"
                                                   href="{{ url('permanent_address_bn?id=' . $user->id) }}"
                                                   title="স্থায়ী ঠিকানা ( বাংলাতে )">
                                                    স্থায়ী ঠিকানা ( বাংলা )
                                                </a>
                                            </li> --}}
                                            <li>
                                                <a target="_blank" href="{{ url('profile_edit?id=' . $user->id) }}" title="প্রোফাইল হালনাগাদ ">প্রোফাইল</a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('warish?id=' . $user->id) }}"
                                                   title="ওয়ারিশ সংযুক্ত করুন">
                                                   ওয়ারিশ
                                                </a>
                                            </li>
                                            <li>
                                                <a target="_blank" href="{{ url('business?id=' . $user->id) }}"
                                                   title="ব্যবসা সংযুক্ত করুন">
                                                   ব্যাবসা
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn btn-danger btn-xs" type="button"
                                           href="{{ url('delete_profile/' . $user->id) }}"
                                           onclick="return confirm(' আপনি  কি  সত্যি  প্রোফাইল  মুছে  ফেলতে  চাচ্ছেন?  ')">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <button class="dropbtn">
                                            <i class="fa fa-download"></i>
                                            ডাউনলোড
                                            <i class="fa fa-caret-down"></i>
                                        </button>
                                        <div class="dropdown-content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="well">
                                                        আপনি নিচের আইকনে ক্লিক করে আপনার প্রয়োজনীয় ফাইল ডাউনলোড করে
                                                        নিতে পারবেন।
                                                        বুঝতে সম্যসা হলে নিচে থাকা মোবাইল নম্বরে যোগাযোগ করতে পারেন।
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row custom_icons">

                                                <?php
                                                $services = \App\Service::where('is_active', 1)->orderBy('position', 'asc')->get();
                                                $payment_by_user = \App\Payment::where('user_id', $user->id)->orderBy('id', 'desc')->get()->first();
                                                //dd($payment_by_user);
                                                if (!empty($payment_by_user) && $payment_by_user->which_time) {
                                                    $which_time = $payment_by_user->which_time;
                                                } else {
                                                    $which_time = null;
                                                }
                                                ?>


                                                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                                    <div class="man-service_one">
                                                        <div class="lang_enbn">
                                                            <a class="btn btn-xs Bn_lang" target="_blank"
                                                               href="{{ url('profile_pdf?uid=' . $user->id . '&ps=' . $which_time)  }}"
                                                               target="_blank">
                                                                বাংলা
                                                            </a>

                                                            <a class="btn btn-xs En_lang"
                                                               href="{{ url('profile_pdf?uid=' . $user->id . '&ps=' . $which_time) }}">
                                                                EN
                                                            </a>
                                                        </div>
                                                        <a target="_blank"
                                                           href="{{ url('profile_pdf?uid=' . $user->id . '&ps=' . $which_time) }}"
                                                           target="_blank">
                                                            <img src="{{ url('public/icons/profile.png') }}">
                                                        </a>
                                                        <a target="_blank"
                                                           href="{{ url('profile_pdf?uid=' . $user->id . '&ps=' . $which_time) }}">
                                                            <h1>
                                                                প্রোফাইল
                                                            </h1>
                                                        </a>
                                                    </div>
                                                </div>

                                                @foreach($services as $service)
                                                @if(($service->id == 7 && $user->landless != 1) || ($service->id == 9 && $user->rivercorrosion != 1))
                                                @else
                                                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                                        <div class="man-service_one">
                                                            <div class="lang_enbn">
                                                                <a target="_blank" class="Bn_lang"
                                                                   href="{{ url( 'download_pdf?uid=' . $user->id . '&sid=' . $service->id . '&ps=' . $which_time) }}"
                                                                   target="_blank">
                                                                    বাংলা
                                                                </a>
                                                                @if($service->route_en == 'en')
                                                                    <?php
                                                                    //$english_route = url($service->route . '?lang=' . $service->route_en . '&uid=' . $user->id . '&sid=' . $service->id . '&ps=' . $which_time);
                                                                    $english_route = url('download_pdf?lang=' . $service->route_en . '&uid=' . $user->id . '&sid=' . $service->id . '&ps=' . $which_time);

                                                                    ?>
                                                                @endif
                                                                <a target="_blank" class="En_lang"
                                                                   href="{{ $english_route  }}">
                                                                    EN
                                                                </a>
                                                            </div>
                                                            <a target="_blank"
                                                               href="{{ url( $service->route .'?uid=' . $user->id . '&sid=' . $service->id . '&ps=' . $which_time) }}"
                                                               target="_blank">
                                                                <img src="{{ $service->icon }}">
                                                            </a>
                                                            <a target="_blank"
                                                               href="{{ url( $service->route .'?&uid=' . $user->id . '&sid=' . $service->id . '&ps=' . $which_time) }}"
                                                               target="_blank">
                                                                <h1>
                                                                    {{ $service->name }}
                                                                </h1>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endforeach

                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr>


                        @endforeach
                        </tbody>
                    </table>
                    <div class="box-footer clearfix">
                        {{ $mine_users->links('component.paginator', ['object' => $mine_users]) }}
                    </div>

                </div>
            </div>
        @endif
    </div>
@endsection
@section('cusjs')
    <style type="text/css">
        .custom_icons img {
            width: 40px !important;
            height: 40px !important;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #FFFFFF;
            min-width: 1000px;
            box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 1);
            z-index: 99999;
            right: 0;
            padding: 10px;
            border: 1px solid #DDDDDD;
        }
    </style>

    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $.noConflict();
        });

        function flip(id) {
            jQuery(".panel_" + id).toggle();
        }
    </script>
@endsection
