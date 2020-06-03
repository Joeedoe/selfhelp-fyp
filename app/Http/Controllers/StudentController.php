<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function index(){
        return view('student.index');
    }

    public function selfhelp(){
        $data['selfhelps'] = \App\SelfHelp::latest()->get();
        return view('student.selfhelp', $data);
    }

}
