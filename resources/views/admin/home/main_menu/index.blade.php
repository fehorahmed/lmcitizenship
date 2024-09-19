@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'Main Menu List' }}
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

                    <h4 class="page-title">Main Menu List</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h4>Main Menus</h4>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-2 content-end">
                                <a href="{{ route('admin.main-menu.create') }}"
                                    class="btn btn-primary">Add Main Menu</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">.
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Main Menu</th>
                                        <th>URL</th>
                                        <th>Order</th>
                                        <th>Content</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>{{ $data->title ?? '' }}</td>
                                            <td>{{ $data->type ?? '' }}</td>
                                            <td>{{ $data->mainMenu->title ?? '' }}</td>
                                            <td>{{ $data->url ?? '' }}</td>
                                            <td>{{ $data->order ?? '' }}</td>
                                            <td>
                                                {{ Str::limit($data->content, 50, '...') }}
                                            </td>
                                            <td>
                                                @if ($data->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.main-menu.edit', $data->id) }}"
                                                    class="btn btn-primary btn-sm">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->
        <!-- end row -->

    </div>
@endsection
