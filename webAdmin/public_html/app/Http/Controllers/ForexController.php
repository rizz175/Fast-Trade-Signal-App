<?php

namespace App\Http\Controllers;

use App\Models\Forex;
use App\Models\Notification;
use App\Models\HistoricalForex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ForexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forex.index');
        
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
        $forex = Forex::create($request->all());
        toastr()->success("forex save successfully");
        
        $title = 'New FX Signal: ' . $forex->symbol . ' - ' . $forex->type;
		
        $notify_response = sendNotification($title);
        
        $date_added=date('Y-m-d H:i:s');
        
        $message = 'New FX Signal: ' . $forex->symbol . ' - ' . $forex->type. ' on '.$date_added;
        
        $notification = new Notification();
        
        $notification->message = $message;
        
        $notification->save();
        
        $results123 = DB::table('users')
		->select('*')
		->where('isLoggedIn', 1)
		->get();
		
		$sent_users=array();
		
		foreach ($results123 as $dataval) 
		{
		    
		    if($dataval->playerId!='')
		    {
			
			    $sent_users[]=$dataval->playerId;
			    
		    }
		}		
		
		$include_player_ids=implode(',',$sent_users);
        
        $content = array(
	    "en" => $title
	    );
        
        $fields = array(
					'app_id' => "5db9b19b-f857-4806-b304-14b2efd45ebc",
					'include_player_ids' => array($include_player_ids),
					'data' => array("foo" => "bar"),
					'contents' => $content
			);

		$fields = json_encode($fields);

		print("\nJSON sent:\n");

		print($fields);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");

		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		curl_setopt($ch, CURLOPT_POST, TRUE);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);

		curl_close($ch);

		$return["allresponses"] = $response;

		$return = json_encode( $return);

		print("\n\nJSON received:\n");

		print($return);

		print("\n");
				
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
    public function update(Request $request,Forex $forex)
    {
        $forex->update($request->all());
        toastr()->success("forex update successfully");
        
        $title = 'Modify FX Signal: ' . $forex->symbol . ' - ' . $forex->type;
        
        $date_added=date('Y-m-d H:i:s');
        
        $message = 'Modify FX Signal: ' . $forex->symbol . ' - ' . $forex->type. ' on '.$date_added;
        
        $notification = new Notification();
        
        $notification->message = $message;
        
        $notification->save();
        
        $results123 = DB::table('users')
		->select('*')
		->where('isLoggedIn', 1)
		->get();
		
		$sent_users=array();
		
		foreach ($results123 as $dataval) 
		{
		    
		    if($dataval->playerId!='')
		    {
			
			    $sent_users[]=$dataval->playerId;
			    
		    }
		}			
		
		$include_player_ids=implode(',',$sent_users);
        
        $content = array(
	    "en" => $title
	    );
        
        $fields = array(
					'app_id' => "5db9b19b-f857-4806-b304-14b2efd45ebc",
					'include_player_ids' => array($include_player_ids),
					'data' => array("foo" => "bar"),
					'contents' => $content
			);

		$fields = json_encode($fields);

		print("\nJSON sent:\n");

		print($fields);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");

		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		curl_setopt($ch, CURLOPT_POST, TRUE);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);

		curl_close($ch);

		$return["allresponses"] = $response;

		$return = json_encode( $return);

		print("\n\nJSON received:\n");

		print($return);

		print("\n");
				
		return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forex $forex)
    {   
        $symbol = $forex->symbol;
        $type = $forex->type;
        $forex->delete();
        toastr()->success("forex delete successfully");
        
        $title = 'Close FX Signal: ' . $symbol . ' - ' . $type;
		
		$date_added=date('Y-m-d H:i:s');
        
        $message = 'Close FX Signal: ' . $forex->symbol . ' - ' . $forex->type. ' on '.$date_added;
        
        $notification = new Notification();
        
        $notification->message = $message;
        
        $notification->save();
        
        $results123 = DB::table('users')
		->select('*')
		->where('isLoggedIn', 1)
		->get();
		
		$sent_users=array();
		
		foreach ($results123 as $dataval) 
		{
		    
		    if($dataval->playerId!='')
		    {
			
			    $sent_users[]=$dataval->playerId;
			    
		    }
		}			
		
		$include_player_ids=implode(',',$sent_users);
        
        $content = array(
	    "en" => $title
	    );
        
        $fields = array(
					'app_id' => "5db9b19b-f857-4806-b304-14b2efd45ebc",
					'include_player_ids' => array($include_player_ids),
					'data' => array("foo" => "bar"),
					'contents' => $content
			);

		$fields = json_encode($fields);

		print("\nJSON sent:\n");

		print($fields);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");

		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		curl_setopt($ch, CURLOPT_POST, TRUE);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);

		curl_close($ch);

		$return["allresponses"] = $response;

		$return = json_encode( $return);

		print("\n\nJSON received:\n");

		print($return);

		print("\n");
				
		return redirect()->back();
		
    }
   
}
