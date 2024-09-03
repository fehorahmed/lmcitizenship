<?php

namespace App\Http\Controllers;

use App\Models\HomeContact;
use App\Models\HomePersonList;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $people = HomePersonList::where('status', 1)->get();
        $contacts = HomeContact::where('status', 1)->get();
        return view('frontend.common.index',compact('people','contacts'));
    }

    public function personDetails($id)
    {
        $data = HomePersonList::findOrFail($id);
        return view('frontend.person_details', compact('data'));
    }
}
