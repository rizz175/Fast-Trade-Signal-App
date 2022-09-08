<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Geolocation extends MY_Controller {

	
	public function __construct() {
		
        parent::__construct();
		
		$this->load->model("Main_model");
		
				
    }

    public function save_post(){//Insert/update user lat and lng

        $user_id=$this->input->post("user_id");
        $lat=$this->input->post("lat");
        $lng=$this->input->post("lng");

        if($user_id&&$lng&&$lat){
            
            $last_updated=date("Y-m-d H:i:s");

            $already_exist=$this->Main_model->get_by_where_column_name("geo_location","id", ["user_id"=>$user_id]);

            if($already_exist){//Update it
                $this->Main_model->update_rec_by_where(["user_id"=>$user_id],"geo_location",["lat"=>$lat, "lng"=>$lng, "last_updated"=>$last_updated]);
            }
            else{//Insert new record
                $this->Main_model->insert_rec("geo_location", ["lat"=>$lat, "lng"=>$lng, "user_id"=>$user_id, "last_updated"=>$last_updated]);
            }

            return json_output(200, array('status' => 200, 'message' => 'Geo location has been updated!'));

        }
        else{
            return json_output(422, array('status' => 422, 'message' => 'Missing mandatory fields'));
        }
    }
    
}

?>