@extends('frontend.layouts.app')

@section('content')
<div class="container user_panel">
    @include('frontend.common.frontend_user_menu')
    @if (Route::has('login'))
    <?php $user_own = Auth::user(); ?>


    <div class="row">

        <div class="col-md-12">

            <table class="table table-striped table-bordered">
                <tbody>
                    <tr style="background: #9E5BBA !important; color: #FFF;">
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Digi User</th>
                        <th>Service</th>
                        <th>Payment</th>
                        <th>Transaction ID</th>
                        <th>Action</th>
                    </tr>

                    @foreach($payments as $income)


                    <tr>

                        <td>{{ $income->id }}</td>

                        <td>
                            <b>নামঃ </b>{{ isset($income->user->name)?$income->user->name:'' }}<br>
                            <b> পিতার নামঃ
                            </b>{{ isset($income->user->bnfathername)?$income->user->bnfathername:'' }}<br>
                            <b>মোবাইলঃ </b>{{ isset($income->user->phone)? e_to_b($income->user->phone): ''}}<br>


                        </td>


                        <td>{{ (isset($income->digi_user->name))?$income->digi_user->name :'N/A' }}</td>

                        <td>{{ $income->service->name }}</td>
                        <td>
                            <b>পেমেন্ট মেথডঃ </b> {{ e_to_b($income->payment_method) }}<br>
                            <b>পরিমাণঃ </b> {{ e_to_b($income->amount) }} টাকা<br>
                            <b>তারিখঃ </b> {{ e_to_b(date("d-F-Y", strtotime($income->created_at))) }}<br>

                        </td>
                        <td>{{ $income->transaction_no }}</td>
                        <td>

                            <a href="{{ url('/pending_payment_view/'.$income->id) }}" class="btn btn-danger btn-sm"
                                target="_blank">
                                <i class="fa fa-money" aria-hidden="true"></i>
                            </a>

                            @if(auth()->user()->isAdmin())

                            @if($income->service_id == 12)

                            @php

                            $business = App\Business::where('payment_id', $income->id)->first();
                            @endphp
                            @if($business)

                            <a href="{{ url('view_trad_license/'.$business->id) }}" title="View Trad Licence"
                                class="btn btn-warning btn-sm" target="_blank">
                                <i class="fa fa-print" aria-hidden="true"></i>
                            </a>
                            @endif
                            @endif

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                data-target="{{'#verifation-'.$income->id}}">
                                Action
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="{{'verifation-'.$income->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                        </div>
                                        {{ Form::open(array('url' => 'payment_verification', 'method' => 'post', 'value' => 'PATCH', 'id' => 'business')) }}
                                        <div class="modal-body">

                                            {{ Form::hidden('id', (!empty($income->id) ? $income->id : NULL), []) }}
                                            <div class="form-group">
                                                {{ Form::label('is_verify', ' Varifacation ', array('class' => 'is_verify cmmone-class')) }}
                                                {{ Form::select('is_verify',['Yes' => 'Yes','No' => 'No', 'Modify' => 'Modify', 'Cancel' => 'Cancel'], (!empty($income->is_verify) ? $income->is_verify : NULL), ['class' => 'form-control']) }}


                                            </div>


                                            <div class="form-group">
                                                {{ Form::label('can_modify', ' Can Modifacation  ', array('class' => 'can_modify cmmone-class')) }}
                                                {{ Form::select('can_modify',['Yes' => 'Yes', 'No' => 'No'], (!empty($income->can_modify) ? $income->can_modify : NULL), ['class' => 'form-control']) }}


                                            </div>

                                            <div class="form-group">
                                                {{ Form::label('remarks', '  Remarks  ', array('class' => 'remarks cmmone-class')) }}
                                                {{ Form::textarea('remarks', (!empty($income->remarks) ? $income->remarks : NULL), ['rows' => 3, 'class' => 'form-control', 'placeholder' => ' Remarks.....   ']) }}


                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>

                            @else

                            <a href="{{ url('/payment_aprove/'.$income->id) }}"
                                class="btn btn-success btn-sm">Aprove</a>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="box-footer clearfix">
                {{-- {{ $mine_income_statement->links('component.paginator', ['object' => $mine_income_statement]) }}
                --}}
                {{ $mine_income_statement->appends(request()->query())->links('component.paginator', ['object' => $mine_income_statement]) }}
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
    jQuery(document).ready(function($) {
        $.noConflict();
    });

    function flip(id) {
        jQuery(".panel_" + id).toggle();
    }

    $('#search').on('keyup', function() {
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: '{{URL::to('
            search ')}}',
            data: {
                'search': $value
            },
            success: function(data) {
                $('tbody').html(data);
            }
        });
    })
</script>
@endsection