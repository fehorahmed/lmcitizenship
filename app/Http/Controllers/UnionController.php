<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Union;
use Illuminate\Http\Request;

class UnionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'division'=>'nullable|numeric',
            'district'=>'nullable|numeric',
            'sub_district'=>'nullable|numeric',
        ]);
        $query= Union::query();

        if($request->division){
           $division= $request->division;
            $query->whereHas('upazila',function($q) use ($division){
                $q->whereHas('district',function($r)use ($division){
                    $r->where('division_id',$division);
                });
            });
        }
        if($request->district){
           $district= $request->district;
            $query->whereHas('upazila',function($q) use ($district){
                $q->where('district_id',$district);
            });
        }
        $unions = $query->OrderBy('id','DESC')->paginate();
        $divisions= Division::all();
        return view('admin.union.index', compact('unions','divisions'));
    }

    public function getUnionBySubDistrict(Request $request)
    {
        $unions = Union::where('upazilla_id', $request->sub_district_id)->get()->toArray();
        return response($unions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        return view('admin.union.create', compact('divisions'));
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
            "name" => 'required|string|max:255',
            "bn_name" => 'required|string|max:255',
        ]);

        $data = new Union();
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->upazilla_id = $request->sub_district;
        if ($data->save()) {
            return redirect()->route('admin.config.union.index')->with('success', 'Union created successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
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
    public function edit(Union $union)
    {
        $divisions = Division::all();
        return view('admin.union.edit', compact('union', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Union $union)
    {
        $request->validate([
            "division" => 'required|numeric',
            "district" => 'required|numeric',
            "sub_district" => 'required|numeric',
            "name" => 'required|string|max:255',
            "bn_name" => 'required|string|max:255',
        ]);


        $union->name = $request->name;
        $union->bn_name = $request->bn_name;
        $union->upazilla_id = $request->sub_district;
        if ($union->save()) {
            return redirect()->route('admin.config.union.index')->with('success', 'Union updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
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
}
