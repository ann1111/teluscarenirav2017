<?php
class Admin_quotes extends Private_Controller
{

	private $mId;

	public function __construct()
	{
		parent::__construct(); 	
		if($this->mres['user_type'] == 2)
		{
		  redirect('vendors','');
		}	
		$this->load->model(array('quotes/admin_quote_model','quotes/quote_model'));
		$this->load->helper(array('products/product','quotes/quote'));		 
		$this->load->library(array('safe_encrypt','Dmailer'));	
		$this->form_validation->set_error_delimiters("<div class='required'>","</div>");
		$this->page_section_ct = 'admin_quotes';
	}

	public function index()
	{	
		$this->manage_quotes();
	}

	

	public function manage_quotes()
	{	
		$record_per_page        = (int) $this->input->post('per_page');		
		
		$offset = (int) $this->input->post('offset');
		
		$config['per_page']		= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');		
		
		
		$base_url               = "members/admin_quotes";

		$where = "a.posted_by ='".$this->userId."' AND a.poster_status='1'";

		$quot_mode = (int) $this->input->get_post('quot_mode');

		if($quot_mode > 0)
		{
		  $where .= " AND quotation_mode='".$quot_mode."'";
		}

		$condtion_array = array(
								'fields'=>"SQL_CALC_FOUND_ROWS a.*",
								'where'=>$where,
								'offset'=>$offset,
								'limit'=>$record_per_page,
								'debug'=>FALSE
							  );

		$sort_by = $this->input->get_post('sort_by');

		switch($sort_by)
		{
		  case 'recent':
			$condtion_array['orderby'] = 'a.date_added DESC';
		  break;

		  case 'oldest':
			$condtion_array['orderby'] = 'a.date_added ASC';
		  break;
		}

		$res_array               = $this->admin_quote_model->get_quotes($condtion_array);
		
				
		$total_rows = get_found_rows();

		$config['total_rows']	= $total_rows;	
  
		$data['total_records'] = $config['total_rows'];

		$data['base_url'] = $base_url;
		
		
	    //$data['page_links']      = front_pagination("$base_url",$config['total_rows'],$config['per_page'],$offset);			
	    $data['title'] = "Manage Quotes";

		$data['res'] = $res_array; 
	
		$data['offset'] = $offset; 	

		$ajx_req = $this->input->is_ajax_request();
			  
		if($ajx_req===TRUE)
		{	
		  $this->load->view('members/admin_quotes/load_quotes',$data);
		}
		else
		{
		  $this->load->view('members/admin_quotes/view_quotes',$data);
		}
	}

    public function quote_details()
    {
	  $quoteId = (int) $this->uri->segment(4);

	  $condtion_array = array(
							  'where'=>"a.quotation_id ='".$quoteId."' AND a.posted_by ='".$this->userId."'",
							  'fields'=>"SQL_CALC_FOUND_ROWS a.*",
							  'offset'=>0,
							  'limit'=>1,
							  'debug'=>FALSE
							);

	  $res_array              =  $this->admin_quote_model->get_quotes($condtion_array);

	  if(is_array($res_array) && !empty($res_array))
	  {
		$res_array = $res_array[0];

		$max_attachment = $this->config->item('max_request_quotation_attachment');

		$this->error_data = FALSE;

		$this->reply_quotation($res_array);

		//Reply

		$record_per_page        = (int) $this->input->post('per_page');		
		
		$offset = (int) $this->input->post('offset');
		
		$config['per_page']		= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');		
		
		
		$base_url               = "members/admin_quotes/quote_details/".$res_array['quotation_id'];

		$condtion_array = array(
							  'where'=>"a.ref_quot_id ='".$quoteId."'",
							  'offset'=>$offset,
							  'limit'=>$config['per_page'],
							  'debug'=>FALSE
							);

	  
		$reply_res              =  $this->admin_quote_model->get_reply($condtion_array);

		$data['reply_res'] = $reply_res;

		$total_rows = get_found_rows();

		$config['total_rows']	= $total_rows;	
  
		$data['total_records'] = $config['total_rows'];

		$data['base_url'] = $base_url;

		$data['res'] = $res_array;

		$data['max_attachment'] = $max_attachment;

		$data['error_data'] = $this->error_data;

		$data['offset'] = $offset;

		$ajx_req = $this->input->is_ajax_request();

		if($ajx_req===TRUE)
		{
		  $data['res'] = $reply_res;
		  $this->load->view('members/admin_quotes/load_quote_reply',$data);
		}
		else
		{
		  $this->load->view('members/admin_quotes/view_quote_details',$data);
		}
	  }
	  else
	  {
		redirect('members/admin_quotes/manage_quotes',''); 
	  }
	  
		
	   
   }

