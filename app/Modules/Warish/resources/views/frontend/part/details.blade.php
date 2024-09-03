<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading"> Details</div>
            <div class="panel-body">



                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="name control-label">মৃত ব্যক্তির নামঃ</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ !empty($fdata->name) ? $fdata->name : $user->name }}"
                                placeholder="মৃত ব্যক্তির নাম...">
                            @if ($errors->has('name'))
                                <span id="helpBlock2" class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('father') ? ' has-error' : '' }}">
                            <label for="father" class="father control-label">স্বামী/পিতার নামঃ </label>
                            <input type="text" class="form-control" name="father" id="father"
                                value="{{ !empty($fdata->father) ? $fdata->father : null }}"
                                placeholder="স্বামী/পিতার নাম...">

                            @if ($errors->has('father'))
                                <span id="helpBlock2" class="help-block">{{ $errors->first('father') }}</span>
                            @endif
                        </div>




                        <div class="form-group {{ $errors->has('mother') ? ' has-error' : '' }}">
                            <label for="mother" class="mother control-label">মাতার  নামঃ  </label>
                            <input type="text" class="form-control" name="mother" id="mother"
                                value="{{ !empty($fdata->mother) ? $fdata->mother : null }}"
                                placeholder="মাতার নাম...">

                            @if ($errors->has('mother'))
                                <span id="helpBlock2" class="help-block">{{ $errors->first('mother') }}</span>
                            @endif
                        </div>
                        {{-- <div class="form-group {{ $errors->has('marital_status') ? ' has-error' : '' }}">
                             <label for="mother" class="mother control-label">বৈবাহিক অবস্থা </label>
                             lv_maritaltype()

                            @if ($errors->has('marital_status'))
                                <span id="helpBlock2" class="help-block">{{ $errors->first('marital_status') }}</span>
                            @endif
                        </div> --}}
                        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="phone control-label">মোবাইল নং </label>
                            <input type="text" class="form-control" name="phone" id="phone"
                                value="{{ !empty($fdata->phone) ? $fdata->phone : null }}"
                                placeholder="মোবাইল নং...">

                            @if ($errors->has('phone'))
                                <span id="helpBlock2" class="help-block">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">



                        <div class="form-group {{ $errors->has('moholla') ? ' has-error' : '' }}">

                            <label for="moholla" class="moholla control-label">গ্রাম/মহল্লা </label>
                            <input type="text" class="form-control" name="moholla" id="moholla" readonly
                                value="{{ !empty($fdata->moholla->bn_name) ? $fdata->moholla->bn_name : $fdata->moholla->name }}"
                                placeholder="গ্রাম/মহল্লা">

                            @if ($errors->has('moholla'))
                                <span id="helpBlock2" class="help-block">{{ $errors->first('moholla') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('post_office') ? ' has-error' : '' }}">

                            <label for="post_office" class="post_office control-label">ডাকঘরঃ </label>
                            <input type="text" class="form-control" name="post_office" id="post_office" readonly
                                value="{{ !empty($fdata->postOffice->bn_name) ? $fdata->postOffice->bn_name : $fdata->postOffice->name }}"
                                placeholder="ডাকঘর...">

                            @if ($errors->has('post_office'))
                                <span id="helpBlock2" class="help-block">{{ $errors->first('post_office') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('ward_no') ? ' has-error' : '' }}">
                            <label for="ward_no" class="ward_no control-label">ওয়ার্ড নং </label>
                            <input type="text" class="form-control" name="ward_no" id="ward_no" readonly
                                value="{{ !empty($fdata->ward->bn_name) ? $fdata->ward->bn_name : $fdata->ward->name }}"
                                placeholder="ওয়ার্ড নং...">

                            @if ($errors->has('ward_no'))
                                <span id="helpBlock2" class="help-block">{{ $errors->first('ward_no') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('nid_no') ? ' has-error' : '' }}">
                           <label for="nid_no" class="nid_no control-label">জাতীয় পরিচয় পত্র নং </label>
                            <input type="text" class="form-control" name="nid_no" id="nid_no"
                                value="{{ !empty($fdata->nid_no) ? $fdata->nid_no : null }}"
                                placeholder="জাতীয় পরিচয় পত্র নং...">
                            @if ($errors->has('nid_no'))
                                <span id="helpBlock2" class="help-block">{{ $errors->first('nid_no') }}</span>
                            @endif
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
