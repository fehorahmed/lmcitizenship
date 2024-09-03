@extends('frontend.layouts.app')

@section('content')
    <div class="container user_panel">
        @include('frontend.common.frontend_user_menu')
        @if (Route::has('login'))
            <?php $user_own = Auth::user(); ?>
            <div class="row up_bottom">
                <div class="col-md-4">
                    <div class="card border-info mx-sm-1 p-3">
                        <div class="text-info text-center mt-3">
                            <h4>
                                আজকের মোট আয়
                            </h4>
                        </div>
                        <div class="text-info text-center mt-2">
                            <h1>
                                <?php $total_today = \App\Payment::where('created_at', '>=', date('Y-m-d') . ' 00:00:00')->where('digi_center_user_id', Auth::user()->id)->get()->sum('amount'); ?>
                                {{ $total_today }}
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-success mx-sm-1 p-3">
                        <div class="text-warning text-center mt-3">
                            <h4>
                                এ মাসে মোট আয়
                            </h4>
                        </div>
                        <div class="text-warning text-center mt-2">
                            <h1>
                                <?php $total_this_month = \App\Payment::whereMonth('created_at', \Carbon\Carbon::now()->month)->where('digi_center_user_id', Auth::user()->id)->get()->sum('amount'); ?>
                                {{ $total_this_month }}
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-success mx-sm-1 p-3">
                        <div class="text-warning text-center mt-3">
                            <h4>
                                এ যাবত মোট আয়
                            </h4>
                        </div>
                        <div class="text-warning text-center mt-2">
                            <h1>
                                <?php $total_all = \App\Payment::where('digi_center_user_id', Auth::user()->id)->get()->sum('amount'); ?>
                                {{ $total_all }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    Filter
                                </h5>
                            </div>
                            <div class="panel-body text-right">
                                <form action="" method="get" class="form-horizontal">
                                    {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-2">
                                        <select id="services" class="form-control" name="service" >
                                            <option value="">Select Services</option>
                                            @foreach ($services as $service)
                                            <option value="{{ $service->id }}" {{ (request('service') == $service->id) ? 'selected' : '' }}>{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if(auth()->user()->isAdmin())
                                    <div class="col-md-2">
                                        <select id="services" class="form-control" name="ward" >
                                            <option value="">Select Ward</option>
                                            @for($i = 1; $i<12; $i++)
                                                <option value="{{ $i }}" {{ (request('ward') == $i) ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    @endif
                                    <div class="col-md-2">
                                        <input id="start_date" class="form-control" name="start_date" type="date" placeholder="Start Date" value="{{ request('start_date') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input id="end_date" class="form-control" name="end_date" type="date" placeholder="End Date" value="{{ request('end_date') }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-success" type="submit">Submit</button>
                                    </div>
                                    <div class="col-md-1">
                                        <a class="btn btn-info" href="{{ url()->current() }}">Reset</a>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="row">

                    <div class="col-md-12">

                            <table class="table table-striped table-bordered">
                                <tbody>
                                <tr style="background: #9E5BBA !important; color: #FFF;">
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Digi User</th>
                                    <th>Service</th>
                                    <th>Payment Method</th>
                                    <th>Amount</th>
                                    <th>Transaction ID</th>
                                </tr>

                                @foreach($mine_income_statement as $income)

        
                                    <tr>
        
                                        <td>{{ $income->id }}</td>
                                        {{--<td>--}}
                                            {{--@php--}}
                                                {{--$user = \App\User::where(['id' => $income->user_id])->first();--}}
                                            {{--@endphp--}}
        
                                            {{--{{ $user->name }}--}}
                                        {{--</td>--}}
                                        <td>{{ $income->user->name }}</td>
                                        {{--<td>--}}
                                            {{--@php--}}
                                                {{--$digi_user = \App\User::where(['id' => $income->digi_center_user_id])->first();--}}
                                            {{--@endphp--}}
        
                                            {{--{{ $digi_user->name }}--}}
        
                                        {{--</td>--}}
                                        <td>{{ (isset($income->digi_user->name))?$income->digi_user->name :'N/A' }}</td>
                                        {{--<td>--}}
                                            {{--@php--}}
                                                {{--$service = \App\Service::where(['id' => $income->service_id])->first();--}}
                                            {{--@endphp--}}
        
                                            {{--{{ $service->name }}--}}
                                        {{--</td>--}}
                                        <td>{{ $income->service->name }}</td>
                                        <td>{{ $income->payment_method }}</td>
                                        <td>{{ $income->amount }}</td>
                                        <td>{{ $income->transaction_no }}</td>
        
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="box-footer clearfix">
                                {{-- {{ $mine_income_statement->links('component.paginator', ['object' => $mine_income_statement]) }} --}}
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
        jQuery(document).ready(function ($) {
            $.noConflict();
        });

        function flip(id) {
            jQuery(".panel_" + id).toggle();
        }

        $('#search').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : '{{URL::to('search')}}',
                data:{'search':$value},
                success:function(data){
                    $('tbody').html(data);
                }
            });
        })
    </script>
@endsection
