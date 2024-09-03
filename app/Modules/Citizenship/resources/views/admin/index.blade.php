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
                                <th>Digital status</th>
                                <th>স্ট্যাটাস</th>
                                <th>কার্যকলাপ</th>
                            </tr>
                            @foreach ($citizenships as $citizenship)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $citizenship->name }}</td>
                                    <td>{{ $citizenship->father }}</td>
                                    <td>{{ $citizenship->mother }}</td>
                                    <td>{{ $citizenship->moholla->name ?? '' }}</td>
                                    <td>{{ $citizenship->postOffice->name ?? '' }}</td>
                                    <td>{{ $citizenship->word->name ?? '' }}</td>
                                    <td>
                                        @if ($citizenship->digital_status)
                                            Approved

                                        @else
                                        Pending
                                        @endif
                                    </td>
                                    <td>{{ $citizenship->status ?? '' }}</td>
                                    <td>
                                        <div class="btn-group btn-xs"> <a
                                                href="{{route('admin.citizenship.details',$citizenship->id)}}"
                                                class="btn btn-info"><i class="dripicons-preview"></i> </a>
                                                <a
                                                href="{{route('profile_pdf',['uid'=>$citizenship->user_id])}}" class="btn btn-warning">
                                                <i class="dripicons-user"></i> </a></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ @$citizenships->links('pagination::bootstrap-4') }}

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
