<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading"> Details</div>
            <div class="panel-body">



                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="name cmmone-class">নামঃ</label>
                            <input type="text" class="form-control" name="name" id="name" readonly
                                value="{{  $user->name  }}" placeholder="নাম...">
                            @if ($errors->has('name'))
                                <span id="helpBlock2" class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('father') ? ' has-error' : '' }}">
                            <label for="father" class="father cmmone-class">পিতার নামঃ </label>

                                <input type="text" class="form-control" name="father" id="father"
                                    value="{{  $user->father_name  }}" readonly
                                    placeholder="পিতার নাম...">


                            @if ($errors->has('father'))
                                <span id="helpBlock2" class="help-block">{{ $errors->first('father') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('mother') ? ' has-error' : '' }}">
                            <label for="mother" class="mother cmmone-class">স্বামী নামঃ</label>
                            <input type="text" class="form-control" name="mother" id="mother" readonly
                                value="{{ $user->mother_name }}" placeholder="মাতার নাম...">

                            @if ($errors->has('mother'))
                                <span id="helpBlock2" class="help-block">{{ $errors->first('mother') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('mother') ? ' has-error' : '' }}">
                            <label for="mother" class="mother cmmone-class">মাতার নামঃ</label>
                            <input type="text" class="form-control" name="mother" id="mother" readonly
                                value="{{ $user->mother_name }}" placeholder="মাতার নাম...">

                            @if ($errors->has('mother'))
                                <span id="helpBlock2" class="help-block">{{ $errors->first('mother') }}</span>
                            @endif
                        </div>


                        <div class="form-group {{ $errors->has('bc_no') ? ' has-error' : '' }}">
                            <label for="bc_no" class="bc_no cmmone-class">জন্ম নিবন্ধন নং</label>
                            <input type="text" class="form-control" name="bc_no" id="bc_no" readonly
                                value="{{  $user->birth_certificate_no  }}"
                                placeholder="জন্ম নিবন্ধন নং...">

                            @if ($errors->has('bc_no'))
                                <span id="helpBlock2" class="help-block">{{ $errors->first('bc_no') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('nid_no') ? ' has-error' : '' }}">
                            <label for="nid_no" class="nid_no cmmone-class">জাতীয় পরিচয় পত্র নং</label>
                            <input type="text" class="form-control" name="nid_no" id="nid_no" readonly
                                value="{{  $user->nid  }}"
                                placeholder="জাতীয় পরিচয় পত্র নং...">

                            @if ($errors->has('nid_no'))
                                <span id="helpBlock2" class="help-block">{{ $errors->first('nid_no') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="phone cmmone-class">মোবাইল নং</label>
                            <input type="text" class="form-control" name="phone" id="phone" readonly
                                value="{{  $user->phone  }}" placeholder="মোবাইল নং...">

                            @if ($errors->has('phone'))
                                <span id="helpBlock2" class="help-block">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('division') ? ' has-error' : '' }}">
                            <label for="division" class="division cmmone-class">Division</label>
                            <input type="text" class="form-control" name="division" id="division" readonly
                                value="{{ $user->perDivision->name??'' }}"
                                placeholder="division">
                        </div>
                        <div class="form-group {{ $errors->has('district') ? ' has-error' : '' }}">
                            <label for="district" class="district cmmone-class">District</label>
                            <input type="text" class="form-control" name="district" id="district" readonly
                                value="{{ $user->perDistrict->name??'' }}"
                                placeholder="district">
                        </div>
                        <div class="form-group {{ $errors->has('upazila') ? ' has-error' : '' }}">
                            <label for="upazila" class="upazila cmmone-class">Upazila</label>
                            <input type="text" class="form-control" name="upazila" id="upazila" readonly
                                value="{{ $user->perUpazila->name??'' }}"
                                placeholder="upazila">
                        </div>
                        <div class="form-group {{ $errors->has('union') ? ' has-error' : '' }}">
                            <label for="union" class="union cmmone-class">Union</label>
                            <input type="text" class="form-control" name="union" id="union" readonly
                                value="{{ $user->perUnion->name??'' }}"
                                placeholder="union">
                        </div>
                        <div class="form-group {{ $errors->has('ward') ? ' has-error' : '' }}">
                            <label for="union" class="ward cmmone-class">Ward</label>
                            <input type="text" class="form-control" name="ward" id="ward" readonly
                                value="{{ $user->perWard->name??'' }}"
                                placeholder="ward">
                        </div>
                        <div class="form-group {{ $errors->has('moholla') ? ' has-error' : '' }}">
                            <label for="moholla" class="moholla cmmone-class">Moholla</label>
                            <input type="text" class="form-control" name="moholla" id="moholla" readonly
                                value="{{ $user->perMoholla->name??'' }}"
                                placeholder="moholla">
                        </div>
                        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="address cmmone-class">Note</label>
                            <input type="text" class="form-control" name="address" id="address" readonly
                                value="{{ $user->per_address??'' }}"
                                placeholder="address">
                        </div>


                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
