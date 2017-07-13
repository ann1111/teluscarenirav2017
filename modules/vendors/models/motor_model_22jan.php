<?php 

class motor_model extends CI_Model{
	
	/* ENTRIES FOR COMP */
	
	public function Insert_comp_values($data,$vendor_id){
		
		date_default_timezone_set('Asia/Calcutta');
		$date = date('Y/d/m/ h:i:s');
		
		$premiumvalue = $data['premium_value']; 
		
		$this->db->insert('tu_comprehensive',array('vendor_id' => $vendor_id,'vehicle_type' => $data['vehicletype'],'agency_type' => $data['agencytype'],'registration_emirates' => $data['emirates'],'driver_age' => $data['driver_age'],'d_licence' => $data['Driving_Licence'],'gcc' => $data['gcc_status'],'min_value' => $data['minvalue'],'premium_value' => $premiumvalue, 'entry_date' => $date))or die(mysql_error());
		
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
		$this->db->insert('tu_tpl',array('vendor_id' => $vendor_id,'vehicle_type' => $data['vehicletype'],'noofcilender' =>  $data['noofcylinders'],'registration_emirates' => $data['emirates'],'driver_age' => $data['driver_age'],'d_licence' => $data['Driving_Licence'],'gcc' => $data['gcc_status'],'premiumvalue' => $data['premiumvalue'],'entry_date' => $date))or die(mysql_error());
		
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
	
	
	public function insert_excluded_cars_model($data,$vendor_id,$path){
		
		$vehicle_register = implode(',',$data['vehicle_register']);
		$vehicle_models = implode(',',$data['vehicle_models']);
		
		$final_entry = $this->db->insert('tu_vendor_excluded_cars',array('vendor_id' => $vendor_id,'exc_vehicle_year' => $data['vehicle_year'],'exc_vehicle_name' =>  $data['vehicle_name'],'exc_vehicle_register' => $vehicle_register,'exc_vehicle_models' => $vehicle_models, 'PAB_driver' => $data['PAB_driver'],'RSA' => $data['RSA'], 'PAB_passanger' =>$data['PAB_passanger'], 'ADD_rent_car'=> $data['ADD_rent_car'] , 'vendor_doc1' => $path['file1'] , 'vendor_doc2' => $path['file2']))or die(mysql_error());
		
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