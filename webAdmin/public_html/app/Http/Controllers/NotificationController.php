<?php

namespace App\Http\Controllers;

use App\Models\Notification;
//use App\Models\HistoricalNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notification.index');
        
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
        $notification = Notification::create($request->all());
        toastr()->success("notification save successfully");
        
        $title = 'New FX Signal: ' . $notification->symbol . ' - ' . $notification->type;
        $notify_response = sendNotification($title);
        return redirect()->back();
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
    public function update(Request $request,Notification $notification)
    {
        $notification->update($request->all());
        toastr()->success("notification update successfully");
        
        $title = 'Modify FX Signal: ' . $notification->symbol . ' - ' . $notification->type;
        $notify_response = sendNotification($title);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {   
        $symbol = $notification->symbol;
        $type = $notification->type;
        $notification->delete();
        toastr()->success("notification delete successfully");
        
        $title = 'Close FX Signal: ' . $symbol . ' - ' . $type;
        $notify_response = sendNotification($title);
        return redirect()->back();
    }
   
}
