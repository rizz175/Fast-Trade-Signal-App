<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends MY_Controller {

	
	public function __construct() {
		
        parent::__construct();
		
		$this->load->model("Main_model");
		
		
		$this->img_url=$this->config->item("admin_url")."assets/imgs/blog/600x335/";
		$this->img_url_large=$this->config->item("admin_url")."assets/imgs/blog/1200x675/";
		
	}
	
	
	
	public function all_get(){
		
		//***************Page handling********************
		$rec_per_page=$this->config->item("rec_per_page");
		
		$current_page=$this->input->get("page")?$this->input->get("page"):1;
		
		if(!is_numeric($current_page)){
			$current_page=1;
		}
		else{
			$current_page=(int)$current_page;
		}
		//******************
		
		$where=array("status"=>1);
				
		$total_blogs=$this->Main_model->count_all_by_where("blogs",$where);
		
		$total_pages=ceil($total_blogs/$rec_per_page);
		
		
		$end_limit=$current_page*$rec_per_page;
		
		$start_limit=$end_limit-$rec_per_page;
		
		
		$this->db->order_by("id","desc");
		$data=$this->Main_model->get_table_by_where_limit("blogs", $where, $rec_per_page, $start_limit);
		
				
		if($data){
			foreach($data as $row){
				
				if($row->cover_img){
					$row->cover_img=$this->img_url.$row->cover_img;
				}
				else{
					$row->cover_img="";//$this->config->item("admin_url")."assets/imgs/blog/default.jpg";
				}
				
				// if($row->tags){
				// 	$row->tags=explode(",",$row->tags);	
				// }
				
				//For getting blogger details
				if($row->user_id){
					
					$ret_user=$this->Main_model->get_by_where_column_name("user","fname, lname, profile_pic",array("id"=>$row->user_id));	
					
					if($ret_user){
						
						$row->blogger_detail=(object)array();
						
						$row->blogger_detail->name=$ret_user->fname." ".$ret_user->lname;
						
						$row->blogger_detail->profile_pic=$this->config->item("admin_url")."assets/imgs/profile/default.png";
						
						if($ret_user->profile_pic){
							
							
							$row->blogger_detail->profile_pic=$this->config->item("admin_url")."assets/imgs/profile/200x200/".$ret_user->profile_pic;
							
							
						}
							
					}
				}
				
				if($row->youtube==NULL||$row->youtube==null||$row->youtube=="null"||$row->youtube=="NULL"){
					$row->youtube="";
				}

				unset($row->user_id);
				unset($row->tags);
				unset($row->category);
				unset($row->comment_count);
			}
			
		}else{
			$data=array();	
		}
		
		
		//print_r("<pre>");var_dump($data);print_r("</pre>");
		
		return json_output(200, array('status' => 200, "current_page"=>$current_page, 'total_records' => $total_blogs, "total_pages"=>$total_pages, 'data' => $data));
		
	}
	
	
	public function details_get(){
		
		$slug=$this->input->get("slug");
				
		if($slug){
			
			$row=$this->Main_model->get_by_where("blogs", array("slug"=>$slug, "status"=>1));
		
			if($row){
				
				if($row->cover_img){
					$row->cover_img=$this->img_url_large.$row->cover_img;
				}
				else{
					$row->cover_img=$this->config->item("admin_url")."assets/imgs/blog/default.jpg";
				}
				
				// if($row->tags){
				// 	$row->tags=explode(",",$row->tags);	
				// }
				
				//For getting blogger details
				if($row->user_id){
					
					$ret_user=$this->Main_model->get_by_where_column_name("user","fname, lname, profile_pic",array("id"=>$row->user_id));	
					
					if($ret_user){
						
						$row->blogger_detail=(object)array();
						
						$row->blogger_detail->name=$ret_user->fname." ".$ret_user->lname;
						
						$row->blogger_detail->profile_pic=$this->config->item("admin_url")."assets/imgs/profile/default.png";
						
						if($ret_user->profile_pic){
							
							
							$row->blogger_detail->profile_pic=$this->config->item("admin_url")."assets/imgs/profile/200x200/".$ret_user->profile_pic;
							
							
						}
							
					}
				}
				
				if($row->youtube==NULL||$row->youtube==null||$row->youtube=="null"||$row->youtube=="NULL"){
					$row->youtube="";
				}
				
				unset($row->user_id);
				unset($row->tags);
				unset($row->category);
				unset($row->comment_count);
				
				
				
				$row->previous="";
				$row->next="";
				
				$next=$this->db->query("select slug from blogs where id = (select min(id) from blogs where id > ".$row->id." and status=1)")->row();
				
				
				$prev=$this->db->query("select slug from blogs where id = (select max(id) from blogs where id < ".$row->id." and status=1)")->row();
				
				if($prev){
					$row->previous=$this->getSingleBlogDetails($prev->slug);
				}else{
					
					$prev=$this->db->query("select slug from blogs where id = (select max(id) from blogs where status=1)")->row();
					
					if($prev){
						$row->previous=$this->getSingleBlogDetails($prev->slug);
					}
				}
				
				if($next){
					$row->next=$this->getSingleBlogDetails($next->slug);
				}else{
					
					$next=$this->db->query("select slug from blogs where id = (select min(id) from blogs where status=1)")->row();
					
					if($next){
						$row->next=$this->getSingleBlogDetails($next->slug);
					}
				}
				
				//Swapping to show in frontend 
				$temp=$row->previous;
				$row->previous=$row->next;
				$row->next=$temp;
				
				return json_output(200, array('status' => 200, 'data' => $row));
			}
			else{
				return json_output(404, array('status' => 404, "message"=>"Blog not found", 'data' => array()));	
			}
			
			
		}
		
		else{
			return json_output(404, array('status' => 404, "message"=>"Blog not found", 'data' => array()));
		}
	}
	
	
	// public function tags_get(){
		
		
	// 	$country=$this->input->get("country")?$this->input->get("country"):"";
		
	// 	$where=array("status"=>1);
	// 	if($country){
	// 		$country=strtolower($country);
			
	// 		$country_code=$this->Main_model->get_by_where("countries",array("country_name"=>$country));
			
	// 		if($country_code){
	// 			$country_code=strtolower($country_code->country_code);
	// 		}else{
	// 			$country_code="cy";
	// 		}
			
	// 		$where=array("country"=>$country_code, "status"=>1);
	// 	}
				
	// 	$return=$this->Main_model->get_by_where_all_colname_order_col("blogs","tags",$where,"id","desc");
		
	// 	$tags=array();
		
	// 	if($return){
			
	// 		foreach($return as $row){
				
	// 			if(!empty($row->tags)){
	// 				$splitTags=explode(",",$row->tags);
	// 				//$tags=array_diff($tags,$splitTags);	
	// 				$tags=array_merge($tags,$splitTags);
	// 			}
	// 		}
			
	// 		$tags=array_unique($tags,SORT_LOCALE_STRING);
	// 		$tags=array_values($tags);
	// 	}
		
		
	// 	return json_output(200, array('status' => 200, 'data' => $tags));
		
		
	// }
	
	
	private function getSingleBlogDetails($slug=NULL){
						
		if($slug){
			
			$row=$this->Main_model->get_by_where("blogs", array("slug"=>$slug, "status"=>1));
		
			if($row){
				
				if($row->cover_img){
					$row->cover_img=$this->img_url_large.$row->cover_img;
				}
				else{
					$row->cover_img=$this->config->item("admin_url")."assets/imgs/blog/default.jpg";
				}
				
				// if($row->tags){
				// 	$row->tags=explode(",",$row->tags);	
				// }
				
				//For getting blogger details
				if($row->user_id){
					
					$ret_user=$this->Main_model->get_by_where_column_name("user","fname, lname, profile_pic",array("id"=>$row->user_id));	
					
					if($ret_user){
						
						$row->blogger_detail=(object)array();
						
						$row->blogger_detail->name=$ret_user->fname." ".$ret_user->lname;
						
						$row->blogger_detail->profile_pic=$this->config->item("admin_url")."assets/imgs/profile/default.png";
						
						if($ret_user->profile_pic){
							
							
							$row->blogger_detail->profile_pic=$this->config->item("admin_url")."assets/imgs/profile/200x200/".$ret_user->profile_pic;
							
							
						}
							
					}
				}
				
				if($row->youtube==NULL||$row->youtube==null||$row->youtube=="null"||$row->youtube=="NULL"){
					$row->youtube="";
				}

				unset($row->user_id);
				unset($row->tags);
				unset($row->category);
				unset($row->comment_count);
				
				return $row;
			}
			else{
				return false;
			}
			
		}else{
			return false;
		}
	}
	
}
