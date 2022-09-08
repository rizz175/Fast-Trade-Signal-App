<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller {

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
		$dated=date("Y-m-d H:i:s");

		if(!$id){//insert blog

            $title=$this->input->post("title");
			$description=$this->input->post("description");
			$youtube=$this->input->post("youtube");
			$status=$this->input->post("status");
			
			$return_imgname=$this->blog_cover_img_upload();
			
			$cover_img=$return_imgname[0];

			$slug=$this->return_unique_slug($title);

			$data=[
				"title"=>$title,
				"slug"=>$slug,
				"description"=>$description,
				"youtube"=>$youtube,
				"status"=>$status,
				"cover_img"=>$cover_img,
				"user_id"=>$this->login->id,
				"listed_date"=>$dated,
				"modified_date"=>$dated
			];

			$return=$this->Main_model->insert_rec("blogs", $data);
			
			if($return){

				$this->session->set_flashdata('success', 'New blog created!');	

				echo json_encode(array("status"=>200, "data"=>["id"=>$return]));
			}
			else{

				$this->session->set_flashdata('error', 'There was an issue while creating a new blog! Kindly try again.');	

				echo json_encode(array("status"=>400, "data"=>array()));
			}
		}
		
		elseif($id){//Update blog

            $title=$this->input->post("title");
			$description=$this->input->post("description");
			$youtube=$this->input->post("youtube");
			$status=$this->input->post("status");
			
			$return_imgname=$this->blog_cover_img_upload();
			
			$cover_img=$return_imgname[0];

			//$slug=$this->return_unique_slug($title);

			$data=[
				"title"=>$title,
				//"slug"=>$slug,
				"description"=>$description,
				"youtube"=>$youtube,
				"status"=>$status,
				"modified_date"=>$dated
			];

			$return_blog_data=NULL;
			if($cover_img){
				$data["cover_img"]=$cover_img;

				//Getting image name
				$return_blog_data=$this->Main_model->get_by_where_column_name("blogs", "cover_img", ["id"=>$id]);
			}

			$return=$this->Main_model->update_rec_by_where(["id"=>$id], "blogs", $data);
			
			if($return){
				
				if($return_blog_data){
					if(!empty($return_blog_data->cover_img)){
						//Delete previous image
						unlink("./assets/imgs/blog/".$return_blog_data->cover_img);
						unlink("./assets/imgs/blog/1200x675/".$return_blog_data->cover_img);
						unlink("./assets/imgs/blog/600x335/".$return_blog_data->cover_img);
					}
				}

				$this->session->set_flashdata('success', 'Blog has been updated!');	

				echo json_encode(array("status"=>200, "data"=>["id"=>$return]));
			}
			else{

				$this->session->set_flashdata('error', 'There was an issue while updating a blog! Kindly try again.');	

				echo json_encode(array("status"=>400, "data"=>array()));
			}
        }
    }
	
	public function delete($id=NULL, $slug=NULL){

		if($id&&$slug){
			
			$return_blog_data=$this->Main_model->get_by_where_column_name("blogs", "cover_img", ["id"=>$id, "slug"=>$slug]);

			if($return_blog_data){
				
				$rec_delete=$this->Main_model->delete_rec("blogs", ["id"=>$id, "slug"=>$slug]);

				if($rec_delete){
					if(!empty($return_blog_data->cover_img)){
						//Delete previous image
						unlink("./assets/imgs/blog/".$return_blog_data->cover_img);
						unlink("./assets/imgs/blog/1200x675/".$return_blog_data->cover_img);
						unlink("./assets/imgs/blog/600x335/".$return_blog_data->cover_img);
					}
				}

				$this->session->set_flashdata('error', 'Blog has been removed!');	


				header('Location: '.$_SERVER["HTTP_REFERER"]);
			}
			else{
				$this->load->view("error_404");
			}
		}
		else{
			$this->load->view("error_404");
		}

	}

	private function return_unique_slug($title){
		
		$slug_copy=$slug=substr($this->make_slug($title),0,189);
	  
		$is_unique_slug=false;
		$i=1;
		do{
			$return=$this->Main_model->get_by_where("blogs",array("slug"=>$slug));
			
			if($return){
				$slug=$slug_copy."-".$i;
			}
			
			else{
				$is_unique_slug=true;
			}
			
			$i++;
			
		}while(!$is_unique_slug);

		return $slug;
	
	}


	private function make_slug($string=NULL)
	{
		$slug=strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
		
		if(strlen($slug)==0){
			$slug="blog-number";	
		}
		
		return $slug;
	
	}




    private function blog_cover_img_upload(){

		if (!empty($_FILES))
		{
						
			$config['upload_path'] = "./assets/imgs/blog/";
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
 
           			$this->_createThumbnail_1200x675($finfo['file_name'],"imgs/blog/");
					
					array_push($fileNames,$finfo['file_name']);	
						
				}
			}

			if ($errors > 0) {
				echo "Error";
			}
			
			return $fileNames;

		}
        
        else{
            return array(null);
        }
	
    }
	
	


	private function _createThumbnail_1200x675($filename,$path){
		
		$config['image_library']    = "gd2";      

		$config['source_image']     = "./assets/".$path.$filename;  

		$config['new_image'] = APPPATH."../assets/".$path."1200x675/".$filename;    

	//$config['create_thumb']     = TRUE;     

	// $config['thumb_marker']     = '_thumb';  

		$config['maintain_ratio']   = TRUE;      

		$config['height'] = "675";      

		$config['width'] = "1200";

		$this->load->library('image_lib');
		
		$this->image_lib->initialize($config);
		//$this->image_lib->initialize($config);
		
		if(!$this->image_lib->resize())

		{

			echo $this->image_lib->display_errors();

		}  
		
		$this->image_lib->clear();  
		
		$this->_createThumbnail_600x335($filename,$path);  

	}


	private function _createThumbnail_600x335($filename,$path){
		
		$config['image_library']    = "gd2";      

		$config['source_image']     = "./assets/".$path."1200x675/".$filename;  

		$config['new_image'] = APPPATH."../assets/".$path."600x335/".$filename;    

	//$config['create_thumb']     = TRUE;     

	// $config['thumb_marker']     = '_thumb';  

		$config['maintain_ratio']   = TRUE;      

		$config['height'] = "335";      

		$config['width'] = "600";

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