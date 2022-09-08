<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller {

	
	public function __construct() {
		
        parent::__construct();
		
		$this->load->model("Main_model");
				
    }
    
    public function save_forprocessing_post(){

        $user_id=$this->input->get_request_header('user-id', TRUE);

        $transaction_type=$this->input->post("transaction_type");
        $address=$this->input->post("address");
        $mobile=$this->input->post("mobile");
        $transaction_status ="processing";
        $dated=date("Y-m-d H:i:s");

        $products=$this->input->post("products");

        //echo json_encode($products);exit;

        if(!in_array($transaction_type, ["paypal", "cash on delivery"])){
            return json_output(401, array('status' => 401, 'message' => 'Invalid data provided'));
        }
        elseif(!$transaction_type||!$address||!$products){
            return json_output(422, array('status' => 422, 'message' => 'Missing mandatory fields'));
        }
        else{

            $products=json_decode($products, true);
            
            $grand_total=0;

            foreach($products as $product){
                if(!@$product['product_id']||!@$product['single_item_price']||!@$product['quantity']){
                    return json_output(401, array('status' => 401, 'message' => 'Invalid data provided'));exit;
                }
                $grand_total+=($product['single_item_price']*$product['quantity']);
            }

            $token=md5($user_id.$transaction_type.$grand_total.$dated);

            $order=["user_id"=>$user_id, "transaction_type"=>$transaction_type, "grand_total"=>$grand_total, "address"=>$address, "mobile"=>$mobile, "transaction_status"=>$transaction_status, "dated"=>$dated, "token"=>$token];

            $order_id=$this->Main_model->insert_rec("orders",$order);

            foreach($products as $product){
                $order_details=["user_id"=>$user_id, "order_id"=>$order_id, "product_id"=>$product['product_id'], "single_item_price"=>$product['single_item_price'], "quantity"=>$product['quantity'], "dated"=>$dated];

                $this->Main_model->insert_rec("order_details",$order_details);
            }

            return json_output(200, array('status' => 200, 'message' => 'Order is on processing', "order_id"=>$order_id, "token"=>$token, "order_status"=>"processing"));

        }

        

    }

    public function confirm_transaction_post(){

        $user_id=$this->input->get_request_header('user-id', TRUE);

        $order_id=$this->input->post("order_id");
        $token=$this->input->post("token");
        $transaction_status=$this->input->post("transaction_status");
        $transaction_id=$this->input->post("transaction_id");
        $transaction_token=$this->input->post("transaction_token");

        if((!$transaction_id&&$transaction_status=="1")||!$token||!$order_id||!($transaction_status=="0"||$transaction_status=="1")||$transaction_status==""){
            return json_output(422, array('status' => 422, 'message' => 'Missing mandatory fields'));
        }
        else{
            $where=["user_id"=>$user_id, "id"=>$order_id, "token"=>$token];
            
            $is_exist=$this->Main_model->get_by_where("orders",$where);

            if(!$is_exist){
                return json_output(401, array('status' => 401, 'message' => 'Invalid data provided'));
            }else{

                $transaction_status_set="failed";
                if($transaction_status==1){
                    $transaction_status_set="completed";
                }

                $this->Main_model->update_rec_by_where($where, "orders", ["transaction_status"=>$transaction_status_set, "transaction_id"=>$transaction_id, "transaction_token"=>$transaction_token]);

                return json_output(200, array('status' => 200, 'message' => 'Transaction status has been updated successfully'));
            }
        }

    }
	
    
}

?>