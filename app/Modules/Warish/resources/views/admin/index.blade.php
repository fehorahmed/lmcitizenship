@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'Moholla List' }}
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
                    <h4 class="page-title">Citizenship List</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <tr>
                                <th>ক্রঃ নং</th>
                                <th>নাম</th>
                                <th>স্বামী/পিতার নাম</th>
                                <th>মাতার নাম</th>
                                <th>গ্রাম</th>
                                <th>ডাকঘর</th>
                                <th>ওয়ার্ড নং</th>
                                <th>স্ট্যাটাস</th>
                                <th>কার্যকলাপ</th>
                            </tr>
                            @foreach ($mdata as $data)
                                <tr>
                                    <td>
                                        {{ $data->id ? $data->id : null }}
                                    </td>
                                    <td>
                                        @isset($data->user)
                                            {{ $data->user->name ? $data->user->name : '' }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset($data->user)
                                            {{ $data->user->phone }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset($data->warish)
                                            {{ $data->warish->father }}
                                        @endisset


                                    </td>

                                    <td>
                                        {{ $data->payment_method ? $data->payment_method : null }}



                                    </td>
                                    <td>
                                        {{ $data->amount ? $data->amount . ' Tk.' : null }}
                                    </td>
                                    <td>
                                        {{ $data->created_at ? date('d-M-Y', strtotime($data->created_at)) : null }}
                                    </td>
                                    <td>
                                        {{ $data->status ? $data->status : null }}
                                    </td>
                                    <td>
                                        <!-- Single button -->

                                        <div class="btn-group btn-xs">
                                            <a href="{{ route('admin.warish.details', $data->id) }}" class="btn btn-info">
                                                <i class="dripicons-preview"></i></a>

                                            <a href="{{ route('profile_pdf',['uid'=>$data->user_id]) }}" class="btn btn-warning"
                                                target="_blank">
                                                <i class="dripicons-user"></i>
                                            </a>

                                        </div>
                                    </td>


                                </tr>
                            @endforeach
                        </table>
                        {{ @$mdata->links('pagination::bootstrap-4') }}

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row -->
        <!-- end row -->

    </div>
@endsection
@push('scripts')
    <script></script>
@endpush
