<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MY_Controller {
	
	
	public function __construct() {
		
        parent::__construct();
		
		$this->load->model("Main_model");
		
	}
	 
	public function register_post(){
		
		if(empty($this->input->post())){
			return json_output(400, array('status' => 400, 'message' => 'Bad request'));
		}
		
		else{
			
			$created_by=0;//Means Super admin can see him
			$user_type="company";
			$dated=date("Y-m-d H:i:s");
			$status="inactive";
			
			$fname=ucfirst($this->input->post("fname"));
			$lname=ucfirst($this->input->post("lname"));
			$account_type=strtolower($this->input->post("account_type"));
			$comp_email=$email=strtolower($this->input->post("email"));
			$password=md5($this->input->post("password"));
						
			$comp_mobile_iso2=strtolower($this->input->post("mobile_iso2"));
			$comp_mobile_code=str_replace("+","",$this->input->post("mobile_code"));
			$comp_mobile=$this->input->post("mobile");
			$company_name=ucwords($this->input->post("company_name"));
			$employees=$this->input->post("employees");
			$country=strtoupper($this->input->post("country"));
			
			if($account_type=="individual"){
				$company_name=$fname." ".$lname;
			}
			
			if($this->is_empty($fname)||$this->is_empty($lname)||$this->is_empty($account_type)||$this->is_empty($email)||$this->is_empty($this->input->post("password"))||$this->is_empty($comp_mobile_iso2)||$this->is_empty($comp_mobile_code)||$this->is_empty($comp_mobile)||$this->is_empty($company_name)||$this->is_empty($country)){
				
				return json_output(422, array('status' => 422, 'message' => 'Missing mandatory fields'));
			}
			
			elseif(!in_array($employees,array("1_5","5_10","10_20","20_50","50_p",""))||!in_array($account_type,array("agent","developer","individual"))||!is_numeric($comp_mobile)){
				
				return json_output(422, array('status' => 422, 'message' => 'Invalid values found'));
			}
			
			elseif(strlen($country)>2||strlen($comp_mobile_iso2)>2){
				return json_output(422, array('status' => 422, 'message' => 'ISO2 country code needed!'));
			}
			
			
			elseif(!$this->check_password_pattern($this->input->post("password"))){
					return json_output(422, array('status' => 422, 'message' => 'Passwords must be at least 8 characters long and must contain atleast one lowercase, uppercase and numeric character'));
			}
			
			else{
			
				$properties_limit=2147483647;//200
				$users_limit=0;
				
				if($account_type!="individual"){
					$users_limit=2147483647;//0
				}
				
				$expiry="";//$Date = date("m/d/Y");//date('m/d/Y', strtotime($Date. ' + 15 days'));
				
				
				/*****For Checking Mobile Number*****/
				$comp_mobile=str_replace(("+".$comp_mobile_code),"",$comp_mobile);//If Country code inside mobile input
				/*******/
				
				
				$receive_news=0;//$this->input->post("signup-news")?1:0;
							
				
				$email_exist=$this->Main_model->get_by_where("user",array("email"=>$email));
				
				if(!$email_exist){
				
					$verify_hash=md5($password.$email);
					
					$verify_4_digit=rand (1001, 9999);
					
					$client_name = $this->input->get_request_header('client-name', TRUE);
					
					$user_info=array("created_by"=>$created_by, "user_type"=>$user_type, "fname"=>$fname, "lname"=>$lname, "email"=>$email, "password"=>$password, "dated"=>$dated, "modified_date"=>$dated, "status"=>$status, "verify_hash"=>$verify_hash, "account_type"=>$account_type, "api_client_name"=>$client_name, "integrated_web_api_user"=>1, "subscribed"=>0, "verify_4_digit"=>$verify_4_digit);
					
					$last_id=$this->Main_model->insert_rec("user",$user_info);
					
					if($last_id){
						
						/****************/
						$company_info=array("user_id"=>$last_id, "company_name"=>$company_name, "comp_email"=>$comp_email, "comp_mobile_iso2"=>$comp_mobile_iso2, "comp_mobile_code"=>$comp_mobile_code, "comp_mobile"=>$comp_mobile, "comp_phone_iso2"=>$comp_mobile_iso2, "comp_phone_code"=>$comp_mobile_code, "comp_phone"=>$comp_mobile, "properties_limit"=>$properties_limit, "users_limit"=>$users_limit, "country"=>$country, "expiry"=>$expiry, "receive_news"=>$receive_news, "employees"=>$employees);
						
						$this->Main_model->insert_rec("company_details",$company_info);
						/**************/
						
						
						/*************/
						$user_details=array("user_id"=>$last_id, "contact_email"=>$email, "mobile_code"=>$comp_mobile_code ,"mobile"=>$comp_mobile, "job_title"=>"", "department"=>"", "tel_code"=>"", "office_tel"=>"", "rental_comm"=>"", "sales_comm"=>"", "short_term_comm"=>"", "signature"=>"", "spoken_language"=>"", "bio"=>"", "office_iso2"=>"", "mobile_iso2"=>$comp_mobile_iso2,"propertyAvail"=>1);
				
						$last_id2=$this->Main_model->insert_rec("user_details",$user_details);
						/*************/
						
						
						//--------------------User Access Inputs-----------------------
						$access_data=array("user_id_access"=>$last_id, "dashboard"=>2, "rent"=>0, "buy"=>0, "short"=>0, "rentbuy"=>0, "contacts"=>2, "leads"=>2, "deals"=>0, "calendar"=>2, "todo"=>2, "invite"=>0, "sharedlistings"=>0, "sharedleads"=>0, "portals"=>0, "users"=>0, "profile"=>2, "hr"=>0, "reports"=>0, "history"=>2, "marketi"=>0, "managementreports"=>0, "propertyview"=>2);
						
						$this->Main_model->insert_rec("screen_access",$access_data);
						//End--------------------User Access Inputs-----------------------
						
						
						$company_mobile_num="+".$comp_mobile_code.$comp_mobile;
						$user_name=ucwords($fname." ".$lname);
												
						$verify_code=$verify_hash."_".$last_id;
						
						
						$website_name="";
						//*********Getting website name according to auth and client name************
						$client_name = $this->input->get_request_header('client-name', TRUE);
						$auth_key  = $this->input->get_request_header('auth-key', TRUE);
						
						$q  = $this->db->select('website_name')->from('api_client')->where(array('client_name'=>$client_name, "authkey"=>$auth_key))->order_by("id","desc")->get()->row();
						 
						$website_name=$q->website_name;
						/*******End**************/
						
						
						$message_toSend_sms=$website_name.' PIN. Never share your code with anyone. '.$website_name.' employees will never ask for it. Your code is '.$verify_4_digit;
						
						$message_toSend_email="Hi ".$user_name.", <br>".$website_name.' PIN. Never share your code with anyone. '.$website_name.' employees will never ask for it. Your code is '.$verify_4_digit;
						
						//$message_toSend_sms=$verify_4_digit." is your ".$website_name." verification code.";
						//$message_toSend_email="Hi ".$fname." ".$lname.", ".$verify_4_digit." is your ".$website_name." verification code.";
						
						$email_subject=$website_name." Verification Message";
						
						$this->sendSMS($company_mobile_num, $message_toSend_sms);
						$this->sendEmail_sendgrid($email, $email_subject, $message_toSend_email);
						
						
						
						return json_output(201, array('status' => 201, "user-id"=>$last_id, "email"=>$email, '4_digits_code'=>$verify_4_digit, "verification_code"=>$verify_code, "name"=>$user_name, "mobile"=>$company_mobile_num, 'message' => 'Account has been created. Kindly verify this account before proceeding to login'));
						
						
					}
					
					else{
						
						return json_output(500, array('status' => 500, 'message' => 'There is some issue on the server, Please try again'));
							
					}
				
				}
				else{
					return json_output(409, array('status' => 409, 'message' => 'Email already exist!'));
				}
				
				
			}
			
			
			
		}
		
	}
	
	
	public function social_register_post(){
		
		if(empty($this->input->post())){
			return json_output(400, array('status' => 400, 'message' => 'Bad request'));
		}
		
		else{
			
			$created_by=0;//Means Super admin can see him
			$user_type="company";
			$dated=date("Y-m-d H:i:s");
			$status="active";
			
			$fname=ucfirst($this->input->post("fname"));
			$lname=ucfirst($this->input->post("lname"));
			$account_type=strtolower($this->input->post("account_type"));
			$comp_email=$email=strtolower($this->input->post("email"));
			//$password=md5($this->input->post("password"));
						
			$comp_mobile_iso2=strtolower($this->input->post("mobile_iso2"));
			$comp_mobile_code=str_replace("+","",$this->input->post("mobile_code"));
			$comp_mobile=$this->input->post("mobile");
			$company_name=ucwords($this->input->post("company_name"));
			$employees=$this->input->post("employees");
			$country=strtoupper($this->input->post("country"));
			
			$id = $this->input->post('id');
			$type = strtolower($this->input->post('type'));
		
			if($account_type=="individual"){
				$company_name=$fname." ".$lname;
			}
			
			if($this->is_empty($fname)||$this->is_empty($lname)||$this->is_empty($account_type)||$this->is_empty($email)||$this->is_empty($comp_mobile_iso2)||$this->is_empty($comp_mobile_code)||$this->is_empty($comp_mobile)||$this->is_empty($company_name)||$this->is_empty($country)||$this->is_empty($id)||$this->is_empty($type)){
				
				return json_output(422, array('status' => 422, 'message' => 'Missing mandatory fields'));
			}
			
			elseif(!in_array($employees,array("1_5","5_10","10_20","20_50","50_p",""))||!in_array($account_type,array("agent","developer","individual"))||!is_numeric($comp_mobile)){
				
				return json_output(422, array('status' => 422, 'message' => 'Invalid values found'));
			}
			
			elseif(strlen($country)>2||strlen($comp_mobile_iso2)>2){
				return json_output(422, array('status' => 422, 'message' => 'ISO2 country code needed!'));
			}
			
			
			else{
			
				$properties_limit=2147483647;//200
				$users_limit=0;
				
				if($account_type!="individual"){
					$users_limit=2147483647;//0
				}
				
				$expiry="";//$Date = date("m/d/Y");//date('m/d/Y', strtotime($Date. ' + 15 days'));
				
				
				/*****For Checking Mobile Number*****/
				$comp_mobile=str_replace(("+".$comp_mobile_code),"",$comp_mobile);//If Country code inside mobile input
				/*******/
				
				
				$receive_news=0;//$this->input->post("signup-news")?1:0;
							
				
				$socialAccount_exist=$this->Main_model->get_by_where("user",array("social_id"=>$id, "social_account_type"=>$type));
				
				if($socialAccount_exist){
					return json_output(409, array('status' => 409, 'message' => 'Social account already exist!'));	
				}
				
				
				$email_exist=$this->Main_model->get_by_where("user",array("email"=>$email));
				
				
				if(!$email_exist&&!$socialAccount_exist){
				
					$verify_hash=md5(rand(1001, 9999).$email);
					
					$verify_4_digit=rand (1001, 9999);
					
					$client_name = $this->input->get_request_header('client-name', TRUE);
					
					$user_info=array("created_by"=>$created_by, "user_type"=>$user_type, "fname"=>$fname, "lname"=>$lname, "email"=>$email, "dated"=>$dated, "modified_date"=>$dated, "status"=>$status, "verify_hash"=>$verify_hash, "account_type"=>$account_type, "api_client_name"=>$client_name, "integrated_web_api_user"=>1, "subscribed"=>0, "verify_4_digit"=>$verify_4_digit, "social_account"=>1, 'social_id'=>$id, "social_account_type"=>$type);
					
					$last_id=$this->Main_model->insert_rec("user",$user_info);
					
					if($last_id){
						
						/****************/
						$company_info=array("user_id"=>$last_id, "company_name"=>$company_name, "comp_email"=>$comp_email, "comp_mobile_iso2"=>$comp_mobile_iso2, "comp_mobile_code"=>$comp_mobile_code, "comp_mobile"=>$comp_mobile, "comp_phone_iso2"=>$comp_mobile_iso2, "comp_phone_code"=>$comp_mobile_code, "comp_phone"=>$comp_mobile, "properties_limit"=>$properties_limit, "users_limit"=>$users_limit, "country"=>$country, "expiry"=>$expiry, "receive_news"=>$receive_news, "employees"=>$employees);
						
						$this->Main_model->insert_rec("company_details",$company_info);
						/**************/
						
						
						/*************/
						$user_details=array("user_id"=>$last_id, "contact_email"=>$email, "mobile_code"=>$comp_mobile_code ,"mobile"=>$comp_mobile, "job_title"=>"", "department"=>"", "tel_code"=>"", "office_tel"=>"", "rental_comm"=>"", "sales_comm"=>"", "short_term_comm"=>"", "signature"=>"", "spoken_language"=>"", "bio"=>"", "office_iso2"=>"", "mobile_iso2"=>$comp_mobile_iso2,"propertyAvail"=>1);
				
						$last_id2=$this->Main_model->insert_rec("user_details",$user_details);
						/*************/
						
						
						//--------------------User Access Inputs-----------------------
						$access_data=array("user_id_access"=>$last_id, "dashboard"=>2, "rent"=>0, "buy"=>0, "short"=>0, "rentbuy"=>0, "contacts"=>2, "leads"=>2, "deals"=>0, "calendar"=>2, "todo"=>2, "invite"=>0, "sharedlistings"=>0, "sharedleads"=>0, "portals"=>0, "users"=>0, "profile"=>2, "hr"=>0, "reports"=>0, "history"=>2, "marketi"=>0, "managementreports"=>0, "propertyview"=>2);
						
						$this->Main_model->insert_rec("screen_access",$access_data);
						//End--------------------User Access Inputs-----------------------
						
						
						$response = $this->MyModel->social_login($id,$type);
						
						return json_output($response['status'],$response);
						
						
					}
					
					else{
						
						return json_output(500, array('status' => 500, 'message' => 'There is some issue on the server, Please try again'));
							
					}
				
				}
				else{
					return json_output(409, array('status' => 409, 'message' => 'Email already exist!'));
				}
				
				
			}
			
			
			
		}
		
	}
	
	
	public function verify_post(){//Verify by verification_code
		
		$verification_code=$this->input->post("verification_code");
		
		
		if($verification_code&&strpos($verification_code,"_")!==false){
			
			$verification_code=explode("_",$verification_code);
			
			$verify_hash=$verification_code[0];
			$user_id=$verification_code[1];	
			
			if($verify_hash&&$user_id){
				
				$return=$this->Main_model->get_by_where("user",array("id"=>$user_id, "verify_hash"=>$verify_hash));
				
				if($return){
					
					$this->Main_model->update_rec($user_id,"user",array("status"=>"active", "email_verify"=>1));
					
					return json_output(200, array('status' => 200, 'message' => 'Account has been verified'));
					
				}
				
				else{
					return json_output(401, array('status' => 401, 'message' => 'Account has not been verified'));
				}
			
			}
		
			else{
				return json_output(400, array('status' => 400, 'message' => 'Bad request'));
			}
		}
		
		else{
			return json_output(400, array('status' => 400, 'message' => 'Bad request'));
		}
	}
	
	
	
	public function verifycode_post(){//Verify by 4 digits code
		
		$verify_4_digit=$this->input->post("verify_4digits");
		$user_id=$this->input->post("user-id");
		
		if($verify_4_digit&&$user_id){
						
			$return=$this->Main_model->get_by_where("user",array("id"=>$user_id, "verify_4_digit"=>$verify_4_digit));
			
			if($return){
				
				$this->Main_model->update_rec($user_id,"user",array("status"=>"active", "email_verify"=>1));
				
				return json_output(200, array('status' => 200, 'message' => 'Account has been verified'));
				
			}
			
			else{
				return json_output(401, array('status' => 401, 'message' => 'Account has not been verified'));
			}
			
			
		}
		
		else{
			return json_output(400, array('status' => 400, 'message' => 'Bad request'));
		}
	}
	
	
	public function resendcode_get(){
		
		$user_id=$this->input->get("user-id");
		
		if($user_id){
		
			$user_details=$this->Main_model->get_by_where_column_name("user_details", "mobile_code, mobile", array("user_id"=>$user_id));
			
			$user_info=$this->Main_model->get_by_where_column_name("user", "fname, lname, email", array("id"=>$user_id));
			
			if(!$user_info){
				return json_output(400, array('status' => 400, 'message' => 'Bad request'));exit;
			}
			
			
			$email=$user_info->email;
			$user_name=ucwords($user_info->fname." ".$user_info->lname);
			$mobile_num="+".$user_details->mobile_code.$user_details->mobile;
			
			$verify_4_digit=rand (1001, 9999);
			
			
			$return_1=$this->Main_model->update_rec($user_id, "user", array("verify_4_digit"=>$verify_4_digit));
			
			if($return_1){	
						
				  $website_name="";
				  //*********Getting website name according to auth and client name************
				  $client_name = $this->input->get_request_header('client-name', TRUE);
				  $auth_key  = $this->input->get_request_header('auth-key', TRUE);
				  
				  $q  = $this->db->select('website_name')->from('api_client')->where(array('client_name'=>$client_name, "authkey"=>$auth_key))->order_by("id","desc")->get()->row();
				   
				  $website_name=$q->website_name;
				  /*******End**************/
				  
				  $message_toSend_sms=$website_name.' PIN. Never share your code with anyone. '.$website_name.' employees will never ask for it. Your code is '.$verify_4_digit;
				  
				  $message_toSend_email="Hi ".$user_name.", <br>".$website_name.' PIN. Never share your code with anyone. '.$website_name.' employees will never ask for it. Your code is '.$verify_4_digit;
				  
				  //$message_toSend_sms=$verify_4_digit." is your ".$website_name." verification code.";
				  //$message_toSend_email="Hi ".$fname." ".$lname.", ".$verify_4_digit." is your ".$website_name." verification code.";
				  
				  $email_subject=$website_name." Verification Message";
				  
				  $this->sendSMS($mobile_num, $message_toSend_sms);
				  $this->sendEmail_sendgrid($email, $email_subject, $message_toSend_email);
				  
				  return json_output(200, array('status' => 200, 'message' => 'Verification 4 digit code has been sent'));
			}
			else{
				return json_output(400, array('status' => 400, 'message' => 'Bad request'));
			}
			
		}
		else{
			return json_output(400, array('status' => 400, 'message' => 'Bad request'));
		}
						
	}
	
	

	
}
