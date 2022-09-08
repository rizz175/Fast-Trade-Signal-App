<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	function __construct()
    {
        parent::__construct();
		
		if($this->session->userdata("login")){
			header('Location: '.site_url("dashboard"));
			exit(); 
		}	
				
			
	}
	
	
	public function index()
	{
		$this->load->view("login");
	}
	
	
	public function login(){
		
		$email=$this->input->post("email");
		$password=$this->input->post("password");
		
		if($email&&$password){
			
			$return=$this->Main_model->get_by_where("user", array("email"=>$email, "password"=>md5($password)));
			
			if($return){
				
				if($return->user_type=="superadmin"){
					
					$this->session->set_userdata("login", $return);
					
					$this->session->set_flashdata('success', 'Successfully logged in');	
					
					header('Location: '.base_url("dashboard"));
					exit();
					
				}
				
				else{
				
					$this->session->set_flashdata('error', 'You don\'t have permission to login!');	
					
					header('Location: '.base_url());
					exit();
				}
			}
			
			else{
				
				$this->session->set_flashdata('error', 'Email or Password is incorrect!');	
				
				header('Location: '.base_url());
				exit();
			}
			
			
		}
		else{
		
			$this->session->set_flashdata('error', 'Missing mandatory fields!');	
			
			header('Location: '.base_url());
			exit();
		}
	}
	
	public function notfound(){
		$this->load->view("error_404", array("heading"=>"Page not found", "message"=>""));	
	}
	
}
