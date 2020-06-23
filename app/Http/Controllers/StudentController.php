<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Support\Facades\Hash;
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

    public function chats(){
        $data['chats'] = \App\Chat::where('sender', '=', auth()->user()->id)->orWhere('receiver', '=', auth()->user()->id)->get();
        $data['onlines'] = \App\User::where('status', '=', '1')->get();
        return view('student.chat', $data);
    }

    public function newchat($uid){
        $exist = \App\Chat::where('sender', '=', auth()->user()->id)->where('receiver', '=', $uid)->first();
        $exist2 = \App\Chat::where('sender', '=', $uid)->where('receiver', '=', auth()->user()->id)->first();

        if($exist){
            $chatid = $exist->id;
        }
        else if ($exist2){
            $chatid = $exist2->id;
        }
        else{
            $chat = new \App\Chat();
            $chat->sender = auth()->user()->id;
            $chat->receiver = $uid;
            $chat->save();
            $chatid = $chat->id;
        }

        return redirect()->route('student.openchat', $chatid);
    }

    public function openchat($cid){
        $data['chat'] = \App\Chat::where('id', $cid)->orderBy('created_at', 'ASC')->first();
        return view('student.message', $data);
    }

    public function addmessage($cid, Request $request){

        $msg = new \App\Message();
        $msg->chat_id = $cid;
        $msg->user_id = $request->input('user_id');
        $msg->message = $request->input('message');
        $msg->save();
        return redirect()->route('student.openchat', $cid);
    }

    public function profile(){
        return view('student.profile');
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

        if (!Hash::check($op, $old)){
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
