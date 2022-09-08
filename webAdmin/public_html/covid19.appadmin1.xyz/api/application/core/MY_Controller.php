<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require  APPPATH . 'libraries/REST_Controller.php';
         
class MY_Controller extends REST_Controller {
    
    public function __construct() {
		
        parent::__construct();
        
		date_default_timezone_set('Asia/Karachi');
		
		$className=strtolower($this->router->fetch_class());
        $methodName=strtolower($this->router->fetch_method());
		
		//Here If No Authentication required (For open functions)
		$class_function_NoAuth=array(array("book"=>"test"), array( "assessment"=>"send100meter_notification"));
		
		//Here just client-name and auth-key will be checked
		$class_function_withoutTokens=array(array("auth"=>"login"), array("auth"=>"logout"), array("auth"=>"register"), array("auth"=>"social_login"), array("auth"=>"social_register"), array("blogs"=>"all"), array("blogs"=>"details"), array("geolocation"=>"save"), array("user"=>"circle_violation"), array("products"=>"all"), array("products"=>"details"),); 
		
		
		//If not a Open/Public class-function
		if(!in_array(array($className=>$methodName),$class_function_NoAuth)){	
		
			//Here just client-name and auth-key will be checked
			if(in_array(array($className=>$methodName),$class_function_withoutTokens)){
				
				$check_auth_client = $this->MyModel->check_auth_client();
				if($check_auth_client == false){
					
					$this->output->set_content_type('application/json');
					$this->output->set_status_header(401);
					//json_output(401,array('status' => 401,'message' => 'Invalid Authentication'));
					echo json_encode(array('status' => 401, 'message' => 'Invalid Authentication'));
					exit;
				}
			}
			
			//User-id and token will be checked here
			else{
				
				
				$check_auth_client = $this->MyModel->check_auth_client();
				if($check_auth_client == false){
					
					$this->output->set_content_type('application/json');
					$this->output->set_status_header(401);
					//json_output(401,array('status' => 401,'message' => 'Invalid Authentication'));
					echo json_encode(array('status' => 401, 'message' => 'Invalid Authentication'));
					exit;
				}
				
				
				$check_auth_token = $this->MyModel->check_auth_token();
				
				if($check_auth_token==1){//For invalid Auth
					
					$this->output->set_content_type('application/json');
					$this->output->set_status_header(401);
					//json_output(401,array('status' => 401,'message' => 'Invalid Authentication'));
					echo json_encode(array('status' => 401, 'message' => 'Invalid Authentication'));	
					exit;
					
				}
				
				elseif($check_auth_token==2){//For Session expired
					
					$this->output->set_content_type('application/json');
					$this->output->set_status_header(401);
					//json_output(401,array('status' => 401,'message' => 'Your session has been expired'));
					echo json_encode(array('status' => 401, 'message' => 'Your session has been expired'));
					exit;
				}
				
			}
		}
      
        
            
    }
	
	
	
	public function check_password_pattern($password){
		
		$uppercase1 = preg_match('@[A-Z]@', $password);
		$lowercase1 = preg_match('@[a-z]@', $password);
		$numbers1    = preg_match('@[0-9]@', $password);
		
		if(!$uppercase1 || !$lowercase1 || !$numbers1 || strlen($password) < 8) {
			return false;
		}
		else{
			return true;	
		}

	}
	
	
	public function random_string($length) {
		$key = '';
		$keys = array_merge(range(0, 9), range('a', 'z'));
	
		for ($i = 0; $i < $length; $i++) {
			$key .= $keys[array_rand($keys)];
		}
	
		return $key;
	}
    
	
	
	
	
	public function sendEmail_sendgrid($to,$subject,$message){
		
        $this->load->library('email');
 
        $this->email->from($this->config->item("email_from"), $this->config->item("website_name"));
        $this->email->to($to);
        $this->email->subject($subject);        
        $this->email->message($message);
        
        if ($this->email->send()) {
            return true;
        }else{
			echo $this->email->print_debugger();
            return false;
        }
    }
	
	
	public function sendSMS($phone_number,$sms){
		
        $this->load->library('plivo');
        		
        $sms_data = array(
            'src' => 'MNPSMS', //The phone number to use as the caller id (with the country code). E.g. For USA 15671234567
            'dst' => $phone_number, // The number to which the message needs to be send (regular phone numbers must be prefixed with country code but without the ‘+’ sign) E.g., For USA 15677654321.
            'text' => $sms, // The text to send
            'type' => 'sms', //The type of message. Should be 'sms' for a text message. Defaults to 'sms'
            'method' => 'POST', // The method used to call the URL. Defaults to. POST
        );

        $response_array = $this->plivo->send_sms($sms_data);
        
		//var_dump($response_array);
        
		if ($response_array[0] == '200' || $response_array[0] == '202') {
            return true;
        }else{
            return false;
        }
    }
	
	
	public function is_empty($d){
		
		if(strlen($d)){
			return false;	
		}
		else{
			return true;
		}
	}
	
	
	


	public function get_auth_client_id(){/*Will return the auth client ID according to client name and authkey*/
		
		$client_name = $this->input->get_request_header('client-name', TRUE);
        $auth_key  = $this->input->get_request_header('auth-key', TRUE);
		
		$return=$this->Main_model->get_by_where_column_name("api_client", "id", array('client_name'=>$client_name, "authkey"=>$auth_key));
		
		if($return){
			return $return->id;	
		}
		else{
			return false;	
		}
	}

	
	public function send_firebase_notification($token, $title, $body){
		
		$url = "https://fcm.googleapis.com/fcm/send";
		/*$token = "djxlbI4_GtDArcmVF";*/
		$serverKey = $this->config->item("fcm_serverkey");
		//$title = "Alert of covid19";
		//$body = "Hello Its me Ahsan";
		$notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
		$arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
		$json = json_encode($arrayToSend);
		$headers = array();
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Authorization: key='. $serverKey;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
		//Send the request
		$response = curl_exec($ch);
		//Close request
		if ($response === FALSE) {
		die('FCM Send Error: ' . curl_error($ch));
		}
		curl_close($ch);
	
	}
	
}

