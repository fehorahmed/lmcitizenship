@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'Ward Edit' }}
@endsection
@section('content')
    @include('admin.master.flash')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ward</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Create</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Ward Edit</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card">
                    <div class="card-header bg-info ">
                        <h4 class=" text-white content-center">Ward Edit</h4>
                    </div>
                    <div class="card-body">
                        <form id="campaign-form" class="form-horizontal" method="post"
                            action="{{ route('admin.config.ward.update', $ward->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="example-select" class="col-12 col-md-3 col-form-label">Division</label>
                                <div class="col-12 col-md-9">
                                    <select name="division" id="division" class="form-select">
                                        <option value="">Select Division</option>
                                        @foreach ($divisions as $division)
                                            <option
                                                {{ old('division', $ward->union->upazila->district->division->id) == $division->id ? 'selected' : '' }}
                                                value="{{ $division->id }}">{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('division')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label for="district" class="col-12 col-md-3 col-form-label">District</label>
                                <div class="col-12 col-md-9">
                                    <select name="district" id="district" class="form-select">
                                        <option value="">Select District</option>
                                    </select>
                                    @error('district')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label for="district" class="col-12 col-md-3 col-form-label">Upazila</label>
                                <div class="col-12 col-md-9">
                                    <select name="sub_district" id="sub_district" class="form-select">
                                        <option value="">Select Upazila</option>
                                    </select>
                                    @error('sub_district')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label for="district" class="col-12 col-md-3 col-form-label">Union</label>
                                <div class="col-12 col-md-9">
                                    <select name="union" id="union" class="form-select">
                                        <option value="">Select Union</option>
                                    </select>
                                    @error('union')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-12 col-md-3 col-form-label">Ward No (English)</label>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $ward->name) }}" class="form-control" placeholder="Ward no ">
                                    @error('name')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label for="bn_name" class="col-12 col-md-3 col-form-label">ওয়ার্ড নং (বাংলা)</label>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="bn_name" id="bn_name"
                                        value="{{ old('bn_name', $ward->bn_name) }}" class="form-control" placeholder="ওয়ার্ড নং (বাংলা)">
                                    @error('bn_name')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>

                            <div class="text-center mb-3">
                                <a href="{{ route('admin.config.ward.index') }}" class="btn btn-danger">Back</a>
                                <input type="submit" class="btn btn-primary  " value="Update Ward">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            var districtSelected = '{{ old('district', $ward->union->upazila->district->id) }}'
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
            var subDistrictSelected = '{{ old('sub_district', $ward->union->upazila->id) }}';
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
            var unionSelected = '{{ old('union', $ward->union->id) }}';
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
