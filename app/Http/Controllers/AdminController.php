<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(){
        return view('admin.index');
    }

    public function users(){
        $data['users'] = \App\User::all();
        return view('admin.users', $data);
    }

    public function chats(){
        $data['chats'] = \App\Chat::all();
        return view('admin.chats', $data);
    }

    public function selfhelp(){
        $data['selfhelps'] = \App\SelfHelp::all();
        return view('admin.selfhelp', $data);
    }

}
