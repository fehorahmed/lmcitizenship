<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $today = Carbon::now();
        $today_pending_count = 0;
        $previous_pending_count = 0;
        $completed_count = 0;
        $canceled_count = 0;
        // dd($previous_pending_count);
        return view('dashboard', compact('today_pending_count', 'previous_pending_count', 'completed_count', 'canceled_count'));
    }
}
