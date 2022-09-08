<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
	
	private $unique_imgname=NULL;

	public function __construct() {
		
        parent::__construct();
		
		$this->load->model("Main_model");
	}
	 
	
	public function profile_post($d=NULL){

		if($d=="upload"){

			$base64_img=$this->input->post("base64_img");

			if(empty($base64_img)){
				return json_output(422, array('status' => 422, 'message' => 'Missing mandatory fields'));
				exit;
			}

			try{

				$user_id=$this->input->get_request_header('user-id', TRUE);
				$token=$this->input->get_request_header('token', TRUE);

				define('UPLOAD_DIR', '../admin/assets/imgs/profile/');

				$image_parts = @explode(";base64,", $base64_img);

				$image_type_aux = @explode("image/", $image_parts[0]);

				$image_type = @$image_type_aux[1];

				$image_base64 = @base64_decode($image_parts[1]);

				$this->unique_imgname=md5(uniqid().time().$user_id.$token).'.png';

				$file = UPLOAD_DIR . $this->unique_imgname;

				//$path="imgs/profile/";
				//echo APPPATH."../admin/assets/".$path."200x200/";;

				$img_uploaded=@file_put_contents($file, $image_base64);
				
				if($img_uploaded){

					$this->_createThumbnail_200x200($this->unique_imgname, "imgs/profile/");

					$return_user_data=$this->Main_model->get_by_where_column_name("user", "profile_pic", ["id"=>$user_id]);

					if($return_user_data){
						
						$rec_update=$this->Main_model->update_rec_by_where(["id"=>$user_id], "user", ["profile_pic"=>$this->unique_imgname]);

						if($rec_update){
							if(!empty($return_user_data->profile_pic)){
								//Delete previous image
								@unlink("../admin/assets/imgs/profile/".$return_user_data->profile_pic);
								@unlink("../admin/assets/imgs/profile/200x200/".$return_user_data->profile_pic);
							}
						}
					}

					$new_url=$this->config->item("admin_url")."assets/imgs/profile/200x200/".$this->unique_imgname;

					return json_output(200, array('status' => 200, "profile"=>$new_url, 'message' => 'Profile picture has been uploaded successfully!'));
				}
				else{

					
					return json_output(400, array('status' => 400, 'message' => 'There is some issue while uploading profile picture!'));

				}
			}
			catch (\Exception $e)
			{
				return json_output(400, array('status' => 400, 'message' => 'There is some issue while uploading profile picture!'));
			}

			
		}
	}


	private function _createThumbnail_200x200($filename,$path){
		
		$this->load->library('upload');

		$config['image_library']    = "gd2";      

		$config['source_image']     = "../admin/assets/".$path.$filename;
		
		//return APPPATH."../../admin/assets/".$path."200x200/".$filename;

		$config['new_image'] = APPPATH."../../admin/assets/".$path."200x200/".$filename; //APPPATH."../admin/assets/".$path."200x200/".$filename;    

		//$config['create_thumb']     = TRUE;     

		// $config['thumb_marker']     = '_thumb';  

		$config['maintain_ratio']   = TRUE;      

		//$config['height'] = "200";      

		$config['width'] = "200";

		$this->load->library('image_lib');
		
		$this->image_lib->initialize($config);
		
		if(!$this->image_lib->resize()){

			echo $this->image_lib->display_errors();

		}  
		
		$this->image_lib->clear();  
		
	}


	public function circle_violation_post(){
		
		$user_id=$this->input->post("user_id");
		$lat=$this->input->post("lat");
		$lng=$this->input->post("lng");

		if($user_id&&$lat&&$lng){

			$dated=date("Y-m-d H:i:s");

			$this->Main_model->insert_rec("circle_violation", ["user_id"=>$user_id, "lat"=>$lat, "lng"=>$lng, "dated"=>$dated]);

			return json_output(200, array('status' => 200, 'message' => 'Record saved!'));
		}
		else{
			return json_output(422, array('status' => 422, 'message' => 'Missing mandatory fields'));
		}

	}

	public function userhealthstatus_get(){
		
		$user_id=$this->input->get_request_header('user-id', TRUE);

		if($user_id){


			$rec=$this->Main_model->get_by_where_all_order_col_limit("tb_assessment",["user_id"=>$user_id], "id","desc",1);

			$return=["assessment_percentage"=>NULL, "temperature"=>NULL];

			if($rec){
				$return["assessment_percentage"]=(int)$rec[0]->avg_percentage;
				$return["temperature"]=(int)$rec[0]->temperature;
			}

			return json_output(200, array('status' => 200, 'data' => $return));
		}
		else{
			return json_output(422, array('status' => 422, 'message' => 'Missing mandatory fields'));
		}

	}



	public function firebasetoken_post(){
		
		$user_id=$this->input->get_request_header('user-id', TRUE);
		$firebase_token=$this->input->post("firebase_token");

		if($user_id&&$firebase_token){

			$rec=$this->Main_model->update_rec_by_where(["id"=>$user_id], "user",["firebase_token"=>$firebase_token]);

			return json_output(200, array('status' => 200, 'message' => "Token updated!"));
		}
		else{
			return json_output(422, array('status' => 422, 'message' => 'Missing mandatory fields'));
		}

	}


	public function weekly_fever_stats_get(){
		
		$user_id=$this->input->get_request_header('user-id', TRUE);
		
		if($user_id){
			
			$to=Date("Y-m-d");
			$from=Date("Y-m-d",strtotime("-7 days"));
			
			$this->db->where(array("dated>"=>$from, "dated<="=>$to));
			$this->db->where("user_id", $user_id);
			$this->db->group_by("Date(dated)");
			//$this->db->order_by("dated","desc");
			$this->db->select("ROUND(avg(temperature),2) as average_temperature, Date(dated) as date")->from("tb_assessment");
			
			$query = $this->db->get();

			$rows=[];
			if ( $query->num_rows() > 0 )
			{
				$rows = $query->result();
			}


			return json_output(200, array('status' => 200, 'data' => $rows));
		}
		else{
			return json_output(422, array('status' => 422, 'message' => 'Missing mandatory fields'));
		}

	}



	public function covidpatients_under100meter_get(){

		$user_id=$this->input->get_request_header('user-id', TRUE);

        if($user_id){

			$total_covid_patients=0;
			$return_userinfo_arr=[];

            $ret_latlng=$this->Main_model->get_by_where("geo_location", ["user_id"=>$user_id]);

            if($ret_latlng){
                
                $lat=$ret_latlng->lat;
                $lng=$ret_latlng->lng;


                //Getting all users under 100 meters of area
                $this->db->having("distance<=",(0.06213)); //100 Meters /*Default is in Mile so converting miles to meters*/
                
                $user_ids=$this->Main_model->get_by_column_name_all("geo_location","user_id, (3959 * acos(cos(radians('".$lat."')) * cos(radians(lat)) * cos( radians(lng) - radians('".$lng."')) + sin(radians('".$lat."')) * sin(radians(lat)))) as distance, lat, lng");	
                
                
                if($user_ids){

                    $user_ids_arr=[];

                    foreach($user_ids as $row){
                        $user_ids_arr[]=$row->user_id;

                        //Counting the total patients
                        $this->db->where(["user_id"=>$row->user_id]);
                        $this->db->order_by("dated","desc");
                        $this->db->limit(1);
                        $this->db->from("tb_assessment");

                        $res_row=$this->db->get()->row();

                        if($res_row){
                            if($res_row->result==0){

								$user_info=$this->Main_model->get_by_where_column_name("user", "address1, address2", ["id"=>$row->user_id]);

								$address1=$address2="";

								if($user_info){
									$address1=$user_info->address1;
									$address2=$user_info->address2;
								}

								$return_userinfo_arr[]=["user_id"=>$row->user_id, "lat"=>$row->lat, "lng"=>$row->lng, "address1"=>$address1, "address2"=>$address2];

                                $total_covid_patients++;       
                            }
                        }
					}
				}
				
			}

			return json_output(200, array('status' => 200, 'total_covid_patients' => $total_covid_patients, "data"=>$return_userinfo_arr));
		}

		else{
			return json_output(422, array('status' => 422, 'message' => 'Missing mandatory fields'));
		}
	}
	
}
