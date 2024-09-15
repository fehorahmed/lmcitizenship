<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Division;
use App\Models\Profession;
use App\Models\Setting;
use App\Models\TransactionLog;
use App\Models\User;
use App\Modules\Citizenship\Models\Citizenship;
use App\Modules\Warish\Models\WarishApplication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Image;

class UserController extends Controller
{
    //    public function __construct()
    //    {
    //        $this->middleware(function ($request, $next) {
    //            $this->project = Auth::user()->role;
    //
    //            if ($this->project!=3){
    //                return redirect()->back()->with('error','You are not authorized.');
    //            }else{
    //                return $next($request);
    //            }
    //
    //        });
    //    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $datas = User::where('role', '!=', 1)->get();
        return view('admin.admin.index', compact('datas'));
    }
    public function registration(Request $request)
    {

        $request->validate([
            'division' => 'nullable|numeric',
            'district' => 'nullable|numeric',
            'upazila' => 'nullable|numeric',
            'union' => 'nullable|numeric',
        ]);
        $query = User::where(['registration_status' => 'Pending', 'role' => 1]);

        if ($request->division) {
            $query->where('per_division_id', $request->division);
        }
        if ($request->district) {
            $query->where('per_district_id', $request->district);
        }
        if ($request->upazila) {
            $query->where('per_sub_district_id', $request->upazila);
        }
        if ($request->union) {
            $query->where('per_union_id', $request->union);
        }


        $datas = $query->paginate();
        $divisions = Division::all();
        return view('admin.application.index', compact('datas', 'divisions'));
    }
    public function approvedUser(Request $request)
    {

        $request->validate([
            'division' => 'nullable|numeric',
            'district' => 'nullable|numeric',
            'upazila' => 'nullable|numeric',
            'union' => 'nullable|numeric',
        ]);


        $query = User::where(['registration_status' => 'Approved', 'role' => 1]);

        if ($request->division) {
            $query->where('per_division_id', $request->division);
        }
        if ($request->district) {
            $query->where('per_district_id', $request->district);
        }
        if ($request->upazila) {
            $query->where('per_sub_district_id', $request->upazila);
        }
        if ($request->union) {
            $query->where('per_union_id', $request->union);
        }

        $datas = $query->paginate();

        $divisions = Division::all();
        return view('admin.application.index', compact('datas', 'divisions'));
    }
    public function cancelledUser(Request $request)
    {

        $request->validate([
            'division' => 'nullable|numeric',
            'district' => 'nullable|numeric',
            'upazila' => 'nullable|numeric',
            'union' => 'nullable|numeric',
        ]);


        $query = User::where(['registration_status' => 'Cancel', 'role' => 1]);

        if ($request->division) {
            $query->where('per_division_id', $request->division);
        }
        if ($request->district) {
            $query->where('per_district_id', $request->district);
        }
        if ($request->upazila) {
            $query->where('per_sub_district_id', $request->upazila);
        }
        if ($request->union) {
            $query->where('per_union_id', $request->union);
        }

        $datas = $query->paginate();

        $divisions = Division::all();
        return view('admin.application.index', compact('datas', 'divisions'));
    }
    public function userView($id)
    {
        $user = User::findOrFail($id);

        return view('admin.application.view', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        return view('admin.admin.create', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|max:20|confirmed',
            'phone' => 'required|string|max:20',
            'role' => 'required|numeric',
            'division' => 'required|numeric',
            'district' => 'required|numeric',
            'sub_district' => 'required|numeric',
            "signature" => 'nullable|required_if:role,2|image|mimes:jpeg,png,jpg,gif,svg|max:100',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }


        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->phone = $request->phone;
        $data->role = $request->role;
        $data->division_id = $request->division;
        $data->district_id = $request->district;
        $data->sub_district_id = $request->sub_district;
        $data->status = 1;
        if ($request->hasFile('signature')) {
            $dest = 'signature';
            $path = saveImage($dest, $request->signature, 200, 50);
            $data->signature = $path;
        }
        $data->save();

        return redirect()->route('admin.admin.index')->with('success', 'User Successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $divisions = Division::all();
        return view('admin.admin.edit', compact('user', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|max:20|confirmed',
            'phone' => 'required|string|max:20',
            'role' => 'required|numeric',
            'division' => 'required|numeric',
            'district' => 'required|numeric',
            'sub_district' => 'required|numeric',
            "signature" => 'nullable|image|mimes:jpeg,png,jpg|max:100',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }


        $data = User::findOrFail($id);
        $data->name = $request->name;
        $data->email = $request->email;
        if ($request->password) {
            $data->password = Hash::make($request->password);
        }
        $data->phone = $request->phone;
        $data->role = $request->role;
        $data->division_id = $request->division;
        $data->district_id = $request->district;
        $data->sub_district_id = $request->sub_district;
        if ($request->hasFile('signature')) {
            deleteFile($data->signature);
            $dest = 'signature';
            $path = saveImage($dest, $request->signature, 200, 50);
            $data->signature = $path;
        }
        $data->save();

        return redirect()->route('admin.admin.index')->with('success', 'User Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeStatus(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id' => 'required|numeric'
        ]);
        if ($validate->fails()) {
            return response([
                'success' => false,
                'message' => $validate->errors()->first(),
            ]);
        }
        $data = User::find($request->id);
        if ($data->status == 1) {
            $data->status = 0;
        } elseif ($data->status == 0) {
            $data->status = 1;
        }
        $data->save();
        return response([
            'success' => true,
            'message' => 'Status change successful.',
        ]);
    }

    public function userRegistration(Request $request)
    {

        $request->validate([
            "name" => 'required|string|max:255',
            // "father_name" => 'required|string|max:255',
            "email" => 'required|email|unique:users,email',
            "phone" => 'required|numeric|unique:users,phone',
            "password" => 'required|string|min:8|confirmed',
            // "date_of_birth" => 'required|date',
            // "nid" => 'required|string|max:255',
        ]);
        //dd($request->all());
        $user = new User();
        $user->name = $request->name;
        // $user->father_name = $request->father_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        // $user->date_of_birth = $request->date_of_birth;
        if ($request->date_of_birth) {
            $user->date_of_birth =  Carbon::createFromFormat('d-m-Y', $request->date_of_birth)->format('Y-m-d');
        }
        // $user->nid = $request->nid;
        $user->role = 1;
        $user->registration_status = 'Pending';
        if ($user->save()) {
            return redirect()->route('login')->with('success', 'Registration Successfull. Please Login');
        } else {
            return redirect()->back()->withInput()->with('error', 'Something went wrong.');
        }
    }
    public function userProfile()
    {

        $user = auth()->user();
        $divisions = Division::all();
        $professions = Profession::all();
        return view('frontend.common.my_account', compact('user', 'divisions', 'professions'));
    }
    public function registrationUserStatusChange(Request $request)
    {

        $request->validate([
            'user_id' => 'required|numeric',
            'status' => 'string|max:255'
        ]);


        $user = User::findOrFail($request->user_id);
        $user->registration_status = $request->status;
        if ($user->update()) {
            return redirect()->back()->with('success', 'Status change successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    public function userProfileUpdate(Request $request)
    {

        $request->validate([
            "name" => 'required|string|max:255',
            "father_name" => 'required|string|max:255',
            "email" => 'required|string|email|max:255',
            "phone" => 'required|numeric',
            "date_of_birth" => 'required|date|max:255',
            "nid" => 'required|string|max:255',
            "permanent_division" => 'required|numeric',
            "permanent_district" => 'required|numeric',
            "permanent_upazila" => 'required|numeric',
            "permanent_union" => 'required|numeric',
            "permanent_ward" => 'required|numeric',
            "permanent_address" => 'required|string|max:255',
            "profession" => 'required|string|max:255',
            "designation" => 'required|string|max:255',
            "office_phone" => 'required|numeric',
            "office_division" => 'required|numeric',
            "office_district" => 'required|numeric',
            "office_address" => 'required|string|max:255',
            "image" => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',

        ]);
        // dd($request->all());

        $user = User::find(auth()->id());
        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->date_of_birth) {
            $user->date_of_birth =  Carbon::createFromFormat('d-m-Y', $request->date_of_birth)->format('Y-m-d');
        }
        // $user->date_of_birth = $request->date_of_birth;
        $user->nid = $request->nid;
        $user->per_division_id = $request->permanent_division;
        $user->per_district_id = $request->permanent_district;
        $user->per_sub_district_id = $request->permanent_upazila;
        $user->per_union_id = $request->permanent_union;
        $user->per_ward_no = $request->permanent_ward;
        $user->per_address = $request->permanent_address;

        $user->designation = $request->designation;
        $user->profession_id = $request->profession;
        $user->off_phone = $request->office_phone;
        $user->off_division_id = $request->office_division;
        $user->off_district_id = $request->office_district;
        $user->off_address = $request->office_address;

        if ($request->hasFile('image')) {
            $dest = 'profile_photo';
            $path = saveImage($dest, $request->image, 200, 200);
            $user->profile_photo_path = $path;
        }


        if ($user->update()) {
            return redirect()->back()->with('success', 'Your profile updated successfully.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Something went wrong.');
        }
    }

    public function apiAdminLogin(Request $request)
    {

        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response([
                'status' => false,
                'message' => $validation->messages()->first(),
            ]);
        }
        // if (Auth::attempt($credentials)) {
        //     $token = $request->user()->createToken('user-access-token')->plainTextToken;
        //     return response()->json(['token' => $token]);
        // } else {
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }

        if (
            !Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 2])
            && !Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 3])
        ) {

            return response([
                'status' => false,
                'message' => "Email or password dose not match.",
            ]);
        } else {
            $token = $request->user()->createToken('admin-access-token', ['admin'])->plainTextToken;
            return response()->json([
                'status' => true,
                'user' => new UserResource($request->user()),
                'token' => $token
            ]);
        }
    }

    public function apiUserRegistration(Request $request)
    {
        $rules = [
            "name" => 'required|string|max:255',
            "father_name" => 'required|string|max:255',
            "email" => 'required|email|unique:users,email',
            "phone" => 'required|numeric|unique:users,phone',
            "password" => 'required|string|min:8|confirmed',
            "date_of_birth" => 'required|date',
            "nid" => 'required|string|max:255',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response([
                'status' => false,
                'message' => $validation->messages()->first(),
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->date_of_birth = $request->date_of_birth;
        $user->nid = $request->nid;
        $user->role = 1;
        $user->registration_status = 'Pending';
        if ($user->save()) {
            return response([
                'status' => true,
                'message' => 'Registration success.',
            ]);
        } else {
            return response([
                'status' => false,
                'message' => 'Something went wrong.',
            ]);
        }
    }


    public function apiUserLogin(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response([
                'status' => false,
                'message' => $validation->messages()->first(),
            ]);
        }


        if (
            !Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 1])
            && !Auth::attempt(['phone' => $request->email, 'password' => $request->password, 'role' => 1])
        ) {

            return response([
                'status' => false,
                'message' => "Email or password dose not match.",
            ]);
        } else {
            $token = $request->user()->createToken('admin-access-token', ['user'])->plainTextToken;
            return response()->json([
                'status' => true,
                'user' => new UserResource($request->user()),
                'token' => $token
            ]);
        }
    }
    public function apiUserInfo(Request $request)
    {
        return new UserResource($request->user());
    }
    public function profile_edit(Request $request)
    {

        $user = Auth::user();

        $settings = Setting::first();
        $divisions = Division::all();
        //$orders_details = $this->ordersdetail->getProductBySecretKey(['user_id' => $user->id]);

        return view('frontend.common.profile_edit')
            ->with([
                'user' => $user,
                'settings' => $settings,
                'divisions' => $divisions,
                // 'posts' => $posts,
                // 'widgets' => $widgets
            ]);
    }
    public function profile_edit_update(Request $request)
    {


        $request->validate([

            "name" => 'required|string|max:255',
            "phone" => 'required|string|unique:users,phone,' . auth()->id(),
            "email" => 'email|required|max:255|unique:users,email,' . auth()->id(),
            "father_name" => 'required|string|max:255',
            "husband_name" => 'nullable|string|max:255',
            "mother_name" => 'required|string|max:255',
            "nidno" => 'nullable|required_without:birthcertificateno|string|max:255|unique:users,nid,' . auth()->id(),
            "nid_file" => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1000',

            "birthcertificateno" => 'nullable|required_without:nidno|string|max:255',
            "birth_certificate_file" => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1000',

            "gender" => 'required|string|max:255',
            "religion" => 'required|numeric',
            "marital_status" => 'required|string|max:255',
            "birthday" => 'required|date|max:255',
            "user_type" => 'required|boolean',

            "profession" => 'required|string|max:255',
            "freedomfighters" => 'required|boolean',
            "present_division" => 'required|numeric',
            "present_district" => 'required|numeric',
            "present_upazila" => 'required|numeric',
            "present_union" => 'required|numeric',
            "present_ward" => 'required|numeric',
            "present_moholla" => 'required|numeric',
            "present_post_office" => 'required|numeric',

            "present_address" => 'nullable|string|max:255',
            "permanent_division" => 'nullable|numeric',
            "permanent_district" => 'nullable|numeric',
            "permanent_upazila" => 'nullable|numeric',
            "permanent_union" => 'nullable|numeric',
            "permanent_ward" => 'nullable|numeric',
            "permanent_moholla" => 'nullable|numeric',
            "permanent_post_office" => 'nullable|string|max:255',

            "permanent_address" => 'nullable|string|max:255',
            "photo" => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd($request->all());
        $user = Auth::user();

        $data = User::find($user->id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->father_name = $request->father_name;
        $data->husband_name = $request->husband_name;
        $data->mother_name = $request->mother_name;
        $data->nid = $request->nidno;
        // $data->passportno = $request->passportno;
        $data->birth_certificate_no = $request->birthcertificateno;
        $data->gender = $request->gender;
        $data->religion = $request->religion;
        $data->marital_status = $request->marital_status;
        $data->date_of_birth = $request->birthday;
        // $data->monthly_income = $request->monthly_income;
        //  $data->yearly_income = $request->yearly_income;
        $data->profession = $request->profession;
        $data->freedomfighters = $request->freedomfighters;
        $data->division_id = $request->present_division;
        $data->district_id = $request->present_district;
        $data->sub_district_id = $request->present_upazila;
        $data->union_id = $request->present_union;
        $data->ward_id = $request->present_ward;
        $data->moholla_id = $request->present_moholla;
        $data->post_office_id = $request->present_post_office;
        $data->address = $request->present_address;
        $data->user_type = $request->user_type;

        if ($request->same_as_present) {
            $data->per_division_id = $request->present_division;
            $data->per_district_id = $request->present_district;
            $data->per_sub_district_id = $request->present_upazila;
            $data->per_union_id = $request->present_union;
            $data->per_ward_id = $request->present_ward;
            $data->per_moholla_id = $request->present_moholla;
            $data->per_post_office_id = $request->present_post_office;
            $data->per_address = $request->present_address;
        } else {
            $data->per_division_id = $request->permanent_division;
            $data->per_district_id = $request->permanent_district;
            $data->per_sub_district_id = $request->permanent_upazila;
            $data->per_union_id = $request->permanent_union;
            $data->per_ward_id = $request->permanent_ward;
            $data->per_moholla_id = $request->permanent_moholla;
            $data->per_post_office_id = $request->permanent_post_office;
            $data->per_address = $request->permanent_address;
        }

        if ($request->hasFile('photo')) {

            deleteFile($data->profile_photo_path);

            $data->profile_photo_path =  saveImage('profile_photo', $request->photo, 300, 300);
        }
        if ($request->hasFile('nid_file')) {
            deleteFile($data->nid_file);
            $data->nid_file =  saveImage('nid', $request->nid_file, 600, 400);
        }
        if ($request->hasFile('birth_certificate_file')) {
            deleteFile($data->birth_certificate_file);
            $data->birth_certificate_file =  saveImage('nid', $request->birth_certificate_file, 600, 400);
        }
        $data->save();

        return redirect()->back()->with('success', 'Profile successfully updated.');
    }


    public function myAccount()
    {
        $settings = Setting::first();


        $user = Auth::user();

        //$orders_details = $this->ordersdetail->getProductBySecretKey(['user_id' => $user->id]);



        return view('frontend.common.my_account')

            ->with([

                'user' => $user,

                'settings' => $settings,
            ]);
    }


    public function userIndex()
    {

        $datas = User::where('role', 1)->get();
        return view('admin.user.index', compact('datas'));
    }
    public function userEdit($id)
    {

        $user = User::where(['id' => $id, 'role' => 1])->first();
        return view('admin.user.edit', compact('user'));
    }
    public function userUpdate(Request $request, $id)
    {
        $request->validate([
            "name" => 'required|string|max:255',
            "email" => 'required|email',
            "password" => 'nullable|string|confirmed|max:255',
            "phone" => 'required|numeric',
        ]);
        $user = User::where(['id' => $id])->first();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        if ($user->update()) {
            return redirect()->route('admin.user.index')->with('success', 'Update Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
        // dd($request->all());


    }


    public function profile_pdf(Request $request)
    {
        $settings = Setting::first();

        if (!empty($request->get('uid'))) {
            $user = User::where('id', $request->get('uid'))->first();
        } else {
            $user = Auth::user();
        }
        $data = [
            'settings' => $settings,
            'user' => $user,
        ];

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
        $mpdf->WriteHTML(view('profile_pdf',  $data));
        $mpdf->Output("profile.pdf", 'I');
    }

    public function pending_payment(Request $request)

    {

        $user = Auth::user();

        if ($user->role == 4) {
            $ward = $user->commissioner_ward_id;
            $payment  = TransactionLog::where(function ($query) use ($ward) {
                $query->whereHas('citizen', function ($q) use ($ward) {
                    $q->where('ward_id', $ward);
                })->orWhereHas('warish', function ($q) use ($ward) {
                    $q->whereHas('warish', function ($p) use ($ward) {
                        $p->where('ward_id', $ward);
                    });
                });
            })->where(['commissioner_status' => 0])->paginate(15);
        }
        if ($user->role == 2) {
            $payment  = TransactionLog::where(['is_active' => 'No'])->paginate(15);
        }

        return view('frontend.common.pending_payment')->with([
            'user' => $user,
            'payments' => $payment

        ]);
    }

    public function pending_payment_view($id)
    {

        $data = TransactionLog::where('id', $id)->first();

        if ($data) {

            $settings = Setting::first();

            $data = [

                'settings' => $settings,

                'data' => $data

            ];
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


            $mpdf->WriteHTML(view('frontend.pdf.pending_payment_view',  $data));
            $mpdf->Output("pending_payment_view.pdf", 'I');

            //    $pdf = PDF::loadView('frontend.pdf.pending_payment_view',  $data, [], $config);

        } else {

            return redirect('/pending_payment')->with('swal_warning', 'Do not found any data!');
        }
    }
    public function payment_aprove(Request $request, $id)
    {

        $data = TransactionLog::findOrFail($id);

        // dd($model);
        try {
            if ($data->payment_type == 'CITIZENSHIP') {
                TransactionLog::where('id',  $id)->update(['is_active' => 'Yes', 'digital_status' => 1, 'digital_accept_by' => auth()->user()->id]);

                Citizenship::where('id', $data->citizenship_id)->update(['digital_status' => 1]);
            }
            if ($data->payment_type == 'WARISH') {
                TransactionLog::where('id',  $id)->update(['is_active' => 'Yes', 'digital_status' => 1, 'digital_accept_by' => auth()->user()->id]);

                WarishApplication::where('id', $data->warish_application_id)->update(['digital_status' => 1]);
            }

            return redirect()->back()->with('success', 'Successfully save changed');
        } catch (\Illuminate\Database\QueryException $ex) {

            return redirect()->back()->withErrors($ex->getMessage());
        }
    }
    public function commissioner_payment_aprove(Request $request, $id)
    {
        $data = TransactionLog::findOrFail($id);
        try {
            if ($data->payment_type == 'CITIZENSHIP') {
                TransactionLog::where('id',  $id)->update(['commissioner_status' => 1, 'commissioner_accept_by' => auth()->user()->id]);

                Citizenship::where('id', $data->citizenship_id)->update(['commissioner_status' => 1]);
            }
            if ($data->payment_type == 'WARISH') {
                TransactionLog::where('id',  $id)->update(['commissioner_status' => 1, 'commissioner_accept_by' => auth()->user()->id]);

                WarishApplication::where('id', $data->warish_application_id)->update(['commissioner_status' => 1]);
            }


            return redirect()->back()->with('success', 'Successfully save changed');
        } catch (\Illuminate\Database\QueryException $ex) {

            return redirect()->back()->withErrors($ex->getMessage());
        }
    }


    public function income_statement(Request $request)

    {

        $setting = Setting::first();

        $user = Auth::user();

        if ($user->role == 4) {
            $ward = $user->commissioner_ward_id;
            $query  = TransactionLog::where(function ($query) use ($ward) {
                $query->whereHas('citizen', function ($q) use ($ward) {
                    $q->where('ward_id', $ward);
                })->orWhereHas('warish', function ($q) use ($ward) {
                    $q->whereHas('warish', function ($p) use ($ward) {
                        $p->where('ward_id', $ward);
                    });
                });
            })->where(['commissioner_status' => 1]);
        }
        if ($user->role == 2) {
            $query  = TransactionLog::where(['is_active' => 'Yes']);
        }

        // $query = TransactionLog::where('is_active', 'Yes');
        if ($request->service) {
            $query->where('payment_type', $request->service);
        }
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        if ($request->Download) {
            // dd($request->all());
            $settings = Setting::first();
            $data['datas'] =  $datas = $query->orderBy('id', 'DESC')->get();
            $data['settings'] = $settings;
            // $data['rules'] = $rules;

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
                // 'orientation' => 'L',
                // 'margin_top' => 0,
                // 'margin_left' => 0,
                // 'margin_right' => 0,
                'mirrorMargins' => true
            ]);
            $mpdf->WriteHTML(view('admin.pdf.payments',  $data));
            $mpdf->Output("payments.pdf", 'D');
        }


        $datas = $query->orderBy('id', 'DESC')->paginate(20);

        return view('frontend.common.income_statement', compact('datas', 'user', 'setting'));
    }
}
