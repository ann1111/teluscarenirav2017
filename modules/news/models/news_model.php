<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News_model extends MY_Model
 {

		 
	 public function get_news($limit='10',$offset='0',$param=array())
	 {		
		
		$status			    =   @$param['status'];
		$orderby		    =   @$param['orderby'];	
		$where		        =   @$param['where'];	
		
		$keyword = $this->db->escape_str($this->input->get_post('keyword',TRUE));
			
	    if($status!='')
		{
			$this->db->where("wl_news.status",$status);
		}
		
	    if($where!='')
		{
			$this->db->where($where);
		}
		
		
		if($keyword!='')
		{
						
			$this->db->where("(wl_news.news_title LIKE '%".$keyword."%' OR wl_news.publisher LIKE '%".$keyword."%' )");
				
		}
		if($orderby!='')
		{
			 $this->db->order_by($orderby);
			
		}else
		{
		  $this->db->order_by('wl_news.news_id','desc');
		}
		
		$this->db->limit($limit,$offset);
		$this->db->select('SQL_CALC_FOUND_ROWS wl_news.*',FALSE);		
		$this->db->from('wl_news');
		$q=$this->db->get();
		//echo_sql();
		$result = $q->result_array();	
		$result = ($limit=='1') ? @$result[0]: $result;	
		return $result;
				
	}
		  
	
	 
}
?>