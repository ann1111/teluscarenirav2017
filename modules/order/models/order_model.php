<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Order_model extends MY_Model
 {
	 
	 
    public function get_orders($offset='0',$per_page='10',$condition='')
	{
	   
		 $order_no   = $this->db->escape_str(trim($this->input->get_post('order_no',TRUE)));
		 $keyword   = $this->db->escape_str(trim($this->input->get_post('keyword',TRUE)));
		 $from_date = $this->db->escape_str(trim($this->input->get_post('from_date',TRUE)));
		 $to_date   = $this->db->escape_str(trim($this->input->get_post('to_date',TRUE)));

		 $user_id               =  (int) $this->input->get_post('user_id');
		 
		 $condition="order_status !='Deleted' $condition ";
		 
		if($from_date!='' ||  $to_date!='')
		{
			
			
				$condition_date=array();
				$condition.=" AND (";
				if($from_date!='')
				{
					$condition_date[] = "DATE(order_received_date)>='$from_date'";
					
				}if($to_date!='')
				{
					 $condition_date[] ="DATE(order_received_date)<='$to_date'";
					 
				}
				
				$condition.=implode(" AND ",$condition_date)." )";
		}

		if($user_id > 0 )
		{
		  $condition.=" AND customers_id='".$user_id."'";
		}	
		
		if($keyword!='')
		{
			$condition.=" AND ( invoice_number LIKE '%".$keyword."%' OR  CONCAT_WS(' ',first_name,last_name) LIKE '%".$keyword."%' OR  email LIKE '%".$keyword."%'  OR  payment_status LIKE '".$keyword."%' OR  order_status LIKE '".$keyword."%' ) ";
			
			
		}
		if($order_no!='')
		{
			$condition.=" AND ( invoice_number = '".$order_no."' )";
			
			
		}
				
		$fetch_config = array(
							  'condition'=>$condition,
							  'order'=>'order_id DESC',
							  'limit'=>$per_page,
							  'start'=>$offset,							 
							  'debug'=>FALSE,
							  'return_type'=>"array"							  
							  );		
		$result = $this->findAll('wl_order',$fetch_config);
		return $result;	
		
	
	}

	public function get_total_transaction($condition='')
	{
	   
		 $order_no   = $this->db->escape_str(trim($this->input->get_post('order_no',TRUE)));
		 $keyword   = $this->db->escape_str(trim($this->input->get_post('keyword',TRUE)));
		 $from_date = $this->db->escape_str(trim($this->input->get_post('from_date',TRUE)));
		 $to_date   = $this->db->escape_str(trim($this->input->get_post('to_date',TRUE)));

		 $user_id               =  (int) $this->input->get_post('user_id');
		 
		 $condition="order_status !='Deleted' $condition ";
		 
		if($from_date!='' ||  $to_date!='')
		{
			
			
				$condition_date=array();
				$condition.=" AND (";
				if($from_date!='')
				{
					$condition_date[] = "DATE(order_received_date)>='$from_date'";
					
				}if($to_date!='')
				{
					 $condition_date[] ="DATE(order_received_date)<='$to_date'";
					 
				}
				
				$condition.=implode(" AND ",$condition_date)." )";
		}

		if($user_id > 0 )
		{
		  $condition.=" AND customers_id='".$user_id."'";
		}	
		
		if($keyword!='')
		{
			$condition.=" AND ( invoice_number LIKE '%".$keyword."%' OR  CONCAT_WS(' ',first_name,last_name) LIKE '%".$keyword."%' OR  email LIKE '%".$keyword."%'  OR  payment_status LIKE '".$keyword."%' OR  order_status LIKE '".$keyword."%' ) ";
			
			
		}
		if($order_no!='')
		{
			$condition.=" AND ( invoice_number = '".$order_no."' )";
			
			
		}
				
		$fetch_config = array(
							  'condition'=>$condition,
							  'field'=>" SUM(total_amount + IFNULL( vat_amount ,0) + IFNULL( shipping_amount, 0)) as total_transaction",
							  'debug'=>FALSE,
							  'return_type'=>"array"							  
							  );		
		$result = $this->find('wl_order',$fetch_config);
		
		$transaction = is_array($result) && !empty($result) ? $result['total_transaction'] : 0;
		return $transaction;	
		
	
	}
	
	
	public function get_order_master($ordId)
		{		
			$id = (int) $ordId;
			if($id!='' && is_numeric($id))
			{
				$condtion = "order_id =$id";
				$fetch_config = array(
				'condition'=>$condtion,							 					 
				'debug'=>FALSE,
				'return_type'=>"array"							  
				);
				
				$result = $this->find('wl_order',$fetch_config);
				return $result;		
			}
		}

		public function get_order_detail($ordno)
		{
			$condtion = "orders_id ='$ordno' ";
			$fetch_config = array(
				'condition'=>$condtion,
				'order'=>'NULL',
				'limit'=>'NULL',
				'start'=>'NULL',							 
				'debug'=>FALSE,
				'return_type'=>"array"							  
			);	
				
			$result = $this->findAll('wl_orders_products',$fetch_config);
			return $result;	
		}
		
		 
	
	 
 }