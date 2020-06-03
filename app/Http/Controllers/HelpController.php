<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
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
        $sh = new \App\SelfHelp();
        $sh->title = $request->input('title');
        $sh->body = $request->input('body');
        $sh->user_id = $request->input('user_id');

        if($sh->save()){
            return "<script>alert('Self Help successfully added!');window.location.href='".url()->previous()."'</script>";
        }
        else{
            return "<script>alert('An error has occured.');window.location.href='".url()->previous()."'</script>";
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
        $sh = \App\SelfHelp::find($request->input('id'));
        $sh->title = $request->input('title');
        $sh->body = $request->input('body');

        if($sh->save()){
            return "<script>alert('Self Help successfully updated!');window.location.href='".url()->previous()."'</script>";
        }
        else{
            return "<script>alert('An error has occured.');window.location.href='".url()->previous()."'</script>";
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
        //
        if(\App\SelfHelp::destroy($id)){
            return "<script>alert('Self help successfully deleted!');window.location.href='".url()->previous()."'</script>";
        }
        else{
            return "<script>alert('An error has occured.');window.location.href='".url()->previous()."'</script>";
        }
    }
}
