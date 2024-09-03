@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'Complain View' }}
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

                            {{--                            <a href="" class="btn btn-primary ms-2 me-2"> --}}
                            {{--                                Export --}}
                            {{--                            </a> --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="page-title">User Details View</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="20%">Application Date</th>
                                        <td>{{ $user->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Father Name</th>
                                        <td>{{ $user->father_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth</th>
                                        <td>{{ $user->date_of_birth }}</td>
                                    </tr>
                                    <tr>
                                        <th>NID</th>
                                        <td>{{ $user->nid }}</td>
                                    </tr>
                                    <tr>
                                        <th>Profession</th>
                                        <td>{{ $user->profession->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Designation</th>
                                        <td>{{ $user->designation ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Office Phone</th>
                                        <td>{{ $user->off_phone ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Office Division</th>
                                        <td>{{ $user->officeDivision->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Office District</th>
                                        <td>{{ $user->officeDistrict->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Office Address</th>
                                        <td>{{ $user->off_address ?? '' }}</td>
                                    </tr>



                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th> Image</th>
                                        <td>
                                            @if ($user->profile_photo_path)
                                                <img src="{{ asset($user->profile_photo_path) }}" alt="Photo">
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="text-center">
                                            Permanent Address
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Division</th>
                                        <td>{{ $user->perDivision->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>District</th>
                                        <td>{{ $user->perDistrict->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Upazila</th>
                                        <td>{{ $user->perUpazila->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Union</th>
                                        <td>{{ $user->perUnion->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ward No</th>
                                        <td>{{ $user->per_ward_no ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{ $user->per_address ?? '' }}</td>
                                    </tr>

                                </table>
                            </div>

                        </div>
                    </div>

                </div> <!-- end card-->
            </div> <!-- end col-->

        </div>
        <!-- end row -->

    </div>
@endsection
