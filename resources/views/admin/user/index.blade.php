@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'Complain User' }}
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

                            {{-- <a href="{{ route('admin.user.export') }}" class="btn btn-primary ms-2">
                                Export
                            </a> --}}

                        </div>
                    </div>
                    <h4 class="page-title">User List</h4>
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
                                <h4>Users</h4>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-2 content-end">
                                {{-- <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Create User</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>District</th>

                                    <th>User Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->phone }}</td>
                                        <td>{{ $data->district->name ?? '' }}</td>

                                        <td>
                                            @if ($data->role == 1)
                                                User
                                            @endif
                                            @if ($data->role == 2)
                                                Admin
                                            @endif
                                            @if ($data->role == 3)
                                                Super Admin
                                            @endif

                                        </td>
                                        <td>
                                            @if ($data->status == 1)
                                                <span class="btn btn-success">Active</span>
                                            @else
                                                <span class="btn btn-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (\Illuminate\Support\Facades\Auth::id() == $data->id)
                                                <span class="btn btn-warning">Self</span>
                                            @else

                                                <a href="{{route('admin.user.edit',$data->id)}}" class="btn btn-info">Edit</a>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->
        <!-- end row -->

    </div>
@endsection
@push('scripts')
    <!-- Datatables js -->
    <script src="{{ asset('/') }}assets/js/vendor/dataTables.buttons.min.js"></script>
    <script src="{{ asset('/') }}assets/js/vendor/buttons.bootstrap5.min.js"></script>
    <script src="{{ asset('/') }}assets/js/vendor/buttons.html5.min.js"></script>
    <script src="{{ asset('/') }}assets/js/vendor/buttons.flash.min.js"></script>
    <script src="{{ asset('/') }}assets/js/vendor/buttons.print.min.js"></script>


    <script !src="">
        $(function() {
            $('.btn-status-change').on('click', function() {
                var id = $(this).data('id');
                var result = confirm('Are you sure to change status??');
                if (result) {
                    if (id != '' && id != null) {
                        $.ajax({
                            method: "GET",
                            url: "{{ route('admin.admin.change-status') }}",
                            data: {
                                id: id
                            }
                        }).done(function(response) {
                            if (response.success) {
                                alert(response.message)
                                location.reload();
                            } else {
                                alert(response.message);

                            }

                        });
                    } else {
                        alert('Something went wrong. Please reload.')
                    }
                }
            })
        })
    </script>
@endpush
