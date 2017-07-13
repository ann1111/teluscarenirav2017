<?php
class Enquiry extends  Admin_Controller{

	public function __construct()
	{		
		parent::__construct(); 			
		$this->load->model(array('sitepanel/enquiry_model'));  
		$this->config->set_item('menu_highlight','enquiry management');	
	}


	public  function index()
	{	
		if($this->input->post('Send')!='')
		{
		  $this->send_group_reply();
		  
		}
		else
		{
		  if( $this->input->post('status_action')!='')
		  {			
			$this->update_status('wl_enquiry','id');			
		  }
	  
		   $keyword                 =  trim($this->input->post('keyword',TRUE));
		   
		   $pagesize                =  (int) $this->input->get_post('pagesize');
				  
		   $config['limit']		  =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');
								  
		   $offset                  =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	
		  
		   $base_url                =  current_url_query_string(array('filter'=>'result'),array('per_page'));		
		  
		   $condition               =  "type ='3' ";
					  
		   $keyword                 = $this->db->escape_str( $keyword );
		  
		  if($keyword!='')
		  {
			  
			 $condition.=" AND  ( email like '%$keyword%' OR  city like '%$keyword%' OR country like '%$keyword%'  OR CONCAT_WS(' ',first_name,last_name) LIKE '%".$keyword."%' ) ";
		   
		  }

		  $reply_status = $this->input->get_post('reply_status');

		  if($reply_status != '')
		  {
			$condition .= " AND reply_status ='".$reply_status."'";
		  }	
															  
		  $res_array              = $this->enquiry_model->get_enquiry($offset,$config['limit'],$condition);	
		  $config['total_rows']	= $this->enquiry_model->total_rec_found;	
		  $data['page_links']     =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);	
		  
		  
			  
		  $data['heading_title']  = 'Manage Enquiry/Feedback';
		  $data['type']       = '3';	
		  $data['res']            = $res_array; 			
		  $this->load->view('enquiry/view_enquiry_list',$data);
		}
	
	}
	
	public function send_reply()
	{
		$rid =  (int) $this->uri->segment(4);
		$this->db->select("*,CONCAT_WS(' ',first_name,last_name) AS name",FALSE);
		$res_data =  $this->db->get_where('wl_enquiry', array('id' =>$rid))->row();	
	    $this->load->library('email');
	   
		if( is_object( $res_data ) )
		{ 
			$this->form_validation->set_rules('subject', 'Subject', 'required|xss_clean');	
			$this->form_validation->set_rules('message', 'Message', 'required|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
			{			
				/* Reply  mail to user */
				
						
				$mail_to      = $res_data->email;
				$mail_subject = $this->input->post('subject'); 				
				$from_email   = $this->admin_info->admin_email;
				$from_name    =  $this->config->item('site_name');				
				$body = "Dear ".$res_data->name.",<br /><br />	";					
				$body .= $this->input->post('message');				
				$body .= "<br /> <br />						   
									Thanks and Regards,<br />						   
									".$this->config->item('site_name')." Team ";		
							
				$this->email->from($from_email,$from_name);
				$this->email->to($mail_to);			
				$this->email->subject($mail_subject);				
				$this->email->message($body);
				$this->email->set_mailtype('html');
				$this->email->send();

				$posted_data = array(
									  'reply_status'=>'Y'
									);
						
				$where = "id = '".$res_data->id."'"; 						
				$this->enquiry_model->safe_update('wl_enquiry',$posted_data,$where,FALSE);

				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',lang('admin_mail_msg'));
									
				redirect('sitepanel/enquiry/send_reply/'.$res_data->id, '');
				
				/* End reply mail to user */	

							
		}
		$data['post_url'] = 'sitepanel/enquiry/send_reply/'.$this->uri->segment(4);
		$data['heading_title'] = "Send Reply";
		$this->load->view('enquiry/view_send_enq_reply',$data);
		
	  }else
	  {
		  redirect('sitepanel/enquiry/','');
		  
	  }
	}

	public function send_group_reply()
	{	
		
		$data['heading_title'] = 'Send Reply';
		
		$data['ckeditor']      =  set_ck_config(array('textarea_id'=>'message'));

		$this->group_reply();

		$emailarray='';	
		$arr_ids = $this->input->post('arr_ids');
		if(is_array($arr_ids))
		{	 
			$sptr = "";		
			foreach($arr_ids as $value)
			{			
				$query = $this->db->query("SELECT * FROM wl_enquiry WHERE id='$value'");				
				foreach ($query->result() as $row)
				{
					$emailarray .= $sptr.$row->email;
					$sptr = ",";				
				}				
			}
		}

		$str_ids =  is_array($arr_ids) ? implode(',', $arr_ids) : $arr_ids;	
			  
		$rowdata=$emailarray;
		$data['newsresult']=$rowdata;
		$data['ids']=$str_ids;
		$data['post_url'] = 'sitepanel/enquiry/send_group_reply';
		$data['back_url'] = 'sitepanel/enquiry';
		$data['ref_id'] = 0;
		$this->load->view('enquiry/view_enquiry_send',$data);
				
	}
	
	public function group_reply()
	{
	   
	        if($this->input->post('action')!='')
			{
				$this->form_validation->set_rules('sendto','TO','trim|required');
				$this->form_validation->set_rules('subject','Subject','trim|required');
				$this->form_validation->set_rules('message','Message','trim|required|exclude_text[<br />]');
				
				if($this->form_validation->run()=== TRUE)
				{	
				    $subject = $this->input->post('subject');
					$message = $this->input->post('message');
					$mail_to = explode(",",$this->input->post('sendto'));
					
				    $this->load->library('email');
					$config['mailtype']="html";
					$this->email->initialize($config);
					
					$this->email->from($this->admin_info->admin_email, $this->config->item('site_name'));
					
					if( is_array($mail_to) && !empty($mail_to))
					{
						foreach($mail_to as $to)
						{
							if($to!='')
							{
								$this->email->to($to);							
								$this->email->subject($subject);
								$this->email->message($message);							
								$this->email->send();
								//$this->email->print_debugger();

								$posted_data = array(
									  'reply_status'=>'Y'
									);
						
								$where = "email = '".$to."'"; 						
								$this->enquiry_model->safe_update('wl_enquiry',$posted_data,$where,FALSE);
							}					
						}
					}
					$this->session->set_userdata(array('msg_type'=>'success'));
					$this->session->set_flashdata('success','Email has been sent successfully.');
					redirect('sitepanel/enquiry', '');
				}
					
				
		   }		
				
	}
	
	
		
}
// End of controller