@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'Citizenship Setting' }}
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
                    <h4 class="page-title">Citizenship Setting</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-lg-6 col-md-6 col-sm-12">

                                    <div class="row mb-3">
                                        <label for="rate" class="col-12 col-md-12 col-form-label">Certificate
                                            value</label>
                                        <div class="col-12 col-md-12">
                                            <input type="number" name="rate" id="rate"
                                                value="{{ old('rate', $setting->rate ?? '') }}" class="form-control"
                                                placeholder="Certificate value.">
                                            @error('rate')
                                                <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <label for="dc_rate" class="col-12 col-md-12 col-form-label">Digital Center
                                            Commission</label>
                                        <div class="col-12 col-md-12">
                                            <input type="number" name="dc_rate" id="dc_rate"
                                                value="{{ old('dc_rate', $setting->dc_rate ?? '') }}" class="form-control"
                                                placeholder="Digital Center Commission">
                                            @error('dc_rate')
                                                <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="is_nid_info" class="col-12 col-md-12 col-form-label">Is Required NID or Birth Certificate
                                            Number?</label>
                                        <div class="col-12 col-md-12">
                                            <select name="is_nid_info" id="is_nid_info" class="form-select">
                                                <option value="">Select One</option>
                                                <option
                                                    {{ old('is_nid_info', $setting->is_nid_info??'') == 1 ? 'selected' : '' }}
                                                    value="1">Yes</option>
                                                <option
                                                    {{ old('is_nid_info', $setting->is_nid_info??'') == 0 ? 'selected' : '' }}
                                                    value="0">No</option>
                                            </select>
                                            @error('is_nid_info')
                                                <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="is_nid_file" class="col-12 col-md-12 col-form-label">Is Required NID or Birth Certificate
                                            File?</label>
                                        <div class="col-12 col-md-12">
                                            <select name="is_nid_file" id="is_nid_file" class="form-select">
                                                <option value="">Select One</option>
                                                <option
                                                    {{ old('is_nid_file', $setting->is_nid_file??'') == 1 ? 'selected' : '' }}
                                                    value="1">Yes</option>
                                                <option
                                                    {{ old('is_nid_file', $setting->is_nid_file??'') == 0 ? 'selected' : '' }}
                                                    value="0">No</option>
                                            </select>
                                            @error('is_nid_file')
                                                <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- <div class="row mb-3">
                                        <label for="is_citizenship_info" class="col-12 col-md-3 col-form-label">Is Required
                                            Citizenship ID Number?</label>
                                        <div class="col-12 col-md-9">
                                            <select name="is_citizenship_info" id="is_citizenship_info" class="form-select">
                                                <option value="">Select One</option>
                                                <option
                                                    {{ old('is_citizenship_info', $setting->is_citizenship_info) == 1 ? 'selected' : '' }}
                                                    value="1">Yes</option>
                                                <option
                                                    {{ old('is_citizenship_info', $setting->is_citizenship_info) == 0 ? 'selected' : '' }}
                                                    value="0">No</option>
                                            </select>
                                            @error('is_citizenship_info')
                                                <div class="help-block text-danger">{{ $message }} </div>
                                            @enderror
                                        </div>
                                    </div> --}}


                                </div>

                                <div class="col-xs-12 col-lg-6 col-md-6 col-sm-12">

                                    <div class="row mb-3">
                                        <label for="profiel_require" class="mb-2">Select Profile required field</label>
                                        @php
                                            $profiel_require = [];
                                            if (!empty($setting->profiel_require) && $setting->profiel_require) {
                                                $profiel_require = json_decode($setting->profiel_require, true);
                                                if (!$profiel_require) {
                                                    $profiel_require = [];
                                                }
                                            }

                                        @endphp
                                        <ul class="checkbox-list">

                                            @foreach (profile_field() as $key => $list)
                                                @php
                                                    $checked = in_array($key, $profiel_require) ? 'checked' : '';

                                                @endphp

                                                <li><label> <input type="checkbox" name="profiel_require[]"
                                                            value="{{ $key }}" {{ $checked }}>
                                                        {{ $list['Name'] }}
                                                    </label></li>
                                            @endforeach



                                        </ul>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xs-12 col-lg-6 col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-3">

                                                <label for="singtur_one_text"
                                                    class="col-12 col-md-12 col-form-label">Signature Name</label>
                                                <div class="col-12 col-md-12">
                                                    <textarea name="singtur_one_text" id="singtur_one_text" class="form-control" cols="30" rows="10">{{ old('singtur_two_text', $setting->singtur_one_text ?? '') }}</textarea>
                                                    @error('singtur_one_text')
                                                        <div class="help-block text-danger">{{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">

                                                <label for="singtur_one_img"
                                                    class="col-12 col-md-12 col-form-label">Signature Image link</label>
                                                <div class="col-12 col-md-12">
                                                    <input type="text" name="singtur_one_img" id="singtur_one_img"
                                                        class="form-control"
                                                        value="{{ old('singtur_one_img', $setting->singtur_one_img ?? '') }}">

                                                    @error('singtur_one_img')
                                                        <div class="help-block text-danger">{{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-xs-12 col-lg-6 col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <label for="singtur_two_text"
                                                    class="col-12 col-md-12 col-form-label">Signature Name</label>
                                                <div class="col-12 col-md-12">
                                                    <textarea name="singtur_two_text" id="singtur_two_text" class="form-control" cols="30" rows="10">{{ old('singtur_two_text', $setting->singtur_two_text ?? '') }}</textarea>
                                                    @error('singtur_two_text')
                                                        <div class="help-block text-danger">{{ $message }} </div>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="row mb-3">
                                                <label for="singtur_two_img"
                                                    class="col-12 col-md-12 col-form-label">Signature Image link</label>
                                                <div class="col-12 col-md-12">
                                                    <input type="text" name="singtur_two_img" id="singtur_two_img"
                                                        class="form-control"
                                                        value="{{ old('singtur_two_img', $setting->singtur_two_img ?? '') }}">

                                                    @error('singtur_two_img')
                                                        <div class="help-block text-danger">{{ $message }} </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>





                            <div class="form-group text-center">
                                <button class="btn btn-primary" type="submit"> Update</button>
                            </div>

                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->
        <!-- end row -->

    </div>
@endsection
@push('scripts')
    <script></script>
@endpush
