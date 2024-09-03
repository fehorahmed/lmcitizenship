@extends('frontend.layouts.app')
@section('content')

<div class="container user_panel">


    @if (Route::has('login'))
    <?php
    $service = \App\TextAssetRule::where(['is_active' => 1])->get();

    if (auth()->user()->isDigitalCenter()) {
        $dc_id = auth()->user()->id;
        $user_id = auth()->user()->id;
    } else {
        $dc_id = null;
        $user_id = auth()->user()->id;
    }


    //dd($tax_assets);
    ?>



    <div class="row up_bottom" style="margin-top: 20px;">
        <div class="col-md-12">
            <div class="panel panel-default commone-hean">
                <div class="panel-heading">
                    সম্পদ এর বিবরণ:

                    <button class="btn btn-sm btn-success pull-right" data-target="#myModal" data-toggle="modal">ট্যাক্স পরিশোধ</button>
                    <a href="{{ url('apply_tax_add') }}" class="btn btn-sm btn-info pull-right" style="margin: 0 10px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> সম্পদ </a>
                </div>

                @if(!empty($tax_assets))
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            {{ Form::open(array('url' => '/tax_payments', 'method' => 'get', 'value' => 'PATCH', 'id' =>  'pay_now')) }}
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            </div>
                            <div class="modal-body">


                                @php
                                $user_id = $tax_assets[0]->user_id;
                                $all_asset = App\TaxAsset::where(['user_id' =>$user_id, 'is_approve' => 1, 'is_active' => 1 ])->get();

                                @endphp

                                {{ Form::hidden('user_id', $data['user_id'], ['required']) }}
                                {{ Form::hidden('dc_id', $data['dc_id'], ['required']) }}

                                <div class="form-group">
                                    <label for="sub_trad_licence"></label>
                                    {{ Form::label('kind_of_asset', 'সম্পদের ধরণ :', array('class' => 'kind_of_asset')) }}
                                    <select id="kind_of_asset" class="form-control" name="kind_of_asset" required>
                                        @foreach ($all_asset as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->asset_name }}</small>
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">

                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                {{ Form::submit(' প্রদান করুন ', ['class' => 'btn btn-success']) }}
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>

                @endif
                <div class="panel-body">
                    <table class="table table-striped table-bordered styled-table_o">
                        <tr>
                            <th>সম্পদের নাম</th>
                            <th>সম্পদের ধরণ</th>
                            <th>ঠিকানা</th>
                            <th>মোট আয়তন</th>
                            <th>নবায়ন শেষ</th>
                            <th>ট্যাক্স</th>
                            <th>কার্যকলাপ</th>
                        </tr>
                        @if(!empty($tax_assets))
                        <tbody>
                            @foreach($tax_assets as $data)

                            @php
                            $asset_rule = App\TextAssetRule::where(['id' => $data->kind_of_asset])->get()->first();
                            //dump($data);

                            $how_much_floor = ($data->how_much_floor)? $data->how_much_floor: 1;
                            $how_much_unit = ($data->how_much_unit)? $data->how_much_unit: 1;
                            $is_approve = ($data->is_approve == 'Yes')? '<b style="color:green">অনুমোদিত</b>': '<b style="color:red">মুলতুবী</b>';
                            if($data->last_payment){

                            $tax_status = '<b style="color:green">পরিশোধিত</b>';

                            }else{
                            $tax_status = '<b style="color:red">অপরিশোধিত</b>';
                            }

                            $total_aria = $data->residential_won_size + $data->residential_rent_size + $data->commercial_won_size + $data->commercial_rent_size;


                            @endphp
                            <tr>
                                <td>{{ $data->asset_name }}</td>
                                <td>{{ $asset_rule->name }}</td>
                                <td>{{ $data->asset_address }}</td>
                                <td>
                                    {{ $total_aria }} ({{ $asset_rule->unit }})
                                </td>
                                <td>
                                    {{ $data->next_payment }}
                                </td>
                                <td>
                                    {!! $tax_status !!}
                                </td>
                                <td>
                                    {!! $is_approve !!}
                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                        @endif
                    </table>

                </div>

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
            var $ = jQuery;
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