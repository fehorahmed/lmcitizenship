@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'Application Setting' }}
@endsection
@section('content')
    {{-- @include('admin.master.flash') --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Application Setting</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Create</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Application Setting</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 m-auto">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h4 class="text-white">Application Setting Update</h4>
                    </div>
                    <div class="card-body">
                        <form id="campaign-form" class="form-horizontal" method="post"
                            action="{{ route('admin.setting.update') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <label for="name" class="col-12 col-md-3 col-form-label">Name</label>
                                        <div class="col-12 col-md-9">
                                            <input type="text" name="name" id="name"
                                                value="{{ old('name', $setting->name ?? '') }}" class="form-control"
                                                placeholder="Enter name here">
                                            @error('name')
                                                <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-select" class="col-12 col-md-3 col-form-label">Phone</label>
                                        <div class="col-12 col-md-9">
                                            <input type="number" name="phone"
                                                value="{{ old('phone', $setting->phone ?? '') }}" id="phone"
                                                class="form-control" placeholder="Phone Number">
                                            @error('phone')
                                                <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="example-select" class="col-12 col-md-3 col-form-label"> Mail</label>
                                        <div class="col-12 col-md-9">
                                            <input type="email" name="email"
                                                value="{{ old('email', $setting->email ?? '') }}" id="email"
                                                class="form-control" placeholder="Enter email">
                                            @error('email')
                                                <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <label for="example-select" class="col-12 col-md-3 col-form-label">Address</label>
                                        <div class="col-12 col-md-9">
                                            <textarea name="address" id="address" cols="5" class="form-control" rows="3"
                                                placeholder="Write address here">{{ old('address', $setting->address ?? '') }}</textarea>
                                            @error('address')
                                                <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-select" class="col-12 col-md-3 col-form-label">Logo</label>
                                        <div class="col-12 col-md-9">
                                            <input type="file" name="logo" id="file" class="form-control">

                                            @error('logo')
                                                <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                            @if ($setting && $setting->logo)
                                                <img src="{{ asset($setting->logo ?? '') }}" class="mt-1" alt=""
                                                    width="200" height="80">
                                            @endif
                                        </div>



                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <label for="map" class="col-12 col-md-3 col-form-label">Map URL</label>
                                        <div class="col-12 col-md-9">
                                            <input type="text" name="map" id="map"
                                                value="{{ old('map', $setting->map ?? '') }}" class="form-control"
                                                placeholder="Enter map url">
                                            @error('map')
                                                <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <label for="banner" class="col-12 col-md-3 col-form-label">Banner</label>
                                        <div class="col-12 col-md-9">
                                            <input type="file" name="banner" id="banner" class="form-control">

                                            @error('banner')
                                                <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                            @if ($setting && $setting->banner)
                                                <img src="{{ asset($setting->banner ?? '') }}" class="mt-1" alt=""
                                                    width="200" height="80">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="mayor_signature" class="col-12 col-md-3 col-form-label">Mayor Signature</label>
                                        <div class="col-12 col-md-9">
                                            <input type="file" name="mayor_signature" id="mayor_signature" class="form-control">

                                            @error('mayor_signature')
                                                <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                            @if ($setting && $setting->mayor_signature)
                                                <img src="{{ asset($setting->mayor_signature ?? '') }}" class="mt-1" alt=""
                                                    width="200" height="50">
                                            @endif
                                        </div>
                                    </div>


                                </div>

                            </div>
                            <div class="text-center mb-3">

                                <input type="submit" class="btn btn-primary  " value="Update Setting">
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
            var districtSelected = '{{ old('district', \Illuminate\Support\Facades\Auth::user()->district_id) }}'
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
        });
    </script>
@endpush
