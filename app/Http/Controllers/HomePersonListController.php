<?php

namespace App\Http\Controllers;

use App\Models\HomePersonList;
use Illuminate\Http\Request;

class HomePersonListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = HomePersonList::all();
        return view('admin.home.person_list.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.home.person_list.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'address' => 'required',
            'content' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
        ]);

        $data = new HomePersonList();
        $data->name = $request->name;
        $data->designation = $request->designation;
        $data->address = $request->address;
        $data->content = $request->content;
        $data->status = $request->status;
        if ($request->photo) {
            $data->photo =  saveImage('content_photo', $request->photo, 150, 180);
        }

        if ($data->save()) {
            return redirect()->route('admin.front-dashboard.list-of-person.index')->with('success', 'Content added successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HomePersonList  $homePersonList
     * @return \Illuminate\Http\Response
     */
    public function show(HomePersonList $homePersonList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomePersonList  $homePersonList
     * @return \Illuminate\Http\Response
     */
    public function edit(HomePersonList $homePersonList)
    {
        return view('admin.home.person_list.edit', compact('homePersonList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HomePersonList  $homePersonList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomePersonList $homePersonList)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'address' => 'required',
            'content' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
        ]);

        $homePersonList->name = $request->name;
        $homePersonList->designation = $request->designation;
        $homePersonList->address = $request->address;
        $homePersonList->content = $request->content;
        $homePersonList->status = $request->status;

        if ($request->photo) {
            deleteFile($homePersonList->photo);
            $homePersonList->photo =  saveImage('content_photo', $request->photo, 150, 180);
        }


        if ($homePersonList->save()) {
            return redirect()->route('admin.front-dashboard.list-of-person.index')->with('success', 'Content added successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomePersonList  $homePersonList
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomePersonList $homePersonList)
    {
        //
    }
}
