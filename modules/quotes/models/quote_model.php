<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Quote_model extends MY_Model
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
		  $fields = "SQL_CALC_FOUND_ROWS a.*,b.prod_title,b.prod_type,b.prod_for,b.short_description,b.friendly_url";
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
		$this->db->from('wl_request_quotation as a');
		$this->db->join('wl_products as b','a.ref_product_id=b.products_id','LEFT');
		
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
		$this->db->from('wl_reply_quotation as a');
		
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

	public function get_feedback($param=array())
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
			$this->db->order_by('a.date_added ','desc');
		}

		if($fields == '')
		{
		  $fields = "SQL_CALC_FOUND_ROWS a.*,b.prod_title,b.prod_type,b.prod_for,b.short_description,b.friendly_url,b.status,b.user_status,d.first_name,d.user_name,c.comments";
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
		$this->db->where("d.status !='2'");
		$this->db->from('wl_quotation_feedback as a');
		$this->db->join('wl_request_quotation as c','a.ref_quot_id=c.quotation_id');
		$this->db->join('wl_customers as d','a.poster_id=d.customers_id');
		$this->db->join('wl_products as b','c.ref_product_id=b.products_id','LEFT');
		
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