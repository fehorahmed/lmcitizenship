

<div class="modal fade" id="payment-option-land-{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{Form::open(array('url' => 'land_final_payment', 'method' => 'post'))}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">

                </h4>
            </div>
            <div class="modal-body">
                @php

                    $rent = ($tender->rent)?$tender->rent:0;
                    $due = ($tender->due)?$tender->due:0;
                    $fine = ($tender->fine)?$tender->fine:0;
                    $total_amount = ($tender->total_amount)?$tender->total_amount:($rent+$due+$fine);



                @endphp

                    {{ Form::hidden('id', $list->id, ['required']) }}
                <div class="form-group">
                    {{ Form::label('land_rent_info', 'ইজারার টাকার পরিমান', array('class' => 'land_rent_info', 'autocomplete' => 'off')) }}



                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co"> ইজারার টাকার পরিমাণ</div>
                        </div>
                        {{ Form::number('land_rent_info[amount]',  $rent, ['required', 'class' => 'form-control', 'placeholder' => 'টাকার পরিমাণ..', 'readonly']) }}

                        <div class="input-group-addon">
                            <div class="input-group-text">টাকা</div>
                        </div>
                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co"> বকেয়া টাকার পরিমাণ</div>
                        </div>
                        {{ Form::number('land_rent_info[due]',  $due, ['required', 'class' => 'form-control', 'placeholder' => 'টাকার পরিমাণ..', 'readonly']) }}

                        <div class="input-group-addon">
                            <div class="input-group-text">টাকা</div>
                        </div>
                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co"> বকেয়া  জরিমানা পরিমাণ</div>
                        </div>
                        {{ Form::number('land_rent_info[fine]',  $fine, ['required', 'class' => 'form-control', 'placeholder' => 'টাকার পরিমাণ..', 'readonly']) }}

                        <div class="input-group-addon">
                            <div class="input-group-text">টাকা</div>
                        </div>
                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text text-success" id="rent_amount_co"> মোট টাকার পরিমাণ</div>
                        </div>
                        {{ Form::number('land_rent_info[total]',  $total_amount, ['required', 'class' => 'form-control', 'placeholder' => 'টাকার পরিমাণ..', 'readonly']) }}

                        <div class="input-group-addon">
                            <div class="input-group-text">টাকা</div>
                        </div>
                    </div>

                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">পে অর্ডার / ব্যাংক ড্রাফট নং  </div>
                        </div>
                        {{ Form::number('land_rent_info[payorder]', null , ['required', 'class' => 'form-control', 'placeholder' => 'পে অর্ডার / ব্যাংক ড্রাফট নং..', 'autocomplete' => 'off']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">তারিখ </div>
                        </div>
                        {{ Form::text('land_rent_info[date]', NULL, ['required', 'class' => 'form-control date-pick', 'placeholder' => 'তারিখ..', 'autocomplete' => 'off']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">ব্যাংকের নাম </div>
                        </div>
                        {{ Form::text('land_rent_info[bank]',  NULL, ['required', 'class' => 'form-control', 'placeholder' => 'ব্যাংকের নাম..', 'autocomplete' => 'off']) }}


                    </div>
                    <div class="input-group" style="margin-bottom: 5px">
                        <div class="input-group-addon" style="min-width: 165px">
                            <div class="input-group-text" id="rent_amount_co">শাখা </div>
                        </div>
                        {{ Form::text('land_rent_info[branch]', NULL, ['required', 'class' => 'form-control', 'placeholder' => 'শাখা..', 'autocomplete' => 'off']) }}


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