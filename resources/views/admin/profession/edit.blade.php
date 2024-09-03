@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'Profession Create' }}
@endsection
@section('content')
    @include('admin.master.flash')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Profession</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Create</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Profession Update</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card">
                    <div class="card-header bg-info ">
                        <h4 class=" text-white content-center">Profession Update</h4>
                    </div>
                    <div class="card-body">
                        <form id="campaign-form" class="form-horizontal" method="post"
                            action="{{ route('admin.config.profession.update', $profession->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-12 col-md-3 col-form-label">Name</label>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $profession->name) }}" class="form-control"
                                        placeholder="User name">
                                    @error('name')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-12 col-md-3 col-form-label">Status</label> <br>
                                <div class="col-12 col-md-9">
                                    <label for="status1">Active</label>
                                    <input type="radio" id="status1" name="status"
                                        {{ old('status', $profession->status) == 1 ? 'checked' : '' }} value="1">
                                    <label for="status2">Inactive</label> <input id="status2" type="radio"
                                        {{ old('status', $profession->status) == '0' ? 'checked' : '' }} name="status"
                                        value="0">
                                    @error('status')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center mb-3">
                                <a href="{{ route('admin.config.profession.index') }}" class="btn btn-danger">Back</a>
                                <input type="submit" class="btn btn-primary  " value="Update Profession">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script></script>
@endpush
