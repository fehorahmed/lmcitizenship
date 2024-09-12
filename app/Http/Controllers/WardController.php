<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wards = Ward::paginate();

        return view('admin.ward.index', compact('wards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        return view('admin.ward.create', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "division" => 'required|numeric',
            "district" => 'required|numeric',
            "sub_district" => 'required|numeric',
            "union" => 'required|numeric',
            "name" => 'required|string|max:255',
            "bn_name" => 'required|string|max:255',
            "commissioner_name" => 'required|string|max:255',
            "commissioner_phone" => 'required|numeric',
            "commissioner_email" => 'required|email',
            "commissioner_signature" => 'nullable|image|max:100',
            "password" => 'required|string|confirmed|min:6|max:20',
        ]);
        $u_ck = User::where('email', $request->commissioner_email)->first();
        $p_ck = User::where('phone', $request->commissioner_phone)->first();
        if ($u_ck) {
            return redirect()->back()->withInput()->with('error', 'Email already present.');
        }
        if ($p_ck) {
            return redirect()->back()->withInput()->with('error', 'Phone number already present.');
        }
        $data = new Ward();
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->commissioner_name = $request->commissioner_name;
        $data->commissioner_phone = $request->commissioner_phone;
        $data->union_id = $request->union;

        if ($request->commissioner_signature) {
            $data->commissioner_signature =  saveImage('signature', $request->commissioner_signature, 200, 50);
        }
        if ($data->save()) {

            $user = User::where('commissioner_ward_id', $data->id)->first();
            if (!$user) {
                $user = new User();
                $user->role = 4;
            }

            $user->name = $request->commissioner_name;
            $user->phone = $request->commissioner_phone;
            $user->email = $request->commissioner_email;
            $user->signature = $data->commissioner_signature;
            $user->commissioner_ward_id = $data->id;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();




            return redirect()->route('admin.config.ward.index')->with('success', 'Ward created successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function show(Ward $ward)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function edit(Ward $ward)
    {
        $divisions = Division::all();
        return view('admin.ward.edit', compact('ward', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ward $ward)
    {
        $request->validate([
            "division" => 'required|numeric',
            "district" => 'required|numeric',
            "sub_district" => 'required|numeric',
            "union" => 'required|numeric',
            "name" => 'required|string|max:255',
            "bn_name" => 'required|string|max:255',
            "commissioner_name" => 'required|string|max:255',
            "commissioner_phone" => 'required|numeric',
            "commissioner_email" => 'required|email',
            "commissioner_signature" => 'nullable|image|max:100',
            "password" => 'nullable|string|confirmed|min:6|max:20',
        ]);

        $u_ck = User::where('email', $request->commissioner_email)->first();
        if ($u_ck) {
            if ($u_ck->commissioner_ward_id == $ward->id) {
            } else {
                return redirect()->back()->withInput()->with('error', 'Email already present.');
            }
        }
        $p_ck = User::where('phone', $request->commissioner_phone)->first();
        if ($p_ck) {
            if ($p_ck->commissioner_ward_id == $ward->id) {
            } else {
                return redirect()->back()->withInput()->with('error', 'Phone number already present.');
            }
        }
        $ward->name = $request->name;
        $ward->bn_name = $request->bn_name;
        $ward->commissioner_name = $request->commissioner_name;
        $ward->commissioner_phone = $request->commissioner_phone;
        $ward->union_id = $request->union;
        if ($request->commissioner_signature) {
            deleteFile($ward->commissioner_signature);
            $ward->commissioner_signature =  saveImage('signature', $request->commissioner_signature, 200, 50);
        }

        if ($ward->save()) {

            $user = User::where('commissioner_ward_id', $ward->id)->first();
            if (!$user) {
                $user = new User();
                $user->role = 4;
            }

            $user->name = $request->commissioner_name;
            $user->phone = $request->commissioner_phone;
            $user->email = $request->commissioner_email;
            $user->signature = $ward->commissioner_signature;
            $user->commissioner_ward_id = $ward->id;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();


            return redirect()->route('admin.config.ward.index')->with('success', 'Ward updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ward $ward)
    {
        //
    }
    public function getWardsByUnion(Request $request)
    {
        $unions = Ward::where('union_id', $request->union_id)->get()->toArray();
        return response($unions);
    }
}
