<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CounsellorController extends Controller
{
    //
    public function index(){
        return view('counsellor.index');
    }

    public function selfhelp(){
        $data['selfhelps'] = \App\SelfHelp::latest()->get();
        return view('counsellor.selfhelp', $data);
    }

}
