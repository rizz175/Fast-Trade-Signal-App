<?php

namespace App\Http\Controllers;

use App\Models\Crypto;
use App\Models\Forex;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CryptoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('crypto.index');
        
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
        $crypto = Crypto::create($request->all());
        toastr()->success("cryoto save successfully");
        
        $title = 'New Crypto Signal: ' . $crypto->symbol . ' - ' . $crypto->type;
        // $body = 'New Crypto Signal: ' . $crypto->symbol . ' - ' . $crypto->type;
        $notify_response = sendNotification($title);
        
        $date_added=date('Y-m-d H:i:s');
        
        $message = 'New Crypto Signal: ' . $crypto->symbol . ' - ' . $crypto->type. ' on '.$date_added;
        
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
				// $crypto = Crypto::where('id',$id)->first();
				// dd($crypto);
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
			public function update(Request $request, Crypto $crypto)
			{
				$crypto->update($request->all());
				toastr()->success("crypto update successfully");
				
				$title = 'Modify Crypto Signal: ' . $crypto->symbol . ' - ' . $crypto->type;
				// $body = 'Modify Crypto Signal: ' . $crypto->symbol . ' - ' . $crypto->type;
				$notify_response = sendNotification($title);
				
				$date_added=date('Y-m-d H:i:s');
				
				$message = 'Modify Crypto Signal: ' . $crypto->symbol . ' - ' . $crypto->type. ' on '.$date_added;
				
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
			public function destroy(Crypto $crypto)
			{
				$symbol = $crypto->symbol;
				$type = $crypto->type;
				$crypto->delete();
				toastr()->success("crypto delete successfully");
				
				$title = 'Close Crypto Signal: ' . $symbol . ' - ' . $type;
				$notify_response = sendNotification($title);
				
				$date_added=date('Y-m-d H:i:s');
				
				$message = 'Close Crypto Signal: ' . $symbol . ' - ' . $type. ' on '.$date_added;
				
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
