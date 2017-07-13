<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vendor_model extends MY_Model
 {

		 
	 public function get_members($param=array())
	 {	
		$orderby			=	@$param['orderby'];	
		$where			    =	@$param['where'];
		$fields			    =	@$param['fields'];
		$exjoin			    =	@$param['exjoin'];
		$debug			    =	@$param['debug'];
	  
		if($where!='')
		{
			$this->db->where($where);
			
		}

		if($orderby!='')
		{		
			$this->db->order_by($orderby);
			
		}
		else
		{
			$this->db->order_by('a.customers_id ','desc');
		}

		if($fields == '')
		{
		  $fields = "SQL_CALC_FOUND_ROWS a.*,p.*";
		}

		if(array_key_exists('limit',$param) && $param['limit'] > 0)
		{
		  $limit = $param['limit'];
		  if(array_key_exists('offset',$param) && applyFilter('NUMERIC_WT_ZERO',$param['offset'])!=-1)
		  {
			$offset = $param['offset'];
		  }
		  else
		  {
			$offset = 0;
		  }
		  $this->db->limit($limit,$offset);
		}
	
		$this->db->select($fields,FALSE);
		$this->db->from('wl_customers as a');
		$this->db->where('a.status !=','2');
		$this->db->join('wl_customer_profile AS p',"p.mem_id=a.customers_id",'LEFT');
		if(is_array($exjoin) && !empty($exjoin))
		{
		  foreach($exjoin as $val)
		  {
			$val['type'] = (!array_key_exists('type',$val) || $val['type']=='') ? 'JOIN' : $val['type'];
			$this->db->join($val['tbl'],$val['condition'],$val['type']);
		  }
		}
		$this->db->group_by("a.customers_id"); 
		$q=$this->db->get();
		if($debug === TRUE)
		{
		  echo_sql();
		}
		$result = $q->result_array();	
		return $result;
	}

	public function get_member_profile($id,$condtion='')
	{
		$id = (int) $id;
		
		if($id!='' && is_numeric($id))
		{
			$condtion = "mem_id =$id $condtion ";
			
			$fetch_config = array(
			  'condition'=>$condtion,							 					  'debug'=>FALSE,
			  'return_type'=>"array"							  
			);
			
			$result = $this->find('wl_customer_profile',$fetch_config);
			return $result;		
		}
	
	}
}