<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

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
	 
	public $login=null;

	function __construct()
    {
        parent::__construct();
		
		if(!$this->session->userdata("login")){
			exit(); 
		}
		
		$this->login=$this->session->userdata("login");
					
    }
    
    public function change_status(){

        $id=$this->input->post("id");
        $status=$this->input->post("is_checked");

        if($id&&$status){
            
            $this->Main_model->update_rec_by_where(["id"=>$id], "user", ["status"=>$status]);

            return true;
        }
        else{
            return false;
        }
    }
	
	public function details(){

        $id=$this->input->post("id");

        if($id){
            
            $user=$this->Main_model->get_by_where("user", ["id"=>$id]);

			if($user){
				echo json_encode($user);
			}
			else{
				return false;
			}
        }
        else{
            return false;
        }
    }
}

?>