<?php 

class pestcontrol_model extends CI_Model{
	
	public function Insert_pestcontrol_values($data,$vendor_id,$upload_path){
		
		$models =  implode(',',$data['vehicle_models']);
		 
		$this->db->insert('tu_pest_control',array('vendor_id' => $vendor_id,'type_of_service' => $data['type_of_service'],'type_of_premises' => $data['premises'],	'kind_of_premises' => $data['kind_premises'],'approx_area' => $data['area'],'upload_doc' => $upload_path))or die(mysql_error());
		
		$this->db->insert('tu_pest_control_premium',array('id'=> $this->db->insert_id(),'vendor_id' => $vendor_id,'rate'=>$data['rate']))or die(mysql_error());
		
		return $this->db->insert_id();
	}
	
	
	public function Insert_pestcontrol_values_chk($data,$vendor_id){
		
		$query = $this->db->select('*');
		$query = $this->db->where(array('vendor_id' => $vendor_id,'type_of_service' => $data['type_of_service'],'type_of_premises' => $data['premises'],'kind_of_premises'=>$data['kind_premises'],'approx_area' => $data['area']));
		$query = $this->db->get('tu_pest_control');
		return $query->num_rows();
		
	}
	
	public function update_pestcontrol_values($data,$vendor_id){
		
		/*  echo '<pre>';
		print_r($data);exit;  
		 */
	
		$kop = $data['kind_premises'] != '' ? 'approx_area=NULL , kind_of_premises =' .$data['kind_premises'] : 'kind_of_premises = NULL ,approx_area= '.$data['area'] ;
		
		//echo $kop; exit;
		
		$this->db->query("UPDATE tu_pest_control SET type_of_service = ".$data['type_of_service'].",type_of_premises =".$data['premises'].",".$kop."  WHERE vendor_id=".$vendor_id." and id=".$data['id']."")or die(mysql_error());	
		 
		$this->db->where(array('vendor_id' => $vendor_id,'id' => $data['id']));
		
		$this->db->update('tu_pest_control_premium', array('rate' => $data['rate'])); 
		
	}
	
	
}




?>