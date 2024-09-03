@extends('frontend.layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="breadcrumb-warp section-margin-two">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <?php
                        $breadcrumbs = new Creitive\Breadcrumbs\Breadcrumbs;

                        $breadcrumbs->setDivider(' » &nbsp;');
                        $breadcrumbs->addCrumb('Home', url('/'))
                            ->addCrumb('Delivery Address', 'product');
                        echo $breadcrumbs->render();
                        ?>
                    </div>
                    <!-- breadcrumb  end-->
                </div>
            </div>
        </div>
    </div>
    <?php $tksign = '&#2547; '; ?>
    <!--breadcrumb-area end  -->
    <!--prosuct-view-section  -->
    <section class="prosuct-view-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(Session::has('cart'))
                        <section>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="about-text">
                                            <h2 class="carddlist-title">
                                                <i class="fa fa-map-marker"></i> Delivery Address
                                            </h2>
                                            <p class="delivery-text">
                                                To add a new delivery address, please fill out the form below.
                                            </p>

                                            @include('frontend.common.message_handler')

                                            <?php
                                            $user = Auth::user();
                                            $data = Session::all();

                                            if ($user == null) {
                                                if (!empty($data['user_details'])) {
                                                    //dd($data['user_details']);
                                                    $id = $data['user_details']['user_id'][0];
                                                    $name = $data['user_details']['name'];
                                                    $phone = $data['user_details']['phone'];
                                                    $e_phone = $data['user_details']['emergency_phone'];
                                                    $email = $data['user_details']['email'];
                                                    $address = $data['user_details']['address'];
                                                    $username = $data['user_details']['username'];
                                                    $password = '';
                                                } else {
                                                    $id = '';
                                                    $name = '';
                                                    $phone = '';
                                                    $e_phone = '';
                                                    $email = '';
                                                    $address = '';
                                                    $username = '';
                                                    $password = '';
                                                }
                                            } else {
                                                $id = $user->id;
                                                $name = $user->name;
                                                $phone = $user->phone;
                                                $e_phone = $user->emergency_phone;
                                                $email = $user->email;
                                                $address = $user->address;
                                                $username = $user->username;
                                                $password = '';
                                            }
                                            ?>

                                            {{ Form::open(array('url' => '/checkout/delivery_address', 'method' => 'post', 'value' => 'PATCH', 'autocomplete' => 'off', 'id' => 'delivery_address')) }}
                                            <div class="row">

                                                <div class="col-md-6">
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        {{ Form::hidden('id', $id) }}
                                                    </div>
                                                    <div class="form-group">
                                                        {{ Form::label('name', 'Full Name', array('class' => 'title')) }}
                                                        {{ Form::text('name', $name, ['required', 'class' => 'form-control', 'placeholder' => 'Full Name']) }}
                                                    </div>
                                                    <div class="form-group">
                                                        {{ Form::label('phone', 'Mobile Number', array('class' => 'title')) }}
                                                        {{ Form::text('phone', $phone, ['required', 'class' => 'form-control', 'placeholder' => 'Mobile Number']) }}
                                                    </div>
                                                    <div class="form-group">
                                                        {{ Form::label('emergency_phone', 'Emergency Mobile Number', array('class' => 'title')) }}
                                                        {{ Form::text('emergency_phone', $e_phone, ['required', 'class' => 'form-control', 'placeholder' => 'Emergency Mobile Number']) }}
                                                    </div>
                                                    <div class="form-group">
                                                        {{ Form::label('email', 'Email', array('class' => 'title')) }}
                                                        {{ Form::email('email', $email, ['required', 'class' => 'form-control', 'placeholder' => 'Email ']) }}
                                                        <div class="show_message"></div>
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::label('districts', 'Choose your districts', array('class' => 'title')) }}
                                                        <?php
                                                        $districts = get_districts();
                                                        //dd($districts);
                                                        ?>

                                                        <select name="district" class="form-control" id="district"
                                                                required="required">
                                                            <option value="">Choose your district</option>
                                                            @foreach($districts as $dist)
                                                                <option value="{{ $dist->district }}"
                                                                        id="{{ $dist->district }}">
                                                                    {{ $dist->district }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        {{ Form::hidden('deliveryfee', null, ['required', 'id' => 'deliveryfee']) }}
                                                    </div>
                                                    <div class="form-group">
                                                        {{ Form::label('address', 'Address', array('class' => 'title')) }}
                                                        {{ Form::textarea('address', $address, ['required', 'class' => 'form-control', 'placeholder' => 'Address', 'rows' => 3]) }}
                                                    </div>

                                                    <div class="form-group password-group">
                                                        <?php if (!Auth::check()) { ?>
                                                        <?php
                                                        $checked = (!empty($username) ? ' checked ' : null);
                                                        $required = (!empty($username) ? ' required ' : null);
                                                        ?>
                                                        {!! Form::checkbox('create-account', TRUE, FALSE, ['class' => 'square', 'id' => 'create-account', $checked]) !!}
                                                        {!! Form::label('permissions', 'Create my user account') !!}

                                                        <div class="passfield"
                                                             style="display: {!! (!empty($username) ? ' block ' : 'none') !!};">
                                                            <div class="form-group">
                                                                {{ Form::label('username', 'Username', array('class' => 'title')) }}
                                                                {{ Form::text('username', !empty($username) ? $username : '', ['id' => 'username', 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Username ']) }}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('password', 'Password', array('class' => 'title')) }}
                                                                {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'autocomplete' => 'off', $required]) }}
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-box">
                                                        <a class="btn pull-left btn-one colorwhite"
                                                           href="{{ url()->previous() }}">
                                                            <i class="fa fa-arrow-left"></i>
                                                            Back
                                                        </a>

                                                        <button class="btn pull-right btn-two" type="submit">
                                                            Next <i class="fa fa-arrow-right"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                        </section>
                    @else
                        <h3>Opps... You have not added any product on your cart yet.</h3>
                    @endif
                </div>
            </div>
            <br>
            <br>
            <?php
            //            $data = Session::all();
            //            if (!empty($data['cart'])) {
            //                dump($data['cart']);
            //            }
            //            if (!empty($data['user_details'])) {
            //                dump($data['user_details']);
            //            }
            //
            //            if (!empty($data['payment_method'])) {
            //                dump($data['payment_method']);
            //            }
            ?>
        </div>
    </section>
@endsection
@section('cusjs')
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $.noConflict();

            $(function () {
                $('#create-account').on('click', function () {
                    if ($(this).is(":checked")) {
                        $("#username").attr("autocomplete", "off");
                        $("#password").attr("autocomplete", "off");

                        $('.passfield').css('display', 'block');
                        $('#password').attr('required', 'required');
                        $('#username').attr('required', 'required');
                    } else {
                        $("#username").attr("autocomplete", "off");
                        $("#password").attr("autocomplete", "off");

                        $('.passfield').css('display', 'none');
                        $('#password').removeAttr('required', 'required');
                        $('#username').removeAttr('required', 'required');
                    }
                });
            });

            $('#email').on('keyup', function () {
                delay(function () {
                    var data = {
                        'email': $(this).val()
                    };

                    $.ajax({
                        url: baseurl + '/check_if_email_exists',
                        method: 'get',
                        data: data,
                        success: function (data) {
                            $('.show_message').html(data);
                        },
                        error: function () {
                            // showError('Sorry. Try reload this page and try again.');
                            // processing.hide();
                        }
                    });
                }, 1000);

            });

            $('#district').on('change', function () {
                var dist = $(this).val();

                if (dist == 'Dhaka') {
                    var fee = '<?php echo get_delivery_fee(true); ?>';
                    $('#deliveryfee').val(fee);
                } else {
                    var fee = '<?php echo get_delivery_fee(false); ?>';
                    $('#deliveryfee').val(fee);
                }
            });

        });

        var delay = (function () {
            var timer = 0;
            return function (callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();
    </script>
    <style type="text/css">
        .password-group label {
            color: #666666;
            font-weight: 500;
        }
    </style>
@endsection