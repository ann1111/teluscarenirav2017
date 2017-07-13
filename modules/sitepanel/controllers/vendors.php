<?php
class Vendors extends Admin_Controller 
{
  public function __construct() 
  {
    parent::__construct();

    $this->load->model(array('vendors/vendor_model'));
    $this->load->library(array('safe_encrypt','Dmailer'));
	$this->config->set_item('menu_highlight','vendor management');
	$this->vendor_type_arr = array(
									'1'=>'Individual',
									'2'=>'Corporate'
								  );	
  }
  
  public  function index()
  {	  
	  if( $this->input->post('status_action')!='')
	  {	
		  $action = $this->input->post('status_action',TRUE);	
		  $arr_ids = $this->input->post('arr_ids',TRUE);
		  print_r($arr_ids);
		  
		  
		  if($action == 'Activate')
		  {
			$this->load->library(array('safe_encrypt','Dmailer'));
			if( is_array($arr_ids) )
			{
			  $logo_url = get_mail_logo();
			  foreach($arr_ids as $custId)
			  {
				$cust_res = $this->db->select('first_name,last_name,user_name,password,is_verified,user_no')->get_where('wl_customers',array('customers_id'=>$custId,'user_type'=>'2','status !='=>'2'))->row();
				if(is_object($cust_res))
				{
				  $send_login_mail = FALSE;

				  $updated_data = array(
				  'status'=>'1'
				  );

				  $is_verified = $cust_res->is_verified;

				  if($is_verified==='0')
				  {
					$send_login_mail = TRUE;
					$db_user_no = 0;
					$res_user_no = $this->db->select('user_no')->order_by('user_no','desc')->get_where('wl_customers')->row();
					if(is_object($res_user_no))
					{
					  $db_user_no =  (int) $res_user_no->user_no;
					}
					if($db_user_no<=0)
					{
					  $user_no = 10000;
					}
					else
					{
					  $user_no = $db_user_no + 1;
					}
					$updated_data['user_no'] = $user_no;
					$updated_data['is_verified'] = '1';
				  }

				  $where = "customers_id = '".$custId."'"; 

				  $this->vendor_model->safe_update('wl_customers',$updated_data,$where,TRUE);

				  if($send_login_mail === TRUE)
				  {
					  /* Send Mail */
					  $first_name  = $cust_res->first_name;
					  $last_name   = $cust_res->last_name;	
					  $username    = $cust_res->user_name;	
					  $password    = $cust_res->password;
					  $password = $this->safe_encrypt->decode($password);					
					  $content    =  get_content('wl_auto_respond_mails','18');		
					  $subject    =  $content->email_subject;						
					  $body       =  $content->email_content;	
										  
					  $verify_url = "<a href=".base_url()."users/>Click here to login </a>";				
											  
					  $name = trim($first_name." ".$last_name);
										  
					  $body			=	str_replace('{mem_name}',$name,$body);
					  $body			=	str_replace('{username}',$username,$body);
					  $body			=	str_replace('{password}',$password,$body);
					  $body			=	str_replace('{user_no}',$user_no,$body);
					  $body			=	str_replace('{admin_email}',$this->admin_info->admin_email,$body);
					  $body			=	str_replace('{site_name}',$this->config->item('site_name'),$body);
					  $body			=	str_replace('{logo}',$logo_url,$body);
					  $body			=	str_replace('{url}',base_url(),$body);
					  $body			=	str_replace('{link}',$verify_url,$body);
					  
					  $mail_conf =  array(
					  'subject'=>$subject,
					  'to_email'=>$username,
					  'from_email'=>$this->admin_info->admin_email,
					  'from_name'=> $this->config->item('site_name'),
					  'body_part'=>$body
					  );	
						  
					  $this->dmailer->mail_notify($mail_conf);
					}
					
				 }
			   }
			   $this->session->set_userdata(array('msg_type'=>'success'));
			   $this->session->set_flashdata('success',lang('activate') );
			   redirect($_SERVER['HTTP_REFERER'], '');
			}
		  }
		  elseif($action == 'Deactivate')
		  {
			if( is_array($arr_ids) )
			{
			  $err_flag = 0;
			  $succ_flag = 0;	
			  foreach($arr_ids as $prdId)
			  {

				$quot_res = $this->db->select('count(products_id) as gtotal')->get_where('wl_products',array('mem_id'=>$prdId,'status '=>'1'))->row();

				if($quot_res->gtotal > 0)
				{
				  $err_flag = 1;
				}
				else
				{
				  $succ_flag = 1;
				  $posted_data = array(
										'status'=>'0'
									 );
				  $where = "customers_id ='".$prdId."'";
				  $this->vendor_model->safe_update('wl_customers',$posted_data,$where,TRUE);
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
				$this->session->set_flashdata('error',"The selected record(s) has some products.Please deactivate them first");
			  }
			  else
			  {
				$this->session->set_userdata(array('msg_type'=>'error'));
				$this->session->set_flashdata('error',lang('deleted')." <br />But some selected record(s) has deactivate.Please delete them first" );
			  }	
			  redirect($_SERVER['HTTP_REFERER'], '');
			}
		  }
		  elseif($action == 'Delete')
		  {
			if( is_array($arr_ids) )
			{
			  $err_flag = 0;
			  $succ_flag = 0;	
			  foreach($arr_ids as $prdId)
			  {

				$quot_res = $this->db->select('count(products_id) as gtotal')->get_where('wl_products',array('mem_id'=>$prdId,'status !='=>'2'))->row();

				if($quot_res->gtotal > 0)
				{
				  $err_flag = 1;
				}
				else
				{
				  $succ_flag = 1;
				  $posted_data = array(
										'status'=>'2'
									 );
				  $where = "customers_id ='".$prdId."'";
				  $this->vendor_model->safe_update('wl_customers',$posted_data,$where,TRUE);
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
				$this->session->set_flashdata('error',"The selected record(s) has some products.Please delete them first");
			  }
			  else
			  {
				$this->session->set_userdata(array('msg_type'=>'error'));
				$this->session->set_flashdata('error',lang('deleted')." <br />But some selected record(s) has products.Please delete them first" );
			  }	
			  redirect($_SERVER['HTTP_REFERER'], '');
			}
		  }
		  else
		  {		
			$this->update_status('wl_customers','customers_id');
		  }			
	  }

	  $condtion               = array();	

	  $pagesize               =  (int) $this->input->get_post('pagesize');

	  $config['limit']		 =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');

	  $offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	

	  $base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));

	  $where = "a.user_type ='2'";

	  $keyword = trim($this->input->get_post('keyword',TRUE));

	  $keyword = $this->db->escape_str($keyword);		

	  $status			         =   $this->input->get_post('status',TRUE);

	  if($status!='')
	  {
		$where .= " AND a.status ='".$status."'";
	  }

	  $vendor_type			         =   $this->input->get_post('vendor_type',TRUE);

	  if($vendor_type!='')
	  {
		$where .= " AND a.vendor_type ='".$vendor_type."'";
	  }

	  $is_verified			         =   $this->input->get_post('is_verified',TRUE);

	  if($is_verified!='')
	  {
		$where .= " AND a.is_verified ='".$is_verified."'";
	  }

	  $cat_id			         =   (int) $this->input->get_post('cat_id',TRUE);

	  if($cat_id > 0)
	  {
		$where .= " AND a.ref_cat_id ='".$cat_id."'";
	  }

	  if($keyword!='')
	  {
		$where.= " AND (CONCAT('',first_name,last_name) like '%".$keyword."%' OR user_name LIKE '%".$keyword."%' OR user_no LIKE '%".$keyword."%')";
	  }

	  $mem_cond = array(
						'where'=> $where,
						'offset' =>$offset,
						'limit' =>$config['limit'],
						'debug'=>FALSE
						); 		

	  $res_array              = $this->vendor_model->get_members($mem_cond);

	  $total_record           = get_found_rows();			
	  $data['page_links']     =  admin_pagination($base_url,$total_record,$config['limit'],$offset);
	  $data['heading_title']  = 'Manage Vendors';
	  $data['pagelist']       = $res_array; 	
	  $data['total_rec']      = $total_record  ;

	  //trace($this->input->post());
	  $this->load->view('vendor/member_list_view',$data); 	
				
	}
	
	
	
	
	
	public function details()
	{
		
		$customers_id   = (int) $this->uri->segment(4);
		
		$mem_cond = array(
							  'where'=>"a.customers_id ='".$customers_id."' AND a.status !='2'"
							); 		

		$mres           = $this->vendor_model->get_members($mem_cond);		
		if(is_array($mres) && !empty($mres))
		{
		  $mres = $mres[0];
		  $data['heading_title']  = 'Members Details';
		  $data['mres']      = $mres;		
		  $this->load->view('vendor/view_member_detail',$data);
		}
		else
		{
		  echo "Invalid record";
		}
	}

	
	
}
// End of controller