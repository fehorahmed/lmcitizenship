@extends('backend.layout.master')

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Contact Page</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update</li>
                    </li>

                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-7 mx-auto">
            <div class="card">
                @if (Session::has('success'))
                    <div class="alert alert-success border-0 bg-success alert-dismissible fade show">
                        <div class="text-white"> {{ Session::get('success') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-success border-0 bg-danger alert-dismissible fade show">
                        <div class="text-white"> {{ Session::get('error') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card-header bg-secondary">
                    <h4 class="card-title text-white">Contact Page Update Form</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.contact-page.store') }}" enctype="multipart/form-data"
                        class="row g-3">
                        @csrf
                        <div class="col-md-12">
                            <x-input-kit type="text" label="Title" name="title" required="required"
                                value="{{ old('title', $contact->title ?? '') }}" />
                        </div>
                        <div class="col-md-12">
                            <x-input-kit type="file" label="Photo" name="photo" required="required" />
                            @if ($contact->photo)
                                <img src="{{ asset('storage/' . $contact->photo) }}" alt="" class="mt-1">
                            @endif
                        </div>
                        <div class="col-md-12">
                            <label for="text" class="form-label">Text <span class="text-danger">*</span></label>
                            <textarea name="text" id="text" class="form-control ck-editor" cols="30" rows="10">{{ old('text', $contact->text ?? '') }}</textarea>
                            @error('text')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class=" gap-3 text-end">
                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                                {{-- <button type="button" class="btn btn-light px-4">Reset</button> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
@endsection
