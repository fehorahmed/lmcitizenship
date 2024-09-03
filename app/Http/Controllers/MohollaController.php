<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Moholla;
use Illuminate\Http\Request;

class MohollaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mohollas = Moholla::paginate();

        $divisions = Division::all();
        return view('admin.moholla.index', compact('mohollas', 'divisions'));
    }
    public function getMohollasByWard(Request $request)
    {

        $mohollas = Moholla::where('ward_id', $request->ward_id)->get()->toArray();
        return response($mohollas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        return view('admin.moholla.create', compact('divisions'));
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
            "district" =>  'required|numeric',
            "sub_district" =>  'required|numeric',
            "union" =>  'required|numeric',
            "ward" =>  'required|numeric',
            "name" =>  'required|string|max:255',
            "bn_name" =>  'required|string|max:255',
        ]);
        $moholla = new Moholla();
        $moholla->name = $request->name;
        $moholla->bn_name = $request->bn_name;
        $moholla->ward_id = $request->ward;
        if ($moholla->save()) {
            return redirect()->route('admin.config.moholla.index')->with('success', 'Moholla created successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Moholla  $moholla
     * @return \Illuminate\Http\Response
     */
    public function show(Moholla $moholla)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Moholla  $moholla
     * @return \Illuminate\Http\Response
     */
    public function edit(Moholla $moholla)
    {
        $divisions = Division::all();
        return view('admin.moholla.edit', compact('moholla', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Moholla  $moholla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Moholla $moholla)
    {
        $request->validate([
            "division" => 'required|numeric',
            "district" =>  'required|numeric',
            "sub_district" =>  'required|numeric',
            "union" =>  'required|numeric',
            "ward" =>  'required|numeric',
            "name" =>  'required|string|max:255',
            "bn_name" =>  'required|string|max:255',
        ]);

        $moholla->name = $request->name;
        $moholla->bn_name = $request->bn_name;
        $moholla->ward_id = $request->ward;
        if ($moholla->update()) {
            return redirect()->route('admin.config.moholla.index')->with('success', 'Moholla updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Moholla  $moholla
     * @return \Illuminate\Http\Response
     */
    public function destroy(Moholla $moholla)
    {
        //
    }
}
