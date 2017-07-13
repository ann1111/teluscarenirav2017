<?php 

class motor_model extends CI_Model{
	
	/* ENTRIES FOR COMP */
	
	public function Insert_comp_values($data,$vendor_id){
		
		date_default_timezone_set('Asia/Calcutta');
		$date = date('Y/d/m/ h:i:s');
		$premiumvalue = $data['premium_value']; 		
			if($_SESSION['exclude_data']['gcc_status'] != ''){		
			$gcc = $_SESSION['exclude_data']['gcc_status'] == 0 ? 1 : 0;			
			}  else{
			$gcc = 0;
			} 				

			foreach($data['agency_type'] as $key => $comp_values){	
			
			$this->db->insert('tu_comprehensive',array('vendor_id' => $vendor_id,'vehicle_type' => $data['vehicletype'],'agency_type' => $key,'registration_emirates' => $data['emirates'],'driver_age' => $data['driver_age'],'d_licence' => $data['Driving_Licence'],'gcc' => $gcc,'min_value' => $comp_values['minvalue'],'premium_value' => $comp_values['premium_value'],'comm_min_value' => $comp_values['comm_minvalue'],'comm_premium_value' => $comp_values['comm_premium_value'], 'entry_date' => $date))or die(mysql_error());
			}	
		}
	
	public function Insert_comp_chk_entry($data,$vendor_id){
		
		$query = $this->db->select('*');
		$query = $this->db->where(array('vendor_id' => $vendor_id,'vehicle_type' => $data['vehicletype'],'agency_type' => $data['agencytype'],'registration_emirates' => $data['emirates'],'driver_age' => $data['driver_age'],'d_licence' => $data['Driving_Licence'],'gcc' => $data['gcc_status']))or die(mysql_error());
		$query = $this->db->get('tu_comprehensive');
		return $query->num_rows();
	}
	
	/* ENTRIES FOR TPL */
	
	public function Insert_tpl_values($data,$vendor_id){
		
		date_default_timezone_set('Asia/Calcutta');
		$date = date('Y/d/m/ h:i:s');		
			if($_SESSION['exclude_data']['gcc_status'] != ''){		
			$gcc = $_SESSION['exclude_data']['gcc_status'] == 0 ? 1 : 0;		
			}else{
			$gcc = 0;
			} 				
		
		foreach($data['noofcylinders'] as $key => $tpl_val){	
		
		$this->db->insert('tu_tpl',array('vendor_id' => $vendor_id,'vehicle_type' => $data['vehicletype'],'noofcilender' =>  $key,'registration_emirates' => $data['emirates'],'driver_age' => $data['driver_age'],'d_licence' => $data['Driving_Licence'],'gcc' => $gcc,'premiumvalue' => $tpl_val['individual']['premiumvalue'],'premiumvalue_comm' => $tpl_val['commercial']['premiumvalue'],'entry_date' => $date))or die(mysql_error());	
		}
		
	}
	
	 public function Insert_tpl_chk_entry($data,$vendor_id){
		
		$query = $this->db->select('*');
		$query = $this->db->where(array('vendor_id' => $vendor_id,'vehicle_type' => $data['vehicletype'],'registration_emirates' => $data['emirates'],'driver_age' => $data['driver_age'],'d_licence' => $data['Driving_Licence'],'gcc' => $data['gcc_status']))or die(mysql_error());
		$query = $this->db->get('tu_comprehensive');
		return $query->num_rows();
	} 
	
	 public function get_all_vehicle_info(){
		
		$this->db->distinct();
		$query = $this->db->select('makeby');
		$query = $this->db->get('tu_vehiclemodelyear');
		return $query->result_array();
	} 
	
	 public function one_time_static_data($user_id){
		
		$blank = '';
		$query = $this->db->distinct();
		$query = $this->db->select('*');
		$query = $this->db->where('vendor_id',  $user_id);
		/* $query = $this->db->where('exc_vehicle_year != ',$blank);
		$query = $this->db->where('exc_vehicle_register != ',$blank); */
		$query = $this->db->get('tu_vendor_excluded_cars');
		return $query->result_array();
	} 
	
	 public function get_v_model($data){
		header('Content-Type: application/json; charset=utf-8');
		$this->db->distinct();
		$query = $this->db->select('model');
		$query = $this->db->where(array('makeby' => $data));
		$query = $this->db->get('tu_vehiclemodelyear');
		echo json_encode($query->result_array()) ;
	} 	

	public function get_emirates($data){	
		$this->db->distinct();		
		$query = $this->db->select('*');	
		$query = $this->db->get('tu_emirates');	
		return $query->result_array();	
	}

 	
	 public function get_v_types(){	
		 $this->db->distinct();		
		 $query = $this->db->select('*');		
		 $query = $this->db->get('tu_vehicle_types');
		 return $query->result_array();	
	 
	 } 
	
	public function insert_excluded_cars_model($data,$vendor_id,$path){
		
		foreach($_SESSION['motor_exclude_data'] as $motor_exc){
		
			if(!empty($motor_exc['vehicletype']) && !empty($motor_exc['vehicle_name'])){
				
			if($motor_exc['vehicle_register'] != ''){
				$vehicle_register = implode(',',$motor_exc['vehicle_register']);
			}else{
				$vehicle_register = '';
			}
			if($motor_exc['vehicle_models'] != ''){
				$vehicle_models = implode(',',$motor_exc['vehicle_models']);
			}else{
				$vehicle_models = '';
			}

			if($motor_exc['vehicle_year'] != ''){
				$vehicle_year = $motor_exc['vehicle_year'];
			}else{
				$vehicle_year = '';
			}
			if($motor_exc['vehicle_name'] != ''){
				$vehicle_name = $motor_exc['vehicle_name'];
			}else{
				$vehicle_name = '';
			}
			
			$final_entry = $this->db->insert('tu_vendor_excluded_cars',array('vendor_id' => $vendor_id,'exc_vehicle_year' => $vehicle_year,'exc_vehicle_name' =>  $vehicle_name,'exc_vehicle_register' => $vehicle_register,'exc_vehicle_models' => $vehicle_models, 'PAB_driver' => $data['PAB_driver'],'RSA' => $data['RSA'], 'PAB_passanger' =>$data['PAB_passanger'], 'ADD_rent_car'=> $data['ADD_rent_car'] , 'vendor_doc1' => $path['file1'] , 'vendor_doc2' => $path['file2']))or die(mysql_error());
			
			}
		}
		if($final_entry){
			return true;
		}else{
			return false;
		}
		
	}
	
	public function chk_cars_year_exist($vendor_id){
		
		$num = $this->db->select('*');
		$num = $this->db->where(array('vendor_id' => $vendor_id));
		$num = $this->db->get('tu_vendor_excluded_cars');
		return $num->result_array();
	} 
	
}




?>