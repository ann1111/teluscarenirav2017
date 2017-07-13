<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class advertise_model extends MY_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_enquiry($cfg=array())
	{
		$sql_keys='';
		$limit_clause='';
		$excond='';
		if(array_key_exists('limit',$cfg) && applyFilter('NUMERIC_GT_ZERO',$cfg['limit'])>0)
		{
			$sql_keys = "SQL_CALC_FOUND_ROWS";
			$limit_clause=" limit ".$cfg['limit'];
		}	
		if(array_key_exists('offset',$cfg) && applyFilter('NUMERIC_WT_ZERO',$cfg['offset'])!=-1)
		{
			$limit_clause=" limit ".$cfg['offset'].",".$cfg['limit'];
		}
		if(array_key_exists('condition',$cfg) && $cfg['condition']!='')
		{
			$excond .= $cfg['condition'];
		}

		if(!array_key_exists('order',$cfg) || $cfg['order']=='')
		{
			$order_by= "b.inserted_on DESC ";
		}
		else
		{
		  $order_by= $cfg['order'];
		}

		if(!array_key_exists('exjoin',$cfg) || $cfg['exjoin']=='')
		{
			$exjoin= "";
		}
		else
		{
		  $exjoin= $cfg['exjoin'];
		}

		if(!array_key_exists('exselect',$cfg) || $cfg['exselect']=='')
		{
			$exselect= "";
		}
		else
		{
		  $exselect= $cfg['exselect'];
		}

		$query = "SELECT $sql_keys b.*,CONCAT_WS(' ',first_name,last_name) as mem_name $exselect FROM wl_advertise as b  $exjoin WHERE (b.status!='2')   $excond  ORDER BY $order_by ";
		$query.=$limit_clause;
		$comment_query=$this->db->query($query);
		$result=$comment_query->result_array();
		return $result;	
		
	}


	
}
// model end here