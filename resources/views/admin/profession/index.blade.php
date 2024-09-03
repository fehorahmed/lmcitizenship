@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'Profession List' }}
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
                    <h4 class="page-title">Profession List</h4>
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
                                <h4>Profession</h4>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-2 content-end">
                                <a href="{{ route('admin.config.profession.create') }}" class="btn btn-primary">Create
                                    Profession</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($professions as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->name }}</td>

                                        <td>
                                            @if ($data->status == 1)
                                                <span class="btn btn-success">Active</span>
                                            @else
                                                <span class="btn btn-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('admin.config.profession.edit', $data->id) }}">Edit</button>
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
