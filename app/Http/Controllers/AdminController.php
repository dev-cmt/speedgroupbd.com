<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\LoseMember;
use App\Models\Admin\Event;
use App\Models\Admin\Gallery;
use DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $from = now()->startOfMonth();
        $to = now();
        $user = User::where('status', 1)->latest()->get();
        $enroll = $user->whereBetween('created_at', [$from, $to])->count();
        $add_hoc = $user->where('committee_type_id', 1)->count();
        $executive = $user->where('committee_type_id', 2)->count();
        $gallery = Gallery::where('status', 1)->count();

        return view('dashboard', compact('user','enroll','add_hoc','executive','gallery'));
    }

}
