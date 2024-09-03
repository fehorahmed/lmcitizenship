@extends('frontend.layouts.app')

@section('content')
    <div class="container user_panel">
        @php
            $rowNumber = 1;

        @endphp

        <h2 class="text-center">ওয়ারিশ</h2>

        <?php
        if (Session::has('myexcep')) {
            dump(Session::get('myexcep'));
        }
        ?>
        <div class="row up_bottom">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading nav">
                        @include('Warish::frontend.part.menu')
                    </div>
                    <form action="{{ route('user.warish.add') }}" method="POST">
                        @csrf

                        <input type="hidden" name="id" value="{{ !empty($fdata->id) ? $fdata->id : null }}">

                        <div class="panel-body">
                            <div class="panel-miss">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div
                                            class="form-group required {{ $errors->has('application_name') ? ' has-error' : '' }}">
                                            <label for="application_name" class="application_name control-label">আবেদনকারীর
                                                নামঃ </label>
                                            <input type="text" class="form-control" name="application_name"
                                                id="application_name" value="{{ (!empty($fdata->application_name) ? $fdata->application_name : $user->name) }}"
                                                placeholder="আবেদনকারীর নাম...">
                                            @if ($errors->has('application_name'))
                                                <span id="helpBlock2"
                                                    class="help-block">{{ $errors->first('application_name') }}</span>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group required {{ $errors->has('application_relation') ? ' has-error' : '' }}">
                                            <label for="application_relation"
                                                class="application_relation control-label">আবেদনকারীর সম্পর্ক</label>
                                            <select name="application_relation" id="application_relation"
                                                class="form-control">
                                                <option value=""></option>
                                                @foreach (lv_warishtype() as $key => $item)
                                                    <option value="{{ $key }}" {{old('application_relation')== $key ? 'selected':''}}>{{ $item }}</option>
                                                @endforeach

                                            </select>
                                            @if ($errors->has('application_relation'))
                                                <span id="helpBlock2"
                                                    class="help-block">{{ $errors->first('application_relation') }}</span>
                                            @endif
                                        </div>


                                        <div
                                            class="form-group required {{ $errors->has('application_address') ? ' has-error' : '' }}">
                                            <label for="application_address"
                                                class="application_address control-label">আবেদনকারীর ঠিকানা</label>
                                            <input type="text" class="form-control" name="application_address"
                                                id="application_address" value="{{ old('application_address') }}"
                                                placeholder="আবেদনকারীর ঠিকানা...">
                                            @if ($errors->has('application_address'))
                                                <span id="helpBlock2"
                                                    class="help-block">{{ $errors->first('application_address') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group required {{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name" class="name control-label">মৃত ব্যক্তির নামঃ</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ old('name') }}" placeholder="নাম...">
                                            @if ($errors->has('name'))
                                                <span id="helpBlock2"
                                                    class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group required {{ $errors->has('father') ? ' has-error' : '' }}">
                                            <label for="father" class="father control-label">মৃত ব্যক্তির পিতা/স্বামীর
                                                নামঃ</label>
                                            <input type="text" class="form-control" name="father" id="father"
                                                value="{{  old('father')  }}" placeholder="পিতা/স্বামীর নাম...">
                                            @if ($errors->has('father'))
                                                <span id="helpBlock2"
                                                    class="help-block">{{ $errors->first('father') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group required {{ $errors->has('mother') ? ' has-error' : '' }}">
                                            <label for="mother" class="mother control-label">মৃত ব্যক্তির মাতার
                                                নামঃ</label>
                                            <input type="text" class="form-control" name="mother" id="mother"
                                                value="{{ old('mother')}}" placeholder="মাতার নাম...">
                                            @if ($errors->has('mother'))
                                                <span id="helpBlock2"
                                                    class="help-block">{{ $errors->first('mother') }}</span>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group required {{ $errors->has('death_certificate') ? ' has-error' : '' }}">
                                            <label for="death_certificate" class="death_certificate control-label">মৃত্যু
                                                সনদ আইডিঃ</label>
                                            <input type="text" class="form-control" name="death_certificate"
                                                id="death_certificate" value="{{ old('death_certificate') }}"
                                                placeholder="মৃত্যু সনদ আইডি...">
                                            @if ($errors->has('death_certificate'))
                                                <span id="helpBlock2"
                                                    class="help-block">{{ $errors->first('death_certificate') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group required {{ $errors->has('qty') ? ' has-error' : '' }}">
                                            <label for="qty" class="qty control-label">কত খানাঃ</label>
                                            <input type="text" class="form-control" name="qty" id="qty"
                                                value="{{ old('qty') }}"
                                                placeholder="কত খানা...">
                                            @if ($errors->has('qty'))
                                                <span id="helpBlock2"
                                                    class="help-block">{{ $errors->first('qty') }}</span>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group required {{ $errors->has('date_of_death') ? ' has-error' : '' }}">
                                            <label for="date_of_death" class="date_of_death control-label">মৃত ব্যক্তির
                                                মৃত্যুর তারিখ</label>
                                            <input type="text" class="form-control date-pick" name="date_of_death"
                                                id="date_of_death"
                                                value="{{ old('date_of_death') }}"
                                                placeholder="মৃত্যুর তারিখ...">
                                            @if ($errors->has('date_of_death'))
                                                <span id="helpBlock2"
                                                    class="help-block">{{ $errors->first('date_of_death') }}</span>
                                            @endif
                                        </div>


                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="form-group {{ $errors->has('division') ? ' has-error' : '' }}">
                                            <label for="division" class="division control-label">বিভাগ</label>
                                            <select name="division" id="division" class="form-control">
                                                <option value="">Select One</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}" {{old('division') ==  $division->id ? 'selected':''}}>{{ $division->name }} -
                                                        {{ $division->bn_name }}</option>
                                                @endforeach

                                            </select>
                                            @if ($errors->has('division'))
                                                <span id="helpBlock2"
                                                    class="help-block">{{ $errors->first('division') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="district" class="district control-label">জেলা
                                            </label>
                                            <select class="form-control" required name="district" id="district">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="upazila" class="upazila control-label">উপজেলা
                                            </label>
                                            <select class="form-control" required name="upazila" id="upazila">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="union_powrasava" class="union_powrasava control-label">উনিয়ন/পৌরসভা
                                            </label>
                                            <select class="form-control" required name="union_powrasava" id="union_powrasava">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="ward" class="ward control-label">ওয়ার্ড নং
                                            </label>
                                            <select class="form-control" required name="ward" id="ward">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="moholla" class="moholla control-label">গ্রাম/মহল্লা
                                            </label>
                                            <select class="form-control" required name="moholla" id="moholla">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>
                                        <div class="form-group {{ $errors->has('post_office') ? ' has-error' : '' }}">
                                            <label for="post_office" class="post_office control-label">ডাকঘর
                                            </label>
                                            <select class="form-control"  name="post_office" id="post_office">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="address" class="address control-label">মন্তব্য
                                            </label>
                                            <input type="text" class="form-control" name="address" id="address"
                                                placeholder="Address  " value="{{ old('address') }}">

                                        </div>


                                    </div>
                                </div>
                                <br>

                                @if ($errors->has('warish'))
                                    <span id="helpBlock2" class="help-block">{{ $errors->first('warish') }}</span>
                                @endif
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">নাম</th>
                                            <th scope="col">সম্পর্ক</th>
                                            <th scope="col">জন্ম তারিখ </th>
                                            <th scope="col">জাতীয় পরিচয়পত্র</th>
                                            <th scope="col">কার্যকলাপ</th>

                                        </tr>
                                    </thead>
                                    <tbody id="appendRow">
                                        @if ($olds = old('warish'))
                                            {{-- Old data after form submit  --}}
                                            @include('Warish::frontend.part.old_index', ['olds' => $olds])
                                            @php
                                                $rowNumber = lv_key_last($olds);

                                            @endphp
                                            {{-- Old data after form submit  --}}
                                        @elseif(!empty($fdata->details))
                                            {{-- Old saved data --}}
                                            @include('Warish::frontend.part.fdata_index', [
                                                'fdata' => $fdata->details,
                                            ])
                                            @php
                                                $rowNumber = $fdata->details->keys()->last() + 1;
                                            @endphp
                                            {{-- Has saved data  --}}
                                        @else
                                            @include('Warish::frontend.part.default_index', ['key' => 1])
                                        @endif


                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="6" style="text-align: right;">
                                                <button class="btn btn-info btn-sm" style="margin-top: 7px;"
                                                    onclick="append_row();" type="button">
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add More
                                                </button>
                                            </td>

                                        </tr>
                                    </tfoot>
                                </table>

                                @if (Session::has('success'))
                                    <div class="col-md-12">
                                        <div class="callout callout-success">
                                            {{ Session::get('success') }}
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="panel-footer text-center">
                                <input type="submit" class="btn btn-success btn-lg" name="submit"
                                    value="{{ !empty($fdata->id) ? 'আপডেট করুন ' : 'সাবমিট করুন ' }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    @endsection

    @section('cusjs')
        <script>
            var count = "{{ $rowNumber + 1 }}";
            count = Number(count);
            jQuery(document).ready(function($) {

                $(".date-pick").datepicker({
                    format: 'dd-mm-yyyy'
                }).val();

                // master_function();

                $(document).on('click', '.removeRow', function(e) {
                    var id = $(this).data('id');

                    $('#row-' + id).remove();

                });



            });
            $(function() {
                var pre_districtSelected = '{{ old('district') }}'
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
                            if (pre_districtSelected == item.id) {
                                $('#district').append('<option selected value="' + item
                                    .id +
                                    '" selected>' + item.name + ' - '+item.bn_name+'</option>');
                            } else {
                                $('#district').append('<option value="' + item.id +
                                    '">' + item
                                    .name + ' - '+item.bn_name+'</option>');
                            }
                        });

                        $('#district').trigger('change');
                    });

                });

                // personal address
                $('#division').trigger('change');
                var pre_subDistrictSelected = '{{ old('upazila') }}';
                $('#district').on('change', function() {
                    var district_id = $(this).val();
                    $('#upazila').html('<option value="">Select sub district</option>');
                    if (district_id != '' && district_id != null) {
                        $.ajax({
                            method: "GET",
                            url: '{{ route('get.sub_district') }}',
                            data: {
                                district_id: district_id
                            }
                        }).done(function(data) {
                            $.each(data, function(index, item) {
                                if (pre_subDistrictSelected == item.id) {
                                    $('#upazila').append('<option selected value="' +
                                        item
                                        .id +
                                        '" selected>' + item.name + ' - '+item.bn_name+'</option>');
                                } else {
                                    $('#upazila').append('<option value="' + item.id +
                                        '">' +
                                        item.name + ' - '+item.bn_name+'</option>');
                                }
                            });
                            $('#upazila').trigger('change');
                        });
                    }
                });
                $('#district').trigger('change');

                var pre_unionSelected = '{{ old('union_powrasava') }}';
                var pre_postOfficeSelected = '{{ old('post_office') }}';
                $('#upazila').on('change', function() {
                    var sub_district_id = $(this).val();
                    $('#union_powrasava').html('<option value="">Select union/powrasava</option>');
                    $('#post_office').html('<option value="">Select post office</option>');
                    if (sub_district_id != '' && sub_district_id != null) {
                        $.ajax({
                            method: "GET",
                            url: '{{ route('get.unions') }}',
                            data: {
                                sub_district_id: sub_district_id
                            }
                        }).done(function(data) {
                            $.each(data, function(index, item) {
                                if (pre_unionSelected == item.id) {
                                    $('#union_powrasava').append('<option selected value="' +
                                        item
                                        .id +
                                        '" selected>' + item.name + ' - '+item.bn_name+'</option>');
                                } else {
                                    $('#union_powrasava').append('<option value="' + item.id +
                                        '">' +
                                        item.name + ' - '+item.bn_name+'</option>');
                                }
                            });
                            $('#union_powrasava').trigger('change');
                        });
                        //Post Office
                        $.ajax({
                            method: "GET",
                            url: '{{ route('get.post-offices') }}',
                            data: {
                                sub_district_id: sub_district_id
                            }
                        }).done(function(data) {
                            $.each(data, function(index, item) {
                                if (pre_postOfficeSelected == item.id) {
                                    $('#post_office').append('<option selected value="' +
                                        item
                                        .id +
                                        '" selected>' + item.name + ' - '+item.bn_name+'</option>');
                                } else {
                                    $('#post_office').append('<option value="' + item.id +
                                        '">' +
                                        item.name + ' - '+item.bn_name+'</option>');
                                }
                            });

                        });
                    }
                });
                $('#upazila').trigger('change');
                var pre_wardSelected = '{{ old('ward') }}';
                $('#union_powrasava').on('change', function() {
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
                                if (pre_wardSelected == item.id) {
                                    $('#ward').append('<option selected value="' +
                                        item
                                        .id +
                                        '" selected>' + item.name + ' - '+item.bn_name+'</option>');
                                } else {
                                    $('#ward').append('<option value="' + item.id +
                                        '">' +
                                        item.name + ' - '+item.bn_name+'</option>');
                                }
                            });
                            $('#ward').trigger('change');
                        });
                    }
                });
                $('#union_powrasava').trigger('change');


                var pre_mohollaSelected = '{{ old('moholla') }}';
                $('#ward').on('change', function() {
                    var ward_id = $(this).val();
                    $('#moholla').html('<option value="">Select Moholla</option>');
                    if (ward_id != '' && ward_id != null) {
                        $.ajax({
                            method: "GET",
                            url: '{{ route('get.mohollas') }}',
                            data: {
                                ward_id: ward_id
                            }
                        }).done(function(data) {
                            $.each(data, function(index, item) {
                                if (pre_mohollaSelected == item.id) {
                                    $('#moholla').append('<option selected value="' +
                                        item
                                        .id +
                                        '" selected>' + item.name + ' - '+item.bn_name+'</option>');
                                } else {
                                    $('#moholla').append('<option value="' + item.id +
                                        '">' +
                                        item.name + ' - '+item.bn_name+'</option>');
                                }
                            });
                            $('#moholla').trigger('change');
                        });
                    }
                });
                $('#ward').trigger('change');

            });

            function append_row() {
                var $ = jQuery;


                let route = "{{ route('warish.ajax.rowitem') }}";
                var rows = count;
                $.ajax({
                    type: 'GET',
                    url: route,
                    data: {
                        rows: rows
                    },
                    success: function(data) {
                        console.log(data.html);
                        $('#appendRow').append(data.html);
                        count = count + 1;
                        $(".date-pick").datepicker({
                            format: 'dd-mm-yyyy'
                        }).val();

                    }
                });

            }
        </script>
    @endsection
