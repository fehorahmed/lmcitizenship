<?php

namespace App\Http\Controllers;

use App\Models\MainMenu;
use Illuminate\Http\Request;

class MainMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = MainMenu::all();
        return view('admin.home.main_menu.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = MainMenu::where('type','main')->get();
        return view('admin.home.main_menu.create',compact('menus'));
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
            "title" => 'required|string|max:255',
            "type" => 'required|string|max:255',
            "main_menu_id" => 'nullable|required_if:type,sub|numeric',
            "url" => 'required|string|max:255|unique:main_menus,url',
            "order" => 'required|numeric',
            "content" => 'required|string|max:5000',
            "position" => 'required|string|max:255',
            "status" => 'required|boolean',
        ]);

        $data = new MainMenu();
        $data->title= $request->title;
        $data->type= $request->type;
        $data->position = $request->position;
        if($request->type== 'sub'){
            $data->main_menu_id= $request->main_menu_id;
        }

        $data->url= $request->url;
        $data->order= $request->order;
        $data->content= $request->content;
        $data->status= $request->status;
        $data->save();

        return redirect()->route('admin.main-menu.index')->with('success','Menu added successfully.');
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainMenu  $mainMenu
     * @return \Illuminate\Http\Response
     */
    public function show(MainMenu $mainMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MainMenu  $mainMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(MainMenu $mainMenu)
    {
        $menus = MainMenu::where('type','main')->get();
        return view('admin.home.main_menu.edit',compact('menus','mainMenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MainMenu  $mainMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainMenu $mainMenu)
    {
        $request->validate([
            "title" => 'required|string|max:255',
            "type" => 'required|string|max:255',
            "main_menu_id" => 'nullable|required_if:type,sub|numeric',
            "url" => 'required|string|max:255|unique:main_menus,url,'.$mainMenu->id,
            "order" => 'required|numeric',
            "content" => 'required|string|max:5000',
            "position" => 'required|string|max:255',
            "status" => 'required|boolean',
        ]);

        $mainMenu->title= $request->title;
        $mainMenu->type= $request->type;
        $mainMenu->position = $request->position;
        if($request->type== 'sub'){
            $mainMenu->main_menu_id= $request->main_menu_id;
        }

        $mainMenu->url= $request->url;
        $mainMenu->order= $request->order;
        $mainMenu->content= $request->content;
        $mainMenu->status= $request->status;
        $mainMenu->save();

        return redirect()->route('admin.main-menu.index')->with('success','Menu updated successfully.');
    }

    public function view($url)
    {
        $data = MainMenu::where('url',$url)->first();

        return view('frontend.pages.menu_details',compact('data'));
    }
}
