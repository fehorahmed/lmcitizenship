@extends('frontend.layouts.app')

@section('content')
<div class="container user_panel">
    @php
    $rowNumber = 1;
    @endphp

    <h2 class="text-center">ওয়ারিশ</h2>

    <?php
        if(Session::has('myexcep')){
            dump(Session::get('myexcep'));
        }

   ?>
    <div class="row up_bottom">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading nav">
                    @include('Warish::frontend.part.menu')
                </div>

                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>মৃত ব্যক্তির নাম </th>
                                <th>পিতা/স্বামীর নাম </th>
                                <th>সম্পর্ক</th>
                                <th>স্ট্যাটাস</th>
                                <th>আবেদনপত্র</th>
                                <th> পেমেন্ট রশিদ</th>
                                <th>ওয়ারিশ সনদ</th>
                                <th>কার্যকলাপ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mdata as $key => $data)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    {{ isset($data->name)? $data->name:null }}
                                </td>
                                <td>
                                    {{ isset($data->father)? $data->father:null }}
                                </td>
                                <td>
                                    {{ isset($data->application_relation)? e2b($data->application_relation):null }}
                                </td>

                                    {{-- @php
                                        dd($data->aplication->status);
                                    @endphp --}}
                                <td>
                                    @if($data->aplication)
                                    <a class="btn {{ btnStatus($data->aplication->status) }}" href="javascript:void(0)">
                                        {{ $data->aplication->status }}
                                    </a>
                                    @endif
                                </td>
                                <td>
                                    @if($data->aplication)
                                    <a href="{{route('warish.pdf.application', $data->aplication->id)}}" target="_blank"
                                        class="btn btn-info">
                                        <i class="fa fa-print" aria-hidden="true"></i> আবেদনপত্র
                                    </a>

                                    @endif
                                </td>
                                <td>
                                    @if($data->aplication)
                                    <a href="{{route('warish.pdf.payment', $data->aplication->id)}}" target="_blank"
                                        class="btn btn-danger">
                                        <i class="fa fa-print" aria-hidden="true"></i> পেমেন্ট রশিদ
                                    </a>
                                    @endif
                                </td>
                                <td>
                                    @if($data->aplication && $data->aplication->status == 'Approved')
                                    <a href="{{route('warish.pdf.certificate', $data->aplication->id)}}" target="_blank"
                                        class="btn btn-success">
                                        <i class="fa fa-print" aria-hidden="true"></i> ওয়ারিশ সনদ
                                    </a>
                                    @endif
                                </td>
                                <td>
                                    @if($data->aplication)
                                    <a href="{{route('user.warish.details', $data->id)}}" class="btn btn-info">
                                        Details
                                    </a>
                                    @else
                                    <a href="{{route('user.warish.form', $data->id)}}" class="btn btn-info">
                                        Edit
                                    </a>
                                    <a href="{{route('user.warish.apply', $data->id)}}" class="btn btn-success">
                                        Apply
                                    </a>

                                    @endif

                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

    @endsection

    @section('cusjs')

    @endsection
