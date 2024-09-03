@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'ইউনিয়ন / পৌরসভা তালিকা' }}
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
                    <h4 class="page-title">উনিয়ন/পৌরসভা তালিকা</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <form action="">
                        <div class="row">

                            <div class="col-2">
                                <select name="division" class="form-select" id="division">
                                    <option value="">Select Division</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->name }} - {{ $division->bn_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <select name="district" class="form-select" id="district">
                                    <option value="">Select District</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <button role="submit" class="btn btn-info">Search</button>
                            </div>
                            <div class="col-2">

                            </div>
                            <div class="col-2">

                            </div>
                            <div class="col-2 content-end">
                                <a href="{{ route('admin.config.union.create') }}" class="btn btn-primary">Create
                                    Powrasava</a>
                            </div>

                        </div>
                    </form>
                    </div>
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>ক্রঃ নং</th>
                                    <th>উনিয়ন/পৌরসভা</th>
                                    <th>Union/Powrasava</th>
                                    <th>উপজেলা</th>
                                    <th>জেলা</th>
                                    <th>বিভাগ</th>
                                    <th>কার্যকলাপ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unions as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->bn_name }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->upazila->bn_name }}</td>
                                        <td>{{ $data->upazila->district->bn_name }}</td>
                                        <td>{{ $data->upazila->district->division->bn_name }}</td>

                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('admin.config.union.edit', $data->id) }}">Edit</button>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ @$unions->links('pagination::bootstrap-4') }}
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
            // $('.btn-status-change').on('click', function() {
            //     var id = $(this).data('id');
            //     var result = confirm('Are you sure to change status??');
            //     if (result) {
            //         if (id != '' && id != null) {
            //             $.ajax({
            //                 method: "GET",
            //                 url: "{{ route('admin.admin.change-status') }}",
            //                 data: {
            //                     id: id
            //                 }
            //             }).done(function(response) {
            //                 if (response.success) {
            //                     alert(response.message)
            //                     location.reload();
            //                 } else {
            //                     alert(response.message);

            //                 }

            //             });
            //         } else {
            //             alert('Something went wrong. Please reload.')
            //         }
            //     }
            // })
            var districtSelected = '{{ request()->district }}'
            $('#division').on('change', function() {
                var division_id = $(this).val();
                $('#district').html('<option value="">Select district</option>');

                $.ajax({
                    method: "GET",
                    url: '{{ route('get.district') }}',
                    data: {
                        division_id: division_id
                    }
                }).done(function(data) {
                    $.each(data, function(index, item) {
                        if (districtSelected == item.id) {
                            $('#district').append('<option selected value="' + item.id +
                                '" selected>' + item.name + ' - '+item.bn_name+ '</option>');
                        } else {
                            $('#district').append('<option value="' + item.id + '">' + item
                                .name +' - '+item.bn_name+ '</option>');
                        }
                    });

                    $('#district').trigger('change');
                });

            });
            $('#division').trigger('change');

        })
    </script>
@endpush
