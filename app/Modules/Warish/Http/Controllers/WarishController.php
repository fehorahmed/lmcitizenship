<?php

namespace App\Modules\Warish\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Setting;
use App\Models\TransactionLog;
use App\Models\User;
use App\Modules\Warish\Models\Warish;
use App\Modules\Warish\Models\WarishApplication;
use App\Modules\Warish\Models\WarishDetail;
use App\Modules\Warish\Models\WarishSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class WarishController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Warish::welcome");
    }

    public function admin_index(Request $request)
    {

        $mdata = WarishApplication::where(['is_active' => 'Yes']);

        if ($request->status) {
            $mdata = $mdata->where(['status' => $request->status]);
        }

        $mdata = $mdata->orderby('id', 'DESC');

        if ($request->submit == 'Print') {

            //working
            $default = [];
            $data = [
                'mdata' => $mdata->get(),
                'request' => $default
            ];
            $config = [
                'format' => 'A4',
                'margin_header' => 0,
                'margin_footer' => 0,
                'margin_left' => 0,
                'margin_right' => 0


            ];
            ini_set("pcre.backtrack_limit", "10000000000000");

            $pdf = PDF::loadView('warish::pdf.aplication',  $data, [], $config);
            return $pdf->stream('taxasset.' . '.pdf');
        } else {
            $mdata = $mdata->paginate(15);
            return view('Warish::admin.index')->with([
                'mdata' => $mdata,
            ]);
        }
    }
    public function setting()
    {
        $setting = WarishSetting::first();
        return view("Warish::admin.setting", compact('setting'));
    }
    public function settingUpdate(Request $request)
    {
        $request->validate([
            "rate" => 'required|numeric',
            "dc_rate" => 'nullable|numeric',
            "singtur_one_text" => 'nullable|string',
            "singtur_one_img" => 'nullable|string',
            "singtur_two_text" => 'nullable|string',
            "singtur_two_img" => 'nullable|string',
        ]);

        $setting = WarishSetting::first();
        if (!$setting) {
            $setting = new WarishSetting();
        }
        $setting->rate = $request->rate;
        $setting->dc_rate = $request->dc_rate;
        $setting->profiel_require = json_encode($request->profiel_require);
        $setting->singtur_one_text = $request->singtur_one_text;
        $setting->singtur_one_img = $request->singtur_one_img;
        $setting->singtur_two_text = $request->singtur_two_text;
        $setting->singtur_two_img = $request->singtur_two_img;
        if ($setting->save()) {
            return redirect()->back()->with('success', 'Update successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function warishIndex()
    {
        $user = auth()->user();


        $mdata = Warish::where(['user_id' => $user->id])->with('aplication')->get();
        // dd($mdata);
        return view('Warish::frontend.index')->with([
            'mdata' => $mdata,
            'warishs' => null,
            'user' => $user,
        ]);
    }
    public function warish_add_form(Request $request)
    {


        $setting = WarishSetting::first();
        if($setting){
          $keysArray=  json_decode($setting->profiel_require);
          $dataArray=profile_field();
          $resultArray = array_intersect_key($dataArray, array_flip($keysArray));
          foreach($resultArray as $item){
            // dd($item['key']);
            $field=$item['key'];
            if(auth()->user()->$field == null || auth()->user()->$field == ''){
                return redirect()->route('user.profile.edit')->with('swal_error','Please update your profile. '.$item['Name']);
            }
          }
        }



        $user = auth()->user();
        if ($request->id) {
            $fdata = Warish::where(['user_id' => $user->id, 'id' => $request->id])->firstOrFail();
        } else {
            $fdata = null;
        }
        $divisions = Division::all();
        return view('Warish::frontend.add')->with([

            'fdata' => $fdata,
            'warishs' => null,
            'user' => $user,
            'divisions' => $divisions,
        ]);
    }

    public function warish_add(Request $request)
    {



        $request->validate([
            "id" => 'nullable|numeric',
            "application_name" => 'required|string|max:255',
            "application_relation" => 'required|string|max:255',
            "application_address" => 'required|string|max:255',
            "name" => 'required|string|max:255',
            "father" => 'required|string|max:255',
            "mother" => 'required|string|max:255',
            "death_certificate" => 'required|string|max:255',
            "qty" => 'required|numeric|max:255',
            "date_of_death" => 'required|date|max:255',
            "division" => 'required|numeric',
            "district" => 'required|numeric',
            "upazila" => 'required|numeric',
            "union_powrasava" => 'required|numeric',
            "ward" => 'required|numeric',
            "moholla" => 'required|numeric',
            "post_office" => 'required|numeric',
            "address" => 'nullable|string|max:255',
            "warish" => 'required|array',
        ]);

        //  dd($request->all());


        $id = $request->get('id');
        if ($request->user_id) {
            $user = User::findOrFail($request->user_id);
        } else {
            $user = auth()->user();
        }
        $transactionFail = false;
        DB::beginTransaction();
        try {

            if (!$id) {

                $warish = new Warish();
                $warish->user_id = $user->id;
                $warish->application_name = $request->application_name;
                $warish->application_relation = $request->application_relation;
                $warish->application_address = $request->application_address;
                $warish->name = $request->name;
                $warish->father = $request->father;
                $warish->mother = $request->mother;
                $warish->death_certificate = $request->death_certificate;
                $warish->date_of_death = Carbon::createFromFormat('d-m-Y', $request->date_of_death)->format('Y-m-d');
                $warish->qty = $request->qty;
                $warish->division_id = $request->division;
                $warish->district_id = $request->district;
                $warish->upazila_id = $request->upazila;
                $warish->union_id = $request->union_powrasava;
                $warish->ward_id = $request->ward;
                $warish->moholla_id = $request->moholla;
                $warish->post_office_id = $request->post_office;
                $warish->address = $request->address;
                $warish->create_by = auth()->id();
                if ($warish->save()) {

                    foreach ($request->warish as $key => $list) {

                        $warish_detail = new WarishDetail();
                        $warish_detail->user_id =  $user->id;
                        $warish_detail->warish_id =  $warish->id;
                        $warish_detail->name =   $list['name'];
                        $warish_detail->relation =   $list['relation'];
                        $warish_detail->birthday =   ($list['birthday']) ? date('Y-m-d', strtotime($list['birthday'])) : null;
                        $warish_detail->nid =   $list['nid'];
                        $warish_detail->sort_by = $key;
                        $warish_detail->create_by = auth()->user()->id;
                        if (!$warish_detail->save()) {
                            $transactionFail = true;
                        }
                    }
                } else {
                    $transactionFail = true;
                }


                if ($transactionFail) {
                    DB::rollBack();
                    return redirect()->back()->withInput()->with('error', 'Something went wrong.'); //myexcep
                } else {
                    DB::commit();
                    return redirect()->route('user.warish')->with('swal_success', 'Successfully save changed!');
                }
            } else {


                $warish = Warish::findOrFail($id);
                $warish->user_id = $user->id;
                $warish->application_name = $request->application_name;
                $warish->application_relation = $request->application_relation;
                $warish->application_address = $request->application_address;
                $warish->name = $request->name;
                $warish->father = $request->father;
                $warish->mother = $request->mother;
                $warish->death_certificate = $request->death_certificate;
                $warish->date_of_death = Carbon::createFromFormat('d-m-Y', $request->date_of_death)->format('Y-m-d');
                $warish->qty = $request->qty;
                $warish->division_id = $request->division;
                $warish->district_id = $request->district;
                $warish->upazila_id = $request->upazila;
                $warish->union_id = $request->union_powrasava;
                $warish->ward_id = $request->ward;
                $warish->moholla_id = $request->moholla;
                $warish->post_office_id = $request->post_office;
                $warish->address = $request->address;
                $warish->modified_by = auth()->id();
                if ($warish->save()) {
                    WarishDetail::where('warish_id', $id)->delete();
                    foreach ($request->warish as $key => $list) {

                        $warish_detail = new WarishDetail();
                        $warish_detail->user_id =  $user->id;
                        $warish_detail->warish_id =  $warish->id;
                        $warish_detail->name =   $list['name'];
                        $warish_detail->relation =   $list['relation'];
                        $warish_detail->birthday =   ($list['birthday']) ? date('Y-m-d', strtotime($list['birthday'])) : null;
                        $warish_detail->nid =   $list['nid'];
                        $warish_detail->sort_by = $key;
                        $warish_detail->create_by = auth()->user()->id;
                        if (!$warish_detail->save()) {
                            $transactionFail = true;
                        }
                    }
                } else {
                    $transactionFail = true;
                }


                if ($transactionFail) {
                    DB::rollBack();
                    return redirect()->back()->withInput()->with('error', 'Something went wrong.'); //myexcep
                } else {
                    DB::commit();
                    return redirect()->route('user.warish')->with('swal_success', 'Successfully save changed!');
                }
            }

            // return redirect()->route('warish.index')->with('swal_success', 'Successfully save changed!');
        } catch (\Illuminate\Database\QueryException $ex) {

            DB::rollBack();
            return redirect()->back()->withErrors($ex->getMessage())->with('myexcep', $ex->getMessage())->withInput();
        }
    }

    public function ajax_rowitem(Request $request)
    {
        $html = null;
        if ($request->rows) {
            $html = view('Warish::frontend.part.default_index')->with(['key' => $request->rows])->render();
        }
        return response()->json(['html' => $html]);
    }

    public function warish_apply(Request $request)
    {
        $user = auth()->user();
        $fdata = Warish::where(['user_id' => $user->id, 'id' => $request->id])->first();
        $rules = WarishSetting::first();
        //dump($user);

        return view('Warish::frontend.payment')->with([
            'fdata' => $fdata,
            'rules' => $rules,
            'user' => $user,
        ]);
    }
    public function warish_payment(Request $request)
    {

        // dd($request->all());

        $set = WarishSetting::where(['is_active' => 'Yes'])->first();


        $rules = [
            'warish_id' => 'required',
            'payment_info.payment_method' => 'required',

        ];
        $rules['payment_info.rate'] = 'required';
        $rules['payment_info.total'] = 'required';

        if ($request->payment_info['payment_method'] == 'Cash') {
            $rules['payment_info.date'] = 'required';
            $rules['payment_info.receipt_no'] = 'required';
            $rules['payment_info.serial_no'] = 'required';
        }
        if ($request->payment_info['payment_method'] == 'Nagat' || $request->payment_info['payment_method'] == 'Bkash') {
            $rules['payment_info.tid'] = 'required';
            $rules['payment_info.number'] = 'required';
            $rules['payment_info.date'] = 'required';
        }
        if ($request->payment_info['payment_method'] == 'Bank draft') {
            $rules['payment_info.bank'] = 'required';
            $rules['payment_info.branch'] = 'required';
            $rules['payment_info.date'] = 'required';
            $rules['payment_info.payorder'] = 'required';
        }
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        // dd($request->all());
        // if ($set->is_nid_file) {
        //     $rules['nid_file'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        // }
        // if ($set->is_citizenship_info) {
        //     $rules['citizenship_info'] = 'required';
        // }
        // if ($set->is_citizenship_file) {
        //     $rules['citizenship_file'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        // }
        // if ($set->is_photo_file) {
        //     $rules['photo_file'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        // }

        //$jurnal_id = $this->accountWarish($request, $id);

        $id =  $request->get('id');
        $user = auth()->user();

        $warish = Warish::where(['user_id' => $user->id, 'id' =>  $request->warish_id])->first();

        $transactionFail = false;
        DB::beginTransaction();
        try {

            $warish_app = new WarishApplication();
            $warish_app->user_id = auth()->user()->id;
            $warish_app->warish_id = $warish->id;
            $warish_app->dc_id = null;
            $warish_app->payment_method = $request->payment_info['payment_method'];
            $warish_app->payment_date = Carbon::createFromFormat('d-m-Y', $request->payment_info['date'])->format('Y-m-d');
            $warish_app->amount = $request->payment_info['total'];
            $warish_app->payment_info = json_encode($request->payment_info);
            $warish_app->rate = $request->payment_info['rate'];
            $warish_app->dc_rate = $request->payment_info['dc_rate'];
            $warish_app->nid_info = $request->get('nid_info');
            $warish_app->citizenship_info = $request->get('citizenship_info');
            $warish_app->is_active = 'Yes';
            if ($warish_app->save()) {
                $tr_log = new TransactionLog();
                $tr_log->payment_type = 'WARISH';
                $tr_log->user_id = auth()->id();
                $tr_log->date =  Carbon::createFromFormat('d-m-Y', $request->payment_info['date'])->format('Y-m-d');
                $tr_log->payment_info = json_encode($request->payment_info);
                $tr_log->amount = $request->payment_info['total'];
                $tr_log->warish_application_id = $warish_app->id;
                $tr_log->created_by = auth()->id();
                if (!$tr_log->save()) {
                    $transactionFail = true;
                }
            } else {
                $transactionFail = true;
            }
            if ($transactionFail) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Something went wrong.');
            } else {
                DB::commit();
                return redirect()->route('user.warish')->with('swal_success', 'Successfully save changed!');
            }
        } catch (\Throwable $ex) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('failed',$ex->getMessage());
        }

    }


    public function details(Request $request)
    {
        $user = auth()->user();
        $fdata = Warish::where(['user_id' => $user->id, 'id' => $request->id])->firstOrFail();
        return view('Warish::frontend.details')->with([

            'fdata' => $fdata,
            'warishs' => null,
            'user' => $user,
        ]);
    }
    public function admin_details(Request $request, $id)
    {

        $mdata = WarishApplication::findOrFail($id);
        $fdata = $mdata->warish;



        return view('Warish::admin.details')->with([
            'mdata' => $mdata,
            'fdata' => $fdata,
        ]);
    }

    public function pdf_payment(Request $request, $id)
    {

        if (auth()->check()) {
            $mdata =  WarishApplication::where(['id' => $id]);

            if (!auth()->user()->isAdmin()) {

                $mdata = $mdata->where(['user_id' => auth()->user()->id]);
            }

            $mdata = $mdata->firstOrFail();
            $settings = Setting::first();

            $default = [];
            if ($mdata) {
                $data = [
                    'mdata' => $mdata,
                    'request' => $default,
                    'settings' => $settings
                ];


                $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
                $fontDirs = $defaultConfig['fontDir'];

                $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
                $fontData = $defaultFontConfig['fontdata'];

                $mpdf = new \Mpdf\Mpdf([
                    'fontDir' => array_merge($fontDirs, [
                        public_path('fonts'),
                    ]),
                    'fontdata' => $fontData + [ // lowercase letters only in font key
                        'solaimanlipi' => [
                            'R' => 'SolaimanLipi12.ttf',
                            'useOTL' => 0xFF,
                        ]
                    ],
                    'default_font' => 'solaimanlipi'
                ]);


                $mpdf->WriteHTML(view('Warish::pdf.payment_details',  $data));
                $mpdf->Output("taxasset_payment.pdf", 'I');


                // ini_set("pcre.backtrack_limit", "10000000000000");

                // $pdf = PDF::loadView('warish::pdf.payment_details',  $data, [], $config);
                // return $pdf->stream('taxasset_payment.' . '.pdf');
            }

            return view('warish::frontend.payment_details')
                ->with(['mdata' => $mdata]);
        } else {
            return redirect()->back()->with('swal_error', 'Your going to wrong way. Please contact with Admin');
        }
    }

    public function pdf_certificate(Request $request, $id)
    {

        if (auth()->check()) {
            $mdata =  WarishApplication::where(['id' => $id, 'status' => 'Approved']);
            if (!auth()->user()->isAdmin()) {
                $mdata = $mdata->where(['user_id' => auth()->user()->id]);
            }
            $mdata = $mdata->firstOrFail();
            $fdata = $mdata->warish;
            $settings = Setting::first();
            $rules = WarishSetting::first();
            $default = [];
            if ($mdata) {
                $data = [
                    'mdata' => $mdata,
                    'rules' => $rules,
                    'fdata' => $fdata,
                    'qrcode' => null,
                    'request' => $default,
                    'settings' => $settings
                ];

                $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
                $fontDirs = $defaultConfig['fontDir'];

                $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
                $fontData = $defaultFontConfig['fontdata'];

                $mpdf = new \Mpdf\Mpdf([
                    'fontDir' => array_merge($fontDirs, [
                        public_path('fonts'),
                    ]),
                    'fontdata' => $fontData + [ // lowercase letters only in font key
                        'solaimanlipi' => [
                            'R' => 'SolaimanLipi12.ttf',
                            'useOTL' => 0xFF,
                        ]
                    ],
                    'default_font' => 'solaimanlipi',
                    'orientation' => 'L',
                    'margin_top' => 0,
                    'margin_left' => 0,
                    'margin_right' => 0,
                    'mirrorMargins' => true
                ]);


                $mpdf->WriteHTML(view('Warish::pdf.certificate',  $data));
                $mpdf->Output("warish_certificate.pdf", 'I');

                // $pdf = PDF::loadView('warish::pdf.certificate',  $data, [], $config);
                // return $pdf->stream('warish_certificate.' . '.pdf');
            }

            // return view('warish::frontend.payment_details')
            //     ->with(['mdata' => $mdata]);
        } else {
            return redirect()->back()->with('swal_error', 'Your going to wrong way. Please contact with Admin');
        }
    }
    public function pdf_certificate_2(Request $request, $id)
    {


        if (auth()->user()->role == 1) {
            $fdata = WarishApplication::where(['id' => $id, 'user_id' => auth()->id()])->first();
        } else {
            $fdata = WarishApplication::findOrFail($id);
        }

        $settings = Setting::first();
        $rules = WarishSetting::first();


        // $data['fdata'] = $citizen;
        // $data['settings'] = $settings;
        // $data['rules'] = $rules;
        $qr_code = QrCode::generate(
            'Warish ID: '.$fdata->id,
        );
        return view('Warish::pdf.certificate_2', compact('fdata', 'settings', 'rules', 'qr_code'));
    }

    public function pdf_application(Request $request, $id)
    {

        if (auth()->check()) {
            $mdata =  WarishApplication::where(['id' => $id]);

            $mdata = $mdata->firstOrFail();
            $fdata = $mdata->warish;
            $warish_items = $fdata->details;
            $rules = WarishSetting::first();
            $default = [];
            $settings = Setting::first();
            if ($mdata) {
                $data = [
                    'mdata' => $mdata,
                    'rules' => $rules,
                    'fdata' => $fdata,
                    'qrcode' => null,
                    'request' => $default,
                    'settings' => $settings
                ];

                $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
                $fontDirs = $defaultConfig['fontDir'];

                $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
                $fontData = $defaultFontConfig['fontdata'];

                $mpdf = new \Mpdf\Mpdf([
                    'fontDir' => array_merge($fontDirs, [
                        public_path('fonts'),
                    ]),
                    'fontdata' => $fontData + [ // lowercase letters only in font key
                        'solaimanlipi' => [
                            'R' => 'SolaimanLipi12.ttf',
                            'useOTL' => 0xFF,
                        ]
                    ],
                    'default_font' => 'solaimanlipi',
                    'margin_top' => 0,
                    'margin_left' => 0,
                    'margin_right' => 0,
                    'mirrorMargins' => true
                ]);


                $mpdf->WriteHTML(view('Warish::pdf.aplication',  $data));
                $mpdf->Output("warish_aplication.pdf", 'I');

                // $pdf = PDF::loadView('warish::pdf.aplication',  $data, [], $config);
                // return $pdf->stream('warish_aplication.' . '.pdf');
            }
        } else {
            return redirect()->back()->with('swal_error', 'Your going to wrong way. Please contact with Admin');
        }
    }
    public function changeStatus(Request $request)
    {

        $request->validate([
            "id" => 'required|numeric',
            "status" => 'required|string'
        ]);

        $data = WarishApplication::findOrFail($request->id);

        if ($data->status == $request->status) {
            return response([
                'status' => false,
                'message' => 'Please change status other status.'
            ]);
        }
        $data->status=$request->status;
        $data->modified_by=auth()->id();
        if ($data->update()) {
            return response([
                'status' => true,
                'message' => 'Status successfully updated.'
            ]);
        } else {
            return response([
                'status' => false,
                'message' => 'Something went wrong.'
            ]);
        }
    }

    public function makePayment()
    {
        $users = User::where('role',1)->get();
        $warish_setting = WarishSetting::first();
        return view("Warish::admin.make_payment", compact('users','warish_setting'));
    }
    public function makePaymentStore(Request $request)
    {
        $rules = [
            'user'=>'required|numeric',
            'payment_info.payment_method' => 'required|string',
            'payment_info.rate' => 'required|numeric',
            'payment_info.dc_rate' => 'required|numeric',
            'payment_info.total' => 'required|numeric',
            'payment_info.notes' => 'nullable|string|max:255',
            'payment_info.date' => 'required|date',

        ];

        if ($request->payment_info['payment_method'] == "Cash" || $request->payment_info['payment_method'] == "Bkash") {
            $rules['payment_info.receipt_no'] = 'required|string|max:255';
            $rules['payment_info.serial_no'] = 'required|string|max:255';
        }
        if ($request->payment_info['payment_method'] == "Nagat") {
            $rules['payment_info.number'] = 'required|string|max:255';
            $rules['payment_info.tid'] = 'required|string|max:255';
        }
        if ($request->payment_info['payment_method'] == "Bank draft") {
            $rules['payment_info.payorder'] = 'required|string|max:255';
            $rules['payment_info.bank'] = 'required|string|max:255';
            $rules['payment_info.branch'] = 'required|string|max:255';
        }

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }


        $setting = CitizenshipSetting::first();
        $user = User::findOrFail($request->user);
        if($setting){
          $keysArray=  json_decode($setting->profiel_require);
          $dataArray=profile_field();
          $resultArray = array_intersect_key($dataArray, array_flip($keysArray));
          foreach($resultArray as $item){
            // dd($item['key']);
            $field=$item['key'];
            if($user->$field == null || $user->$field == ''){

                return redirect()->back()->withInput()->with('error','Please update your profile. '.$item['Name']);
            }
          }
        }

        $citizen = Citizenship::where('user_id',$request->user)->first();
        if ($citizen) {
            return redirect()->back()->withInput()->with('error','Already have a certificate..');
        }


        $attributes = [
            'user_id' => $user->id,
            'dc_id' => ($request->dc_id) ? $request->dc_id : null,
            'name' => $user->name,

            'father' => $user->father_name,
            'husband' =>  null,
            'mother' =>   $user->mother_name,
            'bc_no' =>  $user->birth_certificate_no ?? null,
            'nid' =>  $user->nid,
            'division_id' =>  $user->per_division_id,
            'district_id' =>  $user->per_district_id,
            'upazila_id' =>  $user->per_sub_district_id,
            'union_id' =>  $user->per_union_id,
            'ward_id' =>  $user->per_ward_id,
            'moholla_id' =>  $user->per_moholla_id,
            'post_office_id' =>  $user->per_post_office_id,
            'address' =>  $user->per_address,

            'posting_id' => null,
            'payment_method' => $request->payment_info['payment_method'],
            'payment_date' => date('Y-m-d', strtotime($request->payment_info['date'])),
            'amount' => $request->payment_info['total'],
            'payment_info' => json_encode($request->payment_info),
            'rate' => $request->payment_info['rate'],
            'dc_rate' => $request->payment_info['dc_rate'],
            'nid_info' => $request->get('nid_info'),
            'citizenship_info' => $request->get('citizenship_info'),
            'nid_file' => null,
            'citizenship_file' => null,
            'photo_file' => null,
            'is_active' => 'No',
            'create_by' => auth()->id(),

        ];
        $transactionFail = false;
        try {
            $done =  Citizenship::create($attributes);
            if ($done) {
                $tr_log = new TransactionLog();
                $tr_log->payment_type = 'CITIZENSHIP';
                $tr_log->date =$request->payment_info['date'];
                $tr_log->user_id = auth()->id();
                $tr_log->payment_info = json_encode($request->payment_info);
                $tr_log->amount = $request->payment_info['total'];
                $tr_log->citizenship_id = $done->id;
                $tr_log->created_by = auth()->id();
                if (!$tr_log->save()) {
                    $transactionFail = true;
                }
            } else {
                $transactionFail = true;
            }
            if ($transactionFail) {
                return redirect()->back()->with('error', 'Something went wrong.');
            } else {
                return redirect()->back()->with('success', 'Successfully payment save !');
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }

    }

    public function checkCitizen(Request $request)
    {

        $request->validate([
            "user_id" => 'required|numeric',
        ]);

        $setting = CitizenshipSetting::first();
        $user = User::findOrFail($request->user_id);
        if($setting){
          $keysArray=  json_decode($setting->profiel_require);
          $dataArray=profile_field();
          $resultArray = array_intersect_key($dataArray, array_flip($keysArray));
          foreach($resultArray as $item){
            // dd($item['key']);
            $field=$item['key'];
            if($user->$field == null || $user->$field == ''){
                return response([
                    'status' => true,
                    'message' => 'Please update your profile. '.$item['Name']
                ]);

            }
          }
        }

        $citizen = Citizenship::where('user_id',$request->user_id)->first();

        if ($citizen) {
            return response([
                'status' => true,
                'message' => 'Already have a certificate..'
            ]);
        }else{
            return response([
                'status' => false,
                'message' => 'You can apply.'
            ]);
        }

    }
}
