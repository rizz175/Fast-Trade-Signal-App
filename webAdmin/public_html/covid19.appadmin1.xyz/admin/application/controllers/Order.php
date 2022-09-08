<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller {

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
        $status=$this->input->post("status");

        if($id&&$status){
            
            $this->Main_model->update_rec_by_where(["id"=>$id], "orders", ["order_status"=>$status]);

            return true;
        }
        else{
            return false;
        }
    }


    public function details(){

        $id=$this->input->post("id");

        if($id){

            $this->db->where("order_details.order_id",$id);
            $this->db->select("order_details.*, products.title, products.slug, products.cover_img")->from("order_details");
            
            $this->db->join("products","order_details.product_id=products.id");

            $query = $this->db->get();

			$data=[];
			if ($query->num_rows()>0){
                $data = $query->result();
                
                foreach($data as $row){
                    if($row->cover_img){
                        $row->cover_img=site_url("assets/imgs/product/200w/").$row->cover_img;
                    }else{
                        $row->cover_img=site_url("assets/imgs/blog/default.jpg");
                    }
                }
			}
            
            echo json_encode($data);
        }
        else{
            return false;
        }
    }
    
}

?>