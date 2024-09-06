<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">{{$settings->name??''}}</h2>
    <table class="table">
        <!--begin::Table head-->
        <thead>
            <!--begin::Table row-->
            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                <th class="w-10px pe-2">
                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                        #
                    </div>
                </th>
                <th class="min-w-100px">Payment for</th>
                <th class="min-w-100px">Payment Info</th>
                <th class="min-w-100px">User Info</th>
                <th class="min-w-100px">Amount</th>

                <th class="min-w-100px">Status</th>
            </tr>
            <!--end::Table row-->
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody class="text-gray-600 fw-bold">

            @forelse($datas as $data)
                <!--begin::Table row-->
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
                <!--end::Table row-->
            @empty
                <tr>
                    <td colspan="5" class="text-center">NO RECORD FOUND</td>
                </tr>
            @endforelse
            @if ($datas->count()>0)
            <tr>
                <td colspan="4" style="text-align: right;">Total</td>
                <td>{{number_format($datas->sum('amount'),2)}} /-tk</td>
            </tr>
            @endif

        </tbody>
        <!--end::Table body-->
    </table>
</body>

</html>
