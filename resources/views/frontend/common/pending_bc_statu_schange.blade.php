<!-- Lease request status change Modal start -->

<div class="modal fade" id="pending_bc_statu_schange_{{$list->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            {{Form::open(array('url' => 'pending_bc_status', 'method' => 'post'))}}
            {{ Form::hidden('id', (!empty($list->id) ? $list->id : NULL), ['required']) }}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">আপডেট স্ট্যাটাস </h4>
            </div>
            <div class="modal-body">


                <div class="form-group">
                    {{ Form::label('request_status', 'স্ট্যাটাস', array('class' => 'rent_type')) }}
                    {{ Form::select('request_status',  [
                    'Applied' => 'ফলিত',
                    'Pending' => 'মুলতুবি',
                    'Processing' => 'প্রক্রিয়াকরণ',
                    'Ready for delivery' => 'সরবরাহের জন্য প্রস্তুত',
                    'Delivery successful' => 'বিতরণ সফল',
                    'Correction' => 'সংশোধন',
                    'Cancel' => 'বাতিল'
                    ],
                     (!empty($list->request_status) ? $list->request_status : NULL),
                    ['class' => 'form-control', 'placeholder' => 'একটি বাছাই করুন...']) }}
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">বাতিল</button>
                <button type="submit" class="btn btn-success" >আপডেট</button>
            </div>
            {{ Form::close() }}
        </div>


    </div>
</div>