   public function remove_quote()
   {
	  $quoteId = (int) $this->uri->segment(4);

	  $condtion_array = array(
							  'where'=>"a.quotation_id ='".$quoteId."' AND a.posted_by ='".$this->userId."'",
							  'fields'=>'a.quotation_id',
							  'offset'=>0,
							  'limit'=>1,
							  'debug'=>FALSE
							);

	  $res_array              =  $this->admin_quote_model->get_quotes($condtion_array);

	  if(is_array($res_array) && !empty($res_array))
	  {
		$res_array = $res_array[0];

		$quote_data = array(
								'poster_status'=>'2'
							  );
	
		$where = "quotation_id = '".$res_array['quotation_id']."'";

		$this->vendor_model->safe_update('wl_admin_tenders', $quote_data,$where ,FALSE );

		$this->session->set_userdata(array('msg_type'=>'success'));
		$this->session->set_flashdata('success',"Quote has been deleted successfully");
	  }
	  else
	  {
		$this->session->set_userdata(array('msg_type'=>'error'));
		$this->session->set_flashdata('error',"Invalid record");
	  }
	  redirect('members/admin_quotes',''); 
		
	   
   }

   public function confirm_quote()
   {
	  $quoteId = (int) $this->uri->segment(4);

	  $condtion_array = array(
							  'where'=>"a.quotation_id ='".$quoteId."' AND a.posted_by ='".$this->userId."'",
							  'fields'=>'a.quotation_id,a.tender_title,a.comments',
							  'offset'=>0,
							  'limit'=>1,
							  'debug'=>FALSE
							);

	  $res_array              =  $this->admin_quote_model->get_quotes($condtion_array);

	  if(is_array($res_array) && !empty($res_array))
	  {
		$res_array = $res_array[0];

		$quote_data = array(
								'quotation_mode'=>'1'
							  );
	
		$where = "quotation_id = '".$res_array['quotation_id']."'";

		$this->quote_model->safe_update('wl_admin_tenders', $quote_data,$where ,FALSE );

		/* Send Mail to Vendor */

		$logo_url = get_mail_logo();

		$username    = $this->admin_info->admin_email;

		$poster_name = $this->mres['first_name'].' '.	$this->mres['last_name'];

		$poster_name = trim($poster_name);
						  
		$content    =  get_content('wl_auto_respond_mails','20');		
		$subject    =  $content->email_subject;						
		$body       =  $content->email_content;	
							
		$verify_url = '<a href="'.base_url().'sitepanel">Click here to view </a>';				
								
		$name = 'Admin';
							
		$body			=	str_replace('{mem_name}',$name,$body);

		$body			=	str_replace('{poster_name}',$poster_name,$body);

		$body			=	str_replace('{quot_title}',$res_array['tender_title'],$body);
		
		$body			=	str_replace('{quot_comments}',$res_array['comments'],$body);
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
		

		$this->session->set_userdata(array('msg_type'=>'success'));
		$this->session->set_flashdata('success',"Quote has been confirmed successfully");
		redirect('members/admin_quotes/quote_details/'.$res_array['quotation_id'],''); 
	  }
	  else
	  {
		$this->session->set_userdata(array('msg_type'=>'error'));
		$this->session->set_flashdata('error',"Invalid record");
		redirect('members/quotes/',''); 
	  }
	  
		
	   
   }

   public function decline_quote()
   {
	  $quoteId = (int) $this->uri->segment(4);

	  $condtion_array = array(
							  'where'=>"a.quotation_id ='".$quoteId."' AND a.posted_by ='".$this->userId."'",
							  'fields'=>'a.quotation_id',
							  'offset'=>0,
							  'limit'=>1,
							  'debug'=>FALSE
							);

	  $res_array              =  $this->admin_quote_model->get_quotes($condtion_array);

	  if(is_array($res_array) && !empty($res_array))
	  {
		$res_array = $res_array[0];
  
		$quote_data = array(
								'quotation_mode'=>'3'
							  );
	
		$where = "quotation_id = '".$res_array['quotation_id']."'";

		$this->quote_model->safe_update('wl_admin_tenders', $quote_data,$where ,FALSE );

		$this->session->set_userdata(array('msg_type'=>'success'));
		$this->session->set_flashdata('success',"Quote has been declined successfully");
		redirect('members/admin_quotes/quote_details/'.$res_array['quotation_id'],''); 
	  }
	  else
	  {
		$this->session->set_userdata(array('msg_type'=>'error'));
		$this->session->set_flashdata('error',"Invalid record");
		redirect('members/admin_quotes',''); 
	  }
	  
		
	   
   }

