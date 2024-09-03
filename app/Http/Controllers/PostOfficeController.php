<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\PostOffice;
use Illuminate\Http\Request;

class PostOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = PostOffice::paginate();

        return view('admin.post_office.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        return view('admin.post_office.create', compact('divisions'));
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

        $data = new PostOffice();
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->upazila_id = $request->sub_district;
        if ($data->save()) {
            return redirect()->route('admin.config.post.index')->with('success', 'Post created successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostOffice  $postOffice
     * @return \Illuminate\Http\Response
     */
    public function show(PostOffice $postOffice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostOffice  $postOffice
     * @return \Illuminate\Http\Response
     */
    public function edit(PostOffice $post)
    {
        $divisions = Division::all();
        return view('admin.post_office.edit', compact('post', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostOffice  $postOffice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostOffice $post)
    {
        $request->validate([
            "division" => 'required|numeric',
            "district" => 'required|numeric',
            "sub_district" => 'required|numeric',
            "name" => 'required|string|max:255',
            "bn_name" => 'required|string|max:255',
        ]);

        $post->name = $request->name;
        $post->bn_name = $request->bn_name;
        $post->upazila_id = $request->sub_district;
        if ($post->save()) {
            return redirect()->route('admin.config.post.index')->with('success', 'Post updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostOffice  $postOffice
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostOffice $postOffice)
    {
        //
    }
    public function getPostOfficesBySubDistrict(Request $request)
    {
        $posts = PostOffice::where('upazila_id', $request->sub_district_id)->get()->toArray();
        return response($posts);
    }
}
