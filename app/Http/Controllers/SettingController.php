<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $setting = Setting::first();
        return view('admin.setting.create', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            "name" => 'required|string|max:255',
            "phone" => 'nullable|string|max:255',
            "email" => 'nullable|string|max:255',
            "address" => 'nullable|string|max:255',
            "website" => 'nullable|string|max:255',
            "map" => 'nullable|string|max:1000',
            "logo" => 'nullable|image',
            "banner" => 'nullable|image',
            "mayor_name" => 'nullable|string|max:255',
            "mayor_signature" => 'nullable|image',
        ]);
        // dd($request->all());
        $setting = Setting::first();
        if (!$setting) {
            $setting = new Setting();
        }

        $setting->name = $request->name;
        $setting->phone = $request->phone;
        $setting->email = $request->email;
        $setting->address = $request->address;
        $setting->website = $request->website;
        $setting->map = $request->map;
        $setting->mayor_name = $request->mayor_name;
        if ($request->logo) {
            $setting->logo =  saveImage('logo', $request->logo, 200, 80);
        }
        if ($request->banner) {
            $setting->banner =  saveImage('banner', $request->banner, 1140, 319);
        }
        if ($request->mayor_signature) {
            $setting->mayor_signature =  saveImage('signature', $request->mayor_signature, 200, 50);
        }

        if ($setting->save()) {
            return redirect()->back()->with('success', 'Setting update successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
