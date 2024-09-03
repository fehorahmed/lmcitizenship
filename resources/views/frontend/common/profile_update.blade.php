@extends('frontend.layouts.app')

@section('content')
    @include('frontend.common.slider')
    @include('frontend.common.marquee')

    @if (Route::has('login'))
        <section class="prosuct-view-section">

            @include('frontend.common.frontend_user_menu')

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="about-text">

                            <div class="row">
                                @include('frontend.common.message_handler')

                                <?php
                                $user = Auth::user();
                                if (!empty($user)) {
                                    $name = $user->name;
                                    $phone = $user->phone;
                                    $e_phone = $user->emergency_phone;
                                    $email = $user->email;
                                    $address = $user->address;
                                    $username = $user->username;
                                    $password = '';
                                } else {
                                    $name = '';
                                    $phone = '';
                                    $e_phone = '';
                                    $email = '';
                                    $address = '';
                                    $username = '';
                                    $password = '';
                                }
                                ?>

                                {{ Form::open(array('url' => '/checkout/delivery_address', 'method' => 'post', 'value' => 'PATCH', 'id' => 'delivery_address')) }}

                                <div class="col-md-6">
                                    {{csrf_field()}}
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
                                                {{ Form::text('username', !empty($username) ? $username : '', ['id' => 'username', 'class' => 'form-control', 'placeholder' => 'Username ']) }}
                                            </div>
                                            <div class="form-group">
                                                {{ Form::label('password', 'Password', array('class' => 'title')) }}
                                                {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', $required]) }}
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-two" type="submit">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                            {{ Form::close() }}

                        </div>
                    </div>
                </div>
                <br/><br/>
            </div>
            </div>
        </section>
    @endif
@endsection