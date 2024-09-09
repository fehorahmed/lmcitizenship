<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Ward;
use Illuminate\Http\Request;

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
            "commissioner_signature" => 'nullable|image|max:100',
        ]);

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
            "commissioner_signature" => 'nullable|image|max:100',
        ]);


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
