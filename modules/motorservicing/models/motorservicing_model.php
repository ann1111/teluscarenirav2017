<?php 

class Motorservicing_model extends CI_Model {
	
	public function get_countries(){
		
		$countries =	$this->db->select('*');
		$countries =	$this->db->get('wl_countries');
		
		
		return $countries->result();
		
	}
	
	 public function get_v_model($data){
		
		header('Content-Type: application/json; charset=utf-8');
		
		$this->db->distinct();
		$query = $this->db->select('model');
		$query = $this->db->where(array('makeby' => $data));
		$query = $this->db->get('tu_vehiclemodelyear');
		echo json_encode($query->result_array()) ;
	} 
	
	 public function check_vehicle_avail($data,$vid){
		
		$vehicle_name = $data['vehicle_name'];
		$vehicle_model = $data['vehicle_models'];
		
		$sql = $this->db->query("SELECT * FROM `tu_vendor_excluded_cars` WHERE exc_vehicle_models REGEXP '[[:<:]](".$vehicle_model.")[[:>:]]' and `exc_vehicle_name` = '".$vehicle_name."' and vendor_id ='".$vid."'")or die(mysql_error());
		
		return $sql->num_rows();
		
	} 
	
	 public function check_vehicle_avail_customer($data){
		
		
		$vehicle_model = $data['vehicle_models'];
		
		$sql = " and model REGEXP '[[:<:]](".$vehicle_model.")[[:>:]]'";
		
		return $sql;
		
	} 
	
	
}



?>