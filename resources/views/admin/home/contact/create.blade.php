@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'Contact Create' }}
@endsection
@section('content')
    @include('admin.master.flash')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Contact</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Create</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Contact Create</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="card">
                    <div class="card-header bg-info ">
                        <h4 class=" text-white content-center">Contact Create</h4>
                    </div>
                    <div class="card-body">
                        <form id="campaign-form" class="form-horizontal" method="post"
                            action="{{ route('admin.front-contact.store') }}" enctype="multipart/form-data">
                            @csrf
                            {{-- <div class="row mb-3">
                                <label for="name" class="col-12 col-md-3 col-form-label">Name</label>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        class="form-control" placeholder="name">
                                    @error('name')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div> --}}

                            <div class="row mb-3">
                                <label for="designation" class="col-12 col-md-3 col-form-label">Designation</label>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="designation" value="{{ old('designation') }}"
                                        id="designation" class="form-control" placeholder="designation">
                                    @error('designation')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label for="address" class="col-12 col-md-3 col-form-label">Address</label>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="address" id="address" value="{{ old('address') }}"
                                        class="form-control" placeholder="address">
                                    @error('address')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="phone" class="col-12 col-md-3 col-form-label">Phone</label>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                        class="form-control" placeholder="phone">
                                    @error('phone')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-12 col-md-3 col-form-label">Email</label>
                                <div class="col-12 col-md-9">
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        class="form-control" placeholder="email">
                                    @error('email')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <label for="content" class="col-12 col-md-3 col-form-label">Content</label>
                                <div class="col-12 col-md-9">
                                    <textarea name="content" class="form-control" id="content" cols="30" rows="5"></textarea>
                                    @error('content')
                                        <div class="error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label for="photo" class="col-12 col-md-3 col-form-label">Photo</label>
                                <div class="col-12 col-md-9">
                                    <input type="file" name="photo" id="photo" class="form-control">
                                    @error('photo')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div> --}}
                            <div class="row mb-3">
                                <label for="is_active1" class="col-12 col-md-3 col-form-label">Status</label>
                                <div class="col-12 col-md-9">
                                    <input type="radio" id="is_active1" value="1"
                                        {{ old('status', $setting->status ?? '') == '1' ? 'checked' : '' }} name="status">
                                    <label for="is_active1" class="form-label">
                                        Yes</label>
                                    <input type="radio" id="is_active2" value="0"
                                        {{ old('status', $setting->status ?? '') == '0' ? 'checked' : '' }} name="status">
                                    <label for="is_active2" class="form-label">
                                        No</label>
                                    @error('status')
                                        <div class="error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>



                            <div class="text-center mb-3">
                                <a href="{{ route('admin.front-contact.index') }}" class="btn btn-danger">Back</a>
                                <input type="submit" class="btn btn-primary  " value="Add Contact">
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
