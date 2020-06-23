<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function chats(){
        $data['chats'] = \App\Chat::where('sender', '=', auth()->user()->id)->orWhere('receiver', '=', auth()->user()->id)->get();
        $data['onlines'] = \App\User::where('status', '=', '1')->get();
        return view('counsellor.chat', $data);
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

        return redirect()->route('counsellor.openchat', $chatid);
    }

    public function openchat($cid){
        $data['chat'] = \App\Chat::where('id', $cid)->orderBy('created_at', 'ASC')->first();
        return view('counsellor.message', $data);
    }

    public function addmessage($cid, Request $request){

        $msg = new \App\Message();
        $msg->chat_id = $cid;
        $msg->user_id = $request->input('user_id');
        $msg->message = $request->input('message');
        $msg->save();
        return redirect()->route('counsellor.openchat', $cid);
    }

    public function profile(){
        return view('counsellor.profile');
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
