<?php

namespace App\Http\Controllers;

use App\Models\HomeContact;
use Illuminate\Http\Request;

class HomeContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = HomeContact::all();
        return view('admin.home.contact.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.home.contact.create');
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

            'designation' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $data = new HomeContact();

        $data->designation = $request->designation;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->status = $request->status;
        $data->created_by = auth()->id();

        if ($data->save()) {
            return redirect()->route('admin.front-contact.index')->with('success', 'Contact added successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HomeContact  $homeContact
     * @return \Illuminate\Http\Response
     */
    public function show(HomeContact $homeContact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomeContact  $homeContact
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeContact $homeContact)
    {
        return view('admin.home.contact.edit', compact('homeContact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HomeContact  $homeContact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeContact $homeContact)
    {
        $request->validate([

            'designation' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $homeContact->designation = $request->designation;
        $homeContact->address = $request->address;
        $homeContact->phone = $request->phone;
        $homeContact->email = $request->email;
        $homeContact->status = $request->status;

        if ($homeContact->update()) {
            return redirect()->route('admin.front-contact.index')->with('success', 'Contact updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeContact  $homeContact
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeContact $homeContact)
    {
        //
    }
}
