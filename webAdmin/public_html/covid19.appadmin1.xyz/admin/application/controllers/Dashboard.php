<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

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
	
	private $blog_user_arr=[];
	private $product_user_arr=[];
// Test
	function __construct()
    {
        parent::__construct();
		
		if(!$this->session->userdata("login")){
			header('Location: '.base_url());
			exit(); 
		}	
					
	}
	
	
	public function index()
	{	
		$users=$this->Main_model->record_count("user");
		$blogs=$this->Main_model->record_count("blogs");

		$products=$this->Main_model->count_all_by_where("products", ["quantity>="=>1, "status"=>1]);

		//-------------Calculating the monthly sales--------------------
		$from=date('Y-m-d', strtotime('-1 month'));
		$to=date('Y-m-d');

		$this->db->where(["dated>="=>$from, "dated<="=>$to, "order_status"=>"completed"]);
		$this->db->select("sum(grand_total) as total_sale, Date_Format(dated,'%m/%d') as dated")->from("orders");
		$this->db->group_by("dated");
		$this->db->order_by("dated","asc");

		$query = $this->db->get();

		$dated=[];
		$sales=[];
		$total_sales_sum=0;

		if ($query->num_rows()>0){
			$data = $query->result();

			foreach($data as $row){
				$dated[]=$row->dated;
				$sales[]=$row->total_sale;
				$total_sales_sum+=$row->total_sale;
			}
		}
		//---End----------Calculating the monthly sales--------------------


		$this->load->view("dashboard", array("pagetitle"=>"Dashboard", "activeMenu"=>"dashboard", "users"=>$users, "blogs"=>$blogs, "products"=>$products, "sales"=>$sales, "dated"=>$dated, "total_sales_sum"=>$total_sales_sum));
	}
	
	public function track($type=NULL){
		
		if($type=="users"){

			$positive=0;
			$negative=0;

			$geolocation=$this->Main_model->get_all("geo_location");

			if($geolocation){
				foreach($geolocation as $row){
					$res__assessment=$this->Main_model->get_by_where_column_name_order_by("tb_assessment","result",["user_id"=>$row->user_id],"id","desc");

					if($res__assessment){
						$row->result=$res__assessment->result;

						if($res__assessment->result=="0"){
							$positive++;
						}else{
							$negative++;
						}
					}else{
						$row->result=1;
						$negative++;
					}
				}
			}

			//var_dump($geolocation);exit;
			
			$this->load->view("track/trackusers", array("pagetitle"=>"Track Users", "geolocation"=>$geolocation, "activeMenu"=>"trackusers", "positive"=>$positive, "negative"=>$negative));
		}
		else{
			$this->load->view("error_404");
		}
	}
	
	public function cirlceviolation(){

		$this->db->order_by("cv.id","desc");
		$this->db->select("cv.lat, cv.lng, cv.dated, user.id as user_id, user.fname, user.lname, user.profile_pic")->from("circle_violation as cv");
		$this->db->join("user","cv.user_id=user.id","left");
			
		$query = $this->db->get();

		$data=[];
		if ($query->num_rows()>0){
			$data = $query->result();
		}

		//var_dump($data);exit;

		$this->load->view("track/circleviolation", ["data"=>$data, "pagetitle"=>"Circle Violations", "activeMenu"=>"circleviolations"]);
	}

	public function users(){
		
		$this->db->where("user_type!=","superadmin");
		$users=$this->Main_model->get_all_colname("user", "id, social_account_type, user_points, concat_ws(' ',fname,lname) as username, email, location, mob_code, mobile, age, profile_pic, dated, status, last_login, address1, address2");

		if($users)
		{
			$now = new DateTime;
			foreach($users as $row){

				$row->assessment_count=$this->Main_model->count_all_by_where("tb_assessment", ["user_id"=>$row->id]);
					
				$ago = new DateTime($row->dated);
				$diff = $now->diff($ago);

				$total_assesement_required=$diff->d*3;
				
				$row->assessment_count=$total_assesement_required-$row->assessment_count-2;
			}
		}

		$this->load->view("users", array("pagetitle"=>"Users", "users"=>$users, "activeMenu"=>"users"));
	}
	
	
	public function blog($type=NULL, $id=NULL, $slug=NULL){
		
		if($type=="add"){
			$this->load->view("blogs/add_blog", array("pagetitle"=>"Add Blog", "activeMenu"=>"blogs"));
		}
		elseif($type=="edit"){

			$blog=$this->Main_model->get_by_where("blogs",["id"=>$id, "slug"=>$slug]);

			if($blog){

				$this->blog_user_arr=[];

				$blog=$this->get_single_blog($blog);
		
				$data["pagetitle"]="Update Blog";
				$data["blog"]=$blog;
				$data["activeMenu"]="blogs";

				$this->load->view("blogs/update_blog", $data);
			}
			else{
				$this->load->view("error_404");
			}
		}

		elseif($type=="all"){

			$blogs=$this->Main_model->get_all("blogs");
			
			if($blogs){

				$this->blog_user_arr=[];

				foreach($blogs as $blog){
					
					$blog=$this->get_single_blog($blog);
				}
			}

			$data["pagetitle"]="All Blogs";
			$data["blogs"]=$blogs;
			$data["activeMenu"]="blogs";

			$this->load->view("blogs/all_blogs", $data);
		}
		else{
			$this->load->view("error_404");
		}
	}
	


	public function product($type=NULL, $id=NULL, $slug=NULL){
		
		if($type=="add"){
			$this->load->view("products/add", array("pagetitle"=>"Add New Product", "activeMenu"=>"products"));
		}
		elseif($type=="edit"){

			$product=$this->Main_model->get_by_where("products",["id"=>$id, "slug"=>$slug]);

			if($product){

				$this->product_user_arr=[];

				$product=$this->get_single_product($product);
				
				$product->images=$this->Main_model->get_by_where_all_order_col("product_imgs",["product_id"=>$id], "img_order", "asc");

				$product->img_order=0;

				if(!$product->images){
					$product->images=[];
				}else{
					foreach($product->images as $img){
						$img->img_name=$img->img;
						$img->img=site_url("assets/imgs/product/200w/").$img->img;
						
						$product->img_order=$img->img_order;//For getting last image_order number
					}
				}

				$data["pagetitle"]="Update Product";
				$data["data"]=$product;
				$data["activeMenu"]="products";

				$this->load->view("products/update", $data);
			}
			else{
				$this->load->view("error_404");
			}
		}

		elseif($type=="all"){

			$products=$this->Main_model->get_all("products");
			
			if($products){

				$this->product_user_arr=[];

				foreach($products as $product){
					
					$product=$this->get_single_product($product);
				}
			}

			$data["pagetitle"]="All Products";
			$data["data"]=$products;
			$data["activeMenu"]="products";

			$this->load->view("products/all", $data);
		}
		else{
			$this->load->view("error_404");
		}
	}
	

	public function orders($type=NULL){
		
		if($type=="all"){

			$this->db->order_by("orders.id","desc");
			$this->db->select("orders.*, user.fname, user.lname, user.profile_pic")->from("orders");
			$this->db->join("user","orders.user_id=user.id","left");
			
			$query = $this->db->get();

			$data=[];
			if ($query->num_rows()>0){
				$data = $query->result();
			}

			//var_dump($data);exit;

			$data2["pagetitle"]="Orders";
			$data2["data"]=$data;
			$data2["activeMenu"]="Orders";

			$this->load->view("orders/all", $data2);
		}
		else{
			$this->load->view("error_404");
		}
	}
	
	public function settings(){
		
		$login=$this->session->userdata("login");

		if($login){

			
			$ret_user=$this->Main_model->get_by_where_column_name("user","*",array("id"=>$login->id));	
					
			if($ret_user){
				
				$profile_pic=$ret_user->profile_pic;

				$ret_user->profile_pic=base_url()."assets/imgs/profile/default.png";
				
				if($profile_pic){
					
					$ret_user->profile_pic=base_url()."assets/imgs/profile/200x200/".$profile_pic;
					
				}

				$data["pagetitle"]="Profile Settings";
				$data["data"]=$ret_user;
				$data["activeMenu"]="settings";

				$this->load->view("settings", $data);
					
			}

			else{
				$this->load->view("error_404");
			}
		}

		else{
			$this->load->view("error_404");
		}
	}
	
	public function logout(){
		
		$this->session->unset_userdata("login");	
		header('Location: '.base_url());
		exit(); 
	}
	







	private function get_single_blog($blog){
		
		if(!in_array($blog->user_id, $this->blog_user_arr)){
						
			$return_userdata=$this->Main_model->get_by_where_column_name("user", "concat_ws(' ',fname,lname) as name", ["id"=>$blog->user_id]);

			if($return_userdata){
				$this->blog_user_arr[$blog->user_id]=$return_userdata->name;
			}
		}

		$blog->username=@$this->blog_user_arr[$blog->user_id];

		$blog->added_timeago=$this->time_elapsed_string($blog->listed_date);
		$blog->updated_timeago=$this->time_elapsed_string($blog->modified_date);

		if($blog->cover_img){
			$blog->cover_img=site_url("assets/imgs/blog/600x335/").$blog->cover_img;
		}else{
			$blog->cover_img=site_url("assets/imgs/blog/default.jpg");
		}

		return $blog;
	}


	private function get_single_product($product){
		
		if(!in_array($product->user_id, $this->product_user_arr)){
						
			$return_userdata=$this->Main_model->get_by_where_column_name("user", "concat_ws(' ',fname,lname) as name", ["id"=>$product->user_id]);

			if($return_userdata){
				$this->product_user_arr[$product->user_id]=$return_userdata->name;
			}
		}

		$product->username=@$this->product_user_arr[$product->user_id];

		$product->added_timeago=$this->time_elapsed_string($product->listed_date);
		$product->updated_timeago=$this->time_elapsed_string($product->modified_date);

		if($product->cover_img){
			$product->cover_img=site_url("assets/imgs/product/200w/").$product->cover_img;
		}else{
			$product->cover_img=site_url("assets/imgs/blog/default.jpg");
		}

		return $product;
	}
}
