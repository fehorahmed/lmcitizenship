@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'Complain Create' }}
@endsection
@section('content')
    @include('admin.master.flash')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Complain</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Create</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Complain Create</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 m-auto">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h4 class="text-white">Complain Create</h4>
                    </div>
                    <div class="card-body">
                        <form id="campaign-form" class="form-horizontal" method="post"
                              action="{{route('admin.complain.update',$complain->id)}}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <label for="name" class="col-12 col-md-3 col-form-label">Name</label>
                                        <div class="col-12 col-md-9">
                                            <input type="text" name="name" id="name" value="{{old('name',$complain->name)}}"
                                                   class="form-control" placeholder="Enter name here">
                                            @error('name')
                                            <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-select" class="col-12 col-md-3 col-form-label">Father
                                            Name</label>
                                        <div class="col-12 col-md-9">
                                            <input type="text" name="f_name" value="{{old('f_name',$complain->f_name)}}" id="f_name"
                                                   class="form-control" placeholder="Father Name">
                                            @error('f_name')
                                            <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-select"
                                               class="col-12 col-md-3 col-form-label">Mobile</label>
                                        <div class="col-12 col-md-9">
                                            <input type="number" value="{{old('mobile',$complain->mobile)}}" name="mobile" id="mobile" class="form-control"
                                                   placeholder="Enter Mobile">
                                            @error('mobile')
                                            <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-select" class="col-12 col-md-3 col-form-label"> Mail</label>
                                        <div class="col-12 col-md-9">
                                            <input type="email" name="email" value="{{old('email',$complain->email)}}" id="email"
                                                   class="form-control" placeholder="Enter email">
                                            @error('email')
                                            <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-select" class="col-12 col-md-3 col-form-label">NID</label>
                                        <div class="col-12 col-md-9">
                                            <input type="number" name="nid" id="nid" value="{{old('nid',$complain->nid)}}"
                                                   class="form-control" placeholder="Enter NID">
                                            @error('nid')
                                            <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-select"
                                               class="col-12 col-md-3 col-form-label">Subject</label>
                                        <div class="col-12 col-md-9">
                                            <textarea name="subject" id="subject" cols="5" class="form-control" rows="3"
                                                      placeholder="Write subject here">{{old('subject',$complain->subject)}}</textarea>
                                            @error('subject')
                                            <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-select"
                                               class="col-12 col-md-3 col-form-label">Attachment</label>
                                        <div class="col-12 col-md-9">
                                            <input type="file" name="file" id="file" class="form-control">
                                            <a href="{{asset($complain->file)}}" target="_blank">
                                            <img src="{{asset($complain->file)}}" alt="" width="300" height="150"></a>

                                            @error('file')
                                            <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <label for="example-select"
                                               class="col-12 col-md-3 col-form-label">Date</label>
                                        <div class="col-12 col-md-9">
                                            <input type="date" name="date" value="{{old('date',$complain->application_date)}}" class="form-control">
                                            @error('date')
                                            <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-select"
                                               class="col-12 col-md-3 col-form-label">Division</label>
                                        <div class="col-12 col-md-9">
                                            <select name="division" id="division" class="form-select">
                                                <option value="">Select Division</option>
                                                @foreach($divisions as $division)
                                                    <option {{old('division',$complain->division_id)==$division->id?'selected':''}} value="{{$division->id}}">{{$division->name}}</option>
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
                                        <label for="village" class="col-12 col-md-3 col-form-label">Village</label>
                                        <div class="col-12 col-md-9">
                                            <input type="text" name="village" id="village" class="form-control"
                                                   value="{{old('village',$complain->village)}}">
                                            @error('village')
                                            <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-select"
                                               class="col-12 col-md-3 col-form-label">Remark</label>
                                        <div class="col-12 col-md-9">
                                            <textarea name="remark" class="form-control" id="remark" cols="10"
                                                      rows="3"
                                                      placeholder="Enter remarks here">{{old('remark',$complain->remark)}}</textarea>
                                            @error('remark')
                                            <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="text-center mb-3">
                                <a href="{{route('admin.complain.index')}}" class="btn btn-danger">Back</a>
                                <input type="submit" class="btn btn-primary  " value="Update Application">
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
        $(function (){
            var districtSelected = '{{ old('district',$complain->district_id) }}'
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
            var subDistrictSelected = '{{ old('sub_district',$complain->sub_district_id) }}';
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
            var unionSelected = '{{ old('union',$complain->union_id) }}';
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
