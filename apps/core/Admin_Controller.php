<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Controller extends MY_Controller
{	
	
	public function __construct()
	{
		 parent::__construct();			
		 $this->load->library(array('sitepanel/jquery_pagination'));		
		 $this->load->model(array('utils_model'));	
		 $this->admin_lib->is_admin_logged_in(); 
		 $this->admin_log_data = array(
										 'admin_user' => $this->session->userdata('admin_user'),
										 'adm_key'    => $this->session->userdata('adm_key'),
										 'admin_type' => $this->session->userdata('admin_type'),
										 'admin_id' => $this->session->userdata('admin_id'),
									  );

		  $this->deletePrvg = $this->admin_log_data['admin_type'] == '1' ? TRUE : FALSE;

		  $this->editPrvg = $this->admin_log_data['admin_type'] == '3' ? FALSE : TRUE;

		  $this->activatePrvg = $this->admin_log_data['admin_type'] == '3' ? FALSE : TRUE;

		  $this->deactivatePrvg = $this->admin_log_data['admin_type'] == '3' ? FALSE : TRUE;

		  $this->orderPrvg = $this->admin_log_data['admin_type'] == '3' ? FALSE : TRUE;

		  $this->featuredPrvg = $this->admin_log_data['admin_type'] == '3' ? FALSE : TRUE;

		  $this->orderstatusPrvg = $this->admin_log_data['admin_type'] == '3' ? FALSE : TRUE;

		  $this->newslettermailPrvg = $this->admin_log_data['admin_type'] == '3' ? FALSE : TRUE;
		
	}
	
	public function update_status($table,$auto_field='id',$ostream=array())
	{		
		$current_controller    = $this->router->fetch_class();
		$action                = $this->input->post('status_action',TRUE);	
		$arr_ids               = $this->input->post('arr_ids',TRUE);
		$category_count        = $this->input->post('category_count',TRUE);
		$product_count         = $this->input->post('product_count',TRUE);	
		
		 if( is_array($arr_ids) )
         {
			  $str_ids = implode(',', $arr_ids);
			  
			  if($action=='Activate')
			  {				 
					  foreach($arr_ids as $k=>$v )
					  {
						  $data = array('status'=>'1');
						  $where = "$auto_field ='$v'";					
						  $this->utils_model->safe_update($table,$data,$where,FALSE);
						  //echo_sql();								
						  $this->session->set_userdata(array('msg_type'=>'success'));
						  $this->session->set_flashdata('success',lang('activate') );
						  
					  }	
				
			  }
			  
			  if($action=='Deactivate')
			  {		  $err_flag = 0;
					  $succ_flag = 0;
				      foreach($arr_ids as $k=>$v )
					  {
						   
						   $total_category  = ( $category_count!='' ) ?  count_category("AND parent_id='$v' AND status='1'")     : '0';
						   if($current_controller=='brand')
						   {
							   $total_product   = count_products("AND brand_id='$v' ");
						   }
					       else
						   {
						   $total_product   = ( $product_count!='' )  ?  count_products("JOIN wl_product_category as b ON a.products_id=b.ref_product_id WHERE  b.category_id='".$v."' AND a.status='1'")   : '0';
						   }
						
							if( $total_category>0 || $total_product > 0 )
							{
								$err_flag = 1;
								$this->session->set_userdata(array('msg_type'=>'error'));
								$this->session->set_flashdata('error',lang('child_to_deactivate'));
							
							}else
							{  
								$succ_flag = 1;
								$data = array('status'=>'0');
								$where = "$auto_field ='$v'";					
								$this->utils_model->safe_update($table,$data,$where,FALSE);
							}
						  
					  }
					  if(!$err_flag)
					  {
						$this->session->set_userdata(array('msg_type'=>'success'));
						$this->session->set_flashdata('success',lang('deactivate') );
					  }
					  elseif(!$succ_flag)
					  {
						$this->session->set_userdata(array('msg_type'=>'error'));
						$this->session->set_flashdata('error',lang('child_to_deactivate'));
					  }
					  else
					  {
						$this->session->set_userdata(array('msg_type'=>'error'));
						$this->session->set_flashdata('error',lang('deactivate')." <br /> ".lang('child_to_deactivate_mix') );
					  }	
			  }
			  
			  if($action=='Delete')
			  {
					  $err_flag = 0;
					  $succ_flag = 0;
				      foreach($arr_ids as $k=>$v )
					  {
	  
						   $total_category  = ( $category_count!='' ) ?  count_category("AND parent_id='$v' ")     : '0';
						   if($current_controller=='brand')
						   {
							   $total_product   = count_products("AND brand_id='$v' ");
						   }
						   else
						   {
						   $total_product   = ( $product_count!='' )  ?  count_products("JOIN wl_product_category as b ON a.products_id=b.ref_product_id WHERE  b.category_id='".$v."' AND a.status!='2'")   : '0';

						   }
						
							if( $total_category>0 || $total_product > 0 )
							{
								$err_flag = 1;
								$this->session->set_userdata(array('msg_type'=>'error'));
								$this->session->set_flashdata('error',lang('child_to_delete'));
							
							}else
							{  
								$succ_flag =1;
							    $where = array($auto_field=>$v);
								$this->utils_model->safe_delete($table,$where,TRUE);
								$friendly_url_val = $this->input->get_post("friendly_url_".$v);

								if($current_controller=='category')
								{
									$raw_friendly_url = $friendly_url_val;
									//Individual URL

									$friendly_url_val = $this->config->item('individual_url_prefix')."/".$raw_friendly_url;
									if($raw_friendly_url!='')
									{
									  $where = array('entity_id'=>$v,'page_url'=>$friendly_url_val);

									  $this->utils_model->safe_delete('wl_meta_tags',$where,TRUE);

									  //Corporate URL

									  $friendly_url_val = $this->config->item('corporate_url_prefix')."/".$raw_friendly_url;

									  $where = array('entity_id'=>$v,'page_url'=>$friendly_url_val);

									  $this->utils_model->safe_delete('wl_meta_tags',$where,TRUE);

									  //Vendor URL
									  $friendly_url_val = $raw_friendly_url."/".$this->config->item('cat_vendor_url_suffix');

									  $where = array('entity_id'=>$v,'page_url'=>$friendly_url_val);

									  $this->utils_model->safe_delete('wl_meta_tags',$where,TRUE);
									} 
								}
								else
								{
									if($friendly_url_val!='')
									{
									  $where = array('entity_id'=>$v,'page_url'=>$friendly_url_val);
									  $this->utils_model->safe_delete('wl_meta_tags',$where,TRUE);
									} 
								}

								
								
							
							}						  
					  }
					  if(!$err_flag)
					  {
						$this->session->set_userdata(array('msg_type'=>'success'));
						$this->session->set_flashdata('success',lang('deleted') );
					  }
					  elseif(!$succ_flag)
					  {
						$this->session->set_userdata(array('msg_type'=>'error'));
						$this->session->set_flashdata('error',lang('child_to_delete'));
					  }
					  else
					  {
						$this->session->set_userdata(array('msg_type'=>'error'));
						$this->session->set_flashdata('error',lang('deleted')." <br /> ".lang('child_to_delete_mix') );
					  }	
				
			  }			
			
			  if($action=='Tempdelete')
			  {	
			  			 
				$data = array('status'=>'2');
				$where = "$auto_field IN ($str_ids)";
				$this->utils_model->safe_update($table,$data,$where,FALSE);
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',lang('deleted'));	
				
			  }				 			
			  		 	  
          }
		  

		redirect($_SERVER['HTTP_REFERER'], '');
		
	}
	
	
	public function set_as($table,$auto_field='id',$data=array(),$ostream=array())
	{		
		$arr_ids               = $this->input->post('arr_ids',TRUE);
		
		if( is_array($arr_ids ) )
		{
			
			$str_ids = implode(',', $arr_ids);
			 
			if( is_array($data) && !empty($data) )
			{
				$data = $data;
				$where = "$auto_field IN ($str_ids)";
				$this->utils_model->safe_update($table,$data,$where,FALSE);

				$msg = array_key_exists('msg',$ostream) ? $ostream['msg'] : "Record has been updated successfully.";

				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',$msg);			
			}	
			
		   redirect($_SERVER['HTTP_REFERER'], '');
		   
		}
		
	}
	
	
	/*
	
	$tblname = name of table 
	$fldname = order column name  of table 
	$fld_id  =  auto increment column name of table
			
	*/	
	
    public function update_displayOrder($tblname,$fldname,$fld_id)
	{
		$posted_order_data=$this->input->post('ord');
		
		while(list($key,$val)=each($posted_order_data))
		{
			if( $val!='' )
			{
				 $val = (int) $val;
				 $data = array($fldname=>$val);
				 $where = "$fld_id=$key";
				 $this->utils_model->safe_update($tblname,$data,$where,TRUE);			
			
			}
				
		}
		$this->session->set_userdata(array('msg_type'=>'success'));
		$this->session->set_flashdata('success',lang('order_updated'));		
		redirect($_SERVER['HTTP_REFERER'], '');
	}
	
		
	
	
}