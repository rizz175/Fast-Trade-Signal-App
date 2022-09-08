<?php

class Main_model extends CI_Model{

    function __construct() {
        parent::__construct();
    }
	
	public function insert_rec($table,$data)
	{
		 $success_data = $this->db->insert($table, $data);
         return $this->db->insert_id();
	}
	
	public function insert_rec_unique($table,$data)
	{
		 $q=$this->db->select("id")->from($table)->where($data)->get();
		 
		 if($q->num_rows()<=0){
		 	$success_data = $this->db->insert($table, $data);
         	return $this->db->insert_id();
		 }
		 
		 return 0;
	}
	
	
	
	public function get_by_where($table,$where)
    {
        $this->db->select('*')->from($table)->where($where);
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $row = $query->row();
            return $row;
        }else{
            return false;
        }

    }
	
	//---------------------------------------------------------------------------------
	public function get_by_where_all($table,$where)
    {
        $this->db->select('*')->from($table)->where($where)->order_by("id","desc");
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	public function get_by_where_all_orwhere($table,$where,$orwhere)
    {
		$this->db->where($where);
		$this->db->or_where($orwhere);
		
        $this->db->select('*')->from($table)->order_by("id","desc");
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	
	
	public function get_by_where_orwhere($table,$where,$orwhere)
    {
		
        $this->db->select('*')->from($table)->order_by("id","desc");
	
		$this->db->group_start();
			$this->db->where($where);
		$this->db->group_end();
		
		$this->db->or_group_start();
			$this->db->where($orwhere);
		$this->db->group_end();
		
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $row = $query->row();
            return $row;
        }else{
            return false;
        }

    }
	
	public function get_by_where_all_orwhere_colname($table,$where,$orwhere,$colname)
    {
		$this->db->where($where);
		$this->db->or_where($orwhere);
		
        $this->db->select($colname)->from($table)->order_by("id","desc");
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	
	public function get_by_where_all_order($table,$where,$order)
    {
        $this->db->select('*')->from($table)->where($where)->order_by("id",$order);
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	public function get_by_where_all_order_col($table,$where,$colname,$order)
    {
        $this->db->select('*')->from($table)->where($where)->order_by($colname,$order);
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	
	public function get_by_where_all_colname_order_col($table,$column,$where,$colname,$order)
    {
        $this->db->select($column)->from($table)->where($where)->order_by($colname,$order);
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	
	public function get_by_where_all_order_col_limit($table,$where,$colname,$order,$limit)
    {
		$this->db->limit($limit); 
        $this->db->select('*')->from($table)->where($where)->order_by($colname,$order);
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	
	
	public function get_by_colname_all_order_limit_start_end($table,$columns,$colname,$order,$limit,$start, $where=NULL)
    {
		$this->db->limit($limit, $start);
        $this->db->select($columns)->from($table)->order_by($colname,$order);
		
		if($where){
			$this->db->where($where);	
		}
		
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	
	
	public function get_by_colname_all_order_col_limit($table,$columns,$colname,$order,$limit, $where=NULL)
    {
		$this->db->limit($limit); 
        $this->db->select($columns)->from($table)->order_by($colname,$order);
		
		if($where){
			$this->db->where($where);	
		}
		
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	//-----------------------------------------------------------------------------------
	
	
	public function get_all($table)
    {
        $this->db->select('*')->from($table)->order_by("id","desc");
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	
	
	public function get_all_colname($table,$colname)
    {
        $this->db->select($colname)->from($table)->order_by("id","desc");
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	
	
	public function get_by_where_column_name($table,$column,$where)
    {
        $this->db->select($column)->from($table)->where($where);
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $row = $query->row();
            return $row;
        }else{
            return false;
        }

    }
	
	public function get_by_where_column_name_order_by($table,$column,$where,$orderCol,$orderType)
    {
        $this->db->select($column)->from($table)->where($where)->order_by($orderCol,$orderType);;
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $row = $query->row();
            return $row;
        }else{
            return false;
        }

    }
	
	
	public function get_by_column_name_all($table,$column)
    {
        $this->db->select($column)->from($table);
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	
	public function get_by_where_column_name_all($table,$column,$where)
    {
        $this->db->select($column)->from($table)->where($where);
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	
	
	//This function is using in Bazaraki Monopolion Props Controller,... 
	public function get_by_wherein_where_column_name_all_2($table,$column,$where,$fieldname,$wherein)
    {
        $this->db->select($column)->from($table)->where($where);
		
		if(count($wherein)>0){
			
			$this->db->group_start();
			$where_in_chunks = array_chunk($wherein,25); //Grouping in 25 because of getting sometime memory exceed error
			foreach($where_in_chunks as $where_in_ids)
			{
				$this->db->or_where_in($fieldname, $where_in_ids);
			}
			$this->db->group_end();
		}
		
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	
	public function get_by_wherein_where_column_name_all($table,$column,$where,$fieldname,$wherein)
    {
        $this->db->select($column)->from($table)->where($where);
		
		if(count($wherein)>0){
			
			$this->db->group_start();
			$where_in_chunks = array_chunk($wherein,25); //Grouping in 25 because of getting sometime memory exceed error
			foreach($where_in_chunks as $where_in_ids)
			{
				$this->db->or_where_in($fieldname, $where_in_ids);
			}
			$this->db->group_end();
		}
		
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	
	
	
	public function get_by_wherein_orwhere_column_name_all($table,$column,$where,$fieldname,$wherein)
    {
        $this->db->select($column)->from($table);
		
		if(count($wherein)>0){
			$this->db->where_in($fieldname,$wherein);
		}
		
		$this->db->or_where($where);
		
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	
	
	public function get_by_where_in_all($table,$fieldname,$wherein)
    {
        $this->db->select("*")->from($table);
		
		if(count($wherein)>0){
			$this->db->where_in($fieldname,$wherein);
		}
		
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	
	//--------------------------------------------------------------------------------
	public function get_all_column($table,$cols)
    {
        $this->db->select($cols)->from($table)->order_by("id","desc");
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	public function get_all_column_order($table,$cols,$order)
    {
        $this->db->select($cols)->from($table)->order_by("id",$order);
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	//---------------------------------------------------------------------------------
	
	
	public function update_rec($id,$table,$data)
	{
		 $this->db->where("id",$id);
		 $success_data = $this->db->update($table, $data);
         return $success_data;
	}
	
	public function update_rec_by_where($where,$table,$data)
	{
		 $this->db->where($where);
		 $success_data = $this->db->update($table, $data);
         return $success_data;
	}
	
	public function delete_rec($table,$where)
	{
		 $this->db->where($where);
		 $response = $this->db->delete($table);
         return $response;
	}
	
	
	
	
	
	public function get_by_where_column_name_all_orderBy($table,$column,$where,$orderColumn,$orderType)
    {
        $this->db->select($column)->from($table)->where($where)->order_by($orderColumn, $orderType);
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $rows = $query->result();
            return $rows;
        }else{
            return false;
        }

    }
	
	
	
	
	
   public function record_count($table) {
 
       return $this->db->count_all($table);
 
   }
   
   public function count_all_by_where($table,$where) {
 
       $this->db->where($where);
	   $this->db->from($table);
	   return $this->db->count_all_results();
 
   }
   
   
    public function count_by_where($table,$where,$fieldname) {
 
       $this->db->where($fieldname,$where);
	   $this->db->from($table);
	   return $this->db->count_all_results();
 
   }
   
   
    public function count_all_by_where_in($table,$where,$fieldname) {
 
       $this->db->where_in($fieldname,$where);
	   $this->db->from($table);
	   return $this->db->count_all_results();
 
   }
   
   
   public function count_all_by_where_where_in($table,$where,$fieldname,$where1) {
 	   
	   
       $this->db->where($where1);
       $this->db->where_in($fieldname,$where);
	   $this->db->from($table);
	   return $this->db->count_all_results();
 
   }
 
 
 	public function count_all_by_orwhere_wherein($table,$where,$fieldname,$orwhere1, $orwhere2) {
 	   
	   
       $this->db->where($orwhere1);
	   
       $this->db->where_in($fieldname,$where);
	   
       $this->db->or_where($orwhere2);
	   
       $this->db->where_in($fieldname,$where);
	   
	   $this->db->from($table);
	   return $this->db->count_all_results();
 
   }
   
 
   public function get_table_by_limit($table, $limit, $start) {
 
       $this->db->limit($limit, $start);
 
       $query = $this->db->get($table);
 
       if ($query->num_rows() > 0) {
 
           foreach ($query->result() as $row) {
 
               $data[] = $row;
 
           }
 
           return $data;
 
       }
 
       return false;
 
   }
   
   
   
   public function get_table_by_where_limit($table, $where, $limit, $start) {
 
       $this->db->limit($limit, $start);
 
	   $this->db->where($where);
		 
       $query = $this->db->get($table);
 
       if ($query->num_rows() > 0) {
 
           foreach ($query->result() as $row) {
 
               $data[] = $row;
 
           }
 
           return $data;
 
       }
 
       return false;
 
   }
   
   
   
}

?>