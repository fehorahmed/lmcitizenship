@extends('frontend.layouts.app')

@section('content')
    @include('frontend.common.slider')
    @include('frontend.common.marquee')

    <div class="container user_panel">
            @include('frontend.common.frontend_user_menu')

        @if (Route::has('login'))
            <?php $user = Auth::user(); ?>
            <div class="row up_bottom">
                <div class="col-md-3">

                    @include('frontend.common.user_panel_sidebar')

                </div>
                <div class="col-md-9">
                    <div class="panel panel-danger">
                        <div class="panel-heading"> নিয়মাবলী</div>
                        <div class="panel-body">
                            ১। বাংলায় সার্টিফিকেট পেতে শুধুমাত্র বাংলায় ঘর গুলো পূরন করুন <br/>
                            ২। ইংরেজি সার্টিফিকেট পেতে বাংলা এবং ইংরেজি উভয় ঘর পূরন করুন
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading"> প্রোফাইল কতটা শেষ হয়েছে যাচাই করুন</div>
                        <div class="panel-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    সাধারণ তথ্যাদি ( ইংরেজিতে )
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionDefault" name="someSwitchOption001" type="checkbox"
                                               checked="true"/>
                                        <label for="someSwitchOptionDefault" class="label-success"></label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    সাধারণ তথ্যাদি ( বাংলাতে )
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionPrimary" name="someSwitchOption001" type="checkbox"
                                               checked="true"/>
                                        <label for="someSwitchOptionPrimary" class="label-success"></label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    বর্তমান ঠিকানা ( ইংরেজিতে )
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionSuccess" name="someSwitchOption001" type="checkbox"
                                               checked="true"/>
                                        <label for="someSwitchOptionSuccess" class="label-success"></label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    বর্তমান ঠিকানা ( বাংলাতে )
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionInfo" name="someSwitchOption001" type="checkbox"/>
                                        <label for="someSwitchOptionInfo" class="label-info"></label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    স্থায়ী ঠিকানা ( ইংরেজিতে )
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionWarning" name="someSwitchOption001" type="checkbox"/>
                                        <label for="someSwitchOptionWarning" class="label-warning"></label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    স্থায়ী ঠিকানা ( বাংলাতে )
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionDanger" name="someSwitchOption001" type="checkbox"/>
                                        <label for="someSwitchOptionDanger" class="label-danger"></label>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="panel-footer">
                            প্রোফাইল হালনাগাদের উপর নির্ভর করছে আপনি কোন কোন তথ্যাদির জন্য আবেদন করতে পারবেন। তাই, সঠিক
                            তথ্য দিয়ে প্রোফাইল ব্যবস্থাপনায় থাকা ফর্ম গুলো হালনাগাদ করুন ।
                        </div>

                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading"> আবেদনের তালিকা ও তার ফলাফল</div>
                        <div class="panel-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    নাগরিক সনদের আবেদন
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionDefault" name="someSwitchOption001" type="checkbox"
                                               checked="true"/>
                                        <label for="someSwitchOptionDefault" class="label-success"></label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    ট্রেড লাইসেন্স সনদের আবেদন
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionPrimary" name="someSwitchOption001" type="checkbox"
                                               checked="true"/>
                                        <label for="someSwitchOptionPrimary" class="label-success"></label>
                                    </div>
                                </li>


                                <li class="list-group-item">
                                    ওয়ারিশ সনদের আবেদন
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionPrimary" name="someSwitchOption001" type="checkbox"
                                               checked="true"/>
                                        <label for="someSwitchOptionPrimary" class="label-success"></label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    মৃত্যু সনদের আবেদন
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionPrimary" name="someSwitchOption001" type="checkbox"
                                               checked="true"/>
                                        <label for="someSwitchOptionPrimary" class="label-success"></label>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    চারিত্রিক সনদের আবেদন
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionPrimary" name="someSwitchOption001" type="checkbox"
                                               checked="true"/>
                                        <label for="someSwitchOptionPrimary" class="label-success"></label>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    ভূমিহীন সনদের আবেদন
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionPrimary" name="someSwitchOption001" type="checkbox"
                                               checked="true"/>
                                        <label for="someSwitchOptionPrimary" class="label-success"></label>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    পারিবারিক সনদের আবেদন
                                    <div class="material-switch pull-right">
                                        <input id="someSwitchOptionPrimary" name="someSwitchOption001" type="checkbox"
                                               checked="true"/>
                                        <label for="someSwitchOptionPrimary" class="label-success"></label>
                                    </div>
                                </li>
                                
                            </ul>
                        </div>

                        <div class="panel-footer">
                            প্রোফাইল হালনাগাদের উপর নির্ভর করছে আপনি কোন কোন তথ্যাদির জন্য আবেদন করতে পারবেন। তাই, সঠিক
                            তথ্য দিয়ে প্রোফাইল ব্যবস্থাপনায় থাকা ফর্ম গুলো হালনাগাদ করুন ।
                        </div>

                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection

@section('cusjs')
    <style type="text/css">
        .material-switch > input[type="checkbox"] {
            display: none;
        }

        .material-switch > label {
            cursor: pointer;
            height: 0px;
            position: relative;
            width: 40px;
        }

        .material-switch > label::before {
            background: rgb(0, 0, 0);
            box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            content: '';
            height: 16px;
            margin-top: -8px;
            position: absolute;
            opacity: 0.3;
            transition: all 0.4s ease-in-out;
            width: 40px;
        }

        .material-switch > label::after {
            background: rgb(255, 255, 255);
            border-radius: 16px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
            content: '';
            height: 24px;
            left: -4px;
            margin-top: -8px;
            position: absolute;
            top: -4px;
            transition: all 0.3s ease-in-out;
            width: 24px;
        }

        .material-switch > input[type="checkbox"]:checked + label::before {
            background: inherit;
            opacity: 0.5;
        }

        .material-switch > input[type="checkbox"]:checked + label::after {
            background: inherit;
            left: 20px;
        }
    </style>
@endsection