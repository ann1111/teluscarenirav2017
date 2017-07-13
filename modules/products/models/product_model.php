<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends MY_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	
	
	public function get_products($param=array())
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
			$this->db->order_by('a.products_id ','desc');
		}

		if($fields == '')
		{
		  $fields = "SQL_CALC_FOUND_ROWS a.*,m.media as product_image";
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
		$this->db->from('wl_products as a');
		$this->db->where('a.status !=','2');
		$this->db->join('wl_media AS m',"m.ref_id=a.products_id AND ((m.media_type ='images' AND m.media_section ='products') OR (m.media IS NULL))",'LEFT');
		if(is_array($exjoin) && !empty($exjoin))
		{
		  foreach($exjoin as $val)
		  {
			$val['type'] = (!array_key_exists('type',$val) || $val['type']=='') ? 'JOIN' : $val['type'];
			$this->db->join($val['tbl'],$val['condition'],$val['type']);
		  }
		}
		$this->db->group_by("a.products_id"); 
		$q=$this->db->get();
		if($debug === TRUE)
		{
		  echo_sql();
		}
		$result = $q->result_array();	
		return $result;
	}
	
	
	
	
	public function get_product_by_id($id,$excond='')
	{
		
		$id = applyFilter('NUMERIC_GT_ZERO',$id);
		
		if($id>0)
		{
			$condtion = "status !='2' AND products_id=$id ".$excond;
			$fetch_config = array(
														'condition'=>$condtion,							 					 
														'debug'=>FALSE,
														'return_type'=>"array"							  
													 );
			$result = $this->find('wl_products',$fetch_config);
			return $result;
		}
	}
		
	
	public function get_media($limit='4',$offset='0',$param=array())
    {		  
		 $where			        =   @$param['where'];		
		 
		 		
		 if( is_array($param) && !empty($param) )
		 {			
			$this->db->select('SQL_CALC_FOUND_ROWS *',FALSE);
			$this->db->limit($limit,$offset);
			$this->db->from('wl_media');
			if($where!='')
			{
				$this->db->where($where);	
			}
				
			
							
			$q=$this->db->get();
			$result = $q->result_array();	
			$result = ($limit=='1') ? @$result[0]: $result;
			return $result;	
			
		 }				
		
	}

	public function get_product_category($param=array())
	{
	  $orderby			    =	@$param['orderby'];	
	  $where			    =	@$param['where'];
	  $fields			    =	@$param['fields'];
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
		  $this->db->order_by('a.category_name ','asc');
	  }

	  if($fields == '')
	  {
		$fields = "SQL_CALC_FOUND_ROWS a.category_name";
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
	  $this->db->from('wl_categories as a');
	  $this->db->where('a.status !=','2');
	  $this->db->join('wl_product_category AS d','d.category_id=a.category_id');
	  $q=$this->db->get();
	  if($debug === TRUE)
	  {
		echo_sql();
	  }
	  $result = $q->result_array();	
	  return $result;
	}

	public function get_product_attributes($param=array())
	{
	  $orderby			    =	@$param['orderby'];	
	  $where			    =	@$param['where'];
	  $fields			    =	@$param['fields'];
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
		  $this->db->order_by('a.attr_name ','asc');
	  }

	  if($fields == '')
	  {
		$fields = "SQL_CALC_FOUND_ROWS a.attr_name,d.attr_price";
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
	  $this->db->from('wl_attributes as a');
	  $this->db->where('a.status !=','2');
	  $this->db->join('wl_product_attributes AS d','d.ref_attr_id=a.attr_id');
	  $q=$this->db->get();
	  if($debug === TRUE)
	  {
		echo_sql();
	  }
	  $result = $q->result_array();	
	  return $result;
	}
	
	public function get_product_accessories($param=array())
	{
	  $orderby			    =	@$param['orderby'];	
	  $where			    =	@$param['where'];
	  $fields			    =	@$param['fields'];
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
		  $this->db->order_by('a.acc_name ','asc');
	  }

	  if($fields == '')
	  {
		$fields = "SQL_CALC_FOUND_ROWS a.acc_name,d.acc_price,d.acc_disc_price";
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
	  $this->db->from('wl_accessories as a');
	  $this->db->where('a.status !=','2');
	  $this->db->join('wl_product_accessories AS d','d.ref_acc_id=a.acc_id');
	  $q=$this->db->get();
	  if($debug === TRUE)
	  {
		echo_sql();
	  }
	  $result = $q->result_array();	
	  return $result;
	}

	public function related_products_added($productId,$limit='NULL',$start='NULL')
	{
		$res_data =  array();
		$condtion = ($productId!='') ? "status ='1' AND product_id = '$productId' ":"status ='1'";
		$fetch_config = array(
								'condition'=>$condtion,
								'order'=>"id DESC",
								'limit'=>$limit,
								'start'=>$start,							 
								'debug'=>FALSE,
								'return_type'=>"array"							  
							 );		
		$result = $this->findAll('wl_products_related',$fetch_config);
		if( is_array($result) && !empty($result) )
		{
			foreach ($result as $val )
			{ 
				$res_data[$val['id']] =$val['related_id'];
			}
		}
		return $res_data;		
	}

	public function update_viewed($id,$counter=0)
	{
	  $id = (int) $id;
	  if($id>0)
	  {
		  $posted_data = array(
					'products_viewed'=>($counter+1)
				 );
				 
		  $where = "products_id = '".$id."'"; 				
		  $this->category_model->safe_update('wl_products',$posted_data,$where,FALSE);	
	  }
	
	}
	
	
	
	public function get_related_products($condition)
	{
		$condtion = (!empty($condition)) ? "status !='2'  $condition" :"status !='2'";
				
		$fetch_config = array(
								'condition'=>$condtion,
								'order'=>"products_id DESC",
								'limit'=>'NULL',
								'start'=>'NULL',							 
								'debug'=>FALSE,
								'return_type'=>"array"							  
							 );		
		$result = $this->findAll('wl_products',$fetch_config);
		return $result;	
	}
	
	
	public function related_products($res,$limit='NULL',$start='NULL')
	{
  
		$condtion = array();
		$condtion['where']     = "a.status ='1' AND a.products_id IN(SELECT wpr.related_id FROM wl_products_related as wpr WHERE wpr.product_id ='".$res['products_id']."') ";

		$condtion['limit'] = $limit;

		$condtion['start'] = (int) $start;

		$res_data = $this->get_products($condtion);

		return $res_data;		
	}

	public function get_shipping_methods()
	{
		$condtion = "status =1";
		$fetch_config = array(
													'condition'=>$condtion,
													'order'=>"shipping_type",							 					 
													'debug'=>FALSE,
													'return_type'=>"array"							  
													);		
		$result = $this->findAll('wl_shipping',$fetch_config);
		return $result;	
	}

	public function get_company_type($param=array())
	{	
	  $orderby			    =	@$param['orderby'];	
	  $where			    =	@$param['where'];
	  $fields			    =	@$param['fields'];
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
		$this->db->order_by('a.fld_id ','desc');
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
	  $this->db->from('wl_company_type as a');
	  $this->db->where('a.status !=','2');

	  $q=$this->db->get();
	  if($debug === TRUE)
	  {
		echo_sql();
	  }
	  $result = $q->result_array();	
	  return $result;
	}

	public function get_looking_for($param=array())
	{	
	  $orderby			    =	@$param['orderby'];	
	  $where			    =	@$param['where'];
	  $fields			    =	@$param['fields'];
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
		$this->db->order_by('a.fld_id ','desc');
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
	  $this->db->from('wl_looking_for as a');
	  $this->db->where('a.status !=','2');

	  $q=$this->db->get();
	  if($debug === TRUE)
	  {
		echo_sql();
	  }
	  $result = $q->result_array();	
	  return $result;
	}
}
// model end here