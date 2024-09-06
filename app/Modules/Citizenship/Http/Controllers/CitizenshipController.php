<?php

namespace App\Modules\Citizenship\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\TransactionLog;
use App\Models\User;
use App\Modules\Citizenship\Models\Citizenship;
use App\Modules\Citizenship\Models\CitizenshipSetting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CitizenshipController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Citizenship::welcome");
    }
    public function index()
    {
        $citizenships = Citizenship::paginate();
        return view("Citizenship::admin.index", compact('citizenships'));
    }

    public function setting()
    {
        // dd(profile_field());
        $setting = CitizenshipSetting::first();
        return view("Citizenship::admin.setting", compact('setting'));
    }
    public function settingUpdate(Request $request)
    {
        $request->validate([
            "rate" => 'required|numeric',
            "dc_rate" => 'nullable|numeric',
            "is_nid_info" => 'required|numeric',
            "is_nid_file" => 'required|numeric',
            "is_citizenship_info" => 'nullable|numeric',
            "singtur_one_text" => 'nullable|string',
            "singtur_one_img" => 'nullable|string',
            "singtur_two_text" => 'nullable|string',
            "singtur_two_img" => 'nullable|string',
        ]);

        $setting = CitizenshipSetting::first();
        if (!$setting) {
            $setting = new CitizenshipSetting();
        }
        $setting->rate = $request->rate;
        $setting->dc_rate = $request->dc_rate;
        $setting->is_nid_info = $request->is_nid_info;
        $setting->is_nid_file = $request->is_nid_file;
        // $setting->is_citizenship_info = $request->is_citizenship_info;
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

    public function userCitizenship()
    {

        $user = auth()->user();
        $fdata = Citizenship::where(['user_id' => $user->id])->get();
        $rules = CitizenshipSetting::first();

        $setting = CitizenshipSetting::first();
        if ($setting) {
            $keysArray =  json_decode($setting->profiel_require);
            $dataArray = profile_field();
            $resultArray = array_intersect_key($dataArray, array_flip($keysArray));
            foreach ($resultArray as $item) {
                // dd($item['key']);
                $field = $item['key'];
                if (auth()->user()->$field == null || auth()->user()->$field == '') {
                    return redirect()->route('user.profile.edit')->with('swal_error', 'Please update your profile. ' . $item['Name']);
                }
            }
        }


        if (count($fdata) > 0) {
            return view('Citizenship::frontend.index')->with([
                'fdata' => $fdata,
                'rules' => $rules,
                'user' => $user,
            ]);
        } else {

            return view('Citizenship::frontend.payment')->with([
                'fdata' => $fdata,
                'rules' => $rules,
                'user' => $user,
            ]);
        }
    }
    public function citizenshipPayment(Request $request)
    {
        // dd($request->all());
        $rules = [
            'payment_info.payment_method' => 'required|string',
            'payment_info.rate' => 'required|numeric',
            'payment_info.dc_rate' => 'required|numeric',
            'payment_info.total' => 'required|numeric',
            'payment_info.notes' => 'nullable|string|max:255',
            'payment_info.date' => 'required|date',

        ];

        if ($request->payment_info['payment_method'] == "Cash" || $request->payment_info['payment_method'] == "Bkash") {
            $rules['payment_info.receipt_no'] = 'required|string|max:255';
            $rules['payment_info.serial_no'] = 'required|numeric';
        }
        if ($request->payment_info['payment_method'] == "Nagat") {
            $rules['payment_info.number'] = 'required|string|max:255';
            $rules['payment_info.tid'] = 'required|numeric';
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



        $user = User::find(auth()->id());
        $attributes = [
            'user_id' => $user->id,
            'dc_id' => ($request->dc_id) ? $request->dc_id : null,
            'name' => $user->name,

            'father' => $user->father_name,
            'husband' =>  $user->husband_name ?? null,
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
            'citizenship_file' => null,
            'photo_file' => null,
            'is_active' => 'No',
            'create_by' => auth()->id(),

        ];

        if ($request->nid_file) {
            $attributes['nid_file'] =  saveImage('nid', $request->nid_file, 600, 400);
        }
        $transactionFail = false;
        DB::beginTransaction();
        try {
            $done =  Citizenship::create($attributes);
            if ($done) {
                // DB::rollBack();
                // dd('in');
                $tr_log = new TransactionLog();
                $tr_log->payment_type = 'CITIZENSHIP';
                $tr_log->user_id = auth()->id();
                $tr_log->date =$request->payment_info['date'];
                $tr_log->payment_info = json_encode($request->payment_info);
                $tr_log->amount = $request->payment_info['total'];
                $tr_log->citizenship_id = $done->id;
                $tr_log->created_by = auth()->id();
                if (!$tr_log->save()) {
                    $transactionFail = true;
                }
            } else {

                // DB::rollBack();
                // dd('out');
                $transactionFail = true;
            }
            if ($transactionFail) {
                DB::rollBack();
                return redirect()->back()->with('failed', 'Something went wrong.');
            } else {
                DB::commit();
                return redirect()->route('user.citizenship')->with('swal_success', 'Successfully save changed!');
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function citizenshipPdfApplication($id)
    {
        if (auth()->user()->role == 1) {
            $citizen = Citizenship::where(['id' => $id, 'user_id' => auth()->id()])->first();
        } else {
            $citizen = Citizenship::findOrFail($id);
        }
        $settings = Setting::first();
        $rules = CitizenshipSetting::first();
        $data['citizen'] = $citizen;
        $data['settings'] = $settings;
        $data['rules'] = $rules;
        // $pdf = Pdf::loadView('Citizenship::pdf.aplication',  $data); //[], $config
        // return $pdf->stream('citizenship_payment.' . '.pdf');


        //Mpdf
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


        $mpdf->WriteHTML(view('Citizenship::pdf.aplication',  $data));
        $mpdf->Output("aplication.pdf", 'I');
    }
    public function citizenshipPdfPayment($id)
    {

        if (auth()->user()->role == 1) {
            $citizen = Citizenship::where(['id' => $id, 'user_id' => auth()->id()])->first();
        } else {
            $citizen = Citizenship::findOrFail($id);
        }

        $settings = Setting::first();
        $rules = CitizenshipSetting::first();


        $data['mdata'] = $citizen;
        $data['settings'] = $settings;
        $data['rules'] = $rules;

        //Mpdf
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
        $mpdf->WriteHTML(view('Citizenship::pdf.payment_details',  $data));
        $mpdf->Output("citizenship_payment.pdf", 'I');
    }
    public function citizenshipPdfCertificate($id)
    {

        if (auth()->user()->role == 1) {
            $citizen = Citizenship::where(['id' => $id, 'user_id' => auth()->id()])->first();
        } else {
            $citizen = Citizenship::findOrFail($id);
        }

        $settings = Setting::first();
        $rules = CitizenshipSetting::first();


        $data['fdata'] = $citizen;
        $data['settings'] = $settings;
        $data['rules'] = $rules;

        //Mpdf
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
        $mpdf->WriteHTML(view('Citizenship::pdf.certificate',  $data));
        $mpdf->Output("citizenship_payment.pdf", 'I');
    }
    public function citizenshipPdfCertificate2($id)
    {

        if (auth()->user()->role == 1) {
            $fdata = Citizenship::where(['id' => $id, 'user_id' => auth()->id()])->first();
        } else {
            $fdata = Citizenship::findOrFail($id);
        }

        $settings = Setting::first();
        $rules = CitizenshipSetting::first();


        // $data['fdata'] = $citizen;
        // $data['settings'] = $settings;
        // $data['rules'] = $rules;
        $qr_code = QrCode::generate(
            'Hello, World!',
        );
        return view('Citizenship::pdf.certificate_2', compact('fdata', 'settings', 'rules', 'qr_code'));
    }

    public function adminDetails($id)
    {
        $fdata = Citizenship::findOrFail($id);

        return view("Citizenship::admin.citizen_details", compact('fdata'));
    }
    public function makePayment()
    {
        $users = User::where('role', 1)->get();
        $citizen_setting = CitizenshipSetting::first();
        return view("Citizenship::admin.make_payment", compact('users', 'citizen_setting'));
    }
    public function makePaymentStore(Request $request)
    {
        $rules = [
            'user' => 'required|numeric',
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
        if ($setting) {
            $keysArray =  json_decode($setting->profiel_require);
            $dataArray = profile_field();
            $resultArray = array_intersect_key($dataArray, array_flip($keysArray));
            foreach ($resultArray as $item) {
                // dd($item['key']);
                $field = $item['key'];
                if ($user->$field == null || $user->$field == '') {

                    return redirect()->back()->withInput()->with('error', 'Please update your profile. ' . $item['Name']);
                }
            }
        }

        $citizen = Citizenship::where('user_id', $request->user)->first();
        if ($citizen) {
            return redirect()->back()->withInput()->with('error', 'Already have a certificate..');
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
                $tr_log->user_id = auth()->id();
                $tr_log->date =$request->payment_info['date'];
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
    public function changeStatus(Request $request)
    {

        $request->validate([
            "id" => 'required|numeric',
            "status" => 'required|string'
        ]);

        $citizen = Citizenship::findOrFail($request->id);

        if ($citizen->status == $request->status) {
            return response([
                'status' => false,
                'message' => 'Please change status other status.'
            ]);
        }
        $result = Citizenship::findOrFail($request->id)->update([
            'status' => $request->status,
            'modified_by' => auth()->id()
        ]);

        if ($result) {
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
    public function checkCitizen(Request $request)
    {

        $request->validate([
            "user_id" => 'required|numeric',
        ]);

        $setting = CitizenshipSetting::first();
        $user = User::findOrFail($request->user_id);
        if ($setting) {
            $keysArray =  json_decode($setting->profiel_require);
            $dataArray = profile_field();
            $resultArray = array_intersect_key($dataArray, array_flip($keysArray));
            foreach ($resultArray as $item) {
                // dd($item['key']);
                $field = $item['key'];
                if ($user->$field == null || $user->$field == '') {
                    return response([
                        'status' => true,
                        'message' => 'Please update your profile. ' . $item['Name']
                    ]);
                }
            }
        }

        $citizen = Citizenship::where('user_id', $request->user_id)->first();

        if ($citizen) {
            return response([
                'status' => true,
                'message' => 'Already have a certificate..'
            ]);
        } else {
            return response([
                'status' => false,
                'message' => 'You can apply.'
            ]);
        }
    }
}
