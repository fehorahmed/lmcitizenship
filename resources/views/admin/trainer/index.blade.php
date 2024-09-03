@extends('admin.app')
@section('title') {{ isset($pageTitle) ? $pageTitle : 'Trainer' }} @endsection

@push('styles')
    <link href="{{asset('/')}}assets/css/vendor/buttons.bootstrap5.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <div class="d-flex">

                            <a href="{{route('admin.config.trainer.export')}}" class="btn btn-primary ms-2">
                               Export
                            </a>

                        </div>
                    </div>
                    <h4 class="page-title">Trainer List</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6"> <h4>Trainers</h4></div>
                            <div class="col-4"></div>
                            <div class="col-2 content-end">
                                <a href="{{route('admin.config.trainer.create')}}" class="btn btn-primary">Create Trainer</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Trainer Org</th>
                                <th>Designation</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->code}}</td>
                                    <td>{{$data->TrainerOrg->name}}</td>
                                    <td>{{$data->designation}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->mobile}}</td>
                                    <td>{{$data->address}}</td>
                                    <td>
                                        @if($data->status==1)
                                            <span class="btn btn-success">Active</span>
                                        @else
                                            <span class="btn btn-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('admin.config.trainer.edit',$data->id)}}" class="btn btn-primary">Edit</a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ @$datas->links('pagination::bootstrap-4') }}
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
    <script src="{{asset('/')}}assets/js/vendor/dataTables.buttons.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/buttons.bootstrap5.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/buttons.html5.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/buttons.flash.min.js"></script>
    <script src="{{asset('/')}}assets/js/vendor/buttons.print.min.js"></script>
@endpush
