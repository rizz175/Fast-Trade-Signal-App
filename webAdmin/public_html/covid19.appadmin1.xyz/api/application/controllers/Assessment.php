<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessment extends MY_Controller {

	
	public function __construct() {
		
        parent::__construct();
		
		$this->load->model("Main_model");
		
				
    }

    public function save_post(){//Insert/update user lat and lng
        
        $dated=date("Y-m-d H:i:s");
        $user_id=$this->input->get_request_header('user-id', TRUE);
        $temperature=$this->input->post("temperature");
        $avg_percentage=$this->input->post("assessment_percentage");

       
        if($user_id&&$temperature!=""&&$avg_percentage!=""){

            $result=1;//Fine
            if($avg_percentage<33){
                $result=0;//Risky
            }
            
            //Insert new record
            $this->Main_model->insert_rec("tb_assessment", ["avg_percentage"=>$avg_percentage, "user_id"=>$user_id, "temperature"=>$temperature, "dated"=>$dated, "result"=>$result]);
            

            return json_output(200, array('status' => 200, 'message' => 'Assessment has been saved successfully!'));

        }
        else{
            return json_output(422, array('status' => 422, 'message' => 'Missing mandatory fields'));
        }
    }



    public function send100meter_notification_get($user_id=NULL){

        if($user_id){

            $ret_latlng=$this->Main_model->get_by_where("geo_location", ["user_id"=>$user_id]);

            if($ret_latlng){
                
                $lat=$ret_latlng->lat;
                $lng=$ret_latlng->lng;


                //Getting all users under 100 meters of area
                $this->db->having("distance<=",(0.06213)); //100 Meters /*Default is in Mile so converting miles to meters*/
                
                $user_ids=$this->Main_model->get_by_column_name_all("geo_location","user_id, (3959 * acos(cos(radians('".$lat."')) * cos(radians(lat)) * cos( radians(lng) - radians('".$lng."')) + sin(radians('".$lat."')) * sin(radians(lat)))) as distance");	
                
                
                if($user_ids){

                    $user_ids_arr=[$user_id];

                    $total_covid_patients=0;

                    foreach($user_ids as $row){
                        
                        //$user_ids_arr[]=$row->user_id;

                        //Counting the total patients
                        $this->db->where(["user_id"=>$row->user_id]);
                        $this->db->order_by("dated","desc");
                        $this->db->limit(1);
                        $this->db->from("tb_assessment");

                        $res_row=$this->db->get()->row();

                        if($res_row){
                            if($res_row->result==0){
                                $total_covid_patients++;       
                            }
                        }
                    }
                    
                    
                    


                    if($total_covid_patients>0){
                        
                        $dated=Date("Y-m-d");

                        foreach($user_ids_arr as $row){/*For sending push notifications by checking first if not already sent with same count within same date*/
                            
                            $data=["user_id"=>$row, "dated"=>$dated, "patient_count"=>$total_covid_patients];

                            $already_sent=$this->Main_model->get_by_where("push_notification_history", $data);

                            if(!$already_sent){
                                
                                $u_t=$total_covid_patients>1?"users":"user";

                                $body="You have ".$total_covid_patients." ".$u_t." that have been predicted positive in your 100m radius";

                                $single_user=$this->Main_model->get_by_where_column_name("user", "firebase_token", ["id"=>$row]);

                                if($single_user){

                                    if(!empty($single_user->firebase_token)){

                                        $firebase_token=$single_user->firebase_token;

                                        //Send push notification from here
                                        $this->send_firebase_notification($firebase_token, "CRMPS Alert", $body);
                                    }
                                }

                                //Saving in history
                                $this->Main_model->insert_rec("push_notification_history", $data);
                            }
                        }
                    }
                    
                }

                var_dump($total_covid_patients);
            }

        }

    } 
    
}

?>