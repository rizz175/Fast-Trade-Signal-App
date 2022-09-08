<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {


	public function __construct() {
		
        parent::__construct();
		
		$this->load->model("Main_model");
		
	}
	
	
	public function login_post()
	{
				
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
		if($email&&$password){      		
			
			$response = $this->MyModel->login($email,$password);
			return json_output($response['status'],$response);
		}
		
		else{
			return json_output(400, array('status' => 400, 'message' => 'Bad request'));
		}
		
	}
	
	
	public function social_login_post()
	{
				
		$id = $this->input->post('social_id');
		$type = strtolower($this->input->post('type'));
		
		if($id&&$type){      		
			
			$response = $this->MyModel->social_login($id,$type);
			return json_output($response['status'],$response);
		}
		
		else{
			return json_output(400, array('status' => 400, 'message' => 'Bad request'));
		}
		
	}
	

	public function logout_post()
	{	
		$user_id = $this->input->post('user-id');
        $token = $this->input->post('token');
		
		if($user_id&&$token){
			
		    $response = $this->MyModel->logout($user_id,$token);
			return json_output($response['status'],$response);
			
		}
		else{
			return json_output(400, array('status' => 400, 'message' => 'Bad request'));
		}
	}
	
	
	
	
	public function register_post(){
		
		if(empty($this->input->post())){
			return json_output(400, array('status' => 400, 'message' => 'Bad request'));
		}
		
		else{
			
			
			$dated=date("Y-m-d H:i:s");
			$status="active";
			
			$fname=ucfirst($this->input->post("fname"));
			$lname=ucfirst($this->input->post("lname"));
			$email=strtolower($this->input->post("email"));
			$password=md5($this->input->post("password"));
						
			$mobile_code="+".str_replace("+","",$this->input->post("mobile_code"));
			$mobile=$this->input->post("mobile");
			
			$location=$this->input->post("location");
			$address1=$this->input->post("address1");
			$address2=$this->input->post("address2");
			$age=$this->input->post("age");
			
			
			if($this->is_empty($fname)||$this->is_empty($lname)||$this->is_empty($email)||$this->is_empty($this->input->post("password"))||$this->is_empty($mobile_code)||$this->is_empty($mobile)||$this->is_empty($location)||$this->is_empty($age)){
				
				return json_output(422, array('status' => 422, 'message' => 'Missing mandatory fields'));
			}
			
			
			/*elseif(!$this->check_password_pattern($this->input->post("password"))){
					return json_output(422, array('status' => 422, 'message' => 'Passwords must be at least 8 characters long and must contain atleast one lowercase, uppercase and numeric character'));
			}*/
			
			else{
			
				
				/*****For Checking Mobile Number*****/
				$mobile=str_replace(($mobile_code),"",$mobile);//If Country code inside mobile input
				/*******/
				
				$email_exist=$this->Main_model->get_by_where("user",array("email"=>$email));
				
				if(!$email_exist){
				
					$verify_hash=md5($password.$email);
					
					//$verify_4_digit=rand (1001, 9999);
					
					$client_name = $this->input->get_request_header('client-name', TRUE);
					
					$user_info=array("user_type"=>"user", "fname"=>$fname, "lname"=>$lname, "email"=>$email, "password"=>$password, "dated"=>$dated, "modified_date"=>$dated, "status"=>$status, "verify_hash"=>$verify_hash, "api_client_name"=>$client_name, "address1"=>$address1, "address2"=>$address2, "location"=>$location, "mob_code"=>$mobile_code, "mobile"=>$mobile, "age"=>$age);
					
					$last_id=$this->Main_model->insert_rec("user",$user_info);
					
					$profile=$this->config->item("admin_url")."assets/imgs/profile/default.png";

					$token=$this->generate_user_login_token($last_id);

					return json_output(201, array('status' => 201, "user-id"=>(int)$last_id, "token"=>$token, "user_data"=>array("fname"=>$fname, "lname"=>$lname, "email"=>$email, "profile"=>$profile), 'message' => 'Account has been created successfully!'));				
									
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
			
			
			$dated=date("Y-m-d H:i:s");
			$status="active";
			
			$fname=ucfirst($this->input->post("fname"));
			$lname=ucfirst($this->input->post("lname"));
			$email=strtolower($this->input->post("email"));
			$social_id=$this->input->post("social_id");
			$social_account_type=strtolower($this->input->post("type"));
						
			$mobile_code="+".str_replace("+","",$this->input->post("mobile_code"));
			$mobile=$this->input->post("mobile");
			
			$location=$this->input->post("location");
			$address1=$this->input->post("address1");
			$address2=$this->input->post("address2");
			$age=$this->input->post("age");
			
			
			if($this->is_empty($fname)||$this->is_empty($lname)||$this->is_empty($email)||$this->is_empty($mobile_code)||$this->is_empty($mobile)||$this->is_empty($location)||$this->is_empty($age)||$this->is_empty($social_id)||$this->is_empty($social_account_type)){
				
				return json_output(422, array('status' => 422, 'message' => 'Missing mandatory fields'));
			}
			
			
			/*elseif(!$this->check_password_pattern($this->input->post("password"))){
					return json_output(422, array('status' => 422, 'message' => 'Passwords must be at least 8 characters long and must contain atleast one lowercase, uppercase and numeric character'));
			}*/
			
			else{
			
				
				/*****For Checking Mobile Number*****/
				$mobile=str_replace(($mobile_code),"",$mobile);//If Country code inside mobile input
				/*******/
				
				$socialAccount_exist=$this->Main_model->get_by_where("user",array("social_id"=>$social_id, "social_account_type"=>$social_account_type));
				
				if($socialAccount_exist){
					return json_output(409, array('status' => 409, 'message' => 'Social account already exist!'));	
				}
				
				
				$email_exist=$this->Main_model->get_by_where("user",array("email"=>$email));
				
				if(!$email_exist&&!$socialAccount_exist){
				
					$verify_hash=md5(rand(1001, 9999).$email);
					
					//$verify_4_digit=rand (1001, 9999);
					
					$client_name = $this->input->get_request_header('client-name', TRUE);
					
					$user_info=array("user_type"=>"user", "fname"=>$fname, "lname"=>$lname, "email"=>$email, "password"=>md5("p!!as#@swo23423aA3dr*(d64^".rand(1001, 9999)), "dated"=>$dated, "modified_date"=>$dated, "status"=>$status, "verify_hash"=>$verify_hash, "api_client_name"=>$client_name, "address1"=>$address1, "address2"=>$address2, "location"=>$location, "mob_code"=>$mobile_code, "mobile"=>$mobile, "age"=>$age, "social_account_type"=>$social_account_type, "social_id"=>$social_id);
					
					$last_id=$this->Main_model->insert_rec("user",$user_info);
					
					$profile=$this->config->item("admin_url")."assets/imgs/profile/default.png";

					$token=$this->generate_user_login_token($last_id);
					
					return json_output(201, array('status' => 201, "user-id"=>(int)$last_id, "token"=>$token, "user_data"=>array("fname"=>$fname, "lname"=>$lname, "email"=>$email, "profile"=>$profile), 'message' => 'Account has been created successfully!'));				
									
				}
				else{
					return json_output(409, array('status' => 409, 'message' => 'Email already exist!'));
				}
				
				
			}
			
			
			
		}
		
	}


	private function generate_user_login_token($user_id){
		
		$key = '';
		$keys = array_merge(range(0, 9), range('a', 'z'));
	
		for ($i = 0; $i < 32; $i++) {
			$key .= $keys[array_rand($keys)];
		}
	   
	   $token = $key;
	   //$token = crypt("8778o09ewjn23kR342A8#T&%*Ae",substr( md5(rand()), 0, 14));
	   
	   $expired_at = date("Y-m-d H:i:s", strtotime('+120000 hours'));
	   $last_login = date('Y-m-d H:i:s');

	   $this->db->where('id',$user_id)->update('user',array('last_login' => $last_login));
	   
	   $this->db->insert('api_users_authentication',array('user_id' => $user_id, 'token' => $token,'expired_at' => $expired_at));

	   return $token;
	}
	
}
