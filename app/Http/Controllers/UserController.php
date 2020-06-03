<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = new \App\User();
        $user->uniId = $request->input('uniId');
        $user->userRole = $request->input('userRole');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->status = 0;
        $user->password = bcrypt('password');

        if($user->save()){
            return "<script>alert('User successfully added!');window.location.href='".route('admin.users')."'</script>";
        }
        else{
            return "<script>alert('An error has occured.');window.location.href='".route('admin.users')."'</script>";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = \App\User::find($request->input('id'));
        $user->uniId = $request->input('uniId');
        $user->email = $request->input('email');
        $user->username = $request->input('username');

        if($user->save()){
            return "<script>alert('User successfully updated!');window.location.href='".route('admin.users')."'</script>";
        }
        else{
            return "<script>alert('An error has occured.');window.location.href='".route('admin.users')."'</script>";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(\App\User::destroy($id)){
            return "<script>alert('User successfully deleted!');window.location.href='".route('admin.users')."'</script>";
        }
        else{
            return "<script>alert('An error has occured.');window.location.href='".route('admin.users')."'</script>";
        }
    }
}
