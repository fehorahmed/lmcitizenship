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

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2}

        th {
            background-color: #4CAF50;
            color: white;
        }

    </style>
</head>
<body>
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
        <th class="min-w-100px">Name</th>
        <th class="min-w-100px">Mobile</th>
        <th class="min-w-100px">Subject</th>
        <th class="min-w-100px">District</th>
        <th class="min-w-100px">Upazila</th>
        <th class="min-w-100px">Union</th>
        <th class="min-w-100px">Village</th>
        <th class="min-w-100px">Remark</th>
    </tr>
    <!--end::Table row-->
    </thead>
    <!--end::Table head-->
    <!--begin::Table body-->
    <tbody class="text-gray-600 fw-bold">

    @forelse($datas as $data)
        <!--begin::Table row-->
        <tr class="ms-2">
            <td>
                <div class="form-check form-check-sm form-check-custom form-check-solid">
                    {{ $loop->iteration }}
                </div>
            </td>
            <td><span class="text-gray-800">{{ $data->name }}
                        </span></td>
            <td><span class="text-gray-800">{{ $data->mobile }}</span></td>
            <td><span class="text-gray-800">{{ $data->subject }}</span></td>
            <td><span class="text-gray-800">{{ $data->district->name }}</span></td>
            <td><span class="text-gray-800">{{ $data->upazila->name }}</span></td>
            <td><span class="text-gray-800">{{ $data->union->name }}</span></td>
            <td><span class="text-gray-800">{{ $data->village }}</span></td>
            <td><span class="text-gray-800">{{ $data->remark }}</span></td>

            <!--end::Action=-->
        </tr>
        <!--end::Table row-->
    @empty
        <tr>
            <td colspan="5" class="text-center">NO RECORD FOUND</td>
        </tr>
    @endforelse

    </tbody>
    <!--end::Table body-->
</table>
</body>
</html>
