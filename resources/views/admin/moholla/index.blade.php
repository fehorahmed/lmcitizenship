@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'Moholla List' }}
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

                        </div>
                    </div>
                    <h4 class="page-title">Moholla List</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <select class="form-select" name="division" id="division">
                                    <option value="">Select Division</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select" name="district" id="district">
                                    <option value="">Select District</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select" name="sub_district" id="sub_district">
                                    <option value="">Select Upazila</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select" name="union" id="union">
                                    <option value="">Select Union</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select" name="ward" id="ward">
                                    <option value="">Select ward</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-info">Search</button>
                            </div>

                            <div class="col-md-1 content-end">
                                <a href="{{ route('admin.config.moholla.create') }}" class="btn btn-primary">Create
                                    Moholla</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>ক্রঃ নং</th>
                                    <th>মহল্লা (বাংলা)</th>
                                    <th>Moholla (English)</th>
                                    <th>ওয়ার্ড নং (বাংলা)</th>
                                    <th>ইউনিয়ন</th>
                                    <th>উপজেলা</th>
                                    <th>জেলা</th>
                                    <th>বিভাগ</th>

                                    <th>কার্যকলাপ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mohollas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->bn_name }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->ward->name }}</td>
                                        <td>{{ $data->ward->union->name }}</td>
                                        <td>{{ $data->ward->union->upazila->name }}</td>
                                        <td>{{ $data->ward->union->upazila->district->name }}</td>
                                        <td>{{ $data->ward->union->upazila->district->division->name }}</td>

                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('admin.config.moholla.edit', $data->id) }}">Edit</button>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ @$mohollas->links('pagination::bootstrap-4') }}
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->
        <!-- end row -->

    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            var districtSelected = '{{ old('district') }}'
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
            var subDistrictSelected = '{{ old('sub_district') }}';
            $('#district').on('change', function() {
                var district_id = $(this).val();
                $('#sub_district').html('<option value="">Select sub district</option>');
                if (district_id != '' && district_id != null) {
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
                }
            });
            $('#district').trigger('change');
            var unionSelected = '{{ old('union') }}';
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
            var wardSelected = '{{ old('ward') }}';
            $('#union').on('change', function() {
                var union_id = $(this).val();
                $('#ward').html('<option value="">Select ward</option>');
                if (union_id != '' && union_id != null) {
                    $.ajax({
                        method: "GET",
                        url: '{{ route('get.wards') }}',
                        data: {
                            union_id: union_id
                        }
                    }).done(function(data) {
                        $.each(data, function(index, item) {
                            if (wardSelected == item.id) {
                                $('#ward').append('<option selected value="' + item
                                    .id +
                                    '" selected>' + item.name + '</option>');
                            } else {
                                $('#ward').append('<option value="' + item.id +
                                    '">' +
                                    item.name + '</option>');
                            }
                        });
                    });
                }
            });
            $('#union').trigger('change');
        });
    </script>
@endpush
