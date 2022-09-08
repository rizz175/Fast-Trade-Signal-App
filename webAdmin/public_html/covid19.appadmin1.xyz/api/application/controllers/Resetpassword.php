<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resetpassword extends MY_Controller {
	
	
	public function __construct() {
		
        parent::__construct();
		
		$this->load->model("Main_model");
		
	}
	 
	
	
	
	//Submit Form to send reset password email with url
	public function submitrequest_post(){
		
		$email=$this->input->post("forgot-password-email");
		$redirect_url=$this->input->post("redirect-url");
		
		if(!empty($email)&&!empty($redirect_url)){
			
		$result=$this->Main_model->get_by_where_column_name("user","id, verify_hash, password, fname, lname",array("email"=>$email));
		
		if($result){
			
			
			//*********Getting website name according to auth and client name************
			$client_name = $this->input->get_request_header('client-name', TRUE);
			$auth_key  = $this->input->get_request_header('auth-key', TRUE);
			
			$q  = $this->db->select('website_name')->from('api_client')->where(array('client_name'=>$client_name, "authkey"=>$auth_key))->order_by("id","desc")->get()->row();
			 
			$website_name=$q->website_name;
			/*******End**************/
			
			
			
			$this->load->library('encryption');
		
			$reset_password_key = bin2hex($this->encryption->create_key(16));
			
			$update_rec=array();
			
			if(empty($result->verify_hash)){ //If empty verify hash key fill it as well because needed in url
				
				$verify_hash=md5($result->password.$email);
				
				$update_rec=array("verify_hash"=>$verify_hash, "reset_password_key"=>$reset_password_key);
				
				$result->verify_hash=$verify_hash;
				
			}
			
			else{
				$update_rec=array("reset_password_key"=>$reset_password_key);
			}
				
				
			$this->Main_model->update_rec_by_where(array("email"=>$email),"user",$update_rec);
				
			
			$url=$redirect_url."?key=".$reset_password_key."&id=".$result->id."&hash=".$result->verify_hash;
			
			
			$user_name=ucwords($result->fname." ".$result->lname);
			$message=$this->load->view("Email/Reset_password",array("name"=>$user_name, "url"=>$url, "website_name"=>$website_name), TRUE);	
			
			$return=$this->sendEmail_sendgrid($email,("Reset Password - ".$website_name), $message);
					
			return json_output(200, array('status' => 200, 'message' => "Reset password email has been sent to ".$email));
		}
		
		else{ //Handle form if no email found
			
			return json_output(404, array('status' => 404, 'message' => "No such email exist in our system!"));
			
		}
		
		}
		
		else{
			
			return json_output(422, array('status' => 422, 'message' => "Missing mandatory parameters!"));
			
		}
	}
	
	
	
	//Changing password from here
	public function changepassword_post(){
		
		$id=$this->input->post("id");
		$verify_hash=$this->input->post("hash");
		$reset_password_key=$this->input->post("key");
		$password=$this->input->post("new-password");
		
		
		if($id&&$verify_hash&&$reset_password_key&&$password){
			
			$password=md5($password);
			
			$where=array("id"=>$id, "verify_hash"=>$verify_hash, "reset_password_key"=>$reset_password_key);
			
			$result=$this->Main_model->get_by_where_column_name("user", "email", $where);
			
			if($result){
				
				if(!$this->check_password_pattern($this->input->post("new-password"))){
					return json_output(422, array('status' => 422, 'message' => 'Passwords must be at least 8 characters long and must contain atleast one lowercase, uppercase and numeric character'));
				}
				
				else{
					
					$this->Main_model->update_rec_by_where($where,"user",array("password"=>$password));
					
					return json_output(200, array('status' => 200, 'message' => "Password has been updated", "email"=>$result->email));
				
				}
			}
			else{//If wrong parameters provided
				
				
				return json_output(404, array('status' => 404, 'message' => "Invalid tokens are provided"));
			}
			
			
		}
		else{
			return json_output(422, array('status' => 422, 'message' => "Missing mandatory parameters!"));
		}
	}
	
	
	
	
}
