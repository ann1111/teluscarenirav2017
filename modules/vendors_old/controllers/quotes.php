<?php
class Quotes extends Private_Controller
{

	private $mId;

	public function __construct()
	{
		parent::__construct(); 	
		if($this->mres['user_type'] == 1)
		{
		  redirect('members','');
		}	
		$this->load->model(array('quotes/quote_model'));
		$this->load->helper(array('products/product','quotes/quote'));		 
		$this->load->library(array('safe_encrypt','Dmailer'));	
		$this->form_validation->set_error_delimiters("<div class='required'>","</div>");
		$this->page_section_ct = 'quotes';
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
		
		
		$base_url               = "vendors/quotes/manage_quotes";

		$where = "a.vendor_id ='".$this->userId."' AND a.vendor_status!='2' AND c.status ='1'";

		$product_id = (int) $this->input->get_post('product_id');

		if($product_id > 0)
		{
		  $where .= " AND ref_product_id='".$product_id."'";
		}

		$quot_mode = (int) $this->input->get_post('quot_mode');

		if($quot_mode > 0)
		{
		  $where .= " AND quotation_mode='".$quot_mode."'";
		}

		$condtion_array = array(
								'fields'=>"SQL_CALC_FOUND_ROWS a.*,b.prod_title,b.prod_type,b.prod_for,b.short_description,b.friendly_url,b.status,b.user_status,c.first_name,c.mobile_number,c.user_name",
								'where'=>$where,
								'offset'=>$offset,
								'limit'=>$record_per_page,
								'debug'=>FALSE
							  );

		$condtion_array['exjoin'][] = array('tbl'=>'wl_customers as c','condition'=>"c.customers_id=a.posted_by");

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
			
		$res_array               = $this->quote_model->get_quotes($condtion_array);
		
				
		$total_rows = get_found_rows();

		$config['total_rows']	= $total_rows;	
  
		$data['total_records'] = $config['total_rows'];

		$data['base_url'] = $base_url;
		
		
	    //$data['page_links']      = front_pagination("$base_url",$config['total_rows'],$config['per_page'],$offset);			
	    $data['title'] = "Manage Quote Enquiry";

		$data['res'] = $res_array; 
	
		$data['offset'] = $offset; 	

		$ajx_req = $this->input->is_ajax_request();
			  
		if($ajx_req===TRUE)
		{	
		  $this->load->view('vendors/quotes/load_quotes',$data);
		}
		else
		{
		  $this->load->view('vendors/quotes/view_quotes',$data);
		}
	}

