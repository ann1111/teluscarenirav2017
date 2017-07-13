<?php 

class motorinsurance_model extends CI_Model {
	
	public function get_countries(){
		
		$countries =	$this->db->select('*');
		$countries =	$this->db->get('wl_countries');
		
		
		return $countries->result();
		
	}
	
	
	
	
}



?>