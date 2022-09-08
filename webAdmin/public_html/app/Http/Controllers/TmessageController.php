<?php

namespace App\Http\Controllers;

use App\Models\Tmessage;
use Illuminate\Http\Request;

class TmessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('tmessage.tmessage');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tmessage  $tmessage
     * @return \Illuminate\Http\Response
     */
    public function show(Tmessage $tmessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tmessage  $tmessage
     * @return \Illuminate\Http\Response
     */
    public function edit(Tmessage $tmessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tmessage  $tmessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tmessage $tmessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tmessage  $tmessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tmessage $tmessage)
    {
        //
    }
}
