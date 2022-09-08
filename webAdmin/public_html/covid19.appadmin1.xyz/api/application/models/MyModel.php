<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyModel extends CI_Model {


    public function check_auth_client(){
        $client_name = $this->input->get_request_header('client-name', TRUE);
        $auth_key  = $this->input->get_request_header('auth-key', TRUE);
		
		if(empty($client_name)||empty($auth_key)){
			return false;
		}
		
		 $q  = $this->db->select('id')->from('api_client')->where(array('client_name'=>$client_name, "authkey"=>$auth_key))->order_by("id","desc")->get()->row();
		
        if($q){
            return true;
        } else {
            return false;//json_output(401,array('status' => 401,'message' => 'Unauthorized'));
        }
    }

    public function login($email,$password)
    {
		//If client name should be same
		//$client_name = $this->input->get_request_header('client-name', TRUE);
		//$q  = $this->db->select('id, password, status, email_verify, user_type, account_type')->from('user')->where(array('email'=>$email, "integrated_web_api_user"=>1, "api_client_name"=>$client_name))->get()->row();
		
        $q  = $this->db->select('id, password, status, fname, lname, email, profile_pic')->from('user')->where(array('email'=>$email))->get()->row();
        
		if($q){
            
			$hashed_password = $q->password;
            $id = $q->id;
            
			if(hash_equals($hashed_password, md5($password))) {
			  
			   if($q->status=="inactive"){
					return array('status' => 403,'message' => 'Inactive account', "user-id"=>$id);   
			   }
			   
               $last_login = date('Y-m-d H:i:s');
               
			   
			   $key = '';
				$keys = array_merge(range(0, 9), range('a', 'z'));
			
				for ($i = 0; $i < 32; $i++) {
					$key .= $keys[array_rand($keys)];
				}
			   
			   $token = $key;
			   //$token = crypt("8778o09ewjn23kR342A8#T&%*Ae",substr( md5(rand()), 0, 14));
               
			   $expired_at = date("Y-m-d H:i:s", strtotime('+120000 hours'));
               
			   $this->db->trans_start();
               
			   $this->db->where('id',$id)->update('user',array('last_login' => $last_login));
               
			   $this->db->insert('api_users_authentication',array('user_id' => $id,'token' => $token,'expired_at' => $expired_at));
               if($this->db->trans_status() === FALSE){
                  $this->db->trans_rollback();
                  return array('status' => 500,'message' => 'Internal server error');
               } else {
				  $this->db->trans_commit();
				  
				  $fname=$q->fname; 
				  $lname=$q->lname; 
				  $email=$q->email; 
				  $profile=$q->profile_pic;

				  if($profile){
					$profile=$this->config->item("admin_url")."assets/imgs/profile/200x200/".$profile;
				  }
				  else{

					$profile=$this->config->item("admin_url")."assets/imgs/profile/default.png";
				  }

                  return array('status' => 200,'message' => 'Successfully logged in', 'user-id' => (int)$id, 'token' => $token, "user_data"=>array("fname"=>$fname, "lname"=>$lname, "email"=>$email, "profile"=>$profile));
               }
			   
            } 
			
			else {
               return array('status' => 401,'message' => 'Wrong password');
            }
        }
		else{
			return array('status' => 401,'message' => 'User not found');
		}
    }
	
	
	public function social_login($social_id,$social_account_type)
    {
		//If client name should be same
		//$client_name = $this->input->get_request_header('client-name', TRUE);
		// $q  = $this->db->select('id, status, user_type, account_type')->from('user')->where(array('social_id'=>$social_id, "social_account_type"=>$social_account_type, "integrated_web_api_user"=>1, "api_client_name"=>$client_name))->get()->row();
		
        $q  = $this->db->select('id, status, fname, lname, email, profile_pic')->from('user')->where(array('social_id'=>$social_id, "social_account_type"=>$social_account_type))->get()->row();
        
		if($q){
            
            $id = $q->id;
			  
			  /*if($q->email_verify==0){ //Not Required in social login for a now
				   return array('status' => 403,'message' => 'Account is not verified', "user-id"=>$id);
			   }*/
			   if($q->status=="inactive"){
					return array('status' => 403,'message' => 'Inactive account');   
			   }
			   
               $last_login = date('Y-m-d H:i:s');
               
			   
			   $key = '';
				$keys = array_merge(range(0, 9), range('a', 'z'));
			
				for ($i = 0; $i < 32; $i++) {
					$key .= $keys[array_rand($keys)];
				}
			   
			   $token = $key;
			   //$token = crypt("8778o09ewjn23kR342A8#T&%*Ae",substr( md5(rand()), 0, 14));
               
			   $expired_at = date("Y-m-d H:i:s", strtotime('+120000 hours'));
               
			   $this->db->trans_start();
               
			   $this->db->where('id',$id)->update('user',array('last_login' => $last_login));
               
			   $this->db->insert('api_users_authentication',array('user_id' => $id, 'token' => $token,'expired_at' => $expired_at));
               if($this->db->trans_status() === FALSE){
                  $this->db->trans_rollback();
                  return array('status' => 500,'message' => 'Internal server error');
               } else {
				  $this->db->trans_commit();
				  
				  $fname=$q->fname; 
				  $lname=$q->lname; 
				  $email=$q->email; 
				  $profile=$q->profile_pic;

				  if($profile){
					$profile=$this->config->item("admin_url")."assets/imgs/profile/200x200/".$profile;
				  }
				  else{

					$profile=$this->config->item("admin_url")."assets/imgs/profile/default.png";
				  }

                  return array('status' => 200,'message' => 'Successfully logged in','user-id' => (int)$id, 'token' => $token, "user_data"=>array("fname"=>$fname, "lname"=>$lname, "email"=>$email, "profile"=>$profile));
               }
			   
             
			
        }
		else{
			return array('status' => 401,'message' => 'User not found');
		}
    }

    public function logout($user_id,$token)
    {   
        $this->db->where('user_id',$user_id)->where('token',$token)->delete('api_users_authentication');
        
		if($this->db->affected_rows()>0){
			return array('status' => 200,'message' => 'Successfully logout');
		}
		else{
			return array('status' => 200,'message' => 'Already logged out');
		}
    }






    public function check_auth_token()
    {
		
        $user_id  = $this->input->get_request_header('user-id', TRUE);
        $token     = $this->input->get_request_header('token', TRUE);
        
		$q  = $this->db->select('expired_at')->from('api_users_authentication')->where('user_id',$user_id)->where('token',$token)->order_by("id","desc")->get()->row();
		
		
        if($q == ""){
            return 1;//For un-authorized
        } else {
            if($q->expired_at < date('Y-m-d H:i:s')){
                return 2;//For Expired
            } else {
                $updated_at = date('Y-m-d H:i:s');
                $expired_at = date("Y-m-d H:i:s", strtotime('+120000 hours'));
                $this->db->where('user_id',$user_id)->where('token',$token)->update('api_users_authentication',array('expired_at' => $expired_at,'updated_at' => $updated_at));
                
				//return array('status' => 200,'message' => 'Authorized.');
            }
        }
    }

   

}
