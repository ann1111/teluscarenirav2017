<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pages_model extends MY_Model
{
	
	public  function get_cms_page($page=array())
	{		
		if( is_array($page) && !empty($page) )
		{			
			$result =  $this->db->get_where('wl_cms_pages',$page)->row_array();

			if( is_array($result) && !empty($result) )
			{
				return $result;
			}
			
		}	
			
	}
	
	
	public function get_all_cms_page($offset='0',$limit='10',$opts=array())
	{
		

		if(!array_key_exists('condition',$opts) || $opts['condition']=='')
		{
			$opts['condition']= "status !='2' ";
			
		}else
		{
			$opts['condition']= "status !='2' ".$opts['condition'];
		}
		
		if(!array_key_exists('order',$opts) || $opts['order']=='')
		{
			$opts['order']= "page_name DESC ";
			
		}			
		
		$opts['condition'].= " ";
		
			$fetch_config = array('condition'=>$opts['condition'],
								  'order'=>$opts['order'],														  'return_type'=>"array" 
								  );	
								
		if(array_key_exists('debug',$opts) )
		{			
			$fetch_config['debug']=$opts['debug'];
		}
		
		
		if(array_key_exists('field',$opts) && $opts['field']!='' )
		{			
			$fetch_config['field']=$opts['field'];
		}
												
		if($limit>0)
		{
			
			$fetch_config['limit']=$limit;
		}	
		if(applyFilter('NUMERIC_WT_ZERO',$offset)!=-1)
		{
			$fetch_config['start']=$offset;
		}

		if(array_key_exists('index',$opts) && $opts['index']!='' )
		{			
			$fetch_config['index']=$opts['index'];
		}
		
		$result = $this->findAll('wl_cms_pages as a',$fetch_config);
		return $result;
	
	}

	// Add newsletter service..........................
	  	
	public function add_newsletter_member()
	{
		  $subscribe_me = $this->security->xss_clean($this->input->post('subscribe_me'));

		  $subscribe_me = $subscribe_me == 'Subscribe' || $subscribe_me == 'Y' ? 'Y' : 'N';

		  $subscriber_name = $this->security->xss_clean($this->input->post('subscriber_name'));
		  $subscriber_name = $subscriber_name=='' ? null : $subscriber_name;

		  $subscriber_email = $this->security->xss_clean($this->input->post('subscriber_email'));

		  	
		  if($subscribe_me === 'Y')
		  {
		  
			  $query = $this->db->query("SELECT * FROM wl_newsletters  WHERE subscriber_email='".$subscriber_email."' ");
			  if ($query->num_rows() > 0)
			  {
			  
				  $row = $query->row_array();
				  if($row['status']==1)
				  {
					  $error_type = "error";
					  $error_msg = $this->config->item('newsletter_already_subscribed');
				  
				  }
				  else
				  {
				  
					  $where = "subscriber_email = '".$row['subscriber_email']."'"; 						
					  $this->safe_update('wl_newsletters',array('status'=>'1'),$where,FALSE);

					  $error_type = "success";
					  $error_msg = $this->config->item('newsletter_subscribed');
				  }
			  }
			  else
			  {
				 $data =  array('status'=>'1',
							   'subscriber_name'=>$subscriber_name,
							   'subscriber_email'=>$subscriber_email
							  );
				 $this->pages_model->safe_insert('wl_newsletters',$data); 	

				 $error_type = "success";
				 $error_msg = $this->config->item('newsletter_subscribed');
			  
			  }

			  /*$user_qry = $this->db->query("SELECT customers_id FROM  wl_customers  WHERE user_name='".$subscriber_email."' AND is_subscribed='No'" );

			  if( $user_qry->num_rows() > 0 )
			  {
				$user_res = $user_qry->row_array();

				$where = "customers_id = '".$user_res['customers_id']."'"; 						
				$this->safe_update('wl_customers',array('is_subscribed'=>'Yes'),$where,FALSE);
			  }*/
		  
		  }
		  elseif($subscribe_me === 'N')
		  {
		  
			  $query = $this->db->query("SELECT * FROM wl_newsletters  WHERE subscriber_email='".$subscriber_email."' ");
			  if ($query->num_rows() > 0)
			  {
			  
				  $row = $query->row_array();
				  
				  if($row['status']==1)
				  {
				  
					  $where = "subscriber_email = '".$row['subscriber_email']."'"; 						
					  $this->safe_update('wl_newsletters',array('status'=>'0'),$where,FALSE);	

					  $error_type = "success";
					  $error_msg = $this->config->item('newsletter_unsubscribed');
				  
				  }
				  else
				  {
				  
					$error_type = "error";
					$error_msg = $this->config->item('newsletter_already_unsubscribed');
					
				  
				  }
				  /*$user_qry = $this->db->query("SELECT customers_id FROM  wl_customers  WHERE user_name='".$subscriber_email."' AND is_subscribed='Yes'" );

				  if( $user_qry->num_rows() > 0 )
				  {
					$user_res = $user_qry->row_array();

					$where = "customers_id = '".$user_res['customers_id']."'"; 						
					$this->safe_update('wl_customers',array('is_subscribed'=>'No'),$where,FALSE);
				  }*/
			  }
			  else
			  {
			  
				  $error_type = "error";
				  $error_msg = $this->config->item('newsletter_not_subscribe');
			 }
		  
		  }
		  
		  return array('error_type'=>$error_type,'error_msg'=>$error_msg);
	
	}
	
	public function get_contact_address($opts=array())
	{
		if(!array_key_exists('condition',$opts) || $opts['condition']=='')
		{
			$opts['condition']= "status !='2' ";
			
		}else
		{
			$opts['condition']= "status !='2' ".$opts['condition'];
		}
		
		if(!array_key_exists('order',$opts) || $opts['order']=='')
		{
			$opts['order']= "sl DESC ";
			
		}
				
		$opts['condition'].= " ";
		
		$fetch_config = array('condition'=>$opts['condition'],
							  'order'=>$opts['order'],								
							  'return_type'=>"array" );	
								
		if(array_key_exists('debug',$opts) )
		{			
			$fetch_config['debug']=$opts['debug'];
		}
		
		
		if(array_key_exists('field',$opts) && $opts['field']!='' )
		{			
			$fetch_config['field']=$opts['field'];
		}
												
		if(array_key_exists('limit',$opts) && applyFilter('NUMERIC_GT_ZERO',$opts['limit'])>0)
		{
			
			$fetch_config['limit']=$opts['limit'];
		}	
		if(array_key_exists('offset',$opts) && applyFilter('NUMERIC_WT_ZERO',$opts['offset'])!=-1)
		{
			$fetch_config['start']=$opts['offset'];
		}		
		$result = $this->findAll('wl_contact_address as a',$fetch_config);
		return $result;
	}
	
		
}