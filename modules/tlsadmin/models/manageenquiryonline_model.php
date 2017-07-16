<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manageenquiryonline_model extends MY_Model {

/*
   Dev : Nirav 
   Function : Book Quote
*/

function getbookedquote($usrid){

 if($this->session->userdata('usertype') != '2'){
 
	$bqqty = $this->db->query("select mq.*,cust.user_name,custu.user_name as custname, custu.first_name as firstname from manage_quote mq LEFT JOIN wl_customers cust ON mq.mq_vendor_id = cust.customers_id LEFT JOIN  wl_customers custu ON mq.mq_user_id = custu.customers_id WHERE mq.mq_user_id = '".$usrid."' and mq.mq_state_of_quote = 'B' ORDER BY mq.mq_last_updates DESC");
	
 }
 else
 {
	 $bqqty = $this->db->query("select mq.*,cust.user_name,custu.user_name as custname, custu.first_name as firstname from manage_quote mq LEFT JOIN wl_customers cust ON mq.mq_vendor_id = cust.customers_id LEFT JOIN  wl_customers custu ON mq.mq_user_id = custu.customers_id  WHERE mq.mq_vendor_id = '".$usrid."' and mq.mq_state_of_quote = 'B' ORDER BY mq.mq_last_updates DESC");
 }
  return $bqqty->result_array();
  
}

function updatebookquote($editquote){

$bqqty =  $this->db->query("UPDATE manage_quote SET mq_feedback = '".$this->input->post('Remarks')."' ,mq_orderstatus = '".$this->input->post('StatusofOrder')."' ,mq_state_of_quote = '".$this->input->post('StatusofQuote')."'  WHERE mq_id = '".$editquote."' ");
  return true;
  
}


function getsavedquote($usrid){

	if($this->session->userdata('usertype') != '2'){
				
		$bqqty = $this->db->query("select mq.*,cust.user_name,custu.user_name as custname, custu.first_name as firstname from manage_quote mq LEFT JOIN wl_customers cust ON mq.mq_vendor_id = cust.customers_id LEFT JOIN  wl_customers custu ON mq.mq_user_id = custu.customers_id WHERE mq.mq_user_id = '".$usrid."' and mq.mq_state_of_quote = 'S' ORDER BY mq.mq_last_updates DESC");
		$bqqty = $this->db->query("select mq.*,cust.user_name,custu.user_name as custname, custu.first_name as firstname from manage_quote mq LEFT JOIN wl_customers cust ON mq.mq_vendor_id = cust.customers_id LEFT JOIN  wl_customers custu ON mq.mq_user_id = custu.customers_id WHERE mq.mq_user_id = '".$usrid."' and mq.mq_state_of_quote = 'S' ORDER BY mq.mq_last_updates DESC");
		$bqqty = $this->db->query("select mq.*,cust.user_name,custu.user_name as custname, custu.first_name as firstname from manage_quote mq LEFT JOIN wl_customers cust ON mq.mq_vendor_id = cust.customers_id LEFT JOIN  wl_customers custu ON mq.mq_user_id = custu.customers_id WHERE mq.mq_user_id = '".$usrid."' and mq.mq_state_of_quote = 'S' ORDER BY mq.mq_last_updates DESC");
		$bqqty = $this->db->query("select mq.*,cust.user_name,custu.user_name as custname, custu.first_name as firstname from manage_quote mq LEFT JOIN wl_customers cust ON mq.mq_vendor_id = cust.customers_id LEFT JOIN  wl_customers custu ON mq.mq_user_id = custu.customers_id WHERE mq.mq_user_id = '".$usrid."' and mq.mq_state_of_quote = 'S' ORDER BY mq.mq_last_updates DESC");
	}
	else{
		
		$bqqty = $this->db->query("select mq.*,cust.user_name,custu.user_name as custname, custu.first_name as firstname from manage_quote mq LEFT JOIN wl_customers cust ON mq.mq_vendor_id = cust.customers_id LEFT JOIN  wl_customers custu ON mq.mq_user_id = custu.customers_id WHERE mq.mq_vendor_id = '".$usrid."' and mq.mq_state_of_quote = 'S' ORDER BY mq.mq_last_updates DESC");
	}
 // print_r($bqqty->result_array()); exit;
  return $bqqty->result_array();
  
}

function getbifforquote($usrid){
	if($this->session->userdata('usertype') != '2'){
	
		$bqqty = $this->db->query("select mq.*,cust.user_name,custu.user_name as custname, custu.first_name as firstname from manage_quote mq LEFT JOIN wl_customers cust ON mq.mq_vendor_id = cust.customers_id LEFT JOIN  wl_customers custu ON mq.mq_user_id = custu.customers_id WHERE mq.mq_user_id = '".$usrid."' and mq.mq_state_of_quote = 'BD' ORDER BY mq.mq_last_updates DESC");
	}
	else{
		
		$bqqty = $this->db->query("select mq.*,cust.user_name,custu.user_name as custname, custu.first_name as firstname from manage_quote mq LEFT JOIN wl_customers cust ON mq.mq_vendor_id = cust.customers_id LEFT JOIN  wl_customers custu ON mq.mq_user_id = custu.customers_id WHERE mq.mq_vendor_id = '".$usrid."' and mq.mq_state_of_quote = 'BD' ORDER BY mq.mq_last_updates DESC");
	}
 // print_r($bqqty->result_array()); exit;
  return $bqqty->result_array();
  
}


function getnegotiatequote($usrid){
	if($this->session->userdata('usertype') != '2'){
		
		$bqqty = $this->db->query("select mq.*,cust.user_name,custu.user_name as custname, custu.first_name as firstname from manage_quote mq LEFT JOIN wl_customers cust ON mq.mq_vendor_id = cust.customers_id LEFT JOIN  wl_customers custu ON mq.mq_user_id = custu.customers_id WHERE mq.mq_user_id = '".$usrid."' and mq.mq_state_of_quote = 'N' ORDER BY mq.mq_last_updates DESC");
	} else {
		
		$bqqty = $this->db->query("select mq.*,cust.user_name,custu.user_name as custname, custu.first_name as firstname from manage_quote mq LEFT JOIN wl_customers cust ON mq.mq_vendor_id = cust.customers_id LEFT JOIN  wl_customers custu ON mq.mq_user_id = custu.customers_id WHERE mq.mq_vendor_id = '".$usrid."' and mq.mq_state_of_quote = 'N' ORDER BY mq.mq_last_updates DESC");
	}
 // print_r($bqqty->result_array()); exit;
  return $bqqty->result_array();
  
}

function getconfirmedquote($usrid){
	if($this->session->userdata('usertype') != '2'){
	
		$bqqty = $this->db->query("select mq.*,cust.user_name,custu.user_name as custname, custu.first_name as firstname from manage_quote mq LEFT JOIN wl_customers cust ON mq.mq_vendor_id = cust.customers_id LEFT JOIN  wl_customers custu ON mq.mq_user_id = custu.customers_id WHERE mq.mq_user_id = '".$usrid."' and mq.mq_state_of_quote = 'C' ORDER BY mq.mq_last_updates DESC");
	} else {
	
		$bqqty = $this->db->query("select mq.*,cust.user_name,custu.user_name as custname, custu.first_name as firstname from manage_quote mq LEFT JOIN wl_customers cust ON mq.mq_vendor_id = cust.customers_id LEFT JOIN  wl_customers custu ON mq.mq_user_id = custu.customers_id WHERE mq.mq_vendor_id = '".$usrid."' and mq.mq_state_of_quote = 'C' ORDER BY mq.mq_last_updates DESC");
	}
 // print_r($bqqty->result_array()); exit;
  return $bqqty->result_array();
  
}

function requastaquote($usrid){

	if($this->session->userdata('usertype') != '2'){
	
		$bqqty = $this->db->query("select mq.*,cust.user_name,custu.user_name as custname, custu.first_name as firstname from manage_quote mq LEFT JOIN wl_customers cust ON mq.mq_vendor_id = cust.customers_id LEFT JOIN  wl_customers custu ON mq.mq_user_id = custu.customers_id WHERE mq.mq_user_id = '".$usrid."'  ORDER BY mq.mq_last_updates DESC");
	} else {
	
		$bqqty = $this->db->query("select mq.*,cust.user_name,custu.user_name as custname, custu.first_name as firstname from manage_quote mq LEFT JOIN wl_customers cust ON mq.mq_vendor_id = cust.customers_id LEFT JOIN  wl_customers custu ON mq.mq_user_id = custu.customers_id WHERE mq.mq_vendor_id = '".$usrid."'  ORDER BY mq.mq_last_updates DESC");
	}
	
 // print_r($bqqty->result_array()); exit;
  return $bqqty->result_array();
  
}

function edit($edit_quote)
{
	return $this->db->get_where('manage_quote',array('mq_id'=>$edit_quote))->result_array();
}

/*
function insert_employee($data)
{
	$this->db->insert('m_employee',$data);
}
function employee_list()
{		

	if(isset($this->session->userdata['tripsession']['CompanyCode'])){
		
		$this->db->select('e.*,ed.DesignationDescription');
		$this->db->from('m_employee e');
		
		$this->db->join('m_employee_designation ed','e.DesignationID = ed.SID','left');
		$this->db->where('e.CompanyCode',$this->session->userdata['tripsession']['CompanyCode']);
		$this->db->order_by("ModifiedDate","desc"); 
		
		$query=$this->db->get();
		
		return $query->result();
		
		

		
		}
		else
		{
		
		//return $this->db->get('m_employee')->result();
	    $this->db->select('e.*,ed.DesignationDescription');
		$this->db->from('m_employee e');
		$this->db->join('m_employee_designation ed','e.DesignationID = ed.SID','left');
		$this->db->order_by("ModifiedDate","desc"); 
		
		$query=$this->db->get();
		
		return $query->result();
		
		}
}
function edit($edit_company)
{
	return $this->db->get_where('m_employee',array('SID'=>$edit_company))->result();
}
function update_employee($data,$id)
{
	$this->db->where('SID',$id);
	$this->db->update('m_employee',$data);
}
function employee_delete($id)
{
	$this->db->where('SID',$id);
	$this->db->delete('m_employee');
	
}
*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */