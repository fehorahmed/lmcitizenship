@extends('frontend.layouts.app')
@section('content')

<div class="container user_panel">


    @if (Route::has('login'))
    <?php
    new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $service = \App\TextAssetRule::where(['is_active' => 1])->get();



    if (auth()->user()->isDigitalCenter()) {
        $dc_id = auth()->user()->id;
        $user_id = auth()->user()->id;
    } else {
        $dc_id = null;
        $user_id = auth()->user()->id;
    }

    $is_priviuse_due = false;
    $is_payable_session = false;

    $this_y = date('Y');
    $this_date = date('Y-m-d');
    $this_start = $this_y . '-' . $asset_rul->renew_session_start;

    if ($this_date > $this_start) {
        $session_start = $this_date;
        $session_end = ($this_y + 1) . '-' . $asset_rul->renew_session_end;
    } else {
        $session_start = ($this_y - 1) . '-' . $asset_rul->renew_session_start;
        $session_end = ($this_y) . '-' . $asset_rul->renew_session_end;
    }

    dump($asset_rul);
    dump($session_start);
    dump($session_end);

    if ($asset->next_payment > $session_end) {
        $is_payable_session = true;
    } else {
        if ($asset->last_payment) {
            $is_priviuse_due = true;

            $next_payment = date_create($asset->next_payment);
            $today = date_create(date('Y-m-d'));
            $diff = date_diff($next_payment, $today);

            $due_m = $diff->m;
            $pay_m = year_part($asset_rul->renew_method);



            dump($is_payable_session);
            dump($asset_rul);
        } else {
            $is_priviuse_due = true;

            $next_payment = date_create($asset->approve_date);
            $today = date_create(date('Y-m-d'));
            $diff = date_diff($next_payment, $today);

            $due_m = $diff->m;
            $pay_m = year_part($asset_rul->renew_method);


            dump($next_payment);
            dump($today);
            dump($due_m);
            dump($pay_m);
        }
    }









    ?>
    <div class="row up_bottom" style="margin-top: 20px;">
        <div class="col-md-12">
            <div class="panel panel-default commone-hean">
                <div class="panel-heading">
                    ট্যাক্স পরিশোধ
                </div>

                @if($is_payable_session)

                <div class="panel-body">

                    <h2 class="text-center text-success">আপনি এই বছরের সকল ট্যাক্স প্রদান করেছেন। </h2>

                </div>
                @else
                {{ Form::open(array('url' => '/save_asset_tax', 'method' => 'post', 'value' => 'PATCH', 'id' =>
                            'pay_now')) }}



                <div class="panel-body">

                    @include('frontend.common.message_handler')

                    <div class="row">
                        <div class="col-xs-12 col-lg-6 col-md-6 col-sm-12">
                            Previus Due: <br>
                            Current: <br>
                            Advance: <br>


                        </div>

                    </div>

                    <div class="form-group">
                        {{ Form::submit(' প্রদান করুন ', ['class' => 'btn btn-success', 'name' => 'submit']) }}
                    </div>

                </div>
                {{ Form::close() }}




                @endif

            </div>
        </div>
    </div>


    @endif
</div>
@endsection

@section('cusjs')
<script>
    $(document).ready(function() {

        master_function();

        $(document).on('change', '#kind_of_asset', function(e) {
            master_function();
        });


        function master_function() {
            var kind_of_asset = $('#kind_of_asset').val();

            var id = kind_of_asset;
            $.ajax({
                url: baseurl + '/get_tat_more_ajax',
                method: 'get',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#jeson_data_floor_unit').html(data);
                    //console.log(data);
                },
                error: function() {}
            });


        }

    });
</script>
@endsection