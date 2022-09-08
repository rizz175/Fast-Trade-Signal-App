<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

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

		if(!$id){//insert product

            $title=$this->input->post("title");
			$description=$this->input->post("description");
            $price=$this->input->post("price");
            $quantity=$this->input->post("quantity");
			$status=$this->input->post("status");
			$discount_percentage=$this->input->post("discount_percentage");
			$discount_price=$this->input->post("discount_price");
			
			$return_imgname=$this->cover_img_upload();//For featured image
			$return_imgname_arr=$this->p_imgs_upload();//For product multiple images
            
            $cover_img="";
            if(@$return_imgname[0]){
			    $cover_img=$return_imgname[0];
            }

			$slug=$this->return_unique_slug($title);

			$data=[
				"title"=>$title,
				"slug"=>$slug,
				"description"=>$description,
                "price"=>$price,
                "quantity"=>$quantity,
				"status"=>$status,
				"cover_img"=>$cover_img,
				"user_id"=>$this->login->id,
				"listed_date"=>$dated,
				"modified_date"=>$dated,
				"discount_percentage"=>$discount_percentage,
				"discount_price"=>$discount_price
			];

			$return=$this->Main_model->insert_rec("products", $data);
			
			if($return){
				
				if($return_imgname_arr){//For inserting product gallery images
					$i=0;
					foreach($return_imgname_arr as $img){
						$i++;
						$this->Main_model->insert_rec("product_imgs", ["product_id"=>$return, "img"=>$img, "img_order"=>$i]);
					}
				}

				$this->session->set_flashdata('success', 'New product created!');	

				echo json_encode(array("status"=>200, "data"=>["id"=>$return]));
			}
			else{

				$this->session->set_flashdata('error', 'There was an issue while creating a new product! Kindly try again.');	

				echo json_encode(array("status"=>400, "data"=>array()));
			}
		}
		
		elseif($id){//Update product

            $title=$this->input->post("title");
			$description=$this->input->post("description");
			$price=$this->input->post("price");
			$status=$this->input->post("status");
			$quantity=$this->input->post("quantity");
			$discount_percentage=$this->input->post("discount_percentage");
			$discount_price=$this->input->post("discount_price");
			$img_order=$this->input->post("img_order");
			$remove_images=json_decode($this->input->post("remove_images"));

						
			
			$return_imgname=$this->cover_img_upload();//For featured image
			$return_imgname_arr=$this->p_imgs_upload();//For product multiple images
			
			$cover_img="";
            if(@$return_imgname[0]){
			    $cover_img=$return_imgname[0];
            }

			//$slug=$this->return_unique_slug($title);

			$data=[
				"title"=>$title,
				//"slug"=>$slug,
				"description"=>$description,
                "price"=>$price,
                "quantity"=>$quantity,
				"status"=>$status,
				"modified_date"=>$dated,
				"discount_percentage"=>$discount_percentage,
				"discount_price"=>$discount_price
			];

			$return_product_data=NULL;
			if($cover_img){
				$data["cover_img"]=$cover_img;

				//Getting image name
				$return_product_data=$this->Main_model->get_by_where_column_name("products", "cover_img", ["id"=>$id]);
			}

			$return=$this->Main_model->update_rec_by_where(["id"=>$id], "products", $data);
			
			if($return){
				
				if($return_imgname_arr){//For inserting product gallery images
					$i=$img_order;
					foreach($return_imgname_arr as $img){
						$i++;
						$this->Main_model->insert_rec("product_imgs", ["product_id"=>$id, "img"=>$img, "img_order"=>$i]);
					}
				}

				if($remove_images){//If previously uploaded gallery images need to be deleted

					foreach($remove_images as $r_img){
						$response=$this->Main_model->delete_rec("product_imgs", ["id"=>$r_img->id]);
						if($response){
							//Delete gallery image
							unlink("./assets/imgs/product/".$r_img->name);
							unlink("./assets/imgs/product/600w/".$r_img->name);
							unlink("./assets/imgs/product/200w/".$r_img->name);
						}
					}
				}

				if($return_product_data){//Removing featured image if exist previously
					if(!empty($return_product_data->cover_img)){
						//Delete previous image
						unlink("./assets/imgs/product/".$return_product_data->cover_img);
						unlink("./assets/imgs/product/600w/".$return_product_data->cover_img);
						unlink("./assets/imgs/product/200w/".$return_product_data->cover_img);
					}
				}

				$this->session->set_flashdata('success', 'Product has been updated!');	

				echo json_encode(array("status"=>200, "data"=>["id"=>$return]));
			}
			else{

				$this->session->set_flashdata('error', 'There was an issue while updating a product! Kindly try again.');	

				echo json_encode(array("status"=>400, "data"=>array()));
			}
        }
    }
	
	public function delete($id=NULL, $slug=NULL){

		if($id&&$slug){
			
			$return_product_data=$this->Main_model->get_by_where_column_name("products", "cover_img", ["id"=>$id, "slug"=>$slug]);

			if($return_product_data){
				
				$rec_delete=$this->Main_model->delete_rec("products", ["id"=>$id, "slug"=>$slug]);

				if($rec_delete){
					
					
					if(!empty($return_product_data->cover_img)){//Remove featured image
						//Delete previous image
						unlink("./assets/imgs/product/".$return_product_data->cover_img);
						unlink("./assets/imgs/product/600w/".$return_product_data->cover_img);
						unlink("./assets/imgs/product/200w/".$return_product_data->cover_img);
					}


					$gallery_imgs=$this->Main_model->get_by_where_column_name_all("product_imgs", "id, img", ["product_id"=>$id]);

					if($gallery_imgs){//Delete gallery images

						foreach($gallery_imgs as $single_img){
							$rec_delete__gallery=$this->Main_model->delete_rec("product_imgs", ["id"=>$single_img->id]);

							if($rec_delete__gallery){
								unlink("./assets/imgs/product/".$single_img->img);
								unlink("./assets/imgs/product/600w/".$single_img->img);
								unlink("./assets/imgs/product/200w/".$single_img->img);
							}
						}
					}
				}

				$this->session->set_flashdata('error', 'Product has been removed!');	


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
			$return=$this->Main_model->get_by_where("products",array("slug"=>$slug));
			
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
			$slug="product-number";	
		}
		
		return $slug;
	
	}




    private function cover_img_upload(){

		if (!empty($_FILES['file']))
		{
						
			$config['upload_path'] = "./assets/imgs/product/";
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
 
           			$this->_createThumbnail_600w($finfo['file_name'],"imgs/product/");
					
					array_push($fileNames,$finfo['file_name']);	
						
				}
			}

			if ($errors > 0) {
				echo $this->upload->display_errors();
			}
			
			return $fileNames;

		}
        
        else{
            return array();
        }
	
    }
	
	

	private function p_imgs_upload(){

		if (!empty($_FILES['files']))
		{
						
			$config['upload_path'] = "./assets/imgs/product/";
			$config['allowed_types'] = 'gif|jpg|jpeg|png|ogv';
			
				
			$config['max_size']      =   "50000000000";
	 
		 	//$config['max_width']     =   "1907";
		 
			//$config['min_width']     =   "500";
		 	
			$config['encrypt_name'] = TRUE;
	 
		  	//$config['max_height']    =   "1280";


			$this->load->library('upload');
			
			
			$files           = $_FILES;
			$number_of_files = count($_FILES['files']['name']);
			$errors = 0;

			$fileNames=array();
			
			// codeigniter upload just support one file
			// to upload. so we need a litte trick
			for ($i = 0; $i < $number_of_files; $i++)
			{
				$_FILES['file']['name'] = $files['files']['name'][$i];
				$_FILES['file']['type'] = $files['files']['type'][$i];
				$_FILES['file']['tmp_name'] = $files['files']['tmp_name'][$i];
				$_FILES['file']['error'] = $files['files']['error'][$i];
				$_FILES['file']['size'] = $files['files']['size'][$i];

				// we have to initialize before upload
				$this->upload->initialize($config);

				if (! $this->upload->do_upload("file")) {
					$errors++;
				}
				
				else{
					
           			$finfo=$this->upload->data();
 
           			$this->_createThumbnail_600w($finfo['file_name'],"imgs/product/");
					
					array_push($fileNames,$finfo['file_name']);	
						
				}
			}

			if ($errors > 0) {
				echo $this->upload->display_errors();
			}
			
			return $fileNames;

		}
        
        else{
            return array();
        }
	
    }


	private function _createThumbnail_600w($filename,$path){
		
		$config['image_library']    = "gd2";      

		$config['source_image']     = "./assets/".$path.$filename;  

		$config['new_image'] = APPPATH."../assets/".$path."600w/".$filename;    

	//$config['create_thumb']     = TRUE;     

	// $config['thumb_marker']     = '_thumb';  

		$config['maintain_ratio']   = TRUE;          

		$config['width'] = "600";

        $config['height'] = "600"; 

		$this->load->library('image_lib');
		
		$this->image_lib->initialize($config);
		//$this->image_lib->initialize($config);
		
		if(!$this->image_lib->resize())

		{

			echo $this->image_lib->display_errors();

		}  
		
		$this->image_lib->clear();  
		
		$this->_createThumbnail_200w($filename,$path);  

	}


	private function _createThumbnail_200w($filename,$path){
		
		$config['image_library']    = "gd2";      

		$config['source_image']     = "./assets/".$path."600w/".$filename;  

		$config['new_image'] = APPPATH."../assets/".$path."200w/".$filename;    

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