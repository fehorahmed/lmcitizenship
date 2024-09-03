@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'Application' }}
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
                            {{-- <a href="{{ route('admin.complain.create') }}" class="btn btn-primary">Create Complain</a> --}}
                        </div>
                    </div>
                    <h4 class="page-title">Application List</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h4>Applications</h4>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-2 content-end">

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="">
                            <div class="row">

                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="division" class="form-label">Division</label>
                                        <select name="division" class="form-select" id="division">
                                            <option value="">Select One</option>
                                            @foreach ($divisions as $division)
                                                <option {{ request('division') == $division->id ? 'selected' : '' }}
                                                    value="{{ $division->id }}">{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="district" class="form-label">District</label>
                                        <select name="district" class="form-select" id="district">
                                            <option value="">Select One</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="sub_district" class="form-label">Upazila</label>
                                        <select name="upazila" class="form-select" id="sub_district">
                                            <option value="">Select One</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="union" class="form-label">Union</label>
                                        <select name="union" class="form-select" id="union">
                                            <option value="">Select One</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <button type="submit" name="submit" value="search"
                                            class="btn btn-primary mt-3 ps-3 pe-3">Search
                                        </button>
                                        <button type="submit" name="export" value="export"
                                            class="btn btn-warning mt-3 ms-2 ps-3 pe-3">Export
                                        </button>

                                    </div>
                                </div>

                            </div>
                        </form>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>District</th>
                                    <th>Upazila</th>
                                    <th>Union</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->phone }}</td>
                                        <td>{{ $data->perDistrict->name ?? '' }}</td>
                                        <td>{{ $data->perUpazila->name ?? '' }}</td>
                                        <td>{{ $data->perUnion->name ?? '' }}</td>
                                        <td>{{ $data->per_address ?? '' }}</td>
                                        <td>{{ $data->registration_status ?? '' }}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('admin.registration.view', $data->id) }}">View</a>
                                            @if (!request()->routeIs('admin.approved.index'))
                                                <button class="btn btn-primary btn-sm  status-btn" data-bs-toggle="modal"
                                                    data-id="{{ $data->id }}" data-bs-target="#staticBackdrop">Change
                                                    Status</button>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ @$datas->links('pagination::bootstrap-4') }}
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->

        </div>
        <!-- end row -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.registration.status-change') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="user_id">
                        <label for="">Select Status</label>
                        <select name="status" id="" class="form-select">
                            <option value="">select one</option>
                            <option value="Approved">Approved</option>
                            <option value="Cancel">Cancel</option>

                        </select>
                        {{-- <label for="" class="mt-1">Note</label>
                        <textarea name="note" id="" cols="30" rows="3" class="form-control"></textarea> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('.status-btn').on('click', function() {
                var user_id = $(this).attr('data-id');

                $('#user_id').val(user_id);
            });
        });


        $(function() {
            var districtSelected =
                '{{ request('district', \Illuminate\Support\Facades\Auth::user()->district_id) }}'
            $('#division').on('change', function() {
                var division_id = $(this).val();
                $('#district').html('<option value="">Select district</option>');

                $.ajax({
                    method: "GET",
                    url: '{{ route('get.district') }}',
                    data: {
                        division_id: division_id
                    }
                }).done(function(data) {
                    $.each(data, function(index, item) {
                        if (districtSelected == item.id) {
                            $('#district').append('<option selected value="' + item.id +
                                '" selected>' + item.name + '</option>');
                        } else {
                            $('#district').append('<option value="' + item.id + '">' + item
                                .name + '</option>');
                        }
                    });
                    $('#district').trigger('change');
                });


            });

            // personal address
            $('#division').trigger('change');
            var subDistrictSelected = '{{ request('upazila') }}';
            $('#district').on('change', function() {
                var district_id = $(this).val();
                $('#sub_district').html('<option value="">Select sub district</option>');
                // if (district_id != '' && district_id != null) {
                $.ajax({
                    method: "GET",
                    url: '{{ route('get.sub_district') }}',
                    data: {
                        district_id: district_id
                    }
                }).done(function(data) {
                    $.each(data, function(index, item) {
                        if (subDistrictSelected == item.id) {
                            $('#sub_district').append('<option selected value="' + item
                                .id +
                                '" selected>' + item.name + '</option>');
                        } else {
                            $('#sub_district').append('<option value="' + item.id +
                                '">' +
                                item.name + '</option>');
                        }
                    });
                    $('#sub_district').trigger('change');
                });
                // }

            });
            $('#district').trigger('change');
            var unionSelected = '{{ request('union') }}';
            $('#sub_district').on('change', function() {
                var sub_district_id = $(this).val();
                $('#union').html('<option value="">Select union</option>');
                if (sub_district_id != '' && sub_district_id != null) {
                    $.ajax({
                        method: "GET",
                        url: '{{ route('get.unions') }}',
                        data: {
                            sub_district_id: sub_district_id
                        }
                    }).done(function(data) {
                        $.each(data, function(index, item) {
                            if (unionSelected == item.id) {
                                $('#union').append('<option selected value="' + item
                                    .id +
                                    '" selected>' + item.name + '</option>');
                            } else {
                                $('#union').append('<option value="' + item.id +
                                    '">' +
                                    item.name + '</option>');
                            }
                        });
                    });
                }
            });
            $('#sub_district').trigger('change');
        });
    </script>
@endpush
