@extends('backend.layout.master')

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">List of FeedBack</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->
    {{--    <h6 class="mb-0 text-uppercase">DataTable Example</h6> --}}
    <hr />
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
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>

                            <th>SL</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Message</th>

                            <th>Status</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name ?? '' }}</td>
                                <td>{{ $data->phone ?? '' }}</td>
                                <td>{{ $data->email ?? '' }}</td>
                                <td>{{ $data->message ?? '' }}</td>
                                <td>
                                    @if ($data->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                {{-- <td>
                                    <a href="{{ route('admin.front-contact.edit', $data->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                {{ $feedbacks->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
