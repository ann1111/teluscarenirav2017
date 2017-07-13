<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class vendor_cleaning_model extends MY_Model
{
	
	
	public function get_existing_data($user_id,$city,$sub_city,$premise_type){
		
		$this->db->select("*");
		$this->db->where(array('vendor_id' => $user_id,'city'=>$city,'sub_city'=>$sub_city,'premises_type'=>$premise_type));
		$res = $this->db->get('tu_cleaning');
		
		return $res->result_array();
		
		
	}
	
	public function insert_cleaning_plan($data,$user_id,$city,$sub_city,$file,$premise_type){
			
			$max = $this->db->query("SELECT max(id) as last_num FROM tu_cleaning")->result_array();
			
			if($max){
				$id = $max[0]['last_num'] + 1;
				$final_id = 'CLEANING-'.$id;
			}
			
				$query = $this->db->insert('tu_cleaning',array( 'clean_id'=> $final_id,
																'vendor_id'=>$user_id,
																'city'=>$city,
																'sub_city'=>$sub_city,
																'material'=>$data['material'],
																'material_cost' => $data['material_cost'],
																'weekend_charges' => $data['charges_weekend'],
																'weekdays_charges'=>$data['charges_weekdays'],
																'num_of_cleaners'=>$data['cleaners'],
																'premises_type'=>$premise_type,
																'discount_charges'=>$data['discounthours'],
																'discount_min_hour'=>$data['discounthourscharge'],
																'vendor_doc'=>$file
																));
			
	}
		
		
		
	public function get_city($sub_city){
			
			$this->db->select('*');
			$this->db->where('state_id',$sub_city);
			$get_city = $this->db->get('tu_cities');
			
			echo trim(json_encode($get_city->result_array()));
	}
		
		
}


?> 
	 