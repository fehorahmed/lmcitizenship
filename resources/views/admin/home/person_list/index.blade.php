@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'Content List' }}
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

                    <h4 class="page-title">Content List</h4>
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
                                <h4>Contents</h4>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-2 content-end">
                                <a href="{{ route('admin.front-dashboard.list-of-person.create') }}"
                                    class="btn btn-primary">Add Content</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">.
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Address</th>
                                        <th>Content</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td><img src="{{ asset($data->photo) }}" alt="Uploaded Image" width="150">
                                            </td>
                                            <td>{{ $data->name ?? '' }}</td>
                                            <td>{{ $data->designation ?? '' }}</td>
                                            <td>{{ $data->address ?? '' }}</td>
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
                                                <a href="{{ route('admin.front-dashboard.list-of-person.edit', $data->id) }}"
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
