<?php
class Members extends Admin_Controller 
{
  public function __construct() 
  {
    parent::__construct();

    $this->load->model(array('members/members_model'));
    $this->load->library(array('safe_encrypt'));
	$this->config->set_item('menu_highlight','member management');	
  }
  
  public  function index()
  {	  
		if( $this->input->post('status_action')!='')
		{	
		  $action = $this->input->post('status_action',TRUE);	
		  $arr_ids = $this->input->post('arr_ids',TRUE);
		  if($action == 'Delete')
		  {
			if( is_array($arr_ids) )
			{
			  $err_flag = 0;
			  $succ_flag = 0;	
			  foreach($arr_ids as $prdId)
			  {
				$quot_res = $this->db->select('count(quotation_id) as gtotal')->get_where('wl_request_quotation',array('posted_by'=>$prdId,'poster_status'=>'1'))->row();

				if($quot_res->gtotal > 0)
				{
				  $err_flag = 1;
				}
				else
				{
				  $quot_res = $this->db->select('count(quotation_id) as gtotal')->get_where('wl_admin_tenders ',array('posted_by'=>$prdId,'poster_status'=>'1'))->row();
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
					$this->product_model->safe_update('wl_customers',$posted_data,$where,TRUE);
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
				$this->session->set_flashdata('error',"The selected record(s) has some quotations.Please delete them first");
			  }
			  else
			  {
				$this->session->set_userdata(array('msg_type'=>'error'));
				$this->session->set_flashdata('error',lang('deleted')." <br />But some selected record(s) has quotations.Please delete them first" );
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

		$where = "a.user_type ='1'";

		$keyword = trim($this->input->get_post('keyword',TRUE));
		
		$keyword = $this->db->escape_str($keyword);		
				
		$status			         =   $this->input->get_post('status',TRUE);
			
		if($status!='')
		{
			$where .= " AND a.status ='".$status."'";
		}

		if($keyword!='')
		{
			$where.= " AND (CONCAT('',first_name,last_name) like '%".$keyword."%' OR user_name LIKE '%".$keyword."%')";
		}

		$mem_cond = array(
							  'where'=> $where,
							  'offset' =>$offset,
							  'limit' =>$config['limit'],
							  'debug'=>FALSE
						); 		
	
		$res_array              = $this->members_model->get_members($mem_cond);

		$total_record           = get_found_rows();			
		$data['page_links']     =  admin_pagination($base_url,$total_record,$config['limit'],$offset);
		$data['heading_title']  = 'Manage Members';
		$data['pagelist']       = $res_array; 	
		$data['total_rec']      = $total_record  ;
		
		
		//trace($this->input->post());
		$this->load->view('member/member_list_view',$data); 	
				
	}
	
	
	
	
	
	public function details()
	{
		
		$customers_id   = (int) $this->uri->segment(4);
		
		$mem_cond = array(
							  'where'=>"a.customers_id ='".$customers_id."' AND a.status !='2'"
							); 		

		$mres           = $this->members_model->get_members($mem_cond);		
		if(is_array($mres) && !empty($mres))
		{
		  $mres = $mres[0];
		  $data['heading_title']  = 'Members Details';
		  $data['mres']      = $mres;		
		  $this->load->view('member/view_member_detail',$data);
		}
		else
		{
		  echo "Invalid record";
		}
	}

	public function products_viewed()
	{
	  $customers_id   = (int) $this->uri->segment(4);
	  $query = "SELECT a.products_id,a.product_name,a.product_code,b.hits FROM wl_products as a INNER JOIN wl_product_hits as b ON a.products_id = b.product_id AND b.user_id='".$customers_id ."' WHERE a.status!='2'";
	  $product_res = $this->db->query($query)->result_array();
	  $data['res'] = $product_res;
	  $data['heading_title']  = 'Products Viewed';
	  $this->load->view('catalog/view_products_viewed',$data); 
	}
  
	public  function support_ticket($page = NULL)
    {
		
      $post_per_page =  $this->input->post('per_page');
	
    if($post_per_page!='')
    {
      $post_per_page=applyFilter('NUMERIC_GT_ZERO',$post_per_page);
      if($post_per_page>0)
      {
        $config['per_page']		 = $post_per_page;
      }
      else
      {
        $config['per_page']		 = $this->config->item('per_page');
      }
    }
    else
    {
      $config['per_page']		     = $this->config->item('per_page');
    }
    
		$offset                 = $this->uri->segment(4,0);
		$res_array              = $this->members_model->get_support_ticket($offset,$config['per_page']);			
		$total_record           = get_found_rows();	
		
		if($this->input->post('delete_ticket')!='' && $this->input->post('delete_ticket')=='Delete')
		{
			   $arr_ids = $this->input->post('arr_ids');
			   $str_ids = implode(',', $arr_ids);
			   $where = "id IN( $str_ids)";
			   $this->members_model->delete_in('tbl_ticket_support',$where,FALSE);
		}
		
		
		$data['page_links']     = admin_pagination("members/support_ticket/pages/",$total_record,$config['per_page']);		
		$data['heading_title']  = 'Manage Support Ticket';
		$data['pagelist']       = $res_array; 	
		$data['total_rec'] = $total_record  ;
		$this->load->view('member/support_ticket_view',$data); 	
				
	}
	
	
	public function ticket_reply()
	{
		$rid =  $this->uri->segment(4);
		$res_data =  $this->db->get_where('tbl_ticket_support', array('id' =>$rid))->row();
	
		if( is_object( $res_data ) )
		{ 
			$this->form_validation->set_rules('subject', 'Subject', 'required|xss_clean');	
			$this->form_validation->set_rules('message', 'Message', 'required|xss_clean');
			if ($this->form_validation->run() == FALSE)
			{
				$data['heading_title'] = "Send Reply";
				$data['res'] = $res_data;
				$this->load->view('member/support_ticket_reply_view',$data);
				
			}else
			{
				/* Reply  mail to user */
				
				$admin_email  = get_site_email();				
				$mail_to      = $res_data->email;
				$mail_subject = $this->input->post('subject'); 				
				$from_email   = $admin_email->admin_email;
				$from_name    =  $this->config->item('site_name');				
				$body = "Dear ".$res_data->name.",<br /><br />";						
				$body .= $this->input->post('message');				
				$body .= "<br /> <br />						   
									Thanks and Regards,<br />						   
									".$this->config->item('site_name')." Team ";		
							
				$this->email->from($from_email, $from_name);
				$this->email->to($mail_to);			
				$this->email->subject($mail_subject);				
				$this->email->message($body);
				$this->email->set_mailtype('html');
				$this->email->send();
				
				$this->db->where('id', $res_data->id);
				$this->db->update('tbl_ticket_support',array('replyed'=>'Y'));
				
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',lang('admin_mail_msg'));
					
					
				redirect('sitepanel/members/ticket_reply/'.$res_data->id, '');
				
				/* End reply mail to user */		
			}
		}
	}	
	
	public function export_members_csv()
	{
	  $condtion            = array();
	  $status			         =   $this->input->get_post('status',TRUE);
			
	  if($status!='')
	  {
		  $condtion['status'] = $status;
	  }

	  $res_array               =  $this->members_model->get_members(10000,0,$condtion);	

	  $total_record            = get_found_rows();

	  if(is_array($res_array) && !empty($res_array))
	  {
		
		header("Content-type: text/csv");
		header("Content-Disposition: attachment; filename=members.csv");
		header("Pragma: no-cache");
		header("Expires: 0");

		$output = fopen('php://output', 'w');

		// output the column headings
		$heading_column = array(
								  'Name', 
								  'Username', 
								  'Password',
								  'Contact No',
								  'Billing Name',
								  'Billing Address',
								  'Billing Phone',
								  'Billing ZipCode',
								  'Billing Country',
								  'Billing State',
								  'Billing City',
								  'Shipping Name',
								  'Shipping Address',
								  'Shipping Phone',
								  'Shipping ZipCode',
								  'Shipping Country',
								  'Shipping State',
								  'Shipping City',
								  'Status',
								  'Join Date'
								);
		fputcsv($output,$heading_column);

		foreach($res_array as $pageVal)
		{
				
			$res_bill       = $this->members_model->get_member_address_book($pageVal['customers_id'],'Bill');	
			$res_ship       = $this->members_model->get_member_address_book($pageVal['customers_id'],'Ship');

			$res_bill       = $res_bill[0];
			$res_ship       = $res_ship[0];

			$row = array(
						  trim($pageVal['first_name']." ".$pageVal['last_name']),
						  $pageVal['user_name'],
						  $this->safe_encrypt->decode($pageVal['password']),
						  $pageVal['phone_number'],
						  $res_bill['name'],
						  $res_bill['address'],
						  $res_bill['phone'],
						  $res_bill['zipcode'],
						  $res_bill['country'],
						  $res_bill['state'],
						  $res_bill['city'],
						  $res_ship['name'],
						  $res_ship['address'],
						  $res_ship['phone'],
						  $res_ship['zipcode'],
						  $res_ship['country'],
						  $res_ship['state'],
						  $res_ship['city'],
						  ($pageVal['status']=='1' ? "Active" : "Inactive"),
						  date("M d, Y",strtotime($pageVal['account_created_date']))
						);

			fputcsv($output, $row);
		}
		fclose($output);
		exit;
	  }
	}
	
	
}
// End of controller