	public function reply_quotation($res)
	{
		if($this->input->post('post')!='')
		{
		  $max_attachment = $this->config->item('max_request_quotation_attachment');

		  $this->form_validation->set_error_delimiters("<div class='required'>","</div>");

		  $img_allow_size =  $this->config->item('allow.file.size');

		  //$this->form_validation->set_rules('subject', 'Subject','trim|required|max_length[300]|xss_clean');

		  $this->form_validation->set_rules('comments', 'Comments','trim|required|max_length[800]|xss_clean');

		  for($ik=1;$ik<=$max_attachment;$ik++)
		  {
			$this->form_validation->set_rules('attachment'.$ik,'Attachment',"file_allowed_type[document,image]|file_size_max[$img_allow_size]");
		  }
		  if($this->form_validation->run()===TRUE)
		  {
			  $posted_data = array(
									  'ref_quot_id'=>$res['quotation_id'],
									  'posted_by'=>$this->userId,
									  'vendor_id'=>$res['vendor_id'],
									  'subject'=>$this->input->post('subject')!='' ? $this->input->post('subject') : null,
									  'comments'=>$this->input->post('comments'),
									  'date_added'=>$this->config->item('config.date.time')

								   );

			  $insertId = $this->admin_quote_model->safe_insert('wl_tender_reply',$posted_data,FALSE);

			  if($insertId > 0)
			  {	

				  $quote_data = array(
								'quotation_mode'=>'2'
							  );
	
				  $where = "quotation_id = '".$res['quotation_id']."'";

				  $this->admin_quote_model->safe_update('wl_admin_tenders', $quote_data,$where ,FALSE );
		  
				  if(is_array($_FILES) && !empty($_FILES))
				  {
					$this->load->library('upload');
		
					foreach($_FILES as $fkey=>$fval)
					{
					  if(preg_match("~(attachment)~",$fkey,$matches))
					  {
						  $folder = $matches[1];
						  if( $fval['name']!='' )
						  {			  
							  $uploaded_data =  $this->upload->my_upload($fkey,$folder);
						  
							  if( is_array($uploaded_data)  && !empty($uploaded_data) )
							  { 								
								  $uploaded_file = $uploaded_data['upload_data']['file_name'];

								  $posted_data = array(
												  'media_section'=>'reply_tenders',
												  'media_type'=>'docs',
												  'ref_id'=>$insertId,
												  'media'=>$uploaded_file			
												  );
								  $this->admin_quote_model->safe_insert('wl_attachments',$posted_data,FALSE);
							  
							  }		
							  
						  }
					  }
					}
				  }
			  }
			  $dtl_link = 'members/admin_quotes/quote_details/'.$res['quotation_id'];

			  $this->session->set_userdata(array('msg_type'=>'success'));
			  $this->session->set_flashdata('success','Your  reply has been posted successfully');
			  redirect($dtl_link,'');
		  }
		  else
		  {
			$this->error_data = TRUE;
		  }
		}
	}

