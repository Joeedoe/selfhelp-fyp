<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Hash;
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

    public function profile(){
        return view('admin.profile');
    }

    public function editprofile(Request $request){
        $id = auth()->user()->id;
        $user = \App\User::find($id);
        $user->username = $request->input('username');
        $user->email = $request->input('email');

        try{
            $user->save();
            return "<script>alert('Profile Successfully Edited!');window.location.href='".url()->previous()."'</script>";
        }
        catch(\Exception $e){
            return "<script>alert('An error has occured!');window.location.href='".url()->previous()."'</script>";
        }
    }

    public function editpassword(Request $request){
        $op = $request->input('op');
        $np = $request->input('np');
        $cp = $request->input('cp');


        $user = \App\User::find(auth()->user()->id);
        $old = $user->password;

        echo Hash::make($op);
        echo "<br>";
        // echo $old;

        if (Hash::check($op, $old)){
            return "<script>alert('Old Password is wrong!');window.location.href='".url()->previous()."'</script>";
        }

        if($np != $cp){
            return "<script>alert('Confirm Password is wrong!');window.location.href='".url()->previous()."'</script>";
        }

        $user->password = Hash::make($np);
        try{
            $user->save();
            return "<script>alert('Password Successfully Updated!');window.location.href='".url()->previous()."'</script>";
        }
        catch(\Exception $e){
            return "<script>alert('An error has occured!');window.location.href='".url()->previous()."'</script>";
        }
    }

}
