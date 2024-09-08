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
                                                <i class="fa fa-money" aria-hidden="true"></i>
                                            </a>
                                        @elseif ($income->payment_type == 'WARISH')
                                            <a href="{{ route('citizenship.pdf.aplication', $income->warish_application_id) }}"
                                                class="btn btn-danger btn-sm" target="_blank">
                                                <i class="fa fa-money" aria-hidden="true"></i>
                                            </a>
                                        @endif


                                        <a href="{{ route('digital.payment_aprove', $income->id) }}"
                                            class="btn btn-success btn-sm">Aprove</a>


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
                url: '{{ URL::to('
                                            search ') }}',
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
