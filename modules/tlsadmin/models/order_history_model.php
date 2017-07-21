<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_history_model extends MY_Model {


/*
   Dev : Nirav 
   Function : Order Listing 
*/

function getvieworders($usrid){

 if($this->session->userdata('usertype') != '2'){
 
 	$bqqty = $this->db->query("SELECT * FROM tu_orders WHERE  user_id = '".$usrid."' ORDER BY id DESC");
	
 }
 else
 {
	 $bqqty = $this->db->query("SELECT * FROM tu_orders WHERE  vendor_id = '".$usrid."' ORDER BY id DESC");
 }
  
  return $bqqty->result_array();
  
}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */