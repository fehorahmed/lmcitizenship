@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'User Payments' }}
@endsection

@push('styles')
    <link href="{{ asset('/') }}assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <div class="d-flex">

                            <a href="{{ route('admin.admin.export') }}" class="btn btn-primary ms-2">
                                Export
                            </a>

                        </div>
                    </div>
                    <h4 class="page-title">User Payments</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <form action="">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="option">Search Options</label>
                                    <select name="option" class="form-select" id="">
                                        <option value="">select one</option>
                                        <option {{ request()->option == 'phone' ? 'selected' : '' }} value="phone">Phone
                                        </option>
                                        <option {{ request()->option == 'name' ? 'selected' : '' }} value="name">Name
                                        </option>
                                        <option {{ request()->option == 'email' ? 'selected' : '' }} value="email">Email
                                        </option>
                                    </select>
                                    @error('option')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="option">Type here</label>
                                    <input type="text" name="search" class="form-control" id=""
                                        value="{{ request()->search }}" placeholder="Type here">
                                    @error('search')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" name="start_date" class="form-control"
                                        value="{{ request()->start_date }}">
                                    @error('start_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="end_date">End Date</label>
                                    <input type="date" name="end_date" class="form-control"
                                        value="{{ request()->end_date }}">
                                    @error('end_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for=""> Status</label>
                                    <select name="status" id="" class="form-select">
                                        <option value="">Select Status</option>
                                        <option {{ request()->status == 'No' ? 'selected' : '' }} value="No">Pending</option>
                                        <option {{ request()->status == 'Yes' ? 'selected' : '' }} value="Yes">Approved</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for=""> </label> <br>
                                    <button role="submit" class="btn btn-primary">Search</button>
                                    <input type="submit" class="btn btn-warning" name="download" value="Download">
                                </div>


                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Payment for</th>
                                    <th>Payment Info</th>
                                    <th>User Info</th>
                                    <th>Amount</th>


                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ e_to_b($loop->iteration) }}</td>
                                        <td>
                                            @if ($data->payment_type == 'CITIZENSHIP')
                                                নাগরিকত্ব সনদ
                                            @elseif ($data->payment_type == 'WARISH')
                                                ওয়ারিশ সনদ
                                            @endif

                                        </td>
                                        <td>
                                            @if ($data->payment_info)
                                                <div class="paymentinfo">
                                                    @if ($data->payment_info)
                                                        @php
                                                            $tp_info = json_decode($data->payment_info, true);
                                                        @endphp
                                                        <small>
                                                            @if (isset($tp_info['payment_method']))
                                                                <p class="mb-1"> <b title="মেথড">মেথডঃ
                                                                    </b>{{ e2b($tp_info['payment_method']) }}</p>
                                                            @endif

                                                            @if (isset($tp_info['total']))
                                                                <p class="mb-1"><b title="টাকার পরিমান  ">টাকার পরিমান #
                                                                    </b>{{ e2b($tp_info['total']) }} টাকা</p>
                                                            @endif

                                                            @if (isset($tp_info['payorder']))
                                                                <p class="mb-1"> <b title="ব্যাঙ্ক ড্রাফট নং">ব্যাঙ্ক
                                                                        ড্রাফট নং #
                                                                    </b>{{ $tp_info['payorder'] }}</p>
                                                            @endif
                                                            @if (isset($tp_info['bank']))
                                                                <p class="mb-1"> <b title="ব্যাঙ্ক">ব্যাঙ্কঃ
                                                                    </b>{{ e2b($tp_info['bank']) }}
                                                                </p>
                                                            @endif
                                                            @if (isset($tp_info['branch']))
                                                                <p class="mb-1"> <b title="ব্রাঞ্চ">ব্রাঞ্চঃ
                                                                    </b>{{ e2b($tp_info['branch']) }}
                                                                </p>
                                                            @endif
                                                            @if (isset($tp_info['number']))
                                                                <p class="mb-1">
                                                                    <b title="ইজারা মোবাইল">লেনদেনের মোবাইল নম্বরঃ
                                                                    </b>{{ e2b($tp_info['number']) }}
                                                                </p>
                                                            @endif
                                                            @if (isset($tp_info['tid']))
                                                                <p class="mb-1"> <b title="ট্যাক্স আইডি ">ট্রানঃ আইডিঃ
                                                                    </b>{{ e2b($tp_info['tid']) }}</p>
                                                            @endif
                                                            @if (isset($tp_info['date']))
                                                                <p class="mb-1"><b title="তারিখ">তারিখঃ
                                                                    </b>{{ e2b(date('d-F-Y', strtotime($tp_info['date']))) }}
                                                                </p>
                                                            @endif
                                                        </small>
                                                    @endif
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($data->payment_type == 'CITIZENSHIP')
                                                <small>
                                                    <p class="mb-1"> <b title="মেথড">নাম :
                                                        </b>{{ $data->citizen->name ?? '' }}</p>
                                                    <p class="mb-1"> <b title="মেথড">পিতার নাম :
                                                        </b>{{ $data->citizen->father ?? '' }}</p>

                                                    <p class="mb-1"> <b title="মেথড">মোবাইল :
                                                        </b>{{ e_to_b($data->user->phone ?? '') }}</p>

                                                </small>
                                            @endif
                                            @if ($data->payment_type == 'WARISH')
                                                <small>
                                                    <p class="mb-1"> <b title="মেথড">নাম :
                                                        </b>{{ $data->user->name ?? '' }}</p>
                                                    <p class="mb-1"> <b title="মেথড">পিতার নাম :
                                                        </b>{{ $data->user->father_name ?? '' }}</p>

                                                    <p class="mb-1"> <b title="মেথড">মোবাইল :
                                                        </b>{{ e_to_b($data->user->phone ?? '') }}</p>
                                                </small>
                                            @endif
                                        </td>
                                        <td>{{ $data->amount ?? 0 }}</td>
                                        <td>
                                            @if ($data->is_active == 'Yes')
                                                <span class="btn btn-success">Approved</span>
                                            @else
                                                <span class="btn btn-danger">Pending</span>
                                            @endif
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->
        <!-- end row -->

    </div>
@endsection
@push('scripts')
    <!-- Datatables js -->
    <script src="{{ asset('/') }}assets/js/vendor/dataTables.buttons.min.js"></script>
    <script src="{{ asset('/') }}assets/js/vendor/buttons.bootstrap5.min.js"></script>
    <script src="{{ asset('/') }}assets/js/vendor/buttons.html5.min.js"></script>
    <script src="{{ asset('/') }}assets/js/vendor/buttons.flash.min.js"></script>
    <script src="{{ asset('/') }}assets/js/vendor/buttons.print.min.js"></script>


    <script !src="">
        $(function() {
            $('.btn-status-change').on('click', function() {
                var id = $(this).data('id');
                var result = confirm('Are you sure to change status??');
                if (result) {
                    if (id != '' && id != null) {
                        $.ajax({
                            method: "GET",
                            url: "{{ route('admin.admin.change-status') }}",
                            data: {
                                id: id
                            }
                        }).done(function(response) {
                            if (response.success) {
                                alert(response.message)
                                location.reload();
                            } else {
                                alert(response.message);

                            }

                        });
                    } else {
                        alert('Something went wrong. Please reload.')
                    }
                }
            })
        })
    </script>
@endpush
