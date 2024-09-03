@extends('frontend.layouts.app')
@section('content')

<div class="container user_panel">


    @if (Route::has('login'))
    <?php
    $service = \App\TextAssetRule::where(['is_active' => 1])->get();

    $rowNumber = 1;

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
                    নতুন সম্পদ যোগ করুন
                    <a href="{{ url('apply_tax_pdf') }}" class="btn btn-sm btn-danger pull-right" style="margin: 0 10px;"> বাতিল</a>
                </div>
                {{ Form::open(array('url' => '/save_asset_tax', 'method' => 'post', 'value' => 'PATCH', 'id' =>
                    'pay_now')) }}
                <div class="panel-body">

                    @include('frontend.common.message_handler')

                    <div class="row">
                        <div class="col-xs-12 col-lg-6 col-md-6 col-sm-12">

                            <div class="form-group">
                                {{ Form::label('asset_name', 'সম্পদের নাম : ', array('class' => 'asset_name')) }}
                                {{ Form::text('asset_name', (!empty($fdata->asset_name) ? $fdata->asset_name : NULL), ['required', 'class' => 'form-control', 'id' => 'asset_name', 'placeholder' => 'সম্পদের নাম...']) }}
                                {{ Form::hidden('user_id', $data['user_id'], ['required']) }}
                                {{ Form::hidden('dc_id', $data['dc_id'], ['required']) }}
                                {{ Form::hidden('id', (!empty($fdata->id) ? $fdata->id : NULL), []) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('asset_address', 'ঠিকানা: ', array('class' => 'asset_address')) }}
                                {{ Form::text('asset_address', (!empty($fdata->asset_address) ? $fdata->asset_address : NULL), ['required', 'class' => 'form-control', 'id' => 'asset_address', 'placeholder' => 'ঠিকানা']) }}

                            </div>




                            <div class="form-group">
                                {{ Form::label('asset_description', 'বিবরণ: ', array('class' => 'asset_description')) }}
                                {{ Form::textarea('asset_description', (!empty($fdata->asset_description) ? $fdata->asset_description : NULL), [ 'rows' => 3, 'required', 'class' => 'form-control', 'id' => 'asset_description', 'placeholder' => 'বিবরণ...']) }}


                            </div>


                        </div>

                        <div class="col-xs-12 col-lg-6 col-md-6 col-sm-12">



                            <div class="form-group">
                                <label for="sub_trad_licence"></label>
                                {{ Form::label('kind_of_asset', 'সম্পদের ধরণ :', array('class' => 'kind_of_asset')) }}
                                <select id="kind_of_asset" class="form-control" name="kind_of_asset" required>
                                    @foreach ($service as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group required {{ ($errors->has('type_plot'))? 'has-error' : '' }}">
                                {{ Form::label('type_plot', ' সম্পদের প্রকার ?  ', array('class' => 'type_plot cmmone-class')) }}
                                {{ Form::select('type_plot',['Residential' => 'আবাসিক', 'Commercial' => 'বাণিজ্যিক'], (!empty($fdata->type_plot) ? $fdata->type_plot : NULL), ['class' => 'form-control', 'placeholder' => '  --বাছাই করুন-- ']) }}

                                @if($errors->has('type_plot'))
                                <span class="help-block">{{ $errors->first('type_plot') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="how_much_floor" class="how_much_floor">কত তলা : </label>
                                {{ Form::number('how_much_floor', (!empty($fdata->how_much_floor) ? $fdata->how_much_floor : NULL), [ 'class' => 'form-control', 'id' => 'how_much_floor', 'placeholder' => 'কত তলা...']) }}

                            </div>




                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th title="ইউনিট নং">ইউনিট নং</th>
                                <th scope="col">ইউনিটের প্রকার</th>
                                <th scope="col">আয়তন <small>(বর্গফুট)</small></th>
                                <th scope="col">কার্যকলাপ</th>

                            </tr>
                        </thead>
                        <tbody id="appendRow">

                            @if(!empty($fdata->child))
                            @foreach($fdata->child as $key => $child)

                            @php
                            $rowNumber = $rowNumber + 1;

                            @endphp

                            <tr id="row-{{$rowNumber}}">
                                <th scope="row">#</th>
                                <td>

                                    {{ Form::text('asset[1][titel]', (!empty($child->titel) ? $child->titel : NULL), ['class' => 'form-control', 'id' => '', 'placeholder' => 'ইউনিট নং...']) }}

                                </td>
                                <td>
                                    {{ Form::select('asset[1][types]',['Rent' => 'ভাড়া', 'Own' => 'নিজস্ব'], (!empty($child->unit_type) ? $child->unit_type : NULL), ['class' => 'form-control']) }}

                                </td>
                                <td>

                                    {{ Form::text('asset[1][aria]', (!empty($child->unit_aria) ? $child->unit_aria : NULL), ['class' => 'form-control', 'id' => '', 'placeholder' => 'আয়তন']) }}


                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm removeRow" style="margin-top: 7px;" type="button" data-id="1">
                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                    </button>
                                </td>

                            </tr>
                            @endforeach

                            @else

                            <tr id="row-1">
                                <th scope="row">#</th>
                                <td><input required class="form-control" placeholder="ইউনিট নং..." name="asset[1][titel]" type="text"></td>
                                <td>
                                    <select class="form-control" name="asset[1][types]">
                                        <option value="Rent">ভাড়া</option>
                                        <option value="Own">নিজস্ব</option>
                                    </select>
                                </td>
                                <td><input required class="form-control" placeholder="আয়তন" name="asset[1][aria]" type="number"></td>
                                <td>
                                    <button class="btn btn-danger btn-sm removeRow" style="margin-top: 7px;" type="button" data-id="1">
                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                    </button>
                                </td>

                            </tr>

                            @endif

                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="5" style="text-align: center;">
                                    <button class="btn btn-info btn-sm" style="margin-top: 7px;" onclick="append_row();" type="button">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Add More
                                    </button>
                                </td>

                            </tr>
                        </tfoot>
                    </table>

                    <div class="form-group">
                        {{ Form::submit(' জমা দিন ', ['class' => 'btn btn-success', 'name' => 'submit']) }}
                    </div>

                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

    @endif
</div>
@endsection

@section('cusjs')
<script>
    var count = "{{$rowNumber + 1}}";
    count = Number(count);
    jQuery(document).ready(function($) {



        // master_function();

        $(document).on('click', '.removeRow', function(e) {
            var id = $(this).data('id');

            $('#row-' + id).remove();

        });




    });

    function append_row() {
        var $ = jQuery;
        var rows = '<tr id="row-' + count + '">' +
            '<th>#</th>' +
            '<td><input required class="form-control" placeholder="ইউনিট নং..." name="asset[' + count + '][titel]" type="text"></td>' +
            '<td><select class="form-control" name="asset[' + count + '][types]">' +
            '<option value="Rent">ভাড়া</option>' +
            '<option value="Own">নিজস্ব</option>' +
            '</select></td>' +
            '<td><input required class="form-control" placeholder="আয়তন" name="asset[' + count + '][aria]" type="number"></td>' +
            '<td><button class="btn btn-danger btn-sm removeRow"  type="button" data-id="' + count + '" style="margin-top: 7px;"><i class="fa fa-minus" aria-hidden="true"></i></button></td>' +
            '</tr>';
        $('#appendRow').append(rows);
        count = count + 1;

    }
</script>
@endsection