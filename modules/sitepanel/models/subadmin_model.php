<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subadmin_model extends MY_Model{

   public function __construct(){
   
     parent::__construct();
	 
   }
   
	public function get_subadmins($limit=10,$offset=0,$param=array())
	{
	   
	    
		$status			    =   @$param['status'];	
		$admin_type			    =   @$param['admin_type'];	
		$admin_id		=   @$param['admin_id'];		
		$keyword			=   trim($this->input->get_post('keyword',TRUE));		
		$keyword			=   $this->db->escape_str($keyword);

		$this->db->where("admin_type !=","1");
		
		if($admin_id!='')
		{
			$this->db->where("admin_id","$admin_id");
		}		
		if($status!='')
		{
			$this->db->where("status","$status");
		}
		if($admin_type!='')
		{
			$this->db->where("admin_type","$admin_type");
		}
		
		if($keyword!='')
		{
			
			$this->db->where("(admin_username LIKE '%".$keyword."%' OR admin_email LIKE '%".$keyword."%'  )");
			
		}
		
     	$this->db->order_by('admin_id','desc');	
		$this->db->limit($limit,$offset);
		$this->db->select("SQL_CALC_FOUND_ROWS * ",FALSE);
		$this->db->from('tbl_admin');
		$this->db->where('status !=','2');
		$q=$this->db->get();
		//echo_sql();
		$result = $q->result_array();	
		$result = ($limit=='1') ? $result[0]: $result;	
		return $result;
		
	
	}
	
		
	
	
}
// model end here