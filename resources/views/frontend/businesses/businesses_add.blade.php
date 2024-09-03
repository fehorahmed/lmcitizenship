@extends('frontend.layouts.app')

@section('content')
<div class="container user_panel">
    <div class="well">
        @include('frontend.common.frontend_user_menu')
    </div>
    @if (Route::has('login'))
    <?php
    if (!empty(request()->get('id'))) {
        $user = \App\User::where('id', request()->get('id'))->get()->first();
        //dd($user);
    } else {
        $user = Auth::user();
    }

    //dump($user)
    ?>
    <div class="row up_bottom">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ব্যবসা সংযোজন করুন
                </div>
                <div class="panel-body">


                    <div class="">
                        {{ Form::open(array('url' => 'business_save', 'method' => 'post', 'value' => 'PATCH', 'id' => 'business')) }}

                        {{ Form::hidden('business_id', (!empty($fdata->id) ? $fdata->id : NULL), []) }}

                        <div class="">
                            <fieldset class="secti-margin">
                                <legend>
                                    ব্যবসার সাধারণ তথ্য
                                </legend>


                                <div class="row">

                                    <div class="col-xs-6">
                                        <div class="form-group required {{ ($errors->has('company_name_bn'))? 'has-error' : '' }}">
                                            {{ Form::label('company_name_bn', '  প্রতিষ্ঠানের নাম (বাংলা)  ', array('class' => 'company_name_bn cmmone-class')) }}
                                            {{ Form::text('company_name_bn', (!empty($fdata->company_name_bn) ? $fdata->company_name_bn : NULL), ['class' => 'form-control', 'placeholder' => ' প্রতিষ্ঠানের নাম (বাংলা) ']) }}

                                            @if($errors->has('company_name_bn'))
                                            <span class="help-block">{{ $errors->first('company_name_bn') }}</span>
                                            @endif
                                        </div>
                                    </div>




                                    <div class="col-xs-6">
                                        <div class="form-group required {{ ($errors->has('company_name_en'))? 'has-error' : '' }}">
                                            {{ Form::label('company_name_en', '  প্রতিষ্ঠানের নাম (ইংরেজি)  ', array('class' => 'company_name_en cmmone-class')) }}
                                            {{ Form::text('company_name_en', (!empty($fdata->company_name_en) ? $fdata->company_name_en : NULL), ['class' => 'form-control', 'placeholder' => ' প্রতিষ্ঠানের নাম (ইংরেজি) ']) }}

                                            @if($errors->has('company_name_en'))
                                            <span class="help-block">{{ $errors->first('company_name_en') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group required {{ ($errors->has('company_detail'))? 'has-error' : '' }}">
                                            {{ Form::label('company_detail', '  ব্যবসায়ের বিবরণ   ', array('class' => 'company_detail cmmone-class')) }}
                                            {{ Form::textarea('company_detail', (!empty($fdata->company_detail) ? $fdata->company_detail : NULL), ['rows' => 3, 'class' => 'form-control', 'placeholder' => ' বব্যবসায়ের বিবরণ    ']) }}

                                            @if($errors->has('company_detail'))
                                            <span class="help-block">{{ $errors->first('company_detail') }}</span>
                                            @endif
                                        </div>
                                    </div>


                                </div>



                                <div class="row">


                                </div>
                            </fieldset>

                            <fieldset class="secti-margin">
                                <legend>
                                    ঠিকানা
                                </legend>

                                <div class="row">

                                    <div class="col-xs-3">
                                        <div class="form-group required {{ ($errors->has('holding_bn'))? 'has-error' : '' }}">
                                            {{ Form::label('holding_bn', '  হোল্ডিং নং (বাংলা) ', array('class' => 'holding_bn cmmone-class')) }}
                                            {{ Form::text('holding_bn', (!empty($fdata->holding_bn) ? $fdata->holding_bn : NULL), ['class' => 'form-control', 'placeholder' => ' হোল্ডিং নং (বাংলা) ']) }}

                                            @if($errors->has('holding_bn'))
                                            <span class="help-block">{{ $errors->first('holding_bn') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group required {{ ($errors->has('holding_en'))? 'has-error' : '' }}">
                                            {{ Form::label('holding_en', '  হোল্ডিং নং (ইংরেজি) ', array('class' => 'holding_en cmmone-class')) }}
                                            {{ Form::text('holding_en', (!empty($fdata->holding_en) ? $fdata->holding_en : NULL), ['class' => 'form-control', 'placeholder' => ' হোল্ডিং নং (ইংরেজি)']) }}

                                            @if($errors->has('holding_en'))
                                            <span class="help-block">{{ $errors->first('holding_en') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group required {{ ($errors->has('address_bn'))? 'has-error' : '' }}">
                                            {{ Form::label('address_bn', '  ঠিকানা (বাংলা) ', array('class' => 'address_bn cmmone-class')) }}
                                            {{ Form::text('address_bn', (!empty($fdata->address_bn) ? $fdata->address_bn : NULL), ['class' => 'form-control', 'placeholder' => '   ঠিকানা (বাংলা)']) }}

                                            @if($errors->has('address_bn'))
                                            <span class="help-block">{{ $errors->first('address_bn') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group required {{ ($errors->has('address_en'))? 'has-error' : '' }}">
                                            {{ Form::label('address_en', '  ঠিকানা (ইংরেজি) ', array('class' => 'address_en cmmone-class')) }}
                                            {{ Form::text('address_en', (!empty($fdata->address_en) ? $fdata->address_en : NULL), ['class' => 'form-control', 'placeholder' => '  গ্রাম/মহল্লা ']) }}

                                            @if($errors->has('address_en'))
                                            <span class="help-block">{{ $errors->first('address_en') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="form-group required {{ ($errors->has('road_bn'))? 'has-error' : '' }}">
                                            {{ Form::label('road_bn', ' রোড (বাংলা)  ', array('class' => 'road_bn cmmone-class')) }}
                                            {{ Form::text('road_bn', (!empty($fdata->road_bn) ? $fdata->road_bn : NULL), ['class' => 'form-control', 'placeholder' => '  রোড (বাংলা) ']) }}

                                            @if($errors->has('road_bn'))
                                            <span class="help-block">{{ $errors->first('road_bn') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group required {{ ($errors->has('road_en'))? 'has-error' : '' }}">
                                            {{ Form::label('road_en', ' রোড (ইংরেজি)  ', array('class' => 'road_en cmmone-class')) }}
                                            {{ Form::text('road_en', (!empty($fdata->road_en) ? $fdata->road_en : NULL), ['class' => 'form-control', 'placeholder' => ' রোড (ইংরেজি)']) }}

                                            @if($errors->has('road_en'))
                                            <span class="help-block">{{ $errors->first('road_en') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group required {{ ($errors->has('zone'))? 'has-error' : '' }}">
                                            {{ Form::label('zone', ' অঞ্চল / বাজার শাখা  ', array('class' => 'zone cmmone-class')) }}
                                            {{ Form::select('zone',get_business_zone(), (!empty($fdata->zone) ? $fdata->zone : NULL), ['class' => 'form-control', 'placeholder' => '  --বাছাই করুন-- ']) }}

                                            @if($errors->has('zone'))
                                            <span class="help-block">{{ $errors->first('zone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group required {{ ($errors->has('ward'))? 'has-error' : '' }}">
                                            {{ Form::label('ward', ' ওয়ার্ড / মার্কেট  ', array('class' => 'ward cmmone-class')) }}
                                            {{ Form::select('ward',get_business_ward(), (!empty($fdata->ward) ? $fdata->ward : NULL), ['class' => 'form-control', 'placeholder' => '  --বাছাই করুন-- ']) }}
                                            @if($errors->has('ward'))
                                            <span class="help-block">{{ $errors->first('ward') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="form-group required {{ ($errors->has('area'))? 'has-error' : '' }}">
                                            {{ Form::label('area', ' ব্যবসায়ের এলাকা  ', array('class' => 'area cmmone-class')) }}
                                            {{ Form::select('area',get_business_area(), (!empty($fdata->area) ? $fdata->area : NULL), ['class' => 'form-control', 'placeholder' => '  --বাছাই করুন-- ']) }}

                                            @if($errors->has('area'))
                                            <span class="help-block">{{ $errors->first('area') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group required {{ ($errors->has('market'))? 'has-error' : '' }}">
                                            {{ Form::label('market', ' মার্কেটের নাম ', array('class' => 'market cmmone-class')) }}
                                            {{ Form::select('market',get_business_market(), (!empty($fdata->market) ? $fdata->market : NULL), ['class' => 'form-control', 'placeholder' => '  --বাছাই করুন-- ']) }}

                                            @if($errors->has('market'))
                                            <span class="help-block">{{ $errors->first('market') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group required {{ ($errors->has('floor'))? 'has-error' : '' }}">
                                            {{ Form::label('floor', ' ফ্লোর নং ', array('class' => 'floor cmmone-class')) }}
                                            {{ Form::text('floor', (!empty($fdata->floor) ? $fdata->floor : NULL), ['class' => 'form-control', 'placeholder' => '  ফ্লোর নং ']) }}

                                            @if($errors->has('floor'))
                                            <span class="help-block">{{ $errors->first('floor') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group required {{ ($errors->has('shop_no'))? 'has-error' : '' }}">
                                            {{ Form::label('shop_no', ' দোকান নং ', array('class' => 'shop_no cmmone-class')) }}
                                            {{ Form::text('shop_no', (!empty($fdata->shop_no) ? $fdata->shop_no : NULL), ['class' => 'form-control', 'placeholder' => '   দোকান নং ']) }}

                                            @if($errors->has('shop_no'))
                                            <span class="help-block">{{ $errors->first('shop_no') }}</span>
                                            @endif
                                        </div>
                                    </div>




                                </div>


                            </fieldset>


                            <fieldset class="secti-margin">
                                <legend>
                                    ব্যবসার গুরুত্বপূর্ণ তথ্য
                                </legend>
                                <div class="row">

                                    <div class="col-xs-4">
                                        <div class="form-group required {{ ($errors->has('business_start'))? 'has-error' : '' }}">
                                            {{ Form::label('business_start', ' ব্যবসা শুরুর তারিখ ', array('class' => 'business_start cmmone-class')) }}
                                            {{ Form::text('business_start', (!empty($fdata->business_start) ? $fdata->business_start : date('Y-m-d')) , ['class' => 'form-control', 'readonly']) }}

                                            @if($errors->has('business_start'))
                                            <span class="help-block">{{ $errors->first('business_start') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group required {{ ($errors->has('nature_business'))? 'has-error' : '' }}">
                                            {{ Form::label('nature_business', ' ব্যবসায়ের প্রকৃতি ', array('class' => 'nature_business cmmone-class')) }}
                                            {{ Form::select('nature_business',get_business_nature(), (!empty($fdata->nature_business) ? $fdata->nature_business : NULL), ['class' => 'form-control', 'placeholder' => '  --বাছাই করুন-- ']) }}

                                            @if($errors->has('nature_business'))
                                            <span class="help-block">{{ $errors->first('nature_business') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group required {{ ($errors->has('approved_capital'))? 'has-error' : '' }}">
                                            {{ Form::label('approved_capital', 'অনুমোদিত মূলধণ (ইংরেজি)', array('class' => 'approved_capital cmmone-class')) }}
                                            {{ Form::text('approved_capital',  (!empty($fdata->approved_capital) ? $fdata->approved_capital : NULL), ['class' => 'form-control', 'placeholder' => ' অনুমোদিত মূলধণ (ইংরেজি) ']) }}

                                            @if($errors->has('approved_capital'))
                                            <span class="help-block">{{ $errors->first('approved_capital') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="form-group required {{ ($errors->has('paid_up_capital'))? 'has-error' : '' }}">
                                            {{ Form::label('paid_up_capital', 'পরিশোধিত মূলধণ (ইংরেজি) ', array('class' => 'paid_up_capital cmmone-class')) }}
                                            {{ Form::text('paid_up_capital',  (!empty($fdata->paid_up_capital) ? $fdata->paid_up_capital : NULL), ['class' => 'form-control', 'placeholder' => ' পরিশোধিত মূলধণ (ইংরেজি)  ']) }}

                                            @if($errors->has('paid_up_capital'))
                                            <span class="help-block">{{ $errors->first('paid_up_capital') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group required {{ ($errors->has('type_business'))? 'has-error' : '' }}">
                                            {{ Form::label('type_business', ' ব্যবসায়ের ধরণ ', array('class' => 'type_business cmmone-class')) }}
                                            {{ Form::select('type_business',get_type_business(), (!empty($fdata->type_business) ? $fdata->type_business : NULL), ['class' => 'form-control', 'placeholder' => '  --বাছাই করুন-- ']) }}

                                            @if($errors->has('type_business'))
                                            <span class="help-block">{{ $errors->first('type_business') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group required {{ ($errors->has('sub_type_business'))? 'has-error' : '' }}">
                                            {{ Form::label('sub_type_business', ' বব্যবসায়ের উপ-ধরণ ', array('class' => 'sub_type_business cmmone-class')) }}
                                            {{ Form::select('sub_type_business',get_sub_type_business(), (!empty($fdata->sub_type_business) ? $fdata->sub_type_business : NULL), ['class' => 'form-control', 'placeholder' => '  --বাছাই করুন-- ']) }}

                                            @if($errors->has('company_detail'))
                                            <span class="help-block">{{ $errors->first('sub_type_business') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">


                                    <div class="col-xs-8">
                                        <div class="form-group required {{ ($errors->has('selected_businesses'))? 'has-error' : '' }}">
                                            {{ Form::label('selected_businesses', ' বাছাইকৃত ব্যবসায় সমূহ  ', array('class' => 'en_ward cmmone-class')) }}
                                            {{ Form::text('selected_businesses',  (!empty($fdata->selected_businesses) ? $fdata->selected_businesses : NULL), ['class' => 'form-control', 'readonly']) }}

                                            @if($errors->has('selected_businesses'))
                                            <span class="help-block">{{ $errors->first('selected_businesses') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-4">


                                        <div class="form-group required {{ ($errors->has('signboard_width') || $errors->has('signboard_height'))? 'has-error' : '' }}">
                                            {{ Form::label('signboard_width', 'সাইনবোর্ড (ফিট-ইংরেজি) ', array('class' => 'cmmone-class')) }}

                                            <div class="input-group">
                                                <div class="input-group-addon">দৈর্ঘ্য</div>
                                                {{ Form::text('signboard_height',  (!empty($fdata->signboard_height) ? $fdata->signboard_height : NULL), ['class' => 'form-control', 'placeholder' => ' দৈর্ঘ্য (ইংরেজি) ']) }}
                                                <div class="input-group-addon">প্রস্থ</div>
                                                {{ Form::text('signboard_width',  (!empty($fdata->signboard_width) ? $fdata->signboard_width : NULL), ['class' => 'form-control', 'placeholder' => ' প্রস্থ (ইংরেজি) ']) }}
                                            </div>
                                            @if($errors->has('signboard_width'))
                                            <span class="help-block">{{ $errors->first('signboard_width') }}</span>
                                            @endif
                                            @if($errors->has('signboard_height'))
                                            <span class="help-block">{{ $errors->first('signboard_height') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <a href="javascript:void(0)" onclick="aaFee()" class="btn btn-success"> যোগ করুন </a>
                                        <a href="javascript:void(0)" onclick="removeFee()" class="btn btn-danger"> মুছে ফেলুন </a>
                                    </div>
                                </div>

                                <div class="row" id="tablefees">
                                    <div class="col-xs-12">
                                        <div class="form-group required {{ ($errors->has('company_name_en'))? 'has-error' : '' }}">
                                            {{ Form::label('en_ward', 'সাম্ভাব্য ফিস', array('class' => 'en_ward cmmone-class')) }}
                                            <table class="table table-bordered" cellspacing="0">
                                                <tbody>
                                                    <tr class="Grid" style="background: #42cca2;">
                                                        <th scope="col">নং</th>
                                                        <th scope="col">ফিস</th>
                                                        <th scope="col">পরিমান</th>
                                                    </tr>
                                                    <tr class="GridRow">
                                                        <td>১</td>
                                                        <td>আবেদন ফিস</td>
                                                        <td class="Grid">
                                                            <span id="view_application_fee">50</span>
                                                            {{ Form::hidden('application_fee',  NULL, ['id' => 'application_fee']) }}

                                                        </td>
                                                    </tr>
                                                    <tr class="GridRow">
                                                        <td>২</td>
                                                        <td>লাইসেন্স ফিস</td>
                                                        <td class="Grid">
                                                            <span id="view_license_fee">1500</span>
                                                            {{ Form::hidden('license_fee',  NULL, ['id' => 'license_fee']) }}
                                                        </td>
                                                    </tr>
                                                    <tr class="GridRow">
                                                        <td>৩</td>
                                                        <td>সাইনবোর্ড ফিস</td>
                                                        <td class="Grid">
                                                            <span id="v_signboard_fees">1600</span>
                                                            {{ Form::hidden('signboard_fees',  NULL, ['id' => 'signboard_fees']) }}
                                                        </td>
                                                    </tr>
                                                    <tr class="GridRow">
                                                        <td>৪</td>
                                                        <td>ভ্যাট পূর্ববর্তী মোট টাকা</td>
                                                        <td class="Grid">
                                                            <span id="view_previous_total_amount_vat">3150</span>
                                                            {{ Form::hidden('previous_total_amount_vat',  NULL, ['id' => 'previous_total_amount_vat']) }}
                                                        </td>
                                                    </tr>
                                                    <tr class="GridRow">
                                                        <td>৫</td>
                                                        <td>ভ্যাট (<span id="v_vat"></span>)</td>
                                                        <td class="Grid">
                                                            <span id="view_vat_fee">473</span>
                                                            {{ Form::hidden('vat',  NULL, ['id' => 'vat']) }}
                                                            {{ Form::hidden('vat_fee',  NULL, ['id' => 'vat_fee']) }}
                                                        </td>
                                                    </tr>
                                                    <tr class="GridRow">
                                                        <td>৬</td>
                                                        <td>সার্ভিস চার্জ</td>
                                                        <td class="Grid">
                                                            <span id="view_service_charge">20</span>
                                                            {{ Form::hidden('service_charge',  NULL, ['id' => 'service_charge']) }}
                                                        </td>
                                                    </tr>
                                                    <tr class="GridRow">
                                                        <td>৭</td>
                                                        <td>মোট ফিস (টাকা)</td>
                                                        <td class="Grid">
                                                            <span id="view_grand_total">3643</span>
                                                            {{ Form::hidden('grand_total',  NULL, ['id' => 'grand_total']) }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                </div>



                            </fieldset>
                            <fieldset class="secti-margin">
                                <legend>
                                    অনুসন্ধান
                                </legend>
                                <div class="row">

                                    <div class="col-xs-4">
                                        <div class="form-group required {{ ($errors->has('is_factory'))? 'has-error' : '' }}">
                                            {{ Form::label('is_factory', ' কারখানা কি না ? ', array('class' => 'is_factory cmmone-class')) }}
                                            {{ Form::select('is_factory',['Yes' => 'হ্যা', 'No' => 'না'], (!empty($fdata->is_factory) ? $fdata->is_factory : NULL), ['class' => 'form-control', 'placeholder' => '  --বাছাই করুন-- ']) }}

                                            @if($errors->has('is_factory'))
                                            <span class="help-block">{{ $errors->first('is_factory') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group required {{ ($errors->has('is_chemical_explosive'))? 'has-error' : '' }}">
                                            {{ Form::label('is_chemical_explosive', 'রাসায়নিক / বিস্ফোরক ? ', array('class' => 'is_chemical_explosive cmmone-class')) }}
                                            {{ Form::select('is_chemical_explosive',['Yes' => 'হ্যা', 'No' => 'না'], (!empty($fdata->is_chemical_explosive) ? $fdata->is_chemical_explosive : NULL), ['class' => 'form-control', 'placeholder' => '  --বাছাই করুন-- ']) }}

                                            @if($errors->has('is_chemical_explosive'))
                                            <span class="help-block">{{ $errors->first('is_chemical_explosive') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group required {{ ($errors->has('plot_type'))? 'has-error' : '' }}">
                                            {{ Form::label('plot_type', ' প্লটের প্রকার ?', array('class' => 'plot_type cmmone-class')) }}
                                            {{ Form::select('plot_type',['Private' => 'বেসরকারী', 'Official' => 'সরকারী'], (!empty($fdata->plot_type) ? $fdata->plot_type : NULL), ['class' => 'form-control', 'placeholder' => '  --বাছাই করুন-- ']) }}

                                            @if($errors->has('plot_type'))
                                            <span class="help-block">{{ $errors->first('plot_type') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group required {{ ($errors->has('type_plot'))? 'has-error' : '' }}">
                                            {{ Form::label('type_plot', ' প্লটের ধরণ ?  ', array('class' => 'type_plot cmmone-class')) }}
                                            {{ Form::select('type_plot',['Residential' => 'আবাসিক', 'Commercial' => 'বাণিজ্যিক'], (!empty($fdata->type_plot) ? $fdata->type_plot : NULL), ['class' => 'form-control', 'placeholder' => '  --বাছাই করুন-- ']) }}

                                            @if($errors->has('type_plot'))
                                            <span class="help-block">{{ $errors->first('type_plot') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group required {{ ($errors->has('place_business'))? 'has-error' : '' }}">
                                            {{ Form::label('place_business', ' ব্যবসায়ের স্থান  ', array('class' => 'place_business cmmone-class')) }}
                                            {{ Form::select('place_business',['Rent' => 'ভাড়া', 'Own' => 'নিজস্ব'], (!empty($fdata->place_business) ? $fdata->place_business : NULL), ['class' => 'form-control', 'placeholder' => '  --বাছাই করুন-- ']) }}

                                            @if($errors->has('place_business'))
                                            <span class="help-block">{{ $errors->first('place_business') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group required {{ ($errors->has('types_activities'))? 'has-error' : '' }}">
                                            {{ Form::label('types_activities', ' কার্যক্রমের ধরণ  ', array('class' => 'types_activities cmmone-class')) }}
                                            {{ Form::select('types_activities',['Other' => 'অন্যান্য', 'Retail' => 'খুচরা', 'Wholesale' => 'পাইকারি'], (!empty($fdata->types_activities) ? $fdata->types_activities : NULL), ['class' => 'form-control', 'placeholder' => '  --বাছাই করুন-- ']) }}

                                            @if($errors->has('types_activities'))
                                            <span class="help-block">{{ $errors->first('types_activities') }}</span>
                                            @endif
                                        </div>
                                    </div>



                                </div>



                            </fieldset>

                        </div>

                        <a href="{{ url('business') }}" class="btn btn-default">
                            বাতিল করুন
                        </a>

                        {{ Form::submit(' যোগ করুন ', ['class' => 'btn btn-success', 'name' => 'submit']) }}

                        {{ Form::close() }}
                    </div>



                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection

@section('cusjs')
<style>
    .form-group.required label:after {
        content: "*";
        color: red;
    }

    .input-group .form-control {
        margin-top: 0;
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
    }
</style>
<link rel="stylesheet" href="{{ URL::asset('public/css/dropzone.min.css') }}">
<script>
    jQuery(document).ready(function($) {
        $.noConflict();
        $("#tablefees").hide();
        calFees()

        $(document).on('change', 'select[name=nature_business]', function(e) {
            calFees();

        });

        $(document).on('change', 'select[name=zone]', function(e) {
            let market_branche = $(this).val();
            let need = 'ward_market';
            jQuery.ajax({
                url: baseurl + '/get_merchandises_ajax',
                method: 'get',
                data: {
                    market_branche: market_branche,
                    need: need
                },
                success: function(data) {
                    $('#ward').html(data);
                    // console.log(data);
                },
                error: function() {}
            });


        });

        $(document).on('change', 'select[name=ward]', function(e) {
            let ward_market = $(this).val();
            let need = 'business_area';
            jQuery.ajax({
                url: baseurl + '/get_merchandises_ajax',
                method: 'get',
                data: {
                    ward_market: ward_market,
                    need: need
                },
                success: function(data) {
                    $('#area').html(data);
                    // console.log(data);
                },
                error: function() {}
            });


        });
        $(document).on('change', 'select[name=area]', function(e) {
            let business_area = $(this).val();
            let need = 'market_name';
            jQuery.ajax({
                url: baseurl + '/get_merchandises_ajax',
                method: 'get',
                data: {
                    business_area: business_area,
                    need: need
                },
                success: function(data) {
                    $('#market').html(data);
                    // console.log(data);
                },
                error: function() {}
            });


        });

        $(document).on('change', 'select[name=type_business]', function(e) {
            let type_business = $(this).val();

            jQuery.ajax({
                url: baseurl + '/sub_type_business_ajax',
                method: 'get',
                data: {
                    type_business: type_business,

                },
                success: function(data) {
                    $('#sub_type_business').html(data);
                    // console.log(data);
                },
                error: function() {}
            });


        });


    });



    function aaFee() {
        let nature_business = jQuery('#nature_business').val();
        let paid_up_capital = jQuery('#paid_up_capital').val();
        let sub_type_business = jQuery('#sub_type_business').val();

        let selected_businesses = jQuery('#selected_businesses').val();


        // alert(paid_up_capital);
        if (nature_business && paid_up_capital) {
            if (selected_businesses) {
                jQuery('#selected_businesses').val((selected_businesses + ',' + sub_type_business));

            } else {
                jQuery('#selected_businesses').val(sub_type_business);
            }
            calFees();
            jQuery("#tablefees").show();
        }


    }

    function removeFee() {
        jQuery('#selected_businesses').val('');
        jQuery("#tablefees").hide();
    }

    function calFees() {

        let application_fee = '';
        let license_fee = '';
        let signboard_fees = '';
        let previous_total_amount_vat = '';
        let vat = '';
        let vat_fee = '';
        let service_charge = '';
        let grand_total = '';


        let s_width = jQuery("input[name=signboard_width]").val();
        let s_heigh = jQuery("input[name=signboard_height]").val();
        let paid_up_capital = jQuery("input[name=paid_up_capital]").val();
        let nature_business = jQuery("select[name=nature_business]").val();


        jQuery.ajax({
            url: baseurl + '/get_business_fee',
            method: 'get',
            data: {
                nature_business: nature_business,
                paid_up_capital: paid_up_capital
            },
            success: function(data) {

                application_fee = data.application_fees;
                license_fee = data.lincense;
                vat = data.license_vat;
                signboard_fees = (parseFloat(s_width) * parseFloat(s_heigh) * parseFloat(data.signboard_fees));

                previous_total_amount_vat = application_fee + license_fee + signboard_fees;

                vat_fee = ((previous_total_amount_vat * data.license_vat) / 100);

                service_charge = data.service_charge;

                grand_total = previous_total_amount_vat + vat_fee + service_charge;

                jQuery('#view_application_fee').html(application_fee + ' টাকা');
                jQuery('#application_fee').val(application_fee);

                jQuery('#view_license_fee').html(license_fee + ' টাকা');
                jQuery('#license_fee').val(license_fee);

                jQuery('#v_signboard_fees').html(signboard_fees + ' টাকা ');
                jQuery('#signboard_fees').val(signboard_fees);

                jQuery('#view_previous_total_amount_vat').html(previous_total_amount_vat + ' টাকা ');
                jQuery('#previous_total_amount_vat').val(previous_total_amount_vat);

                jQuery('#v_vat').html(vat + '% ');
                jQuery('#vat').val(vat);

                jQuery('#view_vat_fee').html(vat_fee + ' টাকা ');
                jQuery('#vat_fee').val(vat_fee);

                jQuery('#view_service_charge').html(service_charge + ' টাকা ');
                jQuery('#service_charge').val(service_charge);

                jQuery('#view_grand_total').html(grand_total + ' টাকা ');
                jQuery('#grand_total').val(grand_total);
                console.log(data);

            },
            error: function() {}
        });

    }
</script>
@endsection