	public function post_tender()
	{
	  $max_attachment = $this->config->item('max_request_quotation_attachment');

	  if($this->input->post('post')!='')
	  {
		$this->form_validation->set_error_delimiters("<div class='required'>","</div>");

		$img_allow_size =  $this->config->item('allow.file.size');

		$this->form_validation->set_rules('tender_title', 'Title','trim|required|max_length[300]|xss_clean');

		$this->form_validation->set_rules('comments', 'Comments','trim|required|max_length[800]|xss_clean');

		for($ik=1;$ik<=$max_attachment;$ik++)
		{
		  $this->form_validation->set_rules('attachment'.$ik,'Attachment',"file_allowed_type[document,image]|file_size_max[$img_allow_size]");
		}
		if($this->form_validation->run()===TRUE)
		{
			$vendor_id = $this->input->post('vendors');
			$ref_product_id = is_array($vendor_id) && !empty($vendor_id) ? implode(',',$vendor_id) : null;
			$posted_data = array(
									'ref_product_id'=>'',
									'posted_by'=>$this->userId,
									'vendor_id'=>0,
									'ref_product_id'=>$ref_product_id,
									'tender_title'=>$this->input->post('tender_title')!='' ? $this->input->post('tender_title') : null,
									'comments'=>$this->input->post('comments'),
									'date_added'=>$this->config->item('config.date.time')

								 );

			$insertId = $this->admin_quote_model->safe_insert('wl_admin_tenders',$posted_data,FALSE);

			if($insertId > 0)
			{	
		
				if(is_array($_FILES) && !empty($_FILES))
				{
				  $this->load->library('upload');
	  
				  foreach($_FILES as $fkey=>$fval)
				  {
					if(preg_match("~(attachment)~",$fkey,$matches))
					{
						$folder = $matches[1];
						if( $fval['name']!='' )
						{			  
							$uploaded_data =  $this->upload->my_upload($fkey,$folder);
						
							if( is_array($uploaded_data)  && !empty($uploaded_data) )
							{ 								
								$uploaded_file = $uploaded_data['upload_data']['file_name'];

								$posted_data = array(
												'media_section'=>'tender_quotation',
												'media_type'=>'docs',
												'ref_id'=>$insertId,
												'media'=>$uploaded_file			
												);
								$this->admin_quote_model->safe_insert('wl_attachments',$posted_data,FALSE);
							
							}		
							
						}
					}
				  }
				}
			}
			$this->session->set_userdata(array('msg_type'=>'success'));
			$this->session->set_flashdata('success','Your tender has been posted successfully');
			redirect('members/admin_quotes','');
		}
	  }
	  $data['max_attachment'] = $max_attachment;
	  $this->load->view('admin_quotes/post_tender',$data);
		  
		
	}

	public function sbp_list()
	{
		$quoteId = (int) $this->uri->segment(4);

		$condtion_array = array(
							  'where'=>"a.quotation_id ='".$quoteId."' AND a.posted_by ='".$this->userId."'",
							  'fields'=>'a.quotation_id,a.ref_product_id',
							  'offset'=>0,
							  'limit'=>1,
							  'debug'=>FALSE
							);

		$res_array              =  $this->admin_quote_model->get_quotes($condtion_array);

		if(is_array($res_array) && !empty($res_array))
		{
		  $res_array = $res_array[0];

		  $ref_product_id = array('-99');

		  if($res_array['ref_product_id']!='')
		  {
			$ref_product_id  = explode(',',$res_array['ref_product_id']); 
		  }

		  $where = "a.posted_by ='".$this->userId."' AND a.poster_status='1' AND a.quotation_id IN (".implode(',',$ref_product_id).")";

		  $condtion_array = array(
										  'fields'=>"a.quotation_id,b.prod_title,b.prod_type,b.prod_for,b.friendly_url,b.status,b.user_status,c.company_name,c.status as company_status,c.friendly_url as company_url",
										  'where'=>$where,
										  'offset'=>0,
										  'limit'=>50,
										  'debug'=>FALSE
										);

		  $condtion_array['exjoin'][] = array('tbl'=>'wl_customers as c','condition'=>"c.customers_id=b.mem_id");

		  $res_vendors = $this->quote_model->get_quotes($condtion_array);

		  $total_rows = get_found_rows();

		  $data['heading_title'] = "SBP";

		  $data['res_vendors'] = $res_vendors;

		  $this->load->view('admin_quotes/view_sbp_list',$data);
		}

	}

	
	public function download_attachment()
	{
	  $mediaId = (int) $this->uri->segment(4);

	  $res_array = $this->db->select('media')->get_where('wl_attachments',array('sl'=>$mediaId,'media_type'=>'docs'))->row_array();

	  if(is_array($res_array) && !empty($res_array))
	  {
		  if($res_array['media']!='' && file_exists(UPLOAD_DIR."/attachment/".$res_array['media']))
		  {
			  $this->load->helper('download');
			  $data = file_get_contents(UPLOAD_DIR."/attachment/".$res_array['media']);
			  $name = $res_array['media'];
			  force_download($name, $data); 
		  }

	  }
	}
	
}
/* End of file member.php */
/* Location: .application/modules/member/member.php */