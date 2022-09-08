<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		redirect($this->config->item("documentation_url"));
		//$this->load->view('welcome_message');
	}
	
	public function testaka(){
		
		$className="company";
		$methodName="resendcode";
		
		$class_function_withoutTokens=array(array("auth"=>"login"), array("auth"=>"logout"), array("company"=>"register"), array("company"=>"verify"), array("company"=>"verifycode"), array("company"=>"resendcode"), array("listings"=>"all"), array("listings"=>"show")); 
		
		//Here just client-name and auth-key will be checked
		if(in_array(array($className=>$methodName),$class_function_withoutTokens)){
			echo "yes";
		}
		
		exit;
		
		//$array1=array("a"=>1, "b"=>"", "c"=>222);
		
		//var_dump(array_filter($array1));
		
		$verify_4_digit=rand ( 1001 , 9999);
		
		echo $verify_4_digit;
		
	}
	
	public function check_email(){
		
		$this->sendSMS("+923225838977","Testing sms");
		$this->sendEmail_sendgrid("ahsankhan88889@gmail.com","Property available","Hi, There is beautiful villa available.");
		
	}
}