    public function quote_details()
    {
	  $quoteId = (int) $this->uri->segment(4);

	  $condtion_array = array(
							  'where'=>"a.quotation_id ='".$quoteId."' AND a.vendor_id ='".$this->userId."'",
							  'fields'=>"SQL_CALC_FOUND_ROWS a.*,b.prod_title,b.prod_type,b.prod_for,b.short_description,b.friendly_url,b.status,b.user_status,c.first_name,c.mobile_number,c.user_name",
							  'offset'=>0,
							  'limit'=>1,
							  'debug'=>FALSE
							);

	  $condtion_array['exjoin'][] = array('tbl'=>'wl_customers as c','condition'=>"c.customers_id=a.posted_by");

	  $res_array              =  $this->quote_model->get_quotes($condtion_array);

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
		
		
		$base_url               = "vendors/quotes/quote_details/".$res_array['quotation_id'];

		$condtion_array = array(
							  'where'=>"a.ref_quot_id ='".$quoteId."'",
							  'offset'=>$offset,
							  'limit'=>$config['per_page'],
							  'debug'=>FALSE
							);

	  
		$reply_res              =  $this->quote_model->get_reply($condtion_array);

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
		  $data['mem_name'] = $res_array['first_name'];
		  $this->load->view('vendors/quotes/load_quote_reply',$data);
		}
		else
		{
		  $this->load->view('vendors/quotes/view_quote_details',$data);
		}
	  }
	  else
	  {
		redirect('vendors/quotes/manage_quotes',''); 
	  }
	  
		
	   
   }

   public function remove_quote()
   {
	  $quoteId = (int) $this->uri->segment(4);

	  $condtion_array = array(
							  'where'=>"a.quotation_id ='".$quoteId."' AND a.vendor_id ='".$this->userId."'",
							  'fields'=>'a.quotation_id',
							  'offset'=>0,
							  'limit'=>1,
							  'debug'=>FALSE
							);

	  $res_array              =  $this->quote_model->get_quotes($condtion_array);

	  if(is_array($res_array) && !empty($res_array))
	  {
		$res_array = $res_array[0];

		$quote_data = array(
								'vendor_status'=>'2'
							  );
	
		$where = "quotation_id = '".$res_array['quotation_id']."'";

		$this->vendor_model->safe_update('wl_request_quotation', $quote_data,$where ,FALSE );

		$this->session->set_userdata(array('msg_type'=>'success'));
		$this->session->set_flashdata('success',"Quote has been deleted successfully");
	  }
	  else
	  {
		$this->session->set_userdata(array('msg_type'=>'error'));
		$this->session->set_flashdata('error',"Invalid record");
	  }
	  redirect('vendors/quotes/manage_quotes',''); 
		
	   
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

			  $insertId = $this->quote_model->safe_insert('wl_reply_quotation',$posted_data,FALSE);

			  if($insertId > 0)
			  {	

				  $quote_data = array(
								'quotation_mode'=>'2'
							  );
	
				  $where = "quotation_id = '".$res['quotation_id']."'";

				  $this->quote_model->safe_update('wl_request_quotation', $quote_data,$where ,FALSE );
		  
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
												  'media_section'=>'reply_quotation',
												  'media_type'=>'docs',
												  'ref_id'=>$insertId,
												  'media'=>$uploaded_file			
												  );
								  $this->quote_model->safe_insert('wl_attachments',$posted_data,FALSE);
							  
							  }		
							  
						  }
					  }
					}
				  }
			  }
			  $dtl_link = 'vendors/quotes/quote_details/'.$res['quotation_id'];

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

	public function feedback()
	{
		$quoteId = (int) $this->uri->segment(4);

		$feed_type = $this->uri->segment(3);

		$condtion_array = array(
								'where'=>"a.quotation_id ='".$quoteId."' AND a.posted_by ='".$this->userId."'",
								'fields'=>'a.quotation_id',
								'offset'=>0,
								'limit'=>1,
								'debug'=>FALSE
							  );

		$res_array              =  $this->quote_model->get_quotes($condtion_array);

		if(is_array($res_array) && !empty($res_array))
		{
		  $res_array = $res_array[0];

		  switch($feed_type)
		  {
			case 'complaint':
			  $heading_title = "Complaints";
			  $red_url       = "complaint";
			  $db_feed_type  = 1;
			  $msg_type      = "complaint";
			break;
			case 'suggestion':
			  $heading_title = "Suggestions";
			  $red_url       = "suggestion";
			  $db_feed_type = 2;
			  $msg_type      = "suggestion";
			break;
			case 'queries':
			default:
			  $heading_title = "Queries";
			  $red_url       = "queries";
			  $msg_type      = "query";
			  $db_feed_type = 3;
			break;
		  }

		  $this->form_validation->set_rules('subject', 'Subject','trim|required|max_length[300]|xss_clean');

		  $this->form_validation->set_rules('comments', 'Comments','trim|required|max_length[800]|xss_clean');

		  if($this->form_validation->run()===TRUE)
		  {

			  $posted_data = array(
									  'feed_type'=>$db_feed_type,
									  'ref_quot_id'=>$res_array['quotation_id'],
									  'poster_id'=>$this->userId,
									  'subject'=>$this->input->post('subject'),
									  'comments'=>$this->input->post('comments'),
									  'date_added'=>$this->config->item('config.date.time')

								   );

			  $insertId = $this->quote_model->safe_insert('wl_quotation_feedback',$posted_data,FALSE);
			  $this->session->set_userdata(array('msg_type'=>'success'));
			  $this->session->set_flashdata('success','Your  '.$msg_type.' has been posted successfully');

			  redirect('vendors/quotes/'.$red_url.'/'.$res_array['quotation_id'],'');
		  }
		  $data['res'] = $res_array;
		  $data['heading_title'] = $heading_title;
		  $this->load->view('quotes/quotation_feedback',$data);
		}
		else
		{
		  echo "Invalid record";
		}
	}

	public function view_feedback()
	{
		$this->page_section_ct = 'products';

		$this->error_data = FALSE;

		$this->reply_feedback();

		$record_per_page        = (int) $this->input->post('per_page');		
		
		$offset = (int) $this->input->post('offset');
		
		$config['per_page']		= 1;//( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');		
		
		
		$base_url               = $this->uri->uri_string;

		$feed_type = $this->input->get_post('type');
		$feed_type = $feed_type=='' ? '-1' : $feed_type;
		$feed_type = !in_array($feed_type,array('complain','suggestion','queries')) ? 'complain' : $feed_type;

		$where = "IF(a.poster_id='".$this->userId."',a.poster_status !='2',a.receiver_status !='2') AND (a.receiver_id ='".$this->userId."' OR a.poster_id='".$this->userId."') ";

		$quot_id = $this->input->get_post('quot_id');

		if($quot_id > 0)
		{
		  $where .= " AND ref_quot_id ='".$quot_id."'";
		}


		switch($feed_type)
		{
		  case 'complain':
			$where .= " AND a.feed_type='1'";
			$feedback_heading = "Complaint";
		  break;
		  case'suggestion':
			$where .= " AND a.feed_type='2'";
			$feedback_heading = "Suggestion";
		  break;
		  case'queries':
			$where .= " AND a.feed_type='3'";
			$feedback_heading = "Queries";
		  break;
		}

		$condtion_array = array(
							  'where'=>$where,
							  'offset'=>$offset,
							  'limit'=>$config['per_page'],
							  'debug'=>FALSE
							);

		$res_feedback = $this->quote_model->get_feedback($condtion_array);

		$total_rows = get_found_rows();

		$config['total_rows']	= $total_rows;	
  
		$data['total_records'] = $config['total_rows'];

		$data['base_url'] = $base_url;

		$data['heading_title'] = 'Feedback';

		$data['feedback_type'] = $feedback_heading;

		$data['offset'] = $offset;

		$data['res'] = $res_feedback;

		$data['feed_type'] = $feed_type;

		$ajx_req = $this->input->is_ajax_request();

		if($ajx_req===TRUE)
		{
		  $this->load->view('quotes/load_feedback',$data);
		}
		else
		{
		  $data['error_data'] = $this->error_data;
		  $this->load->view('quotes/view_feedback',$data);
		}
	}

	public function load_feedback()
	{
		$feed_type = $this->input->get_post('type');
		$data['heading_title'] = 'Feedback';
		$data['feed_type'] = $feed_type;
		$this->load->view('quotes/load_feedback',$data);
	}
	
	public function reply_feedback()
	{
	  if($this->input->post('post')!='')
	  {
		  $feedback_id = (int) $this->input->post('feedback_id');

		  $where = "(a.receiver_id ='".$this->userId."' OR a.poster_id='".$this->userId."') AND a.feedback_id = '".$feedback_id."'";

		  $condtion_array = array(
							  'where'=>$where,
							  'fields'=>'a.*',
							  'offset'=>0,
							  'limit'=>1,
							  'debug'=>FALSE
							);

		  $res_array = $this->quote_model->get_feedback($condtion_array);

		  if(is_array($res_array) && !empty($res_array))
		  {
			$res_array = $res_array[0];

			$this->form_validation->set_rules('title', 'Title','trim|required|max_length[300]|xss_clean');

			$this->form_validation->set_rules('comments', 'Comments','trim|required|max_length[800]|xss_clean');

			if($this->form_validation->run()===TRUE)
			{

				$posted_data = array(
										'feed_type'=>$res_array['feed_type'],
										'ref_quot_id'=>$res_array['ref_quot_id'],
										'poster_id'=>$this->userId,
										'parent_id'=>$res_array['feedback_id'],
										'receiver_id'=>$res_array['poster_id'],
										'subject'=>$this->input->post('title'),
										'feedback'=>$this->input->post('comments'),
										'date_added'=>$this->config->item('config.date.time')

									 );

				$insertId = $this->quote_model->safe_insert('wl_quotation_feedback',$posted_data,FALSE);
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success','Your reply has been posted successfully');

				redirect($_SERVER['HTTP_REFERER'],'');
			}
			else
			{
			  $this->error_data = TRUE;
			}
		  }
		  else
		  {

		  }
	  }
	}

	public function remove_feedback()
    {
	  $feedback_id = (int) $this->uri->segment(4);

	  $where = "(a.receiver_id ='".$this->userId."' OR a.poster_id='".$this->userId."') AND a.feedback_id = '".$feedback_id."'";

	  $condtion_array = array(
						  'where'=>$where,
						  'fields'=>'a.*',
						  'offset'=>0,
						  'limit'=>1,
						  'debug'=>FALSE
						);

	  $res_array = $this->quote_model->get_feedback($condtion_array);

	  if(is_array($res_array) && !empty($res_array))
	  {
		$res_array = $res_array[0];
		if($res_array['poster_id'] == $this->userId)
		{
		  $fd_data = array(
								  'poster_status'=>'2'
								);
		}
		else
		{
		  $fd_data = array(
								  'receiver_status'=>'2'
								);
		}
	
		$where = "feedback_id = '".$res_array['feedback_id']."'";

		$this->vendor_model->safe_update('wl_quotation_feedback', $fd_data,$where ,FALSE );

		$this->session->set_userdata(array('msg_type'=>'success'));
		$this->session->set_flashdata('success',"Feedback has been deleted successfully");
	  }
	  else
	  {
		$this->session->set_userdata(array('msg_type'=>'error'));
		$this->session->set_flashdata('error',"Invalid record");
	  }
	  redirect($_SERVER['HTTP_REFERER'],''); 
		
	   
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