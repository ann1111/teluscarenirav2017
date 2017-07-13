<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Familymanagement_model extends CI_Model {

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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */