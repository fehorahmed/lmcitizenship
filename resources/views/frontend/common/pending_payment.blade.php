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
                                <th>Payment Info</th>

                                <th>Action</th>
                            </tr>

                            @foreach ($payments as $income)
                                <tr>

                                    <td>{{ $income->id }}</td>

                                    <td>
                                        <b>নামঃ </b>{{ isset($income->user->name) ? $income->user->name : '' }}<br>
                                        <b> পিতার নামঃ
                                        </b>{{ isset($income->user->father_name) ? $income->user->father_name : '' }}<br>
                                        <b>মোবাইলঃ
                                        </b>{{ isset($income->user->phone) ? e_to_b($income->user->phone) : '' }}<br>
                                    </td>



                                    <td>{{ isset($income->digi_user->name) ? $income->digi_user->name : 'N/A' }}</td>

                                    <td> {{ $income->payment_type }} </td>

                                    <td>

                                        @include('frontend.account.payment-info', [
                                            'payment' => $income->payment_info,
                                        ])
                                    </td>

                                    <td>
                                        @if ($income->payment_type == 'CITIZENSHIP')
                                            <a href="{{ route('citizenship.pdf.aplication', $income->citizenship_id) }}"
                                                class="btn btn-danger btn-sm" target="_blank">
                                                <i class="fa fa-money" aria-hidden="true"></i> Application
                                            </a>
                                        @elseif ($income->payment_type == 'WARISH')
                                            <a href="{{ route('warish.pdf.application', $income->warish_application_id) }}"
                                                class="btn btn-danger btn-sm" target="_blank">
                                                <i class="fa fa-money" aria-hidden="true"></i> Application
                                            </a>
                                        @endif

                                        <button class="btn btn-primary btn-sm payment_approve_btn"
                                            data-id="{{ $income->id }}">Action</button>
                                        @if (auth()->user()->role == 2)
                                            {{-- <button class="btn btn-primary btn-sm digital_payment_approve_btn"
                                                data-id="{{ $income->id }}">Action</button> --}}

                                            {{-- <a href="{{ route('digital.payment_aprove', $income->id) }}"
                                            class="btn btn-success btn-sm">Aprove</a> --}}
                                        @elseif (auth()->user()->role == 4)
                                            {{-- <button class="btn btn-primary btn-sm commissioner_payment_aprove_btn"
                                                data-id="{{ $income->id }}">Action</button> --}}
                                            {{-- <a href="{{ route('commissioner.payment_aprove', $income->id) }}"
                                            class="btn btn-success btn-sm">Aprove</a> --}}
                                        @endif

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="box-footer clearfix">
                        {{-- {{ $mine_income_statement->links('component.paginator', ['object' => $mine_income_statement]) }}
                --}}
                        {{-- {{ $payments->appends(request()->query())->links('component.paginator', ['object' => $payments]) }} --}}
                    </div>

                </div>
            </div>
        @endif
    </div>
    <!-- Bootstrap v3.3.7 Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Please Select Status</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="log_id" id="log_id">
                    <label for="status"> Status </label>
                    <select name="status" class="form-control" id="status">
                        <option value="">Select One</option>
                        <option value="1">Approved</option>
                        <option value="2">Cancel</option>
                    </select>
                    <label for="remark"> Remark </label>
                    <textarea name="remark" id="remark" cols="30" rows="5" class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="payment_approve_submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('cusjs')
    <style type="text/css">
        .custom_icons img {
            width: 40px !important;
            height: 40px !important;
        }

        .paymentinfo p {
            margin-bottom: 0;
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
        $(document).ready(function() {
            // Trigger the modal with a button click
            $('.payment_approve_btn').click(function() {
                var id= $(this).data('id')
                $('#log_id').val(id);

                $('#myModal').modal('show'); // Show the modal
            });
            $('#payment_approve_submit').click(function() {

                var id = $('#log_id').val();
                var status = $('#status').val();
                var remark = $('#remark').val();

                // alert(id + '-' + status + '-'+remark);
                $.ajax({
                    url: "{{ route('payment_approve_ajax') }}",
                    type: "GET",
                    data: {
                        id: id,
                        status: status,
                        remark: remark,
                        // _token: "{{ csrf_token() }}" // Add CSRF token for protection
                    },
                    success: function(response) {
                        if (response.status) {
                             alert(response.message);
                            location.reload(); // Rel
                            // Optionally update the status or the UI here
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // Log any error responses
                    }
                });
            });
        });
    </script>
@endsection
