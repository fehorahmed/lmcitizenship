

<div class="modal fade" id="apply_for_shop{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{Form::open(array('url' => 'shop_online_allocation', 'method' => 'post'))}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    {{ e_to_b($data->shop_number) }} {{ ($data->shop_floor)? ' ('.e_to_b($data->shop_floor). ' তলায়)' : ''}} নং দোকানের জন্য আবেদন <br>
                    <small>মার্কেটের নামঃ {{$market->market_name}}</small>
                </h4>
            </div>
            <div class="modal-body">
                @php

                  //  owndebugger($data);
                @endphp
                <div class="form-group">
                    {{ Form::label('shop_witch_type', 'যে ধরনের ব্যবসার জন্য বরাদ্দ নিয়ে ইচ্ছুক', array('class' => 'shop_ownner')) }}
                    {{ Form::textarea('shop_witch_type', NULL, ['id' => null, 'rows' => 2, 'class' => 'form-control shop_ownner', 'placeholder' => 'যে ধরনের ব্যবসার জন্য বরাদ্দ নিয়ে ইচ্ছুক...']) }}

                    {{ Form::hidden('aplication_user', (!empty($user['user_id']) ? $user['user_id'] : NULL), ['required']) }}
                    {{ Form::hidden('aplication_dc', (!empty($user['dc_id']) ? $user['dc_id'] : NULL), null) }}
                    {{ Form::hidden('shop_id', (!empty($data->id) ? $data->id : NULL), ['required']) }}
                    {{ Form::hidden('as_id', (!empty($fshop->id) ? $fshop->id : NULL), ['required']) }}

                </div>


                <div class="form-group">
                    {{ Form::label('shop_salami', 'সেলামীর অর্থ বাবদ', array('class' => 'total_volume')) }}
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">টাকার পরিমাণ</div>
                        </div>
                        {{ Form::number('shop_salami[amount]', $data->shop_next_salami, ['required', 'class' => 'form-control', 'placeholder' => 'টাকার পরিমাণ..', 'readonly']) }}

                        <div class="input-group-addon">
                            <div class="input-group-text">টাকা</div>
                        </div>
                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">পে অর্ডার / ব্যাংক ড্রাফট নং  </div>
                        </div>
                        {{ Form::number('shop_salami[payorder]', NULL, ['required', 'class' => 'form-control', 'placeholder' => 'পে অর্ডার / ব্যাংক ড্রাফট নং..']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">তারিখ </div>
                        </div>
                        {{ Form::text('shop_salami[date]', NULL, ['required', 'class' => 'form-control date-pick', 'placeholder' => 'তারিখ..']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">ব্যাংকের নাম </div>
                        </div>
                        {{ Form::text('shop_salami[bank]',  NULL, ['required', 'class' => 'form-control', 'placeholder' => 'ব্যাংকের নাম..']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">শাখা </div>
                        </div>
                        {{ Form::text('shop_salami[branch]', NULL, ['required', 'class' => 'form-control', 'placeholder' => 'শাখা..']) }}


                    </div>

                </div>

                <div class="form-group">
                    {{ Form::label('shop_vat', 'সভ্যাটের পরিমাণ (৯ % হরে)', array('class' => 'total_volume')) }}
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">টাকার পরিমাণ</div>
                        </div>
                        {{ Form::number('shop_vat[amount]', (!empty($data->shop_next_vat) ? ($data->shop_next_vat * $data->shop_next_salami) /100  : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'টাকার পরিমাণ..',  'readonly']) }}

                        <div class="input-group-addon">
                            <div class="input-group-text">টাকা</div>
                        </div>
                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">পে অর্ডার / ব্যাংক ড্রাফট নং  </div>
                        </div>
                        {{ Form::number('shop_vat[payorder]', null, ['required', 'class' => 'form-control', 'placeholder' => 'পে অর্ডার / ব্যাংক ড্রাফট নং ..']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">তারিখ </div>
                        </div>
                        {{ Form::text('shop_vat[date]', null, ['required', 'class' => 'form-control date-pick', 'placeholder' => 'তারিখ..']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">ব্যাংকের নাম </div>
                        </div>
                        {{ Form::text('shop_vat[bank]', null, ['required', 'class' => 'form-control', 'placeholder' => 'ব্যাংকের নাম ..']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">শাখা </div>
                        </div>
                        {{ Form::text('shop_vat[branch]', null, ['required', 'class' => 'form-control', 'placeholder' => 'শাখা..']) }}


                    </div>

                </div>

                <div class="form-group">
                    {{ Form::label('shop_tax', 'আয়করে পরিমাণ (৯ % হরে)', array('class' => 'total_volume')) }}

                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">টাকার পরিমাণ</div>
                        </div>
                        {{ Form::number('shop_tax[amount]', (!empty($data->shop_next_tax) ? ($data->shop_next_tax * $data->shop_next_salami) /100 : NULL), ['required', 'class' => 'form-control', 'placeholder' => 'টাকার পরিমাণ..','readonly']) }}

                        <div class="input-group-addon">
                            <div class="input-group-text">টাকা</div>
                        </div>
                    </div>

                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">পে অর্ডার / ব্যাংক ড্রাফট নং  </div>
                        </div>
                        {{ Form::number('shop_tax[payorder]', null, ['required', 'class' => 'form-control', 'placeholder' => 'পে অর্ডার / ব্যাংক ড্রাফট নং..']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">তারিখ </div>
                        </div>
                        {{ Form::text('shop_tax[date]', null, ['required', 'class' => 'form-control date-pick', 'placeholder' => 'তারিখ..']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">ব্যাংকের নাম </div>
                        </div>
                        {{ Form::text('shop_tax[bank]', null, ['required', 'class' => 'form-control', 'placeholder' => 'ব্যাংকের নাম..']) }}

                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">শাখা </div>
                        </div>
                        {{ Form::text('shop_tax[branch]', null, ['required', 'class' => 'form-control', 'placeholder' => 'শাখা..']) }}

                    </div>

                </div>





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">বাতিল</button>
                <button type="submit" class="btn btn-success" >জমা দিন</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>