<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_quote_model extends MY_Model
 {

		 
	 public function get_quotes($param=array())
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
			$this->db->order_by('a.quotation_id ','desc');
		}

		if($fields == '')
		{
		  $fields = "SQL_CALC_FOUND_ROWS a.*";
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
		$this->db->from('wl_admin_tenders as a');
		
		
		if(is_array($exjoin) && !empty($exjoin))
		{
		  foreach($exjoin as $val)
		  {
			$val['type'] = (!array_key_exists('type',$val) || $val['type']=='') ? 'JOIN' : $val['type'];
			$this->db->join($val['tbl'],$val['condition'],$val['type']);
		  }
		}
		$q=$this->db->get();
		if($debug === TRUE)
		{
		  echo_sql();
		}
		$result = $q->result_array();	
		return $result;
	}

	public function get_reply($param=array())
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
			$this->db->order_by('a.reply_id ','desc');
		}

		if($fields == '')
		{
		  $fields = "SQL_CALC_FOUND_ROWS a.*";
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
		$this->db->from('wl_tender_reply as a');
		
		if(is_array($exjoin) && !empty($exjoin))
		{
		  foreach($exjoin as $val)
		  {
			$val['type'] = (!array_key_exists('type',$val) || $val['type']=='') ? 'JOIN' : $val['type'];
			$this->db->join($val['tbl'],$val['condition'],$val['type']);
		  }
		}
		$q=$this->db->get();
		if($debug === TRUE)
		{
		  echo_sql();
		}
		$result = $q->result_array();	
		return $result;
	}
}