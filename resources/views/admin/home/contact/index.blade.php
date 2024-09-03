@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'List of Contact' }}
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

                    <h4 class="page-title">List of Contact</h4>
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
                                <h4>Contacts</h4>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-2 content-end">
                                <a href="{{ route('admin.front-contact.create') }}" class="btn btn-primary">Add Contact</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>

                                        <th>Designation</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Email</th>

                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>

                                            <td>{{ $data->designation ?? '' }}</td>
                                            <td>{{ $data->address ?? '' }}</td>
                                            <td>{{ $data->phone ?? '' }}</td>
                                            <td>{{ $data->email ?? '' }}</td>
                                            <td>
                                                @if ($data->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.front-contact.edit', $data->id) }}"
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

