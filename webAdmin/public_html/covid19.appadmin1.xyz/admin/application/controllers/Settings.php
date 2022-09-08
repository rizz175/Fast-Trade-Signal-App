<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

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
	
	
	public function save($id=NULL)
	{

        $login=$this->session->userdata("login");

        $id=$login->id;

		if($id){//Update user info
            
            $dated=date("Y-m-d H:i:s");
        
            $fname=$this->input->post("fname");
			$lname=$this->input->post("lname");
			$password=$this->input->post("password");
			$cpassword=$this->input->post("cpassword");
            $realpass=$this->input->post("realpass");
            
            $data=["fname"=>$fname, "lname"=>$lname, "modified_date"=>$dated];
            
            if($password==$cpassword){
                if($password!=$realpass){
                    $data["password"]=md5($password);
                }
            }
            
			$return_imgname=$this->img_upload();
			
			$profile_pic="";
            if(@$return_imgname[0]){
			    $profile_pic=$return_imgname[0];
            }

			
			$return_data=NULL;
			if($profile_pic){
				$data["profile_pic"]=$profile_pic;

				//Getting image name
				$return_data=$this->Main_model->get_by_where_column_name("user", "profile_pic", ["id"=>$id]);
			}

			$return=$this->Main_model->update_rec_by_where(["id"=>$id], "user", $data);
			
			if($return){
                
                $login_user_updated_data=$this->Main_model->get_by_where("user", ["id"=>$id]);
                if($login_user_updated_data){
                    $this->session->set_userdata("login",$login_user_updated_data);//Updating the session
                }
                
				if($return_data){
					if(!empty($return_data->profile_pic)){
						//Delete previous image
						unlink("./assets/imgs/profile/".$return_data->profile_pic);
						unlink("./assets/imgs/profile/200x200/".$return_data->profile_pic);
					}
				}

				$this->session->set_flashdata('success', 'Profile has been updated!');	

				echo json_encode(array("status"=>200, "data"=>["id"=>$return]));
			}
			else{

				$this->session->set_flashdata('error', 'There was an issue while updating profile! Kindly try again.');	

				echo json_encode(array("status"=>400, "data"=>array()));
			}
        }else{
            
            $this->session->set_flashdata('error', 'There was an issue while updating profile! Kindly try again.');	

			echo json_encode(array("status"=>400, "data"=>array()));
        }
    }
	




    private function img_upload(){

		if (!empty($_FILES))
		{
						
			$config['upload_path'] = "./assets/imgs/profile/";
			$config['allowed_types'] = 'gif|jpg|jpeg|png|ogv';
			
				
			$config['max_size']      =   "50000000000";
	 
		 	//$config['max_width']     =   "1907";
		 
			//$config['min_width']     =   "500";
		 	
			$config['encrypt_name'] = TRUE;
	 
		  	//$config['max_height']    =   "1280";


			$this->load->library('upload');
			
			
			$files           = $_FILES;
			$number_of_files = count($_FILES['file']['name']);
			$errors = 0;

			$fileNames=array();
			
			// codeigniter upload just support one file
			// to upload. so we need a litte trick
			for ($i = 0; $i < $number_of_files; $i++)
			{
				$_FILES['file']['name'] = $files['file']['name'][$i];
				$_FILES['file']['type'] = $files['file']['type'][$i];
				$_FILES['file']['tmp_name'] = $files['file']['tmp_name'][$i];
				$_FILES['file']['error'] = $files['file']['error'][$i];
				$_FILES['file']['size'] = $files['file']['size'][$i];

				// we have to initialize before upload
				$this->upload->initialize($config);

				if (! $this->upload->do_upload("file")) {
					$errors++;
				}
				
				else{
					
           			$finfo=$this->upload->data();
 
           			$this->_createThumbnail_200w($finfo['file_name'],"imgs/profile/");
					
					array_push($fileNames,$finfo['file_name']);	
						
				}
			}

			if ($errors > 0) {
				echo $this->upload->display_errors();
			}
			
			return $fileNames;

		}
        
        else{
            return array(null);
        }
	
    }
	
	


	private function _createThumbnail_200w($filename,$path){
		
		$config['image_library']    = "gd2";      

		$config['source_image']     = "./assets/".$path.$filename;  

		$config['new_image'] = APPPATH."../assets/".$path."200x200/".$filename;    

        //$config['create_thumb']     = TRUE;     

        // $config['thumb_marker']     = '_thumb';  

		$config['maintain_ratio']   = TRUE;          

		$config['width'] = "200";

        $config['height'] = "200"; 

		$this->load->library('image_lib');
		
		$this->image_lib->initialize($config);
		//$this->image_lib->initialize($config);
		
		if(!$this->image_lib->resize())

		{

			echo $this->image_lib->display_errors();

		}  
		
		$this->image_lib->clear();  
		

	}



}