@extends('admin.app')
@section('title')
    {{ isset($pageTitle) ? $pageTitle : 'Trainer' }}
@endsection
@section('content')
    @include('admin.master.flash')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Trainer</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Create</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Trainer Create</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Trainer Create</h4>
                    </div>
                    <div class="card-body">
                        <form id="campaign-form" class="form-horizontal" method="post"
                              action="{{route('admin.config.trainer.store')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-12 col-md-3 col-form-label">Trainer Name</label>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="name" id="name" value="{{old('name')}}"
                                           class="form-control" placeholder="Zone name">
                                    @error('name')
                                    <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label for="example-select" class="col-12 col-md-3 col-form-label">Trainer Code</label>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="code" value="{{old('code')}}" id="code"
                                           class="form-control" placeholder="Zone code">
                                    @error('code')
                                    <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-select" class="col-12 col-md-3 col-form-label">Trainer Organization</label>
                                <div class="col-12 col-md-9">
                                    <select name="training_organization" class="form-select" id="training_organization">
                                        <option value="">Select One</option>
                                        @foreach(\App\Models\TrainerOrg::where('status',1)->get() as $org)
                                            <option value="{{$org->id}}">{{$org->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('training_organization')
                                    <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label for="example-select" class="col-12 col-md-3 col-form-label">Trainer Mail</label>
                                <div class="col-12 col-md-9">
                                    <input type="email" name="email" value="{{old('email')}}" id="email"
                                           class="form-control" placeholder="Trainer email">
                                    @error('email')
                                    <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label for="example-select" class="col-12 col-md-3 col-form-label">Trainer Designation</label>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="designation" id="designation" value="{{old('designation')}}"
                                           class="form-control" placeholder="Trainer designation">
                                    @error('designation')
                                    <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label for="example-select" class="col-12 col-md-3 col-form-label">Trainer Mobile</label>
                                <div class="col-12 col-md-9">
                                    <input type="number" name="mobile" id="mobile" value="{{old('mobile')}}"
                                           class="form-control" placeholder="Trainer mobile number">
                                    @error('mobile')
                                    <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-3">
                                <label for="example-select" class="col-12 col-md-3 col-form-label">Address</label>
                                <div class="col-12 col-md-9">
                                <textarea name="address" class="form-control" id="address" cols="10"
                                          rows="3" placeholder="Enter Trainer address">{{old('address')}}</textarea>
                                    @error('address')
                                    <div class="help-block text-danger">{{ $message }} </div>
                                    @enderror
                                </div>

                            </div>

                            {{--                                        <div class="mb-3">--}}
                            {{--                                            <label for="name" class="form-label">Status</label> <br>--}}
                            {{--                                            Active <input type="radio" name="status"--}}
                            {{--                                                          {{old('status')==1 ?'checked':''}} value="1">--}}
                            {{--                                            Inactive <input type="radio"--}}
                            {{--                                                            {{old('status')=="0" ?'checked':''}} name="status"--}}
                            {{--                                                            value="0">--}}
                            {{--                                            @error('status')--}}
                            {{--                                            <div class="help-block text-danger">{{ $message }} </div>--}}
                            {{--                                            @enderror--}}
                            {{--                                        </div>--}}

                            <div class="text-center mb-3">
                                <a href="{{route('admin.config.zone.index')}}" class="btn btn-danger">Back</a>
                                <input type="submit" class="btn btn-primary  " value="Add Zone">
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')



@endpush
