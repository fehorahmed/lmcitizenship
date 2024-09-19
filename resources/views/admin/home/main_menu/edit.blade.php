@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'Main Menu Create' }}
@endsection
@section('content')
    @include('admin.master.flash')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Main Menu</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Create</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Main Menu Create</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="card">
                    <div class="card-header bg-info ">
                        <h4 class=" text-white content-center">Main Menu Create</h4>
                    </div>
                    <div class="card-body">
                        <form id="campaign-form" class="form-horizontal" method="post"
                            action="{{ route('admin.main-menu.update',$mainMenu->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="title" class="col-12 col-md-3 col-form-label">Title</label>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="title" id="title" value="{{ old('title',$mainMenu->title) }}"
                                        class="form-control" placeholder="title">
                                    @error('title')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label for="designation" class="col-12 col-md-3 col-form-label">Menu Position</label>
                                <div class="col-12 col-md-9">
                                    <select name="position" id="position" class="form-select">
                                        <option value="">Select One</option>
                                        <option value="header" {{ old('position',$mainMenu->position) == 'header' ? 'selected' : '' }}>Header Menu
                                        </option>
                                        <option value="footer" {{ old('position',$mainMenu->position) == 'footer' ? 'selected' : '' }}>Footer Menu
                                        </option>
                                    </select>
                                    @error('position')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label for="designation" class="col-12 col-md-3 col-form-label">Menu Type</label>
                                <div class="col-12 col-md-9">
                                    <select name="type" id="type" class="form-select">
                                        <option value="">Select One</option>
                                        <option value="main" {{ old('type',$mainMenu->type) == 'main' ? 'selected' : '' }}>Main Menu
                                        </option>
                                        <option value="sub" {{ old('type',$mainMenu->type) == 'sub' ? 'selected' : '' }}>Sub Menu
                                        </option>
                                    </select>
                                    @error('type')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label for="designation" class="col-12 col-md-3 col-form-label">Main Menu Option</label>
                                <div class="col-12 col-md-9">
                                    <select name="main_menu_id" id="main_menu_id" class="form-select">
                                        <option value="">Select One</option>
                                        @foreach ($menus as $menu)
                                            <option value="{{$menu->id}}" {{ old('main_menu_id',$mainMenu->main_menu_id) == $menu->id ? 'selected' : '' }}>
                                                {{$menu->title}}</option>
                                        @endforeach

                                    </select>
                                    @error('type')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label for="url" class="col-12 col-md-3 col-form-label">URL</label>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="url" id="url" value="{{ old('url',$mainMenu->url) }}"
                                        class="form-control" placeholder="url">
                                    @error('url')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="order" class="col-12 col-md-3 col-form-label">Order</label>
                                <div class="col-12 col-md-9">
                                    <input type="number" name="order" id="order" value="{{ old('order',$mainMenu->order) }}"
                                        class="form-control" placeholder="order">
                                    @error('order')
                                        <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="content" class="col-12 col-md-3 col-form-label">Content</label>
                                <div class="col-12 col-md-9">
                                    <textarea name="content" class="form-control" id="content" cols="30" rows="5">{{old('content',$mainMenu->content) }}</textarea>
                                    @error('content')
                                        <div class="error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label for="is_active1" class="col-12 col-md-3 col-form-label">Status</label>
                                <div class="col-12 col-md-9">
                                    <input type="radio" id="is_active1" value="1"
                                        {{ old('status', $mainMenu->status ?? '') == '1' ? 'checked' : '' }} name="status">
                                    <label for="is_active1" class="form-label">
                                        Yes</label>
                                    <input type="radio" id="is_active2" value="0"
                                        {{ old('status', $mainMenu->status ?? '') == '0' ? 'checked' : '' }} name="status">
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
                                <a href="{{ route('admin.main-menu.index') }}"
                                    class="btn btn-danger">Back</a>
                                <input type="submit" class="btn btn-primary  " value="Update Content">
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
