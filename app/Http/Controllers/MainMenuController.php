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
            "status" => 'required|boolean',
        ]);

        $data = new MainMenu();
        $data->title= $request->title;
        $data->type= $request->type;

        $data->main_menu_id= $request->main_menu_id;

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
        //
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
        //
    }

    public function view($url)
    {
        $data = MainMenu::where('url',$url)->first();

        return view('frontend.pages.menu_details',compact('data'));
    }
}
